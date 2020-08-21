@extends('admin.main_layout')

@section('title')
  Chỉnh sửa bài khảo sát
@endsection

@section('custom-css')
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
@endsection

@section('content')
@include('admin.partials.content_header', ['title' => 'Quản lý khảo sát'])
<div class="row">
    <section class="col-12" style="position: relative">
        {{-- Add new survey section --}}
        <div class="card">
            <div class="card-header">
                <div class="card-title">
                    Thông tin khảo sát
                </div>
            </div>
            <div class="card-body">
                <form id="survey-create-form" action="{{route('admin.survey.update', $survey->id )}}" method="post">
                    @csrf
                    <div class="alert survey-create-msg d-none ">
                     </div>
                    <div class="row">

                        <div class="col-md-6 col-12">
                            <div class="form-group">
                                <label for="">Tên bài khảo sát</label>
                                <input name="name" type="text" class="form-control" id=""
                                    placeholder="Nhập tên bài khảo sát (bắt buộc)" value="{{ $survey->name }}">
                                @error('name')
                                <strong class="text-red">
                                    {{$message}}
                                </strong>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="">Tiêu đề</label>
                                <input name="title" type="text" class="form-control" id=""
                                    placeholder="Nhập tiêu đề bài khảo sát" value="{{ $survey->title }}">
                                @error('username')
                                <strong class="title">
                                    {{$message}}
                                </strong>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="">Loại khảo sát</label>
                                <select name="type" class="form-control" id="">
                                    <option {{$survey->type == 1 ? 'selected' : ''}} value="1">Bài khảo sát</option>
                                    <option {{$survey->type == 2 ? 'selected' : ''}} value="2">Bài đánh giá chất lượng nhân viên</option>
                                    <option {{$survey->type == 3 ? 'selected' : ''}} value="3">Bài khảo sát khách hàng</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6 col-12">

                            <div class="form-group">
                                <label for="">Người tạo</label>
                                <input name="" type="text" class="form-control" id="" readonly
                                    placeholder="Nhập password (Bắt buộc)" value="{{ $survey->author->fullname ?? 'Không rõ' }}">
                                <input type="hidden" name="created_by" value="{{$survey->author->id ?? null}}">
                            </div>

                            <div class="form-group">
                                <label for="">Nội dung bài khảo sát</label>
                                <textarea name="content" type="text" class="form-control" id=""
                                    placeholder="Nhập nội dung bài khảo sát" value="" cols="30"
                                    rows="5">{{ $survey->content }}</textarea>
                                @error('content')
                                <strong class="text-red">
                                    {{$message}}
                                </strong>
                                @enderror
                            </div>

                        </div>

                    </div>

                    <button class="btn btn-traphaco">
                        Cập nhật thông tin
                    </button>
                </form>
            </div>
        </div>
        {{-- Question editor --}}
        @include('admin.pages.survey.editor')
    </section>
</div>

@endsection 

@section('custom-js')
<script src="{{asset('template/js/nestable.js')}}"></script>
<script src="{{asset('template/AdminLTE/plugins/bootstrap-switch/js/bootstrap-switch.min.js')}}"></script>
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
    var surveyId = {{$survey->id}};

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

@include('admin.pages.survey.script')

@endsection

