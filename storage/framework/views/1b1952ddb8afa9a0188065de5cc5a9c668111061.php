<?php $__env->startSection('custom-css'); ?>
##parent-placeholder-990972ed184ed228c47a5b9f7df38ea8328b55c4##
<link rel="stylesheet" href="<?php echo e(asset('template/AdminLTE/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css')); ?>">
<link rel="stylesheet" href="<?php echo e(asset('template/AdminLTE/plugins/datatables-responsive/css/responsive.bootstrap4.min.css')); ?>">
<?php $__env->stopSection(); ?>


<?php $__env->startSection('title'); ?>
  Quản lý user
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <?php echo $__env->make('admin.partials.content_header', ['title' => 'Bài đánh giá'], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Danh sách bài đánh giá</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="test-table" class="table table-bordered table-hover">
                    <thead>
                      <tr>
                        <th>ID</th>
                        <th>Đợt đánh giá</th>
                        <th>Tên bài đánh giá</th>
                        <th>Người được đánh giá</th>
                        <th>Thời gian bắt đầu</th>
                        <th>Thời gian kết thúc</th>
                        <th>Trọng số</th>
                        <th>Trạng thái</th>
                        <th>Thao tác</th>
                      </tr>
                    </thead>
                  </table>                
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
    $("#test-table").dataTable({
      processing: true,
      serverSide: true,
      autoWidth:false,
      scrollX:true,
      ajax:{
        url: "<?php echo e(route('answer.list_test')); ?>",
        data: {
          marked: <?php echo e($marked ?? ''); ?>

        }
      } ,
      columns: [
        { "data": "DT_RowIndex","name": 'DT_Row_Index' , "orderable": false, "searchable": false},
        { "data": "survey_round", 'name': 'survey_round.name' },
        { "data": "survey_name", 'name': 'survey_name' },
        { "data": "candiate" },
        { "data": 'start_at', 'name': 'test_time.start_at'},
        { "data": 'end_at', 'name': 'test_time.end_at'},
        { "data": "multiplier"},
        { "data": "status" },
        { "data": "action"},
      ]
    });
  });
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.main_layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/admin/web/dg.traphaco.vn/public_html/resources/views/admin/pages/user_tests/list.blade.php ENDPATH**/ ?>