<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property int $user
 * @property int $vehicle
 * @property string $phone
 * @property string $message
 * @property string $type
 * @property string $created_at
 * @property string $updated_at
 * @property User $user
 * @property Vehicle $vehicle
 */
class SmsHistory extends Model
{
    /**
     * @var array
     */
    protected $fillable = ['phone', 'message', 'created_at', 'updated_at'];

}
