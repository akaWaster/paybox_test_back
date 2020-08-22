<?php

namespace App\models;

use Eloquent;
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
 */
class Payments extends Model
{
    const PAYMENT_CREATED = 0,
        PAYMENT_IN_PROGRESS = 1,
        PAYMENT_PAID = 2,
        PAYMENT_FAILED = 3,
        PAYMENT_REATTEMPTED = 4;

    protected $table = 'user_roles';

    protected $fillable = [
        'card_information', 'paid_at', 'user_id', 'status', 'amount'
    ];

}
