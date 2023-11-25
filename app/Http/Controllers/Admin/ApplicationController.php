<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ApplicationRequest;
use App\Models\ApplicationRequestAnswer;
use App\Models\BuildingType;
use App\Models\BuildingTypeQuestion;
use App\Models\Question;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class ApplicationController extends Controller
{
    public function index()
    {
        $applications = ApplicationRequest::query()->with('buildingType');
        if (\request()->filled('is_applied')) {
            $applications = $applications->where('is_applied', request()->is_applied);
        }else{
            $applications = $applications->where('is_applied', 1);

        }
        if (\request()->filled('q')) {
            $applications = $applications->where(function ($where) {
                $where->orwhere('first_name', 'like', '%' . \request()->q . '%');
                $where->orwhere('last_name', 'like', '%' . \request()->q . '%');
                $where->orwhere('email', 'like', '%' . \request()->q . '%');
                $where->orwhere('street_address', 'like', '%' . \request()->q . '%');
                $where->orwhere('city', 'like', '%' . \request()->q . '%');
                $where->orwhere('district', 'like', '%' . \request()->q . '%');
                $where->orwhere('postal_code', 'like', '%' . \request()->q . '%');
                $where->orwhere('deed_number', 'like', '%' . \request()->q . '%');
                $where->orwhere('plot_number', 'like', '%' . \request()->q . '%');
            });
        }
        $applications = $applications->latest()->paginate(20);
        return response()->json(['data' => $applications]);
    }

    public function show($id)
    {
        $application = ApplicationRequest::with('buildingType')->find($id);
        $answers = ApplicationRequestAnswer::join('questions','application_request_answers.question_id','=','questions.id')
            ->join('building_type_questions','building_type_questions.question_id','=','questions.id')
            ->where('application_request_id',$id)->where('building_type_questions.building_type_id',$application->building_type_id)->orderBy('building_type_questions.order')->get();
        return response()->json(['data' => $application,'answers'=>$answers]);

    }
    public function destroy($applicationId){
        $application = ApplicationRequest::find($applicationId);
        if(!empty($application)){
            $application->answers()->delete();
            $application->delete();
            return response()->json(['message' => 'application deleted']);
        }
    }
}
