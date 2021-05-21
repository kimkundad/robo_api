<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\cat_file;
use Intervention\Image\ImageManagerStatic as Image;
use File;

class CatFileController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $cat = cat_file::all();
        
        $data['objs'] = $cat;

       return view('admin.cat_file.index', $data);
    }

    public function cat_file_status(Request $request){

        $user = cat_file::findOrFail($request->user_id);
   
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
        //
        $data['method'] = "post";
        $data['url'] = url('admin/cat_file');
        $data['datahead'] = "สร้าง review ";
        return view('admin.cat_file.create', $data);
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

        $this->validate($request, [
             'cat_name' => 'required',
         ]);

       $package = new cat_file();
       $package->cat_name = $request['cat_name'];
       $package->save();


       return redirect(url('admin/cat_file/'))->with('add_success','คุณทำการเพิ่มอสังหา สำเร็จ');
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
        $obj = cat_file::find($id);
        $data['url'] = url('admin/cat_file/'.$id);
        $data['datahead'] = "แก้ไข banner";
        $data['method'] = "put";
        $data['objs'] = $obj;
        return view('admin.cat_file.edit', $data);
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
            'cat_name' => 'required',
        ]);


        $package = cat_file::find($id);
        $package->cat_name = $request['cat_name'];
       $package->save();

        return redirect(url('admin/cat_file/'))->with('edit_success','คุณทำการเพิ่มอสังหา สำเร็จ');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function del_cat_file($id)
    {
        //
        $obj = DB::table('cat_files')
      ->where('id', $id)
      ->delete();

      return redirect(url('admin/cat_file/'))->with('del_success','ลบข้อมูล สำเร็จ');
    }
}
