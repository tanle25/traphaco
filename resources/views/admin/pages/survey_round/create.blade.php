@extends('admin.main_layout')
@section('title')
  Quản lý đợt khảo sát
@endsection

@section('custom-css')
<link rel="stylesheet" href="{{asset('template/AdminLTE/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css')}}">
<link rel="stylesheet" href="{{asset('template/AdminLTE/plugins/datatables-responsive/css/responsive.bootstrap4.min.css')}}">
@endsection

@section('content')
@include('admin.partials.content_header', ['title' => 'Quản lý đợt khảo sát'])

<div class="row">
    <section class="col-12">

        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Thông tin đợt khảo sát</h3>
        </div>
        <form action="{{route('admin.survey_round.store')}}" class="row card-body" method="post">
          @csrf
          <div class="col-md-6 col-12">
            <div class="form-group">
              <label for="">Tên đợt khảo sát</label>
              <input name="name" type="text" class="form-control" id=""
                placeholder="Nhập đợt khảo sát mới (Bắt buộc)" value="{{ old('fullname') }}">
              @error('fullname')
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
        
          <button type="submit" class="btn btn-primary ml-2">Lưu thông tin</button>
        </form>      
        </div>
    </section>
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
    
</script>

@endsection

