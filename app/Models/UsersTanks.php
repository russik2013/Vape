<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\Pivot;

class UsersTanks extends Pivot
{
    public $table = "users_to_tanks";

    protected $fillable = [
        'user_id',
        'tank_id',
    ];
}
