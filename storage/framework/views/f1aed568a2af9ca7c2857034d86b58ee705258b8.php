<ol class="dd-list" >
    <?php
        $list = $list->sortBy('sort');
    ?>
    <?php $__currentLoopData = $list; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <li class="dd-item" data-id="<?php echo e($item->id); ?>">
            <div class="dd-handle" >
                <i class="fa <?php echo e($item->icon); ?>"></i> 
                <span><?php echo e($item->department_name); ?></span>
                
                <span class="float-right dd-nodrag">
                    <a href="<?php echo e(route('admin.department.edit', $item->id)); ?>"><i
                            class="fa fa-edit text-success"></i></a>
                    <span data-id="<?php echo e($item->id); ?>" class="remove-department"><i class="fa fa-trash text-danger"></i></span>
                </span>
            </div>
            <?php if($item->child): ?>
                <?php echo $__env->make('admin.pages.departments.department_tree_child', ['list' => $item->child], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
            <?php endif; ?>
        </li>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
</ol><?php /**PATH E:\DEV\Employees management\HR manager\resources\views/admin/pages/departments/department_tree_child.blade.php ENDPATH**/ ?>