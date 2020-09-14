<table id="user-result-table" class="table table-bordered table-hover">
    <thead>
        <tr>
            <th></th>
            <th></th>
            <th></th>
            <th></th>
            <th></th>
            <th></th>
        </tr>
        <tr></tr>
        <tr>
            <th colspan="7"><strong> BẢNG TỔNG HỢP KẾT QUẢ ĐÁNH GIÁ</strong></th>
        </tr>
        <tr>
            <th colspan="7">Ngày tổng hợp báo cáo {{Carbon\Carbon::now()->format('d/m/Y')}}</th>
        </tr>
        <tr>
            <th></th>
            <th colspan="6">Đợt đánh giá: {{$survey_round->name}}</th>
        </tr>
        <tr></tr>
        @php
            $survey_groups = $tests->filter(function($item){
                return $item->survey->type == 2;
            })->groupBy('survey_id');
        @endphp

        @foreach ($survey_groups as $survey_group)
            @php
                $survey = $survey_group->first()->survey;
                $questions = $survey->getQuestions();

            @endphp
            <tr></tr>
            <tr>
                <th></th>
                <th colspan="6">{{$survey->name}}</th>
            </tr>
            
            <tr>
                <th><strong>TT</strong></th>
                <th><strong>Họ tên người được đánh giá</strong></th>
                @foreach ($questions as $question)
                <th>{{$question->content}}</th>
                @endforeach
            </tr>      
            @foreach ($survey_group as $index => $test)
            <tr>
                <td>{{$index + 1}}</td>
                <td>{{$test->candiate->fullname}} | {{$test->candiate->department->department_name}}</td>
                @foreach ($questions as $question)
                @php
                    $option_choice = $test->answer->where('question_id', $question->id)->first()->selected_option ?? null; 
                @endphp
                <td>{{$option_choice->content ?? ''}}</td>
                @endforeach    
            </tr>
                
            @endforeach
          

        @endforeach

        
    </thead>
    <tbody>
      
    </tbody>
</table> 