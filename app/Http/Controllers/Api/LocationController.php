<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use HoangPhi\VietnamMap\Models\Province;
use HoangPhi\VietnamMap\Models\District;
use HoangPhi\VietnamMap\Models\Ward;

class LocationController extends Controller
{
    public function getProvinces(){
        $provinces = Province::all();
        return response()->json($provinces);
    }
    public function getDistricts(Request $request, Province $province){
        $district = $province->districts;
        return response()->json($district);
    }
    public function getWards(Request $request, District $district){
        $wards = $district->wards;
        return response()->json($wards);
    }
}
