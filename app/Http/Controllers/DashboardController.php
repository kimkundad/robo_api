<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Intervention\Image\ImageManagerStatic as Image;

class DashboardController extends Controller
{
    //
    public function index(){

        $user = DB::table('users')
                ->count();
                $data['user'] = $user-2;


        return view('admin.dashboard.index', $data);
    }
}
