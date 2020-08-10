<table>
    <thead>
        <tr style="tesxt-transform:upercase">
            <th>STT</th>
            <th>MÃ DMS</th>
            <th>MÃ CRM</th>
            <th>MÃ HỢP ĐỒNG</th>
            <th>TÊN NHÀ THUỐC</th>
            <th>TÊN KHÁCH HÀNG</th>
            <th>TÊN NGƯỜI LÀM KHẢO SÁT</th>
            @foreach ($survey->getQuestions() as $item)
            <th>{{ strtoupper($item->content)}}</th>
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
            <td>{{$test->customer->pharmacy_code}}</td>
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