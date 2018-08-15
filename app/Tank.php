<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tank extends Model
{

    public $table = 'tanks';

    protected $fillable = ['name'];

    public function params() {
        return $this->morphMany(DeviseSettings::class, 'devices');
    }

    public function users() {
      return $this->belongsToMany(User::class, 'users_to_tanks')->using(UsersTanks::class);
    }

}
