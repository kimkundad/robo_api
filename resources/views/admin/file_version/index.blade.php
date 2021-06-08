@extends('admin.layouts.template')

@section('ga')
window.gaTitle = 'หน้าแรก';
@endsection

@section('stylesheet')
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.24/css/jquery.dataTables.min.css">
<style>

.table td img, .jsgrid .jsgrid-table td img, .table th img, .jsgrid .jsgrid-table th img {
    width: 300px;
    height: auto;
    border-radius: 0%;
}
</style>
@stop('stylesheet')

@section('content')

<div class="row">

                <div class="col-md-12">
                  <a href="{{ url('admin/get_file_version/create') }}" class="btn btn-success btn-fw" style="float:right"><i class="icon-plus"></i>เพิ่มไฟล์ใหม่</a> 
                  <br /><br />
                </div>
                
                <div class="col-md-9">
                         
                            <div class="form-group pull-right">
                                <div class="input-group">
                                    <input type="text" class="form-control" id="search" name="search" placeholder="ค้นหา Firmware">
                                    <div class="input-group-append">
                                      <a class="btn btn-sm btn-primary" id="btnSendData" style="color:#fff">ค้นหา</a>
                                    </div>
                                  </div>
                            </div>
                          
                </div>
                

                
                <div class="col-md-12 grid-margin stretch-card">
                  <div class="card">
                    <div class="card-body">
                      <h4 class="card-title">Firmware version</h4>

                      <div class="table-responsive">

                      <table class="table" id="datatable">
                        <thead>
                          <tr>
                            <th>#</th>
                            <th>วันที่อัปโหลด</th>
                            <th>ชื่อไฟล์ (Version)</th>
                            <th>ประเภทอุปกรณ์</th>
                            <th>ดำเนินการ</th>
                          </tr>
                        </thead>
                        <tbody id="reset_tb">
                      
                            
                        

                        </tbody>
                      </table>

                      </div>
                      <div id="pagi_js"></div>
                    </div>
                  </div>
                </div>

              
              </div>
              <br><br><br><br><br><br><br><br>


@endsection

@section('scripts')
<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script>
<script>

var page = 1;

$("#search").keyup(function(event) {
    if (event.keyCode === 13) {
        $("#btnSendData").click();
    }
});

$(document).on('click','#btnSendData',function (event) {
  event.preventDefault();
  var search = document.getElementById("search").value;

  $.ajax({
        url: "https://iot-test.promptrub.com/api/v1/version_control?Page=1&PageSize=20&Keyword="+search,
        method:'GET',
        success: function (data) {
       
          document.getElementById('reset_tb').innerHTML = "";
            var html = '';
            var num_var = 1;
            for(var i = 0; i < data.items.length; i++){
             
                html += '<tr id="row_hide_'+ data.items[i].id +'">'+
                            '<td>' + num_var + '</td>' +
                            '<td>{{ formatDateThat(' + data.items[i].uploadDate + ')}}</td>' +
                            '<td><a href="#" id="'+ data.items[i].id +'" onClick="reply_click2(this.id)" class="preview_'+ data.items[i].id +'">' + data.items[i].name + '</a></td>' +
                            '<td>' + data.items[i].machineType + '</td>' +
                            '<td><a target="_blank" href="' + data.items[i].url + '" style="margin-right:5px;" class="btn btn-outline-primary btn-sm">ดาวน์โหลด</a>'+
                            '<a id="'+ data.items[i].id +'" onClick="reply_click()" class="btn btn-outline-danger btn-sm">ลบ</a></td>' +
                        '</tr>';
                        num_var++;
                }   
                document.getElementById('reset_tb').innerHTML = html;
                document.getElementById('pagi_js').innerHTML = "";
        },
        error: function (data) {
        }
      });

});

