@extends('admin.layouts.template')

@section('ga')
window.gaTitle = 'หน้าแรก';
@endsection

@section('stylesheet')
<style>


</style>
@stop('stylesheet')

@section('content')



<div class="row">
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

            

            @if(isset($bill))
            @foreach($bill as $u)
            <div class="col-md-4 grid-margin stretch-card">
              
							<div class="card">
              <a href="{{ url('admin/edit_biller_id/'.$u->idb) }}" style="text-decoration:none">
								<div class="card-body">
									<div class="d-flex flex-row">
										<img src="{{ url('img/bank/'.$u->bank_img) }}" class="img-lg rounded" >
										<div class="ml-3">
											<h6>{{ $u->biller_id }}</h6>
											<p class="text-muted">{{ $u->name_bank }}</p>
                                                        @if( $u->process == 0)
                                                        <p class="mt-2 text-warning font-weight-bold">เจ้าหน้าที่ติดต่อกลับ</p>
                                                        @elseif($u->process == 1)
                                                        <p class="mt-2 text-info font-weight-bold">ส่งเรื่องให้กับธนาคาร</p>
                                                        @elseif($u->process == 2)
                                                        <p class="mt-2 text-success font-weight-bold">ผ่าน</p>
                                                        @else
                                                        <p class="mt-2 text-danger  font-weight-bold">ไม่ผ่าน</p>
														                            @endif
										</div>
									</div>
								</div>
                </a>
							</div>
              
						</div>
            @endforeach
            @endif

            


<div class="col-md-12">

  <div class="card">
    <div class="card-body">
    
    

      <h4 class="card-title">บัญชีผู้ใช้งาน : {{ $objs->name }}</h4>
     
     

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
  </div>
  </div>

            <div class="col-md-6 grid-margin stretch-card" style="margin-top:15px">
            
							<div class="card">
              
								<div class="card-body">
									<h4 class="card-title">Updates</h4>
									<ul class="bullet-line-list">
                  @if(isset($log))
                      @foreach($log as $u)
										<li>
                      @if($u->status == 1)
											<h6>User Login</h6>
                      @elseif($u->status == 2)
                      <h6>User Logout</h6>
                      @else
                      <h6>User Register</h6>
                      @endif
											<p class="mb-0">{{$u->detail}} </p>
                      <p class="mb-0 text-muted">ip_address : {{$u->ip_address}} </p>
                      <p class="mb-0 text-muted">browser : {{$u->browser}} </p>
											<p class="text-muted">
												<i class="icon-clock"></i>
												{{$u->created_at}}
											</p>
										</li>
										
                    @endforeach
                          @endif
									</ul>
                  {{ $log->links() }}
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