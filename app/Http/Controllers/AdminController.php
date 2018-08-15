<?php

namespace App\Http\Controllers;

use App\Http\Requests\SettingRequest;
use App\Settings;

class AdminController extends Controller
{
    public function settings()
    {
        return view('admin.settings.index', ['settings' => $this->getAllSettings()]);
    }

    public function settingsDelete($id = null)
    {
       Settings::findOrFail($id)->delete();
       return redirect()->back();
    }
    public function store(SettingRequest $request, Settings $settings)
    {
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
        return view('admin.settings.create', ['setting' => Settings::findOrNew($id)]);
    }

    public function settingsShow($id = null)
    {
        return view('admin.settings.show', ['setting' => Settings::findOrNew($id)]);
    }

    public function getAllSettings()
    {
        return Settings::all();
    }
}
