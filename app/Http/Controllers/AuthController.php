<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\User;
use App\logsys;
use Validator;
use App\text_address;
use Illuminate\Support\Facades\Hash;
use Jenssegers\Agent\Agent;
use App\biller;
use App\biller_file;
use App\mydevice;



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
            if (! $token = auth('api')->attempt($validator->validated())) {
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

    public function add_my_biller_file(Request $request){

        if(isset(auth('api')->user()->id)){

        
     
          $gallary = $request->file('image');
          $id = $request['bill_id'];
          if (sizeof($gallary) > 0) {
            for ($i = 0; $i < sizeof($gallary); $i++) {
              $path = 'img/doc/';
              $filename = time().$i.'.'.$gallary[$i]->getClientOriginalExtension();
              $gallary[$i]->move($path, $filename);
              $admins[] = [
                  'file_name' => $filename,
                  'type' => 3,
                  'biller_id' => $id
              ];
            }
            biller_file::insert($admins);
          }

          return response()->json(['status'=>200, 'message' => 'Insert biller id success' ]);


        }
    }

    
    public function add_new_device(Request $request){

        if(isset(auth('api')->user()->id)){


            $objs = new mydevice();
            $objs->divice_name = $request['divice_name'];
            $objs->mac_address = $request['mac_address'];
            $objs->user_data_id = $request['user_id'];
            $objs->save();

            return response()->json(['status'=>200, 'message' => 'Insert new Device success' ]);

        }

    }


    public function add_new_address(Request $request){

        if(isset(auth('api')->user()->id)){

            $objs = new text_address();
            $objs->fname = $request['fname'];
            $objs->phone = $request['phone'];
            $objs->province = $request['provi'];
            $objs->address_no = $request['address_no'];
            $objs->address_name = $request['address_name'];
            $objs->soi = $request['soi'];
            $objs->road = $request['road'];
            $objs->county = $request['mydist'];
            $objs->district = $request['mySubDist'];
            $objs->postal_code = $request['postal_codes'];
            $objs->company = $request['user_id'];
            $objs->status = 3;
            $objs->save();

            return response()->json(['status'=>300, 'message' => 'Insert new Address success' ]);

        }

    }

     public function add_my_biller_id(Request $request){

       // dd($request->all());

        if(isset(auth('api')->user()->id)){

            $path = 'img/doc/';

            $image1 = $request->file('file_1'); // สำเนาหนังสือทะเบียนพาณิชย์อิเล็กทรอนิกส์
            if($image1 != null){
            $filename1 = time().'-'.(\random_int(1000, 9999)).'.'.$image1->getClientOriginalExtension();
            $image1->move($path, $filename1);
            }else{
                $filename1 = null;
            }

            $image2 = $request->file('file_2'); //สำเนาบัตรประชาชนผู้มีอำนาจลงนาม
            if($image2 != null){
            $filename2 = time().'-'.(\random_int(1000, 9999)).'.'.$image2->getClientOriginalExtension();
            $image2->move($path, $filename2);
            }else{
                $filename2 = null;
            }

            $image3 = $request->file('file_4'); //หน้าสมุดบัญชีธนาคารที่จะใช้ในการรับเงิน
            if($image3 != null){
            $filename3 = time().'-'.(\random_int(1000, 9999)).'.'.$image3->getClientOriginalExtension();
            $image3->move($path, $filename3);
            }else{
                $filename3 = null;
            }

            $image4 = $request->file('file_5'); //หนังสือมอบอำนาจ (กรณีผู้ที่มีอำนาจไม่ได้มาด้วยตนเอง)
            if($image4 != null){
            $filename4 = time().'-'.(\random_int(1000, 9999)).'.'.$image4->getClientOriginalExtension();
            $image4->move($path, $filename4);
            }else{
                $filename4 = null;
            }

            $image5 = $request->file('file_6'); // หนังสือรับรองบริษัท อายุไม่เกิน 3 เดือน
            if($image5 != null){
            $filename5 = time().'-'.(\random_int(1000, 9999)).'.'.$image5->getClientOriginalExtension();
            $image5->move($path, $filename5);
            }else{
                $filename5 = null;
            }

            $image6 = $request->file('file_7'); //ทะเบียนภาษีมูลค่าเพิ%ม (ภพ.20)
            if($image6 != null){
            $filename6 = time().'-'.(\random_int(1000, 9999)).'.'.$image6->getClientOriginalExtension();
            $image6->move($path, $filename6);
            }else{
                $filename6 = null;
            }


            $randomSixDigitInt = (\random_int(1000, 9999)).''.(\random_int(1000, 9999)).''.(\random_int(10, 99));

            $objs = new biller();
            $objs->file_1 = $filename1;
            $objs->file_2 = $filename2;
            $objs->file_3 = $filename3;
            $objs->file_4 = $filename4;
            $objs->file_5 = $filename5;
            $objs->file_6 = $filename6;
            $objs->biller_id = $randomSixDigitInt;
            $objs->address_id = $request['id_address'];
            $objs->url_domain_name = $request['user_domain_name'];
            $objs->company_name = $request['company_name'];
            $objs->company_type = $request['type_company'];
            $objs->business_type = $request['type_bu'];
            $objs->id_card = $request['id_card'];
            $objs->bank_id = $request['checkBank'];
            $objs->user_id = $request['user_id'];
            $objs->bill_type = $request['t_com'];
            $objs->admin_id = 1;
            $objs->status = 1;
            $objs->save();

            return response()->json(['status'=>200, 'message' => 'Insert biller id success', 'bill_id'=> $objs->id ]);

        }

     }

     public function update_profile(Request $request){

        if(isset(auth('api')->user()->id)){
            
            if($request->hbd != null){
                $pieces = explode("-", $request->hbd);
                $age = date("Y") - $pieces[0];
            }else{
                $age = 0;
            }
        

        //    $input = $request->all();
                $id = auth('api')->user()->id;

                $package = User::find($id);
                $package->age = $age;
                $package->first_name = $request->first_name;
                $package->hbd = $request->hbd;
                $package->last_name = $request->last_name;
                $package->phone = $request->phone;
                $package->sex = $request->sex;
                $package->career = $request->career;
                $package->save();


           // DB::table('users')->where('id', auth('api')->user()->id)->update($input);
            return response()->json(['status'=>200, 'message' => 'Update profile success', 'data' => $package ]);
        }

     }


     public function update_profile_avatar(Request $request){

        if(isset(auth('api')->user()->id)){
            dd($request->all());
        }

     }



     public function reset_password(Request $request){

        if(isset(auth('api')->user()->id)){

            if (Hash::check($request->old_password, auth('api')->user()->password)) { 

                $id = auth('api')->user()->id;

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
                $randomSixDigitInt = 'RBT-'.(\random_int(10000, 99999)).'-'.(\random_int(10000, 99999)).'-'.(\random_int(10000, 99999));

                $user = User::create([
                    'name' => $request->name,
                    'email' => $request->email,
                    'first_name' => $request->first_name,
                    'last_name' => $request->last_name,
                    'phone' => $request->phone,
                    'password' => bcrypt($request->password),
                    'provider' => 'email',
                    'avatar' => $ran[array_rand($ran, 1)],
                    'code_user' => $randomSixDigitInt,
                ]);

                $objs = DB::table('role_user')
                    ->where('user_id', $user->id)
                    ->first();

                if($objs != null){

                }else{

                DB::table('role_user')->insert(
                    ['role_id' => 3, 'user_id' => $user->id]
                );

                }
                $agent = new Agent();
                $obj = new logsys();
            $obj->user_id = $user->id;
            $obj->detail = 'ได้ทำการสมัครสมาชิกเข้าระบบเพื่อใช้งานผ่าน :'.$agent->device().' Operating system name : '.$agent->platform();
            $obj->ip_address = \Request::ip();
            $obj->browser = $agent->browser();
            $obj->status = 3;
            $obj->save();

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
        auth('api')->logout();

        return response()->json(['message' => 'User successfully signed out']);
    }

    /**
     * Refresh a token.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function refresh() {
        return $this->createNewToken(auth('api')->refresh());
    }

    /**
     * Get the authenticated User.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function userProfile() {
        return response()->json([
            'status'=>200,
            'data' => auth('api')->user()
        ]
        );
    }


    public function get_device(){

        if(isset(auth('api')->user()->id)){

            $bill = DB::table('mydevices')
                ->where('user_data_id', auth('api')->user()->code_user)
                ->orderby('id', 'desc')
                ->paginate(15);

                if(isset($bill)){
                    foreach($bill as $u){
                        $u->date_create = formatDateThat($u->created_at);
                    }
                }

                return response()->json([
                    'status'=>200,
                    'data' => $bill
                ]
                );

        }
    }

   


    public function get_my_biller_id(){

        if(isset(auth('api')->user()->id)){

            $bill = DB::table('billers')->select(
                'billers.*',
                'billers.created_at as create',
                'billers.id as idb',
                'billers.phone as phone1',
                'billers.status as status_bill',
                'banks.*'
                )
                ->leftjoin('banks', 'banks.id',  'billers.bank_id')
                ->where('billers.user_id', auth('api')->user()->code_user)
                ->orderby('billers.created_at', 'desc')
                ->paginate(15);

                return response()->json([
                    'status'=>200,
                    'data' => $bill
                ]
                );
                

        }

    }

    public function add_new_biller(Request $request){

       
        if(isset(auth('api')->user()->id)){

        $objs = new biller();
        $objs->biller_id = $request['biller_id'];
        $objs->merchant_id = $request['merchant_id'];
        $objs->terminal_id = $request['terminal_id'];
        $objs->bank_no = $request['bank_no'];
        $objs->bank_name = $request['bank_name'];
        $objs->user_id = $request['user_id'];
        $objs->bank_id = $request['checkBank'];
        $objs->status = 1;
        $objs->save();

        return response()->json([
            'status'=>200,
            'data' => 'เพิ่มข้อมูล Biller ID สำเร็จ รอเจ้าหน้าที่ติดต่อกลับ'
        ]
        );

        }  

    }


    public function change_status_device_by_id(Request $request){

        if(isset(auth('api')->user()->id)){

            $id = $request['user_id'];
       
            $user = mydevice::findOrFail($id);

                if($user->status == 1){
                    $user->status = 0;
                } else {
                    $user->status = 1;
                }
                $user->save();

                return response()->json([
                    'status'=>200,
                    'data' => $user
                ]
                );
        }

    }


    public function change_status_biller_by_id(Request $request){

        

        if(isset(auth('api')->user()->id)){

            $id = $request['user_id'];
       
            $user = biller::findOrFail($id);

                if($user->status == 1){
                    $user->status = 0;
                } else {
                    $user->status = 1;
                }
                $user->save();

                return response()->json([
                    'status'=>200,
                    'data' => $user
                ]
                );
        }


    }

    public function get_device_by_id($id){

        if(isset(auth('api')->user()->id)){

            $bill = DB::table('mydevices')
                ->where('id', $id)
                ->first();

                $bill->date_create = formatDateThat($bill->created_at);

                return response()->json([
                    'status'=>200,
                    'data' => $bill
                ]
                );

        }

    }

    public function get_biller_by_id($id){

        if(isset(auth('api')->user()->id)){

            $bill = DB::table('billers')->select(
                'billers.*',
                'billers.created_at as create',
                'billers.id as idb',
                'billers.phone as phone1',
                'billers.status as status_bill',
                'banks.*'
                )
                ->leftjoin('banks', 'banks.id',  'billers.bank_id')
                ->where('billers.id', $id)
                ->first();

                return response()->json([
                    'status'=>200,
                    'data' => $bill
                ]
                );
                

        }


    }

    public function get_tex_address(){

        $cat = DB::table('text_addresses')->where('company', auth('api')->user()->code_user)->get();
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
        $agent = new Agent();

            $obj = new logsys();
            $obj->user_id = auth('api')->user()->id;
            $obj->detail = 'ได้ทำการเข้าสุ่ระบบเพื่อใช้งานผ่าน :'.$agent->device().' Operating system name : '.$agent->platform();
            $obj->ip_address = \Request::ip();
            $obj->browser = $agent->browser();
            $obj->status = 1;
            $obj->save();

        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'status' => 200,
            'expires_in' => auth('api')->factory()->getTTL() * 60,
            'user' => auth('api')->user()
        ]);
    }

}