<aside class="main-sidebar">
  <!-- sidebar: style can be found in sidebar.less -->
  <section class="sidebar">
    <!-- Sidebar user panel -->
    {{--<div class="user-panel">
      
        <div class="pull-left image">
          <img src="{{ url('admin/dist/img/avatar.png') }}" class="img-circle" alt="User Image">
        </div>
        <div class="pull-left info">
          <p>Alexander Pierce</p>
          <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
        </div>
      
    </div>--}}
    <!-- search form -->
    <p class="text-center" style="color: white; margin-top:10px;">Search SAG</p>
    {!! Form::open(['url' => 'admin/search', 'class'=>'sidebar-form']) !!}
      <div class="input-group">
        <input type="text" name="search" class="form-control" placeholder="Search..." required>
        <span class="input-group-btn">
          <button type="submit" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i></button>
        </span>
      </div>
    {!! Form::close() !!}
    <!-- /.search form -->
    <!-- sidebar menu: : style can be found in sidebar.less -->
    <ul class="sidebar-menu">
      <li class="header">MAIN NAVIGATION</li>
      <li class="active">
        <a href="{{ url('home') }}">
          <i class="fa fa-dashboard"></i> <span>Dashboard</span>
        </a>
      </li>
      <li>
        <a href="{{ url('admin/events') }}">
          <i class="fa fa-flag"></i> <span>Events</span> <small class="label pull-right bg-green">{{ App\Event::where('event_type', 1)->count() }}</small>
        </a>
      </li>
      <li>
        <a href="{{ url('admin/tradeshows') }}">
          <i class="fa fa-table"></i> <span>Tradeshows</span> <small class="label pull-right bg-red">{{ App\Event::where('event_type', 2)->count() }}</small>
        </a>
      </li>
      <li>
        <a href="{{ url('admin/ads') }}">
          <i class="fa fa-buysellads"></i> <span>Ads</span> <small class="label pull-right label-primary">{{ App\Ad::count() }}</small>
        </a>
      </li>
      <li>
        <a href="{{ url('admin/gallery')}}">
          <i class="fa  fa-file-image-o"></i> <span>Photo Gallery</span> <small class="label pull-right label-primary"></small>
        </a>
      </li>
      <li>
        <a href="{{ url('admin/subscribers')}}">
          <i class="fa fa-users"></i> <span>Subscribers</span> <small class="label pull-right label-primary">{{ App\Subscription::count() }}</small>
        </a>
      </li>
      
      
    </ul>
  </section>
  <!-- /.sidebar -->
</aside>