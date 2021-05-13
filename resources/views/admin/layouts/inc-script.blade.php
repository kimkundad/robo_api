<script src="{{ url('back/vendors/js/vendor.bundle.base.js') }}"></script>
  <script src="{{ url('back/vendors/js/vendor.bundle.addons.js') }}"></script>
  <!-- endinject -->
  <!-- Plugin js for this page-->
  <!-- End plugin js for this page-->
  <!-- inject:js -->
  <script src="{{ url('back/js/template.js') }}"></script>
  <!-- endinject -->
  <!-- Custom js for this page-->
  <script src="{{ url('back/js/dashboard.js') }}"></script>
  <script src="{{ url('back/js/todolist.js') }}"></script>
  <script src="{{ url('back/vendors/summernote/dist/summernote-bs4.min.js') }}"></script>
<script src="{{ url('back/js/dropify.js') }}"></script>

  <!-- End custom js for this page-->
  <script>
  @if ($message = Session::get('add_success'))
  $.toast({
    heading: 'Success',
    text: 'ระบบทำการเพิ่มข้อมูลให้แล้ว.',
    showHideTransition: 'slide',
    icon: 'success',
    loaderBg: '#f96868',
    position: 'top-right'
  })
  @endif


  @if ($message = Session::get('edit_success'))
  $.toast({
    heading: 'Success',
    text: 'ระบบทำการแก้ไขข้อมูลให้แล้ว.',
    showHideTransition: 'slide',
    icon: 'success',
    loaderBg: '#f96868',
    position: 'top-right'
  })
  @endif

  @if ($message = Session::get('del_success'))
  $.toast({
    heading: 'Success',
    text: 'ระบบทำการลบข้อมูลให้แล้ว.',
    showHideTransition: 'slide',
    icon: 'success',
    loaderBg: '#f96868',
    position: 'top-right'
  })
  @endif
  </script>
