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


        $province = DB::table('provinces')
               ->where('id', $objs->province)
               ->first();
               if(isset($province->name)){
                $objs->p_name = $province->name;
                $objs->p_id = $province->id;
               }else{
                $objs->p_name = null;
                $objs->p_id = null;
               }

           $district = DB::table('districts')
                ->where('id', $objs->county)
                ->first();

            if(isset($district->name)){
                $objs->d_name = $district->name;
                $objs->d_id = $district->id;
               }else{
                $objs->d_name = null;
                $objs->d_id = null;
               }

            $subdistricts = DB::table('sub_districts')
                 ->where('id', $objs->district)
                 ->first();

                 if(isset($subdistricts->name)){
                    $objs->sub_name = $subdistricts->name;
                    $objs->sub_id = $subdistricts->id;
                   }else{
                    $objs->sub_name = null;
                    $objs->sub_id = null;
                   }


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




    public function edit_user_address(Request $request){


        $this->validate($request, [
            'fname' => 'required',
            'phone' => 'required',
            'provi' => 'required',
            'address_no' => 'required',
            'mydist' => 'required',
            'user_id' => 'required',
            'mySubDist' => 'required',
            'postal_codes' => 'required'
        ]);

        $id = $request['user_id'];
   

       
            $objs = text_address::find($request['add_id']);
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
            $objs->status = 3;
            $objs->save();

            return redirect(url('admin/user/'.$id.'/edit'))->with('add_success','เพิ่มธนาคาร เสร็จเรียบร้อยแล้ว');
    }
}
