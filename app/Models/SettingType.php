<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SettingType extends Model
{
    protected $table = 'setting_types';

    protected $fillable = ['name'];

    public function settings(){
        return $this->hasMany( Setting::class );
    }
}
