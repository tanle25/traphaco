<?php $__env->startSection('custom-css'); ?>
##parent-placeholder-990972ed184ed228c47a5b9f7df38ea8328b55c4##
<link rel="stylesheet" href="<?php echo e(asset('template/AdminLTE/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css')); ?>">
<link rel="stylesheet" href="<?php echo e(asset('template/AdminLTE/plugins/datatables-responsive/css/responsive.bootstrap4.min.css')); ?>">
<?php $__env->stopSection(); ?>


<table id="survey-table" class="table table-bordered table-hover">
    <thead>
      <tr>
        <th>ID</th>
        <th>Tên bài khảo sát</th>
        <th>Người tạo</th>
        <th>Thao tác</th>
      </tr>
    </thead>
</table>
    
<?php $__env->startSection('custom-js'); ?>
##parent-placeholder-9861867d401053ff2325265a70136f5f44ff874e##
<script src="<?php echo e(asset('template/AdminLTE/plugins/datatables/jquery.dataTables.min.js')); ?>"></script>
<script src="<?php echo e(asset('template/AdminLTE/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js')); ?>"></script>
<script src="<?php echo e(asset('template/AdminLTE/plugins/datatables-responsive/js/dataTables.responsive.min.js')); ?>"></script>
<script src="<?php echo e(asset('template/AdminLTE/plugins/datatables-responsive/js/responsive.bootstrap4.min.js')); ?>"></script>
<script>
  $(function () {
    $("#survey-table").dataTable({
      processing: true,
      serverSide: true,
      autoWidth:false,
      order:true,
      ajax: "<?php echo e(route('admin.survey.list_survey')); ?>",
      columns: [
        { "data": "id" },
        { "data": "name" },
        { "data": "created_by" },
        { "data" :"action"}
      ]
    });
  });
</script>
<?php $__env->stopSection(); ?>
<?php /**PATH E:\DEV\Employees management\HR manager\resources\views/admin/pages/survey/table_survey.blade.php ENDPATH**/ ?>