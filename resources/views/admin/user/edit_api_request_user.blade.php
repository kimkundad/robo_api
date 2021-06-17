@extends('admin.layouts.template')

@section('ga')
window.gaTitle = 'หน้าแรก';
@endsection

@section('stylesheet')
<style>
.note-editor.note-frame .note-editing-area .note-editable {
    padding: 35px;
    overflow: auto;
    color: #000;
    background-color: #fff;
}
</style>
@stop('stylesheet')

@section('content')



<div class="row">

<div class="col-md-12">
  <div class="card">
    <div class="card-body">
      <h4 class="card-title">ข้อมูล ไฟล์เอกสาร</h4>
      <p class="card-description">
        กรอกข้อมูลให้ครบ ในส่วนที่มีเครื่องหมาย <span class="text-danger">*</span>
      </p>

      <form class="forms-sample" method="POST" action="{{ url('api/post_edit_api_request_user/'.$objs->idb) }}" enctype="multipart/form-data">
      
        {{ csrf_field() }}
        <div class="form-group">
          <label for="exampleInputUsername1">ชื่อ-นามสกุล </label>
          <input type="text" class="form-control" id="exampleInputUsername1"  value="{{$objs->first_name}} {{$objs->last_name}}" readonly> 
        </div>
        <div class="form-group">
          <label for="exampleInputUsername1">ชื่อบริษัท / ร้านค้า </label>
          <input type="text" class="form-control" id="exampleInputUsername1" name="api_name" value="{{ $objs->api_name }}">
        </div>

        <div class="form-group">
        <label for="exampleInputUsername1">ปรับสภานะ </label>
        <select class="form-control" name="status">
                                    
            <option value="0"  @if($objs->status_v2 == 0)
                                    selected='selected'
                                    @endif> รอการตรวจสอบ </option>
            <option value="1"  @if($objs->status_v2 == 1)
                                    selected='selected'
                                    @endif> พร้อมใช้งาน </option>
                                    
        </select>
        </div>

        <div class="form-group">
          <label for="exampleInputUsername1">Call back URL </label>
          <input type="text" class="form-control" id="exampleInputUsername1" name="api_callback" value="{{ $objs->api_callback }}">
        </div>

        <div class="form-group">
          <label for="exampleInputUsername1">API Key </label>
          <input type="text" class="form-control" id="exampleInputUsername1" name="api_key" value="{{ $objs->api_key }}">
        </div>

        <div class="form-group">
          <label for="exampleInputUsername1">Secret Key </label>
          <input type="text" class="form-control" id="exampleInputUsername1" name="secret_key" value="{{ $objs->secret_key }}">
        </div>

        <div class="form-group">
          <label for="exampleInputUsername1">วันที่สมัคร </label>
          <input type="text" class="form-control" value="{{formatDateThat($objs->create)}}" readonly>
        </div>

        <hr>
        <br>
        <h4 class="card-title">ที่อยู่ + ผู้ติดต่อ</h4>
        <div class="form-group">
          <p>ชื่อผู้ติดต่อ {{ $get_address->fname}} {{ $get_address->lname }}, {{ $get_address->phone }} , {{ $get_address->email	}}</p>
          <p>บ้านเลขที่ {{ $get_address->address_no}} {{$get_address->address_name }}, ซอย : {{ $get_address->soi }} , ถนน : {{ $get_address->road	}} 
          , {{ $get_address->phone }}, {{ $get_address->sub_name }} , {{ $get_address->d_name }}, {{ $get_address->p_name }} {{ $get_address->postal_code }} </p>
        </div>

        <div style="text-align: right;">
        <br /><br /><br />
        <button type="submit" class="btn btn-primary mr-2">บันทึก</button>
        <button class="btn btn-light">ยกเลิก</button>
        </div>

      </form>
    </div>
  </div>
</div>

</div>
<br><br><br><br><br><br><br><br>


@endsection

@section('scripts')




@stop('scripts')