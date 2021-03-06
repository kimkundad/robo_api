<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Intervention\Image\ImageManagerStatic as Image;
use App\User;
use App\bank;
use App\biller;
use App\biller_file;
use App\biller_file2;
use App\text_address;
use Auth;
use Response;
use Redirect;

class BillerController extends Controller
{
    //


    public function getProvinces()
    {
        $provinces = DB::table('provinces')
        ->get();

        return $provinces;
    }
    public function getAmphoes($province)
    {
        $amphoes = DB::table('districts')
            ->where('province_id', $province)
            ->get();

        return $amphoes;
    }


    public function getTambons($province,$amphoe)
    {
        $tambons = DB::table('sub_districts')
            ->where('district_id', $amphoe)
            ->get();

        return $tambons;
    }
    public function getZipcodes($province,$amphoe,$tambon)
    {
        $zipcodes = DB::table('postal_codes')
            ->where('sub_district_id', $tambon)
            ->where('district_id', $amphoe)
            ->where('province_id', $province)
            ->get();

        return $zipcodes;
    }


    public function create_biller_id($id){

        $bank = bank::where('bank_status', 1)->get();
        $data['bank'] = $bank;

        $objs = User::find($id);

        $address = text_address::where('company', $objs->code_user)->get();
        $data['address'] = $address;
       // dd($objs);
        
        $data['objs'] = $objs;
        $data['id'] = $id;
        return view('admin.biller.create', $data);

    }

    public function create_address_user($id){

        $data['id'] = $id;

        return view('admin.biller.create_address_user', $data);
    }
    public function create_address_user2($id){

        $data['id'] = $id;

        return view('admin.biller.create_address_user2', $data);
    }

   
    

    public function edit_biller_id($id){

        $bank = bank::where('bank_status', 1)->get();
        $data['bank'] = $bank;

        $file3 = biller_file::where('biller_id', $id)->get();
        $data['file_all'] = $file3;  

        $file_2_all = biller_file2::where('biller_id', $id)->get();
        $data['file_2_all'] = $file_2_all;  

        $bill = DB::table('billers')->select(
            'billers.*',
            'billers.created_at as create',
            'billers.id as idb',
            'billers.phone as phone1',
            'users.*',
            'banks.*',
            'users.id as idu',
            'users.email as email_u',
            'users.phone as phone_u'
            )
            ->leftjoin('users', 'users.code_user',  'billers.user_id')
            ->leftjoin('banks', 'banks.id',  'billers.bank_id')
            ->where('billers.id', $id)
            ->first();

        $data['bill'] = $bill;  

       // dd($bill);

        $objs = User::find($bill->idu);
        $data['objs'] = $objs;

        


        $user = User::find($bill->idu);

        $address = text_address::where('company', $user->code_user)->get();
        $data['address'] = $address;

        $data['id'] = $user->id;

        return view('admin.biller.edit', $data);

    }

    

    public function add_new_address2(Request $request){

        
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
        $obj = User::find($id);

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
            $objs->company = $obj->code_user;
            $objs->status = 3;
            $objs->save();

            return redirect(url('admin/user/'.$id.'/edit'))->with('add_success','????????????????????????????????? ??????????????????????????????????????????????????????');

    }

    public function add_new_address(Request $request){

        
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
        $obj = User::find($id);

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
            $objs->company = $obj->code_user;
            $objs->status = 3;
            $objs->save();

            return redirect(url('admin/create_biller_id/'.$request['user_id']))->with('add_success','????????????????????????????????? ??????????????????????????????????????????????????????');

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

        return redirect(url('admin/edit_biller_id/'.$id))->with('add_success','????????????????????????????????? ??????????????????????????????????????????????????????');

    }

    public function get_document_1($id){

        $objs = DB::table('billers')
            ->where('id', $id)
            ->first();

        $file= public_path(). "/img/doc/".$objs->file_1;
       

        return response::download($file);
    }


    public function get_document_2($id){

        $objs = DB::table('billers')
            ->where('id', $id)
            ->first();

        $file= public_path(). "/img/doc/".$objs->file_2;
       

        return response::download($file);
    }


    public function get_document_3($id){

        $objs = DB::table('billers')
            ->where('id', $id)
            ->first();

        $myFile= public_path("/img/doc/".$objs->file_3);

        $newName = 'itsolutionstuff-pdf-file-'.time().''.$myFile->getClientOriginalExtension();

        return response::download($myFile, $newName);
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

        return redirect(url('admin/edit_biller_id/'.$id))->with('add_success','????????????????????????????????? ??????????????????????????????????????????????????????');

    }



    public function add_file5(Request $request){

        $id = $request['id'];
        $objs = DB::table('billers')
            ->where('id', $id)
            ->first();

            if(isset($objs->file_5)){
              $file_path = 'img/doc/'.$objs->file_5;
               unlink($file_path);
            }

          $image = $request->file('file5');
          $path = 'img/doc/';
          $filename = time().'.'.$image->getClientOriginalExtension();
          $image->move($path, $filename);

        
        $package = biller::find($id);
        $package->file_5 = $filename;
        $package->save();

        return redirect(url('admin/edit_biller_id/'.$id))->with('add_success','????????????????????????????????? ??????????????????????????????????????????????????????');

    }



