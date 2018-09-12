<?php

namespace App\Http\Controllers;

use App\DeviceSetting;
use App\Http\Requests\SettingRequest;

use App\Mode;
use App\Setting;
use Illuminate\Http\Request;
use App\Tank;
class AdminController extends Controller
{
    public function settings()
    {
        return view('admin.settings.index', ['settings' => $this->getAllSettings()]);
    }

    public function settingsDelete($id = null)
    {
       Setting::findOrFail($id)->delete();
       return redirect()->back();
    }
    public function store(SettingRequest $request, $id = null)
    {
        $settings = Setting::findOrNew($id);
        $settings->fill($request->all());
        if($request->activity){
            $settings->activity = 1;
        } else {
            $settings->activity = 0;
        }
        $settings->save();
        return redirect()->route('settings.all');
    }

    public function settingsCreate($id = null)
    {
        return view('admin.settings.create', ['setting' => Setting::findOrNew($id)]);
    }

    public function settingsShow($id = null)
    {
        return view('admin.settings.show', ['setting' => Setting::findOrNew($id)]);
    }

    public function getAllSettings()
    {
        return Setting::all();
    }
}
