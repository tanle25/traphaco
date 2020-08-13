<table id="examiner-table" class="table table-bordered table-hover">
  <thead>
    <tr>
      <th>ID</th>
      <th>Tên người dùng</th>
      <th>Chức vụ - Bộ phận</th>
      <th>Trạng thái hiện tại</th> {{--Chưa gửi, đã gửi--}}
      <th>Thao tác</th>
    </tr>
  </thead>
</table>
@section('custom-js')
<script>
function getExaminerList(testId) {
  $("#survey-table").dataTable({
  processing: true,
  serverSide: true,
  autoWidth:false,
  order:true,
  ajax: {
    url: "{{route('admin.test.get_candiate')}}",
    data: {
      test_id: testId
    }
      },
      columns: [
    { "data": "DT_RowIndex","name": 'DT_Row_Index' , "orderable": false, "searchable": false},
    { "data": "name" },
    { "data": "department_name" },
    { "data" :"status"},
    { "data" : "action"}
      ]
  });
}
</script>
@endsection