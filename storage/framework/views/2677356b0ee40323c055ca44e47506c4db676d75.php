  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-dark navbar-teal" style="background-color: #008a43; color:white">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a style="color:white" class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a style="color:white; letter-spacing:1px" href="" class="nav-link">CÔNG TY CỔ PHẦN TRAPHACO</a>
      </li>
      
    </ul>

    <!-- SEARCH FORM -->
    

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
      <!-- Messages Dropdown Menu -->
      
      <!-- Notifications Dropdown Menu -->
      
      
      <li class="nav-item dropdown">
        <a class="nav-link" data-toggle="dropdown" href="#">
          <i class="far fa-user"></i>
        </a>
        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
          
          
          <form action="<?php echo e(route('logout')); ?>" method="post">
            <?php echo csrf_field(); ?>
            <button type="submit" class="dropdown-item text-center">Đăng xuất</button>
          </form>
        </div>
      </li>



    </ul>
  </nav>
  <!-- /.navbar --><?php /**PATH E:\DEV\Employees management\HR manager\resources\views/admin/partials/nav.blade.php ENDPATH**/ ?>