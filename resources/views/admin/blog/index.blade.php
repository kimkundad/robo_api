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
                
                <div class="col-md-12">
                  <a href="https://blog.robotel.co.th/wp-login.php" target="_blank" class="btn btn-success btn-fw" style="float:right"><i class="icon-plus"></i>เขียนบทความใหม่</a>
                  <br /><br />
                </div>
                <div class="col-md-12 grid-margin stretch-card">
                  <div class="card">
                    <div class="card-body">
                       
                        <h4>
                        username :  robotel <br><br>
                        password :  robotel1429800   
                        </h4>
                    </div>
                  </div>
                </div>


              </div>



@endsection

@section('scripts')


<script>

$(document).ready(function(){


  });

</script>

@stop('scripts')