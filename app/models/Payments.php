<?php

namespace App\models;

use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

/**
 * App\models\Payments
 *
 * @property int $id
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property int $user_id
 * @property float $amount
 * @property int $status
 * @property string $card_information
 * @property Carbon|null $paid_at
 * @mixin Eloquent
 * @method static Builder|Payments newModelQuery()
 * @method static Builder|Payments newQuery()
 * @method static Builder|Payments query()
 * @method static Builder|Payments whereAmount($value)
 * @method static Builder|Payments whereCardInformation($value)
 * @method static Builder|Payments whereCreatedAt($value)
 * @method static Builder|Payments whereId($value)
 * @method static Builder|Payments wherePaidAt($value)
 * @method static Builder|Payments whereStatus($value)
 * @method static Builder|Payments whereUpdatedAt($value)
 * @method static Builder|Payments whereUserId($value)
 */
class Payments extends Model
{
    const PAYMENT_CREATED = 0,
        PAYMENT_IN_PROGRESS = 1,
        PAYMENT_PAID = 2,
        PAYMENT_FAILED = 3,
        PAYMENT_REATTEMPTED = 4;

    const STATUSES = [
        SELF::PAYMENT_CREATED => 'Payment is created',
        SELF::PAYMENT_IN_PROGRESS => 'Payment is in Progress',
        SELF::PAYMENT_PAID => 'Payment is Paid',
        SELF::PAYMENT_FAILED => 'Payment Failed',
        SELF::PAYMENT_REATTEMPTED => 'Payment Reattempted'
    ];
    protected $table = 'payment';

    protected $fillable = [
        'card_information', 'paid_at', 'user_id', 'status', 'amount'
    ];

    public function setInProgress(): void
    {
        $this->status = self::PAYMENT_IN_PROGRESS;
        $this->save();
    }
}
