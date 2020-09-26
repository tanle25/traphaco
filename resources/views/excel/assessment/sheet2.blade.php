<table id="user-result-table" class="table table-bordered table-hover">
    <thead>
        <tr>
            <th></th>
            <th></th>
            <th></th>
            <th></th>
            <th></th>
            <th></th>
            <th>BM 01</th>
        </tr>
        <tr></tr>
        <tr>
            <th colspan="7"><strong> BẢNG TỔNG HỢP KẾT QUẢ ĐÁNH GIÁ NĂNG LỰC NHÂN VIÊN</strong></th>
        </tr>
        <tr>
            <th colspan="7">Ngày tổng hợp báo cáo {{Carbon\Carbon::now()->format('d/m/Y')}}</th>
        </tr>
        <tr></tr>
        <tr>
            <th rowspan="2"><strong>TT</strong> </th>
            <th rowspan="2"><strong>Nội dung</strong> </th>
            <th rowspan="2"><strong>Bộ phận</strong> </th>
            <th colspan="2"><strong>Kết quả điểm TB</strong></th>
            <th rowspan="2"><strong>% năng lực</strong></th>
            <th rowspan="2"><strong>Ghi chú</strong></th>
        </tr>
        <tr>
            <th><strong>Điểm Bài đánh giá</strong> </th>
            <th><strong>Điểm Phiếu đánh giá của Trưởng BP</strong></th>
        </tr>
    </thead>
    <tbody>
        @php
            $index = 1;
        @endphp
        @foreach ($tests as $test)
            @php
                $candiate_test = $test->first(function($item){
                    return $item->survey->type == 2;
                });
                $examiner_test = $test->first(function($item){
                    return $item->survey->type == 1;
                });   
            @endphp

            @if ($candiate_test)
                @php
                    $candiate_score = $candiate_test ? $candiate_test->totalScore() : 0;
                    $examiner_score = $examiner_test ? $examiner_test->totalScore() : 0;

                    $survey = $candiate_test->survey;
                    $candiate_multiplier = $candiate_test->multiplier;
                    $candiate_max_score = $survey->getQuestions()->count();

                    $examiner_survey = $examiner_test->survey;
                    $examiner_multiplier = $examiner_test->multiplier;
                    $examiner_max_score = $examiner_survey->getQuestions()->count() * 3;

                    $candiate_percent = $candiate_score / $candiate_max_score * 100;
                    $examiner_percent = $examiner_score / $examiner_max_score * 100;

                    $score_by_percent = ($candiate_percent * $candiate_multiplier + $examiner_percent * $examiner_multiplier)
                                    / ($candiate_multiplier +  $examiner_multiplier);

                @endphp

                <tr>
                    <th>{{$index}}</th>
                    <th><strong>{{$candiate_test->candiate->fullname ?? ''}}</strong></th>
                    <th><strong>{{$candiate_test->candiate->department->department_name ?? ''}}</strong></th>
                    <th><strong>{{$candiate_score ?? 0}}</strong></th>
                    <th><strong>{{$examiner_score ?? 0}}</strong></th>
                    <th><strong>{{round($score_by_percent, 2) }}%</strong></th>
                </tr>

                @foreach ($candiate_test->survey->section as $index => $section)
                    @php
                        $question_list = $section->questions ?  $section->questions->pluck('id')->toArray() : []; 
                        $answers = $candiate_test->answer;
                        $section_candiate_score = $answers->reduce(function($total, $item) use($question_list){

                            if (in_array($item->question_id, $question_list)){
                                $score = $item->selected_option->score ?? 0;
                            }else{
                                $score = 0;
                            }

                            return $total + $score ;
                        }, 0);

                        $section_examiner_score = 0;

                        if($examiner_test){
                            $questions = $examiner_test->survey->getQuestions();
                            $section_question = $questions[$index];

                            $examiner_test->answer->each(function($item, $key) use($section_question, &$section_examiner_score){
                                if($item->question_id === $section_question->id){
                                    $section_examiner_score = $item->selected_option->score ?? 0;
                                }
                            });
                        }

                        $section_candiate_percent = $section_candiate_score / (count($question_list)) * 100;
                        $section_examiner_score_percent = $section_examiner_score / (3) * 100;
                        $section_score_by_percent = ($section_candiate_percent * $candiate_multiplier + $section_examiner_score_percent * $examiner_multiplier)
                                                    / ($candiate_multiplier +  $examiner_multiplier);

                    @endphp
                    <tr>
                    <th></th>
                    <th>{{$section->title}}</th>
                    <th></th>
                    <th>{{$section_candiate_score}}</th>
                    <th>{{$section_examiner_score}}</th>
                    <th>{{round($section_score_by_percent , 2) }}%</th>    
                    </tr>
                @endforeach    
            @endif
            
            @php
                $index++;
            @endphp
        @endforeach
    </tbody>
</table> 