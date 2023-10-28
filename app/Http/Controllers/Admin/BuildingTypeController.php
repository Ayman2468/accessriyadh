<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\BuildingType;
use App\Models\BuildingTypeQuestion;
use App\Models\Question;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Str;
use App\Traits\imageinsertiontrait;

class BuildingTypeController extends Controller
{
    use imageinsertiontrait;
    public function index()
    {

        $buildingTypes = BuildingType::query();
        if (\request()->filled('q')) {
            $buildingTypes = $buildingTypes->where(function ($where) {
                $where->orwhere('name_ar', 'like', '%' . \request()->q . '%');
                $where->orwhere('name_en', 'like', '%' . \request()->q . '%');
            });
        }
        $buildingTypes = $buildingTypes->paginate(20);
        return response()->json(['data' => $buildingTypes]);
    }

    public function questions($id)
    {
        $buildingTypeId = $id;
        $questions = Question::query();
        $questions = $questions->whereHas('BuildingTypeQuestion', function ($q) use ($buildingTypeId) {
            $q->where('building_type_id', $buildingTypeId);
        })
            ->join('building_type_questions', 'building_type_questions.question_id', '=', 'questions.id')
            ->where('building_type_questions.building_type_id', $buildingTypeId);

        if (\request()->filled('q')) {
            $questions = $questions->where(function ($where) {
                $where->where('web_id', \request()->q);
                $where->orwhere('question_name_ar', 'like', '%' . \request()->q . '%');
                $where->orwhere('question_name_en', 'like', '%' . \request()->q . '%');
                $where->orwhere('description_ar', 'like', '%' . \request()->q . '%');
                $where->orwhere('description_en', 'like', '%' . \request()->q . '%');
            });
        }
        if (\request()->filled('phase_id')) {
            $questions = $questions->where(function ($where) {
                $where->where('building_type_questions.phase_id', \request()->phase_id);
            });
        }
        $questions = $questions->orderBy('building_type_questions.phase_id')
//            ->orderByDesc('questions.id')
            ->orderBy('building_type_questions.order')
            ->get();
        return response()->json(['data' => $questions]);
    }

    public function store(Request $request, $id)
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
                // $storedFilePath = $file->move($directory, $filename);
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
        $insertedQuestion = Question::create(
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
                'title_id' => $request['title_id'] ?? null,
            ],
        );

        $questions = Question::orderBy('web_id')->get();

        $buildingType = BuildingType::find($id);
        foreach ($questions as $question) {
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
        $buildingTypeId = $id;
        $questions = Question::whereHas('BuildingTypeQuestion', function ($q) use ($buildingTypeId) {
            $q->where('building_type_id', $buildingTypeId);
        })
            ->join('building_type_questions', 'building_type_questions.question_id', '=', 'questions.id')
            ->where('building_type_questions.building_type_id', $buildingTypeId)
            ->orderBydesc('questions.id')->get();

        $question = Question::find($insertedQuestion->id);

        return response()->json(['data' => $question]);
    }

    public function update(Request $request, $id)
    {
        $buildingType = BuildingType::find($id);
        $buildingType->name_ar = $request->name_ar;
        $buildingType->name_en = $request->name_en;
        if ($request->image && $request->image != '' && $request->hasFile('image')) {
            //$storedFilePath = $request->image->store('building-types');
            $storedFilePath = $this->imageinsertion($request->image,'img/building-types');
            if(!str_contains($storedFilePath,'error') && file_exists(public_path($buildingType->image)) && !empty($buildingType->image)) unlink(public_path($buildingType->image));
            $buildingType->image = $storedFilePath;
        }
        $buildingType->save();
        return response()->json(['data' => $buildingType]);
    }
    public function destroy($buildingId){
        $building = BuildingType::find($buildingId);
        if(!empty($building)){
            if(file_exists($building->image) && !Str::endsWith($building->image,'/')) unlink($building->image);
            $building->delete();
            return response()->json(['message' => 'building deleted']);
        }
    }
    public function updateQuestion(Request $request, $id, $questionId)
    {
//        $this->ccc2();
//        dd(1);
        $answers = [];
        $answersAll = [];
        $oldQuestion = Question::find($questionId);
        foreach ($request->answers ?? [] as $key => $item) {
            if (isset($item['image']) && $item['image'] instanceof UploadedFile) {
                // $answer['image'] is a file.
                $file = $item['image'];

                // $directory = 'questions'; // Change this to your desired directory
                // $extension = $file->getClientOriginalExtension(); // Get the original file extension
                // $hashedName = Str::random(40); // You can adjust the length of the random string as needed
                // $filename = $hashedName . '.' . $extension;
                // $storedFilePath = $file->move($directory, $filename);
                $storedFilePath = $this->imageinsertion($file,'img/questions');
                if(!str_contains($storedFilePath,'error') && file_exists(public_path($oldQuestion->image) && !empty($oldQuestion->image))) unlink(public_path($oldQuestion->image));
                $answers['image'] = $storedFilePath;
            } else {
                if ($item['image'])
                    $answers['image'] = $oldQuestion->answers[$key]['image'];
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
        Question::find($questionId)->update(
            [
                'web_id' => $request['web_id'],
                'question_name_ar' => $request['question_name_ar'],
                'question_name_en' => $request['question_name_en'],
                'description_ar' => $request['description_ar'],
                'description_en' => $request['description_en'],
                'answers' => $answersAll,
                'type' => $request['type'],
                'score' => $request['score'] ?? null,
                'title_id' => $request['title_id'] ?? null,
            ],
        );

        $questions = Question::orderBy('web_id')->get();

        $buildingTypes = BuildingType::get();
        foreach ($buildingTypes as $buildingType) {
            $counter = 1;
            foreach ($questions as $question) {
                BuildingTypeQuestion::updateorcreate(
                    [
                        'building_type_id' => $buildingType->id,
                        'question_id' => $question->id,
                    ],
                    [
                        'building_type_id' => $buildingType->id,
                        'question_id' => $question->id,
                        'phase_id' => $question->phase_id,

                    ],
                );
                $counter++;
            }
        }
        $question = Question::find($questionId);
        return response()->json(['data' => $question]);
    }


    public function updateOrder(Request $request, $id)
    {
        foreach ($request->questions ?? [] as $item) {
            BuildingTypeQuestion::find($item['id'])->update(['order' => $item['order']]);
        }
        return response()->json(['message' => 'order success']);
    }

    public function updatePhase(Request $request, $id)
    {
        BuildingTypeQuestion::find($request->id)->update(['phase_id' => $request->phase]);
        return response()->json(['message' => 'phase success']);
    }

    public function updateTitle(Request $request, $id)
    {
        Question::find($request->id)->update(['title_id' => $request->title_id]);
        return response()->json(['message' => 'title_id success']);
    }

    //
//    public function ccc()
//    {
//        $questions = Question::get();
//        foreach ($questions as $question) {
//            $answers = [];
//            foreach ( json_decode($question->answers) ?? [] as $key => $item) {
//                $answers[] = ['en'=>$key,'ar'=>$key,'image'=>$item];
//            }
//            $question->answers = $answers;
//            $question->save();
//        }
//    }
//
//    public function ccc2()
//    {
//        $questions = Question::find(3);
//        $answers = [];
//        foreach ($questions->answers as $answer) {
//            $answers[] = ['en'=>$answer['image'],'ar'=>$answer['image'],'image'=>$answer['image']];
//        }
//        $questions->answers = $answers;
//        $questions->save();
//        dd($answers);
//    }

}
