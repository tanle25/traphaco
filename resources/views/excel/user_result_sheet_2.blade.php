<table id="user-result-table" class="table table-bordered table-hover">
    <thead>
        <tr>
            <th></th>
            <th></th>
            <th></th>
            <th></th>
            <th></th>
            <th></th>
            <th></th>
            <th>BM 02</th>
        </tr>
        <tr></tr>
        <tr>
            <th colspan="8"><strong>BẢNG TỔNG HỢP KẾT QUẢ ĐÁNH GIÁ CBQL</strong></th>
        </tr>
        <tr>
            <th colspan="8">Ngày tổng hợp báo cáo {{Carbon\Carbon::now()->format('d/m/Y')}}</th>
        </tr>
        <tr>
            <th></th>
            <th colspan="7">
                Đợt đánh giá: {{$survey_round->name}} <br>
                Bài đánh giá: {{$survey->name}}
            </th>
        </tr>
        <tr></tr>
        <tr>
            <th rowspan="2"><strong>TT</strong> </th>
            <th rowspan="2"><strong>Người được khảo sát</strong> </th>
            <th colspan="4"><strong>Kết quả điểm TB</strong> </th>
            <th rowspan="2"><strong>% năng lực</strong></th>
            <th rowspan="2"><strong>Ghi chú</strong></th>
        </tr>
        <tr>
            <th><strong>Trọng số 3</strong></th>
            <th><strong>Trọng số 2</strong></th>
            <th><strong>Trọng số 1</strong></th>
            <th><strong>Bình quân chung</strong></th>
        </tr>
    </thead>
    <tbody>
    @foreach ($list_candiate as $index => $candiate)
    <tr>
    <td><strong> {{$index + 1}}</strong> </td>
    <td><strong>{{$candiate->fullname}}</strong></td>
    <td><strong>{{$survey->getScoreFromLevel($survey_round->id, $candiate->id, 3)}}</strong></td>
    <td><strong>{{$survey->getScoreFromLevel($survey_round->id, $candiate->id, 2)}}</strong></td>
    <td><strong>{{$survey->getScoreFromLevel($survey_round->id, $candiate->id, 1)}}</strong></td>
    <td><strong>{{$survey->getAvgScore($survey_round->id, $candiate->id)}}</strong></td>
    <td><strong>{{$survey->getScoreByPercent($survey_round->id, $candiate->id)}}%</strong></td>
    <td>
    </td>
    </tr>
    @foreach ($survey->getQuestions() as $index => $question)
    <tr>
        <td>{{$index+1}}</td>
        <td>{{$question->content ?? ''}}</td>
        <td>{{$question->getScoreFromLevel($survey_round->id, $candiate->id, 3)}}</td>
        <td>{{$question->getScoreFromLevel($survey_round->id, $candiate->id, 2)}}</td>
        <td>{{$question->getScoreFromLevel($survey_round->id, $candiate->id, 1)}}</td>
        <td>{{$question->getAvgScore($survey_round->id, $candiate->id)}}</td>
        <td>{{$question->getScoreByPercent($survey_round->id, $candiate->id)}}</td>
      </tr>
    @endforeach
    @endforeach
    </tbody>
</table> 