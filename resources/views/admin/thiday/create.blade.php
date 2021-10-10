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
      <h4 class="card-title">ข้อมูล วันสำคัญ</h4>
      <p class="card-description">
        กรอกข้อมูลให้ครบ ในส่วนที่มีเครื่องหมาย <span class="text-danger">*</span>
      </p>

      <form class="forms-sample" method="POST" action="{{$url}}" enctype="multipart/form-data">
        {{ method_field($method) }}
        {{ csrf_field() }}
        <div class="form-group">
          <label for="exampleInputUsername1">ชื่อ วันสำคัญ <span class="text-danger">*</span></label>
          <input type="text" class="form-control" id="exampleInputUsername1" name="name_day" value="{{ old('name_day') }}">
        </div>

        <div class="form-group">
          <br />
          <label for="exampleInputUsername1">อัพโหลดรูป DeskTop<span class="text-danger">*</span></label>
          <input type="file" class="dropify"  name="image" />
          <br />
        </div>

        <div class="form-group">
          <br />
          <label for="exampleInputUsername1">อัพโหลดรูป Mobile<span class="text-danger">*</span></label>
          <input type="file" class="dropify"  name="image2" />
          <br />
        </div>

        <div class="col-md-6">
                        <div class="form-group row">
                          <label class="col-sm-3 col-form-label">วันที่แสดง</label>
                          <div class="col-sm-9">
                          <div id="datepicker-popup" class="input-group date datepicker">
                                <input type="text" class="form-control" name="day_time" > 
                                <span class="input-group-addon input-group-append border-left">
                                <span class="icon-calendar input-group-text"></span>
                                </span>
                            </div>
                          </div>
                        </div>
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