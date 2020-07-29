<form action="{{route('admin.test.store')}}" class="row mb-3" method="post">
    @csrf
    <input type="hidden" name="survey_round_id" value="{{$survey_round->id}}">
    <div class="form-group col-md-4">
        <label>Chọn bài khảo sát</label>
        <select name="survey_id" class="form-control select2" id="survey-select">
            @foreach ($survey as $item )
            <option value="{{$item->id}}">{{$item->name}}</option>
            @endforeach
        </select>
        @error('survey_id')
        <strong class="text-red">
            {{$message}}
        </strong>
        @enderror
    </div>    
    
    <div class="form-group col-md-4">
        <label>Chọn người được chấm</label>
        <select name="candiate_id[]" multiple="multiple" class="form-control select2" id="candiate-select">
            @foreach ($users as $user )
            <option value="{{$user->id}}">{{$user->fullname ?? ''}} {{$user->department ? "| ". $user->department->department_name : '' }} {{  $user->position ? ' - '. $user->position->name . "" : ' ' }} </option>
            @endforeach
        </select>
        @error('candiate_id')
        <strong class="text-red">
            {{$message}}
        </strong>
        @enderror
    </div>

    <div class="form-group col-md-4">
        <label>Chọn người chấm</label>
        <select name="examiner_id[]" multiple="multiple" class="form-control select2" id="examiner-select">
            @foreach ($users as $user )
            <option value="{{$user->id}}">{{$user->fullname ?? ''}} {{$user->department ? "| ". $user->department->department_name : '' }} {{  $user->position ? ' - '. $user->position->name . "" : ' ' }} </option>
            @endforeach
        </select>
        @error('examiner_id')
        <strong class="text-red">
            {{$message}}
        </strong>
        @enderror
    </div>
    <div class="form-group col-md-4">
        <button type="submit" class="btn btn-primary">Thêm bài test</button>
    </div>
</form>

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

<a class="btn btn-success" href="{{route('admin.test.send_all', $survey_round->id)}}">Gửi tất cả</a>
@section('custom-js')
@parent
<script>
  $(function() {
    $("#tests-table").dataTable({
		processing: true,
		serverSide: true,
		autoWidth:false,
		ajax: {
			url: "{{route('admin.test.get_list')}}",
			data: {
				survey_round_id: {{$survey_round->id}}
			}
      	},
      	columns: [
			{ "data": "id", "name": "id"  },
			{ "data": "survey_name", "name": "survey_name" },
			{ "data": "candiate", "name": "candiate" },
			{ "data" :"examiner", "name": "examiner"},
            { "data": "multiplier", "name":"multiplier" },
            { "data": "status", "name": "status" },
			{ "data" : "action", "name": "action"}
      	]
    });
  })
</script>
@endsection
