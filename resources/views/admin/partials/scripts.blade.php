
<!-- jQuery -->
<script src="{{asset('template/AdminLTE/plugins/jquery/jquery.min.js')}}"></script>
<!-- jQuery UI 1.11.4 -->
<script src="{{asset('template/AdminLTE/plugins/jquery-ui/jquery-ui.min.js')}}"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
  $.widget.bridge('uibutton', $.ui.button)
</script>
<!-- Bootstrap 4 -->
<script src="{{asset('template/AdminLTE/plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
<!-- ChartJS -->
<script src="{{asset('template/AdminLTE/plugins/chart.js/Chart.min.js')}}"></script>
<!-- Sparkline -->
{{-- <script src="{{asset('template/AdminLTE/plugins/sparklines/sparkline.js')}}"></script> --}}
<!-- JQVMap -->
{{-- <script src="{{asset('template/AdminLTE/plugins/jqvmap/jquery.vmap.min.js')}}"></script>
<script src="{{asset('template/AdminLTE/plugins/jqvmap/maps/jquery.vmap.usa.js')}}"></script> --}}
<!-- jQuery Knob Chart -->
<script src="{{asset('template/AdminLTE/plugins/jquery-knob/jquery.knob.min.js')}}"></script>
<!-- daterangepicker -->
<script src="{{asset('template/AdminLTE/plugins/moment/moment.min.js')}}"></script>
<script src="{{asset('template/AdminLTE/plugins/daterangepicker/daterangepicker.js')}}"></script>
<!-- Tempusdominus Bootstrap 4 -->
<script src="{{asset('template/AdminLTE/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js')}}"></script>
<!-- Summernote -->
<script src="{{asset('template/AdminLTE/plugins/summernote/summernote-bs4.min.js')}}"></script>
<!-- overlayScrollbars -->
<script src="{{asset('template/AdminLTE/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js')}}"></script>
<!-- AdminLTE App -->
<script src="{{asset('template/AdminLTE/dist/js/adminlte.js')}}"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
{{-- <script src="{{asset('template/AdminLTE/dist/js/pages/dashboard.js')}}"></script> --}}
<!-- AdminLTE for demo purposes -->
{{-- <script src="{{asset('template/AdminLTE/dist/js/demo.js')}}"></script> --}}
<!-- SWAL2 -->
<script src="{{asset('template\AdminLTE\plugins\sweetalert2\sweetalert2.all.min.js')}}"></script>
<!-- Select 2 -->
<script src="{{asset('template\AdminLTE\plugins\select2\js\select2.full.min.js')}}"></script>

@include('admin.partials.alert')
<!-- Page script -->
<script>
  $(function () {
    //Initialize Select2 Elements
    $('.select2').select2()

    //Initialize Select2 Elements
    $('.select2bs4').select2({
      theme: 'bootstrap4'
    })
  })

  function swalToast(message, type = 'success', position = 'top-end') {
    Swal.mixin({
      toast: true,
      position: position,
      showConfirmButton: false,
      timer: 3000
    }).fire({
      type: type,
      icon: type,
      title: message,
    })
  }

  function auto_grow(element) {
    element.style.height = "5px";
    element.style.height = (element.scrollHeight) + "px" ;
  }

  $('.table').on('draw.dt', function(){
    $('[data-toggle-for="tooltip"]').tooltip({
      placement: 'auto',
    });
  });

  function checkCurrentLocaionMenu(){
    var currentUrl = window.location.href;
    $('.sidebar .nav-link').each(function(){
      if(currentUrl.indexOf($(this).attr('href')) !== -1 ){
        $(this).closest('.nav-item.has-treeview').addClass('menu-open');
      }
    })
  }
  checkCurrentLocaionMenu();
</script>

@yield('custom-js')