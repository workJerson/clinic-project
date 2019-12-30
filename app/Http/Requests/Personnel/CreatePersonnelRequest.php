<?php

namespace App\Http\Requests\Personnel;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class CreatePersonnelRequest extends FormRequest
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
            'first_name' => [
                'required',
                'string',
                'max:100',
            ],
            'middle_name' => [
                'sometimes',
                'required',
                'string',
                'max:100',
            ],
            'last_name' => [
                'required',
                'string',
                'max:100',
            ],
            'title' => [
                'sometimes',
                'required',
                'string',
            ],
            'phone_number' => [
                'sometimes',
                'required',
                'numeric',
            ],
            'mobile_number' => [
                'sometimes',
                'required',
                'numeric',
            ],
            'city' => [
                'required',
                'string',
            ],
            'address' => [
                'required',
                'string',
            ],
            'zip_code' => [
                'required',
                'string',
                'max:50',
            ],
            'image' => [
                'sometimes',
                'required',
                'numeric',
            ],
        ];
    }
}
