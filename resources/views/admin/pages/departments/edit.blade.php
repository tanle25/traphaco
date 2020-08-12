@extends('admin.main_layout')
@php
    $list_root = $departments->filter(function ($value) {
        return $value->parent_id == null;
    });
@endphp
@section('title')
  Quản lý phòng ban
@endsection

@section('custom-css')
  <link rel="stylesheet" href="{{asset('template/css/nestable.min.css')}}">
@endsection

@section('content')
  @include('admin.partials.content_header', ['title' => 'Quản lý phòng ban'])
  <div class="row">
    <section class="col-lg-4 col-12">
      <div class="card">

        <div class="card-header">
          <div class="card-title">
            Cập nhật phòng ban
          </div>

        </div>

        <div class="card-body">
          <form action="{{route('admin.department.update', $current_department->id )}}" method="post">
            @csrf
            <div class="form-group">
              <label for="department_name_input">Tên phòng ban</label>
                <input name="department_name" type="text" value="{{$current_department->department_name}}" class="form-control" id="department_name_input" placeholder="Nhập tên phòng ban">
              @error('department_name')
                  <strong class="text-red">
                    {{$message}}
                  </strong>
              @enderror
            </div>


            <div class="form-group">
              <label for="department_name_input">Người quản lý</label>
              <select name="manager_id" class="form-control select2"">
                @foreach ($users as $user )
                  <option value="{{$user->id}}" {{$user->id == $current_department->manager_id ? 'selected' : ''}} >{{$user->fullname}}</option>
                @endforeach
              </select>
              @error('manager_id')
                  <strong class="text-red">
                    {{$message}}
                  </strong>
              @enderror
            </div>

            <button class="btn btn-traphaco" style="background">
              Lưu thông tin
            </button>
            <a href="{{route('admin.department.index')}}" class="float-right btn btn-traphaco">Tạo mới</a>
          </form>
          
        </div>
      </div>
    </section>
    <!-- ./col -->
    <section class="col-lg-8 col-12">
      <div class="card">

        <div class="card-header">
          <div class="card-title">
            Bố trí nhân sự
          </div>

        </div>

        <div class="card-body">

          <ul class="todo-list" data-widget="todo-list">
            @foreach ($user_positions as $user_position)
            <li>
              <!-- drag handle -->
              <span class="handle">
                <i class="fas fa-ellipsis-v"></i>
                <i class="fas fa-ellipsis-v"></i>
              </span>
              <!-- todo text -->
              <span class="text">{{$user_position->name}}</span>
              <!-- Emphasis label -->
              <small class="badge badge-danger">Level {{$user_position->level}}</small>
              <!-- General tools such as edit or delete-->
              <div class="tools">
                <i class="fas fa-edit" data-toggle="modal" data-name="{{$user_position->name}}" data-level=" {{$user_position->level}}"  data-id="{{$user_position->id}}" data-target="#editItemModel"></i>
                <i class="fas fa-trash" onclick="deleteItem({{$user_position->id}})"></i>
              </div>
            </li>
            @endforeach
            

          </ul>
          {{-- <div id="department-list" class="dd">
            @include('admin.pages.departments.department_tree_child', ['list' => $list_root])
          </div> --}}

        </div>
        <div class="card-footer clearfix">
          <button data-toggle="modal" data-target="#addItemModel" type="button" class="btn btn-info float-right"><i class="fas fa-plus"></i> Thêm chức vụ</button>
        </div>

        <div class="modal fade" id="addItemModel" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Thêm vị trí mới</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <form action="{{route('admin.user_position.store')}}" method="post">
                @csrf
                <div class="modal-body">
                  <input type="hidden" name="department_id" value="{{$current_department->id}}">

                  <div class="form-group">
                    <label for="user-position-name">Tên chức vụ</label>
                    <input name="name" type="text" class="form-control" id="user-postion-name" placeholder="Nhập tên chức vụ">
                    @error('name')
                        <strong class="text-red">
                          {{$message}}
                        </strong>
                    @enderror
                  </div>

                  <div class="form-group">
                    <label for="user-position-name">Level</label>
                    <input name="level" type="text" class="form-control" id="user-postion-name" placeholder="Nhập level (So với tổng giám đốc)">
                    @error('level')
                        <strong class="text-red">
                          {{$message}}
                        </strong>
                    @enderror
                  </div>

                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fas fa-times"></i> Close</button>
                  <button type="submit" class="btn btn-success"><i class="fas fa-plus-circle"></i> Thêm mới</button>
                </div>
              </form>
            </div>
          </div>
        </div>

        <div class="modal fade" id="editItemModel" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Sửa vị trí</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <form action="{{route('admin.user_position.update')}}" method="post">
                @csrf
                <div class="modal-body">
                  <input type="hidden" name="department_id" value="{{$current_department->id}}">
                  <input type="hidden" name="user_position_id" id="user-position-id-update">
                  <div class="form-group">
                    <label for="user-position-name-update">Tên chức vụ</label>
                    <input name="name_update" type="text" class="form-control" id="user-position-name-update" value="" placeholder="Nhập tên chức vụ">
                    @error('name_update')
                        <strong class="text-red">
                          {{$message}}
                        </strong>
                    @enderror
                  </div>

                  <div class="form-group">
                    <label for="user-position-level-update">Level</label>
                    <input name="level_update" type="text" class="form-control" id="user-position-level-update" placeholder="Nhập level (So với tổng giám đốc)">
                    @error('level_update')
                        <strong class="text-red">
                          {{$message}}
                        </strong>
                    @enderror
                  </div>
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
                  <button type="submit" class="btn btn-traphaco">Cập nhật</button>
                </div>
              </form>
            </div>
          </div>
        </div>


      </div>
    </section>
    <!-- ./col -->
</div>

@endsection 

@section('custom-js')
<script src="{{asset('template/js/nestable.js')}}"></script>

<script>
    //Initialize Select2 Elements
$('.select2').select2();
</script>

<script>
const MenuToast = Swal.mixin({
	toast: true,
	position: 'bottom-end',
	showConfirmButton: false,
	timer: 3000
});
$(document).on("click", ".todo-list .tools .fa-edit", function () {
     var userPositionId = $(this).data('id');
     var userPositionName = $(this).data('name');
     var userPositionLevel = $(this).data('level');

     $("#user-position-name-update").val( userPositionName );
     $("#user-position-level-update").val( userPositionLevel );
     $("#user-position-id-update").val( userPositionId );
});
  
function deleteUserPosition(id) {

		$.ajaxSetup({
			headers: {
				'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
			},
		});

        $.ajax({
            type: 'post',
            url: "{{route('admin.user_position.destroy')}}",
            data: {
                id:id,
            },
        }).done(function (result) {
            MenuToast.fire({
                icon: 'success',
                type: 'success',
                title: result.message
            });
            if(result.error){
              MenuToast.fire({
                  type: 'error',
                  title: result.error
              })
            }
			setTimeout(function () {
				location.reload();
			}, 500)
        })
    }


function deleteItem(id) {
	Swal.fire({
		title: 'Are you sure?',
		text: "You won't be able to revert this!",
		icon: 'warning',
		showCancelButton: true,
		confirmButtonColor: '#3085d6',
		cancelButtonColor: '#d33',
		confirmButtonText: 'Yes, delete it!'
	})
	.then((result) => {
		if (result.value) {
			deleteUserPosition(id);

		}
	})
}



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

@endsection

