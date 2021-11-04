@extends('admin.main_layout')
@section('custom-css')
<style>
    textarea {
        resize: none;
        overflow: hidden;
    }
    .padding-content{
        padding: 80px;
    }
</style>
@endsection

@section('title')
    Các bài đánh giá
@endsection

@section('content')
    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            <div class="card card-info mx-auto mt-5" style="max-width: 1024px">

                <form action="{{route('store.answer')}}" method="post" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="test_id" value="{{$test->id}}">
                <div class="card-body padding-content">
                    <div>
                        <h3 class="text-center text-uppercase font-weight-bold">Phiếu biểu quyết</h3>
                        <h6 class="text-center font-italic">(Kèm theo phiếu lấy ý kiến cổ đông số  /2021/CV-HĐQT ngày 14/6/2021)</h6>
                        <br><br>
                        <div class="row">
                            <div class="col-md-2"> <span>Họ tên cổ đông:</span> </div>
                            <div class="col-md-2"><strong>{{Auth::user()->fullname}}</strong></div>
                            <div class="col-md-2"><span> Quốc tịch:</span></div>
                            <div class="col-md-2"><strong>{{Auth::user()->nationality}}</strong></div>
                        </div>

                        <div class="row">
                            <div class="col-md-2"> <span>Số đăng ký sở hữu:</span> </div>
                            <div class="col-md-2"><strong>{{Auth::user()->registration_number}}</strong></div>
                        </div>
                        <div class="row">
                            <div class="col-md-2"> <span>Ngày cấp:</span> </div>
                            <div class="col-md-2"><strong>{{Auth::user()->date_range}}</strong></div>
                            <div class="col-md-2"><span>Nơi cấp:</span></div>
                            <div class="col-md-2"><strong>{{Auth::user()->place_issued}}</strong></div>
                        </div>
                        <div class="row">
                            <div class="col-md-4"> <span>Người đại diện <i>(Đối với cổ đông tổ chức):</i></span> </div>
                            <div class="col-md-2"><strong>{{Auth::user()->deputy}}</strong></div>

                        </div>
                        <div class="row">
                            <div class="col-md-2"> <span>Số giấy tờ pháp lý:</span> </div>
                            <div class="col-md-2"><strong>{{Auth::user()->document_number}}</strong></div>
                        </div>
                        <div class="row">
                            <div class="col-md-2"> <span>Địa chỉ liên lạc:</span> </div>
                            <div class="col-md-10"><strong>{{Auth::user()->address}}</strong></div>
                        </div>
                        <div class="row">
                            <div class="col-md-3"> <span>Số lượng cổ phần sở hữu:</span> </div>
                            <div class="col-md-9"><strong>{{Auth::user()->number_share}}</strong></div>
                        </div>

                        <br> <br>
                    @foreach ($survey->section as $section)
                    <div class="section-header mb-3">
                        <h3>
                            <b> {{$section->title}}</b>
                        </h3>
                        <h4>
                            {{$section->content}}
                        </h4>
                    </div>

                    @foreach ($section->questions as $question)
                        @php
                        $answer = $question->getAnswerByUserTest($test->id);
                        @endphp
                        <div data-question-id="{{$question->id}}" class="mb-3 question {{$question->must_mark == 1 ? 'must-mark' : ''}}">
                            <div class="question-title">
                                <h5 style="white-space: pre-line">{{$question->content ?? ''}} {{$question->must_mark == 1 ? '(*)' : ''}}</h5>
                            </div>
                            <div class="question-option pt-2">
                                <div class="row" style="font-size: 18px">
                                    @php
                                        $question_options = $question->options;
                                        $option_length = $question_options->reduce(function($length, $item){
                                            return $length + strlen($item->content);
                                        }, 0);
                                    @endphp

                                    @foreach ($question->options as $option)
                                    <div class="form-group  @if ($option_length <= 72) col-md-3 @else col-12 @endif d-flex justify-center align-center">
                                        <input
                                        @if ($answer) {{$answer->option_choice == $option->id ? 'checked' : ''}} @endif
                                        class="option-input"
                                        type="radio"
                                        style="height:23px; width:23px;flex: 0 0 23px "
                                        data-question-id="{{$question->id}}"
                                        name="question-{{$question->id}}"
                                        value="{{$option->id}}"
                                        @if ($answer)
                                            @if ($answer->option_choice !== $option->id )
                                            @cannot('sửa bài đánh giá đã làm') disabled @endcan
                                        @endif

                                        @endif
                                        >

                                        <span class="pl-2" style="line-height: 23px">
                                            @if ($answer)
                                                @if ($test->survey->type == 2 && $option->score == 1 && $answer->option_choice == $option->id)
                                                    <strong class="text-success">{{$option->content ?? ''}}</strong>
                                                @elseif($test->survey->type == 2 && $option->score == 1)
                                                    <strong class="text-danger">{{$option->content ?? ''}}</strong>
                                                @else
                                                    {{$option->content ?? ''}}
                                                @endif
                                            @else
                                                {{$option->content ?? ''}}
                                            @endif


                                            @if ($test->survey->type == 1)
                                            ({{$option->score ?? 0}} điểm)
                                            @endif
                                        </span>

                                    </div>
                                    @endforeach
                                </div>
                                <div class="form-group">
                                    @if ($question->can_comment == 1)
                                    <textarea
                                    class="form-control comment"
                                    value="" oninput="auto_grow(this)"
                                    rows="1"
                                    placeholder="Nhận xét khác"
                                    @cannot('sửa bài đánh giá đã làm')readonly @endcan
                                    >
                                        {{$question->getAnswerByUserTest($test->id)->comment ?? ''}}
                                    </textarea>
                                    @endif
                                </div>
                            </div>
                        </div>
                        @endforeach
                    @endforeach
                    <div class="row">
                        <div class="col-md-9">

                        </div>
                        <div class="col-md-3 text-center ">
                            <h5 class= "text-uppercase font-weight-bold">Cổ đông</h5>
                            <h6><i>(Ký và ghi rõ họ tên, đóng dấu nếu là cổ đông tổ chức)</i></h6>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-2">
                            <input type="file" name="attachment" id="attachment" style="visibility: hidden">
                            <label for="attachment">
                                <img src="{{asset('images/placeholder-image.png')}}" width="100%" id="preview" alt="">
                                Tập tin đính kèm
                            </label>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-traphaco send-result">Gửi kết quả</button>

                </div>
            </form>

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
    @include('admin.pages.user_tests.script');

@endsection
