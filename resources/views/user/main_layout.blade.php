<!DOCTYPE html>
<html>
    @include('user.partials.head')
<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">
    @include('user.partials.nav')
    @include('user.partials.sidebar')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    @include('user.partials.content_header')
    <!-- Main content -->
    <section class="content">
    <div class="container-fluid">
        @yield('content')
    </div>
    </section>
    <!-- /.content -->
  </div>
    @include('user.partials.footer')
    <!-- Control Sidebar -->
    <aside class="control-sidebar control-sidebar-dark">
        <!-- Control sidebar content goes here -->
    </aside>
    <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->
@include('user.partials.scripts')
</body>
</html>
