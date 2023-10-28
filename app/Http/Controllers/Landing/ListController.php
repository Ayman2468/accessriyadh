<?php

namespace App\Http\Controllers\Landing;

use App\Http\Controllers\Controller;
use App\Models\Country;
use Illuminate\Http\Request;

class ListController extends Controller
{
    public function index()
    {
        $data = [];
        foreach (request()->lists as $list) {
            if ($list == 'countries') $data['countries'] = Country::get();
        }
        return response()->json(['data' =>$data]);
    }
}
