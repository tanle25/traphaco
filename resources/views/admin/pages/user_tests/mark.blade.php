@extends('admin.main_layout')

@section('custom-css')
<style>
    textarea {
        resize: none;
        overflow: hidden;
    }
</style>
@endsection


@section('title')
    Các bài khảo sát
@endsection

@section('content')
    @include('admin.partials.content_header', ['title' => 'Chấm điểm bài test'])
    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">{{$test->type == 1 ? 'Chấm điểm bài khảo sát' : 'Làm bài đánh giá chất lượng'}} </h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                 <div class="card card-info mx-auto mt-3" style="max-width: 1024px">
                    <div class="card-header">
                        <h2>
                            {{$test->survey->title ?? ''}}
                        </h2>
                        <div>
                            <h5>{{$test->survey->content ?? ''}}</h5>
                        </div>
                        <div class="mt-3">
                            <h5>
                                {{$test->type == 1 ? 'Người được khảo sát' : 'Người làm bài'}}: {{$test->candiate->fullname}} |{{$test->candiate->department->department_name ?? ''}} - {{$test->candiate->position->department_name ?? ''}} , Trọng số: {{$test->multiplier}}
                            </h5>
                        </div>
                    </div>

                    <div class="card-body">
                        @foreach ($survey->section as $section)
                        <div class="section-header mb-3">
                            <h3>
                                {{$section->title}}
                            </h3>
                        </div>
                        
                        @foreach ($section->questions as $question)
                            <div class="mb-3 question">
                                <div class="question-title">
                                    <h5> <strong> Câu hỏi:</strong>{{$question->content ?? ''}}</h5>
                                </div>
                                <div class="question-option pt-2">
                                    <div class="row" style="font-size: 18px">  
                                        @foreach ($question->options as $option)
                                        <div class="form-group col-md-3 d-flex justify-center align-center">
                                            <input class="option-input" type="radio" style="height:23px; width:23px" data-question-id="{{$question->id}}" name="question-{{$question->id}}" value="{{$option->id}}">
                                            <span class="pl-2" style="line-height: 23px">{{$option->content ?? ''}}
                                                @if ($test->type == 1)
                                                ({{$option->score ?? 0}} điểm)</span>
                                                @endif 
                                        </div>
                                        @endforeach 
                                    </div>
                                    <div class="form-group">
                                        <textarea class="form-control comment" value="" oninput="auto_grow(this)" rows="1" placeholder="Nhận xét"></textarea>
                                    </div>
                                </div>
                            </div>  
                            @endforeach
                        @endforeach
                        <button href="{{route('answer.store')}}" class="btn btn-traphaco send-result">Gửi kết quả</button>

                    </div> 


                </div>

              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
      </div>
      <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
@endsection 

@section('custom-js')
<script>
    
    $(document).on('click', '.send-result', function (e) {
        var url = $(this).attr('href');
        var questionCount = $('.question').length;
        var answer = [];
        $('.option-input:checked').each(function(){
            answer.push({
                question_id: $(this).data('question-id'),
                option_id: $(this).attr('value'),
                comment: $(this).closest('.question-option').find('.comment').val(),
            });     
        })

        if(questionCount !== answer.length){
            Swal.fire({
                title: 'Bạn chưa hoàn thành bài test!',
                text: "Vui lòng hoàn thành bài test trước khi gửi!",
                icon: 'warning',
                showCancelButton: true,
                showConfirmButton: false,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                cancelButtonText: 'Tôi hiểu',
            })
            return
        }

        Swal.fire({
            title: 'Hoàn thành bài test!',
            text: "Gửi kết quả!",
            icon: 'success',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Gửi kết quả!',
        })
        .then((result) => {
            console.log(answer);
            if (result.value) {
                $.ajax({
                    url: url,
                    type: "POST",
                    data: {
                        _token: $('meta[name="csrf-token"]').attr('content'),
                        answer: answer,
                        test_id: {{$test->id}},
                    },
                    success: function (data) {
                        if (data.error) {
                            swalToast(data.error, 'error');
                        }
                        if (data.msg) {
                            swalToast(data.msg);
                        }
                        setTimeout(function () {
                            location.href = "{{route('answer.index', ['marked' => 0])}}";
                        }, 300)
                    },
                    error: function (errors) {
                        swalToast('Lỗi không rõ phát sinh trong quá trình xóa', 'error');
                    }
                });
            }
        });
    })
</script>
@endsection