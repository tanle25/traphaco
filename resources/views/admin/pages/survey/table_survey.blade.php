@section('custom-css')
@parent
<link rel="stylesheet" href="{{asset('template/AdminLTE/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css')}}">
<link rel="stylesheet" href="{{asset('template/AdminLTE/plugins/datatables-responsive/css/responsive.bootstrap4.min.css')}}">
@endsection


<table id="survey-table" class="table table-bordered table-hover">
    <thead>
      <tr>
        <th>ID</th>
        <th>Tên bài khảo sát</th>
        <th>Người tạo</th>
        <th>Thao tác</th>
      </tr>
    </thead>
</table>
    
@section('custom-js')
@parent
<script src="{{asset('template/AdminLTE/plugins/datatables/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('template/AdminLTE/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js')}}"></script>
<script src="{{asset('template/AdminLTE/plugins/datatables-responsive/js/dataTables.responsive.min.js')}}"></script>
<script src="{{asset('template/AdminLTE/plugins/datatables-responsive/js/responsive.bootstrap4.min.js')}}"></script>
<script>
  $(function () {
    $("#survey-table").dataTable({
      processing: true,
      serverSide: true,
      autoWidth:false,
      ajax: "{{route('admin.survey.list_survey')}}",
      columns: [
        { "data": "id" },
        { "data": "name" },
        { "data": "created_by" },
        { "data" :"action"}
      ]
    });
  });
</script>
@endsection
