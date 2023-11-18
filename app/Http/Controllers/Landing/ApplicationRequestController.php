<?php

namespace App\Http\Controllers\Landing;

use App\Http\Controllers\Controller;
use App\Models\ApplicationRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class ApplicationRequestController extends Controller
{
    public function show()
    {
        $applicationRequest = new ApplicationRequest();
        $applicationRequest->country_id= 682;
        $applicationRequest->phase_id= '1';
        if(auth()->user()){
            $application = ApplicationRequest::where('email',auth()->user()->email)->where('is_applied',0)->latest()->first();
            if($application){
                if(Hash::check($application->validation,auth()->user()->password)) $applicationRequest = $application;
            }
        }
        return response()->json(['data' => $applicationRequest]);
    }

    public function register(Request $request)
    {
        $fields = [
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'email|required',
            'password' => 'required',
            'country_id' => 'required',
            'building_or_business_name' => 'required',
            'street_address' => 'required',
            'city' => 'required',
            'district' => 'required',
            'postal_code' => 'required',
            'deed_number' => 'required',
            'plot_number' => 'required',
            'phase_id' => 'required',
            'building_type_id' => 'required',
        ];
        $messages = [
            'first_name.required' => __('validate.The first name field is required.'),
            'last_name.required' => __('validate.The last name field is required.'),
            'email.required' => __('validate.The email field is required'),
            'email.email' => __('validate.The email field must be a valid email address.'),
            'password.required' => __('validate.The password field is required.'),
            'country_id.required' => __('validate.The country field is required.'),
            'building_or_business_name.required' => __('validate.The building or business name field is required.'),
            'street_address.required' => __('validate.The street address field is required.'),
            'city.required' => __('validate.The city field is required.'),
            'district.required' => __('validate.The district field is required.'),
            'postal_code.required' => __('validate.The postal code field is required.'),
            'deed_number.required' => __('validate.The deed number field is required.'),
            'plot_number.required' => __('validate.The plot number field is required.'),
            'phase_id.required' => __('validate.The phase field is required'),
            'building_type_id.required' => __('validate.The building type field is required'),
        ];
        $request->validate($fields,$messages);
        $applicationRequest = null;
        if (auth()->user()){
            $application = ApplicationRequest::where('email',auth()->user()->email)->where('is_applied',0)->latest()->first();
            if($application){
                if(Hash::check($application->validation,auth()->user()->password)) $applicationRequest = $application;
            }
        }
        if ($applicationRequest){
            $applicationRequest->update($request->except(['created_at', 'updated_at']));
        }else{
            $applicationRequest = ApplicationRequest::create($request->except('password'));
            $applicationRequest->update(['validation'=>$request->password]);
            if((empty(auth()->user()) || $request->email != auth()->user()->email) && User::where('email',$request->email)->first() == null){
                User::create([
                    'name' => $request->first_name.' '.$request->last_name,
                    'email' => $request->email,
                    'password' => Hash::make($request->password),
                ]);
            }
        }
        return response()->json(['data' => $applicationRequest]);
    }
}
