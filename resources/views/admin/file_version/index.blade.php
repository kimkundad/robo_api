@extends('admin.layouts.template')

@section('ga')
window.gaTitle = 'หน้าแรก';
@endsection

@section('stylesheet')
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.24/css/jquery.dataTables.min.css">
<style>

.table td img, .jsgrid .jsgrid-table td img, .table th img, .jsgrid .jsgrid-table th img {
    width: 300px;
    height: auto;
    border-radius: 0%;
}
</style>
@stop('stylesheet')

@section('content')

<div class="row">
                <div class="col-md-12">
                  <a href="{{ url('admin/get_file_version/create') }}" class="btn btn-success btn-fw" style="float:right"><i class="icon-plus"></i>เพิ่มไฟล์ version</a>
                  <br /><br />
                </div>
                <div class="col-md-12 grid-margin stretch-card">
                  <div class="card">
                    <div class="card-body">
                      <h4 class="card-title">Firmware version</h4>

                      <div class="table-responsive">

                      <table class="table" id="datatable">
                        <thead>
                          <tr>
                            <th>#</th>
                            <th>วันที่อัปโหลด</th>
                            <th>ชื่อไฟล์ (Version)</th>
                            <th>ประเภทอุปกรณ์</th>
                            <th>ดำเนินการ</th>
                          </tr>
                        </thead>
                        <tbody>
                      
                            
                        

                        </tbody>
                      </table>

                      </div>
					 
                    </div>
                  </div>
                </div>

              
              </div>
              <br><br><br><br><br><br><br><br>


@endsection

@section('scripts')
<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script>
<script>

$(document).ready(function(){

  $.ajax({
        url: "https://iot-test.promptrub.com/api/v1/version_control?Page=1&PageSize=10",
        method:'GET',
        success: function (data) {

          $('#datatable tr').not(':first').not(':last').remove();
            var html = '';
            var num_var = 1;
            for(var i = 0; i < data.items.length; i++){
             
                html += '<tr>'+
                            '<td>' + num_var + '</td>' +
                            '<td>' + data.items[i].date_create + '</td>' +
                            '<td>' + data.items[i].name + '</td>' +
                            '<td> ประเภทอุปกรณ์ </td>' +
                            '<td><a href="{{url('/')}}/admin/del_file_version/'+ data.items[i].id +'" style="margin-right:5px;" class="btn btn-outline-primary btn-sm">ดาวน์โหลด</a>'+
                            '<a href="{{url('/')}}/admin/del_file_version/'+ data.items[i].id +'" class="btn btn-outline-danger btn-sm">ลบ</a></td>' +
                        '</tr>';
                        num_var++;
                }   
            $('#datatable tr').first().after(html);

          
        },
        error: function (data) {
        }
      });

	$("input.checkbox").change(function(event) {

	var course_id = $(this).closest('tr').attr('access_id');

	console.log('fea : '+course_id);
	$.ajax({
					type:'POST',
					url:'{{url('api/get_file_version_status')}}',
					headers: {'X-CSRF-TOKEN': '{{ csrf_token() }}' },
					data: { "user_id" : course_id },
					success: function(data){
						if(data.data.success){


              $.toast({
                heading: 'Success',
                text: 'ระบบทำการแก้ไขข้อมูลให้แล้ว.',
                showHideTransition: 'slide',
                icon: 'success',
                loaderBg: '#f96868',
                position: 'top-right'
              })



						}
					}
			});
	});

  	});

</script>


@stop('scripts')