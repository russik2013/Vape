<?php

/**
 * Created by PhpStorm.
 * User: User
 * Date: 20.08.2018
 * Time: 17:10
 */

namespace App\Http\ViewComposers;

use App\Setting;
use Illuminate\View\View;

class TankViewComposer
{
    /**
     * Bind data to the view.
     *
     * @param  View  $view
     * @return void
     */
    public function compose(View $view)
    {
        $settings = Setting::all();

        $view->with('elems', $settings);
    }
}