    public function add_file6(Request $request){

        $id = $request['id'];
        $objs = DB::table('billers')
            ->where('id', $id)
            ->first();

            if(isset($objs->file_6)){
              $file_path = 'img/doc/'.$objs->file_6;
               unlink($file_path);
            }

          $image = $request->file('file6');
          $path = 'img/doc/';
          $filename = time().'.'.$image->getClientOriginalExtension();
          $image->move($path, $filename);

        
        $package = biller::find($id);
        $package->file_6 = $filename;
        $package->save();

        return redirect(url('admin/edit_biller_id/'.$id))->with('add_success','????????????????????????????????? ??????????????????????????????????????????????????????');

    }


    public function add_file3(Request $request){

        $id = $request['id'];
        $objs = DB::table('billers')
            ->where('id', $id)
            ->first();

            if(isset($objs->file_3)){
              $file_path = 'img/doc/'.$objs->file_3;
               unlink($file_path);
            }

          $image = $request->file('file3');
          $path = 'img/doc/';
          $filename = time().'.'.$image->getClientOriginalExtension();
          $image->move($path, $filename);

        
        $obj = biller::find($id);
        $obj->file_3 = $filename;
        $obj->save();

      //  dd($obj);

        return redirect(url('admin/edit_biller_id/'.$id))->with('add_success','????????????????????????????????? ??????????????????????????????????????????????????????');

    }

    public function add_file4(Request $request){

        $id = $request['id'];
        $objs = DB::table('billers')
            ->where('id', $id)
            ->first();

            if(isset($objs->file_4)){
              $file_path = 'img/doc/'.$objs->file_4;
               unlink($file_path);
            }

          $image = $request->file('file4');
          $path = 'img/doc/';
          $filename = time().'.'.$image->getClientOriginalExtension();
          $image->move($path, $filename);

        
        $package = biller::find($id);
        $package->file_4 = $filename;
        $package->save();

        return redirect(url('admin/edit_biller_id/'.$id))->with('add_success','????????????????????????????????? ??????????????????????????????????????????????????????');

    }

    

    public function add_file_com(Request $request){

        $id = $request['id'];

        $gallary = $request->file('sub_file_com');

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

          return redirect(url('admin/edit_biller_id/'.$id))->with('add_success','????????????????????????????????? ??????????????????????????????????????????????????????');

    }


    public function add_file_com2(Request $request){

        $id = $request['id'];

        $gallary = $request->file('file2');

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
            biller_file2::insert($admins);
          }

          return redirect(url('admin/edit_biller_id/'.$id))->with('add_success','????????????????????????????????? ??????????????????????????????????????????????????????');

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

          return Redirect::back()->with('del_success','????????????????????????????????????????????????????????? ??????????????????');
    }


    public function del_image_idcard($id)
    {
        //
        $objs = DB::table('biller_file2s')->where('id', $id)->first();
      //  dd($objs);

        if(isset($objs->file_name)){
            $file_path = 'img/doc/'.$objs->file_name;
             unlink($file_path);
          }
          DB::table('biller_file2s')->where('id', $id)->delete();

          return Redirect::back()->with('del_success','????????????????????????????????????????????????????????? ??????????????????');
    }




    




    public function post_edit_biller_id(Request $request, $id){

        
        
        $this->validate($request, [
            'company_name' => 'required',
            'company_type' => 'required',
            'business_type' => 'required',
            'id_card' => 'required',
            'bank_id' => 'required',
            'user_id' => 'required',
            't_com' => 'required'
        ]);

    
        $objs = biller::find($id);
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
        $objs->url_domain_name = $request['url_domain_name'];
        $objs->bill_type = $request['t_com'];
        $objs->merchant_id = $request['merchant_id'];
        $objs->terminal_id = $request['terminal_id'];
        $objs->address_id = $request['id_address'];
        $objs->AddressNow = $request['id_address2'];
        $objs->AddressCom = $request['id_address3']; 
        $objs->data1_id = $request['notes']; 
     //   $objs->address_id = $request['address'];
        $objs->save();

        return redirect(url('admin/edit_biller_id/'.$id))->with('add_success','Edit successful');

    }



    public function add_new_biller_id(Request $request){

        $this->validate($request, [
            'company_name' => 'required',
            'company_type' => 'required',
            'business_type' => 'required',
            'id_card' => 'required',
            'bank_id' => 'required',
            'user_id' => 'required',
            't_com' => 'required',
            'id_address' => 'required',
            'id_address2' => 'required',
            'id_address3' => 'required'
        ]);

        $randomSixDigitInt = (\random_int(1000, 9999)).''.(\random_int(1000, 9999)).''.(\random_int(10, 99));

        $objs = new biller();
        $objs->biller_id = $randomSixDigitInt;
        $objs->company_name = $request['company_name'];
        $objs->company_type = $request['company_type'];
        $objs->business_type = $request['business_type'];
        $objs->id_card = $request['id_card'];
        $objs->bank_id = $request['bank_id'];
        $objs->user_id = $request['user_id'];
        $objs->admin_id = Auth::user()->id;
        $objs->url_domain_name = $request['url_domain_name'];
        $objs->bill_type = $request['t_com'];
        $objs->merchant_id = $request['merchant_id'];
        $objs->terminal_id = $request['terminal_id'];
        $objs->status = 1;
        $objs->address_id = $request['id_address'];
        $objs->AddressNow = $request['id_address2'];
        $objs->AddressCom = $request['id_address3'];
        $objs->save();

        return redirect(url('admin/edit_biller_id/'.$objs->id))->with('add_success','Edit successful');

    }
}
