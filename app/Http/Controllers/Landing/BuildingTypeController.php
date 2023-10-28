<?php

namespace App\Http\Controllers\Landing;

use App\Http\Controllers\Controller;
use App\Models\BuildingType;
use Illuminate\Http\Request;

class BuildingTypeController extends Controller
{
    public function index()
    {
        $buildingTypes = BuildingType::get();
        return response()->json(['data' => $buildingTypes]);
    }
}
