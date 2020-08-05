<ul class="nav nav-tabs" id="myTab" role="tablist">
    <li class="nav-item">
      <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">Bài khảo sát</a>
    </li>
    <li class="nav-item">
      <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">Bài đánh giá năng lực</a>
    </li>

</ul>
<div class="tab-content" id="myTabContent">
    <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
        <form action="<?php echo e(route('admin.test.store')); ?>" class="row mb-3" method="post">
            <?php echo csrf_field(); ?>
            <input type="hidden" name="survey_round_id" value="<?php echo e($survey_round->id); ?>">
            <input type="hidden" name="test_type" value="1">
            <div class="form-group col-md-4">
                <label>Chọn bài khảo sát</label>
                <select name="survey_id[]" multiple="multiple" class="form-control select2" id="survey-select">
                    <?php $__currentLoopData = $survey; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <?php if($item->type == 1): ?>
                        <option value="<?php echo e($item->id); ?>"><?php echo e($item->name); ?></option>
                        <?php endif; ?>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </select>
                <?php $__errorArgs = ['survey_id'];
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
            
            <div class="form-group col-md-4">
                <label>Chọn người được chấm</label>
                <select name="candiate_id[]" multiple="multiple" class="form-control select2" id="candiate-select">
                    <?php $__currentLoopData = $departments; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $department): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option class="department" department-holder="<?php echo e($department->id); ?>"><?php echo e($department->department_name); ?></option>
                        <?php $__currentLoopData = $department->users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option department-holder="<?php echo e($department->id); ?>"  value="<?php echo e($user->id); ?>"><?php echo e($user->fullname ?? ''); ?> <?php echo e($user->department ? "| ". $user->department->department_name : ''); ?> <?php echo e($user->position ? ' - '. $user->position->name . "" : ' '); ?> </option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    <option value="1"  class="department" department-holder="x">Khong ro phong ban</option>
                    <?php $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <?php if($user->department == null): ?>
                        <option data-department="1000" department-holder="x"  value="<?php echo e($user->id); ?>"><?php echo e($user->fullname ?? ''); ?> </option>
                        <?php endif; ?>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </select>
                <?php $__errorArgs = ['candiate_id'];
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
        
            <div class="form-group col-md-4">
                <label>Chọn người chấm</label>
                <select name="examiner_id[]" multiple="multiple" class="form-control select2" id="examiner-select">
                    <?php $__currentLoopData = $departments; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $department): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option class="department" department-holder="<?php echo e($department->id); ?>"><?php echo e($department->department_name); ?></option>
                        <?php $__currentLoopData = $department->users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option department-holder="<?php echo e($department->id); ?>"  value="<?php echo e($user->id); ?>"><?php echo e($user->fullname ?? ''); ?> <?php echo e($user->department ? "| ". $user->department->department_name : ''); ?> <?php echo e($user->position ? ' - '. $user->position->name . "" : ' '); ?> </option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    <option value="1"  class="department" department-holder="x">Khong ro phong ban</option>
                    <?php $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <?php if($user->department == null): ?>
                        <option data-department="1000" department-holder="x"  value="<?php echo e($user->id); ?>"><?php echo e($user->fullname ?? ''); ?> </option>
                        <?php endif; ?>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </select>
                <?php $__errorArgs = ['examiner_id'];
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
            <div class="form-group col-md-4">
                <button type="submit" class="btn btn-traphaco">Thêm bài test</button>
            </div>
        </form>
    </div>
    <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
        <form action="<?php echo e(route('admin.test.store2')); ?>" class="row mb-3" method="post">
            <?php echo csrf_field(); ?>
            <input type="hidden" name="survey_round_id" value="<?php echo e($survey_round->id); ?>">
            <input type="hidden" name="test_type" value="2">

            <div class="form-group col-md-4">
                <label>Chọn bài đánh giá</label>
                <select name="survey_id[]" multiple="multiple" class="form-control select2" id="survey-select2">
                    <?php $__currentLoopData = $survey; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <?php if($item->type == 2): ?>
                        <option value="<?php echo e($item->id); ?>"><?php echo e($item->name); ?></option>
                        <?php endif; ?>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </select>
                <?php $__errorArgs = ['survey_id'];
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
            
            <div class="form-group col-md-4">

                <label>Chọn người được chấm</label>
                <select name="candiate_id[]" multiple="multiple" class="form-control select2" id="candiate-select2">
                    <?php $__currentLoopData = $departments; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $department): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option class="department" department-holder="<?php echo e($department->id); ?>"><?php echo e($department->department_name); ?></option>
                        <?php $__currentLoopData = $department->users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option department-holder="<?php echo e($department->id); ?>"  value="<?php echo e($user->id); ?>"><?php echo e($user->fullname ?? ''); ?> <?php echo e($user->department ? "| ". $user->department->department_name : ''); ?> <?php echo e($user->position ? ' - '. $user->position->name . "" : ' '); ?> </option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    <option value="1"  class="department" department-holder="x">Khong ro phong ban</option>
                    <?php $__currentLoopData = $users; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $user): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <?php if($user->department == null): ?>
                        <option data-department="1000" department-holder="x"  value="<?php echo e($user->id); ?>"><?php echo e($user->fullname ?? ''); ?> </option>
                        <?php endif; ?>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </select>
                
                <?php $__errorArgs = ['candiate_id'];
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

     

            <div class="form-group col-12">
                <button type="submit" class="btn btn-traphaco">Thêm bài test</button>
            </div>
        </form>   
    </div>
</div>


<table id="tests-table" class="table table-bordered table-hover">
    <thead>
      <tr>
			<th>ID</th>
			<th>Bộ đề</th>
			<th>Người được chấm</th>
			<th>Người chấm</th> 
            <th>Trọng số</th>
            <th>Trạng thái</th>
            <th>Thao tác</th>
      </tr>
    </thead>

</table>

<a class="btn btn-success" href="<?php echo e(route('admin.test.send_all', $survey_round->id)); ?>">Gửi tất cả</a>
<?php $__env->startSection('custom-js'); ?>
##parent-placeholder-9861867d401053ff2325265a70136f5f44ff874e##
<script>
  $(function() {
    $("#tests-table").dataTable({
		processing: true,
		serverSide: true,
		autoWidth:false,
		ajax: {
			url: "<?php echo e(route('admin.test.get_list')); ?>",
			data: {
				survey_round_id: <?php echo e($survey_round->id); ?>

			}
      	},
      	columns: [
			{ "data": "id", "name": "id"  },
			{ "data": "survey_name", "name": "survey_name" },
			{ "data": "candiate", "name": "candiate" },
			{ "data" :"examiner", "name": "examiner"},
            { "data": "multiplier", "name":"multiplier" },
            { "data": "status", "name": "status" },
			{ "data" : "action", "name": "action"}
      	]
    });
  })
</script>
<?php $__env->stopSection(); ?>
<?php /**PATH E:\DEV\Employees management\HR manager\resources\views/admin/pages/survey_round/table.blade.php ENDPATH**/ ?>