<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DeviseSettings extends Model
{
    protected $fillable = [
        'devices_type',
        'devices_id',
        'settings_type',
        'settings_id',
        'value',
    ];
}
