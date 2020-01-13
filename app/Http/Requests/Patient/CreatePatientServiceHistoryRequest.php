<?php

namespace App\Http\Requests\Patient;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class CreatePatientServiceHistoryRequest extends FormRequest
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
                'numeric',
                'exists:patients,id',
            ],
            'patient_hmo_id' => [
                'required',
                'numeric',
                'exists:patient_hmos,id',
            ],
            'personnel_id' => [
                'required',
                'numeric',
                'exists:personnels,id',
            ],
            'approval_code' => [
                'sometimes',
                'string',
            ],
            'transaction_status' => [
                'sometimes',
                'required',
                'numeric',
            ],
            'payment_type' => [
                'sometimes',
                'nullable',
                'string'
            ],
            'status' => [
                'sometimes',
                'numeric',
            ],
            'patient_transactions' => [
                'sometimes',
                'array',
            ],
            'patient_transactions.service_id' => [
                'sometimes',
                'numeric',
                'exists:services,id'
            ],
            'patient_transactions.service_rate_id' => [
                'sometimes',
                'numeric',
                'exists:service_rates,id'
            ],
        ];
    }
}
