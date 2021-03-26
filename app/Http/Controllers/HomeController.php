<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\banner;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
      //  $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }

    public function get_banner_index()
    {
        $obj = banner::all();
        return response()->json($obj);
    }

    public function post_blog(Request $request){
        return 200;
    }
}
