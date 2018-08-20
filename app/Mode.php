<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Mode extends Model
{
    public $timestamps = false;

    protected $fillable = ['name'];

    public function params() {
        return $this->morphMany(DeviseSettings::class, 'devices');
    }


}
