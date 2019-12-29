<?php

namespace App\Http\Requests\Auth;

use Illuminate\Foundation\Http\FormRequest;

class RegisterUserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true; // Admin
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'first_name' => 'required|max:100',
            'last_name' => 'required|max:100',
            'middle_name' => 'string|max:100',
            'birth_date' => 'sometimes|required|date',
            'phone_number' => 'sometimes|required|numeric|digits_between:1,15',
            'mobile_number' => 'nullable|numeric|digits_between:1,15',
            'city' => 'sometimes|required|string',
            'address' => 'sometimes|required|string',
            'zip_code' => 'sometimes|required|string',
            'image' => 'sometimes|string',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|confirmed',
        ];
    }
}
