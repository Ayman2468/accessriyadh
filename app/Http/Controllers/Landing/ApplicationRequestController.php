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
//        $fields = [
//            'first_name' => 'required',
//            'last_name' => 'required',
//            'email' => '',
//            'address' => '',
//            'country_id' => '',
//            'building_or_business_name' => '',
//            'street_address' => '',
//            'city' => '',
//            'district' => '',
//            'postal_code' => '',
//            'deed_number' => '',
//            'plot_number' => '',
//            'phase_id' => '',
//            'building_type_id' => '',
//        ];
        $request->validate($fields);
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
