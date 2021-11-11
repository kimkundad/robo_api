<!DOCTYPE html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>พร้อมรับ ก้าวสู่ยุค สังคมไร้เงินสด อย่างมีคุณภาพ</title>
  <!-- plugins:css -->
  <link rel="stylesheet" href="{{ url('back/vendors/iconfonts/simple-line-icon/css/simple-line-icons.css') }}">
  <link rel="stylesheet" href="{{ url('back/vendors/iconfonts/flag-icon-css/css/flag-icon.min.css') }}">
  <link rel="stylesheet" href="{{ url('back/vendors/css/vendor.bundle.base.css') }}">
  <link rel="stylesheet" href="{{ url('back/vendors/css/vendor.bundle.addons.css') }}">
  <!-- endinject -->
  <!-- plugin css for this page -->
  <!-- End plugin css for this page -->
  <!-- inject:css -->
  <link rel="stylesheet" href="{{ url('back/css/style.css') }}">
  <!-- endinject -->
  <link rel="shortcut icon" href="{{ url('back/images/promptRUB-fav-icon.png') }}" />
  <style>
  .auth.theme-two .banner-section .slide-content.bg-1 {
    background: url('{{ url('img/promptRUB-App-Banner@2x.png') }}') no-repeat center center;
}
.hidden{
  display:none;
}
</style>
</head>

<body>
  <div class="container-scroller">
    <div class="container-fluid page-body-wrapper full-page-wrapper">
      <div class="content-wrapper auth p-0 theme-two">
        <div class="row d-flex align-items-stretch">
          <div class="col-md-4 banner-section d-none d-md-flex align-items-stretch justify-content-center">
            <div class="slide-content bg-1">
            </div>
          </div>
          <div class="col-12 col-md-8 h-100 bg-white">
            <div class="auto-form-wrapper d-flex align-items-center justify-content-center flex-column">
              <div class="nav-get-started">
                
                
              </div>
              <form method="POST" action="https://siamtheatre.com/connect/authorize" >
                @csrf
                <h3 class="mr-auto">Hello! let's get started</h3>
                <p class="mb-5 mr-auto">Enter your details below.</p>

                @error('email')
                <div class="alert alert-danger" role="alert">
                    {{ $message }}
                </div>
                @enderror

                @error('password')
                <div class="alert alert-danger" role="alert">
                    {{ $message }}
                </div>
                @enderror

                @if($errors->any())
                <div class="alert alert-danger" role="alert">
                    {{ implode('', $errors->all(':message')) }}
                    </div>
                @endif


              <?php 

              session(['code_verifier' => $code_verifier = Str::random(128)]);

              $codeChallenge = strtr(rtrim(
                base64_encode(hash('sha256', $code_verifier, true))
              , '='), '+/', '-_');
                ?>

                <div class="form-group hidden">
                  <div class="input-group">
                    <div class="input-group-prepend">
                      <span class="input-group-text"><i class="icon-user"></i></span>
                    </div>
                    <input type="text" class="form-control" name="email" placeholder="Email Address"><br>
                    <input type="text" class="form-control"  name="redirect_uri" value="https://admin.robotel.co.th/oauth/admin/callback">
                    <input type="text" class="form-control"  name="client_id" value="robotel_web">
                    <input type="text" class="form-control"  name="client_secret" value="robotel_web">
                    <input type="text" class="form-control"  name="scope" value="openid profile IdentityServerApi">
                    <input type="text" class="form-control"  name="code_challenge" value="{{ $codeChallenge }}">
                    <input type="text" class="form-control"  name="code_challenge_method" value="S256">
                    <input type="text" class="form-control"  name="response_type" value="code">
                  </div>
                </div>
                <div class="form-group hidden">
                  <div class="input-group">
                    <div class="input-group-prepend">
                      <span class="input-group-text"><i class="icon-lock"></i></span>
                    </div>
                    <input type="password" name="password" class="form-control" placeholder="Password">
                  </div>
                </div>
                <div class="form-group">
                  <button class="btn btn-primary submit-btn" type="submit">SIGN IN</button>
                </div>
                <div class="wrapper mt-5 text-gray">
                  <p class="footer-text">Copyright © 2021 ROBOTEL CO., LTD. All rights reserved.</p>
                  <ul class="auth-footer text-gray">
                    <li><a href="https://www.robotel.co.th/terms" target="_blank">Terms & Conditions</a></li>
                    <li><a href="https://www.robotel.co.th/policy" target="_blank">Cookie Policy</a></li>
                  </ul>
                </div>
              </form>

            </div>
          </div>
        </div>
      </div>
      <!-- content-wrapper ends -->
    </div>
    <!-- page-body-wrapper ends -->
  </div>
  <!-- container-scroller -->
  <!-- plugins:js -->
  <script src="{{ url('back/vendors/js/vendor.bundle.base.js') }}"></script>
  <script src="{{ url('back/vendors/js/vendor.bundle.addons.js') }}"></script>
  <!-- endinject -->
  <!-- Plugin js for this page-->
  <!-- End plugin js for this page-->
  <!-- inject:js -->
  <script src="{{ url('back/js/template.js') }}"></script>
  <!-- endinject -->
  <!-- Custom js for this page-->
  <!-- End custom js for this page-->
</body>

</html>
