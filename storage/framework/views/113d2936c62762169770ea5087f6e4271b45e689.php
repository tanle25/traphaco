  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="<?php echo e(route('home')); ?>" class="brand-link">
      <img src="<?php echo e(asset('images/favicon.ico')); ?>" alt="traphaco Logo" class="brand-image img-circle "
           style="opacity: .8">
      <span class="brand-text font-weight-light">TRAPHACO</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3">
          <div class="d-flex user-panel" style="border-bottom: none">
          <div class="image d-flex align-items-center">
            <img src="<?php echo e(asset('images/user6-128x128.jpg')); ?>" class="img-circle elevation-2 d-block" alt="User Image'">
          </div>
          <div class="info">
            <a href="#" class="d-block font-weight-bold" style="font-size: 1.1rem"><?php echo e(Auth::user()->fullname); ?></a>
          </div>
        </div>
        
        <div class="info mt-1">
          <a class="d-block"><?php echo e(Auth::user()->department->department_name ?? ''); ?></a>
          <a class="d-block"><?php echo e(Auth::user()->position->name ?? ''); ?></a>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
               
          <li class="nav-item has-treeview">
            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->any(['xem khách hàng','xem thống kê khách hàng'])): ?>
            <a href="#" class="nav-link">
              <i class="nav-icon far fa-id-badge"></i> 
              <p>
                Khách hàng
                <i class="fa fa-angle-right right"></i>
              </p>
            </a>
            <?php endif; ?>
            

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
             
            </ul>
          </li>

          <li class="nav-item has-treeview">
            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->any(['xem đợt đánh giá','xem bộ đề','xem báo cáo đợt đánh giá'])): ?>
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-book"></i>
              <p>
                Quản lý đánh giá
                <i class="fa fa-angle-right right"></i>
              </p>
            </a>  
            <?php endif; ?>
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

              <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('xem báo cáo đợt đánh giá')): ?>
              <li class="nav-item">
                <a href="<?php echo e(route('statistic.assessment.show_form')); ?>" class="nav-link">
                  <p>Phân tích thống kê</p>
                </a>
              </li>  
              <?php endif; ?>
              
            </ul>
          </li>

          <li class="nav-item has-treeview">
            <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->any(['xem phòng ban', 'xem user', 'xem quyền'])): ?>
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-cogs"></i>
              <p>
                Quản lý hệ thống
                <i class="fa fa-angle-right right"></i> 
              </p>
            </a>
            <?php endif; ?>
            

            <ul class="nav nav-treeview">
              <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('xem phòng ban')): ?>
              <li class="nav-item">
                <a href="<?php echo e(route('admin.department.index')); ?>" class="nav-link">
                  <p>Quản lý phòng ban</p> 
                </a>
              </li>  
              <?php endif; ?>
              
              <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('xem user')): ?>
              <li class="nav-item">
                <a href="<?php echo e(route('admin.usermanage.index')); ?>" class="nav-link">
                  <p>Quản lý người dùng</p>
                </a>
              </li>  
              <?php endif; ?>
              
              <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('quản_lý quyền')): ?>
              <li class="nav-item">
                <a href="<?php echo e(route('admin.permission.index')); ?>" class="nav-link">
                  <p>Quản lý phân quyền</p>
                </a>
              </li>
              <?php endif; ?>
              

            </ul>
          </li>

          <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('quản_lý nội bộ phòng ban')): ?>
          <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-users"></i>
              <p>
                Báo cáo cho quản lý
                <i class="fa fa-angle-right right"></i> 
              </p>
            </a>            
            <?php
                $department = Auth::user()->department
            ?>
            <ul class="nav nav-treeview">

              <?php if (app(\Illuminate\Contracts\Auth\Access\Gate::class)->check('xem_bài_đánh_giá nội bộ phòng ban')): ?>
              <li class="nav-item">
                <a href="<?php echo e(route('admin.internal_department.show_user_test', $department->id ?? 0)); ?>" class="nav-link">
                  <p>Bài đánh giá của nhân viên</p> 
                </a>
              </li>    
              <?php endif; ?>            
            </ul>
          </li>
          <?php endif; ?>
          
          <?php if(Auth::user()->hasAnyPermission(['xem khách hàng','xem thống kê khách hàng','xem phòng ban', 'xem user', 'xem đợt đánh giá','xem bộ đề','xem báo cáo đợt đánh giá'])): ?>
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

            </ul>
          </li>
          <?php else: ?>
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
          <?php endif; ?>

        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>
<?php /**PATH /home/admin/web/dg.traphaco.vn/public_html/resources/views/admin/partials/sidebar.blade.php ENDPATH**/ ?>