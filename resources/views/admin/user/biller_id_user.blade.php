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
                      <h4 class="card-title">Biller ID ทั้งหมด ( {{ count($objs) }} )</h4>

                      <div class="table-responsive">


                      <table class="table">
                        <thead>

                          <tr>
                            <th>ชื่อธนาคาร</th>
                            <th>ชื่อ-นามสกุล</th>
							<th>สถานะ</th>
                            <th>เบอร์โทร</th>
                            <th>ชื่อบัญชี</th>
                            <th>Biller ID</th>
                            <th>วันที่สมัคร</th>
                            <th>ดำเนินการ</th>
                          </tr>
                        </thead>
                        <tbody>
                      
						@if(isset($objs))
                      @foreach($objs as $u)
                         
                          <tr>
                            <td>
                              {{$u->name_bank}}
                            </td>
                            <td>
                            @if($u->provider == 'email')
                            <img src="{{ url('assets/img/avatar/'.$u->avatar) }}" > 
                            @else
                            <img src="{{ url($u->avatar) }}" > 
                            @endif
                            {{$u->name}}</td>
                            <td>
                              {{$u->first_name}} {{$u->last_name}}
                            </td>
                            <td>
                             
                            @if($u->process == 0)
                                <p class="mt-2 text-warning font-weight-bold">เจ้าหน้าที่ติดต่อกลับ</p>
                            @elseif($u->process == 1)
                                <p class="mt-2 text-info font-weight-bold">ส่งเรื่องให้กับธนาคาร</p>
                            @elseif($u->process == 2)
                                <p class="mt-2 text-success font-weight-bold">ผ่าน</p>
                            @else
                                <p class="mt-2 text-danger  font-weight-bold">ไม่ผ่าน</p>
							              @endif
                            </td>
							                <td>
                              {{$u->phone1}}
                            </td>
                            <td>
                              {{$u->name_bank}}
                            </td>
                            <td>
                              {{$u->biller_id}}
                            </td>
                            <td>
                              {{$u->create}}
                            </td>
                            <td>
                              <a href="{{ url('admin/edit_biller_id/'.$u->idb) }}" class="btn btn-outline-primary btn-sm">แก้ไข</a>
                              <a href="{{ url('api/del_user_biller_id/'.$u->idb) }}" onclick="return confirm('Are you sure?')" class="btn btn-outline-danger btn-sm">ลบ</a>
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