<?php

namespace App\Http\Controllers;

use App\Models\Canton;
use Illuminate\Http\Request;

class LocationController extends Controller
{
    public function getCantones($provinceId)
    {
        $cantons = Canton::where('province_id', $provinceId)->get();
        return response()->json($cantons);
    }
}
