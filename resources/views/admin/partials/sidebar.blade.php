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
            <a href="{{route('admin.department.index')}}" class="nav-link">
              <i class="nav-icon far fa-building"></i> 
              <p>
                Quản lý phòng ban
              </p>
            </a>
            {{-- <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{route('admin.department.index')}}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Danh sách phòng ban</p>
                </a>
              </li>
            </ul> --}}
          </li>

          <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-user-tie"></i>
              <p>
                Quản lý người dùng
                <i class="fas fa-angle-left right"></i> 
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{route('admin.usermanage.index')}}" class="nav-link">
                  <i class="fas fa-list-ul nav-icon"></i>
                  <p>Danh sách người dùng</p>
                </a>
              </li>

              <li class="nav-item">
                <a href="{{route('admin.usermanage.create')}}" class="nav-link">
                  <i class="fas fa-user-plus nav-icon"></i>
                  <p>Thêm user mới</p> 
                </a>
              </li>

            </ul>
          </li>

          <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-book"></i>
              <p>
                Bài khảo sát
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{route('admin.survey.index')}}" class="nav-link">
                  <i class="fas fa-list-ul nav-icon"></i>
                  <p>Danh sách bài khảo sát</p>
                </a>
              </li>

              <li class="nav-item">
                <a href="{{route('admin.survey.create')}}" class="nav-link">
                  <i class="far fa-file nav-icon"></i>
                  <p>Thêm bài khảo sát</p>
                </a>
              </li>
              
            </ul>
          </li>

          <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
              <i class="nav-icon far fa-calendar-minus"></i>
              <p>
                Đợt khảo sát
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{route('admin.survey_round.index')}}" class="nav-link">
                  <i class="fas fa-list-ul nav-icon"></i>
                  <p>Danh sách đợt khảo sát</p>
                </a>
              </li>
              
              <li class="nav-item">
                <a href="{{route('admin.survey_round.create')}}" class="nav-link">
                  <i class="far fa-file nav-icon"></i>
                  <p>Mở đợt khảo sát</p>
                </a>
              </li>
              
            </ul>
          </li>

          <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
              <i class="nav-icon far fa-id-badge"></i> 
              <p>
                Khách hàng
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{route('admin.customer.index')}}" class="nav-link">
                  <i class="nav-icon fas fa-marker"></i> 
                  <p>
                    Quản lý khách hàng
                  </p>
                </a>
              </li>



              <li class="nav-item">
                <a href="{{route('result.index')}}" class="nav-link">
                  <i class="far fa-chart-bar nav-icon"></i>
                  <p>Thống kê cá nhân</p>
                </a>
              </li>
              
            </ul>
          </li>

          <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
              <i class="nav-icon far fa-id-badge"></i> 
              <p>
                Cá nhân
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{route('answer.index', ['marked' => 0])}}" class="nav-link">
                  <i class="nav-icon fas fa-marker"></i> 
                  <p>
                    Bài khảo sát chưa làm
                  </p>
                </a>
              </li>

              <li class="nav-item">
                <a href="{{route('answer.index', ['marked' => 1])}}" class="nav-link">
                  <i class="nav-icon fas fa-tasks"></i> 
                  <p>
                    Bài khảo sát đã làm
                  </p>
                </a>
              </li>

              <li class="nav-item">
                <a href="{{route('result.index')}}" class="nav-link">
                  <i class="far fa-chart-bar nav-icon"></i>
                  <p>Thống kê cá nhân</p>
                </a>
              </li>
            </ul>
          </li>
          @endif
          @if (Auth::user()->is_admin !== 1)
          <li class="nav-item has-treeview">
            <a href="{{route('answer.index', ['marked' => 0])}}" class="nav-link">
              <i class="nav-icon fas fa-marker"></i> 
              <p>
                Bài khảo sát chưa làm
              </p>
            </a>
          </li>

          <li class="nav-item has-treeview">
            <a href="{{route('answer.index', ['marked' => 1])}}" class="nav-link">
              <i class="nav-icon fas fa-tasks"></i> 
              <p>
                Bài khảo sát đã làm
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
