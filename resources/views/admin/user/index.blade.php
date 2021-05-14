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
                
                
                <div class="col-md-12 grid-margin stretch-card">
                  <div class="card">
                    <div class="card-body">
                      <h4 class="card-title">ผู้ใช้งานทั้งหมด ( {{ count($objs)-2 }} )</h4>

                      <div class="table-responsive">


                      <table class="table">
                        <thead>

                          <tr>
                            <th>บัญชีผู้ใช้</th>
                            <th>ชื่อ-นามสกุล</th>
							<th>อีเมล</th>
                            <th>เบอร์โทร</th>
                            <th>อายุ</th>
                            <th>เพศ</th>
                            <th>วันที่สมัคร</th>
                            <th>ดำเนินการ</th>
                          </tr>
                        </thead>
                        <tbody>
                      
						@if(isset($objs))
                      @foreach($objs as $u)
                          @if($u->id != 1 && $u->id != 2)
                          <tr>
                            <td>
                            @if($u->provider == 'email')
                            <img src="{{ url('assets/img/avatar/'.$u->avatar) }}" alt="{{$u->name}}"> 
                            @else
                            <img src="{{ url($u->avatar) }}" alt="{{$u->name}}"> 
                            @endif
                            {{$u->name}}</td>
                            <td>
                              {{$u->first_name}} {{$u->last_name}}
                            </td>
                            <td>
                              {{$u->email}}
                            </td>
							<td>
                              {{$u->phone}}
                            </td>
                            <td>
                              {{$u->age}}
                            </td>
                            <td>
                              @if($u->sex == 0)
                              ไม่ระบุ
                              @elseif($u->sex == 1)
                              ไม่ระบุ
                              @elseif($u->sex == 2)
                              ชาย
                              @else
                              หญิง
                              @endif
                            </td>
                            <td>
                              {{formatDateThat($u->created_at)}}
                            </td>
                            <td>
                              <a href="{{ url('admin/user/'.$u->id.'/edit') }}" class="btn btn-outline-primary btn-sm">แก้ไข</a>
                              <a href="{{ url('api/del_user/'.$u->id) }}" onclick="return confirm('Are you sure?')" class="btn btn-outline-danger btn-sm">ลบ</a>
                            </td>
                          </tr>
                          @endif

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