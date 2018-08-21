<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 11.08.2018
 * Time: 0:20
 */

namespace App\Tasks;

use App\Setting;

class AllSettingGetTask extends Task {

    public function run()
    {
        return Setting::all();
    }
}