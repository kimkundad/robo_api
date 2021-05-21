<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\banner;
use App\package;
use App\User;
use App\option_package;
use Validator;
use Password;
use Response;
use App\logsys;
use App\cat_file;
use App\get_file;
use App\bank;
use Intervention\Image\ImageManagerStatic as Image;
use Jenssegers\Agent\Agent;

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


    public function get_document(){

        $file= public_path(). "/assets/api_document/promptRUB_API_Document.pdf";
        $headers = [
            'Content-Type' => 'application/pdf',
         ];

        return response::download($file, 'promptRUB_API_Document.pdf', $headers);
    }

    public function myreset(Request $request){

        $check_email = DB::table('users')
                ->where('email', $request->email)
                ->count();

        if($check_email == 0){

            return response()->json(['status'=> 100, 'msg' => 'อีเมลนี้ไม่ได้อยู่ในระบบ กรุณาตรวจสอบอีเมลอีกครั้ง']);

        }else{

        $credentials = request()->validate([
            'email' => 'required|email',
            'token' => 'required|string',
            'password' => 'required'
        ]);

        $reset_password_status = Password::reset($credentials, function ($user, $password) {
            $user->password = bcrypt($password);
            $user->save();
        });

        if ($reset_password_status == Password::INVALID_TOKEN) {
            return response()->json(['status'=> 100, 'msg' => 'ระบุโทเค็นไม่ถูกต้อง!']);
        }

        return response()->json(['status'=> 200, 'msg' => 'การรีเซ็ตรหัสผ่านสำเร็จ!']);

    }


    }

    public function check_logout(Request $request){

        $agent = new Agent();

            $obj = new logsys();
            $obj->user_id = $request->id;
            $obj->detail = 'ผู้ใช้งานได้ทำการออกจากระบบ :'.$agent->device().' Operating system name : '.$agent->platform();
            $obj->ip_address = \Request::ip();
            $obj->browser = $agent->browser();
            $obj->status = 2;
            $obj->save();

    }


    public function check_username(Request $request){

        $validator = Validator::make($request->all(), [
            'name' => 'required'
        ]);

        $check_name = DB::table('users')
                ->where('name', $request->name)
                ->count();

        if($check_name == 0){
            return response()->json(['status'=> 200, 'msg' => 'คุณสามารถใช้ ชื่อบัญชีผู้ใช้งานนี้']);
        }else{
            return response()->json(['status'=> 100, 'msg' => 'ชื่อบัญชีผู้ใช้งานนี้ ได้ถูกใช้ไปแล้ว']);
        }


    }

    public function forgot(Request $request){

        $check_email = DB::table('users')
                ->where('email', $request->email)
                ->count();

        if($check_email == 0){

            return response()->json(['status'=> 100, 'msg' => 'อีเมลนี้ไม่ได้อยู่ในระบบ กรุณาตรวจสอบอีเมลอีกครั้ง']);

        }else{

            $credentials = request()->validate(['email' => 'required|email']);
            Password::sendResetLink($credentials);

            return response()->json(['status'=> 200, 'msg' => 'เราได้ส่งลิงก์รีเซ็ตรหัสผ่านของคุณทางอีเมลแล้ว!']);

        }

        

      /*  Password::sendResetLink($credentials);

        return response()->json(["msg" => 'Reset password link sent on your email id.']); */
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
            $package->provider = 'email';
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

    public function get_cat_menu(){

        $obj = cat_file::where('status', 1)->orderby('id', 'asc')->get();
        return response()->json($obj);

    }


    public function get_file_index(){

        $obj = cat_file::where('status', 1)->orderby('id', 'asc')->first();
        $file = get_file::where('status', 1)->where('cat_id', $obj->id)->get();
       

        return response()->json($file);
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

    public function get_banks(){

        $obj = bank::where('bank_status', 1)->get();
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
