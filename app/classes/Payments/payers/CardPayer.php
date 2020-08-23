<?php


namespace App\classes\Payments\payers;

use App\interfaces\IPayment;
use App\models\Payments;
use Illuminate\Support\Carbon;
use Nekman\LuhnAlgorithm\LuhnAlgorithmFactory;
use Nekman\LuhnAlgorithm\Number;

class CardPayer implements IPayment
{
    private $payment;

    /**
     * @param Payments $payments
     */

    public function __construct(Payments $payments)
    {
        date_default_timezone_set('UTC');
        $this->setPayment($payments);
    }

    public function validate($request)
    {
        if (in_array($this->getPayment()->status, [Payments::PAYMENT_PAID])) {
            return false;
        }

        if (!$this->validateCard($request['card_number'])) {
            return false;
        }

        if (!$this->validateDate($request['expire_day'], $request['expire_month'])) {
            return false;
        }

        $this->getPayment()->card_information = json_encode($this->getCardInformation($request));
        $this->getPayment()->paid_at = Carbon::now();
        $this->getPayment()->save();

        return true;
    }

    public function getPayment(): Payments
    {
        return $this->payment;
    }

    /**
     * @param Payments $payment
     */
    public function setPayment(Payments $payment): void
    {
        $this->payment = $payment;
    }

    private function validateCard($cardNumber)
    {

        $validator = LuhnAlgorithmFactory::create();
        $cardNumber = Number::fromString($cardNumber);

        return $validator->isValid($cardNumber);
    }

    private function validateDate($year, $month)
    {
        $day = '31';
        $expiredDate = strtotime(sprintf('%s-%s-%s', $day, $month, $year));

        return time() < $expiredDate;
    }

    private function getCardInformation($information): array
    {
        return [
            'number' => $information['card_number'],
            'expire_day' => $information['expire_day'],
            'expire_month' => $information['expire_month']
        ];

    }

    public function returnResponse()
    {
        $this->getPayment()->status = Payments::PAYMENT_PAID;
        $this->getPayment()->save();

        return $this->payment;
    }

    public function failedResponse(): array
    {
        $this->getPayment()->status = Payments::PAYMENT_FAILED;
        $this->getPayment()->save();

        return ['error' => true, 'message' => 'Failed Response'];
    }
}
