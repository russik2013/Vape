<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Liquid extends Model
{
    public $table = 'liquids';

    protected $fillable = ['name'];

    public function params() {
        return $this->morphMany(DeviceSetting::class, 'devices');
    }
}
