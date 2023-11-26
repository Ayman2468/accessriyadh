<?php

namespace App\Http\Controllers\Landing;

use App\Http\Controllers\Controller;
use App\Models\ApplicationRequest;
use App\Models\ApplicationRequestAnswer;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Auth;

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
    public function get_user_applications(){
        $applications = ApplicationRequest::where('email',auth()->user()->email)->where('is_applied',1)->latest()->get();
        foreach($applications as $application){
            $application->answers = ApplicationRequestAnswer::join('questions','application_request_answers.question_id','=','questions.id')
            ->join('building_type_questions','building_type_questions.question_id','=','questions.id')
            ->where('application_request_id',$application->id)->where('building_type_questions.building_type_id',$application->building_type_id)->orderBy('building_type_questions.order')->get();
            foreach($application->answers as $ans){
                if(!is_numeric($ans->answer)){
                    foreach(json_decode($ans->answers) as $an){
                        if($an->en == $ans->answer) $ans->answer_ar = $an->ar;
                        if(str_contains($ans->answer,',') && str_contains($ans->answer,$an->en)){
                            if(!isset($ans->answer_ar)) $ans->answer_ar = '';
                            if(!empty($ans->answer_ar)) $ans->answer_ar = $ans->answer_ar.','.$an->ar;
                            else $ans->answer_ar = $ans->answer_ar.$an->ar;
                        }
                    }
                }else{
                    $ans->answer_ar = $ans->answer;
                }
            }
        }
        return response()->json(['data' => $applications]);
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
                $user = User::create([
                    'name' => $request->first_name.' '.$request->last_name,
                    'email' => $request->email,
                    'password' => Hash::make($request->password),
                ]);
                event(new Registered($user));

                Auth::login($user);
            }
        }
        return response()->json(['data' => $applicationRequest]);
    }
}
