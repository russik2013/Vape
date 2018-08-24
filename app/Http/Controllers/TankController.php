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

            foreach ($request->params as $setting_data){
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
     * @param  int  $tank_id
     * @return \Illuminate\Http\Response
     */
    public function edit($tank_id)
    {
        $tank = Tank::with('params')->find($tank_id);

        $settings_names = array();
        $settings_values = array();

        foreach ($tank->params as $singleParam) {
            $settings_names[] = $singleParam->settings->name;
            $settings_values[] = $singleParam->value;
        }

        return view("tanks.create",['tank' => $tank, 'settings_values' => $settings_values, 'settings_names' => $settings_names]);
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
        if($request->exists('params')) {
            //delete old params
            $tank->params()->delete();
            //add new params
            $ds_values = array();
            foreach ($request->input('params') as $setting_data) {
                $setting = Setting::where('name', $setting_data['name'])->first();
                $ds_values[] = array('devices_type' => 'App\Tank',
                    'devices_id' => $tank->id,
                    'settings_type' => 'App\Setting',
                    'settings_id' => $setting->id,
                    'value' => $setting_data['value']);
            }
            //insert new params to database
            DeviseSettings::insert($ds_values);
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
