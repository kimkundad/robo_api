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
use App\thiday;
use App\bank;
use App\qr_code_type;
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


    public function get_tex_address_by_id($id){


        $get_address = DB::table('text_addresses')->where('id', $id)->first();

        $province = DB::table('provinces')
                   ->where('id', $get_address->province)
                   ->first();
                   if(isset($province->name)){
                    $get_address->p_name = $province->name;
                    $get_address->p_id = $province->id;
                   }else{
                    $get_address->p_name = null;
                   }

               $district = DB::table('districts')
                    ->where('id', $get_address->county)
                    ->first();

                if(isset($district->name)){
                    $get_address->d_name = $district->name;
                    $get_address->d_id = $district->id;
                   }else{
                    $get_address->d_name = null;
                   }

                $subdistricts = DB::table('sub_districts')
                     ->where('id', $get_address->district)
                     ->first();

                     if(isset($subdistricts->name)){
                        $get_address->sub_name = $subdistricts->name;
                        $get_address->sub_id = $subdistricts->id;
                       }else{
                        $get_address->sub_name = null;
                       }

        return response()->json([
            'status'=>200,
            'data' => $get_address
        ]
        );
    
    
}

    public function get_qr_type(){

        $cat = qr_code_type::where('status', 1)->Orderby('id', 'desc')->paginate(15);
        return response()->json($cat);
        
    }

    public function get_thai_day(){

        $cat = thiday::where('status', 1)->Orderby('id', 'desc')->first();
        if(isset($cat)){
            $cat->desktop_img = 'https://api.robotel.co.th/assets/img/thaiday/'.$cat->desktop_img;
            $cat->mobile_img = 'https://api.robotel.co.th/assets/img/thaiday/'.$cat->mobile_img;
        }
        
        return response()->json($cat);
        
    }


    public function get_province(){

        $provinces = DB::table('provinces')->get();
        return response()->json($provinces);

    }
    public function get_dist($id){
        $districts = DB::table('districts')->where('province_id', $id)->get();
        return response()->json($districts);
    }

    public function get_postal_codes($id = 0, $provi = 0, $mydist = 0){
        
        $postal = DB::table('postal_codes')->where('sub_district_id', $id)->where('district_id', $mydist)->where('province_id', $provi)->first();
        return response()->json($postal->code);
    }


    public function get_subdist($id){
        $subdist = DB::table('sub_districts')->where('district_id', $id)->get();
        return response()->json($subdist);
    }

    public function get_img_bank($id){
        $bank = DB::table('banks')->where('id', $id)->first();
        return response()->json($bank);
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


    public function get_file_version(){

        $bill = DB::table('fileversions')
                ->orderby('id', 'desc')
                ->get();

        return response()->json(['status'=> 200, 'data' => $bill]);
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
            $token = $request->token;

            $response = Http::withToken($token)->withHeaders([
                'Content-Type' => 'application/json',
            ])->post('https://siamtheatre.com/api/v1/user_control/avatar', [
                 // your data array
                 'File' => $image,
            ]);

         /*   $input['imagename'] = time().'.'.$image->getClientOriginalExtension();
            $img = Image::make($image->getRealPath());
            $img->resize(500, 500, function ($constraint) {
            $constraint->aspectRatio();
            })->save('assets/img/avatar/'.$input['imagename']);
            $id = $request['uid'];

            $package = User::find($id);
            $package->avatar = $input['imagename'];
            $package->provider = 'email';
            $package->save(); */

            return response()->json([
                'image' => $response,
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

    public function get_first_menu(){

        $obj = cat_file::where('status', 1)->orderby('id', 'asc')->first();
        return response()->json($obj);

    }

    public function get_file_id($id){

        $file = get_file::where('status', 1)->where('cat_id', $id)->get();
        return response()->json($file);

    }

    public function get_document_page($id){

        $objs = DB::table('get_files')
            ->where('id', $id)
            ->first();

        $file= public_path(). "/img/doc_download/".$objs->store_file;

        return response::download($file);
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
