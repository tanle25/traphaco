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
@include('admin.partials.content_header', ['title' => 'Quản lý user'])


<div class="row">
    <section class="col-12">
        <div class="card">
            <div class="card-header">
                <div class="card-title">
                    Chỉnh sửa User
                </div>
            </div>

            <div class="card-body">
                <form action="{{route('admin.usermanage.update', $user->id)}}" method="post">
                    @csrf
                    <input type="hidden" name="old_user" value="{{$user->id}}">

                    <div class="row">
                        <div class="col-md-6 col-12">
                            <div class="form-group">
                                <label for="">Họ và tên</label>
                                <input name="fullname" type="text" class="form-control" id=""
                                    placeholder="Nhập tên người dùng mới (*)" value="{{ $user->fullname }}">
                                @error('fullname')
                                <strong class="text-red">
                                    {{$message}}
                                </strong>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="">Username</label>
                                <input name="username" type="text" class="form-control" id=""
                                    placeholder="Nhập tên đăng nhập (*)" value="{{ $user->username}}">
                                @error('username')
                                <strong class="text-red">
                                    {{$message}}
                                </strong>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="">Email</label>
                                <input name="email" type="text" class="form-control" id="" placeholder="Nhập Email" value="{{ $user->email }}">
                                @error('email')
                                <strong class="text-red">
                                    {{$message}}
                                </strong>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="">Password</label>
                                <input name="password" type="text" class="form-control" id="" value=''
                                    placeholder="Nhập pass nếu muốn thay đổi">
                                @error('password')
                                <strong class="text-red">
                                    {{$message}}
                                </strong>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label>Phòng ban trực thuộc</label>
                                <select name="department_id" class="form-control select2" id="department-select">
                                    @foreach ($departments as $department )
                                    <option {{$department->id == $user->department_id ? 'selected' : ''}} value="{{$department->id}}">{{$department->department_name}}</option>
                                    @endforeach
                                </select>
                                @error('parent_id')
                                <strong class="text-red">
                                    {{$message}}
                                </strong>
                                @enderror
							</div>
							
							<div class="form-group">
                                <label>Chức vụ</label>
                                <select name="position_id" class="form-control " id="position-select">
                                    @foreach ($user_positions as $user_position )
                                    <option {{$user_position->id == $user->position_id ? 'selected' : ''}} value="{{$user_position->id}}" data-department-id={{$user_position->department->id ?? ''}}>{{$user_position->name}}</option>
                                    @endforeach
                                </select>
                                @error('parent_id')
                                <strong class="text-red">
                                    {{$message}}
                                </strong>
                                @enderror
                            </div>

                            {{-- <div class="form-group">
                                <label class="d-block">Quyền Admin</label>
                                <input {{$user->is_admin == 1 ? 'checked' : ''}} type="checkbox" class="form-control" name="is_admin" data-bootstrap-switch data-off-color="danger" data-on-color="success">
                            </div> --}}
                        </div>
                        @can('quản_lý_quyền user')
                        <div class="col-md-6 col-12">
                            @include('admin.pages.user_manage.role_form_edit')
                        </div>    
                        @endcan
                        
                    </div>
                    <button class="btn btn-traphaco">
                        Lưu thông tin
                    </button>
                </form>
            </div>
        </div>
    </section>
    </section>
</div>


@endsection 

@section('custom-js')
<script src="{{asset('template/js/nestable.js')}}"></script>
<script src="{{asset('template/AdminLTE/plugins/bootstrap-switch/js/bootstrap-switch.min.js')}}"></script>


<script>
    //Initialize Select2 Elements
$('.select2').select2();

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
    
    $('#department-select').on('change', function(){
        var id = $(this).val();
        getPostion(id);
    })
    function getPostion(id) {
        var temp = 1;
        $('#position-select option').each(function(index){
            if($(this).data('department-id') == id){
                $(this).show();
                if(temp == 1){
                    temp = 0;
                    $('#position-select').val($(this).val())
                }
            }
            else{
                $(this).hide();
            }
        });
    }

    getPostion($('#department-select').val());
</script>



@endsection