function reply_click()
    {
      //alert(event.srcElement.id);
      var get_value = event.srcElement.id;
      $.ajax({
      url: "https://iot-test.promptrub.com/api/v1/version_control/"+event.srcElement.id,
      type: 'DELETE',
      success: function(data){
        console.log(data)
        console.log('row_hide_'+get_value)
            swal("สำเร็จ!", "ข้อมูลได้ทำการลบข้อมูลเสร็จแล้ว", "success");
            get_value = document.getElementById('row_hide_'+get_value).remove();
      },
      error: function () {

      }
  });

    }


    function reply_click2(clicked_id)
    {

        var get_value = clicked_id;
      $.ajax({
      url: "https://iot-test.promptrub.com/api/v1/version_control/"+get_value,
      type: 'GET',
      success: function(data){
       
            swal(data.description);
      },
      error: function () {

      }
  });
    }

    function onClickDiv(page_value){


      $.ajax({
        url: "https://iot-test.promptrub.com/api/v1/version_control?Page="+page_value+"&PageSize=20",
        method:'GET',
        success: function (data) {
          document.getElementById('reset_tb').innerHTML = "";
            var html = '';
            var num_var = 1;
            for(var i = 0; i < data.items.length; i++){
             
                html += '<tr id="row_hide_'+ data.items[i].id +'">'+
                            '<td>' + num_var + '</td>' +
                            '<td>{{ formatDateThat(' + data.items[i].uploadDate + ')}}</td>' +
                            '<td><a href="#" id="'+ data.items[i].id +'" onClick="reply_click2(this.id)" class="preview_'+ data.items[i].id +'">' + data.items[i].name + '</a></td>' +
                            '<td>' + data.items[i].machineType + '</td>' +
                            '<td><a target="_blank" href="' + data.items[i].url + '" style="margin-right:5px;" class="btn btn-outline-primary btn-sm">ดาวน์โหลด</a>'+
                            '<a id="'+ data.items[i].id +'" onClick="reply_click()" class="btn btn-outline-danger btn-sm">ลบ</a></td>' +
                        '</tr>';
                        num_var++;
                }   
                document.getElementById('reset_tb').innerHTML = html;
  
              var in_pagi = '';
              for (var i = 1; i <= data?.totalPages; i++) {
                if(page_value == i){
                  in_pagi += '<li class="page-item active">'+
                          '<a class="page-link" onClick="onClickDiv('+i+')"  >'+i+'</a></li>';
                }else{
                  in_pagi += '<li class="page-item ">'+
                          '<a class="page-link" onClick="onClickDiv('+i+')"  >'+i+'</a></li>';
                }
                }

                  var pagination = '';
                  if(data.totalPages > 0){
                    pagination = '<nav>'+
                    '<ul class="pagination rounded-flat pagination-success">'+
                      '<li class="page-item"><a onClick="onClickDiv(1)" class="page-link" ><i class="icon-arrow-left"></i></a></li>'+
                        in_pagi
                      '<li class="page-item"><a onClick="onClickDiv('+ (data.currentPage+1) +')" class="page-link" href="#"><i class="icon-arrow-right"></i></a></li>'+
                    '</ul>'+
                  '</nav>';
                  }

                  document.getElementById('pagi_js').innerHTML = pagination;
                  

          
        },
        error: function (data) {
        }
      });



    }

$(document).ready(function(){

  $.ajax({
        url: "https://iot-test.promptrub.com/api/v1/version_control?Page="+page+"&PageSize=20",
        method:'GET',
        success: function (data) {
          document.getElementById('reset_tb').innerHTML = "";
            var html = '';
            var num_var = 1;
            for(var i = 0; i < data.items.length; i++){
             
                html += '<tr id="row_hide_'+ data.items[i].id +'">'+
                            '<td>' + num_var + '</td>' +
                            '<td>{{ formatDateThat(' + data.items[i].uploadDate + ')}}</td>' +
                            '<td><a href="#" id="'+ data.items[i].id +'" onClick="reply_click2(this.id)" class="preview_'+ data.items[i].id +'">' + data.items[i].name + '</a></td>' +
                            '<td>' + data.items[i].machineType + '</td>' +
                            '<td><a target="_blank" href="' + data.items[i].url + '" style="margin-right:5px;" class="btn btn-outline-primary btn-sm">ดาวน์โหลด</a>'+
                            '<a id="'+ data.items[i].id +'" onClick="reply_click()" class="btn btn-outline-danger btn-sm">ลบ</a></td>' +
                        '</tr>';
                        num_var++;
                }   
                document.getElementById('reset_tb').innerHTML = html;
  
              var in_pagi = '';
              for (var i = 1; i <= data?.totalPages; i++) {
                if(page == i){
                  in_pagi += '<li class="page-item active">'+
                          '<a class="page-link" onClick="onClickDiv('+i+')"  >'+i+'</a></li>';
                }else{
                  in_pagi += '<li class="page-item ">'+
                          '<a class="page-link" onClick="onClickDiv('+i+')"  >'+i+'</a></li>';
                }
                }

                  var pagination = '';
                  if(data.totalPages > 0){
                    pagination = '<nav>'+
                    '<ul class="pagination rounded-flat pagination-success">'+
                      '<li class="page-item"><a onClick="onClickDiv(1)" class="page-link" ><i class="icon-arrow-left"></i></a></li>'+
                        ''+in_pagi
                      '<li class="page-item"><a onClick="onClickDiv('+ (data.currentPage+1) +')" class="page-link"><i class="icon-arrow-right"></i></a></li>'+
                    '</ul>'+
                  '</nav>';
                  }

                  document.getElementById('pagi_js').innerHTML = pagination;
                  

          
        },
        error: function (data) {
        }
      });


     


  	});

</script>


@stop('scripts')