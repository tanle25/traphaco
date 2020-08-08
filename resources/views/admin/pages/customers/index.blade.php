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
@include('admin.partials.content_header', ['title' => 'Quản lý khách hàng'])
<!-- Main content -->
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Danh sách khách hàng</h3>

                        @if (Auth::user()->is_admin == 1)
                        <span class="btn btn-success float-right customer-create" data-toggle="modal"
                            data-target="#customer-model">
                            <i class="far fa-file nav-icon"> Thêm mới</i>
                        </span>
                        <a href="#" class="btn btn-success float-right mr-4" data-toggle="modal"
                        data-target="#import-model">
                            <i class="far fa-file nav-icon"> Import Excel</i>
                        </a>
                        @endif

                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <table id="customer-table" class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th>STT</th>
                                    <th>Mã DMS</th>
                                    <th>Mã CRM</th>
                                    <th>Tên khách hàng</th>
                                    <th>Địa chỉ</th>
                                    <th>Số điện thoại</th>
                                    <th>Địa bàn</th>
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
<div class="modal fade" id="customer-model" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Thông tin khách hàng</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="" method="post" id="customer-form">
                    <input type="hidden" name="_token" value="{{csrf_token()}}">
                    <input type="hidden" name="id">
                    <div class="form-group">
                        <label>Tên khách hàng</label>
                        <input type="test" class="form-control" name="fullname" placeholder="Nhập tên khách hàng">
                    </div>
                    <div class="form-group">
                        <label>Địa chỉ</label>
                        <input type="test" class="form-control" name="address" placeholder="Nhập địa chỉ khách hàng">
                    </div>
                    <div class="form-group">
                        <label>Số điện thoại</label>
                        <input type="test" class="form-control" name="phone" placeholder="Nhập số điện thoại">
                    </div>
                    <div class="form-group">
                        <label>Địa bàn</label>
                        <input type="test" class="form-control" name="zone" placeholder="Nhập tên địa bàn">
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-success customer-form-btn">Lưu thay đổi</button>
            </div>
        </div>
    </div>
</div>

<!-- SURVEY MODAL -->
<div class="modal fade"  id="customer-survey-model" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" style="max-width: 1024px" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Khảo sát khách hàng</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
				<form action="{{route('admin.customer.create_and_send_test')}}" id="survey-form" method="post">
					@csrf
					<input type="hidden" name="created_by" value="{{Auth::user()->id}}">
					<input type="hidden" name="customer_id" value="">
					<div class="form-inline ">
						<label class="mr-3" for="test-list">Chọn bài test</label>
						<select id="test-list" name="survey_id" class="form-control col-md-7" >
							@foreach ($survey as $item)
							<option value="{{$item->id}}">{{$item->name}}</option>
							@endforeach
						</select>
						<button class="ml-3 btn btn-success">Lấy bài test</button>
					</div>
				</form>
				<div id="test-container">
					
				</div>
            </div>
            {{-- <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-success customer-form-btn">Lưu</button>
            </div> --}}
        </div>
    </div>
</div>

