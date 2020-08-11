<table>
    <thead>
    <tr>
        <th></th>
        <th></th>
    </tr>
    <tr>
        <th></th>
        <th></th>
    </tr>
    
    <tr>
        <th>BẢNG TỔNG HỢP KẾT QUẢ ĐÁNH GIÁ CBQL</th>
    </tr>
    <tr>
        <th>Ngày tổng hợp báo cáo {{Carbon\Carbon::now()}}</th>
    </tr>
    <tr>
        <th>Họ tên người được đánh giá:{{$candiate->fullname}}</th>
        <th></th>
        <th></th>
        <th>Vị trí công việc: {{$candiate->position->name ?? ''}}-{{$candiate->department->department_name ?? ''}}</th>
    </tr>

    <tr>
        <th>TT</th>
        <th>Nội dung</th>
        <th>Kết quả điểm TB</th>
        <th></th>
        <th></th>
        <th></th>
        <th>%năng lực</th>
    </tr>
    <tr>
        <th></th>
        <th></th>
        <th>Cấp trên đánh giá</th>
        <th>Ngang cấp đánh giá</th>
        <th>Cấp dưới đánh giá</th>
        <th>Bình quân chung</th>
        <th></th>
    </tr>
    </thead>
    <tbody>
        <tr>
            <th></th>
            <th>Điểm TB</th>
            <th>{{$survey->getScoreFromLevel($survey_round, $candiate_id, 3)}}</th>
            <th>{{$survey->getScoreFromLevel($survey_round, $candiate_id, 2)}}</th>
            <th>{{$survey->getScoreFromLevel($survey_round, $candiate_id, 1)}}</th>
            <th>{{$survey->getAvgScore($survey_round, $candiate_id)}}</th>
            <th>{{$survey->getScoreByPercent($survey_round, $candiate_id)}}</th>
          </tr>

          @foreach ($survey->section as $index => $section)
            <tr>
                <th></th>
                <th>{{$section->title ?? ''}}</th>
                <th>{{$section->getScoreFromLevel($survey_round, $candiate_id, 3)}}</th>
                <th>{{$section->getScoreFromLevel($survey_round, $candiate_id, 2)}}</th>
                <th>{{$section->getScoreFromLevel($survey_round, $candiate_id, 1)}}</th>
                <th>{{$section->getAvgScore($survey_round, $candiate_id)}}</th>
                <th>{{$section->getScoreByPercent($survey_round, $candiate_id)}}</th>
            </tr>
            @foreach ($section->questions as $index => $question)
                <tr>
                    <td>{{$index+1}}</td>
                    <td>{{$question->content ?? ''}}</td>
                    <td>{{$question->getScoreFromLevel($survey_round, $candiate_id, 3)}}</td>
                    <td>{{$question->getScoreFromLevel($survey_round, $candiate_id, 2)}}</td>
                    <td>{{$question->getScoreFromLevel($survey_round, $candiate_id, 1)}}</td>
                    <td>{{$question->getAvgScore($survey_round, $candiate_id)}}</td>
                    <td>{{$question->getScoreByPercent($survey_round, $candiate_id)}}</td>
                </tr>
            @endforeach
          @endforeach
    </tbody>
</table>