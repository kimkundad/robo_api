<link rel="stylesheet" href="{{ url('back/vendors/iconfonts/simple-line-icon/css/simple-line-icons.css') }}">
  <link rel="stylesheet" href="{{ url('back/vendors/iconfonts/flag-icon-css/css/flag-icon.min.css') }}">
  <link rel="stylesheet" href="{{ url('back/vendors/iconfonts/font-awesome/css/font-awesome.min.css') }}">
  <link rel="stylesheet" href="{{ url('back/vendors/css/vendor.bundle.base.css') }}">
  <link rel="stylesheet" href="{{ url('back/vendors/css/vendor.bundle.addons.css') }}">
  <!-- endinject -->
  <!-- plugin css for this page -->
  <!-- End plugin css for this page -->
  <!-- inject:css -->
  <link rel="stylesheet" href="{{ url('back/css/style.css') }}">
  <!-- endinject -->
  <link rel="shortcut icon" href="{{ url('back/images/favicon.png') }}" />
  <link rel="stylesheet" href="{{ url('back/vendors/summernote/dist/summernote-bs4.css') }}">
  <style>


/* The switch - the box around the slider */
.switch {
  position: relative;
  display: inline-block;
  width: 53px;
  height: 26px;
}

/* Hide default HTML checkbox */
.switch input {
  opacity: 0;
  width: 0;
  height: 0;
}

/* The slider */
.slider {
  position: absolute;
  cursor: pointer;
  top: 0;
  left: 0;
  right: 0;
  bottom: 0;
  background-color: #ccc;
  -webkit-transition: .4s;
  transition: .4s;
}

.slider:before {
  position: absolute;
  content: "";
  height: 18px;
  width: 18px;
  left: 4px;
  bottom: 4px;
  background-color: white;
  -webkit-transition: .4s;
  transition: .4s;
}

input:checked + .slider {
  background-color: #2196F3;
}

input:focus + .slider {
  box-shadow: 0 0 1px #2196F3;
}

input:checked + .slider:before {
  -webkit-transform: translateX(26px);
  -ms-transform: translateX(26px);
  transform: translateX(26px);
}

/* Rounded sliders */
.slider.round {
  border-radius: 34px;
}

.slider.round:before {
  border-radius: 50%;
}
.navbar.horizontal-layout .nav-bottom .page-navigation > .nav-item > .nav-link .menu-title {
    font-size: 12px;
    font-weight: 500;
}

  @media (max-width: 991.98px){
    .navbar.horizontal-layout .nav-bottom {
  
}
  }

  .slideout-menu {
  position: fixed;
  top: 0;
  bottom: 0;
  width: 256px;
  min-height: 100vh;
  overflow-y: scroll;
  -webkit-overflow-scrolling: touch;
  z-index: 0;
  display: none;
}

.slideout-menu-left {
  left: 0;
}

.slideout-menu-right {
  right: 0;
}
.pull-right{
  float:right;
}
.slideout-panel {
  position: relative;
  z-index: 1;
  will-change: transform;
  background-color: #FFF; /* A background-color is required */
  min-height: 100vh;
}

.slideout-open,
.slideout-open body,
.slideout-open .slideout-panel {
  overflow: hidden;
}

.slideout-open .slideout-menu {
  display: block;
}
.nav-bottom2 {
  padding-top:50px;
  color:#fff;
    background: #090e40;
}
.nav2{
  
  list-style: none;
  display: flex;
  flex-wrap: wrap;
    padding-left: 0;
    margin-bottom: 0;
}
.nav-link2{
  
  color:#fff;
  display: block;
    white-space: nowrap;
    text-overflow: ellipsis;
    font-size: 0.8rem;
}
.nav-item2{
  width: 100%;

  padding: 10px 20px;
}
.mar-r-5{
  margin-right:8px;
  padding-top:10px;
}
@media (max-width: 767.98px){
  .navbar.horizontal-layout .nav-top .navbar-brand-wrapper .brand-logo-mini {
    position: absolute;
    left: 60px;
    display: block;
}
}

  </style>