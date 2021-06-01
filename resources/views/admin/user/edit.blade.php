@extends('admin.layouts.template')

@section('ga')
window.gaTitle = 'หน้าแรก';
@endsection

@section('stylesheet')
<style>

.profile-page .profile-header {
    width: 100%;
    background: url('{{ url('img/Upgrafe-banner@2x.png') }}') no-repeat center center;
    background-size: cover;
    padding: 60px 0;
    border-radius: 5px;
}
.hidden{
  display:none;
}
.card-title{
  font-size:16px;
  margin-top:30px;
}
.table thead th, .jsgrid .jsgrid-table thead th {
    font-size: 13px;
}
</style>
@stop('stylesheet')

@section('content')


          <div class="row profile-page">
            <div class="col-12">
              <div class="card">
                <div class="card-body">
                  <div class="profile-header text-white">
                    <div class="d-md-flex justify-content-around">


                      <div class="profile-info d-flex align-items-center">
                        @if($objs->provider == 'email')
                          <img class="rounded-circle img-lg" src="{{ url('assets/img/avatar/'.$objs->avatar) }}" alt="{{$objs->name}}">
                        @else
                          <img class="rounded-circle img-lg" src="{{ url($objs->avatar) }}" alt="{{$objs->name}}">
                        @endif
                        <div class="wrapper pl-4">
                          <p class="profile-user-name">{{ $objs->name }} (บัญชีผู้ใช้งาน)</p>
                          <div class="wrapper d-flex align-items-center">
                            <p class="profile-user-designation">{{ $objs->first_name }} {{ $objs->last_name }}</p>
                          </div>
                        </div>
                      </div>


                      <div class="details">
                        <div class="detail-col">
                          <p>Biller_ID</p>
                          <p>{{ count($bill) }}</p>
                        </div>
                        <div class="detail-col">
                          <p>Bank_Acc.</p>
                          <p>0</p>
                        </div>
                      </div>


                    </div>
                  </div>

                  

                  <div class="profile-body">
                    <ul class="nav tab-switch" role="tablist">
                      <li class="nav-item">
                        <a class="nav-link active" id="user-profile-info-tab" data-toggle="pill" href="#user-profile-info" role="tab" aria-controls="user-profile-info" aria-selected="true">บัญชีผู้ใช้งาน</a>
                      </li>
                      <li class="nav-item">
                        <a class="nav-link" id="user-profile-activity-tab" data-toggle="pill" href="#user-profile-activity" role="tab" aria-controls="user-profile-activity" aria-selected="false">ฺBiller ID</a>
                      </li>
                      <li class="nav-item">
                        <a class="nav-link" id="user-profile-activity-tab2" data-toggle="pill" href="#user-profile-activity2" role="tab" aria-controls="user-profile-activity2" aria-selected="false">ฺLog</a>
                      </li>
                      <li class="nav-item">
                        <a class="nav-link">Bank</a>
                      </li>
                      <li class="nav-item">
                        <a class="nav-link">Company</a>
                      </li>
                      <li class="nav-item">
                        <a class="nav-link">Address</a>
                      </li>
                    </ul>

                    <div class="row">
                      <div class="col-md-12">
                        <div class="tab-content tab-body" id="profile-log-switch">
                          <div class="tab-pane fade show active pr-3" id="user-profile-info" role="tabpanel" aria-labelledby="user-profile-info-tab">



              <br>
              <form class="forms-sample" method="POST" action="{{$url}}" enctype="multipart/form-data">
                {{ method_field($method) }}
                {{ csrf_field() }}
                <br>
                  <div class="row">

                  <div class="col-md-6">
                        <div class="form-group row">
                          <label class="col-sm-3 col-form-label">บัญชีผู้ใช้งาน</label>
                          <div class="col-sm-9">
                            <input type="text" class="form-control" name="name" value="{{ $objs->name }}">
                          </div>
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-group row">
                          <label class="col-sm-3 col-form-label">อายุ</label>
                          <div class="col-sm-9">
                            <input type="text" class="form-control" value="{{ $objs->age }}" name="age" readonly>
                          </div>
                        </div>
                      </div>
                    
                      <div class="col-md-6">
                        <div class="form-group row">
                          <label class="col-sm-3 col-form-label">ชื่อจริง</label>
                          <div class="col-sm-9">
                            <input type="text" class="form-control" value="{{ $objs->first_name }}" name="first_name">
                          </div>
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-group row">
                          <label class="col-sm-3 col-form-label">นามสกุล</label>
                          <div class="col-sm-9">
                            <input type="text" class="form-control" value="{{ $objs->last_name }}" name="last_name">
                          </div>
                        </div>
                      </div>


                      <div class="col-md-6">
                        <div class="form-group row">
                          <label class="col-sm-3 col-form-label">อีเมล</label>
                          <div class="col-sm-9">
                            <input type="text" class="form-control" value="{{ $objs->email }}" name="email" readonly>
                          </div>
                        </div>
                      </div>

                      <div class="col-md-6">
                        <div class="form-group row">
                          <label class="col-sm-3 col-form-label">เบอร์โทร</label>
                          <div class="col-sm-9">
                            <input type="text" class="form-control" value="{{ $objs->phone }}" name="phone">
                          </div>
                        </div>
                      </div>

                      <div class="col-md-6">
                        <div class="form-group row">
                          <label class="col-sm-3 col-form-label">วันเกิด</label>
                          <div class="col-sm-9">
                          <div id="datepicker-popup" class="input-group date datepicker">
                                <input type="text" class="form-control" name="hbd" value="{{ $objs->hbd }}"> 
                                <span class="input-group-addon input-group-append border-left">
                                <span class="icon-calendar input-group-text"></span>
                                </span>
                            </div>
                          </div>
                        </div>
                      </div>

                    <div class="col-md-6">
                        <div class="form-group row">
                          <label class="col-sm-3 col-form-label">อาชีพ</label>
                          <div class="col-sm-9">
                            <select class="form-control" name="career">
                                    @if($objs->career != null)
                                    <option value="{{ $objs->career }}" selected='selected'> {{ $objs->career }} </option>
                                    @endif
                                    <option value="" > เลือกอาชีพ </option>
									<option value=" ข้าราชการ/รัฐวิสาหกิจ"> ข้าราชการ/รัฐวิสาหกิจ </option>
									<option value="นักเรียน/นักศึกษา"> นักเรียน/นักศึกษา </option>
									<option value="รับจ้าง/อิสระ"> รับจ้าง/อิสระ </option>
                                    <option value="เกษตรกรรม/ประมง"> เกษตรกรรม/ประมง </option>
                                    <option value="พนักงานบริษัท"> พนักงานบริษัท </option>
                                    <option value=" ค้าขาย/ธุรกิจส่วนตัว/เจ้าของกิจการ">  ค้าขาย/ธุรกิจส่วนตัว/เจ้าของกิจการ </option>
                            </select>
                          </div>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group row">
                          <label class="col-sm-3 col-form-label">เพศ</label>
                          <div class="col-sm-9">
                            <select class="form-control" name="sex">
                                    
                                    @if($objs->sex != null)
                                    <option value="{{ $objs->sex }}" selected='selected'> ไม่ระบุ </option>
                                    @endif

									        <option value="1" 
                                    @if($objs->sex == 1)
                                    selected='selected'
                                    @endif
                                    > ไม่ระบุ </option>
									          <option value="2" @if($objs->sex == 2)
                                    selected='selected'
                                    @endif> ชาย </option>
                                    <option value="3" @if($objs->sex == 3)
                                    selected='selected'
                                    @endif> หญิง </option>
                            </select>
                          </div>
                        </div>
                    </div>


                    <div class="col-md-6">
                        <div class="form-group row">
                          <label class="col-sm-3 col-form-label">user code</label>
                          <div class="col-sm-9">
                            <input type="text" class="form-control" value="{{ $objs->code_user }}" name="code_user">
                            <p class="text-danger">(*ไม่ต้องสนใจ ห้ามยุ่ง dev รู้พอ)</p>
                          </div>
                        </div>
                      </div>


                    </div>

        

        
        


        <div style="text-align: right;">
        <br /><br /><br />
        <button type="submit" class="btn btn-primary mr-2">บันทึก</button>
        <button class="btn btn-light">ยกเลิก</button>
        </div>

      </form>
                            
                            

                            
                          </div>
                          <div class="tab-pane fade" id="user-profile-activity" role="tabpanel" aria-labelledby="user-profile-activity-tab">

                          <div>
                          <a href="{{ url('admin/create_biller_id/'.$objs->id) }}" class="btn btn-success btn-fw" style="float:right"><i class="icon-plus"></i>เพิ่ม Biller ID ใหม่</a>
                          <h4 class="card-title">Biller ID ทั้งหมด ( {{ count($bill) }} )</h4>

                      <div class="table-responsive">
                      <table class="table">
                        <thead>

                          <tr>
                          <th>#</th>
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
                      
						          @if(isset($bill))
                        @foreach($bill as $index => $u)
                         
                          <tr>
                          <td>
                          {{ ( $currentPage - 1 ) * $perPage + $index + 1 }}
                            </td>
                            <td>
                              {{$u->name_bank}}
                            </td>
                            <td>
                            @if($u->provider == 'email')
                            <img src="{{ url('assets/img/avatar/'.$u->avatar) }}" > 
                            @else
                            <img src="{{ url($u->avatar) }}" > 
                            @endif
                            {{$u->first_name}} {{$u->last_name}}</td>

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
                            {{formatDateThat($u->create)}}
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
					            {{ $bill->links() }}
                      </div>
                            
                          </div>

                          <div class="tab-pane fade" id="user-profile-activity2" role="tabpanel" aria-labelledby="user-profile-activity-tab2">

                          <div>
                          <h4 class="card-title">ความเคลื่อนไหวทั้งหมด ทั้งหมด ( {{ count($log) }} )</h4>
                          <br>
                          <div class="table-responsive">
                              <table class="table">
                                  <tbody>
                                  @if(isset($log))
                                    @foreach($log as $u)
                                      <tr>
                                      @if($u->status == 1)
                                      <td>User Login</td>
                                      @elseif($u->status == 2)
                                      <td>User Logout</td>
                                      @else
                                      <td>User Register</td>
                                      @endif
                                      <td>{{$u->detail}}</td>
                                      <td>{{$u->ip_address}}</td>
                                      <td>{{$u->browser}}</td>
                                      <td>{{$u->create}}</td>
                                      </tr>
                                    @endforeach
                                  @endif
                                  </tbody>
                              </table>
                          </div>
                          {{ $log->links() }}
                          </div>
                          </div>


                        </div>
                      </div>
                      
                      
                    </div>

                  </div>


                </div>
              </div>
            </div>
          </div>




<div class="row hidden">
            <div class="col-md-4 grid-margin stretch-card">
							<div class="card">
								<div class="card-body">
									<div class="d-flex flex-row">
                                    <div class="bg-warning px-4 py-2 rounded" style="padding-top:28px !important;">
												<i class="icon-wallet text-white icon-lg"></i>
											</div>
										<div class="ml-3">
											<h6>เพิ่ม Biller ID ใหม่</h6>
											<p class="text-muted">Biller ID ใหม่ต่างธนาคารที่มีอยู่</p>
											<a class="add btn btn-primary font-weight-bold " href="{{ url('admin/create_biller_id/'.$objs->id) }}">Create Biller ID</a>
										</div>
									</div>
								</div>
							</div>
						</div>

            

            

            


<div class="col-md-12">

  <div class="card">
    <div class="card-body">
    
    

      
    </div>
  </div>
  </div>

            <div class="col-md-12 grid-margin stretch-card" style="margin-top:15px">
            
							<div class="card">
              
								<div class="card-body">
									<h4 class="card-title">Updates</h4>

                    
								</div>
                
							</div>
						</div>


</div>




<br><br><br><br><br><br><br><br>



@endsection

@section('scripts')


<script>




</script>
@stop('scripts')