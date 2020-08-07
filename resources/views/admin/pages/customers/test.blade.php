<style>
    textarea {
        resize: none;
        overflow: hidden;
    }
</style>

<div class="card card-info mx-auto mt-3" style="max-width: 1024px">
       <div class="card-header">
           <h2>
               {{$tsurvey->title ?? ''}}
           </h2>
           <div>
               <h5>{{$survey->content ?? ''}}</h5>
           </div>
           <div class="mt-3">
               <h5>
                    Khách hàng: {{$customer->fullname}}
               </h5>
               <h5>
                    Địa chỉ: {{$customer->address}}
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
           <button href="{{route('admin.customer.store_customer_answer')}}" class="btn btn-traphaco send-result">Gửi kết quả</button>
       </div> 
   </div>
</div>
