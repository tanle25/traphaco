<div class="card">
    <div class="card-header">
        <div>
            <div class="mb-3">
                <h5><strong>Thời gian làm bài đánh giá</strong></h5>
            </div>
            <form method="post" action="{{route('admin.survey_round.update_time')}}">
                @csrf
                <input type="hidden" name="survey_round_id" value="{{$survey_round->id}}">

                @foreach ($survey_round->getSurveyListAndTime() as $index => $survey)
                    <div class="row pt-2">
                        <div class="col-md-6"> <strong> {{$survey->name}}</strong></div>
                        <div class="col-md-6 row" style="align-items: center">
                            <input type="hidden" name="time[{{$index}}][survey]" value="{{$survey->id}}">
                            <div class="form-group row col-md-6 col-12">
                                <label for="staticEmail" class="col-form-label col-12 col-lg-2">Từ:</label>
                                <div class="col-12 col-lg-9">
                                    <input @if(!Auth::user()->can('sửa đợt đánh giá')) readonly @endif  style="border:none" id="date-picker" class="date-picker form-control" type="text" name="time[{{$index}}][start_at]" value="{{Carbon\Carbon::parse( $survey->start_at)->format('d/m/Y H:i') ?? '01/01/2000 10:00'}}"> 
                                </div>
                            </div>

                            <div class="form-group row col-md-6 col-12">
                                <label for="staticEmail" class="col-12 col-lg-2 col-form-label">đến:</label>
                                <div class="col-12 col-lg-9" >
                                    <input @if(!Auth::user()->can('sửa đợt đánh giá')) readonly @endif  style="border:none" class="date-picker form-control" type="text" name="time[{{$index}}][end_at]" value="{{ Carbon\Carbon::parse( $survey->end_at)->format('d/m/Y H:i') ?? '01/01/2100 10:00'}}">
                                </div>
                            </div>
                        </div> 
                    </div>
                @endforeach
                @if (Auth::user()->can('sửa đợt đánh giá'))
                    <button type="submit" class="btn btn-success">Cập nhật thời gian làm bài</button>
                @endif
                @if (Auth::user()->can('sửa bài đánh giá'))
                    <a class="btn btn-success" href="{{route('admin.survey_round.stop', $survey_round->id)}}">Thu bài đánh giá</a>
                @endif
            </form>  
        </div>
    </div>
    <div class="card-body">
        <table id="tests-table" class="table table-bordered table-hover">
            <thead>
            <tr>
                    <th>ID</th>
                    <th>Bộ đề</th>
                    <th>Người được chấm</th>
                    <th>Người chấm</th> {{--Chưa gửi, đã gửi--}}
                    <th>Trọng số</th>
                    <th>Trạng thái</th>
                    <th>Thao tác</th>
            </tr>
            </thead>

        </table>
        @if (Auth::user()->can('gửi bài đánh giá'))
        <a class="btn btn-success" href="{{route('admin.test.send_all', $survey_round->id)}}">Gửi tất cả</a>
        @endif

    </div>
</div>
@section('custom-js')
@parent
<script>
  $(function() {
    $("#tests-table").dataTable({
		processing: true,
		serverSide: true,
		autoWidth:false,
        scrollX:true,
		ajax: {
			url: "{{route('admin.test.get_list')}}",
			data: {
				survey_round_id: {{$survey_round->id}}
			}
      	},
      	columns: [
            { "data": "DT_RowIndex","name": 'DT_Row_Index' , "orderable": false, "searchable": false},
			{ "data": "survey_name", "name": "survey_name" },
			{ "data": "candiate", "name": "candiate" },
			{ "data" :"examiner", "name": "examiner"},
            { "data": "multiplier", "name":"multiplier" },
            { "data": "status", "name": "status" },
			{ "data" : "action", "name": "action"}
      	]
    });
  })

$('.date-picker').each(function(){
    $(this).daterangepicker({
        singleDatePicker: true,
        timePicker24Hour: true,
        locale: {
            "format": 'DD/MM/YYYY HH:mm',
            "applyLabel": "Ok",
            "cancelLabel": "Thoát",
            "fromLabel": "Từ",
            "toLabel": "Đến",
            "customRangeLabel": "Custom",
            "daysOfWeek": [
                "CN",
                "T2",
                "T3",
                "T4",
                "T5",
                "T6",
                "T7"
            ],
            "monthNames": [
                "Tháng 1",
                "Tháng 2",
                "Tháng 3",
                "Tháng 4",
                "Tháng 5",
                "Tháng 6",
                "Tháng 7",
                "Tháng 8",
                "Tháng 9",
                "Tháng 10",
                "Tháng 11",
                "Tháng 12"
            ],
        },
        timePicker: true,
    })
}) 

</script>
@endsection
