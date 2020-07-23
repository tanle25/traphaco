
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
<?php echo $__env->make('admin.partials.content_header', ['title' => 'Quản lý user'], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>


<div class="row">
    <section class="col-12">
        <div class="card">
            <div class="card-header">
                <div class="card-title">
                    Tạo mới User
                </div>
            </div>

            <div class="card-body">
                <form action="<?php echo e(route('admin.usermanage.store')); ?>" method="post">
                    <?php echo csrf_field(); ?>
                    <div class="row">
                        <div class="col-md-6 col-12">
                            <div class="form-group">
                                <label for="">Họ và tên</label>
                                <input name="fullname" type="text" class="form-control" id=""
                                    placeholder="Nhập tên người dùng mới (Bắt buộc)" value="<?php echo e(old('fullname')); ?>">
                                <?php $__errorArgs = ['fullname'];
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
                                <label for="">Username</label>
                                <input name="username" type="text" class="form-control" id=""
                                    placeholder="Nhập tên đăng nhập (Bắt buộc)" value="<?php echo e(old('username')); ?>">
                                <?php $__errorArgs = ['username'];
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
                                <label for="">Email</label>
                                <input name="email" type="text" class="form-control" id="" placeholder="Nhập Email" value="<?php echo e(old('email')); ?>">
                                <?php $__errorArgs = ['email'];
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
                                <label for="">Password</label>
                                <input name="password" type="text" class="form-control" id=""
                                    placeholder="Nhập password (Bắt buộc)">
                                <?php $__errorArgs = ['password'];
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
                                <label>Phòng ban trực thuộc</label>
                                <select name="department_id" class="form-control select2" id="department-select">
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
                                <label>Chức vụ</label>
                                <select name="position_id" class="form-control " id="position-select">
                                    <?php $__currentLoopData = $user_positions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user_position): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <option value="<?php echo e($user_position->id); ?>" data-department-id=<?php echo e($user_position->department->id ?? ''); ?>><?php echo e($user_position->name); ?></option>
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
                                <label class="d-block">Quyền Admin</label>
                                <input type="checkbox" class="form-control" name="is_admin" data-bootstrap-switch data-off-color="danger" data-on-color="success">
                            </div>
                        </div>
                    </div>
                    <button class="btn btn-primary">
                        Lưu thông tin
                    </button>
                </form>
            </div>
        </div>
    </section>
    </section>
</div>


<?php $__env->stopSection(); ?> 

<?php $__env->startSection('custom-js'); ?>
<script src="<?php echo e(asset('template/js/nestable.js')); ?>"></script>
<script src="<?php echo e(asset('template/AdminLTE/plugins/bootstrap-switch/js/bootstrap-switch.min.js')); ?>"></script>


<script>
    //Initialize Select2 Elements
$('.select2').select2();

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
    
    $('#department-select').on('change', function(){
        var id = $(this).val();
        getPostion(id);
    })
    function getPostion(id) {
        var temp = 1;
        $('#position-select option').each(function(index){
            if($(this).data('department-id') == id){
                $(this).show();
                if(temp == 1){
                    temp = 0;
                    $('#position-select').val($(this).val())
                }
            }
            else{
                $(this).hide();
            }
        });
    }
    
    getPostion($('#department-select').val());
</script>



<?php $__env->stopSection(); ?>


<?php echo $__env->make('admin.main_layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH E:\DEV\Employees management\HR manager\resources\views/admin/pages/user_manage/create.blade.php ENDPATH**/ ?>