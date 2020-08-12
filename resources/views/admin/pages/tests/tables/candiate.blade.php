<table id="cadiate-table" class="table table-bordered table-hover">
    <thead>
      <tr>
			<th>ID</th>
			<th>Chọn bộ đề</th>
			<th>Chức vụ - Bộ phận</th>
			<th>Trạng thái hiện tại</th> {{--Chưa gửi, đã gửi--}}
			<th>Thao tác</th>
      </tr>
	</thead>
	
	<tbody>
		<tr>
			<td></td>
		</tr>
	</tbody>

</table>
@section('custom-js')
<script>
  function getUserList(testId) {
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