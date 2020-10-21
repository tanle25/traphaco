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
    Các bài đánh giá
@endsection

@section('content')
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
                    <div class="mt-3">
                        <h5>
                            {{$test->survey->type == 1 ? 'Người được đánh giá' : 'Người làm bài'}}: {{$test->candiate->fullname}} |{{$test->candiate->department->department_name ?? ''}} - {{$test->candiate->position->department_name ?? ''}}
                        </h5>
                    </div>
                </div>

                <div class="card-body">
                    <div>
                        <h4 class="text-red font-weight-bold">KẾT QUẢ: {{$total_score ?? 0}} / {{$max_score ?? 0}}</h4> 
                    </div>
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
                    @can('sửa bài đánh giá đã làm')
                    <button href="{{route('answer.update_ans')}}" class="btn btn-traphaco send-result">Sửa kết quả</button>
                    @endcan
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