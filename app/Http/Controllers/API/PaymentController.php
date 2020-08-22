<?php

namespace App\Http\Controllers;

use App\models\Payments;
use Request;

class PaymentController extends Controller
{
    public function add(Request $request)
    {
        $request->validate([
            'amount' => 'required|float',
            'user_id' => 'required|integer|exists:users,id'
        ]);

        $payment = Payments::create($request);

        $payment->status = Payments::PAYMENT_IN_PROGRESS;
        $payment->save();

        return $payment;
    }
}
