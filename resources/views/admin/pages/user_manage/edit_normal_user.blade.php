@extends('admin.main_layout')

@section('title')
  Thông tin cá nhân
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
                    Chỉnh sửa thông tin
                </div>
            </div>

            <div class="card-body">
                <form action="{{route('user.update_normal_user', $user->id)}}" method="post">
                    @csrf
                    <input type="hidden" name="old_user" value="{{$user->id}}">

                    <div class="row">
                        <div class="col-md-6 col-12">

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
                                <label class="col-sm-3" for="">Mật khẩu</label>
                                <div class="col-sm-9">
                                    <input name="password" type="text" class="form-control" id="" value=''
                                    placeholder="Nhập mật khẩu nếu muốn thay đổi">
                                @error('password')
                                <strong class="text-red">
                                    {{$message}}
                                </strong>
                                @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-3" for="nationality">Quốc tịch</label>
                                <div class="col-sm-9">
                                <input type="text" class="form-control" name="nationality" id="nationality" placeholder="Quốc tịch" value="{{Auth::user()->nationality}}">

                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-3" for="registration-number">Số đăng ký sở hữu</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" name="registration_number" id="registration-number" placeholder="Số đăng ký sở hữu" value="{{Auth::user()->registration_number}}">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-3" for="date-range">Ngày cấp</label>
                                <div class="col-sm-3">
                                    <input type="text" class="form-control" name="date_range" id="date-range" placeholder="Ngày cấp" value="{{Auth::user()->date_range}}">
                                </div>
                                <label class="col-sm-3 text-center" for="place-issued">Nơi cấp</label>
                                <div class="col-sm-3">
                                    <input type="text" class="form-control" name="place_issued" id="place-issued" placeholder="Nơi cấp" value="{{Auth::user()->place_issued}}">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-sm-3" for="deputy">Người đại diện <small><i> (đối với cổ đông tổ chức)</i></small></label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" name="deputy" id="deputy" placeholder="Người đại diện" value="{{Auth::user()->deputy}}">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-sm-3" for="document-number">Số giấy tờ pháp lý </label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" name="document_number" id="document-number" placeholder="Số giấy tờ pháp lý" value="{{Auth::user()->document_number}}">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-sm-3" for="address">Địa chỉ liên lạc</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" name="address" id="address" placeholder="Địa chỉ liên lạc" value="{{Auth::user()->address}}">
                                </div>
                            </div>
                        </div>



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
</script>

@endsection

