<table id="cadiate-table" class="table table-bordered table-hover">
    <thead>
      <tr>
			<th>ID</th>
			<th>Chọn bộ đề</th>
			<th>Chức vụ - Bộ phận</th>
			<th>Trạng thái hiện tại</th> 
			<th>Thao tác</th>
      </tr>
	</thead>
	
	<tbody>
		<tr>
			<td></td>
		</tr>
	</tbody>

</table>
<?php $__env->startSection('custom-js'); ?>
<script>
  function getUserList(testId) {
    $("#survey-table").dataTable({
		processing: true,
		serverSide: true,
		autoWidth:false,
		order:true,
		ajax: {
			url: "<?php echo e(route('admin.test.get_candiate')); ?>",
			data: {
				test_id: testId
			}
      	},
      	columns: [
			{ "data": "id" },
			{ "data": "name" },
			{ "data": "department_name" },
			{ "data" :"status"},
			{ "data" : "action"}
      	]
    });
  }
</script>
<?php $__env->stopSection(); ?><?php /**PATH E:\DEV\Employees management\HR manager\resources\views/admin/pages/tests/tables/candiate.blade.php ENDPATH**/ ?>