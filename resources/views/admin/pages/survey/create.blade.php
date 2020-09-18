@extends('admin.main_layout')

@section('title')
  Thêm đề khảo sát
@endsection

@section('custom-css')


@endsection

@section('content')
@include('admin.partials.content_header', ['title' => 'Thêm mới khảo sát'])
<div class="row">
    <section class="col-12" style="position: relative">
        {{-- Add new survey section --}}
        <div class="card">
            <div class="card-header">
                <div class="card-title">
                    Tạo mới đề khảo sát
                </div>
            </div>
            <div class="card-body">
                <form id="survey-create-form" action="{{route('admin.survey.store')}}" method="post">
                    @csrf
                    <div class="alert survey-create-msg d-none ">
                     </div>
                    <div class="row">

                        <div class="col-md-6 col-12">
                            <div class="form-group">
                                <label for="">Tên bài khảo sát</label>
                                <input name="name" type="text" class="form-control" id=""
                                    placeholder="Nhập tên bài khảo sát (*)" value="{{ old('name') }}">
                                @error('name')
                                <strong class="text-red">
                                    {{$message}}
                                </strong>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="">Tiêu đề</label>
                                <input name="title" type="text" class="form-control" id=""
                                    placeholder="Nhập tiêu đề bài khảo sát" value="{{ old('title') }}">
                                @error('username')
                                <strong class="title">
                                    {{$message}}
                                </strong>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="">Nội dung bài khảo sát</label>
                                <textarea name="content" type="text" class="form-control" id=""
                                    placeholder="Nhập nội dung bài khảo sát" value="{{ old('content') }}" cols="30"
                                    rows="5"></textarea>
                                @error('content')
                                <strong class="text-red">
                                    {{$message}}
                                </strong>
                                @enderror
                            </div>

                        </div>
                        <div class="col-md-6 col-12">
                            <div class="form-group">
                                <label for="">Người tạo</label>
                                <input name="" type="text" class="form-control" id="" readonly
                                    placeholder="Nhập password (*)" value="{{Auth::user()->fullname}}">
                                <input type="hidden" name="created_by" value="{{Auth::user()->id}}">
                            </div>
                            <div class="form-group">
                                <label for="">Loại khảo sát</label>
                                <select name="type" class="form-control" id="">
                                    <option value="1">Bài đánh giá nhân viên</option>
                                    <option value="2">Bài kiểm tra chất lượng nhân viên</option>
                                    <option value="3">Bài khảo sát khách hàng</option>
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="">Hướng dẫn làm bài khảo sát</label>
                                <textarea name="tutorial" type="text" class="form-control" id=""
                                    placeholder="Nhập hướng dẫn làm bài khảo sát" value="{{ old('tutotial') }}" cols="30"
                                    rows="5"></textarea>
                                @error('content')
                                <strong class="text-red">
                                    {{$message}}
                                </strong>
                                @enderror
                            </div>

                        </div>

                    </div>
                    <button class="btn btn-traphaco">
                        Lưu thông tin
                    </button>
                </form>
            </div>
        </div>
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

@include('admin.pages.survey.script')

@endsection

