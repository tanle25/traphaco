

<?php $__env->startSection('custom-css'); ?>
##parent-placeholder-990972ed184ed228c47a5b9f7df38ea8328b55c4##
<link rel="stylesheet" href="<?php echo e(asset('template/AdminLTE/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css')); ?>">
<link rel="stylesheet" href="<?php echo e(asset('template/AdminLTE/plugins/datatables-responsive/css/responsive.bootstrap4.min.css')); ?>">
<?php $__env->stopSection(); ?>


<?php $__env->startSection('title'); ?>
  Chi tiết đợt khảo sát
<?php $__env->stopSection(); ?>


<?php $__env->startSection('content'); ?>
    <?php echo $__env->make('admin.partials.content_header', ['title' => 'Chi tiết đợt khảo sát'], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-header">
                <h2 class="card-title">Danh sách bài khảo sát khảo sát</h2>                
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <div class="mb-4">
                    <h5>
                        <strong>Người được khảo sát: </strong>  <?php echo e($candiate->fullname); ?>

                    </h5>
                    <h5>
                        <strong>Phòng ban: </strong><?php echo e($candiate->department->department_name ?? 'Không rõ phòng ban'); ?>

                    </h5>
                    <h5>
                        <strong>Chức vụ: </strong><?php echo e($candiate->position->name ?? 'Không rõ chức vụ'); ?>

                    </h5>
                </div>
                <div>
                    <?php $__currentLoopData = $tests; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $test): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="card bg-gradient-light collapsed-card">
                        <div class="card-header bg-gradient-success border-0" style="cursor: move;">
                          <h3 class="card-title">
                            <i class="fas fa-book-open"></i> &nbsp;&nbsp;&nbsp;
                            <?php echo e($test->survey->name); ?>

                          </h3>
                          <!-- tools card -->
                          <div class="card-tools">
                            <a class="btn btn-info" href="<?php echo e(route('admin.survey_round.details.export', ['id' => $test->survey_round, 'candiate_id' => $candiate->id, 'survey_id' => $test->survey->id])); ?>">Xuất excel</a>
                            <button type="button" class="btn btn-info btn-sm" data-card-widget="collapse">
                              <i class="fas fa-minus"></i> Xem chi tiết
                            </button>
                            <button type="button" class="btn btn-danger btn-sm" data-card-widget="remove">
                              <i class="fas fa-times"></i>
                            </button>
                          </div>
                          <!-- /. tools -->
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body pt-0" style="overflow: auto">
                          <!--The calendar -->
                            

                           <table class="table table-bordered mx-auto mt-4" style="overflow:scrollX; max-width: 1024px; min-width: 768px">
                            <thead>
                              <tr>
                                <th style="width: 5%" rowspan="2">TT</th>
                                <th  style="width: 40%" rowspan="2">Nội dung</th>
                                <th style="width: 40%" colspan="4">Kết quả điểm TB</th>
                                <th style="width: 10%" rowspan="2">% Năng lực</th>
                              </tr>
                              <tr>
                                <th style="width: 10%">Cấp trên đánh giá</th>
                                <th style="width: 10%">Ngang cấp đánh giá</th>
                                <th style="width: 10%">Cấp dưới đánh giá</th>
                                <th style="width: 10%">Bình quân chung</th>
                              </tr>
                              <tr>
                                <th></th>
                                <th>Điểm TB</th>
                                <th><?php echo e($test->survey->getScoreFromLevel($test->survey_round, $candiate->id, 3)); ?></th>
                                <th><?php echo e($test->survey->getScoreFromLevel($test->survey_round, $candiate->id, 2)); ?></th>
                                <th><?php echo e($test->survey->getScoreFromLevel($test->survey_round, $candiate->id, 1)); ?></th>
                                <th><?php echo e($test->survey->getAvgScore($test->survey_round, $candiate->id)); ?></th>
                                <th><?php echo e($test->survey->getScoreByPercent($test->survey_round, $candiate->id)); ?></th>
                              </tr>

                              <?php $__currentLoopData = $test->survey->section; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $section): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                              <tr>
                                <th></th>
                                <th><?php echo e($section->title ?? ''); ?></th>
                                <th><?php echo e($section->getScoreFromLevel($test->survey_round, $candiate->id, 3)); ?></th>
                                <th><?php echo e($section->getScoreFromLevel($test->survey_round, $candiate->id, 2)); ?></th>
                                <th><?php echo e($section->getScoreFromLevel($test->survey_round, $candiate->id, 1)); ?></th>
                                <th><?php echo e($section->getAvgScore($test->survey_round, $candiate->id)); ?></th>
                                <th><?php echo e($section->getScoreByPercent($test->survey_round, $candiate->id)); ?></th>
                              </tr>
                              <?php $__currentLoopData = $section->questions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $question): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                              

                              <tr>
                                <td><?php echo e($index+1); ?></td>
                                <td><?php echo e($question->content ?? ''); ?></td>
                                <td><?php echo e($question->getScoreFromLevel($test->survey_round, $candiate->id, 3)); ?></td>
                                <td><?php echo e($question->getScoreFromLevel($test->survey_round, $candiate->id, 2)); ?></td>
                                <td><?php echo e($question->getScoreFromLevel($test->survey_round, $candiate->id, 1)); ?></td>
                                <td><?php echo e($question->getAvgScore($test->survey_round, $candiate->id)); ?></td>
                                <td><?php echo e($question->getScoreByPercent($test->survey_round, $candiate->id)); ?></td>
                              </tr>
                              <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                              <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                            </thead>
                           </table>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                    
                </div>

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

  $(document).on('click', '.round-survey-delete', function(e){
            e.preventDefault();
            var url = $(this).attr('href');
            Swal.fire({
                title: 'Xóa đợt khảo sát này?',
                text: "Bạn không thể hoàn tác!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Vẫn xóa nó!',
            })
            .then((result) => {
                if (result.value) {
                    $.ajax({
                        url: url,
                        type: "POST",
                        data: {
                          _token: $('meta[name="csrf-token"]').attr('content')
                        },
                        success: function(data){
                            if(data.error){
                                swalToast(data.error, 'error');
                            }
                            if(data.msg){
                                swalToast(data.msg);
                            }
                            location.reload();
                        },
                        error: function(errors){
                            swalToast('Lỗi không rõ phát sinh trong quá trình xóa', 'error');
                        }
                    });
                }
            });
        })
</script>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.main_layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH E:\DEV\Employees management\HR manager\resources\views/admin/pages/survey_round/user_details.blade.php ENDPATH**/ ?>