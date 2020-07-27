  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="<?php echo e(route('admin.home')); ?>" class="brand-link">
      <img src="<?php echo e(asset('template/AdminLTE/dist/img/AdminLTELogo.png')); ?>" alt="AdminLTE Logo" class="brand-image img-circle elevation-3"
           style="opacity: .8">
      <span class="brand-text font-weight-light">TRAPHACO USER</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="<?php echo e(asset('template/AdminLTE/dist/img/user6-128x128.jpg')); ?>" class="img-circle elevation-2" alt="User Image'">
        </div>
        <div class="info">
          <a href="#" class="d-block">Alexander Pierce</a>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-edit"></i>
              <p>
                Quản lý phòng ban
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="<?php echo e(route('admin.department.index')); ?>" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Danh sách phòng ban</p>
                </a>
              </li>
              
            </ul>
          </li>

          <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-edit"></i>
              <p>
                Quản lý người dùng
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="<?php echo e(route('admin.usermanage.index')); ?>" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Danh sách người dùng</p>
                </a>
              </li>

              <li class="nav-item">
                <a href="<?php echo e(route('admin.usermanage.create')); ?>" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Thêm user mới</p>
                </a>
              </li>

            </ul>
          </li>

          <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-edit"></i>
              <p>
                Quản lý khảo sát
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="<?php echo e(route('admin.survey.index')); ?>" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Danh sách bài khảo sát</p>
                </a>
              </li>

              <li class="nav-item">
                <a href="<?php echo e(route('admin.survey.create')); ?>" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Thêm bài khảo sát</p>
                </a>
              </li>
              
            </ul>
          </li>
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>
<?php /**PATH E:\DEV\Employees management\HR manager\resources\views/admin/partials/sidebar.blade.php ENDPATH**/ ?>