<!DOCTYPE html>
<html>
    @include('Admin.partials.head')
<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">
    @include('Admin.partials.nav')
    @include('Admin.partials.sidebar')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    @include('Admin.partials.content_header')
    <!-- Main content -->
    <section class="content">
    <div class="container-fluid">
        @yield('content')
    </div>
    </section>
    <!-- /.content -->
  </div>
    @include('Admin.partials.footer')
    <!-- Control Sidebar -->
    <aside class="control-sidebar control-sidebar-dark">
        <!-- Control sidebar content goes here -->
    </aside>
    <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->
@include('Admin.partials.scripts')
</body>
</html>
