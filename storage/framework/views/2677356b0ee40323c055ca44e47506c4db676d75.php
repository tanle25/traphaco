  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-dark navbar-teal" style="background-color: #008a43; color:white">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a style="color:white" class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a style="color:white; letter-spacing:1px" href="" class="nav-link">HỆ THỐNG ĐÁNH GIÁ NĂNG LỰC - CÔNG TY CỔ PHẦN TRAPHACO</a>
      </li>
      
    </ul>

    <!-- SEARCH FORM -->
    

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
      <!-- Messages Dropdown Menu -->
      
      <!-- Notifications Dropdown Menu -->
      
      
      <li class="nav-item dropdown">
        <a class="nav-link" data-toggle="dropdown" href="#">
          <i class="fas fa-user-circle"></i>
        </a>
        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
          
          
          <a href="<?php echo e(route('user.edit_normal_user')); ?>" class="dropdown-item">
            <i class="fas fa-envelope mr-2"></i> Thông tin cá nhân
          </a>
          <form action="<?php echo e(route('logout')); ?>" method="post">
            <?php echo csrf_field(); ?>
            <button type="submit" class="dropdown-item"><i class="fas fa-sign-out-alt"></i> Đăng xuất</button>
          </form>
        </div>
      </li>



    </ul>
  </nav>
  <!-- /.navbar --><?php /**PATH E:\DEV\Employees management\HR manager\resources\views/admin/partials/nav.blade.php ENDPATH**/ ?>