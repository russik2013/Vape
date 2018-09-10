<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\Pivot;

class DeviceUser extends Pivot
{
    public $table = "device_user";

    protected $fillable = [
        'user_id',
        'device_type',
        'device_id',
    ];
}
