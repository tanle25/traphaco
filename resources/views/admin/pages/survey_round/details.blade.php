@extends('admin.main_layout')

@section('custom-css')
@parent
<link rel="stylesheet" href="{{asset('template/AdminLTE/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css')}}">
<link rel="stylesheet" href="{{asset('template/AdminLTE/plugins/datatables-responsive/css/responsive.bootstrap4.min.css')}}">
@endsection


@section('title')
  Chi tiết đợt đánh giá
@endsection

@section('content')
    @include('admin.partials.content_header', ['title' => 'Chi tiết đợt đánh giá'])
    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Danh sách người được đánh giá</h3>
                {{-- <a href="{{route('admin.survey_round.create')}}" class="btn btn-success float-right">
                  <i class="far fa-file nav-icon">  Thêm mới</i>
                </a> --}}
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="round-table" class="table table-bordered table-hover">
                    <thead>
                      <tr>
                        <th>ID</th>
                        <th>Tên người được đánh giá</th>
                        <th>Các bài đánh giá</th>
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
    $("#round-table").dataTable({
      processing: true,
      serverSide: true,
      autoWidth:false,
      scrollX:true,
      ajax: "{{route('admin.survey_round.details_table', $survey_round->id)}}",
      columns: [
        { "data": "DT_RowIndex","name": 'DT_Row_Index' , "orderable": false, "searchable": false},
        { "data": "candiate_name", 'name':'users.fullname' },
        { "data": "survey_name", 'name':'survey.name' },
        { "data" :"action"}
      ]
    });
  });

  $(document).on('click', '.round-survey-delete', function(e){
            e.preventDefault();
            var url = $(this).attr('href');
            Swal.fire({
                title: 'Xóa bài đánh giá này?',
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