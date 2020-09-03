@extends('admin.main_layout')
@section('title')
  Quản lý đợt khảo sát
@endsection

@section('custom-css')
<link rel="stylesheet" href="{{asset('template/AdminLTE/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css')}}">
<link rel="stylesheet" href="{{asset('template/AdminLTE/plugins/datatables-responsive/css/responsive.bootstrap4.min.css')}}">
<link rel="stylesheet" href="{{asset('template/css/multiple-select.min.css')}}">
@endsection

@section('content')
@include('admin.partials.content_header', ['title' => 'Quản lý đợt khảo sát'])



<div class="row">
    <section class="col-12">

        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Thông tin đợt khảo sát</h3>
                <a class="btn btn-success d-block float-right" href="{{route('admin.survey_round.index')}}">Back</a>

          </div>
        <form action="{{route('admin.survey_round.update', $survey_round->id)}}" class="row card-body" method="post">
          @csrf
          <div class="col-md-6 col-12">
            <div class="form-group">
              <label for="">Tên đợt khảo sát</label>
              <input name="name" type="text" class="form-control" id=""
                placeholder="Nhập đợt khảo sát mới (Bắt buộc)" value="{{  $survey_round->name ?? '' }}">
              @error('name')
              <strong class="text-red">
                {{$message}}
              </strong>
              @enderror
            </div>
          </div>
    
          <div class="col-md-6 col-12">
            <div class="form-group">
              <label for="">Người tạo</label>
              <input name="" type="text" class="form-control" id="" readonly
                placeholder="Nhập password (Bắt buộc)" value="{{Auth::user()->fullname}}">
              <input type="hidden" name="created_by" value="{{Auth::user()->id}}">
            </div>
          </div>
        
          <button type="submit" class="btn btn-traphaco ml-2">Lưu thông tin</button>
        </form>      
        </div>

        <div class="card">
            <div class="card-header">
              <h3 class="card-title">Quản lý bài test</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
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
                                @foreach ($departments as $department)
                                    <option class="department" department-holder="{{$department->id}}">{{$department->department_name}}</option>
                                    @foreach ($department->users as $user)
                                    <option department-holder="{{$department->id}}"  value="{{$user->id}}">{{$user->fullname ?? ''}} {{$user->department ? "| ". $user->department->department_name : '' }} {{  $user->position ? ' - '. $user->position->name . "" : ' ' }} </option>
                                    @endforeach
                                @endforeach
                                <option value="1"  class="department" department-holder="x">Không rõ phòng ban</option>
                                @foreach ($users as $user)
                                    @if ($user->department == null)
                                    <option data-department="1000" department-holder="x"  value="{{$user->id}}">{{$user->fullname ?? ''}} </option>
                                    @endif
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
                                @foreach ($departments as $department)
                                    <option class="department" department-holder="{{$department->id}}">{{$department->department_name}}</option>
                                    @foreach ($department->users as $user)
                                    <option department-holder="{{$department->id}}"  value="{{$user->id}}">{{$user->fullname ?? ''}} {{$user->department ? "| ". $user->department->department_name : '' }} {{  $user->position ? ' - '. $user->position->name . "" : ' ' }} </option>
                                    @endforeach
                                @endforeach
                                <option value="1"  class="department" department-holder="x">Không rõ phòng ban</option>
                                @foreach ($users as $user)
                                    @if ($user->department == null)
                                    <option data-department="1000" department-holder="x"  value="{{$user->id}}">{{$user->fullname ?? ''}} </option>
                                    @endif
                                @endforeach
                            </select>
                            @error('examiner_id')
                            <strong class="text-red">
                                {{$message}}
                            </strong>
                            @enderror
                        </div>
                        <div class="form-group col-md-4">
                            <button type="submit" class="btn btn-traphaco">Thêm bài test</button>
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
                                @foreach ($departments as $department)
                                    <option class="department" department-holder="{{$department->id}}">{{$department->department_name}}</option>
                                    @foreach ($department->users as $user)
                                    <option department-holder="{{$department->id}}"  value="{{$user->id}}">{{$user->fullname ?? ''}} {{$user->department ? "| ". $user->department->department_name : '' }} {{  $user->position ? ' - '. $user->position->name . "" : ' ' }} </option>
                                    @endforeach
                                @endforeach
                                <option value="1"  class="department" department-holder="x">Không rõ phòng ban</option>
                                @foreach ($users as $user)
                                    @if ($user->department == null)
                                    <option data-department="1000" department-holder="x"  value="{{$user->id}}">{{$user->fullname ?? ''}} </option>
                                    @endif
                                @endforeach
                            </select>
                            
                            @error('candiate_id')
                            <strong class="text-red">
                                {{$message}}
                            </strong>
                            @enderror
            
                        </div>
                        <div class="form-group col-12">
                            <button type="submit" class="btn btn-traphaco">Thêm bài test</button>
                        </div>
                    </form>   
                </div>
            </div>
            
            </div>
            <!-- /.card-body -->
        </div>
        @include('admin.pages.survey_round.table')

    </section>
