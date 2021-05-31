<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Intervention\Image\ImageManagerStatic as Image;
use App\User;

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

            //dd($bill);

        $data['objs'] = $bill;  
        return view('admin.user.biller_id_user', $data);

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

        $bill = DB::table('billers')->select(
            'billers.*',
            'billers.created_at as create',
            'billers.id as idb',
            'users.*',
            'banks.*'
            )
            ->leftjoin('users', 'users.code_user',  'billers.user_id')
            ->leftjoin('banks', 'banks.id',  'billers.bank_id')
            ->where('users.id', $id)
            ->get();

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

        $objs = User::find($id);

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
