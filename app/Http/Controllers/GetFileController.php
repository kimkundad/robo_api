<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\get_file;
use App\cat_file;
use Intervention\Image\ImageManagerStatic as Image;
use File;
use Response;
use Redirect;


class GetFileController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //status

        $cat = DB::table('get_files')->select(
            'get_files.*',
            'get_files.created_at as create',
            'get_files.id as idg',
            'get_files.status as statusg',
            'cat_files.*',
            'cat_files.id as idc',
            )
            ->leftjoin('cat_files', 'cat_files.id',  'get_files.cat_id')
            ->get();

            $data['objs'] = $cat;

       return view('admin.get_file.index', $data);

    }

    public function get_file_status(Request $request){

        $user = get_file::findOrFail($request->user_id);
   
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
        $cat = cat_file::all();
        $data['cat'] = $cat;

        $data['method'] = "post";
        $data['url'] = url('admin/get_file');
        $data['datahead'] = "สร้าง review ";
        return view('admin.get_file.create', $data);

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

        $bytes = $request->file('image')->getSize();
    

     //    dd($bytes);


        //dd($request->file('image')->getSize());
        $image = $request->file('image');
      
        $this->validate($request, [
             'image' => 'required',
             'file_name' => 'required',
             'cat_id' => 'required'
         ]);

         $path = 'img/doc_download/';
         $filename = time().'.'.$image->getClientOriginalExtension();
         $image->move($path, $filename);
        
         

         if ($bytes >= 1073741824)
        {
            $bytes = number_format($bytes / 1073741824, 2) . ' GB';
        }
        elseif ($bytes >= 1048576)
        {
            $bytes = number_format($bytes / 1048576, 2) . ' MB';
        }
        elseif ($bytes >= 1024)
        {
            $bytes = number_format($bytes / 1024, 2) . ' KB';
        }
        elseif ($bytes > 1)
        {
            $bytes = $bytes . ' bytes';
        }
        elseif ($bytes == 1)
        {
            $bytes = $bytes . ' byte';
        }
        else
        {
            $bytes = '0 bytes';
        }


       $package = new get_file();
       $package->file_name = $request['file_name'];
       $package->cat_id = $request['cat_id'];
       $package->file_size = $bytes;
       $package->store_file = $filename;
       $package->save();


       return redirect(url('admin/get_file/'))->with('add_success','คุณทำการเพิ่มอสังหา สำเร็จ');
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
        $cat = cat_file::all();
        $data['cat'] = $cat;

        $obj = get_file::find($id);
        $data['url'] = url('admin/get_file/'.$id);
        $data['datahead'] = "แก้ไข get_file";
        $data['method'] = "put";
        $data['objs'] = $obj;
        return view('admin.get_file.edit', $data);
    }

    public function get_file_upload($id){

        $objs = DB::table('get_files')
            ->where('id', $id)
            ->first();

        $file= public_path(). "/img/doc_download/".$objs->store_file;
       

        return response::download($file);
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

        $this->validate($request, [
             'file_name' => 'required',
             'cat_id' => 'required'
         ]);


         $package = get_file::find($id);
       $package->file_name = $request['file_name'];
       $package->cat_id = $request['cat_id'];
       $package->file_size = $bytes;
       $package->save();

        }else{

            $bytes = $request->file('image')->getSize(); 

        if ($bytes >= 1073741824)
        {
            $bytes = number_format($bytes / 1073741824, 2) . ' GB';
        }
        elseif ($bytes >= 1048576)
        {
            $bytes = number_format($bytes / 1048576, 2) . ' MB';
        }
        elseif ($bytes >= 1024)
        {
            $bytes = number_format($bytes / 1024, 2) . ' KB';
        }
        elseif ($bytes > 1)
        {
            $bytes = $bytes . ' bytes';
        }
        elseif ($bytes == 1)
        {
            $bytes = $bytes . ' byte';
        }
        else
        {
            $bytes = '0 bytes';
        }

        $this->validate($request, [
             'file_name' => 'required',
             'cat_id' => 'required'
         ]);


          $objs = get_file::find($id)->first();
          $file_path = 'img/doc_download/'.$objs->store_file;
          unlink($file_path);

         $path = 'img/doc_download/';
         $filename = time().'.'.$image->getClientOriginalExtension();
         $image->move($path, $filename);

         $package = get_file::find($id);
       $package->file_name = $request['file_name'];
       $package->cat_id = $request['cat_id'];
       $package->file_size = $bytes;
       $package->store_file = $filename;
       $package->save();

        }

        return redirect(url('admin/get_file/'))->with('edit_success','คุณทำการเพิ่มอสังหา สำเร็จ');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function del_get_file($id)
    {
        //

        $objs = DB::table('get_files')
      ->where('id', $id)
      ->first();

      $destinationPath = 'img/doc_download/'.$objs->store_file;
      File::delete($destinationPath);

      $obj = DB::table('get_files')
      ->where('id', $id)
      ->delete();

      return redirect(url('admin/get_file/'))->with('del_success','ลบข้อมูล สำเร็จ');
    }
}
