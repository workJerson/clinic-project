<?php

namespace App\Http\Controllers;

use App\Http\Filters\ResourceFilters;
use App\Http\Requests\User\CreateUserRequest;
use App\Repositories\User\UserRepositoryInterface;
use Illuminate\Http\Request;
use App\User;
use DB;

class UserController extends Controller
{
    protected $model;
    public function __construct(UserRepositoryInterface $userRepositoryInterface)
    {
        $this->model = $userRepositoryInterface;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(ResourceFilters $filters)
    {
        return $this->generateCachedResponse(function () use ($filters) {
            $users = $this->model->filter($filters)
                ->with([
                    'userDetails',
                ]);

            return $this->paginateOrGet($users);
        });
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateUserRequest $request)
    {
        $user = null;
        try {
            DB::beginTransaction();
            $user = $this->model->create($request->validated());
            $user->userDetails()->create($request->validated());

            if ($request->password) {
                $user->password = $request->password;
                $user->save();
            }
            DB::commit();
        } catch (\Throwable $th) {
            DB::rollback();
            throw $th;
        }

        return response($user->load([
            'userDetails',
        ]), 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data = $this->model->show($id)->load([
            'userDetails',
        ]);

        return response($data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(CreateUserRequest $request, $id)
    {
        $user = $this->model->update($request->validated(), $id);

        if ($request->password) {
            $user->password = $request->password;
            $user->save();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
