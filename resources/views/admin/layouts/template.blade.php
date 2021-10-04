<!DOCTYPE html>
<html lang="en">
<?php header('Access-Control-Allow-Origin: *'); ?>
<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title> @yield('title')</title>
  <!-- plugins:css -->
  @include('admin.layouts.inc-style')
  @yield('stylesheet')

</head>

<body>

<div id="menu" class="nav-bottom2 menu slideout-menu slideout-menu-left">
        <div class="container">
          
          <ul id="menu" class="nav2 page-navigation">
            <li class="nav-item2">
              <a href="{{ url('admin/dashboard') }}" class="nav-link2"><i class="link-icon icon-screen-desktop"></i><span class="menu-title"> Dashboard</span></a>
            </li>


            <li class="nav-item2">

              <a href="#" class="nav-link2"><i class="link-icon icon-user"></i><span class="menu-title"> ข้อมูลผู้ใช้งาน</span> <i class="menu-arrow"></i></a>
              <div class="submenu">
                <ul class="submenu-item">
                  <li class="nav-item2"> <a href="{{ url('admin/user') }}" class="nav-link2"> รายชื่อผู้ใช้งาน </a></li>
                  <li class="nav-item2"><a class="nav-link2" href="{{ url('admin/biller_id_user') }}"> Biller ID</a></li>
                  <li class="nav-item2"><a class="nav-link2" href="{{ url('admin/api_request_user') }}"> ข้อมูล API</a></li>
                </ul>
              </div>
              
            </li>


            <li class="nav-item2">
              <a href="{{ url('admin/bank') }}" class="nav-link2"><i class="link-icon icon-briefcase"></i><span class="menu-title"> ธนาคาร</span></a>
            </li>

            <li class="nav-item2">
              <a href="#" class="nav-link2"><i class="link-icon icon-bag"></i><span class="menu-title"> สินค้า</span></a>
            </li>

            <li class="nav-item2">
              <a href="#" class="nav-link2"><i class="link-icon icon-basket-loaded"></i><span class="menu-title"> การสั่งซื้อ</span></a>
            </li>

            <li class="nav-item2">
              <a href="#" class="nav-link2"><i class="link-icon icon-present"></i><span class="menu-title"> โค้ดส่วนลด</span></a>
            </li>

            <li class="nav-item2">
              <a href="{{ url('admin/blog') }}" class="nav-link2"><i class="link-icon icon-trophy"></i><span class="menu-title"> บทความ</span></a>
            </li>
 
            <li class="nav-item2">

              <a href="{{ url('admin/setting') }}" class="nav-link2"><i class="link-icon icon-settings"></i><span class="menu-title"> ตั้งค่าเว็บ</span> <i class="menu-arrow"></i></a>
              <div class="submenu">
                <ul class="submenu-item">
                  <li class="nav-item2"> <a href="{{ url('admin/setting') }}" class="nav-link2"> ตั้งค่าเว็บไซต์ </a></li>
                  <li class="nav-item2"> <a href="{{ url('admin/banner') }}" class="nav-link2"> รองรับการชำระ </a></li>
                  <li class="nav-item2"><a class="nav-link2" href="{{ url('admin/cat_file') }}"> หมวดหมู่ไฟล์</a></li>
                  <li class="nav-item2"><a class="nav-link2" href="{{ url('admin/get_file') }}"> ไฟล์เอกสาร </a></li>
                  <li class="nav-item2"><a class="nav-link2" href="{{ url('admin/get_file_version') }}"> ไฟล์ version </a></li>
                  <li class="nav-item2"><a class="nav-link2" href="{{ url('admin/get_qr_type') }}"> ประเภท QR </a></li>
                </ul>
              </div>
              
            </li>
            


          </ul>
        </div>
      </div>


  <div class="container-scroller" id="panel">
    
    <!-- partial:partials/_horizontal-navbar.html -->
    @include('admin.layouts.inc-header')

    <!-- partial -->
    <div class="container-fluid page-body-wrapper" >
      <div class="main-panel">
        <div class="content-wrapper">


          @yield('content')


        </div>
        <!-- content-wrapper ends -->
        <!-- partial:partials/_footer.html -->
        @include('admin.layouts.inc-footer')
        <!-- partial -->
      </div>
      <!-- main-panel ends -->
    </div>
    <!-- page-body-wrapper ends -->
   
   
  </div>
  <!-- container-scroller -->

  <!-- plugins:js -->
  @include('admin.layouts.inc-script')
  @yield('scripts')
</body>

</html>
