<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Intervention\Image\ImageManagerStatic as Image;
use App\User;
use App\api_request;


class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
      //  dd(User::all());
        $objs = DB::table('users')
                ->Orderby('id', 'desc')
                ->paginate(15);

        $data['currentPage'] = $objs->currentPage();
        $data['perPage'] = $objs->perPage();
        $data['total'] = $objs->total();

        $data['objs'] = $objs;
        return view('admin.user.index', $data);
    }


    public function api_request_search(Request $request){

        $this->validate($request, [
            'search' => 'required'
        ]);
        $search = $request->get('search');

        $bill = DB::table('api_requests')->select(
            'api_requests.*',
            'api_requests.created_at as create',
            'api_requests.id as idb',
            'api_requests.status as status_v2',
            'users.*',
            'users.phone as phone1',
            'users.id as idu',
            )
            ->leftjoin('users', 'users.code_user',  'api_requests.user_id')
            ->where('users.name', 'like', "%$search%")
            ->orwhere('users.phone', 'like', "%$search%")
            ->orwhere('users.email', 'like', "%$search%")
            ->orwhere('users.first_name', 'like', "%$search%")
            ->orwhere('users.last_name', 'like', "%$search%")
            ->orwhere('api_requests.api_name', 'like', "%$search%")
            ->Orderby('api_requests.id', 'desc')
            ->paginate(15);


        $data['currentPage'] = $bill->currentPage();
        $data['perPage'] = $bill->perPage();
        $data['total'] = $bill->total();
        $data['search'] = $search;

        $data['objs'] = $bill;  
        return view('admin.user.api_request_search', $data);

    }

    public function biller_search(Request $request){

        $this->validate($request, [
            'search' => 'required'
        ]);
        $search = $request->get('search');

        $bill = DB::table('billers')->select(
            'billers.*',
            'billers.created_at as create',
            'billers.id as idb',
            'users.*',
            'users.phone as phone1',
            'banks.*',
            'users.id as idu',
            )
            ->leftjoin('users', 'users.code_user',  'billers.user_id')
            ->leftjoin('banks', 'banks.id',  'billers.bank_id')
            ->where('users.name', 'like', "%$search%")
            ->orwhere('users.phone', 'like', "%$search%")
            ->orwhere('users.email', 'like', "%$search%")
            ->orwhere('users.first_name', 'like', "%$search%")
            ->orwhere('users.last_name', 'like', "%$search%")
            ->orwhere('billers.biller_id', 'like', "%$search%")
            ->Orderby('billers.id', 'desc')
            ->paginate(15);


            $data['currentPage'] = $bill->currentPage();
        $data['perPage'] = $bill->perPage();
        $data['total'] = $bill->total();
        $data['search'] = $search;
            //dd($bill);

        $data['objs'] = $bill;  
        return view('admin.user.biller_search', $data);

    }


    public function user_search(Request $request){

        $this->validate($request, [
            'search' => 'required'
        ]);
        $search = $request->get('search');

        $objs = DB::table('users')
            ->where('name', 'like', "%$search%")
            ->orwhere('phone', 'like', "%$search%")
            ->orwhere('email', 'like', "%$search%")
            ->orwhere('first_name', 'like', "%$search%")
            ->orwhere('last_name', 'like', "%$search%")
            ->paginate(15);

        $data['currentPage'] = $objs->currentPage();
        $data['perPage'] = $objs->perPage();
        $data['total'] = $objs->total();
        $data['search'] = $search;

        $data['objs'] = $objs;
        return view('admin.user.search', $data);

    }

    public function biller_id_user(){


        $bill = DB::table('billers')->select(
            'billers.*',
            'billers.created_at as create',
            'billers.id as idb',
            'users.*',
            'users.phone as phone1',
            'banks.*',
            'users.id as idu',
            )
            ->leftjoin('users', 'users.code_user',  'billers.user_id')
            ->leftjoin('banks', 'banks.id',  'billers.bank_id')
            ->Orderby('billers.id', 'desc')
            ->paginate(15);


            $data['currentPage'] = $bill->currentPage();
        $data['perPage'] = $bill->perPage();
        $data['total'] = $bill->total();

          //  dd($bill);

        $data['objs'] = $bill;  
        return view('admin.user.biller_id_user', $data);

    }

    public function api_request_user(){


        $bill = DB::table('api_requests')->select(
            'api_requests.*',
            'api_requests.created_at as create',
            'api_requests.id as idb',
            'api_requests.status as status_v2',
            'users.*',
            'users.phone as phone1'
            )
            ->leftjoin('users', 'users.code_user',  'api_requests.user_id')
            ->Orderby('api_requests.id', 'desc')
            ->paginate(15);

            if(isset($bill)){
                foreach($bill as $u){

                    $u->one_my_type = unserialize($u->api_type);


                }
            }

          //  dd($bill);


            $data['currentPage'] = $bill->currentPage();
        $data['perPage'] = $bill->perPage();
        $data['total'] = $bill->total();

           // dd($bill);

        $data['objs'] = $bill;  
        return view('admin.user.api_request_user', $data);

    }

    public function del_api_request_user($id){

        DB::table('api_requests')->where('id', $id)->delete();

            return redirect(url('admin/api_request_user/'))->with('del_success','คุณทำการเพิ่มอสังหา สำเร็จ');

    }


    public function post_edit_api_request_user(Request $request, $id){

            $objs = api_request::find($id);
            $objs->api_name = $request['api_name'];
            $objs->api_callback = $request['api_callback'];
            $objs->api_key = $request['api_key'];
            $objs->secret_key = $request['secret_key'];
            $objs->status = $request['status'];
            $objs->save();

            return redirect(url('admin/api_request_user/'))->with('edit_success','คุณทำการเพิ่มอสังหา สำเร็จ');
    }


    public function edit_api_request_user($id){

        $bill = DB::table('api_requests')->select(
            'api_requests.*',
            'api_requests.created_at as create',
            'api_requests.id as idb',
            'api_requests.status as status_v2',
            'users.*',
            'users.phone as phone1'
            )
            ->leftjoin('users', 'users.code_user',  'api_requests.user_id')
            ->where('api_requests.id', $id)
            ->first(15);

            $get_address = DB::table('text_addresses')
                ->where('id', $bill->address_id)
                ->first();


                if(($get_address) != null){


                  $province = DB::table('provinces')
                       ->where('id', $get_address->province)
                       ->first();
                       if(isset($province->name)){
                        $get_address->p_name = $province->name;
                       }else{
                        $get_address->p_name = null;
                       }

                   $district = DB::table('districts')
                        ->where('id', $get_address->county)
                        ->first();

                    if(isset($district->name)){
                        $get_address->d_name = $district->name;
                       }else{
                        $get_address->d_name = null;
                       }

                    $subdistricts = DB::table('sub_districts')
                         ->where('id', $get_address->district)
                         ->first();

                         if(isset($subdistricts->name)){
                            $get_address->sub_name = $subdistricts->name;
                           }else{
                            $get_address->sub_name = null;
                           }
                }

          //  dd($get_address);
          $data['get_address'] = $get_address;         
        $data['objs'] = $bill;  
        return view('admin.user.edit_api_request_user', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //name_bank






        $objs = User::find($id);

        $add = DB::table('text_addresses')->where('company', $objs->code_user)->paginate(15);

        if(isset($add)){
            foreach($add as $get_address){

          $province = DB::table('provinces')
               ->where('id', $get_address->province)
               ->first();
               if(isset($province->name)){
                $get_address->p_name = $province->name;
               }else{
                $get_address->p_name = null;
               }

           $district = DB::table('districts')
                ->where('id', $get_address->county)
                ->first();

            if(isset($district->name)){
                $get_address->d_name = $district->name;
               }else{
                $get_address->d_name = null;
               }

            $subdistricts = DB::table('sub_districts')
                 ->where('id', $get_address->district)
                 ->first();

                 if(isset($subdistricts->name)){
                    $get_address->sub_name = $subdistricts->name;
                   }else{
                    $get_address->sub_name = null;
                   }

         }
        }

        
        
        $data['add'] = $add;   

        $bill = DB::table('billers')->select(
            'billers.*',
            'billers.created_at as create',
            'billers.id as idb',
            'users.*',
            'users.phone as phone1',
            'banks.*',
            'users.id as idu',
            )
            ->leftjoin('users', 'users.code_user',  'billers.user_id')
            ->leftjoin('banks', 'banks.id',  'billers.bank_id')
            ->where('billers.user_id', $objs->code_user)
            ->Orderby('billers.id', 'desc')
            ->paginate(15);

        $data['currentPage'] = $bill->currentPage();
        $data['perPage'] = $bill->perPage();
        $data['total'] = $bill->total();
        
        $data['bill'] = $bill;   


        $log = DB::table('logsys')->select(
            'logsys.*',
            'logsys.created_at as create',
            'users.*'
            )
            ->leftjoin('users', 'users.id',  'logsys.user_id')
            ->where('users.id',  $id)
            ->paginate(10);

            $data['log'] = $log;

        

        $data['url'] = url('admin/user/'.$id);
        $data['method'] = "put";
        $data['objs'] = $objs;
        return view('admin.user.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //

        $this->validate($request, [
            'name' => 'required'
        ]);

        if($request->hbd != null){
            $pieces = explode("-", $request->hbd);
            $age = date("Y") - $pieces[0];
            $age += 543;
        }else{
            $age = 0;
        }



            $package = User::find($id);
            $package->age = $age;
            $package->first_name = $request->first_name;
            $package->hbd = $request->hbd;
            $package->last_name = $request->last_name;
            $package->name = $request->name;
            $package->phone = $request->phone;
            $package->sex = $request->sex;
            $package->career = $request->career;
            $package->code_user = $request->code_user;
            $package->save();

            return redirect(url('admin/user/'.$id.'/edit'))->with('edit_success','Edit successful');


    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function del_user($id)
    {
        //
        DB::table('role_user')->where('user_id', $id)->delete();
        DB::table('logsys')->where('user_id', $id)->delete();
        DB::table('users')->where('id', $id)->delete();
        return redirect(url('admin/user'))->with('del_success','คุณทำการเพิ่มอสังหา สำเร็จ');
    }

    public function del_user_biller_id($id){

        $bill = DB::table('billers')
            ->where('id', $id)
            ->first();

            if(isset($bill->file_1)){
               $file_path = 'img/doc/'.$bill->file_1;
               unlink($file_path);
            }
            if(isset($bill->file_2)){
                $file_path = 'img/doc/'.$bill->file_2;
                unlink($file_path);
            }
            if(isset($bill->file_3)){
                $file_path = 'img/doc/'.$bill->file_3;
                unlink($file_path);
            }
            if(isset($bill->file_4)){
                $file_path = 'img/doc/'.$bill->file_4;
                unlink($file_path);
            }
            if(isset($bill->file_5)){
                $file_path = 'img/doc/'.$bill->file_5;
                unlink($file_path);
            }
            if(isset($bill->file_6)){
                $file_path = 'img/doc/'.$bill->file_6;
                unlink($file_path);
            } 

            $file = DB::table('biller_files')
            ->where('biller_id', $id)
            ->get();

           if(sizeof($file) > 0){
            for ($i = 0; $i < sizeof($file); $i++) {

                $file_path = 'img/doc/'.$file[$i]->file_name;
                unlink($file_path);

            }
           }

           



            DB::table('billers')->where('id', $id)->delete();
            DB::table('biller_files')->where('biller_id', $id)->delete();

        return redirect(url('admin/biller_id_user'))->with('del_success','คุณทำการเพิ่มอสังหา สำเร็จ'); 

    }
}
