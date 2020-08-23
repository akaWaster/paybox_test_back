<?php


namespace App\models\Payment;

use App\Http\Requests\AddPaymentRequest;

class PaymentValidator
{

    const CUT_PRECISION_LENGTH = 2;

    private $payment;

    public static function getValidatedData(AddPaymentRequest $request): array
    {
        $data = $request->validated();
        $data['amount'] = self::cutAmount($data['amount'], SELF::CUT_PRECISION_LENGTH);
        return $data;
    }

    private static function cutAmount(float $amount, int $length): float
    {
        return intval(($amount * pow(10, $length))) / pow(10, $length);
    }

    /**
     * @return Payment
     */
    public function getPayment(): Payment
    {
        return $this->payment;
    }

    /**
     * @param Payment $payment
     */
    public function setPayment(Payment $payment): void
    {
        $this->payment = $payment;
    }

}
