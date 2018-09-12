<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Mode;

class ModeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('modes.index', ['modes' => Mode::all()]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function create($id = null)
    {
        return view('modes.create', ['mode' => Mode::findOrNew($id)]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $id = null)
    {
        $mode = Mode::findOrNew($id);
        $mode->fill($request->all());
        $mode->save();
        $settingsMass = [];
        if($request->Settings) {
            foreach ($request->Settings as $setting) {
                $settingsMass[] = [
                    'devices_type' => Mode::class,
                    'devices_id' => $mode->id,
                    'settings_type' => Setting::class,
                    'settings_id' => array_get($setting, 'settingID', 1),
                    'value' => array_get($setting, 'settingValue', 'default')
                ];
            }
        }
        DeviceSetting::insert($settingsMass);
        return redirect(route('modes.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return view('modes.single', ['mode' => Mode::find($id)]);
    }

//    /**
//     * Show the form for editing the specified resource.
//     *
//     * @param  int  $id
//     * @return \Illuminate\Http\Response
//     */
//    public function edit($id)
//    {
//        //
//    }
//
//    /**
//     * Update the specified resource in storage.
//     *
//     * @param  \Illuminate\Http\Request  $request
//     * @param  int  $id
//     * @return \Illuminate\Http\Response
//     */
//    public function update(Request $request, $id)
//    {
//        //
//    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        (Mode::findOrNew($id))->delete();
        return redirect(route('modes.index'));
    }
}
