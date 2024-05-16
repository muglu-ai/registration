<?php

namespace App\Http\Controllers;

use App\Http\Requests\ExhibitorLogin;
use App\Models\exhibitor_reg_table;
use Illuminate\Http\Request;
use App\Models\Exhibitor;
use App\Models\Country;


class ExhibitorController extends Controller
{
    public function login(Request $request){
        $country = Country::all();
        return response()->json($country);
    }

    public function register(Request $request): \Illuminate\Http\JsonResponse
    {
        $exhibitor = new exhibitor_reg_table();
        $exhibitor->exhibitor_id = $request->exhibitor_id;
        $exhibitor->cp_name = $request->name;
        $exhibitor->cp_email = $request->email;
        $exhibitor->country = $request->country;
        $exhibitor->save();
        return response()->json($exhibitor);
    }


}
