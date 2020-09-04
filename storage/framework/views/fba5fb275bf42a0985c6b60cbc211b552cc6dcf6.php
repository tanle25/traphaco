  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="<?php echo e(route('home')); ?>" class="brand-link">
      <img src="<?php echo e(asset('images/favicon.ico')); ?>" alt="traphaco Logo" class="brand-image img-circle "
           style="opacity: .8">
      <span class="brand-text font-weight-light">TRAPHACO <?php echo e(Auth::user()->is_admin == 1 ? 'ADMIN' : 'USER'); ?></span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="<?php echo e(asset('template/AdminLTE/dist/img/user6-128x128.jpg')); ?>" class="img-circle elevation-2" alt="User Image'">
        </div>
        <div class="info">
          <a href="#" class="d-block"><?php echo e(Auth::user()->fullname); ?></a>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->

          <?php if(Auth::user()->is_admin == 1): ?>
          <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
              <i class="nav-icon far fa-id-badge"></i> 
              <p>
                Khách hàng
                <i class="fa fa-angle-right right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('xem khách hàng')): ?>
              <li class="nav-item">
                <a href="<?php echo e(route('admin.customer.index')); ?>" class="nav-link">
                  <p>
                    Danh sách khách hàng
                  </p>
                </a>
              </li>
              <?php endif; ?>
              
              <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('xem thống kê khách hàng')): ?>
              <li class="nav-item">
                <a href="<?php echo e(route('admin.customer_test.index')); ?>" class="nav-link">
                  <p>Báo cáo khảo sát</p>
                </a>
              </li>  
              <?php endif; ?>
              

              <li class="nav-item">
                <a href="<?php echo e(route('history.customer_info_history')); ?>" class="nav-link">
                  <p>Lịch sử</p></p>
                </a>
              </li>
            </ul>
          </li>

          <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-book"></i>
              <p>
                Quản lý đánh giá
                <i class="fa fa-angle-right right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">

              <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('xem đợt đánh giá')): ?>
              <li class="nav-item">
                <a href="<?php echo e(route('admin.survey_round.index')); ?>" class="nav-link">
                  <p>Đợt đánh giá</p>
                </a>
              </li>  
              <?php endif; ?>
              
              <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('xem bộ đề')): ?>
              <li class="nav-item">
                <a href="<?php echo e(route('admin.survey.index')); ?>" class="nav-link">
                  <p>Bài đánh giá</p>
                </a>
              </li>  
              <?php endif; ?>
              
              <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('xem báo cáo đợt đánh giá')): ?>
              <li class="nav-item">
                <a href="<?php echo e(route('result.index')); ?>" class="nav-link">
                  <p>Báo cáo đánh giá</p>
                </a>
              </li>  
              <?php endif; ?>
              
              
            </ul>
          </li>

          <li class="nav-item has-treeview">
            
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-cogs"></i>
              <p>
                Quản lý hệ thống
                <i class="fa fa-angle-right right"></i> 
              </p>
            </a>

            <ul class="nav nav-treeview">
              <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('xem phòng ban')): ?>
              <li class="nav-item">
                <a href="<?php echo e(route('admin.department.index')); ?>" class="nav-link">
                  <p>Quản lý phòng ban</p> 
                </a>
              </li>  
              <?php endif; ?>
              
              <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('xem người dùng')): ?>
              <li class="nav-item">
                <a href="<?php echo e(route('admin.usermanage.index')); ?>" class="nav-link">
                  <p>Quản lý người dùng</p>
                </a>
              </li>  
              <?php endif; ?>
              
              <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('xem người dùng')): ?>
              <li class="nav-item">
                <a href="<?php echo e(route('admin.permission.index')); ?>" class="nav-link">
                  <p>Quản lý phân quyền</p>
                </a>
              </li>  
              <?php endif; ?>
              

            </ul>
          </li>

          <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-user"></i> 
              <p>
                Cá nhân
                <i class="fa fa-angle-right right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="<?php echo e(route('answer.index', ['marked' => 0])); ?>" class="nav-link">
                  <p>
                    Bài đánh giá chưa làm
                  </p>
                </a>
              </li>

              <li class="nav-item">
                <a href="<?php echo e(route('answer.index', ['marked' => 1])); ?>" class="nav-link">
                  <p>
                    Bài đánh giá đã làm
                  </p>
                </a>
              </li>

              <li class="nav-item">
                <a href="<?php echo e(route('result.index')); ?>" class="nav-link">
                  <p>Thống kê cá nhân</p>
                </a>
              </li>
            </ul>
          </li>
          <?php endif; ?>
          <?php if(Auth::user()->is_admin !== 1): ?>
          <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
              <i class="nav-icon far fa-id-badge"></i> 
              <p>
                Khách hàng
                <i class="fa fa-angle-right right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="<?php echo e(route('admin.customer.index')); ?>" class="nav-link">
                  <p>
                    Danh sách khách hàng
                  </p>
                </a>
              </li>

            </ul>
          </li>
          <li class="nav-item has-treeview">
            <a href="<?php echo e(route('answer.index', ['marked' => 0])); ?>" class="nav-link">
              <i class="nav-icon fas fa-marker"></i> 
              <p>
                Bài đánh giá chưa làm
              </p>
            </a>
          </li>

          <li class="nav-item has-treeview">
            <a href="<?php echo e(route('answer.index', ['marked' => 1])); ?>" class="nav-link">
              <i class="nav-icon fas fa-tasks"></i> 
              <p>
                Bài đánh giá đã làm
              </p>
            </a>
          </li>
          <li class="nav-item has-treeview">
            <a href="<?php echo e(route('result.index')); ?>" class="nav-link">
              <i class="nav-icon far fa-id-badge"></i> 
              <p>
                Thống kế cá nhân
              </p>
            </a>
          </li>
          <?php endif; ?>

          
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>
<?php /**PATH E:\DEV\Employees management\HR manager\resources\views/admin/partials/sidebar.blade.php ENDPATH**/ ?>