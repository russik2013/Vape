<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DeviceSetting extends Model
{
    protected $table = 'device_setting';

    protected $fillable = [
        'device_type',
        'device_id',
        'setting_id',
        'value',
    ];

    public function devices()
    {
        return $this->morphTo();
    }

    public function settings()
    {
        return $this->morphTo();
    }

}
