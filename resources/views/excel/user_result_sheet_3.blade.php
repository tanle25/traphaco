@php
    $questions = $survey->getQuestions();
@endphp
<table>
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
            <th colspan="{{$questions->count() + 4}}"><strong>BẢNG TỔNG HỢP KẾT QUẢ ĐÁNH GIÁ CBQL</strong></th>
        </tr>
        <tr>
            <th colspan="{{$questions->count() + 4}}">Ngày tổng hợp báo cáo {{Carbon\Carbon::now()->format('d/m/Y')}}</th>
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
            <th ><strong>TT</strong> </th>
            <th ><strong>Họ tên người được đánh giá</strong> </th>
            @foreach ($questions as $question)
            <th>
                {{$question->content}}
            </th>
            @endforeach
            <th><strong>Kết quả điểm trung bình</strong></th>
            <th><strong>% năng lực</strong></th>
        </tr>
    </thead>
    
    <tbody>
        @foreach ($list_candiate as $index => $candiate)
        <tr>
           <td><strong>{{$index + 1}}</strong></td>       
           <td><strong>{{$candiate->fullname}}</strong></td>     
           @foreach ($questions as $question)
           <td>
            {{$question->getAvgScore($survey_round->id, $candiate->id)}}
           </td>
           @endforeach
           <td>
               <strong>
                    {{$survey->getAvgScore($survey_round->id, $candiate->id)}}
                </strong>
            </td>
            <td>
                <strong>
                    {{$survey->getScoreByPercent($survey_round->id, $candiate->id)}}%
                </strong>
            </td>
        </tr>   
        @endforeach
    </tbody>
</table>