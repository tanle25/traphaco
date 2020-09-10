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
    {{-- @include('admin.partials.content_header', ['title' => 'Chấm điểm bài test']) --}}
    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            <div class="card card-info mx-auto mt-5" style="max-width: 1024px">
                <div class="card-header">
                    <h2>
                        {{$test->survey->title ?? ''}}
                    </h2>
                    <div>
                        <h5>{{$test->survey->content ?? ''}}</h5>
                    </div>
                    <div>
                        <h5 class="mt-4">
                            Thời gian làm bài: Từ {{ Carbon\Carbon::parse( $test->getStartTime())->format('d/m/Y H:i') ?? ''}} đến {{ Carbon\Carbon::parse( $test->getEndTime())->format('d/m/Y H:i') ?? ''}}
                            @if ( Carbon\Carbon::parse( $test->getEndTime())->format('d/m/Y H:i') < Carbon\Carbon::now() )
                                (Đã hết thời gian làm bài)
                            @endif
                        </h5>
                    </div>
                    <div class="mt-2">
                        <h5>
                            {{$test->survey->type == 1 ? 'Người được đánh giá' : 'Người làm bài'}}: {{$test->candiate->fullname}} |{{$test->candiate->department->department_name ?? ''}} - {{$test->candiate->position->department_name ?? ''}} , Trọng số: {{$test->multiplier}}
                        </h5>
                    </div>
                </div>

                <div class="card-body">
                    @foreach ($survey->section as $section)
                    <div class="section-header mb-3">
                        <h3>
                            {{$section->title}}
                        </h3>
                        <h4>
                            {{$section->content}}
                        </h4>
                    </div>
                    
                    @foreach ($section->questions as $question)
                        <div data-question-id="{{$question->id}}" class="mb-3 question {{$question->must_mark == 1 ? 'must-mark' : ''}}">
                            <div class="question-title">
                                <h5> <strong></strong>{{$question->content ?? ''}} {{$question->must_mark == 1 ? '(bắt buộc)' : ''}}</h5>
                            </div>
                            <div class="question-option pt-2">
                                <div class="row" style="font-size: 18px">  
                                    @php
                                        $question_options = $question->options;
                                        $option_length = $question_options->reduce(function($length, $item){
                                            return $length + strlen($item->content);
                                        }, 0);
                                    @endphp

                                    @foreach ($question_options as $option)
                                    <div class="form-group d-flex justify-center align-center @if ($option_length <= 72) col-md-3 @else col-12 @endif">
                                        <input class="option-input" type="radio" style="height:23px; width:23px; flex: 0 0 23px" data-question-id="{{$question->id}}" name="question-{{$question->id}}" value="{{$option->id}}">
                                        <span class="pl-2" style="line-height: 23px">{{$option->content ?? ''}}
                                            @if ($test->type == 1)
                                            ({{$option->score ?? 0}} điểm)</span>
                                            @endif 
                                    </div>
                                    @endforeach 

                                </div>
                                <div class="form-group">
                                    @if ($question->can_comment == 1)
                                    <textarea class="form-control comment" value="" oninput="auto_grow(this)" rows="1" placeholder="Nhận xét"></textarea>                                        
                                    @endif
                                </div>
                            </div>
                        </div>  
                        @endforeach
                    @endforeach
                    <button href="{{route('answer.store')}}" class="btn btn-traphaco send-result">Gửi kết quả</button>
                </div> 


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