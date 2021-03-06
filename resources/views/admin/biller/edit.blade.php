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
.dropify-wrapper {

    height: 90px;
    padding: 5px 10px;

}
.new-accounts ul.chats li.chat-persons a div.user {
    width: 90%;
}
.my_remove1{
    text-align: center;
    margin-left: auto !important;
}
.name_doc_all{
  position: absolute;
    height: 50px;
    width: 300px;
    overflow: hidden;
    font-size: 10px;
}
</style>
@stop('stylesheet')

@section('content')



<div class="row">

                        <div class="col-md-6 grid-margin">
							<div class="card">
								<div class="card-body">
									<h4 class="card-title mb-0">ข้อมูล Biller ID : {{ $bill->biller_id }}</h4>
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
                                                        @if( $bill->process == 0)
														<p class="mt-2 text-warning font-weight-bold">เจ้าหน้าที่ติดต่อกลับ</p>
                                                        @elseif($bill->process == 1)
                                                        <p class="mt-2 text-info font-weight-bold">ส่งเรื่องให้กับธนาคาร</p>
                                                        @elseif($bill->process == 2)
                                                        <p class="mt-2 text-success font-weight-bold">ผ่าน</p>
                                                        @else
                                                        <p class="mt-2 text-danger  font-weight-bold">ไม่ผ่าน</p>
														@endif

											
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


                        
  
  <div class="card " style="margin-top:10px">
    <div class="card-body">
      
    <h4 class="card-title mb-0">ข้อมูลผู้ใช้งาน</h4>
     
    <br>
        <br>
        
                    <div class="row">

                    <div class="col-md-12">
                        <div class="form-group row">
                          <label class="col-sm-3 col-form-label">บัญชีผู้ใช้งาน</label>
                          <div class="col-sm-9">
                            <input type="text" class="form-control"  value="{{ $objs->name }}" readonly>
                          </div>
                        </div>
                      </div>
                      <div class="col-md-12">
                        <div class="form-group row">
                          <label class="col-sm-3 col-form-label">อายุ</label>
                          <div class="col-sm-9">
                            <input type="text" class="form-control" value="{{ $objs->age }}"  readonly>
                          </div>
                        </div>
                      </div>
                    
                      <div class="col-md-12">
                        <div class="form-group row">
                          <label class="col-sm-3 col-form-label">ชื่อจริง</label>
                          <div class="col-sm-9">
                            <input type="text" class="form-control" value="{{ $objs->first_name }}" readonly>
                          </div>
                        </div>
                      </div>
                      <div class="col-md-12">
                        <div class="form-group row">
                          <label class="col-sm-3 col-form-label">นามสกุล</label>
                          <div class="col-sm-9">
                            <input type="text" class="form-control" value="{{ $objs->last_name }}" readonly>
                          </div>
                        </div>
                      </div>


                      <div class="col-md-12">
                        <div class="form-group row">
                          <label class="col-sm-3 col-form-label">อีเมล</label>
                          <div class="col-sm-9">
                            <input type="text" class="form-control" value="{{ $objs->email }}"  readonly>
                          </div>
                        </div>
                      </div>

                      <div class="col-md-12">
                        <div class="form-group row">
                          <label class="col-sm-3 col-form-label">เบอร์โทร</label>
                          <div class="col-sm-9">
                            <input type="text" class="form-control" value="{{ $objs->phone }}" readonly>
                          </div>
                        </div>
                      </div>

                      <div class="col-md-12">
                        <div class="form-group row">
                          <label class="col-sm-3 col-form-label">วันเกิด</label>
                          <div class="col-sm-9">
                          {{ $objs->hbd }}
                          </div>
                        </div>
                      </div>

                    <div class="col-md-12">
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

                    <div class="col-md-12">
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

                        <div class="col-md-6 grid-margin ">
                            <div class="row">
                                <div class="col-md-12">
							        <div class="card">
                                        <div class="card-body">

                                            <div class="d-flex align-items-start pb-3 border-bottom">
                                                <img src="{{ url('img/bank/'.$bill->bank_img) }}" height="49">
                                                <div class="wrapper pl-4">
                                                    <p class="font-weight-bold text-primary mb-0">{{ $bill->biller_id }}</p>
                                                    <small class="text-warning"><span class="text-muted mb-0">{{ $bill->name_bank }}</span> ( บริษัท {{ $bill->company_name }} ) </small>
                                                </div>
                                            </div>

                                            <h6 class="my-4">เอกสารที่ต้องเตรียม</h6>   
                                            <div class="new-accounts">
                                            <ul class="chats">
                                                <li class="chat-persons">
                                                <a href="#">
                                                    <span class="pro-pic"><button type="button" class="btn btn-icons btn-rounded btn-warning"><i class="icon-docs"></i></button></span>
                                                    <div class="user">
                                                        <p class="u-name">สำเนาหนังสือทะเบียนพาณิชย์อิเล็กทรอนิกส์</p>
                                                        
                                                        <span class="d-flex align-items-center mt-2">
                                                        @if(isset($bill->file_1))
                                                        
                                                        <span onclick="window.open('{{ url('img/doc/'.$bill->file_1) }}', '_blank');" class="btn btn-xs btn-rounded btn-outline-primary" style="margin-right: 25px;">Download</span>
                                                        <br><br>
                                                        @endif
                                                        <form method="POST" id="sub_file1" action="{{ url('api/add_file1/') }}" enctype="multipart/form-data">
                                                        {{ csrf_field() }}
                                                        <input type="file" class="dropify" id="file1"  name="file1" />
                                                        <input type="hidden"  name="biller_id" value="{{$bill->biller_id}}" />
                                                        <input type="hidden"  name="id" value="{{$bill->idb}}" />
                                                        </form>
                                                        
                                                        </span>
                                                    </div>
                                                    </a>
                                                </li>


                                                <li class="chat-persons">
                                                <a href="#">
                                                    <span class="pro-pic"><button type="button" class="btn btn-icons btn-rounded btn-secondary"><i class="icon-docs"></i></button></span>
                                                    <div class="user">
                                                        <p class="u-name"> สำเนาบัตรประชาชนผู้มีอำนาจลงนาม</p>
                                                        <p class="u-designation"> (สำเนาบัตรประชาชนผู้มีอำนาจลงนาม ของ นิติบุคคล) </p>
                                                        <span class="d-flex align-items-center mt-2">
                                                        @if(isset($bill->file_2))
                                                        
                                                        <span onclick="window.open('{{ url('img/doc/'.$bill->file_2) }}', '_blank');" class="btn btn-xs btn-rounded btn-outline-primary" style="margin-right: 25px;">Download</span>
                                                        <br><br>
                                                        @endif
                                                        <form method="POST" id="sub_file2" action="{{ url('api/add_file_com2/') }}" enctype="multipart/form-data">
                                                        {{ csrf_field() }}
                                                        <input type="file" class="dropify" id="file2"  name="file2[]" multiple/>
                                                        <input type="hidden"  name="biller_id" value="{{$bill->biller_id}}" />
                                                        <input type="hidden"  name="id" value="{{$bill->idb}}" />
                                                        </form>
                                                        </span>
                                                    </div>


                                                    </a>
                                                      <div class="list-wrapper ">
                                                        <ul class=" d-flex flex-column-reverse todo-list todo-list-custom" >
                                                                              @if(isset($file_2_all))
                                                                              @foreach($file_2_all as $u)
                                                                        <li >
                                                                              <a href="{{ url('img/doc/'.$u->file_name) }}" class="item" target="_blank">
                                                                              <img src="{{ url('assets/icon/icon_file.png') }}" height="72">
                                                                              <span class="name_doc_all" style="padding-left: 70px;">{{ $u->file_name }}</span>
                                                                              </a>
                                                                                  <a href="{{ url('api/del_image_idcard/'.$u->id) }}" onclick="return confirm('Are you sure?')" class="btn btn-outline-danger btn-sm my_remove1">ลบ</a>
                                                                        </li>
                                                                              @endforeach
                                                                              @endif
                                                                              
                                                        
                                                          </ul>
                                                      </div>
                                                </li>
                                                <li class="chat-persons">
                                                <a href="#">
                                                <span class="pro-pic"><button type="button" class="btn btn-icons btn-rounded btn-primary"><i class="icon-briefcase"></i></button></span>
                                                    <div class="user">
                                                        <p class="u-name">หน้าสมุดบัญชีธนาคารที่จะใช้ในการรับเงิน</p>
                                                        <p class="u-designation">(1 บัญชีต่อ Biller ID เท่านั้น)</p>
                                                        <span class="d-flex align-items-center mt-2">
                                                        @if(isset($bill->file_3))
                                                        
                                                        <span onclick="window.open('{{ url('img/doc/'.$bill->file_3) }}', '_blank' );" class="btn btn-xs btn-rounded btn-outline-primary" 
                                                        style="margin-right: 25px;">Download</span>
                                                        <br><br>
                                                        @endif
                                                        <form method="POST" id="sub_file3" action="{{ url('api/add_file3/') }}" enctype="multipart/form-data">
                                                        {{ csrf_field() }}
                                                        <input type="file" class="dropify" id="file3"  name="file3" />
                                                        <input type="hidden"  name="biller_id" value="{{$bill->biller_id}}" />
                                                        <input type="hidden"  name="id" value="{{$bill->idb}}" />
                                                        </form>
                                                        </span>
                                                    </div>
                                                    </a>
                                                </li>

                                                <li class="chat-persons">
                                                <a href="#">
                                                <span class="pro-pic"><button type="button" class="btn btn-icons btn-rounded btn-info "><i class="icon-briefcase"></i></button></span>
                                                    <div class="user">
                                                        <p class="u-name">หนังสือรับรองบริษัท</p>
                                                        <p class="u-designation">( อายุไม่เกิน 3 เดือน )</p>
                                                        <span class="d-flex align-items-center mt-2">
                                                        @if(isset($bill->file_5))
                                                        
                                                        <span onclick="window.open('{{ url('img/doc/'.$bill->file_5) }}', '_blank' );" class="btn btn-xs btn-rounded btn-outline-primary" 
                                                        style="margin-right: 25px;">Download</span>
                                                        <br><br>
                                                        @endif
                                                        <form method="POST" id="sub_file5" action="{{ url('api/add_file5/') }}" enctype="multipart/form-data">
                                                        {{ csrf_field() }}
                                                        <input type="file" class="dropify" id="file5"  name="file5" />
                                                        <input type="hidden"  name="biller_id" value="{{$bill->biller_id}}" />
                                                        <input type="hidden"  name="id" value="{{$bill->idb}}" />
                                                        </form>
                                                        </span>
                                                    </div>
                                                    </a>
                                                </li>


                                                <li class="chat-persons">
                                                <a href="#">
                                                <span class="pro-pic"><button type="button" class="btn btn-icons btn-rounded btn-dark "><i class="icon-briefcase"></i></button></span>
                                                    <div class="user">
                                                        <p class="u-name">ทะเบียนภาษีมูลค่าเพิ่ม (ภพ.20)</p>
                                                        <span class="d-flex align-items-center mt-2">
                                                        @if(isset($bill->file_6))
                                                        
                                                        <span onclick="window.open('{{ url('img/doc/'.$bill->file_6) }}', '_blank' );" class="btn btn-xs btn-rounded btn-outline-primary" 
                                                        style="margin-right: 25px;">Download</span>
                                                        <br><br>
                                                        @endif
                                                        <form method="POST" id="sub_file6" action="{{ url('api/add_file6/') }}" enctype="multipart/form-data">
                                                        {{ csrf_field() }}
                                                        <input type="file" class="dropify" id="file6"  name="file6" />
                                                        <input type="hidden"  name="biller_id" value="{{$bill->biller_id}}" />
                                                        <input type="hidden"  name="id" value="{{$bill->idb}}" />
                                                        </form>
                                                        </span>
                                                    </div>
                                                    </a>
                                                </li>


                                                

                                                <li class="chat-persons">
                                                <a href="#">
                                                <span class="pro-pic"><button type="button" class="btn btn-icons btn-rounded btn-success"><i class="icon-camera"></i></button></span>
                                                    <div class="user">
                                                        <p class="u-name">ภาพถ่ายสำนักงานทั้งภายในภายนอก</p>
                                                        <p class="u-designation">พร้อมป้ายชื่อบริษัท และสินค้าที่จำหน่าย, ตัวอย่างเว็บไซต์, URL, Domain</p>
                                                        <span class="d-flex align-items-center mt-2">
                                                        <form method="POST" id="sub_file_com" action="{{ url('api/add_file_com/') }}" enctype="multipart/form-data">
                                                        {{ csrf_field() }}
                                                        <input type="file" class="dropify" id="file_com" name="sub_file_com[]" multiple/>
                                                        <input type="hidden"  name="id" value="{{$bill->idb}}" />
                                                        </form>
                                                        </span>
                                                        <hr>
                                                        
                                                    </div>
                                                    </a>
                                                </li>
                                            </ul>
                                            </div>
                                            <hr>
                                    <div class="list-wrapper">
										<ul class=" d-flex flex-column-reverse todo-list todo-list-custom" id="ul-li">
                                            @if(isset($file_all))
                                            @foreach($file_all as $u)
											<li >
                                            <a href="{{ url('img/doc/'.$u->file_name) }}" class="item" target="_blank">>
                                            <img src="{{ url('assets/icon/icon_file.png') }}" height="72">
                                            <span class="name_doc_all">{{ $u->file_name }}</span>
                                            </a>
                                                <a href="{{ url('api/del_image_3/'.$u->id) }}" onclick="return confirm('Are you sure?')" class="btn btn-outline-danger btn-sm my_remove1">ลบ</a>
											</li>
                                            @endforeach
                                            @endif
                                            
											
                                            </ul>
                                        </div>

                                        </div>
                                    </div>
                                </div>
                            </div>
						</div>      






  </div>      
           

    <div class="row">
        <div class="col-md-12 grid-margin">
           

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
   

  <form class="forms-sample" method="POST" action="{{ url('api/post_edit_biller_id/'.$bill->idb) }}" enctype="multipart/form-data">
        {{ csrf_field() }}
  <div class="row">

    <div class="col-md-12 grid-margin">

        <div class="card">
            <div class="card-body">
                <h4 class="card-title mb-0">1. ข้อมูลผู้ติดต่อ</h4>
                <p class="card-description">
                    ข้อมุลส่วนนี้ดึงมาจาก Profile นะ ไม่ได้เปิดให้แก้ไขส่วนนี้ให้ดูเฉยๆว่าเป็นของใคร
                </p>
                <br>
                <div class="row">
                        
                    <div class="col-md-6">
                        <div class="form-group row">
                          <label class="col-sm-3 col-form-label">ชื่อจริง <span class="text-danger">*</span></label>
                          <div class="col-sm-9">
                            <input type="text" class="form-control" value="{{ $bill->first_name }}" >
                            <input type="hidden" class="form-control" value="{{ $objs->code_user }}" name="user_id">
                          </div>
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-group row">
                          <label class="col-sm-3 col-form-label">นามสกุล <span class="text-danger">*</span></label>
                          <div class="col-sm-9">
                            <input type="text" class="form-control" value="{{ $bill->last_name }}" >
                          </div>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group row">
                          <label class="col-sm-3 col-form-label">อีเมล <span class="text-danger">*</span></label>
                          <div class="col-sm-9">
                            <input type="text" class="form-control" value="{{ $bill->email_u }}"  >
                          </div>
                        </div>
                      </div>

                      <div class="col-md-6">
                        <div class="form-group row">
                          <label class="col-sm-3 col-form-label">เบอร์โทร <span class="text-danger">*</span></label>
                          <div class="col-sm-9">
                            <input type="text" class="form-control" value="{{ $bill->phone_u }}">
                          </div>
                        </div>
                    </div>

                    <div class="col-md-12">
                        <div class="form-group row">
                          <label class="col-sm-3 col-form-label">สถานะ Biller ID (แสดงหน้าผู้ใช้งาน) <span class="text-danger">*</span></label>
                          <div class="col-sm-9">
                           <select class="form-control" name="process">
                                <option value="0" @if( $bill->process == 0)
														selected='selected'
														@endif>เจ้าหน้าที่ติดต่อกลับ</option>
                                <option value="1" @if( $bill->process == 1)
														selected='selected'
														@endif>ส่งเรื่องให้กับธนาคาร</option>
                                <option value="2" @if( $bill->process == 2)
														selected='selected'
														@endif>ผ่าน</option>
                                <option value="3" @if( $bill->process == 3)
														selected='selected'
														@endif>ไม่ผ่าน</option>
                            </select>
                          </div>
                        </div>
                    </div>


                    <div class="col-md-12">
                        <div class="form-group row">
                          <label class="col-sm-3 col-form-label">หมายเหตุ <span class="text-danger">*</span></label>
                          <div class="col-sm-9">
                            <textarea class="form-control" name="notes" id="notes" cols="30" rows="5">{{ $bill->data1_id }}</textarea>
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
                          <label class="col-sm-3 col-form-label">รูปแบบของธุรกิจ <span class="text-danger">*</span></label>
                          <div class="col-sm-9">
                          <select class="form-control" name="t_com">
                                <option value="0" @if( $bill->bill_type == 0)
														selected='selected'
														@endif>บุคคลธรรมดา</option>
                                <option value="1" @if( $bill->bill_type == 1)
														selected='selected'
														@endif>นิติบุคคล</option>
                            </select>
                          </div>
                        </div>
                      </div>
                        
                    <div class="col-md-12">
                        <div class="form-group row">
                          <label class="col-sm-3 col-form-label">ชื่อบริษัท <span class="text-danger">*</span></label>
                          <div class="col-sm-9">
                            <input type="text" class="form-control" value="{{ $bill->company_name }}" name="company_name">
                          </div>
                        </div>
                      </div>
                      <div class="col-md-12">
                        <div class="form-group row">
                          <label class="col-sm-3 col-form-label">เลขประจำตัวผู้เสียภาษี <span class="text-danger">*</span></label>
                          <div class="col-sm-9">
                            <input type="text" class="form-control" value="{{ $bill->id_card }}" name="id_card">
                          </div>
                        </div>
                    </div>

                    <div class="col-md-12">
                        <div class="form-group row">
                          <label class="col-sm-3 col-form-label">ประเภทบริษัท <span class="text-danger">*</span></label>
                          <div class="col-sm-9">
                            <input type="text" class="form-control" value="{{ $bill->company_type }}" placeholder="ประเภทบริษัท (เช่น อาหาร, เทคโนโลยี, ขนส่ง)" name="company_type" >
                          </div>
                        </div>
                      </div>

                      <div class="col-md-12">
                        <div class="form-group row">
                          <label class="col-sm-3 col-form-label">ประเภทธุรกิจ/สินค้าที่จำหน่าย <span class="text-danger">*</span></label>
                          <div class="col-sm-9">
                            <input type="text" class="form-control" value="{{ $bill->business_type }}" name="business_type">
                          </div>
                        </div>
                    </div>

                    <div class="col-md-12">
                        <div class="form-group row">
                          <label class="col-sm-3 col-form-label">Website, URL, Domain </label>
                          <div class="col-sm-9">
                            <input type="text" class="form-control" value="{{ $bill->url_domain_name }}" name="url_domain_name">
                          </div>
                        </div>
                    </div>


                    <div class="col-md-12">
                        <div class="form-group row">
                          <label class="col-sm-3 col-form-label">Merchant id (รอข้อมูลจากธนาคาร)</label>
                          <div class="col-sm-9">
                            <input type="text" class="form-control" value="{{ $bill->merchant_id }}" name="merchant_id">
                          </div>
                        </div>
                      </div>

                      <div class="col-md-12">
                        <div class="form-group row">
                          <label class="col-sm-3 col-form-label">Terminal id (รอข้อมูลจากธนาคาร)</label>
                          <div class="col-sm-9">
                            <input type="text" class="form-control" value="{{ $bill->terminal_id }}" name="terminal_id">
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
        <h4 class="card-title mb-0">3. ที่อยู่ตามบัตรประชาชน/ทะเบียนบ้าน </h4><br>
        <a class="add btn btn-primary font-weight-bold " href="{{ url('admin/create_address_user2/'.$id) }}">เพิ่มที่อยุ่ใหม่</a>
        <div class="row">
                
            <div class="col-md-12">
                <br>
                <div class="form-group">
                  <select class="form-control" name="id_address" >
                    <option value=""> -- เลือกที่อยู่ -- </option>
                    @if(isset($address))
                      @foreach($address as $u)
                        <option value="{{$u->id}}" 
                                    @if($u->id == $bill->address_id)
                                    selected='selected'
                                    @endif
                                    > {{ $u->fname }}, {{ $u->phone }}, {{ $u->address_no }}, {{ $u->address_name }} </option>
                      @endforeach
                    @endif
                  </select> 
                </div>
            </div>
        </div>

    </div>
