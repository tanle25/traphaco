@extends('admin.main_layout')

@section('custom-css')
@parent
<link rel="stylesheet" href="{{asset('template/AdminLTE/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css')}}">
<link rel="stylesheet" href="{{asset('template/AdminLTE/plugins/datatables-responsive/css/responsive.bootstrap4.min.css')}}">
@endsection


@section('title')
  Lịch sử khách hàng
@endsection

@section('content')
    @include('admin.partials.content_header', ['title' => 'Lịch sử khách hàng'])
    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Danh sách</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="round-table" class="table table-bordered table-hover">
                    <thead>
                      <tr>
                        <th>STT</th>
                        <th>Thời gian</th>
                        <th>Đối tượng</th>
                        <th>Mô tả</th>
                        <th>Dữ liệu cũ</th>
                        <th>Dữ liệu mới</th>
                        <th>Nguời thực hiện</th>
                      </tr>
                    </thead>
                    <tbody>
                        @foreach ($history_list as $index => $item)
                        <tr>
                            <td>{{$index + 1}}</td>
                            <td>{{Carbon\Carbon::parse($item->created_at)->format('d/m/Y H:i:s A') }}</td>
                            <td>Khách hàng:{{$item->subject->contract_code ?? ''}}</td>
                            <td>{{$item->description}}</td>
                            <td>
                                
                            @switch($item->description)
                                @case('created')
                                    <p>N/A</p>
                                    @break
                                @case('deleted')
                                    @foreach ($item->properties['attributes'] ?? [] as $key => $value)
                                    <p>{{$key}}: {{$value}}</p>
                                    @endforeach
                                    @break
                                @case('updated')
                                    @foreach ($item->properties['old'] ?? [] as $key => $value)
                                    <p>{{$key}}: {{$value}}</p>
                                    @endforeach
                                    @break
                                @default  
                            @endswitch
                            </td>
                            <td>
                            @switch($item->description)
                                @case('created')
                                    @foreach ($item->properties['attributes'] ?? [] as $key => $value)
                                    <p>{{$key}}: {{$value}}</p>
                                    @endforeach
                                    @break
                                @case('deleted')
                                    <p>N/A</p>
                                    @break
                                @case('updated')
                                    @foreach ($item->properties['attributes'] ?? [] as $key => $value)
                                    <p>{{$key}}: {{$value}}</p>
                                    @endforeach
                                    @break
                                @default  
                            @endswitch
                          </td>
                          <td>
                            <p>{{$item->causer->username ?? '' }}</p>
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
    $("#round-table").dataTable({
       autoWidth:false,
    });
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