<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\qr_code_type;
use Intervention\Image\ImageManagerStatic as Image;
use File;
use Response;
use Redirect;

class QrTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $cat = qr_code_type::Orderby('id', 'desc')->paginate(15);
        
        $data['objs'] = $cat;

       return view('admin.get_qr_type.index', $data);
        //
    }

    public function qr_type_status(Request $request){

        $user = qr_code_type::findOrFail($request->user_id);
   
                  if($user->status == 1){
                      $user->status = 0;
                  } else {
                      $user->status = 1;
                  }
   
   
          return response()->json([
          'data' => [
            'success' => $user->save(),
          ]
        ]);

    }

    
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        $data['method'] = "post";
        $data['url'] = url('admin/get_qr_type');
        return view('admin.get_qr_type.create', $data);
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
        $image = $request->file('image');
      
        $this->validate($request, [
             'image' => 'required',
             'qr_name' => 'required'
         ]);

         $path = 'assets/img/qr_image/';
         $filename = time().'.'.$image->getClientOriginalExtension();
         $image->move($path, $filename);

        $package = new qr_code_type();
       $package->qr_name = $request['qr_name'];
       $package->qr_image = $filename;
       $package->save();


       return redirect(url('admin/get_qr_type/'))->with('add_success','คุณทำการเพิ่มอสังหา สำเร็จ');


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
        //
        $obj = qr_code_type::find($id);
        $data['url'] = url('admin/get_qr_type/'.$id);
        $data['method'] = "put";
        $data['objs'] = $obj;
        return view('admin.get_qr_type.edit', $data);
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
        $image = $request->file('image');

        if($image == NULL){

                $package = qr_code_type::find($id);
                $package->qr_name = $request['qr_name'];
                $package->save();

        }else{

            $objs = qr_code_type::find($id)->first();
            $file_path = 'assets/img/qr_image/'.$objs->qr_image;
            unlink($file_path);

            $path = 'assets/img/qr_image/';
            $filename = time().'.'.$image->getClientOriginalExtension();
            $image->move($path, $filename);

                $package = qr_code_type::find($id);
                $package->qr_name = $request['qr_name'];
                $package->qr_image = $filename;
                $package->save();

        }

        return redirect(url('admin/get_qr_type/'))->with('edit_success','คุณทำการเพิ่มอสังหา สำเร็จ');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function del_get_qr_type($id)
    {
        //
        $objs = DB::table('qr_code_types')
      ->where('id', $id)
      ->first();

      $destinationPath = 'assets/img/qr_image/'.$objs->qr_image;
      File::delete($destinationPath);

      $obj = DB::table('qr_code_types')
      ->where('id', $id)
      ->delete();

      return redirect(url('admin/get_qr_type/'))->with('del_success','ลบข้อมูล สำเร็จ');
    }
}
