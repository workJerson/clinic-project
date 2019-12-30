<?php

namespace App\Http\Requests\Patient;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class CreatePatientRequest extends FormRequest
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
            'home_phone_number' => [
                'sometimes',
                'required',
                'numeric',
            ],
            'mobile_number' => [
                'sometimes',
                'required',
                'numeric',
            ],
            'birth_date' => [
                'required',
                'date',
            ],
            'gender' => [
                'required',
                'string',
            ],
            'civil_status' => [
                'required',
                'string',
            ],
            'occupation' => [
                'sometimes',
                'required',
                'string',
            ],
            'contact_person' => [
                'sometimes',
                'required',
                'string',
            ],
            'contact_person_number' => [
                'sometimes',
                'required',
                'string',
            ],
            'senior_id' => [
                'sometimes',
                'required',
                'string',
            ],
        ];
    }
}
