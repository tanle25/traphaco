@extends('admin.main_layout')
@section('title')
  Quản lý đợt đánh giá
@endsection

@section('custom-css')
<link rel="stylesheet" href="{{asset('template/AdminLTE/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css')}}">
<link rel="stylesheet" href="{{asset('template/AdminLTE/plugins/datatables-responsive/css/responsive.bootstrap4.min.css')}}">
<link rel="stylesheet" href="{{asset('template/css/multiple-select.min.css')}}">
@endsection

@section('content')
@include('admin.partials.content_header', ['title' => 'Quản lý đợt đánh giá'])

<div class="row">
    <section class="col-12">

        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Thông tin đợt đánh giá</h3>
        </div>
        <form action="{{route('statistic.assessment.export')}}" class="row card-body" method="get">
          @csrf
          <div class="col-md-6 col-12">
            <div class="form-group">
              <label for="">Tên đợt đánh giá</label>
                <select multiple="multiple" name="survey_round_id[]" id="" class="select2 form-control">
                    @foreach ($survey_rounds as $survey_round)
                    <option value="{{$survey_round->id}}">{{$survey_round->name}}</option>
                    @endforeach
                </select>
              @error('survey_round_id')
              <strong class="text-red">
                {{$message}}
              </strong>
              @enderror
            </div>
          </div>
    
          <div class="col-md-6 col-12">
            <div class="form-group">
              <label for="">Loại đánh giá</label>
              <select name="survey_round_type" class="select2 form-control">
                <option value="1">Đợt đánh giá nhân viên</option>
            </select>
            </div>
          </div>
        
          <button type="submit" class="btn btn-traphaco ml-2">Xuất kết quả</button>
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
<script src="{{asset('template/js/multiple-select.min.js')}}"></script>
<script>
    //Initialize Select2 Elements
$('.select2').select2();

$("input[data-bootstrap-switch]").each(function(){
    $(this).bootstrapSwitch('state', $(this).prop('checked'));
});
</script>



@endsection

