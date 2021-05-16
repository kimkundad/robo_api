@extends('admin.layouts.template')

@section('ga')
window.gaTitle = 'หน้าแรก';
@endsection

@section('stylesheet')
<style>

.card-description {
    margin-bottom: 0.9375rem;
    margin-top: 0.9375rem;
    color:#999;
}
</style>
@stop('stylesheet')

@section('content')



<div class="row">

<div class="col-md-6 grid-margin">
							<div class="card">
								<div class="card-body">
									<h4 class="card-title mb-0">สร้าง Biller ID</h4>
                                    <br>
									<div class="d-flex justify-content-between align-items-center">
                                    <div class="d-flex flex-row">
                                        @if($objs->provider == 'email')
                                        <img src="{{ url('assets/img/avatar/'.$objs->avatar) }}" class="img-lg rounded" alt="{{$objs->name}}"> 
                                        @else
                                        <img src="{{ url($objs->avatar) }}" class="img-lg rounded" alt="{{$objs->name}}"> 
                                        @endif
										<div class="ml-3">
											<h6>{{ $objs->name }}</h6>
											<p class="text-muted">{{ $objs->email }}</p>
											<p class="mt-2 text-success font-weight-bold">{{ $objs->code_user }}</p>
										</div>
									</div>
										<div class="d-inline-block">
											<div class="bg-warning px-4 py-2 rounded">
												<i class="icon-wallet text-white icon-lg"></i>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>          



