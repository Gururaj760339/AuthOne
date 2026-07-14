<?php

namespace App\Http\Controllers;

use App\Models\Setting;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    public function showSetting()
    {
        $setting = Setting::first();

        return view('admin.settings.admin_settings_show', compact('setting'));
    }

    public function editSetting($id)
    {
        $setting = Setting::findOrFail($id);

        return view('admin.settings.admin_edit_settings', compact('setting'));
    }


    public function updateSetting(Request $request, $id)
    {
        $setting = Setting::findOrFail($id);

        $request->validate([
            'website_name' => 'required',
            'email' => 'required|email',
            'phone' => 'required',
            'address' => 'required',
            'facebook' => 'nullable',
            'instagram' => 'nullable',
            'youtube' => 'nullable',
            'logo' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        if ($request->hasFile('logo')) {

            if ($setting->logo && file_exists(public_path($setting->logo))) {
                unlink(public_path($setting->logo));
            }

            $image = $request->file('logo');

            $name = time() . '.' . $image->getClientOriginalExtension();

            $image->move(public_path('uploads/settings'), $name);

            $setting->logo = 'uploads/settings/' . $name;
        }

        $setting->website_name = $request->website_name;
        $setting->email = $request->email;
        $setting->phone = $request->phone;
        $setting->address = $request->address;
        $setting->facebook = $request->facebook;
        $setting->instagram = $request->instagram;
        $setting->youtube = $request->youtube;

        $setting->save();

        return redirect()->route('admin.setting')
            ->with('success', 'Setting Updated Successfully.');
    }
}
