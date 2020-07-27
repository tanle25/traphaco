@extends('admin.main_layout')


@section('title')
  Quản lý Khảo sát
@endsection

@section('content')
    @include('admin.partials.content_header', ['title' => 'Quản lý phòng ban'])
    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Danh sách bài khảo sát</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                @include('admin.pages.survey.table_survey')
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
    <script>
        $(document).on('click', '.remove-survey-btn', function(e){
            e.preventDefault();
            var url = $(this).attr('href');
            console.log('hellop');
            Swal.fire({
                title: 'Xóa bài khảo sát này?',
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

