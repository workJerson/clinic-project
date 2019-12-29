<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class CreateUserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return Auth::check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'first_name' => 'sometimes|required|max:100',
            'last_name' => 'sometimes|required|max:100',
            'email' => 'sometimes|required|string|email|max:255|unique:users',
            'password' => 'sometimes|required|string|confirmed',
            'is_web' => 'sometimes|required|boolean',
            'is_cms' => 'sometimes|required|boolean',
            'status' => 'sometimes|required|numeric'
        ];
    }
}
