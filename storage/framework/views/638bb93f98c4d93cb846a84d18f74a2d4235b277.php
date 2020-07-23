

<?php
    $list_root = $departments->filter(function ($value) {
        return $value->parent_id == null;
    });
?>

<?php $__env->startSection('title'); ?>
  Quản lý phòng ban
<?php $__env->stopSection(); ?>

<?php $__env->startSection('custom-css'); ?>
  <link rel="stylesheet" href="<?php echo e(asset('template/css/nestable.min.css')); ?>">
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
  <?php echo $__env->make('admin.partials.content_header', ['title' => 'Quản lý phòng ban'], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
  <div class="row">
    <section class="col-lg-4 col-12">
      <div class="card">

        <div class="card-header">
          <div class="card-title">
            Tạo mới phòng ban
          </div>

        </div>

        <div class="card-body">
          <form action="<?php echo e(route('admin.department.store')); ?>" method="post">
            <?php echo csrf_field(); ?>
            <div class="form-group">
              <label for="department_name_input">Tên phòng ban</label>
              <input name="department_name" type="text" class="form-control" id="department_name_input" placeholder="Nhập tên phòng ban">
              <?php $__errorArgs = ['department_name'];
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

            <div class="form-group">
              <label>Phòng ban trực thuộc</label>
              <select name="parent_id" class="form-control select2"">
                <option value="" selected="selected">--ROOT--</option>
                <?php $__currentLoopData = $departments; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $department): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                  <option value="<?php echo e($department->id); ?>"><?php echo e($department->department_name); ?></option>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
              </select>
              <?php $__errorArgs = ['parent_id'];
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

            <div class="form-group">
              <label for="department_name_input">Người quản lý</label>
              <select name="manager_id" class="form-control select2"">
                <option value="">Trống</option>
                <?php $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                  <option value="<?php echo e($user->id); ?>"><?php echo e($user->fullname); ?></option>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
              </select>
              <?php $__errorArgs = ['manage_id'];
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

            <div class="form-group">
              <label for="department_name_input">Thứ tự</label>
              <input name="sort" type="number" class="form-control" placeholder="Số thứ tự">
            </div>

            <button class="btn btn-primary">
              Lưu thông tin
            </button>
          </form>
        </div>
      </div>
    </section>
    <!-- ./col -->
    <section class="col-lg-8 col-12">
      <div class="card">

        <div class="card-header">
          <div class="card-title">
            Danh sách phòng ban
          </div>
        </div>

        <div class="card-body">
          <div id="department-list" class="dd">
            <?php echo $__env->make('admin.pages.departments.department_tree_child', ['list' => $list_root], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
          </div>
        </div>


      </div>

    </section>
    <!-- ./col -->
</div>

<?php $__env->stopSection(); ?> 

<?php $__env->startSection('custom-js'); ?>
  <script src="<?php echo e(asset('template/js/nestable.js')); ?>"></script>

  <script>
    const MenuToast = Swal.mixin({
        toast: true,
        position: 'bottom-end',
        showConfirmButton: false,
        timer: 3000
    });

    $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
        });

    function saveTree(data){
        $.ajax({
            type: 'post',
            url: "<?php echo e(route('admin.department.savetree')); ?>",
            data: {
                jsonData:data,
            },
        }).done(function (result) {
            MenuToast.fire({
                icon: 'success',
                type: 'success',
                title: 'Cập nhật phòng ban thành công'
            })
        })
    }

    function deleteDepartment(id) {
        $.ajax({
            type: 'post',
            url: "<?php echo e(route('admin.department.destroy')); ?>",
            data: {
                id:id,
            },
        }).done(function (result) {
            MenuToast.fire({
                icon: 'success',
                type: 'success',
                title: result.message
            });
            if(result.error){
              MenuToast.fire({
                  type: 'error',
                  title: result.error
              })
            }
        })
    }

    
    $('#department-list').nestable();
    $('.dd').on('change', function() {
        var data = $('.dd').nestable('serialize');
        saveTree(data);
    });
    //Initialize Select2 Elements
    $('.select2').select2();

    $('.dd-item .remove-department').on('click', function(){
      let id = $(this).attr('data-id');
        Swal.fire({
			title: 'Are you sure?',
			text: "You won't be able to revert this!",
			icon: 'warning',
			showCancelButton: true,
			confirmButtonColor: '#3085d6',
			cancelButtonColor: '#d33',
			confirmButtonText: 'Yes, delete it!',
		})
		.then((result) => {
			if (result.value) {
				$(this).parent().parent().parent().remove();
				deleteDepartment(id);
			}
		})
    })
</script>



<?php $__env->stopSection(); ?>
<?php echo $__env->make('admin.main_layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH E:\DEV\Employees management\HR manager\resources\views/admin/pages/departments/list.blade.php ENDPATH**/ ?>