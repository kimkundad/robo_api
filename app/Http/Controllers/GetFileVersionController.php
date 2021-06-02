<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\fileversion;
use Intervention\Image\ImageManagerStatic as Image;
use File;
use Response;
use Redirect;


class GetFileVersionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $data['objs'] = '';

       return view('admin.file_version.index', $data);
    }


    public function get_file_version_api(){

        $bill = DB::table('fileversions')
                ->orderby('id', 'desc')
                ->get();

                if(isset($bill)){
                    foreach($bill as $u){
                        $u->date_create = formatDateThat($u->created_at);
                    }
                }



        return response()->json($bill);

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
        $data['url'] = url('admin/file_version');
        $data['datahead'] = "สร้าง review ";
        return view('admin.file_version.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function add_file_version(Request $request)
    {
        //
        $image = $request->file('image');
        $path = 'assets/doc_version/';
         $filename = time().'.'.$image->getClientOriginalExtension();
         $image->move($path, $filename);

       $package = new fileversion();
       $package->name = $request['file_name'];
       $package->version = $request['version'];
       $package->file_version = $filename;
       $package->save();

       return response()->json([
        'data' => [
          'status' => 200,
          'msg' => 'This user was not verified by recaptcha.'
        ]
      ]);


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
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
