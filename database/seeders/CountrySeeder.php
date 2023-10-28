<?php

namespace Database\Seeders;

use App\Models\Country;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

class CountrySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('countries')->truncate();
        $json=File::get('database/datasets/countries.json');
        $data=json_decode($json);
        foreach ($data as $obj){
            Country::create(array(
                'id'=>$obj->iso_numeric,
                'iso_alpha_2'=>$obj->iso_alpha_2,
                'name_en'=>$obj->name_en,
                'name_ar'=>$obj->name_ar,
                'name_native'=>$obj->name_native,
                'calling_codes'=>$obj->calling_codes,
                'currencies'=>$obj->currencies,
                'languages'=>$obj->languages
            ));
        }
    }
}
