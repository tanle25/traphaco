<!--=========================================================-->
@php
    if (isset($survey->section)) {
        $sections = $survey->section;
    }
    else{
        $sections = [];
    }
@endphp



<div class="question-tool mx-auto d-flex" style="max-width: 768px">
    <div class="card col-12 " >
        {{-- section edit --}}
        <div class="card-header">
            <div class="card-title">
                Bộ câu hỏi
            </div>
            <a href="#" 
            class="btn btn-success float-right mr-4" 
            data-toggle="modal"
            data-target="#import-model"
            >
                <i class="fas fa-file-excel"></i> Import Excel
            </a>
        </div>
        <div class="card-body ">
            {{-- start section question --}}
            <div class="sortable editor-body">
                @foreach ($sections as $section)
                <div class="card section-wraper" data-section-id="{{$section->id}}" style="margin-bottom: 20px">
                    {{-- section handle --}}
                    <div class="sortable-handle text-center p-2">
                        <i class="fas fa-grip-lines"></i>
                    </div>
                    {{-- section header --}}
                    <div class=" section-header callout">
                        <div class=" row">
                            <div class="col-sm-10 section-title">
                                <input type="text" placeholder="Tiêu đề section" value="{{$section->title ?? ''}}">
                                <div class="focus-line"></div>
                            </div>
                            <div class="section-remove">
                                <i class="far fa-trash-alt" style="font-size: 20px; cursor:pointer"></i>
                            </div>
                        </div>
                        <textarea oninput="auto_grow(this)" name="email" type="text" class="section-content"
                                placeholder="Nhập nội dung section"cols="30"
                                rows="1">{{$section->content}}</textarea>
                    </div>
                    {{-- section question --}}
                    @php
                        if(isset($section->questions)){
                            $questions = $section->questions;
                        }
                        else{
                            $questions = [];
                        }
                    @endphp
                        <div class="sortable question-container">
                            @foreach ($questions as $question)
                            <div class="callout question-wraper" data-question-id="{{ $question->id}}">
                                <div class="form-group row">
                                    <div class="col-sm-10 question-title">
                                        <textarea oninput="auto_grow(this)" name="" id="" cols="30" rows="1" placeholder="Câu hỏi">{{$question->content}}</textarea>
                                        <div class="focus-line"></div>
                                    </div>
                                    <div class="question-remove">
                                        <i class="far fa-trash-alt" style="font-size: 20px; cursor:pointer"></i>
                                    </div>
                                </div>
                                {{-- question options --}}
                                @php
                                    if(isset($question->options)){
                                        $options = $question->options;
                                    }
                                    else{
                                        $options = [];
                                    }
                                @endphp
                                <div class="sortable options-wraper" >
                                    @foreach ($options as $option)
                                    <div class="form-group question-option row" data-question-option-id="{{$option->id}}">
                                        <label class="question-option-label">
                                            <i class="far fa-circle"></i>
                                        </label>
                                        <div class="col-8">
                                            <input value="{{$option->content}}" type="text" class="question-option-content" placeholder="Nhập câu trả lời">
                                        </div>
                                        <div class="col-2 d-flex">
                                            <input type="number" class="d-inline question-option-score" value="{{$option->score}}" placeholder="điểm">
                                        </div>
                                        <div class="question-option-remove">
                                            <i class="far fa-trash-alt" style="font-size: 20px; cursor:pointer"></i>
                                        </div>
                                    </div>
                                    @endforeach
                                </div>
                                <div class="can-comment">

                                    @if ($question->can_comment == 1)
                                    <div class="form-group question-option row" data-question-id="{{$question->id}}">
                                        <label class="question-option-label">
                                            <i class="far fa-circle"></i>
                                        </label>
                                        <div class="col-10">
                                            <input readonly type="text" class="question-comment" placeholder="Khác">
                                        </div>
                                        
                                        <div class="question-comment-remove">
                                            <i class="far fa-trash-alt" style="font-size: 20px; cursor:pointer"></i>
                                        </div>
                                    </div>
                                    @endif
                                </div>
                                {{-- question add --}}
                                
                                <div class="add-question row ">
                                    <div class="col-12 add-option d-flex">
                                        <input readonly type="text" class="question-option-add" id="" placeholder="Thêm câu trả lời">
                                        @if ($question->can_comment == 1)
                                        <input readonly type="text" class="question-comment-add" style="display:none" id="" placeholder="Thêm khác">
                                        @else
                                        <input readonly type="text" class="question-comment-add" style="display:block" id="" placeholder="Thêm khác">
                                        @endif
                                    </div>
                                    
                                    <div class="mt-3 d-flex justify-content-end col-12 question-footer " >
                                        <div class="question-duplicate ">
                                            <i class="far fa-copy align-m" style="font-size: 25px; cursor:pointer"></i>
                                        </div>
                                        <div class="form-group">
                                            <div class="custom-control custom-switch">
                                                <input {{$question->must_mark == 1 ? 'checked' : '' }} type="checkbox" class="d-none custom-control-input" data-question-id="{{$question->id}}" id="must-mark-{{$question->id}}">
                                                <label class="ml-3 custom-control-label" for="must-mark-{{$question->id}}">Bắt buộc</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                </div>
                @endforeach
                
            </div>
            {{-- end section question --}}
        </div>
        
    </div>
    {{-- Menu tool --}}
    <div class="question-tool-menu card" data-csstransition="false">
        <div class="tooltip question-tool-menu-btn add-section-btn">
            <i class="far fa-file" ></i>
            <span class="tooltiptext">Tạo mới section</span>
        </div>
        <div class="tooltip question-tool-menu-btn add-question-btn">
            <i class="fas fa-plus-circle"></i>
            <span class="tooltiptext">Tạo mới câu hỏi</span>
        </div>
    </div>

</div> 

<div class="modal fade"  id="import-model" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" style="max-width: 1024px" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Import file dữ liệu khách hàng</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
				<form action="{{route('admin.survey.import', $survey->id)}}" id="import-form" method="post" enctype="multipart/form-data">
					@csrf
                    <div class="form-group">
                        <label for="exampleInputFile">Chọn file xlsx</label>
                        <div class="input-group">
                          <div class="custom-file">
                            <input type="file" class="custom-file-input" name="customer_list" id="exampleInputFile">
                            <label class="custom-file-label" for="exampleInputFile">Chọn file...</label>
                          </div>
                          <div class="input-group-append">
                            <button class="input-group-text" id="">Upload</button>
                          </div>
                        </div>
                    </div>
				</form>
            </div>
        </div>
    </div>
</div>

<!--=========================================================-->