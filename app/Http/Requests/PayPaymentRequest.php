<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;


class PayPaymentRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'payment_id' => 'required|integer|exists:payment,id',
            'card_number' => 'required|integer|digits:16',
            'expire_day' => 'required|integer|between:0,31|',
            'expire_month' => 'required|integer|between:0,12'
        ];
    }

    public function messages()
    {
        return [
            'payment_id.exists' => 'Payment does not exists in database',
            'card_number.required' => 'The Card Number Field Is required.',
            'expire_day.required' => 'The Expire Date Field Is required.',
            'expire_month.required' => 'The Expire Month Field Is required.',
        ];
    }

}
