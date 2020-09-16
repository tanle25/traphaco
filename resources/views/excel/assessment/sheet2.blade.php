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
                return $item->survey->type == 1;
            });
            $examiner_test = $test->first(function($item){
                return $item->survey->type == 2;
            });  
            $candiate_score = $candiate_test->totalScore() ?? 0;
            $examiner_score = $examiner_test->totalScore() ?? 0;
        @endphp
        <tr>
            <th>{{$index}}</th>
            <th><strong>{{$candiate_test->candiate->fullname}}</strong></th>
            <th><strong>{{$candiate_test->candiate->department->department_name}}</strong></th>
            <th><strong>{{$candiate_score ?? 0}}</strong></th>
            <th><strong>{{$examiner_score ?? 0}}</strong></th>
            @php
                $score_by_percent = ($candiate_score * 2 + $examiner_score*2)/(3*6)*100;
            @endphp

            <th><strong>{{round( $score_by_percent, 2) }}</strong></th>
        </tr>
        @foreach ($candiate_test->survey->section as $section)
            @php
                $question_list = $section->question ?  $section->question->pluck('id')->toArray() : [];
                $section_candiate_score = $candiate_test->answer->reduce(function($total, $item) use($question_list){
                    if (in_array($item->question_id, $question_list)){
                        return $total += $item->selected_option->score;
                    }
                }, 0) ?? 0;
                $section_examiner_score = $examiner_test->answer->reduce(function($total, $item) use($question_list){
                    if (in_array($item->question_id, $question_list)){
                        return $total += $item->selected_option->score;
                    }
                }, 0) ?? 0 ;
            @endphp
            <tr>
            <th></th>
            <th>{{$section->title}}</th>
            <th></th>
            <th>{{$section_candiate_score}}</th>
            <th>{{$section_examiner_score}}</th>
            @php
                $score_by_percent = ($section_candiate_score * 2 + $section_examiner_score*2) / (3*6)*100;
            @endphp
            <th>{{round($score_by_percent , 2) }}</th>    
            </tr>
        @endforeach

        @php
            $index++;
        @endphp
        @endforeach
    </tbody>
</table> 