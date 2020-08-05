

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
                        <strong>Chức vụ ban: </strong><?php echo e($candiate->porsition->name ?? 'Không rõ chức vụ'); ?>

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
                        <div class="card-body pt-0">
                          <!--The calendar -->
                            <div class="card card-info mx-auto mt-3" style="max-width: 1024px">
                               <div class="card-header">
                                   <h2>
                                       <?php echo e($test->survey->title ?? ''); ?>

                                   </h2>
                                   <div>
                                       <h5><?php echo e($test->survey->content ?? ''); ?></h5>
                                   </div>
                                   <div class="mt-3">
                                       <h5>
                                           <?php echo e($test->type == 1 ? 'Người được khảo sát' : 'Người làm bài'); ?>: <?php echo e($test->candiate->fullname); ?> |<?php echo e($test->candiate->department->department_name ?? ''); ?> - <?php echo e($test->candiate->position->department_name ?? ''); ?> , Trọng số: <?php echo e($test->multiplier); ?>

                                       </h5>
                                   </div>
                               </div>
           
                               <div class="card-body">
                                   <?php $__currentLoopData = $test->survey->section; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $section): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                   <div class="section-header mb-3">
                                       <h3>
                                           <?php echo e($section->title); ?>

                                       </h3>
                                   </div>
                                   
                                   <?php $__currentLoopData = $section->questions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $question): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                       <div class="mb-3 question">
                                           <div class="question-title">
                                               <h5> <strong> Câu hỏi:</strong><?php echo e($question->content ?? ''); ?></h5>
                                           </div>
                                           <div class="question-option pt-2">
                                               <div class="row" style="font-size: 18px">  
                                                   <?php $__currentLoopData = $question->options; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $option): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                   <div class="form-group col-md-3 d-flex justify-center align-center">
                                                       <input class="option-input" type="radio" style="height:23px; width:23px" data-question-id="<?php echo e($question->id); ?>" name="question-<?php echo e($question->id); ?>" value="<?php echo e($option->id); ?>">
                                                       <span class="pl-2" style="line-height: 23px"><?php echo e($option->content ?? ''); ?>

                                                           <?php if($test->type == 1): ?>
                                                           (<?php echo e($option->score ?? 0); ?> điểm)</span>
                                                           <?php endif; ?> 
                                                   </div>
                                                   <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?> 
                                               </div>
                                               <div class="form-group">
                                                   <textarea class="form-control comment" value="" oninput="auto_grow(this)" rows="1" placeholder="Nhận xét"></textarea>
                                               </div>
                                           </div>
                                       </div>  
                                       <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                   <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>           
                               </div> 
           
           
                           </div>
           
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