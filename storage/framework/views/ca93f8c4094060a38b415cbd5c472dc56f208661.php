
<?php $__env->startSection('title'); ?>
  Quản lý đợt khảo sát
<?php $__env->stopSection(); ?>

<?php $__env->startSection('custom-css'); ?>
<link rel="stylesheet" href="<?php echo e(asset('template/AdminLTE/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css')); ?>">
<link rel="stylesheet" href="<?php echo e(asset('template/AdminLTE/plugins/datatables-responsive/css/responsive.bootstrap4.min.css')); ?>">
<link rel="stylesheet" href="<?php echo e(asset('template/css/multiple-select.min.css')); ?>">
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<?php echo $__env->make('admin.partials.content_header', ['title' => 'Quản lý đợt khảo sát'], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>



<div class="row">
    <section class="col-12">

        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Thông tin đợt khảo sát</h3>
        </div>
        <form action="<?php echo e(route('admin.survey_round.update', $survey_round->id)); ?>" class="row card-body" method="post">
          <?php echo csrf_field(); ?>
          <div class="col-md-6 col-12">
            <div class="form-group">
              <label for="">Tên đợt khảo sát</label>
              <input name="name" type="text" class="form-control" id=""
                placeholder="Nhập đợt khảo sát mới (Bắt buộc)" value="<?php echo e($survey_round->name ?? ''); ?>">
              <?php $__errorArgs = ['name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
              <strong class="text-red">
                <?php echo e($message); ?>

              </strong>
              <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
            </div>
          </div>
    
          <div class="col-md-6 col-12">
            <div class="form-group">
              <label for="">Người tạo</label>
              <input name="" type="text" class="form-control" id="" readonly
                placeholder="Nhập password (Bắt buộc)" value="<?php echo e(Auth::user()->fullname); ?>">
              <input type="hidden" name="created_by" value="<?php echo e(Auth::user()->id); ?>">
            </div>
          </div>
        
          <button type="submit" class="btn btn-traphaco ml-2">Lưu thông tin</button>
        </form>      
        </div>

        <div class="card">
            <div class="card-header">
              <h3 class="card-title">Quản lý bài test</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <?php echo $__env->make('admin.pages.survey_round.table', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            </div>
            <!-- /.card-body -->
        </div>
    </section>
    </section>
</div>


<?php $__env->stopSection(); ?> 

<?php $__env->startSection('custom-js'); ?>
<script src="<?php echo e(asset('template/js/nestable.js')); ?>"></script>
<script src="<?php echo e(asset('template/AdminLTE/plugins/bootstrap-switch/js/bootstrap-switch.min.js')); ?>"></script>
<script src="<?php echo e(asset('template/AdminLTE/plugins/datatables/jquery.dataTables.min.js')); ?>"></script>
<script src="<?php echo e(asset('template/AdminLTE/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js')); ?>"></script>
<script src="<?php echo e(asset('template/AdminLTE/plugins/datatables-responsive/js/dataTables.responsive.min.js')); ?>"></script>
<script src="<?php echo e(asset('template/AdminLTE/plugins/datatables-responsive/js/responsive.bootstrap4.min.js')); ?>"></script>
<script src="<?php echo e(asset('template/js/multiple-select.min.js')); ?>"></script>
<script>
    //Initialize Select2 Elements
$('.select2').select2({
});

$('.select2').on('select2:select', function(e){
//console.log(e.params.data.element.getAttribute('value'));
selectContain = e.target;

if(e.params.data.element.classList.contains('department')){
  el = e.params.data.element;
  departmentId = el.getAttribute('department-holder');
  selectContain.querySelectorAll(`option[department-holder="${departmentId}"]`).forEach(function(item){
    item.selected = true;
  });
  $(".select2").trigger("change");
}



});

$("input[data-bootstrap-switch]").each(function(){
    $(this).bootstrapSwitch('state', $(this).prop('checked'));
});
</script>

<script>
    const MenuToast = Swal.mixin({
        toast: true,
        position: 'bottom-end',
        showConfirmButton: false,
        timer: 3000
    });
</script>

<?php if($errors->hasAny(['name', 'department_id', 'level'])): ?> {
<script>
  $('#addItemModel').modal('show')
</script>
<?php endif; ?>

<?php if($errors->hasAny(['name_update','level_update'])): ?> {
  <script>
    $('#editItemModel').modal('show')
  </script>
<?php endif; ?>

<script>
	
	$(document).on('blur', '.multipiler-input', function(){
		var url = $(this).attr('href');
		var value = $(this).val();
		$.ajax({
			url: url,
			type: "POST",
			data: {
				value: value,
				_token: $('meta[name="csrf-token"]').attr('content')
			},
			success: function (data) {
				if (data.warning) {
					swalToast(data.warning, 'warning');
				}
				if (data.msg) {
					swalToast(data.msg);
				}
				//location.reload();
			},
			error: function (errors) {
				swalToast(errors.responseJSON.errors.value[0], 'error');
			}
		});
	});

	
	$(document).on('click', '.send-test', function(){
		var url = $(this).attr('href');
		$.ajax({
			url: url,
			type: "POST",
			data: {
				_token: $('meta[name="csrf-token"]').attr('content')
			},
			success: function (data) {
				if (data.warning) {
					swalToast(data.warning, 'warning');
				}
				if (data.msg) {
					swalToast(data.msg);
				}
				location.reload();
			},
			error: function (errors) {
				swalToast('Lỗi không rõ phát sinh trong quá trình gửi', 'error');
			}
		});
	});

    $(document).on('click', '.test-delete', function (e) {
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
                        success: function (data) {
                            if (data.error) {
                                swalToast(data.error, 'error');
                            }
                            if (data.msg) {
                                swalToast(data.msg);
                            }
                            location.reload();
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


<?php echo $__env->make('admin.main_layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH E:\DEV\Employees management\HR manager\resources\views/admin/pages/survey_round/edit.blade.php ENDPATH**/ ?>