<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\banner;
use App\package;
use App\User;
use App\option_package;
use Validator;
use Intervention\Image\ImageManagerStatic as Image;

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
        $str = 'kim@gmail.com';
        $check = preg_match("/^([a-z0-9\+_\-]+)(\.[a-z0-9\+_\-]+)*@([a-z0-9\-]+\.)+[a-z]{2,6}$/ix", $str);
        dd($check);
        return view('home');
    }

    public function update_profile_avatar(Request $request){


            $image = $request->file('image');
            $input['imagename'] = time().'.'.$image->getClientOriginalExtension();
            $img = Image::make($image->getRealPath());
            $img->resize(500, 500, function ($constraint) {
            $constraint->aspectRatio();
            })->save('assets/img/avatar/'.$input['imagename']);
            $id = $request['uid'];

            $package = User::find($id);
            $package->avatar = $input['imagename'];
            $package->save();

            return response()->json([
                'image' => $input['imagename'],
                'status ' => 200
            ]);
        
    

     }

    public function call_user(){
        $user = User::all();
        dd($user);
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

    public function check_name_user(Request $request){

        $count = User::where('name', $request['name'])->count();
        if($count == 0){

            $validator = Validator::make($request->all(), [
                'password' => 'required|string|min:8',
            ]);
    
            if ($validator->fails()) {
                return response()->json(['status'=> 100, 'password' => 'The password must be at least 8 characters.']);
            }else{

                return response()->json([
                    'message' => 'คุณสามารถใช้งานชื่อผู้ใช้งานนี้ได้',
                    'status ' => 200
                ]);

            }

        }else{
            return response()->json([
                'message' => 'ชื่อผู้ใช้นี้ถูกใช้งานไปแล้ว',
                'status ' => 100
            ]);
        }

    }


    public function send_mail_to_contact(Request $request){

        $details = [
            'title' => 'คุณได้รับข้อความจาก : '.$request['name'],
            'email' => $request['email'],
            'phone' => $request['phone'],
            'subject' => $request['subject'],
            'body' => $request['detail']
        ];
       
        \Mail::to('admin@robotel.co.th')->send(new \App\Mail\ContactMail($details));
       
        return response()->json([
            'message' => 'ส่งอีเมล เรียบร้อยแล้ว',
            'status ' => 200
        ]);

    }
}
