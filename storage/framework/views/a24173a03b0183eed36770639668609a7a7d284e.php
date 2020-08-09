<?php $__env->startSection('title'); ?>
  Trang quản trị
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>

<?php echo $__env->make('admin.partials.content_header', ['title' => 'Trang chủ'], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<div class="row">
    <div class="col-lg-3 col-6">
      <!-- small box -->
      <div class="small-box bg-info">
        <div class="inner">
          <h3><?php echo e(Auth::user()->asExaminerTests->where('status', '2')->count()); ?></h3>

          <p>Bài khảo sát mới</p>
        </div>
        <div class="icon">
          <i class="ion ion-bag"></i>
        </div>
        <a href="<?php echo e(route('answer.index', ['marked' => 0])); ?>" class="small-box-footer">Chi tiết <i class="fas fa-arrow-circle-right"></i></a>
      </div>
    </div>
    <!-- ./col -->
    <div class="col-lg-3 col-6">
      <!-- small box -->
      <div class="small-box bg-success">
        <div class="inner">
          <h3><?php echo e(Auth::user()->asExaminerTests->where('status', '3')->count()); ?><sup style="font-size: 20px"></sup></h3>
          <p>Bài khảo sát đã hoàn thành</p>
        </div>
        <div class="icon">
          <i class="ion ion-stats-bars"></i>
        </div>
        <a href="<?php echo e(route('answer.index', ['marked' => 1])); ?>" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
      </div>
    </div>
    <!-- ./col -->
    <!-- ./col -->
</div>

  <!-- /.row (main row) -->
<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.main_layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/admin/web/dg.traphaco.vn/public_html/resources/views/admin/pages/home.blade.php ENDPATH**/ ?>