@extends('admin.main_layout')

@section('custom-css')
@parent
<link rel="stylesheet" href="{{asset('template/AdminLTE/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css')}}">
<link rel="stylesheet" href="{{asset('template/AdminLTE/plugins/datatables-responsive/css/responsive.bootstrap4.min.css')}}">
@endsection


@section('title')
  Chi tiết đợt khảo sát
@endsection


@section('content')
    @include('admin.partials.content_header', ['title' => 'Chi tiết đợt khảo sát'])
    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-header">
                <h2 class="card-title">Danh sách bài khảo sát khảo sát</h2>                
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <div class="mb-4">
                    <h5>
                        <strong>Người được khảo sát: </strong>  {{$candiate->fullname}}
                    </h5>
                    <h5>
                        <strong>Phòng ban: </strong>{{$candiate->department->department_name ?? 'Không rõ phòng ban'}}
                    </h5>
                    <h5>
                        <strong>Chức vụ: </strong>{{$candiate->position->name ?? 'Không rõ chức vụ'}}
                    </h5>
                </div>
                <div>
                    @foreach ($tests as $test)
                    <div class="card bg-gradient-light collapsed-card">
                        <div class="card-header bg-gradient-success border-0" style="cursor: move;">
                          <h3 class="card-title">
                            <i class="fas fa-book-open"></i> &nbsp;&nbsp;&nbsp;
                            {{$test->survey->name}}
                          </h3>
                          <!-- tools card -->
                          <div class="card-tools">
                            <button type="button" class="btn btn-info btn-sm" data-card-widget="collapse">
                              <i class="fas fa-minus"></i> Xem chi tiết
                            </button>
                            <button type="button" class="btn btn-danger btn-sm" data-card-widget="remove">
                              <i class="fas fa-times"></i>
                            </button>
                          </div>
                          <!-- /. tools -->
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body pt-0" style="overflow: auto">
                          <!--The calendar -->
                            {{-- <div class="card card-info mx-auto mt-3" style="max-width: 1024px">
                               <div class="card-header">
                                   <h2>
                                       {{$test->survey->title ?? ''}}
                                   </h2>
                                   <div>
                                       <h5>{{$test->survey->content ?? ''}}</h5>
                                   </div>
                                   <div class="mt-3">
                                       <h5>
                                           {{$test->type == 1 ? 'Người được khảo sát' : 'Người làm bài'}}: {{$candiate->fullname}} |{{$candiate->department->department_name ?? ''}} - {{$candiate->position->name ?? ''}}
                                       </h5>
                                   </div>
                               </div>
           
                               <div class="card-body">
                                   @foreach ($test->survey->section as $section)
                                   <div class="section-header mb-3">
                                       <h3>
                                           {{$section->title}}
                                       </h3>
                                   </div>
                                   
                                   @foreach ($section->questions as $question)
                                       <div class="mb-3 question">
                                           <div class="question-title">
                                               <h5> <strong> Câu hỏi:</strong>{{$question->content ?? ''}}</h5>
                                           </div>
                                           <div class="question-option pt-2">
                                               <div class="row" style="font-size: 18px">  
                                                   @foreach ($question->options as $option)
                                                   <div class="form-group row col-12 d-flex justify-center align-center">
                                                       <input class="option-input" type="radio" style="height:23px; width:23px" data-question-id="{{$question->id}}" name="question-{{$question->id}}" value="{{$option->id}}">
                                                       <span  class="pl-2 col-md-4" style="line-height: 23px">{{$option->content ?? ''}}
                                                           @if ($test->type == 1)
                                                           ({{$option->score ?? 0}} điểm)</span>
                                                           @endif 
                                                        <span class="col-md-3">
                                                          Điểm trung bình:
                                                        </span>
                                                   </div>
                                                   @endforeach 
                                               </div>
                                               <div class="form-group">
                                                   <textarea class="form-control comment" value="" oninput="auto_grow(this)" rows="1" placeholder="Nhận xét"></textarea>
                                               </div>
                                           </div>
                                       </div>  
                                       @endforeach
                                   @endforeach           
                               </div> 
           
           
                           </div> --}}

                           <table class="table table-bordered mx-auto mt-4" style="overflow:scrollX; max-width: 1024px; min-width: 768px">
                            <thead>
                              <tr>
                                <th style="width: 5%" rowspan="2">TT</th>
                                <th  style="width: 40%" rowspan="2">Nội dung</th>
                                <th style="width: 40%" colspan="4">Kết quả điểm TB</th>
                                <th style="width: 10%" rowspan="2">% Năng lực</th>
                              </tr>
                              <tr>
                                <th style="width: 10%">Cấp trên đánh giá</th>
                                <th style="width: 10%">Ngang cấp đánh giá</th>
                                <th style="width: 10%">Cấp dưới đánh giá</th>
                                <th style="width: 10%">Bình quân chung</th>
                              </tr>
                              <tr>
                                <th></th>
                                <th>Điểm TB</th>
                                <th>{{$test->survey->getScoreFromLevel($test->survey_round, $candiate->id, 3)}}</th>
                                <th>{{$test->survey->getScoreFromLevel($test->survey_round, $candiate->id, 2)}}</th>
                                <th>{{$test->survey->getScoreFromLevel($test->survey_round, $candiate->id, 1)}}</th>
                                <th>{{$test->survey->getAvgScore($test->survey_round, $candiate->id)}}</th>
                                <th>{{$test->survey->getScoreByPercent($test->survey_round, $candiate->id)}}</th>
                              </tr>

                              @foreach ($test->survey->section as $index => $section)
                              <tr>
                                <th></th>
                                <th>{{$section->title ?? ''}}</th>
                                <th></th>
                                <th></th>
                                <th></th>
                                <th></th>
                                <th></th>
                              </tr>
                              @foreach ($section->questions as $index => $question)
                              

                              <tr>
                                <td>{{$index+1}}</td>
                                <td>{{$question->content ?? ''}}</td>
                                <td>{{$question->getScoreFromLevel($test->survey_round, $candiate->id, 3)}}</td>
                                <td>{{$question->getScoreFromLevel($test->survey_round, $candiate->id, 2)}}</td>
                                <td>{{$question->getScoreFromLevel($test->survey_round, $candiate->id, 1)}}</td>
                                <td>{{$question->getAvgScore($test->survey_round, $candiate->id)}}</td>
                                <td>{{$question->getScoreByPercent($test->survey_round, $candiate->id)}}</td>
                              </tr>
                              @endforeach
                              @endforeach

                              

                            </thead>
                           </table>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    @endforeach

                    
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
@endsection 

@section('custom-js')
@parent
<script src="{{asset('template/AdminLTE/plugins/datatables/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('template/AdminLTE/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js')}}"></script>
<script src="{{asset('template/AdminLTE/plugins/datatables-responsive/js/dataTables.responsive.min.js')}}"></script>
<script src="{{asset('template/AdminLTE/plugins/datatables-responsive/js/responsive.bootstrap4.min.js')}}"></script>
<script>
  $(function () {

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