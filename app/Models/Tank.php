<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tank extends Model
{
    public $table = 'tanks';

    protected $fillable = ['name'];

    public function settings() {
        return $this->morphToMany(Setting::class, 'device', 'device_setting' );
    }

    public function users() {
      return $this->morphToMany(User::class, 'device', 'device_user' )->using( DeviceUser::class );
    }
}
