<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property int $area_code
 * @property int $type
 * @property int $brand
 * @property string $number
 * @property string $code
 * @property string $stnk_validity_period
 * @property string $tax_validity_period
 * @property string $created_at
 * @property string $updated_at
 * @property VehicleAreaCode $vehicleAreaCode
 * @property VehicleBrand $vehicleBrand
 * @property VehicleType $vehicleType
 * @property ReminderHistory[] $reminderHistories
 */
class Vehicle extends Model
{
    /**
     * @var array
     */
    protected $fillable = ['area_code', 'number', 'code', 'stnk_validity_period', 'tax_validity_period', 'created_at', 'updated_at'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function reminderHistories()
    {
        return $this->hasMany('App\Models\ReminderHistory', 'vehicle');
    }
}
