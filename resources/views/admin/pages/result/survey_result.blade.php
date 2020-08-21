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
    @include('admin.partials.content_header', ['title' => 'Thống kê cá nhân'])
    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Kết quả các cuộc khảo sát</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="user-result-table" class="table table-bordered table-hover">
                    <thead>
                      <tr>
                        <th rowspan="2">STT</th>
                        <th rowspan="2">Người được khảo sát</th>
                        <th colspan="4">Kết quả điểm TB</th>
                        <th rowspan="2">% năng lực</th>
                        <th rowspan="2">Thao tác</th>
                      </tr>
                      <tr>
                        <th>Trọng số 3</th>
                        <th>Trọng số 2</th>
                        <th>Trọng số 1</th>
                        <th style="border-right-width: 1px !important">Bình quân chung</th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr>
                        <td>1</td>
                        <td>2</td>
                        <td>3</td>
                        <td>4</td>
                        <td>5</td>
                        <td>6</td>
                        <td>7</td>
                        <td>8</td>
                      </tr>
                    </tbody>
                  </table>                
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
    $("#user-result-table").dataTable({
      autoWidth:false,
    });
  });
</script>
@endsection