</div>


@endsection 

@section('custom-js')
<script src="{{asset('template/js/nestable.js')}}"></script>
<script src="{{asset('template/AdminLTE/plugins/bootstrap-switch/js/bootstrap-switch.min.js')}}"></script>
<script src="{{asset('template/AdminLTE/plugins/datatables/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('template/AdminLTE/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js')}}"></script>
<script src="{{asset('template/AdminLTE/plugins/datatables-responsive/js/dataTables.responsive.min.js')}}"></script>
<script src="{{asset('template/AdminLTE/plugins/datatables-responsive/js/responsive.bootstrap4.min.js')}}"></script>
<script src="{{asset('template/js/multiple-select.min.js')}}"></script>
<script>
    //Initialize Select2 Elements
$('.select2').select2({
});

$('.select2').on('select2:select', function(e){
//console.log(e.params.data.element.getAttribute('value'));
selectContain = e.target;

if(e.params.data.element.classList.contains('department')){
  el = e.params.data.element;
  departmentId = el.getAttribute('department-holder');
  selectContain.querySelectorAll(`option[department-holder="${departmentId}"]`).forEach(function(item){
    item.selected = true;
  });
  $(".select2").trigger("change");
}



});

$("input[data-bootstrap-switch]").each(function(){
    $(this).bootstrapSwitch('state', $(this).prop('checked'));
});
</script>

<script>
    const MenuToast = Swal.mixin({
        toast: true,
        position: 'bottom-end',
        showConfirmButton: false,
        timer: 3000
    });
</script>

@if ($errors->hasAny(['name', 'department_id', 'level'])) {
<script>
  $('#addItemModel').modal('show')
</script>
@endif

@if ($errors->hasAny(['name_update','level_update'])) {
  <script>
    $('#editItemModel').modal('show')
  </script>
@endif

<script>
	
	$(document).on('blur', '.multipiler-input', function(){
		var url = $(this).attr('href');
		var value = $(this).val();
		$.ajax({
			url: url,
			type: "POST",
			data: {
				value: value,
				_token: $('meta[name="csrf-token"]').attr('content')
			},
			success: function (data) {
				if (data.warning) {
					swalToast(data.warning, 'warning');
				}
				if (data.msg) {
					swalToast(data.msg);
				}
				//location.reload();
			},
			error: function (errors) {
				swalToast(errors.responseJSON.errors.value[0], 'error');
			}
		});
	});

	
	$(document).on('click', '.send-test', function(){
		var url = $(this).attr('href');
		$.ajax({
			url: url,
			type: "POST",
			data: {
				_token: $('meta[name="csrf-token"]').attr('content')
			},
			success: function (data) {
				if (data.warning) {
					swalToast(data.warning, 'warning');
				}
				if (data.msg) {
					swalToast(data.msg);
				}
				location.reload();
			},
			error: function (errors) {
				swalToast('Lỗi không rõ phát sinh trong quá trình gửi', 'error');
			}
		});
	});

    $(document).on('click', '.test-delete', function (e) {
        e.preventDefault();
        var url = $(this).attr('href');
        Swal.fire({
            title: 'Xóa đợt khảo sát này?',
            text: "Bạn không thể hoàn tác!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Vẫn xóa nó!',
        })
            .then((result) => {
                if (result.value) {
                    $.ajax({
                        url: url,
                        type: "POST",
                        data: {
                            _token: $('meta[name="csrf-token"]').attr('content')
                        },
                        success: function (data) {
                            if (data.error) {
                                swalToast(data.error, 'error');
                            }
                            if (data.msg) {
                                swalToast(data.msg);
                            }
                            location.reload();
                        },
                        error: function (errors) {
                            swalToast('Lỗi không rõ phát sinh trong quá trình xóa', 'error');
                        }
                    });
                }
            });
    })

</script>

@endsection

