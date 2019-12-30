<?php

namespace App\Http\Requests\Service;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class CreateServiceRateRequest extends FormRequest
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
            'total_rate' => [
                'required',
                'numeric',
                'between:0.000001,999999999999.999999',
            ],
            'h_m_o_id' => [
                'required',
                'integer',
                'exists:h_m_o_s,id',
            ],
            'service_id' => [
                'required',
                'integer',
                'exists:services,id',
            ],
        ];
    }
}
