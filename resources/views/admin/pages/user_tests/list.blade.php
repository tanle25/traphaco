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
    @include('admin.partials.content_header', ['title' => 'Bài đánh giá'])
    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Danh sách bài test</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="test-table" class="table table-bordered table-hover">
                    <thead>
                      <tr>
                        <th>ID</th>
                        <th>Đợt khảo sát</th>
                        <th>Tên bài test</th>
                        <th>Người được đánh giá</th>
                        <th>Thời gian bắt đầu</th>
                        <th>Thời gian kết thúc</th>
                        <th>Trọng số</th>
                        <th>Trạng thái</th>
                        <th>Thao tác</th>
                      </tr>
                    </thead>
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
    $("#test-table").dataTable({
      processing: true,
      serverSide: true,
      autoWidth:false,
      scrollX:true,
      ajax:{
        url: "{{route('answer.list_test')}}",
        data: {
          marked: {{$marked ?? ''}}
        }
      } ,
      columns: [
        { "data": "DT_RowIndex","name": 'DT_Row_Index' , "orderable": false, "searchable": false},
        { "data": "survey_round", 'name': 'survey_round.name' },
        { "data": "survey_name", 'name': 'survey_name' },
        { "data": "candiate" },
        { "data": 'start_at', 'name': 'test_time.start_at'},
        { "data": 'end_at', 'name': 'test_time.end_at'},
        { "data": "multiplier"},
        { "data": "status" },
        { "data": "action"},
      ]
    });
  });
</script>
@endsection