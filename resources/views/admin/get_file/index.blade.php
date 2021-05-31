@extends('admin.layouts.template')

@section('ga')
window.gaTitle = 'หน้าแรก';
@endsection

@section('stylesheet')
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
                  <a href="{{ url('admin/get_file/create') }}" class="btn btn-success btn-fw" style="float:right"><i class="icon-plus"></i>เพิ่ม ไฟล์เอกสาร</a>
                  <br /><br />
                </div>
                <div class="col-md-12 grid-margin stretch-card">
                  <div class="card">
                    <div class="card-body">
                      <h4 class="card-title">ไฟล์เอกสาร ทั้งหมด</h4>

                      <div class="table-responsive">

                      <table class="table">
                        <thead>
                          <tr>
                            <th>หมวดหมู่</th>
                            <th>ไฟล์เอกสาร</th>
                            <th>ขนาด</th>
                            <th>ใช้งาน</th>
							<th>วันที่</th>
                            <th>ดำเนินการ</th>
                          </tr>
                        </thead>
                        <tbody>
                      
						@if(isset($objs))
                      @foreach($objs as $u)
                          <tr access_id="{{$u->idg}}">
                            <td>
                            {{$u->cat_name}}
                            </td>
                            <td>
                            {{$u->file_name}}
                            </td>
                            <td>
                            {{$u->file_size}}
                            </td>
                            <td>
                              <div class="form-check form-check-flat">
                              <label class="form-check-label">
                                <input class="checkbox" type="checkbox" @if($u->statusg == 1)
                                  checked="checked"
                                  @endif>
                                ปิด / เปิด
                              </label>
                            </div>
                            </td>
						                <td>
                            {{formatDateThat($u->create)}}
                            </td>
                            <td>
                              <a href="{{ url('admin/get_file/'.$u->idg.'/edit') }}" class="btn btn-outline-primary btn-sm">แก้ไข</a>
                              <a href="{{ url('api/del_get_file/'.$u->idg) }}" onclick="return confirm('Are you sure?')" class="btn btn-outline-danger btn-sm">ลบ</a>
                            </td>
                          </tr>
                          @endforeach
                          @endif

                        </tbody>
                      </table>
                      </div>
					 
                    </div>
                  </div>
                </div>


              </div>



@endsection

@section('scripts')

<script>

$(document).ready(function(){


	$("input.checkbox").change(function(event) {

	var course_id = $(this).closest('tr').attr('access_id');

	console.log('fea : '+course_id);
	$.ajax({
					type:'POST',
					url:'{{url('api/get_file_status')}}',
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