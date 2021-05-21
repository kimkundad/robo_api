<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Intervention\Image\ImageManagerStatic as Image;
use App\User;
use App\bank;
use App\biller;
use App\biller_file;
use Auth;
use Response;
use Redirect;

class BillerController extends Controller
{
    //

    public function create_biller_id($id){

        $bank = bank::where('bank_status', 1)->get();
        $data['bank'] = $bank;

        $objs = User::find($id);
        $data['objs'] = $objs;
        return view('admin.biller.create', $data);

    }

    public function edit_biller_id($id){

        $bank = bank::where('bank_status', 1)->get();
        $data['bank'] = $bank;

        $file3 = biller_file::where('biller_id', $id)->get();
        $data['file3'] = $file3;  

        $bill = DB::table('billers')->select(
            'billers.*',
            'billers.created_at as create',
            'billers.id as idb',
            'billers.phone as phone1',
            'users.*',
            'banks.*',
            'users.id as idu',
            )
            ->leftjoin('users', 'users.code_user',  'billers.user_id')
            ->leftjoin('banks', 'banks.id',  'billers.bank_id')
            ->where('billers.id', $id)
            ->first();

        $data['bill'] = $bill;  

        $objs = User::find($bill->idu);
        $data['objs'] = $objs;

        return view('admin.biller.edit', $data);

    }

    

    public function add_file1(Request $request){

        $id = $request['id'];
        $objs = DB::table('billers')
            ->where('id', $id)
            ->first();

            if(isset($objs->file_1)){
              $file_path = 'img/doc/'.$objs->file_1;
               unlink($file_path);
            }

        $image = $request->file('file1');
        
          $path = 'img/doc/';
          $filename = time().'.'.$image->getClientOriginalExtension();
          $image->move($path, $filename);

        
        $package = biller::find($id);
        $package->file_1 = $filename;
        $package->save();

        return redirect(url('admin/edit_biller_id/'.$id))->with('add_success','เพิ่มธนาคาร เสร็จเรียบร้อยแล้ว');

    }

    public function get_document_1($id){

        $objs = DB::table('billers')
            ->where('id', $id)
            ->first();

        $file= public_path(). "/img/doc/".$objs->file_1;
       

        return response::download($file);
    }


    public function add_file2(Request $request){

        $id = $request['id'];
        $objs = DB::table('billers')
            ->where('id', $id)
            ->first();

            if(isset($objs->file_2)){
              $file_path = 'img/doc/'.$objs->file_2;
               unlink($file_path);
            }

        $image = $request->file('file2');
        
          $path = 'img/doc/';
          $filename = time().'.'.$image->getClientOriginalExtension();
          $image->move($path, $filename);

        
        $package = biller::find($id);
        $package->file_2 = $filename;
        $package->save();

        return redirect(url('admin/edit_biller_id/'.$id))->with('add_success','เพิ่มธนาคาร เสร็จเรียบร้อยแล้ว');

    }

    public function add_file3(Request $request){

        $id = $request['id'];

        $gallary = $request->file('file3');

        if (sizeof($gallary) > 0) {
            for ($i = 0; $i < sizeof($gallary); $i++) {
              $path = 'img/doc/';
              $filename = time()."-".$gallary[$i]->getClientOriginalName();
              $gallary[$i]->move($path, $filename);
              $admins[] = [
                  'file_name' => $filename,
                  'type' => 3,
                  'biller_id' => $id
              ];
            }
            biller_file::insert($admins);
          }

          return redirect(url('admin/edit_biller_id/'.$id))->with('add_success','เพิ่มธนาคาร เสร็จเรียบร้อยแล้ว');

    }


    public function del_image_3($id)
    {
        //
        $objs = DB::table('biller_files')->where('id', $id)->first();
      //  dd($objs);

        if(isset($objs->file_name)){
            $file_path = 'img/doc/'.$objs->file_name;
             unlink($file_path);
          }
          DB::table('biller_files')->where('id', $id)->delete();

          return Redirect::back()->with('del_success','คุณทำการเพิ่มอสังหา สำเร็จ');
    }




    public function get_document_2($id){

        $objs = DB::table('billers')
            ->where('id', $id)
            ->first();

        $file= public_path(). "/img/doc/".$objs->file_2;
       

        return response::download($file);
    }


    public function post_edit_biller_id(Request $request, $id){

        $this->validate($request, [
            'f_name' => 'required',
            'l_name' => 'required',
            'email' => 'required',
            'phone' => 'required',
            'company_name' => 'required',
            'company_type' => 'required',
            'business_type' => 'required',
            'id_card' => 'required',
            'bank_id' => 'required',
            'user_id' => 'required'
        ]);

    
        $objs = biller::find($id);
        $objs->f_name = $request['f_name'];
        $objs->l_name = $request['l_name'];
        $objs->email = $request['email'];
        $objs->phone = $request['phone'];
        $objs->company_name = $request['company_name'];
        $objs->company_type = $request['company_type'];
        $objs->business_type = $request['business_type'];
        $objs->id_card = $request['id_card'];
        $objs->bank_id = $request['bank_id'];
        $objs->user_id = $request['user_id'];
        $objs->admin_id = Auth::user()->id;
        $objs->status = 1;
        $objs->process = $request['process'];
        $objs->bank_name = $request['bank_name'];
        $objs->bank_no = $request['bank_no'];
        $objs->bank_major = $request['bank_major'];
        $objs->save();

        return redirect(url('admin/edit_biller_id/'.$id))->with('add_success','Edit successful');

    }


    public function add_new_biller_id(Request $request){

        $this->validate($request, [
            'f_name' => 'required',
            'l_name' => 'required',
            'email' => 'required',
            'phone' => 'required',
            'company_name' => 'required',
            'company_type' => 'required',
            'business_type' => 'required',
            'id_card' => 'required',
            'bank_id' => 'required',
            'user_id' => 'required'
        ]);

        $randomSixDigitInt = (\random_int(1000, 9999)).''.(\random_int(1000, 9999)).''.(\random_int(10, 99));

        $objs = new biller();
        $objs->biller_id = $randomSixDigitInt;
        $objs->f_name = $request['f_name'];
        $objs->l_name = $request['l_name'];
        $objs->email = $request['email'];
        $objs->phone = $request['phone'];
        $objs->company_name = $request['company_name'];
        $objs->company_type = $request['company_type'];
        $objs->business_type = $request['business_type'];
        $objs->id_card = $request['id_card'];
        $objs->bank_id = $request['bank_id'];
        $objs->user_id = $request['user_id'];
        $objs->admin_id = Auth::user()->id;
        $objs->status = 1;
        $objs->save();

        return redirect(url('admin/edit_biller_id/'.$objs->id))->with('add_success','Edit successful');

    }
}