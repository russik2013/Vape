<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Setting;

class SettingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('settings.index', ['settings' => $this->getAllSettings()]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function create($id = null)
    {
        return view('settings.create', ['setting' => Setting::findOrNew($id)]);
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
        $settings = Setting::findOrNew($id);
        $settings->fill($request->all());
        if($request->activity){
            $settings->activity = 1;
        } else {
            $settings->activity = 0;
        }
        $settings->save();
        return redirect()->route('settings.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id = null)
    {
        return view('settings.single', ['setting' => Setting::findOrNew($id)]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id = null)
    {
        Setting::findOrFail($id)->delete();
        return redirect()->back();
    }

    public function getAllSettings()
    {
        return Setting::all();
    }
}
