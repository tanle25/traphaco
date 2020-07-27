
<!-- jQuery -->
<script src="<?php echo e(asset('template/AdminLTE/plugins/jquery/jquery.min.js')); ?>"></script>
<!-- jQuery UI 1.11.4 -->
<script src="<?php echo e(asset('template/AdminLTE/plugins/jquery-ui/jquery-ui.min.js')); ?>"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
  $.widget.bridge('uibutton', $.ui.button)
</script>
<!-- Bootstrap 4 -->
<script src="<?php echo e(asset('template/AdminLTE/plugins/bootstrap/js/bootstrap.bundle.min.js')); ?>"></script>
<!-- ChartJS -->
<script src="<?php echo e(asset('template/AdminLTE/plugins/chart.js/Chart.min.js')); ?>"></script>
<!-- Sparkline -->
<script src="<?php echo e(asset('template/AdminLTE/plugins/sparklines/sparkline.js')); ?>"></script>
<!-- JQVMap -->
<script src="<?php echo e(asset('template/AdminLTE/plugins/jqvmap/jquery.vmap.min.js')); ?>"></script>
<script src="<?php echo e(asset('template/AdminLTE/plugins/jqvmap/maps/jquery.vmap.usa.js')); ?>"></script>
<!-- jQuery Knob Chart -->
<script src="<?php echo e(asset('template/AdminLTE/plugins/jquery-knob/jquery.knob.min.js')); ?>"></script>
<!-- daterangepicker -->
<script src="<?php echo e(asset('template/AdminLTE/plugins/moment/moment.min.js')); ?>"></script>
<script src="<?php echo e(asset('template/AdminLTE/plugins/daterangepicker/daterangepicker.js')); ?>"></script>
<!-- Tempusdominus Bootstrap 4 -->
<script src="<?php echo e(asset('template/AdminLTE/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js')); ?>"></script>
<!-- Summernote -->
<script src="<?php echo e(asset('template/AdminLTE/plugins/summernote/summernote-bs4.min.js')); ?>"></script>
<!-- overlayScrollbars -->
<script src="<?php echo e(asset('template/AdminLTE/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js')); ?>"></script>
<!-- AdminLTE App -->
<script src="<?php echo e(asset('template/AdminLTE/dist/js/adminlte.js')); ?>"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="<?php echo e(asset('template/AdminLTE/dist/js/pages/dashboard.js')); ?>"></script>
<!-- AdminLTE for demo purposes -->
<script src="<?php echo e(asset('template/AdminLTE/dist/js/demo.js')); ?>"></script>
<!-- SWAL2 -->
<script src="<?php echo e(asset('template\AdminLTE\plugins\sweetalert2\sweetalert2.all.min.js')); ?>"></script>
<!-- Select 2 -->
<script src="<?php echo e(asset('template\AdminLTE\plugins\select2\js\select2.full.min.js')); ?>"></script>

<?php echo $__env->make('admin.partials.alert', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
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
</script>

<?php echo $__env->yieldContent('custom-js'); ?>
<?php /**PATH E:\DEV\Employees management\HR manager\resources\views/Admin/partials/scripts.blade.php ENDPATH**/ ?>