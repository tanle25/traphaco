

<?php $__env->startSection('title'); ?>
  Thêm cuộc khảo sát
<?php $__env->stopSection(); ?>

<?php $__env->startSection('custom-css'); ?>

<style>
    .section-title input {
        height: 60px;
        font-size: 40px;
        border-width: 0 0 1px 0;
        padding-left: 0;
        border-color: rgb(148, 143, 143); 
        position: relative;
        width: 100%;
        position: relative;
    }

    .section-title{
        margin-bottom: 30px;
    }

    .section-title .focus-line{
        height: 5px;
        width: 0%;
        color: #20C997;
        position: absolute;;
        top: 100%;
        left:0;
        transition: 0.5s;
        z-index: 100;
    }

    .section-title input:focus{
        outline: none;
    }

    .section-title input:focus ~ .focus-line{
        width: 100%;
    }

    .section-title:focus::before{
        width: 100%;
    }

    .section-title input ::placeholder{
        font-size: 40px;
    }

    .section-remove, .question-remove{
        text-align: center;
        line-height: 60px;
        height: 60px;
        width: 60px;
        border-radius: 50%;
    }

    .section-remove:hover, .question-remove:hover{
        background-color:  rgb(243, 243, 243);
    }

    .question-remove{
        height: 45px;
        width:45px;
        line-height: 45px;

    }
    
    .section-header textarea {
        border-width: 0 0 1px 0;
        padding-left: 0;
        border-color: rgb(148, 143, 143); 
        position: relative;
        width: 100%;
        position: relative;
        z-index: 1;
        height: auto;
    }
    textarea{
        resize: none;
        overflow: hidden;
    }

    textarea:focus{
        outline: none;
    }

    .question-wraper input{
        height: 45px;
        font-size: 18px;
        padding-left: 0;
        border-color: rgb(148, 143, 143); 
        position: relative;
        width: 100%;
        position: relative;
        z-index: 1;
        border-width: 0 0 0 0;

    }

    .question-wraper input:focus{
        outline: none;
        border-width: 0 0 1px 0;
    }

    .question-option:hover input {
        border-width: 0 0 1px 0;
    }

    .question-option-label{
        height: 45px;
        width: 30px;
        line-height: 45px;
        color: #757575;
        font-size: 23px;

    }

    .question-title input::placeholder{
        font-size: 25px;
    }

    .question-title input, {
        font-size: 25px;
        background-color: #F8F9FA;
    }

    .question-title textarea{
        font-size: 25px;
        background-color: #F8F9FA;
        border-width: 0 0 1px 0;
        padding-left: 0;
        border-color: rgb(148, 143, 143); 
        position: relative;
        width: 100%;
        position: relative;
        z-index: 1;
    }

    .question-title{
        margin-right:30px;
    }

    .question-tool{
        position: relative;
    }

    .question-tool-menu{
        position: absolute;
        left:101%;
        margin-top: 50px; 
        padding: 20px 5px;
    }

    .question-tool-menu-btn{
        margin-bottom: 20px;
        height: 40px;
        width: 40px;
        text-align: center;
        line-height: 40px;
        cursor: pointer;

    }

    .question-tool-menu i {
        display: block;
        font-size: 30px;
    }

    .sortable-handle{
        cursor: move;
    }

</style>


<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
<?php echo $__env->make('admin.partials.content_header', ['title' => 'Thêm mới khảo sát'], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<div class="row">
    <section class="col-12" style="position: relative">
        
        <div class="card">
            <div class="card-header">
                <div class="card-title">
                    Tạo mới khảo sát
                </div>
            </div>
            <div class="card-body">
                <form id="survey-create-form" action="<?php echo e(route('admin.survey.store')); ?>" method="post">
                    <?php echo csrf_field(); ?>
                    <div class="alert survey-create-msg d-none ">
                     </div>
                    <div class="row">

                        <div class="col-md-6 col-12">
                            <div class="form-group">
                                <label for="">Tên cuộc khảo sát</label>
                                <input name="name" type="text" class="form-control" id=""
                                    placeholder="Nhập tên cuộc khảo sát (bắt buộc)" value="<?php echo e(old('name')); ?>">
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
                                    placeholder="Nhập tiêu đề cuộc khảo sát" value="<?php echo e(old('title')); ?>">
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
                        </div>
                        <div class="col-md-6 col-12">
                            <div class="form-group">
                                <label for="">Người tạo</label>
                                <input name="" type="text" class="form-control" id="" readonly
                                    placeholder="Nhập password (Bắt buộc)" value="<?php echo e(Auth::user()->fullname); ?>">
                                <input type="hidden" name="created_by" value="<?php echo e(Auth::user()->id); ?>">
                            </div>

                            <div class="form-group">
                                <label for="">Nội dung cuộc khảo sát</label>
                                <textarea name="content" type="text" class="form-control" id=""
                                    placeholder="Nhập nội dung cuộc khảo sát" value="<?php echo e(old('content')); ?>" cols="30"
                                    rows="5"></textarea>
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

                    </div>
                    <button class="btn btn-primary">
                        Lưu thông tin
                    </button>
                </form>
            </div>
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


</script>

<script>
    $('.sortable').sortable({
        //handle              : '.handle',
        forcePlaceholderSize: true,
        zIndex              : 999999,
        animation: 150,
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
    var surveyId = null;

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
            location.href = data.editUrl;
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


<?php echo $__env->make('admin.main_layout', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH E:\DEV\Employees management\HR manager\resources\views/admin/pages/survey/create.blade.php ENDPATH**/ ?>