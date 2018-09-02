<?php

namespace App\Http\Controllers;

use App\Http\Requests\TankRequest;
use App\Tank;
use App\Setting;
use App\DeviseSettings;
use Illuminate\Http\Request;
use Psy\Util\Json;

class TankController extends Controller
{
    const DEVICE_TYPE = 'App\Tank';
    const SETTING_TYPE = 'App\Setting';
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
                $ds_values[] = array('devices_type' => self::DEVICE_TYPE,
                    'devices_id' => $tank->id,
                    'settings_type' => self::SETTING_TYPE,
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
    public function show($id)
    {
        $tank = Tank::with('params', 'params.settings')->find($id);
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
        $tank_params = $tank->params;

        //1.update old params
        for($i = 0; $i < count($tank_params); $i++) {
            //set new values for current parameter
            $tank_params[$i]->value = $user_params[$i]['value'];
            $tank_params[$i]->settings_id = $user_params[$i]['id'];
            $tank_params[$i]->save();
        }

        //2.add new params
        $newParams = [];
        for($i = count($tank_params); $i < count($user_params); $i++) {
            $newParams[] = [
                'devices_type' => Tank::class,
                'devices_id' => $tank->id,
                'settings_type' => Setting::class,
                'settings_id' => array_get($user_params[$i], 'id', 1),
                'value' => array_get($user_params[$i], 'value', 'default'),
            ];
        }
        DeviseSettings::insert($newParams);

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
