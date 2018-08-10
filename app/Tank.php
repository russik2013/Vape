<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tank extends Model
{
    protected $fillable = ['name'];

    public function params()
    {
        return $this->morphMany(DeviseSettings::class, 'devices');
    }

    public function users(){
      return $this->belongsToMany(User::class);
    }

}
