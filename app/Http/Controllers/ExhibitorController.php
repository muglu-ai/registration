<?php

namespace App\Http\Controllers;

use App\Http\Requests\ExhibitorLogin;
use Illuminate\Http\Request;
use App\Models\Exhibitor;


class ExhibitorController extends Controller
{
    //
    public function login(ExhibitorLogin $request){
        //log $request

        $credentials = $request->only('email', 'password');
        return response()->json($credentials);

//        if (!auth()->attempt($credentials)) {
//            return response()->json([
//                'message' => 'Invalid credentials'
//            ], 401);
//        }
    }


}
