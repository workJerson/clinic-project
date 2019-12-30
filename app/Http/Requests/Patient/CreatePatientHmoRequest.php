<?php

namespace App\Http\Requests\Patient;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class CreatePatientHmoRequest extends FormRequest
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
            'patient_id' => [
                'required',
                'integer',
                'exists:patients,id'
            ],
            'hmo_id' => [
                'required',
                'integer',
                'exists:h_m_o_s,id'
            ],
            'account_number' => [
                'nullable',
                'string',
                'max:100',
            ],
            'status' => [
                'sometimes',
                'integer',
            ]
        ];
    }
}
