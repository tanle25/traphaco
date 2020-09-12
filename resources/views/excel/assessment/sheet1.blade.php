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

        @foreach ($tests as $index => $item)
            <tr>
                @php
                    $candiate = $item->first()->candiate;
                    $survey = $item->filter(function($item){
                        return $item->survey->type == 1;
                    })->first()->survey;
                @endphp

                <td>{{$index + 1}}</td>
                <td>{{$candiate->fullname}}</td>
                <td>{{$candiate->department->department_name}}</td>
                <td>{{$survey->section->count()}}</td>
                <td>
                    {{$item->filter(function($item){
                            return $item->survey->type == 2;
                        })->first()
                        ->totalScore()
                    }}
                </td>
                <td>
                    {{$item->filter(function($item){
                            return $item->survey->type == 1;
                        })->first()
                        ->totalScore()
                    }}
                </td>

            </tr>
        @endforeach
    </tbody>
</table> 