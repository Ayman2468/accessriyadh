<?php

namespace App\Http\Controllers\Admin;

use App\Events\PasswordChanged;
use App\Http\Controllers\Controller;
use App\Services\HelperServices;
use App\Services\SettingServices;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AccountController extends Controller
{
    public ?HelperServices $helperServices = null;
    public ?SettingServices $settingServices = null;

    public function __construct()
    {
        $this->helperServices = new HelperServices();
        $this->settingServices = new SettingServices();

    }
    public function me()
    {
        $countries = $this->helperServices->countries();
        $me = auth()->user();
        return response()->json(['data' => $me,'countries' => $countries, ]);
    }

    public function updateMe(Request $request)
    {
        $this->validate($request, [
            'email' => 'unique:users,email,' . auth()->user()->id . ',id,deleted_at,NULL'
        ]);
        $user = auth()->user();
        $user->first_name = $request->first_name;
        $user->last_name = $request->last_name;
        $user->mobile_country_code = $request->mobile_country_code;
        $user->mobile = $request->mobile;
        $user->email = $request->email;
        $user->name = $user->full_name;
        if ($request->file('image')) {
            $fileName = $request->image->store('admin/personal_images');
            $user->image = $fileName;
        }
        $user->save();

        return response()->json(['user' => $user]);
    }

    public function updateMyPassword(Request $request)
    {
        $user = auth()->user();
        $request->validate([
            'new_password' => 'required|min:4',
            'current_password' => ['required', function ($attribute, $value, $fail) use ($user) {
                if (!Hash::check($value, $user->password)) {
                    return $fail(__('The current password is incorrect.'));
                }
            }],
        ]);


        $user->password = Hash::make($request->new_password);
        $user->save();
        return response()->json(['last_change' => $user->last_password_change]);
    }

    public function setting()
    {
        $setting = $this->settingServices->adminSetting();
        return response()->json(['setting' => $setting]);
    }
    public function updateSetting(Request $request)
    {
        $profile = $this->settingServices->adminSetting();
        if ($request->filled('privacy_policy')){
            $profile->privacy_policy = $request->privacy_policy;
        }
        if ($request->filled('about_us')){
            $profile->about_us = $request->about_us;
        }
        if ($request->filled('integration_info')){
            $profile->integration_info = $request->integration_info;
        }
        if ($request->filled('payment_info')){
            $profile->payment_info = $request->payment_info;
        }
        $profile->save();
        return response()->json(['data' => $profile]);

    }
}
