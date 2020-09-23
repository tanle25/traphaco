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
                        //Kiểm tra location nếu có edit thì trả về những bài đã làm
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

        Swal.fire({
            title: 'Hoàn thành bài đánh giá!',
            text: "Gửi kết quả!",
            icon: 'success',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Gửi kết quả!',
        })
        .then((result) => {
            if (result.value) {
                saveAnswer(url, answer);
            }
        });
    })

    // console.log(Date.now());
    // console.log(Date.parse( "{{$test->getEndTime()}}"));

    @if(\Request::route()->getName() === "answer.mark" )
    var checkTime =  setInterval(function(){
        console.log(Date.now());

        if( Date.now() >  Date.parse("{{$test->getEndTime()}}") - 10000 ){
            clearInterval(checkTime);
            Swal.fire({
                title: 'Hết thời gian làm bài!',
                text: "Kết quả sẽ được gửi ngay!",
                icon: 'success',
            });
            var answer = getAnswer();
            setTimeout(function(){
                saveAnswer(url, answer);
            }, 3000)

        }
    }, 2000)    
    @endif
    
    

</script>