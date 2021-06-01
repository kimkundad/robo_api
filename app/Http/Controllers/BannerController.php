<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\banner;
use Intervention\Image\ImageManagerStatic as Image;
use File;

class BannerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $cat = banner::Orderby('sort', 'asc')->paginate(15);
        
        $data['objs'] = $cat;
        $data['currentPage'] = $cat->currentPage();
        $data['perPage'] = $cat->perPage();
        $data['total'] = $cat->total();

       return view('admin.banner.index', $data);
    }
    

    public function banner_status(Request $request){

        $user = banner::findOrFail($request->user_id);
   
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
        $data['url'] = url('admin/banner');
        $data['datahead'] = "สร้าง review ";
        return view('admin.banner.create', $data);
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
             'name' => 'required',
             'sort' => 'required'
         ]);

        $input['imagename'] = time().'.'.$image->getClientOriginalExtension();

        $img = Image::make($image->getRealPath());
        $img->resize(250, 250, function ($constraint) {
        $constraint->aspectRatio();
      })->save('img/banner/'.$input['imagename']);



       $package = new banner();
       $package->name = $request['name'];
       $package->sort = $request['sort'];
       $package->image = $input['imagename'];
       $package->save();


       return redirect(url('admin/banner/'))->with('add_success','คุณทำการเพิ่มอสังหา สำเร็จ');
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
        $obj = banner::find($id);
        $data['url'] = url('admin/banner/'.$id);
        $data['datahead'] = "แก้ไข banner";
        $data['method'] = "put";
        $data['objs'] = $obj;
        return view('admin.banner.edit', $data);
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
               'name' => 'required',
               'sort' => 'required'
           ]);


           $package = banner::find($id);
           $package->name = $request['name'];
           $package->sort = $request['sort'];
           $package->save();

           return redirect(url('admin/banner/'))->with('edit_success','คุณทำการเพิ่มอสังหา สำเร็จ');



        }else{

            $this->validate($request, [
                'name' => 'required',
                'sort' => 'required'
            ]);

       /*   $objs = banner::find($id)->first();

          $file_path = 'img/banner/'.$objs->image;
          unlink($file_path);  */

          $input['imagename'] = time().'.'.$image->getClientOriginalExtension();

          $img = Image::make($image->getRealPath());
          $img->resize(250, 250, function ($constraint) {
          $constraint->aspectRatio();
        })->save('img/banner/'.$input['imagename']);

           $package = banner::find($id);
           $package->name = $request['name'];
           $package->sort = $request['sort'];
           $package->image = $input['imagename'];
           $package->save();

           return redirect(url('admin/banner/'))->with('edit_success','คุณทำการเพิ่มอสังหา สำเร็จ');

        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function del_banner($id)
    {
        //
        $objs = DB::table('banners')
      ->where('id', $id)
      ->first();

      $destinationPath = 'img/banner/'.$objs->image;
      File::delete($destinationPath);

      $obj = DB::table('banners')
      ->where('id', $id)
      ->delete();

      return redirect(url('admin/banner/'))->with('del_success','ลบข้อมูล สำเร็จ');
    }
}
