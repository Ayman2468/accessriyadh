<?php

namespace App\Http\Controllers\Landing;

use App\Http\Controllers\Controller;
use App\Models\ApplicationRequest;
use App\Models\ApplicationRequestAnswer;
use App\Models\Question;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class QuestionController extends Controller
{
    public function index()
    {
        $buildingTypeId = request()->building_type_id ?? '';
        $stepId = request()->step_id ?? '';
        $requestId = request()->request_id ?? '';
        $questions = Question::whereHas('BuildingTypeQuestion', function ($q) use ($buildingTypeId, $stepId) {
            $q->where('building_type_id', $buildingTypeId);
            $q->where('phase_id', $stepId);
        })
            ->join('building_type_questions', 'building_type_questions.question_id', '=', 'questions.id')
            ->where('building_type_questions.building_type_id', $buildingTypeId)
            ->orderBy('questions.title_id')
            ->orderBy('building_type_questions.order')->get();
        return response()->json(['questions' => $questions]);
    }

    public function answer(Request $request)
    {
        $buildingTypeId = request()->building_type_id ?? '';
        $stepId = request()->step_id ?? '';
        $requestId = request()->update_request_id ?? false;

        $applicationRequest = null;
        if ($requestId)
            $applicationRequest = ApplicationRequest::find($requestId);

        if (!$applicationRequest) abort(404);

       $this->saveAnswers($request,$applicationRequest);
    }
    public function finish(Request $request)
    {
        $buildingTypeId = request()->building_type_id ?? '';
        $stepId = request()->step_id ?? '';
        $requestId = request()->update_request_id ?? false;

        $applicationRequest = null;
        if ($requestId)
            $applicationRequest = ApplicationRequest::find($requestId);

        if (!$applicationRequest) abort(404);

        $this->saveAnswers($request,$applicationRequest);

        $applicationRequest->is_applied = 1;
        $applicationRequest->save();
    }

    private function saveAnswers($request,$applicationRequest)
    {



        $questions = [];
        foreach ($request->request as $key => $item) {
            if (Str::startsWith($key, 'questionId')) {
                $questionWebId = explode('questionId', $key)[1] ?? false;
                if ($questionWebId) {
                    $questions[] = ['id' => $questionWebId, 'answer' => $item];
                }
            }
        }
        foreach ($questions as $question) {
            $questionBase = Question::find($question['id']);
            $score = 0;
            if(gettype($questionBase->answers) != 'array'){
                $questionBase->answers = json_decode($questionBase->answers);
            }
            foreach($questionBase->answers as $ans){
                if(gettype($question['answer']) == 'array'){
                    foreach($question['answer'] as $questAns){
                        if(($ans['en'] == $questAns || $ans['ar'] == $questAns) && isset($ans['score'])){
                            $score += $ans['score'];
                        }
                    }
                }else{
                    if(($ans['en'] == $question['answer'] || $ans['ar'] == $question['answer']) && isset($ans['score'])){
                        $score += $ans['score'];
                    }
                }
            }
            ApplicationRequestAnswer::updateOrCreate(
                [
                    'application_request_id' => $applicationRequest->id,
                    'question_id' => $question['id']
                ],
                [
                    'application_request_id' => $applicationRequest->id,
                    'question_id' => $question['id'],
                    'score' => $score,
                    'answer' => is_array($question['answer']) ? implode(', ', $question['answer']) : $question['answer']
                ]
            );
        }
    }
}
