<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

/**
 * @property int $id
 * @property string $name
 * @property string $email
 * @property string $phone
 * @property string $email_verified_at
 * @property string $password
 * @property string $remember_token
 * @property string $created_at
 * @property string $updated_at
 * @property ReminderHistory[] $reminderHistories
 */
class User extends Authenticatable
{
    /**
     * @var array
     */

    protected $hidden = ['password'];
    protected $fillable = ['name', 'email', 'phone', 'email_verified_at', 'password', 'remember_token', 'superadmin', 'created_at', 'updated_at'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function reminderHistories()
    {
        return $this->hasMany('App\Models\ReminderHistory', 'user');
    }
}
