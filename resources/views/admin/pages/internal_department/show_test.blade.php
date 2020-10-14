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
                <h3 class="card-title">Kết quả đợt đánh giá</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="user-result-table" class="table table-bordered table-hover">
                    <thead>
                      <tr>
                        <th >STT</th>
                        <th>Tên đợt đánh giá</th>
                        <th >Tên bài đánh giá</th>
                        <th >Người được đánh giá</th>
                        <th >Người làm đánh giá</th>
                        <th >Thao tác</th>
                      </tr>
                    </thead>
                    <tbody>
                      @foreach ($tests as $index => $test)
                        <tr>
                          <td>{{$index + 1}}</td>
                          <td>{{$test->survey_round_instance->name ?? ''}}</td>
                          <td>{{$test->survey->name ?? ''}}</td>
                          <td>{{$test->candiate->fullname ?? ''}}|{{$test->candiate->position->name ?? ''}}-{{$test->candiate->department->department_name ?? ''}}</td>
                          <td>{{$test->examiner->fullname ?? ''}}|{{$test->examiner->position->name ?? ''}}-{{$test->examiner->department->department_name ?? ''}}</td>

                          <td>
                            <a data-toggle-for="tooltip" title="Xem kết quả" href="{{route("answer.re_ans", $test->id)}}"><i class="fas fa-eye"></i></a>
                          </td>
                        </tr>
                      @endforeach
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