<div class="col-md-12 grid-margin">

  <div class="card">
    <div class="card-body">
      
    <h4 class="card-title mb-0">ข้อมูลผู้ใช้งาน</h4>
     
    <br>
        <br>
        
                    <div class="row">

                    <div class="col-md-6">
                        <div class="form-group row">
                          <label class="col-sm-3 col-form-label">บัญชีผู้ใช้งาน</label>
                          <div class="col-sm-9">
                            <input type="text" class="form-control"  value="{{ $objs->name }}" readonly>
                          </div>
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-group row">
                          <label class="col-sm-3 col-form-label">อายุ</label>
                          <div class="col-sm-9">
                            <input type="text" class="form-control" value="{{ $objs->age }}"  readonly>
                          </div>
                        </div>
                      </div>
                    
                      <div class="col-md-6">
                        <div class="form-group row">
                          <label class="col-sm-3 col-form-label">ชื่อจริง</label>
                          <div class="col-sm-9">
                            <input type="text" class="form-control" value="{{ $objs->first_name }}" readonly>
                          </div>
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-group row">
                          <label class="col-sm-3 col-form-label">นามสกุล</label>
                          <div class="col-sm-9">
                            <input type="text" class="form-control" value="{{ $objs->last_name }}" readonly>
                          </div>
                        </div>
                      </div>


                      <div class="col-md-6">
                        <div class="form-group row">
                          <label class="col-sm-3 col-form-label">อีเมล</label>
                          <div class="col-sm-9">
                            <input type="text" class="form-control" value="{{ $objs->email }}"  readonly>
                          </div>
                        </div>
                      </div>

                      <div class="col-md-6">
                        <div class="form-group row">
                          <label class="col-sm-3 col-form-label">เบอร์โทร</label>
                          <div class="col-sm-9">
                            <input type="text" class="form-control" value="{{ $objs->phone }}" readonly>
                          </div>
                        </div>
                      </div>

                      <div class="col-md-6">
                        <div class="form-group row">
                          <label class="col-sm-3 col-form-label">วันเกิด</label>
                          <div class="col-sm-9">
                          {{ $objs->hbd }}
                          </div>
                        </div>
                      </div>

                    <div class="col-md-6">
                        <div class="form-group row">
                          <label class="col-sm-3 col-form-label">อาชีพ</label>
                          <div class="col-sm-9">
                            <select class="form-control" readonly>
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
                            <select class="form-control" name="sex" readonly>
                                    
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

                    </div>

   
    </div>
  </div>
  </div>

  </div>      
           

    <div class="row">
        <div class="col-md-12 grid-margin">
                @if ($errors->has('f_name'))
                  <div class="alert alert-warning" role="alert">
                    กรุณากรอก ชื่อจริง ให้ครบ
                  </div>
                @endif
                @if ($errors->has('l_name'))
                  <div class="alert alert-warning" role="alert">
                    กรุณากรอก นามสกุล ให้ครบ
                  </div>
                @endif
                @if ($errors->has('email'))
                  <div class="alert alert-warning" role="alert">
                    กรุณากรอก อีเมล ให้ครบ
                  </div>
                @endif
                @if ($errors->has('phone'))
                  <div class="alert alert-warning" role="alert">
                    กรุณากรอก เบอร์โทร ให้ครบ
                  </div>
                @endif

                @if ($errors->has('company_name'))
                  <div class="alert alert-warning" role="alert">
                    กรุณากรอก ชื่อบริษัท
                  </div>
                @endif
                @if ($errors->has('company_type'))
                  <div class="alert alert-warning" role="alert">
                    กรุณากรอก ประเภทบริษัท
                  </div>
                @endif
                @if ($errors->has('business_type'))
                  <div class="alert alert-warning" role="alert">
                    กรุณากรอก ประเภทธุรกิจ หรือ สินค้าที่จำหน่าย
                  </div>
                @endif
                @if ($errors->has('id_card'))
                  <div class="alert alert-warning" role="alert">
                    กรุณากรอก เลขประจำตัวผู้เสียภาษี 
                  </div>
                @endif
                @if ($errors->has('bank_id'))
                  <div class="alert alert-warning" role="alert">
                    กรุณาเลือกธนาคารที่ต้องการผูกบัญชี
                  </div>
                @endif
        </div>
    </div>  
   

  <form class="forms-sample" method="POST" action="{{ url('api/add_new_biller_id') }}" enctype="multipart/form-data">
        {{ csrf_field() }}
  <div class="row">

    <div class="col-md-12 grid-margin">

        <div class="card">
            <div class="card-body">
                <h4 class="card-title mb-0">1. ข้อมูลผู้ติดต่อ</h4>
                <p class="card-description">
                    กรอกข้อมูลให้ครบ ในส่วนที่มีเครื่องหมาย <span class="text-danger">*</span>
                </p>
                <br>
                <div class="row">
                        
                    <div class="col-md-6">
                        <div class="form-group row">
                          <label class="col-sm-3 col-form-label">ชื่อจริง <span class="text-danger">*</span></label>
                          <div class="col-sm-9">
                            <input type="text" class="form-control" value="{{ old('f_name')  }}" name="f_name">
                            <input type="hidden" class="form-control" value="{{ $objs->code_user }}" name="user_id">
                          </div>
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-group row">
                          <label class="col-sm-3 col-form-label">นามสกุล <span class="text-danger">*</span></label>
                          <div class="col-sm-9">
                            <input type="text" class="form-control" value="{{ old('l_name') }}" name="l_name">
                          </div>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group row">
                          <label class="col-sm-3 col-form-label">อีเมล <span class="text-danger">*</span></label>
                          <div class="col-sm-9">
                            <input type="text" class="form-control" value="{{ old('email') }}" name="email" >
                          </div>
                        </div>
                      </div>

                      <div class="col-md-6">
                        <div class="form-group row">
                          <label class="col-sm-3 col-form-label">เบอร์โทร <span class="text-danger">*</span></label>
                          <div class="col-sm-9">
                            <input type="text" class="form-control" value="{{ old('phone') }}" name="phone">
                          </div>
                        </div>
                    </div>

                </div>

            </div>
        </div>
    </div>


    <div class="col-md-12 grid-margin">

        <div class="card">
            <div class="card-body">
                <h4 class="card-title mb-0">2. ข้อมูลบริษัท</h4>
                <p class="card-description">
                    กรอกข้อมูลให้ครบ ในส่วนที่มีเครื่องหมาย <span class="text-danger">*</span>
                </p>
                <br>
                <div class="row">
                        
                    <div class="col-md-12">
                        <div class="form-group row">
                          <label class="col-sm-3 col-form-label">ชื่อบริษัท <span class="text-danger">*</span></label>
                          <div class="col-sm-9">
                            <input type="text" class="form-control" value="{{ old('company_name')  }}" name="company_name">
                          </div>
                        </div>
                      </div>
                      <div class="col-md-12">
                        <div class="form-group row">
                          <label class="col-sm-3 col-form-label">เลขประจำตัวผู้เสียภาษี <span class="text-danger">*</span></label>
                          <div class="col-sm-9">
                            <input type="text" class="form-control" value="{{ old('id_card') }}" name="id_card">
                          </div>
                        </div>
                    </div>

                    <div class="col-md-12">
                        <div class="form-group row">
                          <label class="col-sm-3 col-form-label">ประเภทบริษัท <span class="text-danger">*</span></label>
                          <div class="col-sm-9">
                            <input type="text" class="form-control" value="{{ old('company_type') }}" placeholder="ประเภทบริษัท (เช่น อาหาร, เทคโนโลยี, ขนส่ง)" name="company_type" >
                          </div>
                        </div>
                      </div>

                      <div class="col-md-12">
                        <div class="form-group row">
                          <label class="col-sm-3 col-form-label">ประเภทธุรกิจ/สินค้าที่จำหน่าย <span class="text-danger">*</span></label>
                          <div class="col-sm-9">
                            <input type="text" class="form-control" value="{{ old('business_type') }}" name="business_type">
                          </div>
                        </div>
                    </div>

                </div>

            </div>
        </div>
    </div>



    <div class="col-md-12 grid-margin">

        <div class="card">
            <div class="card-body">
                <h4 class="card-title mb-0">3. เลือกธนาคารที่ต้องการสมัคร</h4>
                <p class="card-description">
                    กรอกข้อมูลให้ครบ ในส่วนที่มีเครื่องหมาย <span class="text-danger">*</span>
                </p>
            
                <div class="row">
                        
                    <div class="col-md-12">
                    <div class="form-group">

                        @if(isset($bank))
                        @foreach($bank as $u)
                          <div class="form-check">
                            <label class="form-check-label">
                              <input type="radio" class="form-check-input" name="bank_id" id="optionsRadios1" value="{{ $u->id }}">
                              {{ $u->name_bank }} 
                            <i class="input-helper"></i></label>
                          </div>
                          @endforeach
                          @endif
                          
                        </div>
                      </div>
                      
                      

                </div>

            </div>
        </div>

        
    </div>

    <div class="col-md-12 text-center">
    <br>
    <button type="submit" class="btn btn-primary btn-fw">บันทึก</button>
    <a href="{{ url('admin/user/'.$objs->id.'/edit') }}" class="btn btn-danger btn-fw" >ยกเลิก</a>

    </div>



</div>

</form>

<br><br><br><br><br><br><br><br><br><br><br><br>



@endsection

@section('scripts')


<script>




</script>
@stop('scripts')