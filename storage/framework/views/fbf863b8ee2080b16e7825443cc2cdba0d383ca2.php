<!DOCTYPE html>
<html>
    <?php echo $__env->make('admin.partials.head', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">
    <?php echo $__env->make('admin.partials.nav', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <?php echo $__env->make('admin.partials.sidebar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <!-- Main content -->
    <section class="content">
    <div class="container-fluid">
    <?php echo $__env->yieldContent('content'); ?>
    </div>
    </section>
    <!-- /.content -->
  </div>
    <?php echo $__env->make('admin.partials.footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <!-- Control Sidebar -->
    
    <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->
<?php echo $__env->make('admin.partials.scripts', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
</body>
</html>
<?php /**PATH /home/admin/web/dg.traphaco.vn/public_html/resources/views/admin/main_layout.blade.php ENDPATH**/ ?>