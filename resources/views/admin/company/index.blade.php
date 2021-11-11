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
                
                <div class="col-md-4">
                    
                            <div class="form-group">
                              <form class="form-horizontal" action="{{ url('admin/users') }}" method="GET" enctype="multipart/form-data">
                                  {{ csrf_field() }}
                                  <label>ค้นหา</label>
                                    <div class="input-group">
                                    <input type="text" class="form-control" name="search" value="{{ $search }}" placeholder="ชื่อ-นามสกุล ผู้ติดต่อ, ชื่อร้านค้า, เบอร์โทร" >
                                    <div class="input-group-append">
                                      <button class="btn btn-sm btn-primary" type="submit">ค้นหา</button>
                                    </div>
                                  </div>
                                </form>
                            </div>
                       
                </div>
                <div class="col-md-2"> 
                  <div class="form-group">
                    <label for="exampleFormControlSelect2">ช่องทางการชำระเงิน</label>
                    <select class="form-control" id="exampleFormControlSelect2">
                      <option>ทั้งหมด</option>
                      <option>2</option>
                      <option>3</option>
                      <option>4</option>
                      <option>5</option>
                    </select>
                  </div>
                </div>
                <div class="col-md-2"> 
                  <div class="form-group">
                    <label for="exampleFormControlSelect2">สถานะ</label>
                    <select class="form-control" id="exampleFormControlSelect2">
                      <option>ทั้งหมด1</option>
                      <option>2</option>
                      <option>3</option>
                      <option>4</option>
                      <option>5</option>
                    </select>
                  </div>
                </div>

                <div class="col-md-2"> 
                <div class="form-group row">
                          <label >วันที่เริ่มต้น</label>
                        
                          <div id="datepicker-popup" class="input-group date datepicker" >
                                <input type="text" class="form-control" name="dateOfBirth" > 
                                <span class="input-group-addon input-group-append border-left">
                                <span class="icon-calendar input-group-text"></span>
                                </span>
                            </div>
                      
                        </div>
                </div>
                <div class="col-md-2"> 
                <div class="form-group row">
                          <label >วันที่สิ้นสุด</label>
                       
                          <div id="datepicker-popup" class="input-group date datepicker" >
                                <input type="text" class="form-control" name="dateOfBirth2" > 
                                <span class="input-group-addon input-group-append border-left">
                                <span class="icon-calendar input-group-text"></span>
                                </span>
                            </div>
                      
                        </div>
                </div>

                <div class="col-md-12 grid-margin stretch-card">
                  <div class="card">
                    <div class="card-body">
               
                      <h4 class="card-title">การสมัครของร้านค้า</h4>

                      <div class="table-responsive">

                      <table class="table">
                        <thead>

                          <tr>
                     
                            <th>วันที่</th>
                            <th>ชื่อผู้ติดต่อ</th>
							<th>ร้านค้า</th>
                            <th>เบอร์โทร</th>
                            <th>ประเภทการสมัคร</th>
                            <th>ช่องทางการชำระเงินที่สมัคร</th>
                            <th>สถานะ</th>
                            <th>ดำเนินการ</th>
                          </tr>
                        </thead>
                        <tbody>
                    
						          @if(isset($data))
                        @foreach($data as $u)
                   
                          <tr>
                            <td>ขาดวันที่</td>
                            <td>
                              {{ $u['contractFirstname'] }} {{$u['contractLastname']}} 
                            </td>
                            <td>
                              {{$u['companyName']}} 
                            </td>
                            <td>
                                ขาดเบอร์ติดต่อ
                            </td>
							<td>
                            {{$u['companyType']}}
                            </td>
                            <td>
                            ช่องทางการชำระเงิน
                            </td>
                            
                            <td>
                                <label class="badge badge-warning">รอการติดต่อ</label>
                            </td>
                            <td>
                              <a href="{{ url('admin/company/'.$u['companyId'].'/edit') }}" class="btn btn-outline-primary btn-sm">แก้ไข</a>
                              <a href="{{ url('api/del_company/') }}" onclick="return confirm('Are you sure?')" class="btn btn-outline-danger btn-sm">ลบ</a>
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





@stop('scripts')