</div>

</div>


<div class="col-md-12 grid-margin">

<div class="card">
    <div class="card-body">
        <h4 class="card-title mb-0">4. ที่อยู่ปัจจุบัน</h4>
        
        <div class="row">
                
            <div class="col-md-12">
            <br>
                <div class="form-group">
                <select class="form-control" name="id_address2" >
                <option value=""> -- เลือกที่อยู่ -- </option>
                    @if(isset($address))
                      @foreach($address as $u)
                        <option value="{{$u->id}}"  @if($u->id == $bill->AddressNow)
                                    selected='selected'
                                    @endif
                                    > {{ $u->fname }}, {{ $u->phone }}, {{ $u->address_no }}, {{ $u->address_name }} </option>
                      @endforeach
                    @endif
                    </select> 
                </div>
            </div>
        </div>

    </div>
</div>

</div>


<div class="col-md-12 grid-margin">

<div class="card">
    <div class="card-body">
        <h4 class="card-title mb-0">5. ที่อยู่บริษัท/ร้านค้่า</h4>
        
        <div class="row">
                
            <div class="col-md-12">
            <br>
                <div class="form-group">
                <select class="form-control" name="id_address3" >
                <option value=""> -- เลือกที่อยู่ -- </option>
                    @if(isset($address))
                      @foreach($address as $u)
                        <option value="{{$u->id}}" @if($u->id == $bill->AddressCom)
                                    selected='selected'
                                    @endif> {{ $u->fname }}, {{ $u->phone }}, {{ $u->address_no }}, {{ $u->address_name }} </option>
                      @endforeach
                    @endif
                    </select> 
                </div>
            </div>
        </div>

    </div>
