@extends('admin.layouts.template')

@section('ga')

@endsection

@section('stylesheet')

@stop('stylesheet')

@section('content')



<div class="row">
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
                        <i class="icon-user  text-primary icon-lg"></i>
                      </div>
                    </div>
                   
                   
                  </div>
                </div>
              </div>
            </div>
          </div>



@endsection

@section('scripts')

@stop('scripts')