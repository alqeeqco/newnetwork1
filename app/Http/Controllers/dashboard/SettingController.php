<?php

namespace App\Http\Controllers\dashboard;

use App\Http\Controllers\Controller;
use App\Models\Settings;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class SettingController extends Controller
{
    public function index()
    {

        $settings=Settings::where('set_group','general')->orderBy('sort_order')->get();

        return view('dashboard.setting.index',compact('settings'));
    }

    public function social()
    {
        $settings=Settings::where('set_group','social')->orderBy('sort_order')->get();
        return view('dashboard.setting.social',compact('settings'));
    }

    public function update(Request $request)
    {
        $data = $request->except('logo');
        if ($request->hasFile('logo')) {
            $name = Str::random(12);
            $path = $request->file('logo');
            $name = $name . time() . '.' . $request->file('logo')->getClientOriginalExtension();
            $data['logo'] = $name;
            $path->move('dashboard/images', $name);
        }
        if ($request->hasFile('contact-us')) {
            $name = Str::random(12);
            $path = $request->file('contact-us');
            $name = $name . time() . '.' . $request->file('contact-us')->getClientOriginalExtension();
            $data['contact-us'] = $name;
            $path->move('dashboard/images', $name);
        }
        foreach ($data as $k => $v) {
            $this->update_setting([
                'key_id' => $k,
                'value' => $v
            ], $k);
        }

        return redirect()->back()->with('success', __('lang.success'));
    }

    public function update_setting($data,$key){
        return Settings::where('key_id',$key)->update($data);
    }
}
