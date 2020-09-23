<script>
    var url = $('.send-result').attr('href');

    function alertMustMarkQuestion(){
        Swal.fire({
                title: 'Bạn chưa hoàn thành bài đánh giá!',
                text: "Vui lòng hoàn thành các câu hỏi (*)!",
                icon: 'warning',
                showCancelButton: true,
                showConfirmButton: false,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                cancelButtonText: 'Tôi hiểu',
            })
    }

    function alertProblemInSurvey(){
        Swal.fire({
                title: 'Bộ đề có câu hỏi trắng không thể hoàn thành!',
                text: "Vui lòng báo lại người tạo bài đánh giá bổ sung thêm!",
                icon: 'warning',
                showCancelButton: true,
                showConfirmButton: false,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                cancelButtonText: 'Tôi hiểu',
            })
    }

    function getAnswer(){
        var answer = [];
        $('.question').each(function(){
            var questionId = $(this).data('question-id');
            answer.push({
                question_id: questionId,
                option_id: $(this).find('.option-input:checked').attr('value') ? $(this).find('.option-input:checked').attr('value') :  '',
                comment: $(this).find('.comment').val() ? $(this).find('.comment').val() : '',
            });     
        })
        return answer
    }

    function saveAnswer(url, answer){
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
                    setTimeout(function () {
                        if(location.href.indexOf('edit') == - 1){
                            location.href = "{{route('answer.index', ['marked' => 0])}}";
                        }else{
                            location.href = "{{route('answer.index', ['marked' => 1])}}";
                        }
                    }, 300)
                } 
            },
            error: function (errors) {
                swalToast('Lỗi không rõ phát sinh trong quá trình gửi', 'error');
            }
        });
    }

    $(document).on('click', '.send-result', function (e) {
        var mustMark = $('.must-mark');
        var isValidAnswer = true;
        
        mustMark.each(function(){
            var option = $(this).find('.option-input');
            var comment = $(this).find('textarea');
            //Case 1 comment == null & option == null
            if(!option && !comment ){
                alertProblemInSurvey();
                return;
            }
            //Case2
            temp = false;
            if(option){
                option.each(function(){
                    if($(this).prop('checked')){
                        temp = true;
                        return;
                    }
                });
                if(comment){
                    if(temp == false && comment.val() != '' && typeof(comment.val()) == 'string'){
                        temp = true;
                    }
                }
            }else{
                if(temp == false && comment.val() != '' && typeof(comment.val()) == 'string'){
                    temp = true;
                }
            }
            if(temp == false){
                isValidAnswer = false;
                return false;
            }
        });

        if(!isValidAnswer){
            alertMustMarkQuestion();
            return
        }

        var answer = getAnswer();
        saveAnswer(url, answer);
    })

    var session_time = {{Carbon\Carbon::now()->timestamp * 1000}};
    @if(\Request::route()->getName() === "answer.mark" )
    var checkTime =  setInterval(function(){
        session_time += 2000; 
        if( session_time >  {{Carbon\Carbon::parse($test->getEndTime())->timestamp * 1000}} - 10000 ){
            clearInterval(checkTime);
            Swal.fire({
                title: 'Hết thời gian làm bài!',
                text: "Kết quả sẽ được gửi ngay!",
                icon: 'success',
            });
            var answer = getAnswer();
            setTimeout(function(){
                saveAnswer(url, answer);
            }, 1000)
        }
    }, 2000)

    @endif

</script>