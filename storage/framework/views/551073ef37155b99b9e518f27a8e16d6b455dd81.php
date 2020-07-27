
<script src="<?php echo e(asset('template/js/stickyfloat.js')); ?>"></script>
<script>
    jQuery('.question-tool-menu').stickyfloat({ duration: 400 });

    // Question logic 
    /*
    * Biến surveyID được tạo ra khi create survey qua ajax thành công
    */
    //===========Logic CRUD section===========//
    function appendSurveySectionFrontend(newSection = null, newQuestion = null){
        if(!newSection){
            return;
        }
        var surveySection = `
        <div class="card section-wraper" data-section-id="${newSection}" style="margin-bottom: 20px">
            <div class="sortable-handle text-center p-2">
                <i class="fas fa-grip-lines"></i>
            </div>
            <div class=" section-header callout">
                <div class=" row">
                    <div class="col-sm-10 section-title">
                        <input type="text" placeholder="Tiêu đề section" value="Không có tiêu đề">
                        <div class="focus-line"></div>
                    </div>
                    <div class="section-remove">
                        <i class="far fa-trash-alt" style="font-size: 20px; cursor:pointer"></i>
                    </div>
                </div>
                <textarea oninput="auto_grow(this)" name="email" type="text" class="section-content"
                    placeholder="Nhập nội dung section" cols="30" rows="1"></textarea>
            </div>
            <div class="sortable question-container">
                <div class="callout question-wraper" data-question-id="${newQuestion}">
                    <div class="form-group row">
                        <div class="col-sm-10 question-title">
                            <textarea oninput="auto_grow(this)" name="" id="" cols="30" rows="1"
                                placeholder="Câu hỏi"></textarea>
                        </div>
                        <div class="question-remove">
                            <i class="far fa-trash-alt" style="font-size: 20px; cursor:pointer"></i>
                        </div>
                    </div>
                    <div class="sortable options-wraper">
                    </div>
                    <div class="col-8 add-option">
                        <input readonly type="text" class="question-option-add" id=""
                            placeholder="Thêm câu trả lời">
                    </div>
                </div>
            </div>
        </div>          
        `
        $('.sortable').sortable('destroy');
        $('.editor-body').append(surveySection);
        $('.sortable').sortable({
            //handle              : '.handle',
            forcePlaceholderSize: true,
            zIndex              : 999999,
            animation: 150,
        });
    }

    function createSurveySection(survey = null){
        if(!survey){
            return;
        }
        $.ajax({
            url: "<?php echo e(route('admin.survey_section.store')); ?>",
            data : {
                survey_id: survey,
            },
            type: 'POST',
            success: function(data){
                swalToast('Tạo mới thành công section');
                appendSurveySectionFrontend(data.newSection, data.newQuestion);
            },
            error: function(errors){
                swalToast('Lỗi tạo section', 'error');
            }
        });
    }

    function updateSection(sectionId, title, content){
        $.ajax({
            url: "<?php echo e(route('admin.survey_section.update')); ?>",
            data : {
                section_id: sectionId,
                title: title,
                content: content,
            },
            type: 'POST',
            success: function(data){
                if(data.error){
                    swalToast(data.error, 'error');
                }
                if(data.msg){
                    swalToast(data.msg);
                }
            },
            error: function(errors){
                swalToast('Lỗi cập nhật tiêu đề sectio quá 255 ký tự', 'error');
            }
        });
    }

    function removeSection(sectionId){
        $.ajax({
            url: "<?php echo e(route('admin.survey_section.destroy')); ?>",
            data : {
                section_id: sectionId,
            },
            type: 'POST',
            success: function(data){
                if(data.error){
                    swalToast(data.error, 'error');
                }
                if(data.msg){
                    swalToast(data.msg);
                }
            },
            error: function(errors){
                swalToast('Lỗi không rõ phát sinh trong quá trình xóa', 'error');
            }
        });
    }

    $(document).ready(function() {
        //event add section
        $(document).on("click",'.add-section-btn',function() {
            if(surveyId) {
                createSurveySection(surveyId);
            }
            else{
                swalToast('Bạn phải tạo cuộc khảo sát trước', 'error');
            }
        });

        //event update section
        $(document).on("blur",'.section-title input',function(e) {
            var sectionId = $(this).closest('.section-wraper').data('section-id');
            var title = $(this).val();
            if(surveyId) {
                updateSection(sectionId, title, null);
            }
            else{
                swalToast('Bạn phải tạo cuộc khảo sát trước', 'error');
            }
        });

        $(document).on("blur",'.section-content',function(e) {
            var sectionId = $(this).closest('.section-wraper').data('section-id');
            var content = $(this).val();
            if(surveyId) {
                updateSection(sectionId,null, content);
            }
            else{
                swalToast('Bạn phải tạo cuộc khảo sát trước', 'error');
            }
        });

        $(document).on("click",'.section-remove',function(e) {
            var sectionId = $(this).closest('.section-wraper').data('section-id');
            Swal.fire({
			title: 'Xóa seciton này?',
			text: "Bạn không thể hoàn tác!",
			icon: 'warning',
			showCancelButton: true,
			confirmButtonColor: '#3085d6',
			cancelButtonColor: '#d33',
			confirmButtonText: 'Vẫn xóa nó!',
            })
            .then((result) => {
                if (result.value) {
                    removeSection(sectionId);
                    $(this).closest('.section-wraper').remove();
                }
            });
        });

        $(document).on("blur",'.section-content',function(e) {
            var sectionId = $(this).closest('.section-wraper').data('section-id');
            var content = $(this).val();
            if(surveyId) {
                updateSection(sectionId,null, content);
            }
            else{
                swalToast('Bạn phải tạo cuộc khảo sát trước', 'error');
            }
        });


    });
    //===========Logic CRUD section===========//

    //=============Logic CRUD question=================//

    function getCurrentSection(){
        var result = null;
        $('.section-wraper').each(function(){
            if ($(this).hasClass('active')) {
                result = $(this);
            }
        })
        return result;
    }

    $(document).on('click', '.section-wraper', function(){
        $('.section-wraper').removeClass('active');
        $(this).addClass('active');
    });

    $(document).on('click', '.add-question-btn', function(){
        var currentSection = getCurrentSection();
        if(currentSection){
            var sectionId = currentSection.data('section-id');
            createQuestion(sectionId);
        }
    })

    function appendQuestionFrontEnd(questionId){
        var questiontemplate =  `
        <div class="callout question-wraper" data-question-id="${questionId}">
            
            <div class="form-group row">
                <div class="col-sm-10 question-title">
                    <textarea oninput="auto_grow(this)" name="" id="" cols="30" rows="1" placeholder="Câu hỏi"></textarea>
                </div>
                <div class="question-remove">
                    <i class="far fa-trash-alt" style="font-size: 20px; cursor:pointer"></i>
                </div>
            </div>
            <div class="sortable options-wraper ui-sortable"></div>
            <div class="col-8 add-option">
                <input readonly type="text" class="question-option-add" id="" placeholder="Thêm câu trả lời">
            </div>
        </div>
        `;
        $('.sortable').sortable('destroy');
        $('.section-wraper.active .question-container').append(questiontemplate);
        $('.sortable').sortable({
            forcePlaceholderSize: true,
            zIndex              : 999999,
            animation: 150,
        });
    }

    function createQuestion(section = null){
        if(!section){
            return;
        }
        $.ajax({
            url: "<?php echo e(route('admin.question.store')); ?>",
            data : {
                section_id: section,
            },
            type: 'POST',
            success: function(data){
                swalToast('Tạo mới thành công câu hỏi');
                appendQuestionFrontEnd(data.newQuestion);
            },
            error: function(errors){
                swalToast('Lỗi tạo câu hỏi', 'error');
            }
        });
    }

    function updateQuestion(questionId, content){
        $.ajax({
            url: "<?php echo e(route('admin.question.update')); ?>",
            data : {
                question_id: questionId,
                content: content,
            },
            type: 'POST',
            success: function(data){
                if(data.error){
                    swalToast(data.error, 'error');
                }
                if(data.msg){
                    swalToast(data.msg);
                }
            },
            error: function(errors){
                swalToast('Lỗi cập nhật nội dung câu hỏi', 'error');
            }
        });
    }

    $(document).on("blur",'.question-title textarea',function(e) {
        var questionId = $(this).closest('.question-wraper').data('question-id');
        var title = $(this).val();
        if(questionId) {
            updateQuestion(questionId, title);
        }
        else{
            swalToast('Câu hỏi không tồn tại', 'error');
        }
    });

    function removeQuestion(questionId){
        $.ajax({
            url: "<?php echo e(route('admin.question.destroy')); ?>",
            data : {
                question_id: questionId,
            },
            type: 'POST',
            success: function(data){
                if(data.error){
                    swalToast(data.error, 'error');
                }
                if(data.msg){
                    swalToast(data.msg);
                }
            },
            error: function(errors){
                swalToast('Lỗi không rõ phát sinh trong quá trình xóa', 'error');
            }
        });
    }

    $(document).on("click",'.question-remove',function(e) {
        var questionId = $(this).closest('.question-wraper').data('question-id');
        Swal.fire({
        title: 'Xóa câu hỏi này?',
        text: "Bạn không thể hoàn tác!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Vẫn xóa nó!',
        })
        .then((result) => {
            if (result.value) {
                removeQuestion(questionId);
                $(this).closest('.question-wraper').remove();
            }
        });
    });

    //===========Question option CRUD=============//
    function appendQuestionOptionFrontEnd(questionElement, questionOptionId){
        var questionOptionTemplate =`
        <div class="form-group question-option row" data-question-option-id="${questionOptionId}">
            <label class="question-option-label">
                <i class="far fa-circle"></i>
            </label>
            <div class="col-8">
                <input value="" type="text" class="question-option-content" placeholder="Nhập câu trả lời">
            </div>
            <div class="col-2 d-flex">
                <input type="number" class="d-inline question-option-score" value="" placeholder="điểm">
            </div>
            <div class="question-option-remove">
                <i class="far fa-trash-alt" style="font-size: 20px; cursor:pointer"></i>
            </div>
        </div>
        `;
        $('.sortable').sortable('destroy');
        questionElement.append(questionOptionTemplate);
        $('.sortable').sortable({
            forcePlaceholderSize: true,
            zIndex              : 999999,
            animation: 150,
        });
    }

    function createQuestionOption(questionWraper, question = null){
        if(!question){
            return;
        }
        $.ajax({
            url: "<?php echo e(route('admin.question_option.store')); ?>",
            data : {
                question_id: question,
            },
            type: 'POST',
            success: function(data){
                swalToast('Tạo mới thành công câu hỏi');
                appendQuestionOptionFrontEnd(questionWraper, data.newOption);
            },
            error: function(errors){
                swalToast('Lỗi tạo đáp án!', 'error');
            }
        });
    }

    $(document).on('click', '.question-option-add', function(){
        var question = $(this).closest('.question-wraper');
        var optionWraper =  question.children('.options-wraper');
        if(question && optionWraper){
            var questionId = question.data('question-id');
            createQuestionOption(optionWraper, questionId);
        }
    })

    function updateQuestionOption(optionId, content = null, score = null){
        $.ajax({
            url: "<?php echo e(route('admin.question_option.update')); ?>",
            data : {
                option_id: optionId,
                content: content,
                score: score,
            },
            type: 'POST',
            success: function(data){
                if(data.error){
                    swalToast(data.error, 'error');
                }
                if(data.msg){
                    swalToast(data.msg);
                }
            },
            error: function(errors){
                swalToast('Lỗi cập nhật nội dung câu trả lời', 'error');
            }
        });
    }

    $(document).on("blur",'.question-option-content',function(e) {
        var optionId = $(this).closest('.question-option').data('question-option-id');
        var content = $(this).val();
        if(optionId) {
            updateQuestionOption(optionId, content, null);
        }
        else{
            swalToast('Câu trả lời không tồn tại', 'error');
        }
    });

    function removeQuestionOption(optionId){
        $.ajax({
            url: "<?php echo e(route('admin.question_option.destroy')); ?>",
            data : {
                option_id: optionId,
            },
            type: 'POST',
            success: function(data){
                if(data.error){
                    swalToast(data.error, 'error');
                }
                if(data.msg){
                    swalToast(data.msg);
                }
            },
            error: function(errors){
                swalToast('Lỗi không rõ phát sinh trong quá trình xóa', 'error');
            }
        });
    }

    $(document).on("click",'.question-option-remove',function(e) {
        var optionId = $(this).closest('.question-option').data('question-option-id');
        Swal.fire({
        title: 'Xóa câu trả lời này?',
        text: "Bạn không thể hoàn tác!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Vẫn xóa nó!',
        })
        .then((result) => {
            if (result.value) {
                removeQuestionOption(optionId);
                $(this).closest('.question-option').remove();
            }
        });
    });

    $(document).on("blur",'.question-option-score',function(e) {
        var optionId = $(this).closest('.question-option').data('question-option-id');
        var score = $(this).val();
        if(optionId) {
            updateQuestionOption(optionId, null, score);
        }
        else{
            swalToast('Câu trả lời không tồn tại', 'error');
        }
    });

</script><?php /**PATH E:\DEV\Employees management\HR manager\resources\views/admin/pages/survey/script.blade.php ENDPATH**/ ?>