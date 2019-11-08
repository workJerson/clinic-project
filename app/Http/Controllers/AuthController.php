<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use App\User;
use App\UserDetails;
use Exception;
use DB;
use App\Http\Requests\User\RegisterUserRequest;

class AuthController extends Controller
{
    /**
     * Create user.
     *
     * @param  [string] name
     * @param  [string] email
     * @param  [string] password
     * @param  [string] password_confirmation
     *
     * @return [string] message
     */
    public function signup(RegisterUserRequest $request)
    {
        $request->validated();

        $user = new User([
            'email' => $request->email,
            'is_web' => true,
            'status' => 1, // Active
            'account_type' => 0, // Customer
        ]);
        $user->password = $request->password;
        $user->save();
        $userDetails = new UserDetails([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'user_id' => $user->id,
        ]);

        try {
            DB::beginTransaction();
            $user->save();
            $user->userDetails()->save($userDetails);

            DB::commit();
        } catch (Exception $ex) {
            DB::rollback();
            dd($ex);
        } catch (Swift_TransportException $e) {
            DB::rollback();
        }

        return response()->json([
            'message' => 'Successfully created user!',
        ], 201);
    }

    /**
     * Login user and create token.
     *
     * @param  [string] email
     * @param  [string] password
     * @param  [boolean] remember_me
     *
     * @return [string] access_token
     * @return [string] token_type
     * @return [string] expires_at
     */
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|string|email',
            'password' => 'required|string',
            'remember_me' => 'boolean',
        ]);
        $credentials = request(['email', 'password']);

        if (!Auth::attempt($credentials)) {
            $userCheck = (new User())->findForPassport($request->input('email') ?? $request->input('username'));

            if ($userCheck && $userCheck->login_attempts >= 3 && $userCheck->status == 0) {
                return response([
                    'error' => 'deactivated_account',
                    'message' => 'Your account is inactive.',
                ], 401);
            }

            if ($userCheck) {
                $userCheck->incrementLoginAttempts();
            }

            return response()->json([
                'message' => 'Unauthorized',
            ], 401);
        }
        $user = $request->user();

        if ($user->login_attempts >= 3 && $user->status == 0) {
            return response([
                'error' => 'deactivated_account',
                'message' => 'Your account is inactive.',
            ], 401);
        }

        $tokenResult = $user->createToken('Personal Access Token');
        $token = $tokenResult->token;
        $user->clearLoginAttempts();

        if ($request->remember_me) {
            $token->expires_at = Carbon::now()->addWeeks(1);
        }
        $token->save();

        return response()->json([
            'access_token' => $tokenResult->accessToken,
            'token_type' => 'Bearer',
            'expires_at' => Carbon::parse(
                $tokenResult->token->expires_at
            )->toDateTimeString(),
            'user' => $user,
        ]);
    }

    /**
     * Logout user (Revoke the token).
     *
     * @return [string] message
     */
    public function logout(Request $request)
    {
        $request->user()->token()->revoke();

        return response()->json([
            'message' => 'Successfully logged out',
        ]);
    }

    public function checkUserIfDeactivated($user)
    { }
}
