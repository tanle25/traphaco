
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
            <a href="#"
            class="btn btn-success float-right mr-4"
            data-toggle="modal"
            data-target="#import-model"
            >
                <i class="fas fa-file-excel"></i> Import Excel
            </a>
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
                                        <div class="focus-line"></div>
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
                                <div class="can-comment">

                                    <?php if($question->can_comment == 1): ?>
                                    <div class="form-group question-option row" data-question-id="<?php echo e($question->id); ?>">
                                        <label class="question-option-label">
                                            <i class="far fa-circle"></i>
                                        </label>
                                        <div class="col-10">
                                            <input readonly type="text" class="question-comment" placeholder="Khác">
                                        </div>

                                        <div class="question-comment-remove">
                                            <i class="far fa-trash-alt" style="font-size: 20px; cursor:pointer"></i>
                                        </div>
                                    </div>
                                    <?php endif; ?>
                                </div>
                                

                                <div class="add-question row ">
                                    <div class="col-12 add-option d-flex">
                                        <input readonly type="text" class="question-option-add" id="" placeholder="Thêm câu trả lời">
                                        <?php if($question->can_comment == 1): ?>
                                        <input readonly type="text" class="question-comment-add" style="display:none" id="" placeholder="Thêm khác">
                                        <?php else: ?>
                                        <input readonly type="text" class="question-comment-add" style="display:block" id="" placeholder="Thêm khác">
                                        <?php endif; ?>
                                    </div>

                                    <div class="mt-3 d-flex justify-content-end col-12 question-footer " >
                                        <div class="question-duplicate ">
                                            <i class="far fa-copy align-m" style="font-size: 25px; cursor:pointer"></i>
                                        </div>
                                        <div class="form-group">
                                            <div class="custom-control custom-switch">
                                                <input <?php echo e($question->must_mark == 1 ? 'checked' : ''); ?> type="checkbox" class="d-none custom-control-input" data-question-id="<?php echo e($question->id); ?>" id="must-mark-<?php echo e($question->id); ?>">
                                                <label class="ml-3 custom-control-label" for="must-mark-<?php echo e($question->id); ?>">Bắt buộc</label>
                                            </div>
                                        </div>
                                    </div>
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
        <div class="tooltip question-tool-menu-btn add-section-btn">
            <i class="far fa-file" ></i>
            <span class="tooltiptext">Tạo mới section</span>
        </div>
        <div class="tooltip question-tool-menu-btn add-question-btn">
            <i class="fas fa-plus-circle"></i>
            <span class="tooltiptext">Tạo mới câu hỏi</span>
        </div>
    </div>

</div>

<div class="modal fade"  id="import-model" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" style="max-width: 1024px" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Import file dữ liệu khách hàng</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
				<form action="<?php echo e(route('admin.survey.import', $survey->id)); ?>" id="import-form" method="post" enctype="multipart/form-data">
					<?php echo csrf_field(); ?>
                    <div class="form-group">
                        <label for="exampleInputFile">Chọn file xlsx</label>
                        <div class="input-group">
                          <div class="custom-file">
                            <input type="file" class="custom-file-input" name="customer_list" id="exampleInputFile">
                            <label class="custom-file-label" for="exampleInputFile">Chọn file...</label>
                          </div>
                          <div class="input-group-append">
                            <button class="input-group-text" id="">Upload</button>
                          </div>
                        </div>
                    </div>
				</form>
            </div>
        </div>
    </div>
</div>

<!--=========================================================-->
<?php /**PATH /home/admin/web/dg.traphaco.vn/public_html/resources/views/admin/pages/survey/editor.blade.php ENDPATH**/ ?>