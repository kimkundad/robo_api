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
      <h4 class="card-title">ข้อมูลของ {{ $objs['firstname'] }} {{ $objs['lastname'] }}</h4>
      <p class="card-description">
        กรอกข้อมูลให้ครบ ในส่วนที่มีเครื่องหมาย <span class="text-danger">*</span>
      </p>

      <div>
      @if (count($errors) > 0)
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
      </div>

      <form class="forms-sample" method="POST" action="{{$url}}" enctype="multipart/form-data">
        {{ csrf_field() }}
        {{ method_field($method) }}

                    <div class="row">
                      <div class="col-md-6">
                        <div class="form-group row">
                          <label class="col-sm-3 col-form-label">ชื่อ</label>
                          <div class="col-sm-9">
                            <input type="text" class="form-control" name="firstname" value="{{ $objs['firstname'] }}">
                            <input type="hidden" class="form-control" name="userId" value="{{ $objs['userId'] }}">
                          </div>
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-group row">
                          <label class="col-sm-3 col-form-label">นามสกุล</label>
                          <div class="col-sm-9">
                            <input type="text" class="form-control" name="lastname" value="{{ $objs['lastname'] }}">
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-md-6">
                        <div class="form-group row">
                          <label class="col-sm-3 col-form-label">เบอร์โทร</label>
                          <div class="col-sm-9">
                            <input type="text" class="form-control" name="phoneNumber" value="{{ $objs['phoneNumber'] }}">
                          </div>
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-group row">
                          <label class="col-sm-3 col-form-label">อีเมล</label>
                          <div class="col-sm-9">
                            <input type="text" class="form-control" name="email" value="{{ $objs['email'] }}">
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="row">

                    <div class="col-md-6">
                        <div class="form-group row">
                          <label class="col-sm-3 col-form-label">วันเกิด</label>
                          <div class="col-sm-9">
                          <div id="datepicker-popup" class="input-group date datepicker" >
                                <input type="text" class="form-control" name="dateOfBirth" value="{{ $objs['dateOfBirth'] }}"> 
                                <span class="input-group-addon input-group-append border-left">
                                <span class="icon-calendar input-group-text"></span>
                                </span>
                            </div>
                          </div>
                        </div>
                      </div>

                    <div class="col-md-6">
                        <div class="form-group row">
                          <label class="col-sm-3 col-form-label">อายุ</label>
                          <div class="col-sm-9">
                            <input type="text" class="form-control" id="age_my">
                          </div>
                        </div>
                      </div>
                      
                      
                      
                    </div>
                    <div class="row">
                    
                    
                      
                      <div class="col-md-6">
                        <div class="form-group row">
                          <label class="col-sm-3 col-form-label">เพศ</label>
                          <div class="col-sm-9">
                          <select class="form-control form-control-lg" name="gender">
                            <option @if($objs['gender'] == 'ไม่ระบุ')
                                    selected='selected'
                                    @endif >ไม่ระบุ</option>
                            <option @if($objs['gender'] == 'ชาย')
                                    selected='selected'
                                    @endif>ชาย</option>
                            <option @if($objs['gender'] == 'หญิง')
                                    selected='selected'
                                    @endif>หญิง</option>
                            </select>
                          </div>
                        </div>
                      </div>
                    </div>
                    

       
                    

       <!-- <div class="form-group">
          <br />
          <label for="exampleInputUsername1">รูปผู้ใช้งาน <span class="text-danger">*</span></label>
          <input type="file" class="dropify"  name="image" />
          <br />
        </div> -->


        <div style="text-align: right;">
        <br /><br /><br />
        <button type="submit" class="btn btn-primary mr-2">บันทึก</button>
        <a class="btn btn-light" href="{{ url('/admin/user') }}">ยกเลิก</a>
        </div>

      </form>
    </div>
  </div>
</div>

</div>
<br><br><br><br><br><br><br><br>

@endsection

@section('scripts')



<script>



var birth = new Date('<?php echo $objs['dateOfBirth']; ?>');
var check = new Date();

var milliDay = 1000 * 60 * 60 * 24; // a day in milliseconds;


var ageInDays = (check - birth) / milliDay;

var ageInYears =  Math.floor(ageInDays / 365 );

console.log('--',ageInYears)

if(ageInYears > 0){
  document.getElementById('age_my').value = ageInYears;
}


</script>
@stop('scripts')
