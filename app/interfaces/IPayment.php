<?php

namespace App\interfaces;

use App\Http\Requests\PayPaymentRequest;

interface IPayment
{
    public function validate(PayPaymentRequest $request);

    public function returnResponse();

    public function failedResponse();
}
