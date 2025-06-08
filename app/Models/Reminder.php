<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property int $before_deadline
 * @property string $time
 * @property string $created_at
 * @property string $updated_at
 * @property ReminderReceiverRole[] $reminderReceiverRoles
 */
class Reminder extends Model
{
    /**
     * @var array
     */
    protected $fillable = ['before_deadline', 'created_at', 'updated_at'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function reminderReceiverRoles()
    {
        return $this->hasMany('App\Models\ReminderReceiverRole', 'reminder');
    }
}
