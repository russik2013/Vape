<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Validator;
use App\Setting;
class ValidateProvider extends ServiceProvider
{
    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        Validator::extend('usersParams', function ($attribute, $params, $parameters, $validator ) {
            foreach ($params as $key => $value ) {
                //if id is numeric
                if( !is_numeric( $value['id'] ) ) {
                    return false;
                }
                //if setting exists in database
                if( !Setting::all()->contains( $value['id'] ) ) {
                    return false;
                }

                foreach( collect($params)->except($key) as $innerItem ) {
                    if( $innerItem['id'] == $value['id'] ) {
                        return false;
                    }
                }
            }
            return true;
        });
    }

    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
