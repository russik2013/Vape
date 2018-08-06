<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Settings extends Model
{
    protected $fillable = ['name', 'activity',];

    protected $table = 'settings';

    public function devices()
    {
        return $this->morphMany(DeviseSettings::class, 'settings');
    }
    //набросок на будущее
//    public function getDevicesAttribute($value)
//    {
//        $relation = 'devices';
//        $notificationSettings = $this->getRelationValue($relation);
//        $notificationSettings[] =  new DeviseSettings([
//            'devices_type' => 'App\Tank',
//            'devices_id' => 12,
//            'settings_type' => 'App\Settings',
//            'settings_id' => 1,
//            'value' => 12,
//        ]);
//        $this->setRelation($relation, $notificationSettings);
//        return $notificationSettings;
//
//    }
}