</div>

</div>



    <div class="col-md-12 grid-margin">

        <div class="card">
            <div class="card-body">
                <h4 class="card-title mb-0">6. เลือกธนาคารที่ต้องการสมัคร</h4>
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
                              <input type="radio" class="form-check-input" name="bank_id" id="optionsRadios1" value="{{ $u->id }}" @if( $bill->bank_id == $u->id)
                              checked
														@endif>
                              {{ $u->name_bank }} 
                            <i class="input-helper"></i></label>
                          </div>
                          @endforeach
                          @endif
                          
                        </div> 
                      </div>


                      <div class="col-md-12">
                      <br>
                        <div class="form-group row">
                          <label class="col-sm-3 col-form-label">ชื่อบัญชีธนาคาร <span class="text-danger">*</span></label>
                          <div class="col-sm-9">
                            <input type="text" class="form-control" value="{{ $bill->bank_name }}" name="bank_name">
                          </div>
                        </div>
                    </div>

                    <div class="col-md-12">
                      
                        <div class="form-group row">
                          <label class="col-sm-3 col-form-label">หมายเลขบัญชีธนาคาร <span class="text-danger">*</span></label>
                          <div class="col-sm-9">
                            <input type="text" class="form-control" value="{{ $bill->bank_no }}" name="bank_no">
                          </div>
                        </div>
                    </div>

                    <div class="col-md-12">
                      
                        <div class="form-group row">
                          <label class="col-sm-3 col-form-label">สาขา</label>
                          <div class="col-sm-9">
                            <input type="text" class="form-control" value="{{ $bill->bank_major }}" name="bank_major">
                          </div>
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

$("#file1").on('change',function()
{
    document.getElementById('sub_file1').submit();
});

$("#file2").on('change',function()
{
    document.getElementById('sub_file2').submit();
});

$("#file3").on('change',function()
{
    document.getElementById('sub_file3').submit();
});

$("#file5").on('change',function()
{
    document.getElementById('sub_file5').submit();
});

$("#file6").on('change',function()
{
    document.getElementById('sub_file6').submit();
});

$("#file_com").on('change',function()
{
    document.getElementById('sub_file_com').submit();
});

            
$(document).ready(function() {
    $("#ul-li").lightGallery({
      thumbnail: true,
      download: false,
      selector: ".item"
    });
  });

</script>
@stop('scripts')