@extends('admin.layouts.template')

@section('ga')

@endsection

@section('stylesheet')

@stop('stylesheet')

@section('content')



<div class="row">


            <div class="col-md-12">
              <h4 class="card-title">รายการทั้งหมด</h4>
            </div>
            <div class="col-12 grid-margin">
              <div class="card card-statistics">
                <div class="card-body p-0">
                  <div class="row">
                    
                    <div class="col-md-6 col-lg-3">
                      <div class="d-flex justify-content-between border-right card-statistics-item">
                        <div>
                          <h1>{{ $user }}</h1>
                          <p class="text-muted mb-0">ผู้ใช้งาน ทั้งหมด</p>
                        </div>
                        <i class="icon-people text-primary icon-lg"></i>
                      </div>
                    </div>

                    <div class="col-md-6 col-lg-3">
                      <div class="d-flex justify-content-between border-right card-statistics-item">
                        <div>
                          <h1>{{ $biller }}</h1>
                          <p class="text-muted mb-0">Biller ID</p>
                        </div>
                        <i class="icon-wallet text-primary icon-lg"></i>
                      </div>
                    </div>


                    <div class="col-md-6 col-lg-3">
                      <div class="d-flex justify-content-between border-right card-statistics-item">
                        <div>
                          <h1>0</h1>
                          <p class="text-muted mb-0">การสั่งซื้อ</p>
                        </div>
                        <i class="icon-basket-loaded text-primary icon-lg"></i>
                      </div>
                    </div>

                    <div class="col-md-6 col-lg-3">
                      <div class="d-flex justify-content-between border-right card-statistics-item">
                        <div>
                          <h1>0</h1>
                          <p class="text-muted mb-0">จำนวนผู้เข้าชม</p>
                        </div>
                        <i class="icon-pin text-primary icon-lg"></i>
                      </div>
                    </div>
                   
                   
                  </div>



                </div>
              </div>
            </div>

                        <div class="col-md-3 grid-margin stretch-card">
                          <div class="card">
                            <div class="card-body">
                              <h4 class="card-title">รายได้ทั้งหมด</h4>
                              <div class="w-75 mx-auto">
                                <canvas id="earning-report" width="100" height="100"></canvas>
                              </div>
                              <div class="py-4 d-flex justify-content-center align-items-end">
                                <h1 class="text-center text-md-left mb-0">1.2 ล้าน</h1>
                              </div>
                              <div id="earning-report-legend" class="earning-report-legend"></div>
                            </div>
                          </div>
                        </div>


                        <div class="col-md-9 grid-margin stretch-card">
                          <div class="card">
                            <div class="card-body">
                              <h4 class="card-title">รายการสั่งซื้อล่าสุด</h4>
                              <table class="table">
                                <thead>
                                  <tr>
                                    <th></th>
                                    <th>เลขที่สั่งซื้อ</th>
                                    <th>ยอดรวม</th>
                                    <th>วันที่สั่งซื้อ</th>
                                    <th>สถานะ</th>
                                  </tr>
                                </thead>
                                <tbody>
                                  <tr>
                                    <td>
                                      <div class="disc bg-secondary"></div>
                                    </td>
                                    <td>
                                      <h4 class="text-primary font-weight-normal">PO-20210616-005</h4>
                                      <p class="text-muted mb-0">1 รายการ 10 ชิ้น</p>
                                    </td>
                                    <td>
                                      ฿10,000
                                    </td>
                                    <td>
                                      <p>27 มิ.ย. 2564</p>
                                      <p class="text-muted mb-0">วันนี้</p>
                                    </td>
                                    <td>
                                      <label class="badge badge-warning">รอจัดส่ง</label>
                                    </td>
                                  </tr>
                                  <tr>
                                    <td>
                                      <div class="disc bg-secondary"></div>
                                    </td>
                                    <td>
                                      <h4 class="text-primary font-weight-normal">PO-20210616-004</h4>
                                      <p class="text-muted mb-0">1 รายการ 10 ชิ้น</p>
                                    </td>
                                    <td>
                                      ฿1,000
                                    </td>
                                    <td>
                                      <p>26 มิ.ย. 2564</p>
                                      <p class="text-muted mb-0">1 วันที่แล้ว</p>
                                    </td>
                                    <td>
                                      <label class="badge badge-success">จัดส่งแล้ว</label>
                                    </td>
                                  </tr>
                                  <tr>
                                    <td>
                                      <div class="disc bg-secondary"></div>
                                    </td>
                                    <td>
                                      <h4 class="text-primary font-weight-normal">PO-20210616-003</h4>
                                      <p class="text-muted mb-0">1 รายการ 10 ชิ้น</p>
                                    </td>
                                    <td>
                                      ฿5,260
                                    </td>
                                    <td>
                                      <p>26 มิ.ย. 2564</p>
                                      <p class="text-muted mb-0">1 วันที่แล้ว</p>
                                    </td>
                                    <td>
                                      <label class="badge badge-success">จัดส่งแล้ว</label>
                                    </td>
                                  </tr>
                                  <tr>
                                    <td>
                                      <div class="disc bg-secondary"></div>
                                    </td>
                                    <td>
                                      <h4 class="text-primary font-weight-normal">PO-20210616-002</h4>
                                      <p class="text-muted mb-0">1 รายการ 10 ชิ้น</p>
                                    </td>
                                    <td>
                                      ฿12,000
                                    </td>
                                    <td>
                                      <p>26 มิ.ย. 2564</p>
                                      <p class="text-muted mb-0">1 วันที่แล้ว</p>
                                    </td>
                                    <td>
                                      <label class="badge badge-success">จัดส่งแล้ว</label>
                                    </td>
                                  </tr>
                                  <tr>
                                    <td>
                                      <div class="disc bg-secondary"></div>
                                    </td>
                                    <td>
                                      <h4 class="text-primary font-weight-normal">PO-20210616-001</h4>
                                      <p class="text-muted mb-0">1 รายการ 10 ชิ้น</p>
                                    </td>
                                    <td>
                                      ฿599
                                    </td>
                                    <td>
                                      <p>25 มิ.ย. 2564</p>
                                      <p class="text-muted mb-0">2 วันที่แล้ว</p>
                                    </td>
                                    <td>
                                      <label class="badge badge-success">จัดส่งแล้ว</label>
                                    </td>
                                  </tr>
                                </tbody>
                              </table>
                            </div>
                          </div>
                        </div>



                        <div class="col-md-12 grid-margin stretch-card">
                          <div class="card">
                            <div class="card-body d-flex flex-column justify-content-between">
                              <div>
                                <h4 class="card-title">จำนวนผู้ใช้งานใหม่ปีนี้</h4>
                                <h3 class="text-muted">520 คน</h3>
                              </div>
                              <canvas id="sales-chart" class="mt-auto"></canvas>
                            </div>
                          </div>
                        </div>




          </div>



@endsection

@section('scripts')

<script src="{{ url('back/js/dashboard.js') }}?v1"></script>

@stop('scripts')