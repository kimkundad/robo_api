@extends('admin.layouts.template')

@section('stylesheet')

<style>
.table td, .jsgrid .jsgrid-table td, .table th, .jsgrid .jsgrid-table th {
    font-size: 12px;
}
.table td img{
  margin-right:5px;
}
</style>
@stop('stylesheet')

@section('content')



<div class="row">
                
                <div class="col-md-6">
                    
                            <div class="form-group">
                              <form class="form-horizontal" action="{{ url('admin/users') }}" method="GET" enctype="multipart/form-data">
                                  {{ csrf_field() }}
                                <div class="input-group">
                                    <input type="text" class="form-control" name="search" value="{{ $search }}" placeholder="ชื่อ-นามสกุล, อีเมล, เบอร์โทร" aria-label="Recipient's username">
                                    <div class="input-group-append">
                                      <button class="btn btn-sm btn-primary" type="submit">ค้นหา</button>
                                    </div>
                                  </div>
                                </form>
                            </div>
                       
                </div>
                <div class="col-md-6"> </div>

                <div class="col-md-12 grid-margin stretch-card">
                  <div class="card">
                    <div class="card-body">
               
                      <h4 class="card-title">ผู้ใช้งานทั้งหมด ( {{ count($data_tatal) }} )</h4>

                      <div class="table-responsive">

                      <table class="table">
                        <thead>

                          <tr>
                            <th>#</th>
                            <th>บัญชีผู้ใช้</th>
                            <th>ชื่อ-นามสกุล</th>
							              <th>อีเมล</th>
                            <th>เบอร์โทร</th>
                            <th>เพศ</th>
                            <th>วันที่สมัคร</th>
                            <th>การใช้งาน</th>
                            <th>ดำเนินการ</th>
                          </tr>
                        </thead>
                        <tbody>
                    
						          @if(isset($data))
                        @foreach($data as $u)
                   
                          <tr access_id="{{$u['userId']}}">
                            <td>1</td>
                            <td>
                            @if($u['avatar'] == null)
                            <img src="{{ url('back/avatar/profile-pic.png') }}">  {{ $u['username'] }}
                            @else
                            <img src="{{ $u['avatar'] }}">  {{ $u['username'] }}
                            @endif
                              
                            </td>
                            <td>
                              {{$u['firstname']}} {{$u['lastname']}} 
                            </td>
                            <td>
                               {{$u['email']}}
                            </td>
							              <td>
                               {{$u['phoneNumber']}}
                            </td>
                            <td>
                              {{$u['gender']}}
                            </td>
                            <td>
                             {{$u['createdDate']}}
                            </td>
                            <td>
                            <label class="switch">
                                <input type="checkbox" class="checkbox"
                                @if($u['isActive'] == true)
                                checked
                                @endif
                                >
                                <span class="slider round"></span>
                            </label>
                            </td>
                            <td>
                              <a href="{{ url('admin/user/'.$u['userId'].'/edit') }}" class="btn btn-outline-primary btn-sm">ดู</a>
                            </td>
                          </tr>
                       
                          @endforeach
                          @endif


                        </tbody>
                      </table>
                      </div>
                      <hr>
                      <div class="row">
                        <div class="col-6 d-flex"><p class="mar-r-5">ดู</p> 
                        <form class="forms-sample" method="GET" action="{{ url('admin/users') }}" enctype="multipart/form-data">
                          {{ csrf_field() }}
                            <select class="form-control mar-r-5" name="totalshow" onchange="this.form.submit()" style="width:80px;">
                              <option value="10">10</option>
                              <option value="20">20</option>
                              <option value="50">50</option>
                              <option value="100">100</option>
                            </select> 
                        </form>
                            <p class="mar-r-5">รายการต่อหน้า </p> 
                            <small class="text-muted mar-r-5">{{ $data->currentPage() }}-{{ $data->lastPage() }} รายการ จาก {{ $data->lastPage() }} รายการ</small>
                        </div>
                        <div class="col-6">
                          <nav class="pull-right">
                            @if ($data->lastPage() > 1)
                            <ul class="pagination">
                                <li class="page-item {{ ($data->currentPage() == 1) ? ' disabled' : '' }}">
                                    <a class="page-link" href="{{ url('/admin/user').$data->url(1) }}">Previous</a>
                                </li>
                                @for ($i = 1; $i <= $data->lastPage(); $i++)
                                    <li class="page-item {{ ($data->currentPage() == $i) ? ' active' : '' }}">
                                        <a class="page-link" href="{{ url('/admin/user').$data->url($i) }}">{{ $i }}</a>
                                    </li>
                                @endfor
                                <li class="page-item {{ ($data->currentPage() == $data->lastPage()) ? ' disabled' : '' }}">
                                    <a class="page-link" href="{{ url('/admin/user').$data->url($data->currentPage()+1) }}" >Next</a>
                                </li>
                            </ul>
                            @endif
                          </nav>
                        </div>
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
        type:'PUT',
        url:'https://siamtheatre.com/api/v1/user_control/'+course_id+'/toggle_active',
        data: { "user_id" : course_id },
        success: function(data){
          if(data.status == 204){

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