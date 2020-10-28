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
        var input = answer.filter(function(item){
            return item.option_id !== '';
        });

        $.ajax({
            url: url,
            type: "POST",
            data: {
                _token: $('meta[name="csrf-token"]').attr('content'),
                answer: input,
                test_id: {{$test->id}},
            },
            success: function (data) {
                if (data.error) {
                    swalToast(data.error, 'error');
                }
                
                if (data.msg) {
                    swalToast(data.msg);
                    
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

        setTimeout(function () {
            if(location.href.indexOf('edit') == - 1){
                location.href = "{{route('answer.index', ['marked' => 0])}}";
            }else{
                location.href = "{{route('answer.index', ['marked' => 1])}}";
            }
        }, 300)
    })

    setInterval(() => {
        var answer = getAnswer();
        saveAnswer(url, answer);
    }, 60000);

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

    (function () {
    let  duration = "{{- Carbon\Carbon::now()->timestamp * 1000 + Carbon\Carbon::parse($test->getEndTime())->timestamp * 1000}}";
    const second = 1000,
            minute = second * 60,
            hour = minute * 60,
            day = hour * 24;
    
    let endTime = new Date(),
        countDown = new Date(endTime).getTime(),
        x = setInterval(function() {    

            distance = duration;
            console.log(distance);
            //document.getElementById("days").innerText = Math.floor(distance / (day)),
            //document.getElementById("hours").innerText = Math.floor((distance % (day)) / (hour)),
            document.getElementById("minutes").innerText = Math.floor((distance / (minute))),
            document.getElementById("seconds").innerText = Math.floor((distance % (minute)) / second);
            duration -= 1000;
            //do something later when date is reached
            if (distance < 0) {
            let headline = document.getElementById("headline"),
                countdown = document.getElementById("countdown"),
                content = document.getElementById("content");

            countdown.style.display = "none";
            content.style.display = "block";

            clearInterval(x);
            }
            //seconds
        }, 1000)
    }());

</script>