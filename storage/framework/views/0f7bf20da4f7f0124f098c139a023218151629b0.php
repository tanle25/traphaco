
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
            Cập nhật phòng ban
          </div>

        </div>

        <div class="card-body">
          <form action="<?php echo e(route('admin.department.update', $current_department->id )); ?>" method="post">
            <?php echo csrf_field(); ?>
            <div class="form-group">
              <label for="department_name_input">Tên phòng ban</label>
                <input name="department_name" type="text" value="<?php echo e($current_department->department_name); ?>" class="form-control" id="department_name_input" placeholder="Nhập tên phòng ban">
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
              <label for="department_name_input">Người quản lý</label>
              <select name="manager_id" class="form-control select2"">
                <?php $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                  <option value="<?php echo e($user->id); ?>" <?php echo e($user->id == $current_department->manager_id ? 'selected' : ''); ?> ><?php echo e($user->fullname); ?></option>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
              </select>
              <?php $__errorArgs = ['manager_id'];
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

            <button class="btn btn-traphaco" style="background">
              Lưu thông tin
            </button>
            <a href="<?php echo e(route('admin.department.index')); ?>" class="float-right btn btn-traphaco">Tạo mới</a>
          </form>
          
        </div>
      </div>
    </section>
    <!-- ./col -->
    <section class="col-lg-8 col-12">
      <div class="card">

        <div class="card-header">
          <div class="card-title">
            Bố trí nhân sự
          </div>

        </div>

        <div class="card-body">

          <ul class="todo-list" data-widget="todo-list">
            <?php $__currentLoopData = $user_positions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user_position): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <li>
              <!-- drag handle -->
              <span class="handle">
                <i class="fas fa-ellipsis-v"></i>
                <i class="fas fa-ellipsis-v"></i>
              </span>
              <!-- todo text -->
              <span class="text"><?php echo e($user_position->name); ?></span>
              <!-- Emphasis label -->
              <small class="badge badge-danger">Level <?php echo e($user_position->level); ?></small>
              <!-- General tools such as edit or delete-->
              <div class="tools">
                <i class="fas fa-edit" data-toggle="modal" data-name="<?php echo e($user_position->name); ?>" data-level=" <?php echo e($user_position->level); ?>"  data-id="<?php echo e($user_position->id); ?>" data-target="#editItemModel"></i>
                <i class="fas fa-trash" onclick="deleteItem(<?php echo e($user_position->id); ?>)"></i>
              </div>
            </li>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            

          </ul>
          

        </div>
        <div class="card-footer clearfix">
          <button data-toggle="modal" data-target="#addItemModel" type="button" class="btn btn-info float-right"><i class="fas fa-plus"></i> Thêm chức vụ</button>
        </div>

        <div class="modal fade" id="addItemModel" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Thêm vị trí mới</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <form action="<?php echo e(route('admin.user_position.store')); ?>" method="post">
                <?php echo csrf_field(); ?>
                <div class="modal-body">
                  <input type="hidden" name="department_id" value="<?php echo e($current_department->id); ?>">

                  <div class="form-group">
                    <label for="user-position-name">Tên chức vụ</label>
                    <input name="name" type="text" class="form-control" id="user-postion-name" placeholder="Nhập tên chức vụ">
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

                  <div class="form-group">
                    <label for="user-position-name">Level</label>
                    <input name="level" type="text" class="form-control" id="user-postion-name" placeholder="Nhập level (So với tổng giám đốc)">
                    <?php $__errorArgs = ['level'];
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
                <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                  <button type="submit" class="btn btn-traphaco">Thêm mới</button>
                </div>
              </form>
            </div>
          </div>
        </div>

        <div class="modal fade" id="editItemModel" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Sửa vị trí</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <form action="<?php echo e(route('admin.user_position.update')); ?>" method="post">
                <?php echo csrf_field(); ?>
                <div class="modal-body">
                  <input type="hidden" name="department_id" value="<?php echo e($current_department->id); ?>">
                  <input type="hidden" name="user_position_id" id="user-position-id-update">
                  <div class="form-group">
                    <label for="user-position-name-update">Tên chức vụ</label>
                    <input name="name_update" type="text" class="form-control" id="user-position-name-update" value="" placeholder="Nhập tên chức vụ">
                    <?php $__errorArgs = ['name_update'];
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
                    <label for="user-position-level-update">Level</label>
                    <input name="level_update" type="text" class="form-control" id="user-position-level-update" placeholder="Nhập level (So với tổng giám đốc)">
                    <?php $__errorArgs = ['level_update'];
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
                <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
                  <button type="submit" class="btn btn-traphaco">Cập nhật</button>
                </div>
              </form>
            </div>
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
    //Initialize Select2 Elements
$('.select2').select2();
</script>

<script>
const MenuToast = Swal.mixin({
	toast: true,
	position: 'bottom-end',
	showConfirmButton: false,
	timer: 3000
});
$(document).on("click", ".todo-list .tools .fa-edit", function () {
     var userPositionId = $(this).data('id');
     var userPositionName = $(this).data('name');
     var userPositionLevel = $(this).data('level');

     $("#user-position-name-update").val( userPositionName );
     $("#user-position-level-update").val( userPositionLevel );
     $("#user-position-id-update").val( userPositionId );
});
  
function deleteUserPosition(id) {

		$.ajaxSetup({
			headers: {
				'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
			},
		});

        $.ajax({
            type: 'post',
            url: "<?php echo e(route('admin.user_position.destroy')); ?>",
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
			setTimeout(function () {
				location.reload();
			}, 500)
        })
    }


function deleteItem(id) {
	Swal.fire({
		title: 'Are you sure?',
		text: "You won't be able to revert this!",
		icon: 'warning',
		showCancelButton: true,
		confirmButtonColor: '#3085d6',
		cancelButtonColor: '#d33',
		confirmButtonText: 'Yes, delete it!'
	})
	.then((result) => {
		if (result.value) {
			deleteUserPosition(id);

		}
	})
}



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

<?php $__env->stopSection(); ?>


<?php echo $__env->make('admin.main_layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH E:\DEV\Employees management\HR manager\resources\views/admin/pages/departments/edit.blade.php ENDPATH**/ ?>