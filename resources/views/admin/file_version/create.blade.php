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
      <h4 class="card-title">ข้อมูล FIRMWARE VERSION</h4>
      <p class="card-description">
        กรอกข้อมูลให้ครบ ในส่วนที่มีเครื่องหมาย <span class="text-danger">*</span>
      </p>

      <form class="forms-sample" id="contactForm">
        <div class="form-group">
          <label for="exampleInputUsername1">รายละเอียด<span class="text-danger">*</span></label>
          <textarea class="form-control" id="Description" name="Description" rows="4"></textarea>
        </div>

        <div class="form-group">
          <label for="exampleInputUsername1">Version <span class="text-danger">*</span></label>
          <input type="text" class="form-control" name="Version" id="Version">
        </div>

        <div class="form-group">
          <label for="exampleInputUsername1">Machine Type <span class="text-danger">*</span></label>
          <input type="text" class="form-control" name="MachineType" id="MachineType">
        </div>

        <div class="form-group">
          <br />
          <label for="exampleInputUsername1">อัพโหลดไฟล์ <span class="text-danger">*</span></label>
          <input type="file" class="dropify"  name="File" id="File"/>
          <br />
        </div>


          <div style="text-align: right;">
            <br /><br /><br />
            <a class="btn btn-primary mr-2" id="btnSendData" style="color:#fff">บันทึก</a>
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

<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

<script>

$(document).on('click','#btnSendData',function (event) {
  event.preventDefault();
  var form = $('#contactForm')[0];
  var formData = new FormData(form);

  var description = document.getElementById("Description").value;
  var version = document.getElementById("Version").value;
  var machineType = document.getElementById("MachineType").value;
  var file = document.getElementById("File").value;


if(description == '' || version == '' || machineType == '' || file == ''){

  swal("กรูณา ป้อนข้อมูลให้ครบถ้วน");

}else{

 

  

  $.ajax({
      url: "https://iot-test.promptrub.com/api/v1/version_control/upload",
      data: formData,
      async: true,
      crossDomain: true,
      processData: false,
      contentType: false,
      type: 'POST',
      success: function(data){
        console.log(data)
            swal("สำเร็จ!", "ข้อมูลได้ทำการบันทึกเสร็จแล้ว", "success");


          setTimeout(function(){
                window.location.replace("{{url('admin/get_file_version/')}}/");
          }, 2000);

          
      },
      error: function () {

      }
  });

}


});
</script>

@stop('scripts')