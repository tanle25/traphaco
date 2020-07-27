<!DOCTYPE html>
<html>
    @include('admin.partials.head')
<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">
    @include('admin.partials.nav')
    @include('admin.partials.sidebar')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <!-- Main content -->
    <section class="content">
    <div class="container-fluid">
    @yield('content')
    </div>
    </section>
    <!-- /.content -->
  </div>
    @include('admin.partials.footer')
    <!-- Control Sidebar -->
    <aside class="control-sidebar control-sidebar-dark">
        <!-- Control sidebar content goes here -->
    </aside>
    <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->
@include('admin.partials.scripts')
</body>
</html>
