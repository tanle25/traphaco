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
            Tạo mới phòng ban
          </div>

        </div>

        <div class="card-body">
          <form action="{{route('admin.department.store')}}" method="post">
            @csrf
            <div class="form-group">
              <label for="department_name_input">Tên phòng ban</label>
              <input name="department_name" type="text" class="form-control" id="department_name_input" placeholder="Nhập tên phòng ban">
              @error('department_name')
                  <strong class="text-red">
                    {{$message}}
                  </strong>
              @enderror
            </div>

            <div class="form-group">
              <label>Phòng ban trực thuộc</label>
              <select name="parent_id" class="form-control select2"">
                <option value="" selected="selected">--ROOT--</option>
                @foreach ($departments as $department )
                  <option value="{{$department->id}}">{{$department->department_name}}</option>
                @endforeach
              </select>
              @error('parent_id')
                  <strong class="text-red">
                    {{$message}}
                  </strong>
              @enderror
            </div>

            <div class="form-group">
              <label for="department_name_input">Người quản lý</label>
              <select name="manager_id" class="form-control select2"">
                <option value="">Trống</option>
                @foreach ($users as $user )
                  <option value="{{$user->id}}">{{$user->fullname}}</option>
                @endforeach
              </select>
              @error('manage_id')
                  <strong class="text-red">
                    {{$message}}
                  </strong>
              @enderror
            </div>

            <div class="form-group">
              <label for="department_name_input">Thứ tự</label>
              <input name="sort" type="number" class="form-control" placeholder="Số thứ tự">
            </div>

            <button class="btn btn-primary">
              Lưu thông tin
            </button>
          </form>
        </div>
      </div>
    </section>
    <!-- ./col -->
    <section class="col-lg-8 col-12">
      <div class="card">

        <div class="card-header">
          <div class="card-title">
            Danh sách phòng ban
          </div>
        </div>

        <div class="card-body">
          <div id="department-list" class="dd">
            @include('admin.pages.departments.department_tree_child', ['list' => $list_root])
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
    const MenuToast = Swal.mixin({
        toast: true,
        position: 'bottom-end',
        showConfirmButton: false,
        timer: 3000
    });

    $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
        });

    function saveTree(data){
        $.ajax({
            type: 'post',
            url: "{{route('admin.department.savetree')}}",
            data: {
                jsonData:data,
            },
        }).done(function (result) {
            MenuToast.fire({
                icon: 'success',
                type: 'success',
                title: 'Cập nhật phòng ban thành công'
            })
        })
    }

    function deleteDepartment(id) {
        $.ajax({
            type: 'post',
            url: "{{route('admin.department.destroy')}}",
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
        })
    }

    
    $('#department-list').nestable();
    $('.dd').on('change', function() {
        var data = $('.dd').nestable('serialize');
        saveTree(data);
    });
    //Initialize Select2 Elements
    $('.select2').select2();

    $('.dd-item .remove-department').on('click', function(){
      let id = $(this).attr('data-id');
      Swal.fire({
			title: 'Are you sure?',
			text: "You won't be able to revert this!",
			icon: 'warning',
			showCancelButton: true,
			confirmButtonColor: '#3085d6',
			cancelButtonColor: '#d33',
			confirmButtonText: 'Yes, delete it!',
      })
      .then((result) => {
        if (result.value) {
          $(this).parent().parent().parent().remove();
          deleteDepartment(id);
        }
      })
    })
</script>



@endsection