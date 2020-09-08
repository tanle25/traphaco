<style>
    textarea {
        resize: none;
        overflow: hidden;
    }
    .no-border {
        border: 0;
        box-shadow: none;
        background: white;
    }

    input:-moz-read-only { /* For Firefox */
    background-color: white !important;
    }

    input:read-only {
    background-color: white !important;
    }

</style>

<div class="card card-info mx-auto mt-3" style="max-width: 1024px">
    <div class="card-header">
       Thông tin khách hàng
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
            <input type="hidden" name="_token" value="{{csrf_token()}}">
            <input type="hidden" name="id">
            <div class="form-inline">
                <label class="col-md-2 d-inline-block text-left">Mã DMS:</label>
                <input type="test" class="col-md-10 form-control no-border" readonly  name="" value="{{$test->customer->DMS_code}}">
            </div>
            <div class="form-inline">
                <label class="col-md-2 d-inline-block text-left">Mã CRM:</label>
                <input type="test" class="col-md-10 form-control no-border" readonly name="" value="{{$test->customer->CRM_code}}">
            </div>
            <div class="form-inline">
                <label class="col-md-2 d-inline-block text-left">Mã hợp đồng:</label>
                <input type="test" class="col-md-10 form-control no-border" readonly name="" value="{{$test->customer->contract_code}}">
            </div>

            <div class="form-inline">
                <label class="col-md-2 d-inline-block text-left">Tên khách hàng:</label>
                <input readonly type="test" id="test-fullname-value" class="col-md-9 col-11 form-control  no-border" name="fullname" value="{{$test->customer->fullname}}" placeholder="Nhập tên khách hàng">
            </div>
            <div class="form-inline">
                <label class="col-md-2 d-inline-block text-left">Tên nhà thuốc:</label>
                <input readonly type="test" id="test-fullname-value" class="col-md-9 col-11 form-control  no-border" name="pharmacy_name" value="{{$test->customer->pharmacy_name}}" placeholder="Nhập tên hiệu thuốc">
            </div>
            <div class="form-inline">
                <label class="col-md-2 col-12 d-inline-block text-left">Địa chỉ:</label>
                <input readonly type="test" id="test-address-value" class="col-md-9 col-11 form-control  no-border" value="{{$test->customer->address}}" name="address" placeholder="Nhập địa chỉ khách hàng">
            </div>
            <div class="form-inline">
                <label class="col-md-2 d-inline-block text-left">Số điện thoại:</label>
                <input readonly type="test" id="test-phone-value" class="col-md-9 col-11 form-control no-border" value="{{$test->customer->phone}}" name="phone" placeholder="Nhập số điện thoại">
            </div>
            <div class="form-inline">
                <label class="col-md-2 d-inline-block text-left">Địa bàn:</label>
                <input readonly id="test-zone-value" type="test" class="col-md-9 col-11 form-control no-border" value="{{$test->customer->zone}}" name="zone" placeholder="Nhập tên địa bàn">
            </div>
    </div> 
</div>
</div>


<div class="card card-info mx-auto mt-3" style="max-width: 1024px">
       <div class="card-header">
           <h2>
               {{$test->survey->title ?? ''}}
           </h2>
           <div>
               <h5>{{$test->survey->content ?? ''}}</h5>
           </div>
           </div>
       </div>

       <div class="card-body">
        <form action="{{route('admin.customer_test.update', $test->id)}}" id="test_form" method="post">
            @method('POST')
            @csrf
            @foreach ($test->survey->section as $section)
            <div class="section-header mb-3">
                <h3>
                    {{$section->title}}
                </h3>
            </div>
            @foreach ($section->questions as $question)
                <div class="mb-3 question" data-question-id="{{$question->id}}">
                    <div class="question-title">
                        <h5> <strong> Câu hỏi: </strong>{{$question->content ?? ''}}</h5>
                    </div>
                    <div class="question-option pt-2">
                        @if ($question->getAnswerByCustomerTest($test->id) && $question->getAnswerByCustomerTest($test->id)->comment == '' )
                        <div class="row option-wraper">  
                            @foreach ($question->options as $option)
                            <div class="form-group col-md-3 d-flex justify-center align-center">
                                @if ( $question->getAnswerByCustomerTest($test->id)->option_choice_model && $question->getAnswerByCustomerTest($test->id)->option_choice_model->id == $option->id)
                                <input 
                                checked  
                                class="option-input" 
                                type="radio" 
                                data-question-id="{{$question->id}}" 
                                name="question-{{$question->id}}" 
                                value="{{$option->id}}">
                                @else
                                <input
                                @cannot('sửa bài khảo sát khách hàng') disabled @endcan  
                                class="option-input" 
                                type="radio" 
                                data-question-id="{{$question->id}}" 
                                name="question-{{$question->id}}" 
                                value="{{$option->id}}">
                                @endif
                                <span class="pl-2" style="line-height: 23px">{{$option->content ?? ''}}
                            </div>
                            @endforeach
                        </div>
                        @else
                        <div class="row option-wraper">  
                            @foreach ($question->options as $option)
                            <div class="form-group col-md-3 d-flex justify-center align-center">
                                <input
                                @cannot('sửa bài khảo sát khách hàng') disabled @endcan 
                                class="option-input" 
                                type="radio" 
                                data-question-id="{{$question->id}}" 
                                name="question-{{$question->id}}" 
                                value="{{$option->id}}">
                                <span class="pl-2" style="line-height: 23px">{{$option->content ?? ''}}
                            </div>
                            @endforeach 
                        </div>
                        @endif
                        
                        @if ($question->can_comment == 1)
                        <div class="form-group">
                            <label for="">Ý kiến khác</label>
                            <textarea 
                            @cannot('sửa bài khảo sát khách hàng') readonly @endcan 
                            class="form-control comment"
                            value=""
                            oninput="auto_grow(this)" 
                            rows="1" placeholder="Ý kiến khác">@if ($question->getAnswerByCustomerTest($test->id)){{$question->getAnswerByCustomerTest($test->id)->comment}}@endif</textarea>
                        </div>
                        @endif
                    </div>
                </div>  
                @endforeach
            @endforeach
            @if (Auth::user()->can('sửa bài khảo sát khách hàng'))
            <button type="submit" class="btn btn-traphaco send-result">Sửa kết quả</button>
            @endif
        </form>

       </div> 
   </div>
