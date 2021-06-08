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
      <h4 class="card-title">ข้อมูล ไฟล์ version</h4>
      <p class="card-description">
        กรอกข้อมูลให้ครบ ในส่วนที่มีเครื่องหมาย <span class="text-danger">*</span>
      </p>

      <form class="forms-sample" id="contactForm">
        <div class="form-group">
          <label for="exampleInputUsername1">ชื่อไฟล์ version<span class="text-danger">*</span></label>
          <input type="text" class="form-control" name="file_name" id="file_name" value="">
          <input type="hidden" class="form-control" name="file_id" id="file_id" value="">
        </div>

        <div class="form-group">
          <label for="exampleInputUsername1">Version <span class="text-danger">*</span></label>
          <input type="text" class="form-control" name="version" id="version" value="">
        </div>

        <div class="form-group">
          <br />
          <label for="exampleInputUsername1">อัพโหลดไฟล์ <span class="text-danger">*</span></label>
          <input type="file" class="dropify"  name="image" id="image"/>
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
<script src="https://cdn.jsdelivr.net/npm/gasparesganga-jquery-loading-overlay@2.1.6/dist/loadingoverlay.min.js"></script>
<script>

$.ajax({
        url: "{{ url('api/get_file_version/'.$objs->id.'/edit') }}",
        method:'GET',
        success: function (data) {
            console.log(data.name)
document.getElementById("file_name").value = data.name;
document.getElementById("version").value = data.version;
document.getElementById("file_id").value = data.id;

version
},
        error: function (data) {
        }
      });



$(document).on('click','#btnSendData',function (event) {
  event.preventDefault();
  var form = $('#contactForm')[0];
  var formData = new FormData(form);

  var file_name = document.getElementById("file_name").value;
  var version = document.getElementById("version").value;
  var image = document.getElementById("image").value;




if(file_name == '' || version == ''){

  swal("กรูณา ป้อนข้อมูลให้ครบถ้วน");

}else{

  $.LoadingOverlay("show", {
    background  : "rgba(255, 255, 255, 0.4)",
    image       : "",
    fontawesome : "fa fa-cog fa-spin"
  });


  $.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="token"]').attr('value')
    }
 });

  console.log(formData)

  $.ajax({
      url: "{{url('/api/add_file_version_edit')}}",
      headers: {'X-CSRF-TOKEN': '{{ csrf_token() }}' },
      data: formData,
      processData: false,
      contentType: false,
      cache:false,
      type: 'POST',
      success: function (data) {

      //  console.log(data.data.status)
          if(data.data.status == 200){


            setTimeout(function(){
                $.LoadingOverlay("hide");
            }, 0);

            swal("สำเร็จ!", "ข้อความถูกส่งไปหาเจ้าหน้าที่เรียบร้อยแล้ว", "success");

            $("#name").val('');
            $("#comments").val('');
            $("#email").val('');
            $("#subject").val('');


          setTimeout(function(){
                window.location.replace("{{url('admin/get_file_version/')}}/");
          }, 2000);

          }else{

            setTimeout(function(){
                $.LoadingOverlay("hide");
            }, 500);

            swal("กรูณา ป้อนข้อมูลให้ครบถ้วน");

          }
      },
      error: function () {

      }
  });

}


});

</script>


@stop('scripts')