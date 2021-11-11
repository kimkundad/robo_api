<nav class="navbar horizontal-layout col-lg-12 col-12 p-0">

<style>
  .brand-logo-mini22 {
    display: none;
}
.btn-hamburger {
    border: none;
    position: absolute;
    top: 5px;
    left: 12px;
    outline: none;
    background: url('{{ url('slideout/test/assets/hamber1.png') }}') no-repeat center;
    width: 50px;
    height: 50px;
}
@media (min-width: 40em){
    .btn-hamburger {
    top: 10px;
    left: 30px;
    }
  }
  @media screen and (max-width: 767px){
    
  }
  @media (max-width: 991.98px){
    .brand-logo-mini22 {
    display: block;
}
  }

</style>
      <div class="nav-top flex-grow-1">
        <div class="container d-flex flex-row h-100 align-items-center">
          <div class="text-center navbar-brand-wrapper d-flex align-items-center" >

            <button class="btn-hamburger brand-logo-mini22 js-slideout-toggle" ></button>

            <a class="navbar-brand brand-logo" href="{{ url('admin/dashboard') }}"><img src="{{ url('img/PromptRUB Original.png') }}" alt="logo"/></a>
            <a class="navbar-brand brand-logo-mini" href="{{ url('admin/dashboard') }}"><img src="{{ url('img/PromptRUB Original.png') }}" alt="logo"/></a>
          </div>
          <div class="navbar-menu-wrapper d-flex align-items-center justify-content-between flex-grow-1">

            <ul class="navbar-nav navbar-nav-right mr-0 ml-auto">

              <li class="nav-item nav-profile dropdown">
                <a class="nav-link dropdown-toggle" href="#" data-toggle="dropdown" id="profileDropdown">
                  <img src="{{ url('back/avatar/1483537975.png') }}" alt="profile"/>
                  <span class="nav-profile-name"> {{ Auth::user()->name }} </span>
                </a>
                <div class="dropdown-menu dropdown-menu-right navbar-dropdown" aria-labelledby="profileDropdown">
                  

                  <div class="dropdown-divider"></div>
                  <a class="dropdown-item" href="{{ url('logout') }}">
                    <i class="icon-logout text-primary mr-2"></i>
                    ออกจากระบบ
                  </a>
                </div>
              </li>
            </ul>
            <button class="navbar-toggler align-self-center" type="button" data-toggle="minimize">
              <span class="icon-menu text-dark"></span>
            </button>
          </div>
        </div>
      </div>

      <div class="nav-bottom">
        <div class="container">
          
          <ul  class="nav page-navigation">
            <li class="nav-item">
              <a href="{{ url('admin/dashboard') }}" class="nav-link"><i class="link-icon icon-grid"></i><span class="menu-title">Dashboard</span></a>
            </li>

            <li class="nav-item">
              <a href="{{ url('admin/user') }}" class="nav-link"><i class="link-icon icon-user"></i><span class="menu-title">ผู้ใช้งาน</span></a>
            </li>

            <li class="nav-item">
              <a href="{{ url('admin/company') }}" class="nav-link"><i class="link-icon icon-compass"></i><span class="menu-title">การสมัครของร้านค้า</span></a>
            </li>

            <li class="nav-item">
              <a href="#" class="nav-link"><i class="link-icon icon-home"></i><span class="menu-title">จัดการร้านค้า</span></a>
            </li>

            <li class="nav-item">
              <a href="#" class="nav-link"><i class="fa fa-dollar" style="font-size:18px"></i><span class="menu-title"> ธนาคารและช่องทางการชำระเงิน</span></a>
            </li>

            <li class="nav-item">
              <a href="{{ url('admin/get_file_version') }}" class="nav-link"><i class="link-icon icon-present"></i><span class="menu-title">Firmware version</span></a>
            </li>

            <li class="nav-item">
              <a href="{{ url('admin/blog') }}" class="nav-link"><i class="link-icon icon-basket-loaded"></i><span class="menu-title">e-Commerce</span></a>
            </li>
 
            <li class="nav-item">

              <a href="{{ url('admin/setting') }}" class="nav-link"><i class="link-icon icon-settings"></i><span class="menu-title">ตั้งค่าเว็บ RBT</span> <i class="menu-arrow"></i></a>
              <div class="submenu">
                <ul class="submenu-item">
                  <li class="nav-item"> <a href="{{ url('admin/setting') }}" class="nav-link"> ตั้งค่าเว็บไซต์ </a></li>
                  <li class="nav-item"> <a href="{{ url('admin/thai_day') }}" class="nav-link"> ตั้งค่าวันสำคัญ </a></li>
                  <li class="nav-item"> <a href="{{ url('admin/banner') }}" class="nav-link"> รองรับการชำระ </a></li>
                  <li class="nav-item"><a class="nav-link" href="{{ url('admin/cat_file') }}"> หมวดหมู่ไฟล์</a></li>
                  <li class="nav-item"><a class="nav-link" href="{{ url('admin/get_file') }}"> ไฟล์เอกสาร </a></li>
                  <li class="nav-item"><a class="nav-link" href="{{ url('admin/get_qr_type') }}"> ประเภท QR </a></li>
                </ul>
              </div>
              
            </li>

          </ul>
        </div>
      </div>
    </nav>
