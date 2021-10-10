<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\thiday;
use Intervention\Image\ImageManagerStatic as Image;
use File;
use Response;
use Redirect;


class ThaiDayController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $cat = thiday::Orderby('id', 'desc')->paginate(15);
        
        $data['objs'] = $cat;

       return view('admin.thiday.index', $data);
    }

    public function thai_day_status(Request $request){

        $user = thiday::findOrFail($request->user_id);
   
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
        $data['url'] = url('admin/thai_day');
        return view('admin.thiday.create', $data);
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
        $image2 = $request->file('image2');
      
        $this->validate($request, [
             'image' => 'required',
             'image2' => 'required',
             'name_day' => 'required',
             'day_time' => 'required'
         ]);

         $path = 'assets/img/thaiday/';
         $filename = time().'.'.$image->getClientOriginalExtension();
         $image->move($path, $filename);

        
         $filename2 = time().'-mobile.'.$image2->getClientOriginalExtension();
         $image2->move($path, $filename2);

        $package = new thiday();
       $package->name_day = $request['name_day'];
       $package->desktop_img = $filename;
       $package->mobile_img = $filename2;
       $package->day_time = $request['day_time'];
       $package->save();


       return redirect(url('admin/thai_day/'))->with('add_success','คุณทำการเพิ่มอสังหา สำเร็จ');

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
        $obj = thiday::find($id);
        $data['url'] = url('admin/thai_day/'.$id);
        $data['method'] = "put";
        $data['objs'] = $obj;
        return view('admin.thiday.edit', $data);
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
        $image2 = $request->file('image2');
      
        $this->validate($request, [
             'name_day' => 'required',
             'day_time' => 'required'
         ]);

         if($image == NULL && $image2 == NULL){

            $package = thiday::find($id);
            $package->day_time = $request['day_time'];
            $package->name_day = $request['name_day'];
            $package->save();

         }

         if($image != NULL && $image2 == NULL){

            $objs = thiday::find($id)->first();
            $file_path = 'assets/img/thaiday/'.$objs->desktop_img;
            unlink($file_path);

            $path = 'assets/img/thaiday/';
            $filename = time().'.'.$image->getClientOriginalExtension();
            $image->move($path, $filename);

            $package = thiday::find($id);
            $package->day_time = $request['day_time'];
            $package->name_day = $request['name_day'];
            $package->desktop_img = $filename;
            $package->save();

         }


         if($image == NULL && $image2 != NULL){

            $objs = thiday::find($id)->first();
            $file_path = 'assets/img/thaiday/'.$objs->mobile_img;
            unlink($file_path);

            $path = 'assets/img/thaiday/';
            $filename = time().'-mobile.'.$image2->getClientOriginalExtension();
            $image2->move($path, $filename);

            $package = thiday::find($id);
            $package->day_time = $request['day_time'];
            $package->name_day = $request['name_day'];
            $package->mobile_img = $filename;
            $package->save();

         }


         return redirect(url('admin/thai_day/'))->with('edit_success','คุณทำการเพิ่มอสังหา สำเร็จ');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function del_thai_day($id)
    {
        //
        $objs = DB::table('thidays')
      ->where('id', $id)
      ->first();

      $destinationPath = 'assets/img/thaiday/'.$objs->desktop_img;
      File::delete($destinationPath);

      $destinationPath2 = 'assets/img/thaiday/'.$objs->mobile_img;
      File::delete($destinationPath2);

      $obj = DB::table('thidays')
      ->where('id', $id)
      ->delete();

      return redirect(url('admin/thai_day/'))->with('del_success','ลบข้อมูล สำเร็จ');
    }
}
