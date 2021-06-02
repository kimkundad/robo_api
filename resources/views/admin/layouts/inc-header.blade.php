<nav class="navbar horizontal-layout col-lg-12 col-12 p-0">
      <div class="nav-top flex-grow-1">
        <div class="container d-flex flex-row h-100 align-items-center">
          <div class="text-center navbar-brand-wrapper d-flex align-items-center">
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
                  <a class="dropdown-item">
                    
					
                  </a>
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
          <ul class="nav page-navigation">
            <li class="nav-item">
              <a href="{{ url('admin/dashboard') }}" class="nav-link"><i class="link-icon icon-screen-desktop"></i><span class="menu-title">Dashboard</span></a>
            </li>


            <li class="nav-item">

              <a href="#" class="nav-link"><i class="link-icon icon-user"></i><span class="menu-title">ข้อมูลผู้ใช้งาน</span> <i class="menu-arrow"></i></a>
              <div class="submenu">
                <ul class="submenu-item">
                  <li class="nav-item"> <a href="{{ url('admin/user') }}" class="nav-link"> รายชื่อผู้ใช้งาน </a></li>
                  <li class="nav-item"><a class="nav-link" href="{{ url('admin/biller_id_user') }}"> Biller ID</a></li>
                </ul>
              </div>
              
            </li>


            <li class="nav-item">
              <a href="{{ url('admin/bank') }}" class="nav-link"><i class="link-icon icon-briefcase"></i><span class="menu-title">ธนาคาร</span></a>
            </li>

            <li class="nav-item">
              <a href="#" class="nav-link"><i class="link-icon icon-bag"></i><span class="menu-title">สินค้า</span></a>
            </li>

            <li class="nav-item">
              <a href="#" class="nav-link"><i class="link-icon icon-basket-loaded"></i><span class="menu-title">การสั่งซื้อ</span></a>
            </li>

            <li class="nav-item">
              <a href="#" class="nav-link"><i class="link-icon icon-present"></i><span class="menu-title">โค้ดส่วนลด</span></a>
            </li>

            <li class="nav-item">
              <a href="{{ url('admin/banner') }}" class="nav-link"><i class="link-icon icon-badge"></i><span class="menu-title">รองรับการชำระ</span></a>
            </li>
 
            <li class="nav-item">

              <a href="{{ url('admin/setting') }}" class="nav-link"><i class="link-icon icon-settings"></i><span class="menu-title">ตั้งค่าเว็บ</span> <i class="menu-arrow"></i></a>
              <div class="submenu">
                <ul class="submenu-item">
                  <li class="nav-item"> <a href="{{ url('admin/setting') }}" class="nav-link"> ตั้งค่าเว็บไซต์ </a></li>
                  <li class="nav-item"><a class="nav-link" href="{{ url('admin/cat_file') }}"> หมวดหมู่ไฟล์</a></li>
                  <li class="nav-item"><a class="nav-link" href="{{ url('admin/get_file') }}"> ไฟล์เอกสาร </a></li>
                  <li class="nav-item"><a class="nav-link" href="{{ url('admin/get_file_version') }}"> ไฟล์ version </a></li>
                </ul>
              </div>
              
            </li>
            


          </ul>
        </div>
      </div>
    </nav>
