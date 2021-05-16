@extends('admin.layouts.template')

@section('stylesheet')

<style>
.table td, .jsgrid .jsgrid-table td, .table th, .jsgrid .jsgrid-table th {
    font-size: 12px;
}
</style>
@stop('stylesheet')

@section('content')



<div class="row">
                
                <div class="col-md-12">
                  <a href="{{ url('admin/bank/create') }}" class="btn btn-success btn-fw" style="float:right"><i class="icon-plus"></i>เพิ่มธนาคาร</a>
                  <br /><br />
                </div>
                <div class="col-md-12 grid-margin stretch-card">
                  <div class="card">
                    <div class="card-body">
                      <h4 class="card-title">ธนาคารที่อยู่ในระบบ ( {{ count($objs) }} )</h4>

                      <div class="table-responsive">


                      <table class="table">
                        <thead>

                          <tr>
                            <th>#</th>
                            <th>ธนาคาร</th>
                            <th>จำนวนผู้ใช้งาน</th>
                            <th>เปิดใช้งาน</th>
                            <th>วันที่สร้าง</th>
                            <th>ดำเนินการ</th>
                          </tr>
                        </thead>
                        <tbody>
                      
						@if(isset($objs))
                      @foreach($objs as $u)
                     
                          <tr access_id="{{$u->id}}">
                            <td>
                            <img src="{{ url('img/bank/'.$u->bank_img) }}" alt="{{$u->name_bank}}"> </td>
                            <td>
                              {{$u->name_bank}} 
                            </td>
                            <td>
                            {{ $u->option }}
                            </td>
                            <td>
                              <div class="form-check form-check-flat">
                              <label class="form-check-label">
                                <input class="checkbox" type="checkbox" @if($u->bank_status == 1)
                                  checked="checked"
                                  @endif>
                                ปิด / เปิด
                              </label>
                            </div>
                            </td>
                            
                            <td>
                              {{formatDateThat($u->created_at)}}
                            </td>
                            <td>
                              <a href="{{ url('admin/bank/'.$u->id.'/edit') }}" class="btn btn-outline-primary btn-sm">แก้ไข</a>
                              <a href="{{ url('api/del_bank/'.$u->id) }}" onclick="return confirm('Are you sure?')" class="btn btn-outline-danger btn-sm">ลบ</a>
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
        url:'{{url('api/bank_status')}}',
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