<style>
    .hidden{
        display:none; 
    }
    .data-background-image-login {
    background-image: url('{{ url('img/BG@2x.png') }}');
    background-size: cover;
    background-position: 50%;
    background-color: #00326a;
}
</style>
<div class="container data-background-image-login" style="width:100%; height:100%">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header hidden">Dashboard</div>

                <div class="card-body">
                    


        <form class="forms-sample hidden" id="myForm" method="POST" action="https://siamtheatre.com/connect/authorize" enctype="multipart/form-data">
            <div class="form-group">
            
                <input type="text" class="form-control"  name="redirect_uri" value="https://api.robotel.co.th/oauth/robotel/callback">
                <input type="text" class="form-control"  name="client_id" value="robotel_web">
                <input type="text" class="form-control"  name="client_secret" value="robotel_web">
                <input type="text" class="form-control"  name="scope" value="openid profile IdentityServerApi">
                <input type="text" class="form-control"  name="code_challenge" value="{{ $codeChallenge }}">
                <input type="text" class="form-control"  name="code_challenge_method" value="S256">
                <input type="text" class="form-control"  name="response_type" value="code">
                
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
</div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script>
$(document).ready(function(){

    $('form#myForm').submit();

});
</script>
