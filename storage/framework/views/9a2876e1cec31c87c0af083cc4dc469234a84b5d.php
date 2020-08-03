

<?php $__env->startSection('custom-css'); ?>
<style>
    textarea {
        resize: none;
        overflow: hidden;
    }
</style>
<?php $__env->stopSection(); ?>


<?php $__env->startSection('title'); ?>
    Các bài khảo sát
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <?php echo $__env->make('admin.partials.content_header', ['title' => 'Chấm điểm bài test'], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title"><?php echo e($test->type == 1 ? 'Chấm điểm bài khảo sát' : 'Làm bài đánh giá chất lượng'); ?> </h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
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
                        <?php $__currentLoopData = $survey->section; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $section): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
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
                        <button href="<?php echo e(route('answer.store')); ?>" class="btn btn-primary send-result">Gửi kết quả</button>

                    </div> 


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
<script>
    
    $(document).on('click', '.send-result', function (e) {
        var url = $(this).attr('href');
        var questionCount = $('.question').length;
        var answer = [];
        $('.option-input:checked').each(function(){
            answer.push({
                question_id: $(this).data('question-id'),
                option_id: $(this).attr('value'),
                comment: $(this).closest('.question-option').find('.comment').val(),
            });     
        })

        if(questionCount !== answer.length){
            Swal.fire({
                title: 'Bạn chưa hoàn thành bài test!',
                text: "Vui lòng hoàn thành bài test trước khi gửi!",
                icon: 'warning',
                showCancelButton: true,
                showConfirmButton: false,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                cancelButtonText: 'Tôi hiểu',
            })
            return
        }

        Swal.fire({
            title: 'Hoàn thành bài test!',
            text: "Gửi kết quả!",
            icon: 'success',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Gửi kết quả!',
        })
        .then((result) => {
            console.log(answer);
            if (result.value) {
                $.ajax({
                    url: url,
                    type: "POST",
                    data: {
                        _token: $('meta[name="csrf-token"]').attr('content'),
                        answer: answer,
                        test_id: <?php echo e($test->id); ?>,
                    },
                    success: function (data) {
                        if (data.error) {
                            swalToast(data.error, 'error');
                        }
                        if (data.msg) {
                            swalToast(data.msg);
                        }
                        setTimeout(function () {
                            location.href = "<?php echo e(route('answer.index', ['marked' => 0])); ?>";
                        }, 300)
                    },
                    error: function (errors) {
                        swalToast('Lỗi không rõ phát sinh trong quá trình xóa', 'error');
                    }
                });
            }
        });
    })
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.main_layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH E:\DEV\Employees management\HR manager\resources\views/admin/pages/user_tests/mark.blade.php ENDPATH**/ ?>