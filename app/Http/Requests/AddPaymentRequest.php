<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;


class AddPaymentRequest extends FormRequest
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
            'amount' => 'required|numeric|between:0,100000.9999',
            'user_id' => 'required|integer|exists:users,id',
//            'card_number' => 'required|integer|length:16',
//            'expire_day' => 'required|integer|length:2',
//            'expire_month' => 'required|integer|length:2'
        ];
    }

    public function messages()
    {
        return [
            'amount.required' => 'The Amount Field Is required.',
            'user_id.required' => 'The User_id Field is required.',
            'user_id.exists' => 'User_id does not exists'
        ];
    }

}
