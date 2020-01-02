<?php

namespace App\Http\Requests\Patient;

use Illuminate\Foundation\Http\FormRequest;

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
            ],
            'patient_hmo_id' => [
            ],
            'personnel_id' => [
            ],
            'approval_code' => [
            ],
            'total_charges' => [
            ],
            'transaction_status' => [
            ],
            'discounted_charges' => [
            ],
            'discount_rate' => [
            ],
            'payment_type' => [
            ],
            'status' => [
            ],
        ];
    }
}