</div>


<script>

     $(document).on('submit', '#test_form', function (e) {
        e.preventDefault();
        var url = $(this).attr('action');
        var questionCount = $('.question').length;
        var answer = [];

        $('.question').each(function(){
            var questionId = $(this).data('question-id');
            answer.push({
                question_id: questionId,
                option_id: $(this).find('.option-input:checked').attr('value') ? $(this).find('.option-input:checked').attr('value') :  '',
                comment: $(this).find('.comment').val() ? $(this).find('.comment').val() : '',
            });     
        })

        Swal.fire({
            title: 'Hoàn thành bài khảo sát!',
            text: "Gửi kết quả!",
            icon: 'success',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Gửi kết quả!',
        })
        .then((result) => {
            if (result.value) {
                $.ajax({
                    url: url,
                    type: "POST",
                    data: {
                        _token: $('meta[name="csrf-token"]').attr('content'),
                        answer: answer,
                        test_id: {{$test->id ?? ''}},
                    },
                    success: function (data) {
                        if (data.error) {
                            swalToast(data.error, 'error');
                        }
                        if (data.msg) {
                            swalToast(data.msg);
                        }
                        $('#customer-survey-model').modal('hide');
                        
                    },
                    error: function (errors) {
                        swalToast('Lỗi không rõ phát sinh trong quá trình gửi', 'error');
                    }
                });
            }
        });
    })

    // Customer Answer logic
    // $(document).on('click', '.send-result', function (e) {
    //     var url = $(this).attr('href');
    //     var questionCount = $('.question').length;
    //     var answer = [];

    //     $('.question').each(function(){
    //         var questionId = $(this).data('question-id');
    //         answer.push({
    //             question_id: questionId,
    //             option_id: $(this).find('.option-input:checked').attr('value') ?? '',
    //             comment: $(this).find('.comment').val() ?? '',
    //         });     
    //     })

    //     Swal.fire({
    //         title: 'Hoàn thành bài test!',
    //         text: "Gửi kết quả!",
    //         icon: 'success',
    //         showCancelButton: true,
    //         confirmButtonColor: '#3085d6',
    //         cancelButtonColor: '#d33',
    //         confirmButtonText: 'Gửi kết quả!',
    //     })
    //     .then((result) => {
    //         if (result.value) {
    //             $.ajax({
    //                 url: url,
    //                 type: "POST",
    //                 data: {
    //                     _token: $('meta[name="csrf-token"]').attr('content'),
    //                     answer: answer,
    //                     test_id: {{$new_test->id ?? ''}},
    //                 },
    //                 success: function (data) {
    //                     if (data.error) {
    //                         swalToast(data.error, 'error');
    //                     }
    //                     if (data.msg) {
    //                         swalToast(data.msg);
    //                     }
    //                     $('#customer-survey-model').modal('hide');
                        
    //                 },
    //                 error: function (errors) {
    //                     swalToast('Lỗi không rõ phát sinh trong quá trình gửi', 'error');
    //                 }
    //             });
    //         }
    //     });
    // })
    // $(document).on('blur', '#customer-test-form input',function(e){
    //     var url = $('#customer-test-form').attr('action');
    //     var key = $(this).attr('name');
    //     var value = $(this).val();
    //     var data = {
    //         [key]: value,
    //         _token: $('meta[name="csrf-token"]').attr('content'),
    //     }
    //     $.ajax({
    //         url: url,
    //         data: data,
    //         success: function(data){
    //             swalToast(data.success, 'success');
    //             setTimeout(function () {
    //                 $("#customer-table").DataTable().ajax.reload();
    //             }, 500);
    //         },
    //         error: function(errors){
    //             error_list = errors.responseJSON.errors;
    //             swalToast(Object.values(error_list)[0], 'error');
    //         }
    //     })
    // });

</script>