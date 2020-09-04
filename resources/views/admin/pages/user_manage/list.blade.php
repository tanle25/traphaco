@extends('admin.main_layout')

@section('custom-css')
@parent
<link rel="stylesheet" href="{{asset('template/AdminLTE/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css')}}">
<link rel="stylesheet" href="{{asset('template/AdminLTE/plugins/datatables-responsive/css/responsive.bootstrap4.min.css')}}">
@endsection


@section('title')
  Quản lý user
@endsection

@section('content')
    @include('admin.partials.content_header', ['title' => 'Quản lý người dùng'])
    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Danh sách người dùng</h3>
                @can('thêm user')
                  <a href="{{route('admin.usermanage.import')}}" class="ml-3 btn btn-success float-right">
                    <i class="fas fa-plus-circle nav-icon">Import</i>
                  </a>
                  <a href="{{route('admin.usermanage.create')}}" class="btn btn-success float-right">
                    <i class="fas fa-plus-circle nav-icon"> Thên mới</i>
                  </a>
                @endcan
                

              </div>
              <!-- /.card-header -->
              <div class="card-body">
                @include('admin.pages.user_manage.table')
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
      </div>
      <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
@endsection 

@section('custom-js')
@parent
<script src="{{asset('template/AdminLTE/plugins/datatables/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('template/AdminLTE/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js')}}"></script>
<script src="{{asset('template/AdminLTE/plugins/datatables-responsive/js/dataTables.responsive.min.js')}}"></script>
<script src="{{asset('template/AdminLTE/plugins/datatables-responsive/js/responsive.bootstrap4.min.js')}}"></script>
<script>
  $(function () {
    $("#user-table").dataTable({
      processing: true,
      serverSide: true,
      autoWidth:false,
      ajax: "{{route('admin.usermanage.list_user')}}",
      columns: [
        { "data": "DT_RowIndex","name": 'DT_Row_Index' , "orderable": false, "searchable": false},
        { "data": "fullname" },
        { "data": "email" },
        { "data": "department_name" },
        { "data" :"action"}
      ]
    });
  });
</script>
@endsection