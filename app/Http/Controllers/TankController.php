<?php

namespace App\Http\Controllers;

use App\Http\Requests\TankRequest;
use App\Tank;
use App\Setting;
use App\DeviceSetting;
use Illuminate\Http\Request;
use Psy\Util\Json;

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
        return view("tanks.index", [ 'tanks'=> $tanks ] );
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
            foreach ($request->params as $setting_data) {
                $tank->settings()
                    ->attach($setting_data['id'], ['value' => $setting_data['value']]);
            }
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
        $tank = Tank::with('settings')->find($id);

        $params = DeviceSetting::where([
            ['device_type', Tank::class],
            ['device_id', $tank->id],
        ])->get();

        return view("tanks.single",['tank' => $tank, 'params' => $params]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  Tank  $tank
     * @return \Illuminate\Http\Response
     */
    public function edit(Tank $tank)
    {
        return view("tanks.create",['tank' => $tank]);
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

        $params_to_synchronize = array();

        if($request->params) {
            foreach ($request->params as $single_param) {
                    $params_to_synchronize[$single_param['id']] = ['value' => $single_param['value']];
            }
            $tank->settings()->sync($params_to_synchronize);
        }

        return redirect(route('tanks.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy( $id )
    {
        $tank =  Tank::findOrFail( $id );
        $tank->settings()->detach();
        $tank->delete();
        return redirect()->back();
    }
    /**
     * Detach single param from tank.
     *
     * @param  Request $request
     * @return bool
     */
    public function detachSingleParam(Request $request)
    {
        DeviceSetting::where([
            ["device_type", "=", Tank::class],
            ["device_id", "=", $request->input('tank_id')],
            ["setting_id", "=", $request->input('param')['id']],
            ["value", "=", $request->input('param')['value']],
        ])->delete();

        $params = DeviceSetting::where([
            ['device_type', Tank::class],
            ['device_id', $request->input('tank_id')],
        ])->get()->toJson();

        $settings = Setting::all()->toJson();

        $settings_and_params = "{\"settings\":".$settings.",\"params\":".$params."}";
        return $settings_and_params;
    }

    public function getSettingsAndTankParams(Request $request)
    {
        $params = DeviceSetting::where([
            ['device_type', Tank::class],
            ['device_id', $request->tank_id],
        ])->get()->toJson();

        $settings = $this->getAllSettings()->toJson();

        $settings_and_params = "{\"settings\":".$settings.",\"params\":".$params."}";

        return $settings_and_params;
    }
}
