<table>
    <thead>
        <tr></tr>
        <tr></tr>
        <tr>
            <th colspan="5"><strong>BÁO CÁO CHƯƠNG TRÌNH KHẢO SÁT KHÁCH HÀNG</strong> </th>
        </tr>
        <tr>
            <th colspan="5"><strong>TÊN CHƯƠNG TRÌNH:</strong>{{$survey->name}}</th>
        </tr>
        <tr></tr>
        <tr></tr>
    </thead>
    <tbody>
        <tr>
            <th><strong>STT</strong></th>
            <th><strong>NỘI DUNG</strong></th>
            <th><strong>SỐ LƯỢNG</strong></th>
            <th><strong>TỶ LỆ</strong></th>
            <th><strong>CHI TIẾT</strong></th>
        </tr>
        @foreach ($survey->getQuestions() as $index => $question)
            @php
                $count = $question->options->count() + 1;
                if($question->can_comment == 1){
                    $count ++;
                }
            @endphp
            <tr>
                <td rowspan="{{$count + 1}}">{{$index + 1}}</td>
                <td colspan="4"><strong>Câu hỏi: {{$question->content}}</strong></td>
            </tr>
            @foreach ($question->options as $option)
            @php
                $answers = $option->getCustomerChoosen();
                $customer_chosen_count = $option->countCustomerChosen();
                $answer_count = $question->getAnswerCount();
            @endphp
                <tr>
                    <td>
                        {{$option->content ?? ''}}
                    </td>
                    <td>
                        {{$customer_chosen_count}}
                    </td>
                    <td>
                        @if ($answer_count !== 0)
                        {{ round($customer_chosen_count / $answer_count * 100, 2)}}%
                        @endif
                    </td>
                    <td>
                        @foreach ($answers as $answer)
                        @php
                            $customer = $answer->customer_test->customer;
                        @endphp
                        {{$customer->contract_code}}-{{$customer->pharmacy_name}},
                        @endforeach
                    </td>
                </tr>
            @endforeach 

            @if ($question->can_comment == 1)
                @php
                    $answer_has_comment = $question->getAnswerWithComment();
                @endphp
                <tr>
                    <td>Khác</td>
                    <td>{{$answer_has_comment->count()}}</td>
                    <td>{{round( $answer_has_comment->count() / $question->getAnswerCount() * 100, 2)}}%</td>
                    <td>
                        @foreach ($answer_has_comment as $answer)
                        <span>{{$answer->customer_test->customer->contract_code}}-{{$answer->customer_test->customer->pharmacy_name}}: {{$answer->comment}}</span> <br>
                        @endforeach
                    </td>
                </tr>
            @endif
            <tr>
                @php
                    $empty_answer = $question->getEmptyCustomerAnswer();
                @endphp
                <td>Không tick</td>
                <td>{{$empty_answer->count()}}</td>
                <td>{{round( $empty_answer->count() / $question->getAnswerCount() * 100, 2)}}%</td>
                <td>
                    @foreach ($empty_answer as $answer)
                    {{$answer->customer_test->customer->contract_code}}-{{$answer->customer_test->customer->pharmacy_name}}, 
                    @endforeach
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
