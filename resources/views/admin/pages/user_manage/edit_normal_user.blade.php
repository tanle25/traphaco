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
                                <label for="">Mật khẩu</label>
                                <input name="password" type="text" class="form-control" id="" value=''
                                    placeholder="Nhập mật khẩu nếu muốn thay đổi">
                                @error('password')
                                <strong class="text-red">
                                    {{$message}}
                                </strong>
                                @enderror
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

