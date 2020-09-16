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
            <th ><strong>TT</strong> </th>
            <th ><strong>Họ và tên</strong> </th>
            <th ><strong>Bộ phận</strong> </th>
            <th ><strong>Số năng lực</strong></th>
            <th ><strong>Tổng điểm bài đánh giá</strong></th>
            <th ><strong>Tổng điểm Phiếu đánh giá của Trưởng BP</strong></th>
            <th ><strong>% năng lực</strong></th>
        </tr>
    </thead>
    <tbody>
        @php
            $index = 1;
        @endphp
        @foreach ($tests as $item)
            @php
                $candiate = $item->first()->candiate;
                //Lấy bài test đầu tiên thuộc loại 2 (bài thi chất lượng)
                $candiate_test = $item->filter(function($item){
                    return $item->survey->type == 2;
                })->first();
                //Lấy bài test đầu tiên thuộc loại 1 (bài đánh giá của cấp trên)
                $examiner_test = $item->filter(function($item){
                    return $item->survey->type == 1;
                })->first();
            @endphp

            @if ($candiate_test)
                @php
                    $survey = $candiate_test->survey;
                @endphp
                <tr>
                    <td>{{$index}}</td>
                    <td>{{$candiate->fullname}}</td>
                    <td>{{$candiate->department->department_name}}</td>
                    <td>{{$survey->section->count()}}</td>
                    <td>
                        {{ $candiate_test ? $candiate_test->totalScore() : 0}}
                    </td>
                    <td>
                        {{ $examiner_test ? $examiner_test->totalScore() : 0}}
                    </td>
                </tr>    
            @endif
        @php
            $index += 1;
        @endphp
        @endforeach
    </tbody>
</table> 