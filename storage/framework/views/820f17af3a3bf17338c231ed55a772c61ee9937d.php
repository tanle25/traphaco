<!--=========================================================-->
<?php
    if (isset($survey->section)) {
        $sections = $survey->section;
    }
    else{
        $sections = [];
    }
?>

<div class="question-tool mx-auto d-flex" style="max-width: 768px">
    <div class="card col-12 " >
        
        <div class="card-header">
            <div class="card-title">
                Bộ câu hỏi
            </div>
        </div>
        <div class="card-body ">
            
            <div class="sortable editor-body">
                <?php $__currentLoopData = $sections; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $section): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="card section-wraper" data-section-id="<?php echo e($section->id); ?>" style="margin-bottom: 20px">
                    
                    <div class="sortable-handle text-center p-2">
                        <i class="fas fa-grip-lines"></i>
                    </div>
                    
                    <div class=" section-header callout">
                        <div class=" row">
                            <div class="col-sm-10 section-title">
                                <input type="text" placeholder="Tiêu đề section" value="<?php echo e($section->title ?? ''); ?>">
                                <div class="focus-line"></div>
                            </div>
                            <div class="section-remove">
                                <i class="far fa-trash-alt" style="font-size: 20px; cursor:pointer"></i>
                            </div>
                        </div>
                        <textarea oninput="auto_grow(this)" name="email" type="text" class="section-content"
                                placeholder="Nhập nội dung section"cols="30"
                                rows="1"><?php echo e($section->content); ?></textarea>
                    </div>
                    
                    <?php
                        if(isset($section->questions)){
                            $questions = $section->questions;
                        }
                        else{
                            $questions = [];
                        }
                    ?>
                        <div class="sortable question-container">
                            <?php $__currentLoopData = $questions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $question): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <div class="callout question-wraper" data-question-id="<?php echo e($question->id); ?>">
                                
                                <div class="form-group row">
                                    <div class="col-sm-10 question-title">
                                        <textarea oninput="auto_grow(this)" name="" id="" cols="30" rows="1" placeholder="Câu hỏi"><?php echo e($question->content); ?></textarea>
                                        
                                    </div>
                                    <div class="question-remove">
                                        <i class="far fa-trash-alt" style="font-size: 20px; cursor:pointer"></i>
                                    </div>
                                </div>
                                
                                <?php
                                    if(isset($question->options)){
                                        $options = $question->options;
                                    }
                                    else{
                                        $options = [];
                                    }
                                ?>
                                <div class="sortable options-wraper" >
                                    <?php $__currentLoopData = $options; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $option): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <div class="form-group question-option row" data-question-option-id="<?php echo e($option->id); ?>">
                                        <label class="question-option-label">
                                            <i class="far fa-circle"></i>
                                        </label>
                                        <div class="col-8">
                                            <input value="<?php echo e($option->content); ?>" type="text" class="question-option-content" placeholder="Nhập câu trả lời">
                                        </div>
                                        <div class="col-2 d-flex">
                                            <input type="number" class="d-inline question-option-score" value="<?php echo e($option->score); ?>" placeholder="điểm">
                                        </div>
                                        <div class="question-option-remove">
                                            <i class="far fa-trash-alt" style="font-size: 20px; cursor:pointer"></i>
                                        </div>
                                    </div>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </div>
                                
                                <div class="col-8 add-option">
                                    <input readonly type="text" class="question-option-add" id="" placeholder="Thêm câu trả lời">
                                </div>

                            </div>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                        </div>

                </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                
            </div>
            
        </div>
        
    </div>
    
    <div class="question-tool-menu card" data-csstransition="false">
        <div class="question-tool-menu-btn add-section-btn" data-toggle="tooltip" data-placement="right" title="Tạo mới section">   
            <i class="far fa-file" ></i>
        </div>

        <div class="question-tool-menu-btn add-question-btn" data-toggle="tooltip" data-placement="right" title="Tạo mới câu hỏi">   
            <i class="far fa-edit"></i>
        </div>
    </div>
</div> 
<!--=========================================================--><?php /**PATH E:\DEV\Employees management\HR manager\resources\views/admin/pages/survey/editor.blade.php ENDPATH**/ ?>