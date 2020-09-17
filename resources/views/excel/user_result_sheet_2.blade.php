
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
    @foreach ($result as $index => $candiate_test)
        @php
            $total = $candiate_test['total'];
        @endphp
        <tr>
        <td><strong> {{$index + 1}}</strong> </td>
        <td><strong>{{$total['candiate_name']}}</strong></td>
        <td><strong>{{$total['score_from_level_3']}}</strong></td>
        <td><strong>{{$total['score_from_level_2']}}</strong></td>
        <td><strong>{{$total['score_from_level_1']}}</strong></td>
        <td><strong>{{$total['avg_score']}}</strong></td>
        <td><strong>{{$total['percent']}}%</strong></td>
        <td>
        </td>
        </tr>
        @foreach ($candiate_test['details'] as $index => $detail)
        @php
        @endphp
        <tr>
            <td>{{$index + 1}}</td>
            <td>{{$detail['content']}}</td>
            <td>{{$detail['score_from_level_3']}}</td>
            <td>{{$detail['score_from_level_2']}}</td>
            <td>{{$detail['score_from_level_1']}}</td>
            <td>{{$detail['avg_score']}}</td>
            <td>{{$detail['percent']}}</td>
        </tr>
        @endforeach
    @endforeach
    </tbody>
</table> 

