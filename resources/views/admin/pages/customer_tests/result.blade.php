
<div class="card card-info mx-auto mt-3" style="max-width: 1024px">
    <div class="card-header">
       Thông tin cuộc khảo sát
       <div class="card-tools">
        <button type="button" class="btn btn-info btn-sm" data-card-widget="collapse">
          <i class="fas fa-minus"></i>
        </button>
        <button type="button" class="btn btn-danger btn-sm" data-card-widget="remove">
          <i class="fas fa-times"></i>
        </button>
      </div>
    </div>

    <div class="card-body">
        <form action="" method="post" id="customer-test-form">
            <input type="hidden" name="_token" value="{{csrf_token()}}">
            <input type="hidden" name="id">
            <div class="form-inline">
                <label class="col-md-2 d-inline-block text-left">Mã DMS:</label>
                <input type="test" class="col-md-10 form-control no-border" readonly  name="" value="">
            </div>
            <div class="form-inline">
                <label class="col-md-2 d-inline-block text-left">Mã CRM:</label>
                <input type="test" class="col-md-10 form-control no-border" readonly name="" value="">
            </div>
            <div class="form-inline">
                <label class="col-md-2 d-inline-block text-left">Mã hợp đồng:</label>
                <input type="test" class="col-md-10 form-control no-border" readonly name="" value="">
            </div>
    </div> 
</div>
</div>


<div class="card card-info mx-auto mt-3" style="max-width: 1024px">
       <div class="card-header">
           <h2>
               {{$survey->title ?? ''}}
           </h2>
           <div>
               <h5>{{$survey->content ?? ''}}</h5>
           </div>
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
               <div class="mb-3 question" data-question-id="{{$question->id}}">
                   <div class="question-title">
                       <h5> <strong> Câu hỏi:</strong>{{$question->content ?? ''}}</h5>
                   </div>
                   <div class="question-option pt-2">
                       <div class="row option-wraper" style="font-size: 18px">  
                           @foreach ($question->options as $option)
                           <div class="form-group col-md-12 d-flex justify-center align-center">
                                <input class="option-input" type="radio" style="height:23px; flex: 0 0 23px" data-question-id="{{$question->id}}" name="question-{{$question->id}}" value="{{$option->id}}">
                                <span class="pl-2" style="line-height: 23px" >{{$option->content ?? ''}}
                                <span>{{$option->countCustomerChosen()}}</span>

                                @if ($question->getAnswerCount() !== 0)
                                {{ round($option->countCustomerChosen() / $question->getAnswerCount() * 100, 2)}}%
                                @endif
                           </div>
                           @endforeach 
                       </div>

                       @if ($question->can_comment == 1)
                       <div class="form-group d-flex align-items-center ">
                            <input class="option-input  align-middle" type="radio" style="height:23px; width:23px" data-question-id="{{$question->id}}" name="question-{{$question->id}}" value="{{$option->id}}">
                            <span class="d-block ml-2 mr-2" style="font-size: 18px">Khác</span>
                            <div class="btn-group dropright">
                                <button type="button" class="btn btn-light dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                  Chi tiết
                                </button>
                                <div class="dropdown-menu p-3 ">
                                    @foreach ($question->getAllAnswer() as $answer)
                                        @if ($answer->comment)
                                        <span>{{$answer->customer_test->customer->fullname}} : {{$answer->comment}}</span> 
                                        @endif
                                    @endforeach
                                </div>
                            </div>                           
                        </div>
                       @endif
                   </div>
               </div>  
               @endforeach
           @endforeach
           <button href="{{route('admin.customer.store_customer_answer')}}" class="btn btn-traphaco send-result">Gửi kết quả</button>
       </div> 
   </div>
</div>
