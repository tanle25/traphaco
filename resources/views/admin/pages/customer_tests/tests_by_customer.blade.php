@extends('admin.main_layout')

@section('custom-css')
@parent
<link rel="stylesheet" href="{{asset('template/AdminLTE/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css')}}">
<link rel="stylesheet" href="{{asset('template/AdminLTE/plugins/datatables-responsive/css/responsive.bootstrap4.min.css')}}">
@endsection


@section('title')
  Quản lý đợt khảo sát
@endsection

@section('content')
    @include('admin.partials.content_header', ['title' => 'Quản lý đợt khảo sát'])
    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Các bài khảo sát của người dùng</h3>
                {{-- <a href="{{route('admin.survey_round.create')}}" class="btn btn-success float-right">
                  <i class="far fa-file nav-icon">Thêm mới</i>
                </a> --}}
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="round-table" class="table table-bordered table-hover">
                    <thead>
                      <tr>
                        <th>ID</th>
                        <th>Tên bài khảo sát</th>
                        <th>Người tạo</th>
                        <th>Thao tác</th>
                      </tr>
                    </thead>
                    <tbody>
                      @foreach ($customer_tests as $index => $test)
                        <tr>
                          <td>{{$index + 1}}</td>
                          <td>{{$test->survey->name}}</td>
                          <td>{{$test->author->fullname}}</td>
                          <td>
                            <span href="{{route('admin.customer_test.details', $test->id)}}"class="btn text-success test-details"><i class="fas fa-eye" data-toggle="modal" data-target="#test-model" ></i></span>
                            <a href="{{route('admin.customer_test.details.export', $test->id)}}" class="btn text-danger test-delete"><i class="far fa-trash-alt"></i></a>
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

    <div class="modal fade"  id="test-model" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
      <div class="modal-dialog" style="max-width: 1024px" role="document">
          <div class="modal-content">
              <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalLabel">Chi tiết bài test</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                  </button>
              </div>
              <div class="modal-body">
                <div class="test-container">

                </div>
              </div>
          </div>
      </div>
  </div>
@endsection 

@section('custom-js')
@parent
<script src="{{asset('template/AdminLTE/plugins/datatables/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('template/AdminLTE/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js')}}"></script>
<script src="{{asset('template/AdminLTE/plugins/datatables-responsive/js/dataTables.responsive.min.js')}}"></script>
<script src="{{asset('template/AdminLTE/plugins/datatables-responsive/js/responsive.bootstrap4.min.js')}}"></script>
<script>
  $(function () {
    $("#round-table").dataTable({
      autoWidth:false,      
    });
  });

  $('.test-details').on('click', function(e){
    var url = $(this).attr('href');
    $.ajax({
      url: url,
      type: "GET",
      success: function(data){
        $('.test-container').html(data);
      }
    })
  });

  $(document).on('click', '.round-survey-delete', function(e){
      e.preventDefault();
      var url = $(this).attr('href');
      Swal.fire({
          title: 'Xóa đợt khảo sát này?',
          text: "Bạn không thể hoàn tác!",
          icon: 'warning',
          showCancelButton: true,
          confirmButtonColor: '#3085d6',
          cancelButtonColor: '#d33',
          confirmButtonText: 'Vẫn xóa nó!',
      })
      .then((result) => {
          if (result.value) {
              $.ajax({
                  url: url,
                  type: "POST",
                  data: {
                    _token: $('meta[name="csrf-token"]').attr('content')
                  },
                  success: function(data){
                      if(data.error){
                          swalToast(data.error, 'error');
                      }
                      if(data.msg){
                          swalToast(data.msg);
                      }
                      location.reload();
                  },
                  error: function(errors){
                      swalToast('Lỗi không rõ phát sinh trong quá trình xóa', 'error');
                  }
              });
          }
      });
  })


</script>

@endsection