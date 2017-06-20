<header class="main-header">
  <!-- Logo -->
  <a href="{{ url('')}}" class="logo">
    <!-- mini logo for sidebar mini 50x50 pixels -->
    <span class="logo-mini"><b>S</b>AG</span>
    <!-- logo for regular state and mobile devices -->
    <span class="logo-lg"><b>SAG</b>&nbsp; PLC</span>
  </a>
  <!-- Header Navbar: style can be found in header.less -->
  <nav class="navbar navbar-static-top" role="navigation">
    <!-- Sidebar toggle button-->
    <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
      <span class="sr-only">Toggle navigation</span>
    </a>
    <div class="navbar-custom-menu">
      <ul class="nav navbar-nav">
        <li class="user user-menu bg-red">
          <a href="{{ url('logout') }}">
            <i class="fa fa-power-off"></i>
            <span class="hidden-xs">Logout</span>
          </a>
        </li>
        {{-- 
          <li class="dropdown user user-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <img src="{{ url('admin/dist/img/avatar.png') }}" class="user-image" alt="User Image">
              <span class="hidden-xs">Alexander Pierce</span>
            </a>
            <ul class="dropdown-menu">
              <!-- User image -->
              <li class="user-header">
                <img src="{{ url('admin/dist/img/avatar.png') }}" class="img-circle" alt="User Image">
                <p>
                  Alexander Pierce - General Manager
                  <small>Member since Nov. 2012</small>
                </p>
              </li>
              
              <li class="user-footer">
                <div class="pull-left">
                  <a href="#" class="btn btn-success btn-flat">Profile</a>
                </div>
                <div class="pull-right">
                  <a href="{{ url('logout') }}" class="btn btn-danger btn-flat">Sign out</a>
                </div>
              </li>
            </ul>
          </li>
        --}}
      </ul>
    </div>
  </nav>
</header>
