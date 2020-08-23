<?php


namespace App\abstracts;


use App\Http\Requests\PayPaymentRequest;
use App\interfaces\IPayment;

abstract class PaymentValidator
{
    public function pay(PayPaymentRequest $request)
    {
        $paymentMethod = $this->getPaymentMethod();
        if ($paymentMethod->validate($request)) {
            return $paymentMethod->returnResponse();
        }

        return $paymentMethod->failedResponse();
    }

    abstract public function getPaymentMethod(): IPayment;
}
