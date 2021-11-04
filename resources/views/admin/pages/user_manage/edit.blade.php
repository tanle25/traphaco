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
                            <div class="form-group row">
                                <label class="col-sm-3" for="">Họ và tên</label>
                                <div class="col-sm-9">
                                    <input name="fullname" type="text" class="form-control" id=""
                                    placeholder="Nhập tên người dùng mới (*)" value="{{ $user->fullname }}">
                                    @error('fullname')
                                    <strong class="text-red">
                                        {{$message}}
                                    </strong>
                                    @enderror
                                </div>

                            </div>
                            <div class="form-group row">
                                <label class="col-sm-3" for="nationality">Quốc tịch</label>
                                <div class="col-sm-9">
                                <input type="text" class="form-control" name="nationality" id="nationality" placeholder="Quốc tịch" value="{{$user->nationality}}">

                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-3" for="registration-number">Số đăng ký sở hữu</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" name="registration_number" id="registration-number" placeholder="Số đăng ký sở hữu" value="{{$user->registration_number}}">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-3" for="date-range">Ngày cấp</label>
                                <div class="col-sm-3">
                                    <input type="text" class="form-control" name="date_range" id="date-range" placeholder="Ngày cấp" value="{{$user->date_range}}">
                                </div>
                                <label class="col-sm-3 text-center" for="place-issued">Nơi cấp</label>
                                <div class="col-sm-3">
                                    <input type="text" class="form-control" name="place_issued" id="place-issued" placeholder="Nơi cấp" value="{{$user->place_issued}}">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-sm-3" for="deputy">Người đại diện <small><i> (đối với cổ đông tổ chức)</i></small></label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" name="deputy" id="deputy" placeholder="Người đại diện" value="{{$user->deputy}}">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-sm-3" for="document-number">Số giấy tờ pháp lý </label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" name="document_number" id="document-number" placeholder="Số giấy tờ pháp lý" value="{{$user->document_number}}">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-3" for="address">Địa chỉ liên lạc</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" name="address" id="address" placeholder="Địa chỉ liên lạc" value="{{$user->address}}">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-3" for="number-share">Số lượng cổ phần sở hữu</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" name="number_share" id="number-share" placeholder="Số lượng cổ phần sở hữu" value="{{$user->number_share}}">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-3" for="">Username</label>
                                <div class="col-sm-9">
                                    <input name="username" type="text" class="form-control" id=""
                                    placeholder="Nhập tên đăng nhập (*)" value="{{ $user->username}}">
                                    @error('username')
                                    <strong class="text-red">
                                        {{$message}}
                                    </strong>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-sm-3" for="">Email</label>
                                <div class="col-sm-9">
                                    <input name="email" type="text" class="form-control" id="" placeholder="Nhập Email" value="{{ $user->email }}">
                                    @error('email')
                                    <strong class="text-red">
                                        {{$message}}
                                    </strong>
                                    @enderror
                                </div>

                            </div>

                            <div class="form-group row">
                                <label class="col-sm-3" for="">Password</label>
                                <div class="col-sm-9">
                                    <input name="password" type="text" class="form-control" id="" value=''
                                    placeholder="Nhập pass nếu muốn thay đổi">
                                    @error('password')
                                    <strong class="text-red">
                                        {{$message}}
                                    </strong>
                                    @enderror
                                </div>

                            </div>

                            <div class="form-group row">
                                <label class="col-sm-3">Phòng ban trực thuộc</label>
                                <div class="col-sm-9">
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

							</div>

							<div class="form-group row">
                                <label class="col-sm-3">Chức vụ</label>
                                <div class="col-sm-9">
                                    <select name="position_id" class="form-control" value="{{ $user->position_id}}" id="position-select">
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
        $('#position-select option').each(function(index){
            if($(this).data('department-id') == id){
                $(this).show();
            }
            else{
                $(this).hide();
            }
        });
    }

    getPostion($('#department-select').val());
</script>



@endsection

