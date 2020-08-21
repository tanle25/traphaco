<table>
    <thead>
        <tr></tr>
        <tr></tr>
        <tr>
            <td colspan="14">BÁO CÁO CHƯƠNG TRÌNH KHẢO SÁT KHÁCH HÀNG</td>
        </tr>
        <tr>
            <td colspan="14">TÊN CHƯƠNG TRÌNH: {{$survey->name}}</td>
        </tr>
        <tr></tr>
        <tr></tr>
        <tr>
            <th><strong>STT</strong></th>
            <th><strong>MÃ DMS</strong></th>
            <th><strong>MÃ CRM</strong></th>
            <th><strong>MÃ HỢP ĐỒNG</strong></th>
            <th><strong>TÊN NHÀ THUỐC</strong></th>
            <th><strong>TÊN KHÁCH HÀNG</strong></th>
            <th><strong>TÊN NGƯỜI LÀM KHẢO SÁT</strong></th>
            @foreach ($survey->getQuestions() as $item)
            <th><strong>{{$item->content}}</strong></th>
            @endforeach
        </tr>
    </thead>
    <tbody>
        @foreach ($tests as $index => $test)
        <tr>
            <td>{{$index + 1}}</td>
            <td>{{$test->customer->DMS_code}}</td>
            <td>{{$test->customer->CRM_code}}</td>
            <td>{{$test->customer->contract_code}}</td>
            <td>{{$test->customer->pharmacy_name}}</td>
            <td>{{$test->customer->fullname}}</td>
            <td>{{$test->author->fullname}}</td>

            @foreach ($survey->getQuestions() as $question)
                @foreach ($test->answers as $answer)
                    @if ($answer->question_id == $question->id)
                        @if ($answer->comment)
                        <td>{{$answer->comment}}</td>
                        @elseif($answer->option_choice)
                        <td>{{$answer->option_choice_model->content}}</td>
                        @else
                        <td></td>
                        @endif
                        @break
                    @endif  
                @endforeach
            @endforeach
            
        </tr>   
        @endforeach
    </tbody>
</table>