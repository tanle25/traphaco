


<?php $__env->startSection('title'); ?>
  Quản lý Khảo sát
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <?php echo $__env->make('admin.partials.content_header', ['title' => 'Bài khỏa sát'], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Danh sách bài khảo sát</h3>
                <a href="<?php echo e(route('admin.survey.create')); ?>" class="btn float-right btn-success">
                  <i class="far fa-file nav-icon"> Thêm mới</i>
                </a>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <?php echo $__env->make('admin.pages.survey.table_survey', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
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
    <script>
        $(document).on('click', '.remove-survey-btn', function(e){
            e.preventDefault();
            var url = $(this).attr('href');
            console.log('hellop');
            Swal.fire({
                title: 'Xóa bài khảo sát này?',
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


<?php echo $__env->make('admin.main_layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH E:\DEV\Employees management\HR manager\resources\views/admin/pages/survey/list.blade.php ENDPATH**/ ?>