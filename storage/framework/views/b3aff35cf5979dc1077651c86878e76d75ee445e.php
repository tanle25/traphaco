<style>
    textarea {
        resize: none;
        overflow: hidden;
    }
</style>

<div class="card card-info mx-auto mt-3" style="max-width: 1024px">
       <div class="card-header">
           <h2>
               <?php echo e($tsurvey->title ?? ''); ?>

           </h2>
           <div>
               <h5><?php echo e($survey->content ?? ''); ?></h5>
           </div>
           <div class="mt-3">
               <h5>
                    Khách hàng: <?php echo e($customer->fullname); ?>

               </h5>
               <h5>
                    Địa chỉ: <?php echo e($customer->address); ?>

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
           <button href="<?php echo e(route('admin.customer.store_customer_answer')); ?>" class="btn btn-traphaco send-result">Gửi kết quả</button>
       </div> 
   </div>
</div>
<?php /**PATH E:\DEV\Employees management\HR manager\resources\views/admin/pages/customers/test.blade.php ENDPATH**/ ?>