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
  <link rel="shortcut icon" href="{{ url('back/images/favicon.png') }}" />
  <link rel="stylesheet" href="{{ url('back/vendors/summernote/dist/summernote-bs4.css') }}">
  <link rel="stylesheet" href="{{ url('back/vendors/lightgallery/css/lightgallery.css') }}">
  <style>
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
@media (max-width: 767.98px){
  .navbar.horizontal-layout .nav-top .navbar-brand-wrapper .brand-logo-mini {
    position: absolute;
    left: 60px;
    display: block;
}
}

  </style>