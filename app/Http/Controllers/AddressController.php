<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Intervention\Image\ImageManagerStatic as Image;
use App\bank;
use App\text_address;

class AddressController extends Controller
{
    //

    public function edit_add_id($id){

        $objs = DB::table('text_addresses')->where('id', $id)->first();
        $user = DB::table('users')
            ->where('code_user', $objs->company)
            ->first();
        $data['user'] = $user;
        $data['objs'] = $objs;

        return view('admin.address.edit', $data);

    }

    public function del_user_add_id($id){

            $objs = DB::table('text_addresses')
            ->where('id', $id)
            ->first();

            $user = DB::table('users')
            ->where('code_user', $objs->company)
            ->first();

            $obj = DB::table('text_addresses')
            ->where('id', $id)
            ->delete();


            return redirect(url('admin/user/'.$user->id.'/edit'))->with('add_success','เพิ่มธนาคาร เสร็จเรียบร้อยแล้ว');

            

        
    }
}
