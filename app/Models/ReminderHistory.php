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
class ReminderHistory extends Model
{
    /**
     * @var array
     */
    protected $fillable = ['user', 'vehicle', 'phone', 'message', 'type', 'created_at', 'updated_at'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo('App\Models\User', 'user');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function vehicle()
    {
        return $this->belongsTo('App\Models\Vehicle', 'vehicle');
    }
}
