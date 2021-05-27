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

        $data['objs'] = $objs;
        return view('admin.user.index', $data);
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
}
