@extends('admin.main_layout')
@section('title')
  Trang quản trị
@endsection

@section('content')

@include('admin.partials.content_header', ['title' => 'Trang chủ'])

<div class="row">
    <div class="col-lg-3 col-6">
      <!-- small box -->
      <div class="small-box bg-info">
        <div class="inner">
          <h3>{{Auth::user()->asExaminerTests->where('status', '2')->count()}}</h3>

          <p>Bài đánh giá mới</p>
        </div>
        <div class="icon">
          <i class="ion ion-bag"></i>
        </div>
        <a href="{{route('answer.index', ['marked' => 0])}}" class="small-box-footer">Chi tiết <i class="fas fa-arrow-circle-right"></i></a>
      </div>
    </div>
    <!-- ./col -->
    <div class="col-lg-3 col-6">
      <!-- small box -->
      <div class="small-box bg-success">
        <div class="inner">
          <h3>{{Auth::user()->asExaminerTests->where('status', '3')->count()}}<sup style="font-size: 20px"></sup></h3>
          <p>Bài đánh giá đã hoàn thành</p>
        </div>
        <div class="icon">
          <i class="ion ion-stats-bars"></i>
        </div>
        <a href="{{route('answer.index', ['marked' => 1])}}" class="small-box-footer">Chi tiết <i class="fas fa-arrow-circle-right"></i></a>
      </div>
    </div>
    <!-- ./col -->
    <!-- ./col -->
</div>

  <!-- /.row (main row) -->
@endsection