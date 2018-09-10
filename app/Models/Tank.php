<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tank extends Model
{
    public $table = 'tanks';

    protected $fillable = ['name'];

    public function settings() {
        return $this->morphToMany(Setting::class, 'device', 'device_setting');
    }

    public function users() {
      return $this->belongsToMany(User::class, 'users_to_tanks')->using(UsersTanks::class);
    }

}
