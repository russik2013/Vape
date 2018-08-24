<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 23.08.2018
 * Time: 16:17
 */

namespace App\Http\ViewComposers;

use Illuminate\View\View;
use App\Tank;

class UserViewComposer
{
    /**
     * Bind data to the view.
     *
     * @param  View  $view
     * @return void
     */
    public function compose(View $view)
    {
        $tanks = Tank::all();

        $view->with('elems', $tanks);
    }
}