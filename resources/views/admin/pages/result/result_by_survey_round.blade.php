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
                        <th >STT</th>
                        <th>Tên đợt khảo sát</th>
                        <th >Số được đánh giá</th>
                        <th >Các bài khảo sát</th>
                        <th >Thao tác</th>
                      </tr>
                    </thead>
                    <tbody>
                      @foreach ($survey_round as $index => $item)
                        <tr>
                          <td>{{$index + 1}}</td>
                          <td>{{$item->survey_round_name}}</td>
                          <td>{{$item->user_count}}</td>
                          <td>{{$item->survey_list}}</td>
                          <td>
                            <a href="{{route('admin.user_result.show', $item->survey_round_id)}}"> Xem chi tiết </a>
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