<?php

namespace App;

use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

/**
 * App\Roles
 *
 * @property int $id
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property int $user_id
 * @property string $role
 * @method static Builder|Roles newModelQuery()
 * @method static Builder|Roles newQuery()
 * @method static Builder|Roles query()
 * @method static Builder|Roles whereCreatedAt($value)
 * @method static Builder|Roles whereId($value)
 * @method static Builder|Roles whereRole($value)
 * @method static Builder|Roles whereUpdatedAt($value)
 * @method static Builder|Roles whereUserId($value)
 * @mixin Eloquent
 */
class Roles extends Model
{

    const USER_ROLE = 'user',
        ADMIN_ROLE = 'admin';
    protected $table = 'user_roles';
    protected $fillable = [
        'role', 'user_id',
    ];


}
