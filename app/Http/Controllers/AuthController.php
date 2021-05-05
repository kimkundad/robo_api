<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\User;
use Validator;
use App\text_address;
use Illuminate\Support\Facades\Hash;


class AuthController extends Controller
{
    /**
     * Create a new AuthController instance.
     *
     * @return void
     */
    public function __construct() {
        $this->middleware('auth:api', ['except' => ['login', 'register']]);
    }

    /**
     * Get a JWT via given credentials.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function login(Request $request){
        
    	$validator = Validator::make($request->all(), [
            'name' => 'required',
            'password' => 'required|string|min:6',
        ]);

        $check_email = DB::table('users')
                ->where('name', $request->name)
                ->count();

        if($check_email == 0){

            return response()->json(['status'=> 100, 'email' => 'บัญชีผู้ใช้งานไม่ได้อยู่ในระบบ กรุณาตรวจสอบอีกครั้ง', 'password' => '']);

        }else{

            if ($validator->fails()) {
                return response()->json(['status'=> 100, 'email' => '', 'password' => 'รหัสผ่านไม่ถูกต้อง']);
            }
            if (! $token = auth()->attempt($validator->validated())) {
                return response()->json(['status'=> 100, 'email' => '', 'password' => 'บัญชีผู้ใช้งาน หรือ รหัสผ่าน ของคุณไม่ถูกต้อง ']);
                //return response()->json(['error' => 'Unauthorized'], 401);
            }
    
            return $this->createNewToken($token);

        }

        
        
    }

    

    /**
     * Register a User.
     *
     * @return \Illuminate\Http\JsonResponse
     */

     public function update_profile(Request $request){

        

        if(isset(auth()->user()->id)){
            
            

            if($request->hbd != null){
                $pieces = explode("-", $request->hbd);
                $age = date("Y") - $pieces[0];
            }else{
                $age = 0;
            }

        

        //    $input = $request->all();
                $id = auth()->user()->id;

                $package = User::find($id);
                $package->age = $age;
                $package->first_name = $request->first_name;
                $package->hbd = $request->hbd;
                $package->last_name = $request->last_name;
                $package->phone = $request->phone;
                $package->sex = $request->sex;
                $package->career = $request->career;
                $package->save();


           // DB::table('users')->where('id', auth()->user()->id)->update($input);
            return response()->json(['status'=>200, 'message' => 'Update profile success', 'age' => $package->age]);
        }

     }


     public function update_profile_avatar(Request $request){

        if(isset(auth()->user()->id)){
            dd($request->all());
        }

     }



     public function reset_password(Request $request){

        if(isset(auth()->user()->id)){

            if (Hash::check($request->old_password, auth()->user()->password)) { 

                $id = auth()->user()->id;

                $package = User::find($id);
                $package->password = bcrypt($request->password);
                $package->save();

                return response()->json([
                    'status'=> 200,
                    'msg' => 'old password ถูกต้องนะ'
                ]);

            }else{

                return response()->json([
                    'status'=> 100,
                    'msg' => 'รหัสผ่านปัจจุบัน ไม่ถูกต้องนะ'
                ]);

            }

            

        }


     }



    public function register(Request $request) {
       // dd($request->all());

       $validator = Validator::make($request->all(), [
            'phone' => 'required|regex:/[0-9]{10}/'
        ]);

        if ($validator->fails()) {

            return response()->json([
                'status'=> 100,
                'msg' => 'เบอร์โทรของท่านไม่ถูกต้อง'
            ]);

        }

        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required',
            'password' => 'required',
        ]);

        $check_email = User::where('email', $request['email'])->count();
        if($check_email > 0){
            return response()->json([
                'status'=> 100,
                'msg' => 'อีเมลนี้มีการลงทะเบียนแล้ว'
            ]);
        }

        $check_phone = User::where('phone', $request['phone'])->count();
        if($check_phone > 0){
            return response()->json([
                'status'=> 100,
                'msg' => 'เบอร์โทรนี้มีการลงทะเบียนแล้ว'
            ]);
        }


        $check_valid = preg_match("/^([a-z0-9\+_\-]+)(\.[a-z0-9\+_\-]+)*@([a-z0-9\-]+\.)+[a-z]{2,6}$/ix", $request['email']);

        if($check_valid == 0){
            return response()->json([
                'status'=> 100,
                'msg' => 'รูปแบบอีเมล ของท่านไม่ถูกต้อง'
            ]);
        }

        if($check_phone == 0 && $check_email == 0){

           

                $ran = array("1483537975.png","1483556517.png","1483556686.png");
                $user = User::create([
                    'name' => $request->name,
                    'email' => $request->email,
                    'first_name' => $request->first_name,
                    'last_name' => $request->last_name,
                    'phone' => $request->phone,
                    'password' => bcrypt($request->password),
                    'provider' => 'email',
                    'avatar' => $ran[array_rand($ran, 1)]
                ]);

                return response()->json([
                    'msg' => 'User successfully registered',
                    'status' => 200,
                    'user' => $user
                ]);

            

            /*

             */

        }

        
    }


    /**
     * Log the user out (Invalidate the token).
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function logout() {
        auth()->logout();

        return response()->json(['message' => 'User successfully signed out']);
    }

    /**
     * Refresh a token.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function refresh() {
        return $this->createNewToken(auth()->refresh());
    }

    /**
     * Get the authenticated User.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function userProfile() {
        return response()->json([
            'status'=>200,
            'data' => auth()->user()
        ]
        );
    }

    public function get_tex_address(){

        $cat = DB::table('text_addresses')->where('user_id', auth()->user()->id)->get();

        return response()->json(['status'=>200, 'message' => 'get tex address success', 'data' => $cat]);
    }

    /**
     * Get the token array structure.
     *
     * @param  string $token
     *
     * @return \Illuminate\Http\JsonResponse
     */
    protected function createNewToken($token){
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'status' => 200,
            'expires_in' => auth()->factory()->getTTL() * 60,
            'user' => auth()->user()
        ]);
    }

}