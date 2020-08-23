<?php

namespace App\Http\Controllers\API;

use App\classes\Payments\creators\CardCreator;
use App\Http\Controllers\Controller;
use App\Http\Requests\AddPaymentRequest;
use App\Http\Requests\PayPaymentRequest;
use App\Http\Resources\Payment as PaymentResource;
use App\models\Payment\PaymentValidator;
use App\models\Payments;


class PaymentController extends Controller
{
    public function add(AddPaymentRequest $request): PaymentResource
    {
        $validatedData = PaymentValidator::getValidatedData($request);
        $payment = Payments::create($validatedData);
        $payment->setInProgress();

        return new PaymentResource($payment);
    }

    public function pay(PayPaymentRequest $request)
    {
        $payment = Payments::find($request['payment_id']);
        $payment = new CardCreator($payment);

        return $payment->pay($request);
    }
}
