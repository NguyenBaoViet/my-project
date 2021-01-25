  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="index3.html" class="brand-link">
      <img src="{{asset('Admin/dist/img/AdminLTELogo.png')}}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3"
           style="opacity: .8">
      <span class="brand-text font-weight-light">AdminLTE 3</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="{{asset('Admin/dist/img/user2-160x160.jpg')}}" class="img-circle elevation-2" alt="User Image">
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
          @can('list-category')
          <li class="nav-item">
            <a href="{{route('category.index')}}" class="nav-link">
              <i class="nav-icon fas fa-th"></i>
              <p>Danh mục sản phẩm</p>
            </a>
          </li>
          @endcan
          @can('list-menu')
          <li class="nav-item">
            <a href="{{route('menus.index')}}" class="nav-link">
              <i class="nav-icon fas fa-th"></i>
              <p>Menu</p>
            </a>
          </li>
          @endcan
          @can('list-product')
          <li class="nav-item">
            <a href="{{route('products.index')}}" class="nav-link">
              <i class="nav-icon fas fa-th"></i>
              <p>Product</p>
            </a>
          </li>
          @endcan
          @can('list-slider')
          <li class="nav-item">
            <a href="{{route('sliders.index')}}" class="nav-link">
              <i class="nav-icon fas fa-th"></i>
              <p>Slider</p>
            </a>
          </li>
          @endcan
          <li class="nav-item">
            <a href="{{route('settings.index')}}" class="nav-link">
              <i class="nav-icon fas fa-th"></i>
              <p>Setting</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{route('users.index')}}" class="nav-link">
              <i class="nav-icon fas fa-th"></i>
              <p>Danh sách nhân viên</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{route('roles.index')}}" class="nav-link">
              <i class="nav-icon fas fa-th"></i>
              <p>Danh sách vai trò</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{route('permissions.create')}}" class="nav-link">
              <i class="nav-icon fas fa-th"></i>
              <p>Tạo permissions</p>
            </a>
          </li>
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>