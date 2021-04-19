<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\banner;
use App\package;
use App\option_package;

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

    public function get_package(){
        $obj = package::all();

        if(isset($obj)){
            foreach($obj as $u){
                $option = option_package::where('p_id', $u->id)->get();
                $u->option = $option;
            }
        }

        return response()->json($obj);
    }

    public function post_blog(Request $request){
        return 200;
    }


    public function send_mail_to_contact(Request $request){

        $details = [
            'title' => 'คุณได้รับข้อความจาก : '.$request['name'],
            'email' => $request['email'],
            'phone' => $request['phone'],
            'subject' => $request['subject'],
            'body' => $request['detail']
        ];
       
        \Mail::to('kim.kundad@gmail.com')->send(new \App\Mail\ContactMail($details));
       
        return response()->json([
            'message' => 'ส่งอีเมล เรียบร้อยแล้ว',
            'status ' => 200
        ]);

    }
}
