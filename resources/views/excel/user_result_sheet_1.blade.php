
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
        
        @foreach ($result as $index => $candiate_score)
        <tr>
            <td>{{$index + 1}}</td>
            <td>{{ $candiate_score['candiate_name']}}</td>
            <td>{{$candiate_score['score_from_level_3']}}</td>
            <td>{{$candiate_score['score_from_level_2']}}</td>
            <td>{{$candiate_score['score_from_level_1']}}</td>
            <td><strong>{{$candiate_score['avg_score']}}</strong></td>
            <td><strong>{{$candiate_score['percent']}}%</strong></td>
            <td>
            </td>
        </tr>

        @endforeach

    </tbody>
</table> 

