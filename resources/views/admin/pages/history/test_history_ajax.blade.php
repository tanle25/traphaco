<!-- Main content -->
<section class="content">
    <div class="">
        <div class="row">
        <div class="col-12">
            <div class="card card-info mx-auto">
                <div class="card-header">
                    <h4>
                        {{$test->survey->title ?? ''}}
                    </h4>
                    <div>
                        <h5>{{$test->survey->content ?? ''}}</h5>
                    </div>
                    <div class="mt-3">
                        <h5>
                            {{$test->survey->type == 1 ? 'Người được đánh giá' : 'Người làm bài'}}: {{$test->candiate->fullname}} |{{$test->candiate->department->department_name ?? ''}} - {{$test->candiate->position->department_name ?? ''}}
                        </h5>
                        <h5>
                            @if ($test->survey->type == 1)
                                Người đánh giá: {{$test->examiner->fullname}} | {{$test->examiner->department->department_name ?? ''}} - {{$test->examiner->position->department_name ?? ''}}
                            @endif
                        </h5>
                    </div>
                </div>

                <div class="card-body">
                    @foreach ($test->survey->section as $section)
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
                                <h5 style="white-space: pre-line">{{$question->content ?? ''}} {{$question->must_mark == 1 ? '(*)' : ''}}</h5>
                            </div>
                            <div class="question-option pt-2">
                                <div class="row" style="font-size: 16px">  
                                    @php
                                        $options = $question->options;
                                    @endphp
                                    @foreach ($history_list as $item)
                                        @if ($item->subject->question_id === $question->id)

                                            @if ($item->description == 'created')
                                            <div class="form-group col-12 d-flex justify-center align-center">
                                                <span class="pl-2" style="line-height: 23px">
                                                Lựa chọn: {{$options->where('id', $item->properties['attributes']['option_choice'])->first()->content ?? 'Không chọn'}}
                                                @if ($item->properties['attributes']['comment'] ?? false)
                                                |Ý kiến khác: {{$item->properties['attributes']['comment']}}
                                                @endif
                                                | {{Carbon\Carbon::parse($item->created_at)->format('d/m/Y H:i A')}}
                                                |Người thực hiện: {{$item->causer->fullname}}
                                                </span>
                                            </div>
                                            @endif

                                            @if ($item->description == 'updated')
                                            <div class="form-group col-12 d-flex justify-center align-center">
                                                <span class="pl-2" style="line-height: 23px">
                                                    @if (isset($item->properties['attributes']['option_choice']))
                                                    Sửa thành: {{$options->where('id', $item->properties['attributes']['option_choice'])->first()->content ?? 'Không chọn'}}    
                                                    @else
                                                    Không sửa lựa chọn
                                                    @endif
                                                    @if (isset($item->properties['attributes']['comment']))
                                                    |Sửa nhận xét: {{$item->properties['attributes']['comment']}}
                                                    @endif
                                                    | {{Carbon\Carbon::parse($item->created_at)->format('d/m/Y H:i A')}}
                                                    |Người thực hiện: {{$item->causer->fullname}}
                                                </span>
                                            </div>
                                            @endif

                                        @endif
                                    @endforeach
                                </div>
                            </div>
                        </div>  
                        @endforeach
                    @endforeach
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