<div class="modal fade"  id="import-model" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" style="max-width: 1024px" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Import file dữ liệu khách hàng</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
				<form action="{{route('admin.customer.import')}}" id="import-form" method="post" enctype="multipart/form-data">
					@csrf
                    <div class="form-group">
                        <label for="exampleInputFile">File input</label>
                        <div class="input-group">
                          <div class="custom-file">
                            <input type="file" class="custom-file-input" name="customer_list" id="exampleInputFile">
                            <label class="custom-file-label" for="exampleInputFile">Choose file</label>
                          </div>
                          <div class="input-group-append">
                            <button class="input-group-text" id="">Upload</button>
                          </div>
                        </div>
                    </div>
				</form>
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
    // Add the following code if you want the name of the file appear on select
    $(".custom-file-input").on("change", function() {
    var fileName = $(this).val().split("\\").pop();
    $(this).siblings(".custom-file-label").addClass("selected").html(fileName);
    });
    $(function () {
        $("#customer-table").dataTable({
            processing: true,
            serverSide: true,
            autoWidth: false,
            ajax: "{{route('admin.customer.list')}}",
            columns: [
                { "data": "id" },
                { "data": "DMS_code" },
                { "data": "CRM_code" },
                { "data": "fullname" },
                { "data": "address" },
                { "data": "phone" },
                { "data": "zone" },
                { "data": "action" },
            ]
        });
    });


    function storeCustomer(url, data) {
        $.ajax({
            url: url,
            type: "POST",
            data: data,
            success: function (data) {
                if (data.error) {
                    swalToast(data.error, 'error');
                    return;
                }
                swalToast(data.msg, 'success');
                $('#customer-model').modal('hide');
            },
            error: function (errors) {
                swalToast('Lỗi không xác định vui lòng kiểm tra lại các trường', 'error');
            }
        });
    }

    function updateCustomer(url, data) {
        $.ajax({
            url: url,
            type: "POST",
            data: data,
            success: function (data) {
                if (data.error) {
                    swalToast(data.error, 'error');
                    return;
                }
                swalToast(data.msg, 'success');
                $('#customer-model').modal('hide');
            },
            error: function (errors) {
                swalToast('Lỗi không xác định vui lòng kiểm tra lại các trường', 'error');
            }
        });
    }

    function editCustomer(url) {
        $.ajax({
            url: url,
            type: "GET",
            data: {
                _token: $('meta[name="csrf-token"]').attr('content')
            },
            success: function (data) {
                if (data.error) {
                    swalToast(data.error, 'error');
                    return;
                }
                $('#customer-form input[name="fullname"]').val(data.fullname)
                $('#customer-form input[name="address"]').val(data.address)
                $('#customer-form input[name="phone"]').val(data.phone)
                $('#customer-form input[name="zone"]').val(data.zone)
                $('#customer-form input[name="id"]').val(data.id)

            },
            error: function (errors) {
                swalToast('Không tìm thấy khách hàng', 'error');
            }
        });
    }

	function getSurvey(url, data){
		$.ajax({
			url: url,
			type: 'POST',
			data: data,
			success: function (data) {
                if (data.error) {
                    swalToast(data.error, 'error');
                    return;
                }
                $('#customer-model').modal('hide');
				$('#test-container').html(data);
            },
            error: function (errors) {
                swalToast('Lỗi không xác định vui lòng kiểm tra lại các trường', 'error');
            }
		})
	};

	$(document).on('click', '.customer-survey', function(e){
		var customerId = $(this).data('customer-id');
		$('#test-container').html('');
		$('#survey-form input[name="customer_id"]').val(customerId);
	})

	$(document).on('submit', '#survey-form', function(e){
		e.preventDefault();
		var url = $('#survey-form').attr('action');
		var data = $('#survey-form').serializeArray();
        data = data.reduce(function (obj, item) {
            obj[item.name] = item.value;
            return obj;
        }, {});
		getSurvey(url, data);
	})

    $(document).on('click', '.customer-edit', function (e) {
        var url = $(this).attr('href');
        editCustomer(url);
        $('#customer-form').attr('action', '{{route("admin.customer.update")}}')

    })

    $(document).on('click', '.customer-form-btn', function (e) {
        var url = $('#customer-form').attr('action');
        var data = $('#customer-form').serializeArray();
        data = data.reduce(function (obj, item) {
            obj[item.name] = item.value;
            return obj;
        }, {});
        if (url == '{{route("admin.customer.store")}}') {
            storeCustomer(url, data);
            $("#customer-table").DataTable().ajax.reload();
        }
        if (url == '{{route("admin.customer.update")}}') {
            updateCustomer(url, data);
            setTimeout(function () {
                $("#customer-table").DataTable().ajax.reload();
            }, 500);
        }
    })

    $(document).on('click', '.customer-create', function (e) {
        var url = "{{route('admin.customer.store')}}";
        $('#customer-form input[name="fullname"]').val('')
        $('#customer-form input[name="address"]').val('')
        $('#customer-form input[name="phone"]').val('')
        $('#customer-form input[name="zone"]').val('')
        $('#customer-form input[name="id"]').val('')
        $('#customer-form').attr('action', '{{route("admin.customer.store")}}')
    })


    $(document).on('click', '.customer-delete', function (e) {
        e.preventDefault();
        var url = $(this).attr('href');
        Swal.fire({
            title: 'Xóa khách hàng này?',
            text: "Bạn không thể hoàn tác!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Vẫn xóa!',
        })
            .then((result) => {
                if (result.value) {
                    $.ajax({
                        url: url,
                        type: "POST",
                        data: {
                            _token: $('meta[name="csrf-token"]').attr('content')
                        },
                        success: function (data) {
                            if (data.error) {
                                swalToast(data.error, 'error');
                            }
                            if (data.msg) {
                                swalToast(data.msg);
                            }
                            location.reload();
                        },
                        error: function (errors) {
                            swalToast('Lỗi không rõ phát sinh trong quá trình xóa', 'error');
                        }
                    });
                }
            });
    })
// survey logic
</script>

<script>
    $(document).on('click', '.send-result', function (e) {
        var url = $(this).attr('href');
        var questionCount = $('.question').length;
        var answer = [];
        $('.option-input:checked').each(function(){
            answer.push({
                question_id: $(this).data('question-id'),
                option_id: $(this).attr('value'),
                comment: $(this).closest('.question-option').find('.comment').val(),
            });     
        })
        if(questionCount !== answer.length){
            Swal.fire({
                title: 'Bạn chưa hoàn thành bài test!',
                text: "Vui lòng hoàn thành bài test trước khi gửi!",
                icon: 'warning',
                showCancelButton: true,
                showConfirmButton: false,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                cancelButtonText: 'Tôi hiểu',
            })
            return
        }

        Swal.fire({
            title: 'Hoàn thành bài test!',
            text: "Gửi kết quả!",
            icon: 'success',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Gửi kết quả!',
        })
        .then((result) => {
            if (result.value) {
                $.ajax({
                    url: url,
                    type: "POST",
                    data: {
                        _token: $('meta[name="csrf-token"]').attr('content'),
                        answer: answer,
                        test_id: 1,
                    },
                    success: function (data) {
                        if (data.error) {
                            swalToast(data.error, 'error');
                        }
                        if (data.msg) {
                            swalToast(data.msg);
                        }
                        setTimeout(function () {
                            location.href = "{{route('answer.index', ['marked' => 0])}}";
                        }, 300)
                    },
                    error: function (errors) {
                        swalToast('Lỗi không rõ phát sinh trong quá trình xóa', 'error');
                    }
                });
            }
        });
    })
    $(document).on('blur', '#customer-test-form input',function(e){
        var url = $('#customer-test-form').attr('action');
        var data = {
            `${$(this).attr('name')}` : `${$(this).val()}`,
        }
        console.log('data');
        $.ajax({
            url: url,
            data: 
        })
    });
</script>

@error('customer_list')
<script>
    swalToast("{{$message}}", 'error' )
</script>
@enderror
@endsection