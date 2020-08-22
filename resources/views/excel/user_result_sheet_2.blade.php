
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
            <th>BM 01</th>
        </tr>
        <tr></tr>
        <tr>
            <th colspan="8"><strong>BẢNG TỔNG HỢP KẾT QUẢ ĐÁNH GIÁ CBQL</strong></th>
        </tr>
        <tr>
            <th colspan="8">Ngày tổng hợp báo cáo {{Carbon\Carbon::now()->format('d/m/Y')}}</th>
        </tr>
        <tr></tr>
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
        <td>{{$index + 1}}</td>
        <td>{{$candiate->fullname}}</td>
        <td>{{$survey->getScoreFromLevel($survey_round->id, $candiate->id, 3)}}</td>
        <td>{{$survey->getScoreFromLevel($survey_round->id, $candiate->id, 2)}}</td>
        <td>{{$survey->getScoreFromLevel($survey_round->id, $candiate->id, 1)}}</td>
        <td><strong>{{$survey->getAvgScore($survey_round->id, $candiate->id)}}</strong></td>
        <td><strong>{{$survey->getScoreByPercent($survey_round->id, $candiate->id)}}%</strong></td>
        <td>

        </td>
      </tr>
      @endforeach
    </tbody>
</table> 