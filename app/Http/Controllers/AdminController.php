<?php

namespace App\Http\Controllers;

use App\DeviceSetting;
use App\Http\Requests\SettingRequest;
use App\Http\Requests\AdditionalParamsRequest;
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
    public function modes()
    {
        return view('modes.index', ['modes' => Mode::all()]);
    }

    public function modesCreate($id = null)
    {
        return view('modes.create', ['mode' => Mode::findOrNew($id)]);
    }

    public function modesStore( Request $request, $id = null)
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

    public function modeDelete($id)
    {
        (Mode::findOrNew($id))->delete();
        return redirect(route('modes.index'));
    }

    public function modeShow($id)
    {
        return view('modes.single', ['mode' => Mode::find($id)]);
    }

    /**
     * Get additional view for adding settings to tanks
     *
     * @param \App\Http\Requests\AdditionalParamsRequest $request
     * @return \Illuminate\Http\Response
     * */
    public function getAdditionalViewForTanks(AdditionalParamsRequest $request)
    {
        return view('tanks.forAdditionalParams', ['index' => $request->input('index')]);
    }
    /**
     * Get additional view for adding tanks to users
     *
     * @param \App\Http\Requests\AdditionalParamsRequest $request
     * @return \Illuminate\Http\Response
     * */
    public function getAdditionalViewForUsers( AdditionalParamsRequest $request)
    {
        return view('users.forAdditionalParams', ['index' => $request->input('index')]);
    }
}
