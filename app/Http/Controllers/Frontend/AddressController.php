<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\City;
use App\Models\Province;
use Illuminate\Http\Request;

class AddressController extends Controller
{

    public function apiProvinces()
    {
        $provinces = Province::all();
        $response = [
            'provinces' => $provinces
        ];
        return response()->json($response, 200);
    }

    public function apiCities($id)
    {
        $cities = City::where('province_id', $id)->get();
        $response = [
            'cities' => $cities
        ];
        return response()->json($response, 200);
    }
}
