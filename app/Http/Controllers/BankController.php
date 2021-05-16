<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\bank;
use Intervention\Image\ImageManagerStatic as Image;


class BankController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
      $objs = DB::table('banks')
        ->get();

        if(isset($objs)){
          foreach($objs as $u){

            $count = DB::table('billers')->where('bank_id', $u->id)
            ->count();
            $u->option = $count;
          }
        }

      $data['objs'] = $objs;
      return view('admin.bank.index', $data);
    }


    public function bank_status(Request $request){

      $user = bank::findOrFail($request->user_id);
  
                if($user->bank_status == 1){
                    $user->bank_status = 0;
                } else {
                    $user->bank_status = 1;
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
      $data['url'] = url('admin/bank');
      return view('admin.bank.create', $data);
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
            'image' => 'required',
            'name_bank' => 'required'
          ]);

          $image = $request->file('image');
          $path = 'img/bank/';
          $filename = time().'.'.$image->getClientOriginalExtension();
          $image->move($path, $filename);

        $package = new bank();
        $package->bank_img = $filename;
        $package->name_bank = $request['name_bank'];
        $package->save();

        return redirect(url('admin/bank'))->with('add_success','เพิ่มธนาคาร เสร็จเรียบร้อยแล้ว');

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

        $objs = bank::find($id);

        $data['url'] = url('admin/bank/'.$id);
        $data['method'] = "put";
        $data['objs'] = $objs;
        return view('admin.bank.edit', $data);
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
        $this->validate($request, [
            'name_bank' => 'required'
          ]);

        $package = bank::find($id);
        $package->name_bank = $request['name_bank'];
        $package->save();

        if($image != NULL){

            $objs = DB::table('banks')
               ->where('id', $id)
               ->first();

               if(isset($objs->bank_img)){
                $file_path = 'img/bank/'.$objs->bank_img;
                 unlink($file_path);
              }

              $path = 'img/bank/';
       $filename = time().'.'.$image->getClientOriginalExtension();
       $image->move($path, $filename);

        $package = bank::find($id);
        $package->name_bank = $request['name_bank'];
        $package->bank_img = $filename;
        $package->save();

        }

        return redirect(url('admin/bank/'))->with('edit_success','คุณทำการเพิ่มอสังหา สำเร็จ');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function del_bank($id)
    {
        //
        $objs = DB::table('banks')
            ->where('id', $id)
            ->first();

            if(isset($objs->bank_img)){
              $file_path = 'img/bank/'.$objs->bank_img;
               unlink($file_path);
            }

             DB::table('banks')->where('id', $id)->delete();

             return redirect(url('admin/bank'))->with('del_success','คุณทำการเพิ่มอสังหา สำเร็จ');
        
    }
}
