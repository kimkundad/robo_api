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
                <div class="col-md-12">
                    <h4 class="card-title mb-10">เทสเตอร์ จำกัด</h4>
                </div>
            
                <div class="col-md-12 grid-margin stretch-card">
                    
                    <div class="card">
                        <div class="card-body">
                        <h4 class="card-title">ข้อมูลการสมัคร</h4>

                        <table class="table">
                            <tbody>
                                <tr>
                                <td>วันที่</td>
                                <td>29 ต.ค. 2564</td>
                                </tr>
                                <tr>
                                <td>ชื่อผู้ติดต่อ</td>
                                <td>ศิรินทรา เศรษฐิอนันต์</td>
                                </tr>
                                <tr>
                                <td>ร้านค้า</td>
                                <td>เทสเตอร์ จำกัด</td>
                                </tr>
                                <tr>
                                <td>เบอร์โทร</td>
                                <td>083-903-2345</td>
                                </tr>
                                <tr>
                                <td>อีเมล</td>
                                <td>sirintra@gmail.com</td>
                                </tr>
                            </tbody>
                        </table>
                        </div>
                    </div>
                    
                </div>


                <div class="col-md-12 grid-margin stretch-card">
                    <div class="card ">
                        <div class="card-body">
                            <h4 class="card-title">ช่องทางการชำระเงินที่สมัคร</h4>
                            <p> PromptPay, Credit Card (QR Credit), Alipay, WeChat </p>
                        </div>
                    </div>
                </div>

                <div class="col-md-12 grid-margin stretch-card">
                    <div class="card ">
                        <div class="card-body">
                            <h4 class="card-title">เอกสารการสมัคร</h4>
                            <p class="card-description">
                                กรุณาอัปโหลดเอกสารให้ครบตามที่ระบุไว้ด้านล่าง และ <span class="text-danger">เซ็นเอกสารสำเนาถูกต้อง กรณีเป็นเอกสารของบริษัท โปรดประทับตราบริษัทให้เรียบร้อย</span> 
                                รองรับไฟล์ doc, docx, pdf, jpeg, png
                            </p>

                            <div class="card mb-10">
                                <div class="card-body">
                                    <div style="display: flex;">
                                    <div>
                                        <h6 class="mb-1">1. หนังสือรับรองบริษัท อายุไม่เกิน 3 เดือน</h6>
                                        <p class="mb-0 text-muted" style="padding-left:18px">
                                            Document.pdf
                                        </p>
                                    </div>
                                    <div class="push" style="align-content: flex-end"><button type="button" class="btn btn-outline-primary" style="float:right">ดาวน์โหลดเอกสาร</button></div>
                                    
                                    </div>
                                </div>
                            </div>


                            <div class="card mb-10">
                                <div class="card-body">
                                    <div style="display: flex;">
                                    <div>
                                        <h6 class="mb-1">2. ทะเบียนภาษีมูลค่าเพิ่ม (ภพ.20)</h6>
                                        <p class="mb-0 text-muted" style="padding-left:18px">
                                            Document.pdf
                                        </p>
                                    </div>
                                    <div class="push" style="align-content: flex-end"><button type="button" class="btn btn-outline-primary" style="float:right">ดาวน์โหลดเอกสาร</button></div>
                                    
                                    </div>
                                </div>
                            </div>


                            <div class="card mb-10">
                                <div class="card-body">
                                    <div style="display: flex;">
                                    <div>
                                        <h6 class="mb-1">3. สำเนาบัตรประชาชนผู้มีอำนาจลงนาม (ส่งหลายไฟล์พร้อมกันได้)</h6>
                                        <p class="mb-0 text-muted" style="padding-left:18px">
                                            Document.pdf
                                        </p>
                                    </div>
                                    <div class="push" style="align-content: flex-end"><button type="button" class="btn btn-outline-primary" style="float:right">ดาวน์โหลดเอกสาร</button></div>
                                    
                                    </div>
                                </div>
                            </div>


                            <div class="card mb-10">
                                <div class="card-body">
                                    <div style="display: flex;">
                                    <div>
                                        <h6 class="mb-1">4. ภาพถ่ายสำนักงานทังภายในและภายนอก พร้อมป้ายบริษัท และสินค้าที่จำหน่าย รวมถึงแผนที่</h6>
                                        <p class="mb-0 text-muted" style="padding-left:18px">
                                            Document.pdf
                                        </p>
                                    </div>
                                    <div class="push" style="align-content: flex-end"><button type="button" class="btn btn-outline-primary" style="float:right">ดาวน์โหลดเอกสาร</button></div>
                                    
                                    </div>
                                </div>
                            </div>

                            <div class="card mb-10">
                                <div class="card-body">
                                    <div style="display: flex;">
                                    <div>
                                        <h6 class="mb-1">5. หน้าสมุดบัญชีธนาคารที่จะใช้ในการรับเงิน (1 บัญชีต่อ Biller ID เท่านั้น)</h6>
                                        <p class="mb-0 text-muted" style="padding-left:18px">
                                            Document.pdf
                                        </p>
                                    </div>
                                    <div class="push" style="align-content: flex-end"><button type="button" class="btn btn-outline-primary" style="float:right">ดาวน์โหลดเอกสาร</button></div>
                                    
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>



                <div class="col-md-12 grid-margin stretch-card">
                    <div class="card ">
                        <div class="card-body">
                            <h4 class="card-title">สถานะ</h4>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group row">
                                    <label class="col-sm-3 col-form-label">สถานะการติดต่อ</label>
                                    <div class="col-sm-9">
                                        <select class="form-control">
                                        <option>รอการติดต่อ</option>
                                        <option>สำเร็จ</option>
                                        </select>
                                    </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group row">
                                    <label class="col-sm-3 col-form-label">Sale</label>
                                    <div class="col-sm-9">
                                        <select class="form-control">
                                        <option>Sale01</option>
                                        <option>Sale02</option>
                                        </select>
                                    </div>
                                    </div>
                                </div>
                                </div>
                                <div class="col-md-12 text-right">
                                    <button type="submit" class="btn btn-primary mb-2">บันทึก</button>
                                </div>
                                
                            
                        </div>
                    </div>
                </div>


            </div>
            <br><br><br><br><br><br><br><br><br>

<style>
    .push {
    margin-left: auto;
}
.mb-10{
    margin-bottom:10px;
}
</style>
@endsection

@section('scripts')





@stop('scripts')