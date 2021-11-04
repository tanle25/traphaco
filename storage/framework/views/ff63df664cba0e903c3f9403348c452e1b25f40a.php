<?php $__env->startSection('title'); ?>
  Quản lý người dùng
<?php $__env->stopSection(); ?>

<?php $__env->startSection('custom-css'); ?>
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
                            <div class="form-group row">
                                <label class=" col-sm-3" for="">Họ và tên</label>
                                <div class="col-sm-9">

                                <input name="fullname" type="text" class="form-control" id=""
                                placeholder="Nhập tên người dùng mới (*)" value="<?php echo e(old('fullname')); ?>">
                                </div>
                                <?php $__errorArgs = ['fullname'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <strong class="text-red"> <?php echo e($message); ?> </strong> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                            </div>

                            <div class="form-group row">
                                <label class="col-sm-3" for="nationality">Quốc tịch</label>
                                <div class="col-sm-9">
                                <input type="text" class="form-control" name="nationality" id="nationality" placeholder="Quốc tịch">

                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-3" for="registration-number">Số đăng ký sở hữu</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" name="registration_number" id="registration-number" placeholder="Số đăng ký sở hữu">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-3" for="date-range">Ngày cấp</label>
                                <div class="col-sm-3">
                                    <input type="text" class="form-control" name="date_range" id="date-range" placeholder="Ngày cấp">
                                </div>
                                <label class="col-sm-3 text-center" for="place-issued">Nơi cấp</label>
                                <div class="col-sm-3">
                                    <input type="text" class="form-control" name="place_issued" id="place-issued" placeholder="Nơi cấp">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-sm-3" for="deputy">Người đại diện <small><i> (đối với cổ đông tổ chức)</i></small></label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" name="deputy" id="deputy" placeholder="Người đại diện">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-sm-3" for="document-number">Số giấy tờ pháp lý </label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" name="document_number" id="document-number" placeholder="Số giấy tờ pháp lý">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-3" for="address">Địa chỉ liên lạc</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" name="address" id="address" placeholder="Địa chỉ liên lạc">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-3" for="number-share">Số lượng cổ phần sở hữu</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" name="number_share" id="number-share" placeholder="Số lượng cổ phần sở hữu">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-3" for="">Username</label>
                                <div class="col-sm-9">
                                    <input name="username" type="text" class="form-control" id=""
                                    placeholder="Nhập tên đăng nhập (*)" value="<?php echo e(old('username')); ?>">
                                </div>
                                <?php $__errorArgs = ['username'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <strong class="text-red"> <?php echo e($message); ?> </strong> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                            </div>

                            <div class="form-group row">
                                <label class="col-sm-3" for="email">Email</label>
                                <div class="col-sm-9">
                                    <input name="email" type="text" class="form-control" id="email" placeholder="Nhập Email" value="<?php echo e(old('email')); ?>">
                                </div>
                                <?php $__errorArgs = ['email'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> <strong class="text-red"> <?php echo e($message); ?>  </strong> <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                            </div>

                            <div class="form-group row">
                                <label class="col-sm-3" for="password">Password</label>
                                <div class="col-sm-9">
                                    <input name="password" type="text" class="form-control" id="password" placeholder="Nhập password (*)">
                                </div>
                                <?php $__errorArgs = ['password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                <strong class="text-red"> <?php echo e($message); ?> </strong>
                                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                            </div>

                            <div class="form-group row">
                                <label class="col-sm-3" for="department-select">Phòng ban trực thuộc</label>
                                <div class="col-sm-9">
                                    <select name="department_id" class="form-control select2" id="department-select">
                                        <?php $__currentLoopData = $departments; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $department): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option value="<?php echo e($department->id); ?>"><?php echo e($department->department_name); ?></option>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </select>
                                </div>

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

							<div class="form-group row">
                                <label for="position-select" class="col-sm-3">Chức vụ</label>
                                <div class="col-sm-9">
                                    <select name="position_id" class="form-control" id="position-select">
                                        <?php $__currentLoopData = $user_positions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user_position): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option value="<?php echo e($user_position->id); ?>" data-department-id=<?php echo e($user_position->department->id ?? ''); ?>><?php echo e($user_position->name); ?></option>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </select>
                                </div>

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

                        <div class="col-md-6 col-12">

                            <?php echo $__env->make('admin.pages.user_manage.role_form', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

                        </div>
                    </div>
                    <button class="btn btn-traphaco">
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


<?php echo $__env->make('admin.main_layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/admin/web/dg.traphaco.vn/public_html/resources/views/admin/pages/user_manage/create.blade.php ENDPATH**/ ?>