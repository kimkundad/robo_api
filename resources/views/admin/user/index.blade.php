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
                <div class="col-md-6"> </div>
                <div class="col-md-6">
                    
                            <div class="form-group">
                              <form class="form-horizontal" action="{{url('admin/user_search')}}" method="GET" enctype="multipart/form-data">
                                  {{ csrf_field() }}
                                <div class="input-group">
                                    <input type="text" class="form-control" name="search" placeholder="ชื่อ - นามสกุล, อีเมล, เบอร์ติดต่อ" aria-label="Recipient's username">
                                    <div class="input-group-append">
                                      <button class="btn btn-sm btn-primary" type="submit">ค้นหา</button>
                                    </div>
                                  </div>
                                </form>
                            </div>
                       
                </div>

                <div class="col-md-12 grid-margin stretch-card">
                  <div class="card">
                    <div class="card-body">
                      <h4 class="card-title">ผู้ใช้งานทั้งหมด ( {{ $count }} )</h4>

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
                            <th>ดำเนินการ</th>
                          </tr>
                        </thead>
                        <tbody>
                      
						@if(isset($objs))
                      @foreach($objs as $index => $u)
                      
                          <tr>
                            <td>{{ ( $currentPage - 1 ) * $perPage + $index + 1 }}</td>
                            <td>
                            {{$u['username']}}
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
                              <a href="{{ url('admin/user/edit') }}" class="btn btn-outline-primary btn-sm">แก้ไข</a>
                              <a href="{{ url('api/del_user/') }}" onclick="return confirm('Are you sure?')" class="btn btn-outline-danger btn-sm">ลบ</a>
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





@stop('scripts')