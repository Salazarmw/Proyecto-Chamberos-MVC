<?php

namespace App\Http\Controllers;

use App\Models\Canton;
use Illuminate\Http\Request;

class LocationController extends Controller
{
    /**
     * Obtener los cantones por provincia.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function getCantons(Request $request)
    {
       //Acá va el update de los dropdowns para los cantones :c
        //$cantons = Canton::where('province_id', $provinceId)->get();
        //return response()->json($cantons);
    }
}
