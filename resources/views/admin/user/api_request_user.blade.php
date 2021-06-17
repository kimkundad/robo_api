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
                              <form class="form-horizontal" action="{{url('admin/api_request_search')}}" method="GET" enctype="multipart/form-data">
                                {{ csrf_field() }}
                                <div class="input-group">
                                    <input type="text" class="form-control" name="search" placeholder="ชื่อ - นามสกุล, ร้านค้า" aria-label="Recipient's username">
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

                    
                      <h4 class="card-title">ข้อมูล API ทั้งหมด ( {{ count($objs) }} )</h4>

                      <div class="table-responsive">
                      <table class="table">
                        <thead>

                          <tr>
                          <th>#</th>
                            <th>ชื่อบริษัท / ร้านค้า</th>
                            <th>ชื่อ-นามสกุล</th>
						              	<th>สถานะ</th>
                            <th>เบอร์โทร</th>
                            <th>วันที่สมัคร</th>
                            <th>ดำเนินการ</th>
                          </tr>
                        </thead>
                        <tbody>
                      
						          @if(isset($objs))
                        @foreach($objs as $index => $u)
                         
                          <tr>
                          <td>
                          {{ ( $currentPage - 1 ) * $perPage + $index + 1 }}
                            </td>
                            <td>
                              {{$u->api_name}}
                            </td>
                            <td>
                            @if($u->provider == 'email')
                            <img src="{{ url('assets/img/avatar/'.$u->avatar) }}" > 
                            @else
                            <img src="{{ url($u->avatar) }}" > 
                            @endif
                            {{$u->first_name}} {{$u->last_name}}</td>
                            <td>
                            @if($u->status_v2 == 0)
                                <p class="mt-2 text-warning font-weight-bold">รอการตรวจสอบ</p>
                            @else
                                <p class="mt-2 text-success font-weight-bold">พร้อมใช้งาน</p>
							              @endif
                            </td>
							                <td>
                              {{$u->phone1}}
                            </td>
                            <td>
                            {{formatDateThat($u->create)}}
                            </td>
                            <td>
                              <a href="{{ url('admin/edit_api_request_user/'.$u->idb) }}" class="btn btn-outline-primary btn-sm">แก้ไข</a>
                              <a href="{{ url('api/del_api_request_user/'.$u->idb) }}" onclick="return confirm('Are you sure?')" class="btn btn-outline-danger btn-sm">ลบ</a>
                            </td>
                          </tr>
                    

                          @endforeach
                          @endif


                        </tbody>
                      </table>
                      </div>
					            {{ $objs->links() }}
                    </div>
                  </div>
                </div>


              </div>



@endsection

@section('scripts')




@stop('scripts')