<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ApplicationRequest;
use App\Models\ApplicationRequestAnswer;
use App\Models\BuildingType;
use App\Models\BuildingTypeQuestion;
use App\Models\Question;
use App\Services\QuestionService;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Str;
use App\Traits\imageinsertiontrait;

class QuestionController extends Controller
{
    use imageinsertiontrait;

    protected $questionService;

    public function __construct(QuestionService $questionService)
    {
        $this->questionService = $questionService;
    }


    public function index()
    {
        if (!request()->filled('search'))
            $buildingTypes = BuildingType::get();

        $questions = $this->questionService->getAllPaginated(['BuildingTypeQuestion.buildingType']);

        return response()->json(['questions' => $questions, 'building_types' => $buildingTypes ?? []]);
    }

    public function store(Request $request)
    {

        $answers = [];
        $answersAll = [];
        foreach ($request->answers ?? [] as $key => $item) {
            if (isset($item['image']) && $item['image'] instanceof UploadedFile) {
                // $answer['image'] is a file.
                $file = $item['image'];

                // $directory = 'questions'; // Change this to your desired directory
                // $extension = $file->getClientOriginalExtension(); // Get the original file extension
                // $hashedName = Str::random(40); // You can adjust the length of the random string as needed
                // $filename = $hashedName . '.' . $extension;
                // $storedFilePath = $file->storeAs($directory, $filename);
                $storedFilePath = $this->imageinsertion($file,'img/questions');
                $answers['image'] = $storedFilePath;
            } else {
                if ($item['image'])
                    $answers['image'] = $item['image'];
            }

            if ($item['en'] != '' && $item['en'] != null) {
                $answers['en'] = $item['en'];
                $answers['ar'] = $item['ar'];
                $answers['score'] = $item['score'];
            }
            if (count($answers))
                $answersAll[] = ($answers);

            $answers = [];
        }
        $order = Question::orderBy('order', 'desc')->first()->order ?? null;

        $question = Question::create(
            [
                'phase_id' => $request['phase_id'],
                'web_id' => $request['web_id'],
                'question_name_ar' => $request['question_name_ar'],
                'question_name_en' => $request['question_name_en'],
                'description_ar' => $request['description_name_ar'],
                'description_en' => $request['description_name_en'],
                'answers' => $answersAll,
                'order' => ++$order,
                'type' => $request['type'],
                'score' => $request['score'] ?? null,

            ],
        );
        if ($request['is_all_building'] == '0') {
            $buildingTypes = BuildingType::get();
        } else {
            $buildingTypes = BuildingType::wherein('id', $request['building_type_id'])->get();
        }

        foreach ($buildingTypes as $buildingType) {
            BuildingTypeQuestion::updateorcreate(
                [
                    'building_type_id' => $buildingType->id,
                    'question_id' => $question->id,
                ],
                [
                    'building_type_id' => $buildingType->id,
                    'question_id' => $question->id,
                    'phase_id' => $question->phase_id,
                    'order' => $question->order,

                ],
            );
        }

        $questions = $this->questionService->getAllPaginated(['BuildingTypeQuestion.buildingType']);

        return response()->json(['data' => $questions]);
    }

    public function update(Request $request, $questionId)
    {
        $question = Question::find($questionId);
        $answers = [];
        $answersAll = [];
        foreach ($request->answers ?? [] as $key => $item) {

            if (isset($item['image']) && $item['image'] instanceof UploadedFile) {
                // $answer['image'] is a file.
                $file = $item['image'];

                // $directory = 'questions'; // Change this to your desired directory
                // $extension = $file->getClientOriginalExtension(); // Get the original file extension
                // $hashedName = Str::random(40); // You can adjust the length of the random string as needed
                // $filename = $hashedName . '.' . $extension;
                // $storedFilePath = $file->storeAs($directory, $filename);
                $storedFilePath = $this->imageinsertion($file,'img/questions');
                if(!str_contains($storedFilePath,'error') && file_exists(public_path($question->image) && !empty($question->image))) unlink(public_path($question->image));
                $answers['image'] = $storedFilePath;

            } else {
                if ($item['image'])
                $answers['image'] = $question->answers[$key]['image'];
            }

            if ($item['en'] != '' && $item['en'] != null) {
                $answers['en'] = $item['en'];
                $answers['ar'] = $item['ar'];
                $answers['score'] = $item['score'];
            }
            if (count($answers))
                $answersAll[] = ($answers);

            $answers = [];
        }
        $question->update(
            [
                'web_id' => $request['web_id'],
                'question_name_ar' => $request['question_name_ar'],
                'question_name_en' => $request['question_name_en'],
                'description_ar' => $request['description_ar'],
                'description_en' => $request['description_en'],
                'answers' => $answersAll,
                'type' => $request['type'],
                'phase_id' => $request['phase_id'],
                'score' => $request['score'] ?? null,
            ],
        );

        //        $questions = Question::orderBy('web_id')->get();

        //        foreach ($questions as $question) {
        foreach ($question->BuildingTypeQuestion ?? [] as $item) {
            BuildingTypeQuestion::updateorcreate(
                [
                    'building_type_id' => $item->building_type_id,
                    'question_id' => $question->id,
                ],
                [
                    'building_type_id' => $item->building_type_id,
                    'question_id' => $question->id,
                    'phase_id' => $question->phase_id,
                ],
            );
        }

        //        }

        return response()->json(['data' => []]);
    }
    public function destroy($questionId){
        $question = Question::find($questionId);
        if(!empty($question)){
            if(gettype($question->answers) != 'array'){
                $question->answers = json_decode($question->answers);
            }
            foreach (($question->answers) ?? [] as $key => $item) {
                if(file_exists(isset($item['image']) && !Str::endsWith($question->image,'/') ? $item['image'] : null)) unlink($item['image']);
            }
            $question->delete();
            return response()->json(['message' => 'question deleted']);
        }
    }
    public function updateOrder(Request $request)
    {
        foreach ($request->questions ?? [] as $item) {
            Question::find($item['id'])->update(['order' => $item['order']]);
        }
        foreach ($request->questions ?? [] as $itemOrder) {

            foreach (BuildingTypeQuestion::where('question_id', $itemOrder['id'])->get() as $item) {
                $item->update(['order' => $itemOrder['order']]);
            }
        }

        return response()->json(['message' => 'order success']);
    }

    public function updatePhase(Request $request)
    {
        Question::find($request->id)->update(['phase_id' => $request->phase]);
        foreach (BuildingTypeQuestion::where('question_id', $request->id)->get() as $item) {
            $item->update(['phase_id' => $request->phase]);
        }
        return response()->json(['message' => 'order success']);
    }
}
