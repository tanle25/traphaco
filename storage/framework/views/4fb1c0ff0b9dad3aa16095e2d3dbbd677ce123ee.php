<?php $__env->startSection('custom-css'); ?>
##parent-placeholder-990972ed184ed228c47a5b9f7df38ea8328b55c4##
<link rel="stylesheet" href="<?php echo e(asset('template/AdminLTE/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css')); ?>">
<link rel="stylesheet" href="<?php echo e(asset('template/AdminLTE/plugins/datatables-responsive/css/responsive.bootstrap4.min.css')); ?>">
<?php $__env->stopSection(); ?>


<?php $__env->startSection('title'); ?>
  Quản lý user
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <?php echo $__env->make('admin.partials.content_header', ['title' => 'Quản lý người dùng'], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Danh sách người dùng</h3>
                <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('thêm user')): ?>
                  <a href="<?php echo e(route('admin.usermanage.import')); ?>" class="ml-3 btn btn-success float-right">
                    <i class="fas fa-plus-circle nav-icon">Import</i>
                  </a>
                  <a href="<?php echo e(route('admin.usermanage.create')); ?>" class="btn btn-success float-right">
                    <i class="fas fa-plus-circle nav-icon"> Thên mới</i>
                  </a>
                <?php endif; ?>
                

              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <?php echo $__env->make('admin.pages.user_manage.table', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
      </div>
      <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
<?php $__env->stopSection(); ?> 

<?php $__env->startSection('custom-js'); ?>
##parent-placeholder-9861867d401053ff2325265a70136f5f44ff874e##
<script src="<?php echo e(asset('template/AdminLTE/plugins/datatables/jquery.dataTables.min.js')); ?>"></script>
<script src="<?php echo e(asset('template/AdminLTE/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js')); ?>"></script>
<script src="<?php echo e(asset('template/AdminLTE/plugins/datatables-responsive/js/dataTables.responsive.min.js')); ?>"></script>
<script src="<?php echo e(asset('template/AdminLTE/plugins/datatables-responsive/js/responsive.bootstrap4.min.js')); ?>"></script>
<script>
  $(function () {
    $("#user-table").dataTable({
      processing: true,
      serverSide: true,
      autoWidth:false,
      scrollX:true,
      ajax: "<?php echo e(route('admin.usermanage.list_user')); ?>",
      columns: [
        { "data": "DT_RowIndex","name": 'DT_Row_Index' , "orderable": false, "searchable": false},
        { "data": "username"},
        { "data": "fullname" },
        { "data": "email" },
        { "data": "department_name" },
        { "data" :"action"}
      ]
    });
  });
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.main_layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/admin/web/dg.traphaco.vn/public_html/resources/views/admin/pages/user_manage/list.blade.php ENDPATH**/ ?>