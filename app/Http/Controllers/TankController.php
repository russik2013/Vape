<?php

namespace App\Http\Controllers;

use App\Http\Requests\TankRequest;
use App\Tank;
use App\Setting;
use App\DeviseSettings;

class TankController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $tanks = Tank::all();

        return view("tanks.index",['tanks'=> $tanks]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("tanks.create");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\TankRequest  $request
     * @return \Illuminate\Http\Response
     * @param  \App\Tank $tank
     */
    public function store(TankRequest $request, Tank $tank)
    {
        $tank->fill($request->all());
        $tank->save();

        if($request->params) {
            $ds_values = array();

            foreach ($request->params as $setting_data) {
                $ds_values[] = array('devices_type' => 'App\Tank',
                    'devices_id' => $tank->id,
                    'settings_type' => 'App\Setting',
                    'settings_id' => $setting_data['id'],
                    'value' => $setting_data['value']);
            }
            DeviseSettings::insert($ds_values);
        }
        return redirect(route('tanks.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  integer  $id
    // * @param Tank $tank
     * @return \Illuminate\Http\Response
     */
    public function show($id) // ознакомься и пойми, зачем я добавил эти строки
    //public function show(Tank $tank)
    {
        $tank = Tank::with('params', 'params.settings')->find($id); // debugger в помощь
        return view("tanks.single",['tank' => $tank]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  Tank  $tank
     * @return \Illuminate\Http\Response
     */
    public function edit(Tank $tank)
    {
        return view("tanks.create",['tank'=>$tank]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\TankRequest  $request
     * @param  \App\Tank  $tank
     * @return \Illuminate\Http\Response
     */
    public function update(TankRequest $request, Tank $tank)
    {
        $tank->fill($request->all());
        $tank->update();

        $user_params = $request->params;
        if($user_params) {
            //get collection of tank parameters in database
            $tank_params = $tank->params;
            for($i = 0; $i < count($user_params); $i++) {
                //if users parameters are more than tank parameters - add new one
                if($i >= count($tank_params)) {
                    $additionalParam = new DeviseSettings();
                    $additionalParam->devices_type = 'App\Tank';
                    $additionalParam->devices_id = $tank->id;
                    $additionalParam->settings_type = 'App\Setting';
                    $additionalParam->settings_id = $user_params[$i]['id'];
                    $additionalParam->value = $user_params[$i]['value'];
                    //add new parameter to tank parameters collection
                    $tank_params->push( $additionalParam );
                    break;
                }
                //set new values for current parameter
                $tank_params[$i]->value = $user_params[$i]['value'];
                $tank_params[$i]->settings_id = $user_params[$i]['id'];
            }
                //insert or update each model in tank collection of parameters
                $tank_params->each(function($item, $key) {
                    $item->save();
                });
            //if users parameters are less than tank parameters - remove odd params from tank
            if( count($user_params) < count($tank_params) ) {
                //get odd elements of tank parameters
                $deleting_items = $tank_params->slice( count($user_params) - 1 );
                //delete odd elements
                $deleting_items->each(function($item, $key){
                    $item->delete();
                });
            }
        }

        return redirect(route('tanks.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $tank =  Tank::findOrFail($id);
        $tank->params()->delete();
        $tank->delete();
        return redirect()->back();
    }
}
