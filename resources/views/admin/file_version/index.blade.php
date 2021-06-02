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
                      <h4 class="card-title">ไฟล์ version ทั้งหมด</h4>

                      <div class="table-responsive">

                      <table class="table" id="datatable">
                        <thead>
                          <tr>
                            <th>ชื่อไฟล์</th>
                            <th>Version</th>
                            <th>วันที่สร้าง</th>
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
        url: "{{ url('api/get_file_version') }}",
        method:'GET',
        success: function (data) {

          $('#datatable tr').not(':first').not(':last').remove();
            var html = '';
            for(var i = 0; i < data.length; i++){
                html += '<tr>'+
                            '<td>' + data[i].name + '</td>' +
                            '<td>' + data[i].version + '</td>' +
                            '<td>' + data[i].date_create + '</td>' +
                            '<td><a href="#" class="btn btn-outline-primary btn-sm" style="margin-right:5px;">แก้ไข</a>' +
                            '<a href="#" class="btn btn-outline-danger btn-sm">ลบ</a></td>' +
                        '</tr>';
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