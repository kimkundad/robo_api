@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Dashboard</div>

                <div class="card-body">
                    


        <form class="forms-sample" method="POST" action="https://siamtheatre.com/connect/authorize" enctype="multipart/form-data">
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
@endsection
