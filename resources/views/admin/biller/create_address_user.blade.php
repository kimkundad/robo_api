@extends('admin.layouts.template')

@section('ga')
window.gaTitle = 'หน้าแรก';
@endsection

@section('stylesheet')
<style>
.note-editor.note-frame .note-editing-area .note-editable {
    padding: 35px;
    overflow: auto;
    color: #000;
    background-color: #fff;
}
</style>
@stop('stylesheet')

@section('content')



<div class="row">

<div class="row">
        <div class="col-md-12 grid-margin">
                @if ($errors->has('fname'))
                  <div class="alert alert-warning" role="alert">
                    กรุณากรอก ชื่อ-นามสกุล ให้ครบ
                  </div>
                @endif

                @if ($errors->has('phone'))
                  <div class="alert alert-warning" role="alert">
                    กรุณากรอก หมายเลขโทรศัพท์ ให้ครบ
                  </div>
                @endif

                @if ($errors->has('address_no'))
                  <div class="alert alert-warning" role="alert">
                    กรุณากรอก เลขที่บ้าน ให้ครบ
                  </div>
                @endif

                @if ($errors->has('address_name'))
                  <div class="alert alert-warning" role="alert">
                    กรุณากรอก ชื่ออาคาร/หมู่บ้าน ให้ครบ
                  </div>
                @endif

                @if ($errors->has('provi'))
                  <div class="alert alert-warning" role="alert">
                    กรุณาเลือก จังหวัด ให้ถูกต้อง
                  </div>
                @endif


                @if ($errors->has('mydist'))
                  <div class="alert alert-warning" role="alert">
                    กรุณาเลือก เขต/อำเภอ ให้ถูกต้อง
                  </div>
                @endif

                @if ($errors->has('mySubDist'))
                  <div class="alert alert-warning" role="alert">
                    กรุณาเลือก แขวง/ตำบล ให้ถูกต้อง
                  </div>
                @endif

                @if ($errors->has('postal_codes'))
                  <div class="alert alert-warning" role="alert">
                    กรุณาเพิ่ม รหัสไปรษณีย์ ให้ถูกต้อง
                  </div>
                @endif


                
               
                
        </div>
    </div>  

<div class="col-md-12">
  <div class="card">
    <div class="card-body">
      <h4 class="card-title">เพิ่มที่อยู่ของลูกค้า</h4>
      <p class="card-description">
        กรอกข้อมูลให้ครบ ในส่วนที่มีเครื่องหมาย <span class="text-danger">*</span>
      </p>

      <form class="forms-sample" method="POST" action="{{ url('api/add_new_address') }}" enctype="multipart/form-data">
        {{ csrf_field() }}

        <div class="form-group">
          <label for="exampleInputUsername1">ชื่อ-นามสกุล <span class="text-danger">*</span></label>
          <input type="text" class="form-control" name="fname" value="{{ old('fname') }}">
          <input type="hidden" name="user_id" value="{{$id}}">
        </div>

        <div class="form-group">
          <label for="exampleInputUsername1">หมายเลขโทรศัพท์ <span class="text-danger">*</span></label>
          <input type="text" class="form-control" name="phone" value="{{ old('phone') }}">
        </div>

        <div class="form-group">
          <label for="exampleInputUsername1">เลขที่ <span class="text-danger">*</span></label>
          <input type="text" class="form-control" name="address_no" value="{{ old('address_no') }}">
        </div>

        <div class="form-group">
          <label for="exampleInputUsername1">ชื่ออาคาร/หมู่บ้าน </label>
          <input type="text" class="form-control" name="address_name" value="{{ old('address_name') }}">
        </div>

        <div class="form-group">
          <label for="exampleInputUsername1">ตรอก/ซอย </label>
          <input type="text" class="form-control" name="soi" value="{{ old('soi') }}">
        </div>

        <div class="form-group">
          <label for="exampleInputUsername1">ถนน </label>
          <input type="text" class="form-control" name="road" value="{{ old('road') }}">
        </div>

        <div class="form-group">
          <label for="exampleInputUsername1">จังหวัด </label>
          <select class="form-control" name="provi" id="input_province" onchange="showAmphoes()">
            <option > -- เลือกจังหวัด -- </option>
          </select>
        </div>

        <div class="form-group">
          <label for="exampleInputUsername1">เขต/อำเภอ </label>
          <select class="form-control" name="mydist" id="input_amphoe" onchange="showTambons()">
          </select>
        </div>

        <div class="form-group">
          <label for="exampleInputUsername1">แขวง/ตำบล </label>
          <select class="form-control" name="mySubDist" id="input_tambon" onchange="showZipcode()">
          </select>
        </div>

        <div class="form-group">
          <label for="exampleInputUsername1">รหัสไปรษณีย์ </label>
          <input type="text" class="form-control" id="input_zipcode" name="postal_codes">
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

</div>
<br><br><br><br><br><br><br><br>


@endsection

@section('scripts')


<script>
document.addEventListener('DOMContentLoaded', (event) => {
    console.log("START");
    showProvinces();    
});
function showProvinces(){
    //PARAMETERS
    fetch("{{ url('/') }}/provinces")
        .then(response => response.json())
        .then(result => {
            console.log(result);
            //UPDATE SELECT OPTION
            let input_province = document.querySelector("#input_province");
          //  input_province.innerHTML = "";
            for(let item of result){
                let option = document.createElement("option");
                option.text = item.name;
                option.value = item.id;
                input_province.add(option);                
            }
            //QUERY AMPHOES
            showAmphoes();
        });
}
function showAmphoes(){
    let input_province = document.querySelector("#input_province");
    fetch("{{ url('/') }}/province/"+input_province.value+"/amphoes")
        .then(response => response.json())
        .then(result => {
            console.log(result);
            //UPDATE SELECT OPTION
            let input_amphoe = document.querySelector("#input_amphoe");
            input_amphoe.innerHTML = "";
            for(let item of result){
                let option = document.createElement("option");
                option.text = item.name;
                option.value = item.id;
                input_amphoe.add(option);                
            }
            //QUERY AMPHOES
         //   showTambons();
        });
}
function showTambons(){
    let input_province = document.querySelector("#input_province");
    let input_amphoe = document.querySelector("#input_amphoe");
    fetch("{{ url('/') }}/province/"+input_province.value+"/amphoe/"+input_amphoe.value+"/tambons")
        .then(response => response.json())
        .then(result => {
            console.log(result);
            //UPDATE SELECT OPTION
            let input_tambon = document.querySelector("#input_tambon");
            input_tambon.innerHTML = "";
            for(let item of result){
                let option = document.createElement("option");
                option.text = item.name;
                option.value = item.id;
                input_tambon.add(option);                
            }
            //QUERY AMPHOES
            showZipcode();
        });
}
function showZipcode(){
    let input_province = document.querySelector("#input_province");
    let input_amphoe = document.querySelector("#input_amphoe");
    let input_tambon = document.querySelector("#input_tambon");
    fetch("{{ url('/') }}/province/"+input_province.value+"/amphoe/"+input_amphoe.value+"/tambon/"+input_tambon.value+"/zipcodes")
        .then(response => response.json())
        .then(result => {
            console.log(result);
            //UPDATE SELECT OPTION
            let input_zipcode = document.querySelector("#input_zipcode");
            input_zipcode.value = "";
            for(let item of result){
                input_zipcode.value = item.code;
                break; 
            }
        });
    
}
</script>

@stop('scripts')