<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tank extends Model
{
    protected $fillable = ['name'];

    public function settings()
    {
        return $this->morphMany(DeviseSettings::class, 'devices');
    }

}
