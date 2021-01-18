<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\SettingRequest;
use App\Setting;
use App\Traits\DeleteModelTrait;


class AdminSettingController extends Controller
{
    use DeleteModelTrait;
    private $setting;
    public function __construct(Setting $setting) {
        $this->setting = $setting;
    }
    public function index() {
        $settings = $this->setting->latest()->paginate(5);
        return view('admin.settings.index', compact('settings'));
    }

    public function create() {
        return view('admin.settings.create');
    }

    public function store(SettingRequest $request) {
        $dataInsert = [
            'config_key' => $request->config_key,
            'config_value' => $request->config_value,
            'type' => $request->type
        ];
        $this->setting->create($dataInsert);
        return redirect()->route('settings.index');
    }

    public function edit($id) {
        $setting = $this->setting->find($id);
        return view('admin.settings.edit',compact('setting'));
    }

    public function update(Request $request, $id) {
        $dataUpdate = [
            'config_key' => $request->config_key,
            'config_value' => $request->config_value
        ];
        $this->setting->find($id)->update($dataUpdate);
        return redirect()->route('settings.index');
    }

    public function delete($id) {
        return $this->deleteModelTrait($id,$this->setting);
    }
}
