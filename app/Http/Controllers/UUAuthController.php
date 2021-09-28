<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UUAuthController extends Controller
{
    //
    public function handleProviderCallback(Request $request){

        dd($request->all());
        
    }
}
