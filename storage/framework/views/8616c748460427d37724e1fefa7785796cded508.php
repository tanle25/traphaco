
<?php $__env->startSection('title'); ?>
  Quản lý đợt khảo sát
<?php $__env->stopSection(); ?>

<?php $__env->startSection('custom-css'); ?>
<link rel="stylesheet" href="<?php echo e(asset('template/AdminLTE/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css')); ?>">
<link rel="stylesheet" href="<?php echo e(asset('template/AdminLTE/plugins/datatables-responsive/css/responsive.bootstrap4.min.css')); ?>">
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<?php echo $__env->make('admin.partials.content_header', ['title' => 'Quản lý đợt khảo sát'], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<div class="row">
    <section class="col-12">

        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Thông tin đợt khảo sát</h3>
        </div>
        <form action="<?php echo e(route('admin.survey_round.store')); ?>" class="row card-body" method="post">
          <?php echo csrf_field(); ?>
          <div class="col-md-6 col-12">
            <div class="form-group">
              <label for="">Tên đợt khảo sát</label>
              <input name="name" type="text" class="form-control" id=""
                placeholder="Nhập đợt khảo sát mới (Bắt buộc)" value="<?php echo e(old('fullname')); ?>">
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
          </div>
    
          <div class="col-md-6 col-12">
            <div class="form-group">
              <label for="">Người tạo</label>
              <input name="" type="text" class="form-control" id="" readonly
                placeholder="Nhập password (Bắt buộc)" value="<?php echo e(Auth::user()->fullname); ?>">
              <input type="hidden" name="created_by" value="<?php echo e(Auth::user()->id); ?>">
            </div>
          </div>
        
          <button type="submit" class="btn btn-primary ml-2">Lưu thông tin</button>
        </form>      
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
    
</script>

<?php $__env->stopSection(); ?>


<?php echo $__env->make('admin.main_layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH E:\DEV\Employees management\HR manager\resources\views/admin/pages/survey_round/create.blade.php ENDPATH**/ ?>