<?php $__env->startSection('title'); ?>
  Chỉnh sửa bài khảo sát
<?php $__env->stopSection(); ?>

<?php $__env->startSection('custom-css'); ?>
    <style>
        .question-footer{
            border-top: 1px solid rgb(211, 211, 211);
            padding-top: 20px;
        }
        .question-footer .form-group{
            border-left: 1px solid rgb(211, 211, 211);
            margin-left: 30px;
        }

        .question-footer .form-group label{

        }


    </style>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<?php echo $__env->make('admin.partials.content_header', ['title' => 'Quản lý khảo sát'], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<div class="row">
    <section class="col-12" style="position: relative">
        
        <div class="card">
            <div class="card-header">
                <div class="card-title">
                    Thông tin khảo sát
                </div>
            </div>
            <div class="card-body">
                <form id="survey-create-form" action="<?php echo e(route('admin.survey.update', $survey->id )); ?>" method="post">
                    <?php echo csrf_field(); ?>
                    <div class="alert survey-create-msg d-none ">
                     </div>
                    <div class="row">

                        <div class="col-md-6 col-12">
                            <div class="form-group">
                                <label for="">Tên bài khảo sát</label>
                                <input name="name" type="text" class="form-control" id=""
                                    placeholder="Nhập tên bài khảo sát (*)" value="<?php echo e($survey->name); ?>">
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
                                <label for="">Tiêu đề</label>
                                <input name="title" type="text" class="form-control" id=""
                                    placeholder="Nhập tiêu đề bài khảo sát" value="<?php echo e($survey->title); ?>">
                                <?php $__errorArgs = ['username'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                <strong class="title">
                                    <?php echo e($message); ?>

                                </strong>
                                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                            </div>
                            <div class="form-group">
                                <label for="">Nội dung bài khảo sát</label>
                                <textarea name="content" type="text" class="form-control" id=""
                                    placeholder="Nhập nội dung bài khảo sát" value="" cols="30"
                                    rows="5" oninput="auto_grow(this)"><?php echo e($survey->content); ?></textarea>
                                <?php $__errorArgs = ['content'];
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
                                    placeholder="Nhập password (*)" value="<?php echo e($survey->author->fullname ?? 'Không rõ'); ?>">
                                <input type="hidden" name="created_by" value="<?php echo e($survey->author->id ?? null); ?>">
                            </div>
                            <div class="form-group">
                                <label for="">Loại khảo sát</label>
                                <select name="type" class="form-control" id="sur">
                                    <option <?php echo e($survey->type == 1 ? 'selected' : ''); ?> value="1">Bài đánh giá nhân viên</option>
                                    <option <?php echo e($survey->type == 2 ? 'selected' : ''); ?> value="2">Bài đánh giá chất lượng nhân viên</option>
                                    <option <?php echo e($survey->type == 3 ? 'selected' : ''); ?> value="3">Bài khảo sát khách hàng</option>
                                    <option <?php echo e($survey->type == 4 ? 'selected' : ''); ?> value="4">Biểu quyết</option>
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="">Hướng dẫn làm bài khảo sát</label>
                                <textarea name="tutorial" type="text" class="form-control" id=""
                                    placeholder="Nhập hướng dẫn làm bài khảo sát" value="" cols="30"
                                    rows="5" oninput="auto_grow(this)"><?php echo e($survey->tutorial); ?></textarea>
                                <?php $__errorArgs = ['tutorial'];
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
                    </div>

                    <button class="btn btn-traphaco">
                        Cập nhật thông tin
                    </button>
                </form>
            </div>
        </div>
        
        <div id="editor">
        <?php echo $__env->make('admin.pages.survey.editor', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    </div>
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

$('.question-tool-menu-btn').tooltip({
    offset: 100,
    html:true,
    template:'<div class="tooltip" role="tooltip"" ><div class="tooltip-inner"></div></div>',
});

function auto_grow(element) {
    element.style.height = "5px";
    element.style.height = (element.scrollHeight)+"px" ;
}

document.querySelectorAll('textarea').forEach(function(item){
    auto_grow(item);
})

</script>

<script>
    $('.sortable').sortable({
        //handle              : '.handle',
        forcePlaceholderSize: true,
        zIndex              : 999999,
        animation: 150,
        scrollSpeed: 40,
        delay: 150


    })

  if ( jQuery('.rt-ads-right').length ) {
        var obj = jQuery('.rt-ads-right'),
            csstransition = obj.attr('data-csstransition') == 'true' ? true : false,
            easing = obj.attr('data-easing');

        obj.stickyfloat({ duration: 400, cssTransition: csstransition, easing: easing });
    }
</script>

<script>

    const MenuToast = Swal.mixin({
        toast: true,
        position: 'bottom-end',
        showConfirmButton: false,
        timer: 3000
    });
</script>

<script>
      // jQuery UI sortable for the todo list
  $('.todo-list').sortable({
    placeholder         : 'sort-highlight',
    handle              : '.handle',
    forcePlaceholderSize: true,
    zIndex              : 999999
  })

  $('.question-list').sortable({
    placeholder         : 'sort-highlight',
    handle              : '.question-handle',
    forcePlaceholderSize: true,
    zIndex              : 999999
  })
</script>

<script>

    //declare variable handle survey
    var surveyId = <?php echo e($survey->id); ?>;

    //ajax setup
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    function getDataForm(data){
        var result = {};
        data.forEach(function (item) {
            result[item.name] = item.value;
        })
        return result;
    }

    $("#survey-create-form").submit(function(e) {
        e.preventDefault(); // avoid to execute the actual submit of the form.

        var form = $(this);
        var url = form.attr('action');
    $.ajax({
        type: "POST",
        url: url,
        data: form.serialize(), // serializes the form's elements.
        success: function(data)
        {
            $('.survey-create-msg').removeClass('alert-danger d-none').addClass('alert-success d-block');
            $('.survey-create-msg').text(data.msg);
            form.attr('action', data.editUrl);
            surveyId = data.newSurvey;
        }
        }).fail(function(errors){
            errObj = JSON.parse(errors.responseText).errors;
            var errList = Object.values(errObj);
            var errStr = errList.join('|');
            $('.survey-create-msg').removeClass('alert-success d-none').addClass('alert-danger d-block');
            $('.survey-create-msg').text(errStr);
        });
    });

</script>

<?php echo $__env->make('admin.pages.survey.script', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

<?php $__env->stopSection(); ?>


<?php echo $__env->make('admin.main_layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/admin/web/dg.traphaco.vn/public_html/resources/views/admin/pages/survey/edit.blade.php ENDPATH**/ ?>