<?php

namespace Database\Seeders;

use App\Models\BuildingType;
use App\Models\BuildingTypeQuestion;
use App\Models\Question;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BuildingTypeQuestionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
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
                        'order' => $question->order,

                    ],
                );
                $counter++;
            }
        }
    }
}
