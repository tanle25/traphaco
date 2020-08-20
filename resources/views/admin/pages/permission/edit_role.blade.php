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
    @include('admin.partials.content_header', ['title' => 'Quản lý phân quyền'])
    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Danh sách vai trò</h3>
                {{-- <a href="{{route('admin.survey_round.create')}}" class="btn btn-success float-right">
                  <i class="far fa-file nav-icon">Thêm mới</i>
                </a> --}}
              </div>
              <!-- /.card-header -->
              <div class="card-body row">
                 <div class="col-12 col-md-6">
                  <table id="round-table" class="table table-bordered table-hover">
                    <thead>
                      <tr>
                        <th>STT</th>
                        <th>Tên vai trò</th>
                        <th>Quyền</th>
                        <th>Thao tác</th>
                      </tr>
                    </thead>
                    <tbody>
                      @foreach ($roles as $key => $role)
                      <tr>
                        <td>{{$key +1}}</td>
                        <td>{{$role->name}}</td>
                        <td>
                          @foreach ($role->permissions as $permission)
                          <span class="badge badge-warning">{{$permission->name}}</span>
                          @endforeach
                        </td>
                        <td>
                          <a href="{{route('admin.permission.edit', $role->id)}}" class="btn btn-success"><i class="far fa-edit"></i></a>
                          <a href="{{route('admin.permission.destroy', $role->id)}}" class="permission-delete btn btn-danger"><i class="far fa-trash-alt"></i></a>
                        </td>
                      </tr>
                      @endforeach
                    </tbody>
                </table>
                 </div>

                 <div class="col-12 col-md-6 pl-4">
                    <div class="card">
                      <div class="card-header d-flex align-item-center">
                        <div class="card-title ">
                          Cập nhật thông tin
                        </div>
                        {{-- <a href="" class="btn btn-success ml-auto">Tạo mới</a> --}}
                      </div>
                      <div class="card-body">
                        @include('admin.pages.permission.role_form_edit', ['current_role' => $current_role])
                      </div>
                    </div>
                 </div>
                
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
    $("#permission-table").dataTable({
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

  $(document).on('click', '.permission-delete', function(e){
      e.preventDefault();
      var url = $(this).attr('href');
      Swal.fire({
          title: 'Xóa quyền này?',
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
                      if(data.success){
                          swalToast(data.success);
                      }
                      setTimeout(function(){
                        location.reload();
                      },500)
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