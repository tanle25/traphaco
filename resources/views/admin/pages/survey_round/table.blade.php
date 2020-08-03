<ul class="nav nav-tabs" id="myTab" role="tablist">
    <li class="nav-item">
      <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">Bài khảo sát</a>
    </li>
    <li class="nav-item">
      <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">Bài đánh giá năng lực</a>
    </li>

</ul>
<div class="tab-content" id="myTabContent">
    <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
        <form action="{{route('admin.test.store')}}" class="row mb-3" method="post">
            @csrf
            <input type="hidden" name="survey_round_id" value="{{$survey_round->id}}">
            <input type="hidden" name="test_type" value="1">
            <div class="form-group col-md-4">
                <label>Chọn bài khảo sát</label>
                <select name="survey_id[]" multiple="multiple" class="form-control select2" id="survey-select">
                    @foreach ($survey as $item )
                        @if ($item->type == 1)
                        <option value="{{$item->id}}">{{$item->name}}</option>
                        @endif
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
        
    </div>
    <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
        <form action="{{route('admin.test.store2')}}" class="row mb-3" method="post">
            @csrf
            <input type="hidden" name="survey_round_id" value="{{$survey_round->id}}">
            <input type="hidden" name="test_type" value="2">

            <div class="form-group col-md-4">
                <label>Chọn bài đánh giá</label>
                <select name="survey_id[]" multiple="multiple" class="form-control select2" id="survey-select2">
                    @foreach ($survey as $item )
                        @if ($item->type == 2)
                        <option value="{{$item->id}}">{{$item->name}}</option>
                        @endif
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
                <select name="candiate_id[]" multiple="multiple" class="form-control select2" id="candiate-select2">
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

            <div class="form-group col-12">
                <button type="submit" class="btn btn-primary">Thêm bài test</button>
            </div>
        </form>   
    </div>
</div>


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
