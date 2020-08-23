<?php


namespace App\classes\Payments\creators;

use App\abstracts\PaymentValidator;
use App\classes\Payments\payers\CardPayer;
use App\interfaces\IPayment;
use App\models\Payments;

class CardCreator extends PaymentValidator
{
    private $payment;

    public function __construct(Payments $payments)
    {
        $this->payment = $payments;
    }

    public function getPaymentMethod(): IPayment
    {
        return new CardPayer($this->payment);
    }
}
