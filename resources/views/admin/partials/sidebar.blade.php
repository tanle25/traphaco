  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="{{route('home')}}" class="brand-link">
      <img src="{{asset('images/favicon.ico')}}" alt="traphaco Logo" class="brand-image img-circle "
           style="opacity: .8">
      <span class="brand-text font-weight-light">TRAPHACO {{Auth::user()->is_admin == 1 ? 'ADMIN' : 'USER'}}</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="{{asset('template/AdminLTE/dist/img/user6-128x128.jpg')}}" class="img-circle elevation-2" alt="User Image'">
        </div>
        <div class="info">
          <a href="#" class="d-block">{{Auth::user()->fullname}}</a>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->

          @if (Auth::user()->is_admin == 1)
          <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
              <i class="nav-icon far fa-id-badge"></i> 
              <p>
                Khách hàng
                <i class="fa fa-angle-right right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              @can('xem khách hàng')
              <li class="nav-item">
                <a href="{{route('admin.customer.index')}}" class="nav-link">
                  <p>
                    Danh sách khách hàng
                  </p>
                </a>
              </li>
              @endcan
              
              @can('xem thống kê khách hàng')
              <li class="nav-item">
                <a href="{{route('admin.customer_test.index')}}" class="nav-link">
                  <p>Báo cáo khảo sát</p>
                </a>
              </li>  
              @endcan
              

              <li class="nav-item">
                <a href="{{route('history.customer_info_history')}}" class="nav-link">
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

              @can('xem đợt đánh giá')
              <li class="nav-item">
                <a href="{{route('admin.survey_round.index')}}" class="nav-link">
                  <p>Đợt đánh giá</p>
                </a>
              </li>  
              @endcan
              
              @can('xem bộ đề')
              <li class="nav-item">
                <a href="{{route('admin.survey.index')}}" class="nav-link">
                  <p>Bài đánh giá</p>
                </a>
              </li>  
              @endcan
              
              @can('xem báo cáo đợt đánh giá')
              <li class="nav-item">
                <a href="{{route('result.index')}}" class="nav-link">
                  <p>Báo cáo đánh giá</p>
                </a>
              </li>  
              @endcan
              
              
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
              @can('xem phòng ban')
              <li class="nav-item">
                <a href="{{route('admin.department.index')}}" class="nav-link">
                  <p>Quản lý phòng ban</p> 
                </a>
              </li>  
              @endcan
              
              @can('xem user')
              <li class="nav-item">
                <a href="{{route('admin.usermanage.index')}}" class="nav-link">
                  <p>Quản lý người dùng</p>
                </a>
              </li>  
              @endcan
              
              @can('xem user')
              <li class="nav-item">
                <a href="{{route('admin.permission.index')}}" class="nav-link">
                  <p>Quản lý phân quyền</p>
                </a>
              </li>  
              @endcan
              

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
                <a href="{{route('answer.index', ['marked' => 0])}}" class="nav-link">
                  <p>
                    Bài đánh giá chưa làm
                  </p>
                </a>
              </li>

              <li class="nav-item">
                <a href="{{route('answer.index', ['marked' => 1])}}" class="nav-link">
                  <p>
                    Bài đánh giá đã làm
                  </p>
                </a>
              </li>

              <li class="nav-item">
                <a href="{{route('result.index')}}" class="nav-link">
                  <p>Thống kê cá nhân</p>
                </a>
              </li>
            </ul>
          </li>
          @endif
          @if (Auth::user()->is_admin !== 1)
          {{-- <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
              <i class="nav-icon far fa-id-badge"></i> 
              <p>
                Khách hàng
                <i class="fa fa-angle-right right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{route('admin.customer.index')}}" class="nav-link">
                  <p>
                    Danh sách khách hàng
                  </p>
                </a>
              </li>

            </ul>
          </li> --}}
          <li class="nav-item has-treeview">
            <a href="{{route('answer.index', ['marked' => 0])}}" class="nav-link">
              <i class="nav-icon fas fa-marker"></i> 
              <p>
                Bài đánh giá chưa làm
              </p>
            </a>
          </li>

          <li class="nav-item has-treeview">
            <a href="{{route('answer.index', ['marked' => 1])}}" class="nav-link">
              <i class="nav-icon fas fa-tasks"></i> 
              <p>
                Bài đánh giá đã làm
              </p>
            </a>
          </li>
          <li class="nav-item has-treeview">
            <a href="{{route('result.index')}}" class="nav-link">
              <i class="nav-icon far fa-id-badge"></i> 
              <p>
                Thống kế cá nhân
              </p>
            </a>
          </li>
          @endif

        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>
