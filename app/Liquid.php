<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Liquid extends Model
{
    protected $fillable = ['name'];

    public function params()
    {
        return $this->morphMany(DeviseSettings::class, 'devices');
    }
}
