<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    @yield('title')
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.5 -->
    <link rel="stylesheet" href="{{ url('admin/bootstrap/css/bootstrap.min.css') }}">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ url('admin/dist/css/AdminLTE.min.css') }}">
    <!-- AdminLTE Skins. Choose a skin from the css/skins
         folder instead of downloading all of them to reduce the load. -->
    <link rel="stylesheet" href="{{ url('admin/dist/css/skins/_all-skins.min.css') }}">
    <!-- iCheck -->
    <link rel="stylesheet" href="{{ url('admin/plugins/iCheck/all.css') }}">
    <!-- Dropxone -->
    <link rel="stylesheet" href="{{ url('admin/plugins/dropzone/dropzone.min.css') }}">

    {{--
    <!-- Morris chart -->
    <link rel="stylesheet" href="{{ url('admin/plugins/morris/morris.css') }}"> 
    <!-- jvectormap -->
    <link rel="stylesheet" href="{{ url('admin/plugins/jvectormap/jquery-jvectormap-1.2.2.css') }}">
    <!-- Date Picker -->
    <link rel="stylesheet" href="{{ url('admin/plugins/datepicker/datepicker3.css') }}"> 
    
    <!-- bootstrap wysihtml5 - text editor -->
    <link rel="stylesheet" href="{{ url('admin/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css') }}"> 
    --}}
    <!-- Daterange picker -->
    <link rel="stylesheet" href="{{ url('admin/plugins/daterangepicker/daterangepicker-bs3.css') }}"> 
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css">
    <!-- DataTables -->
    <link rel="stylesheet" href="{{ url('admin/plugins/datatables/dataTables.bootstrap.css') }}">
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js') }}"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js') }}"></script>
    <![endif]-->
  </head>
  <body class="hold-transition skin-blue sidebar-mini">
    <div class="wrapper">
      <!-- HEADER -->
      @include('admin.header')
      
      <!-- Left side column. contains the logo and sidebar -->
      @include('admin.aside')

      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        @yield('breadcrumb')

        <!-- Main content -->
        <section class="content">
          
          @yield('content')

          <div class="modal fade in" id="ajaxProgressModal">
                <center>
                    <div class="modal-body" style="">
                        <p class="text text-capitalize" id="modal_status_text" style="color:white;"><i class="fa fa-spin"></i> Processing...</p>
                    </div>
                </center>
          </div>
        </section><!-- /.content -->
      </div><!-- /.content-wrapper -->
      <footer class="main-footer">
        <div class="pull-right hidden-xs">
          <b>Version</b> 1.0.0
        </div>
        <strong>Copyright &copy; 2017 - 2018 <a href="#">SAG PLC</a>.</strong> All rights reserved.
      </footer>
    </div><!-- ./wrapper -->

    <!-- jQuery 2.1.4 -->
    <script src="{{ url('admin/plugins/jQuery/jQuery-2.1.4.min.js') }}"></script>
    <!-- jQuery UI 1.11.4 -->
    <script src="https://code.jquery.com/ui/1.11.4/jquery-ui.min.js"></script>
    <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
    <script>
      $.widget.bridge('uibutton', $.ui.button);
    </script>
    <!-- Bootstrap 3.3.5 -->
    <script src="{{ url('admin/bootstrap/js/bootstrap.min.js') }}"></script>
    <!-- DataTables -->
    <script src="{{ url('admin/plugins/datatables/jquery.dataTables.min.js')}}"></script>
    <script src="{{ url('admin/plugins/datatables/dataTables.bootstrap.min.js')}}"></script>
    {{--
        <!-- Morris.js charts -->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
        <script src="{{ url('admin/plugins/morris/morris.min.js') }}"></script>
        <!-- Sparkline -->
        <script src="{{ url('admin/plugins/sparkline/jquery.sparkline.min.js') }}"></script>
        <!-- jvectormap -->
        <script src="{{ url('admin/plugins/jvectormap/jquery-jvectormap-1.2.2.min.js') }}"></script>
        <script src="{{ url('admin/plugins/jvectormap/jquery-jvectormap-world-mill-en.js') }}"></script>
        <!-- jQuery Knob Chart -->
        <script src="{{ url('admin/plugins/knob/jquery.knob.js') }}"></script>
    
        <!-- datepicker -->
        <script src="{{ url('admin/plugins/datepicker/bootstrap-datepicker.js') }}"></script>
        <!-- Bootstrap WYSIHTML5 -->
        <script src="{{ url('admin/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js') }}"></script>
    --}}    
    <!-- daterangepicker -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.10.2/moment.min.js"></script>
    <script src="{{ url('admin/plugins/daterangepicker/daterangepicker.js') }}"></script>
    <!-- Slimscroll -->
    <script src="{{ url('admin/plugins/slimScroll/jquery.slimscroll.min.js') }}"></script>
    <!-- FastClick -->
    <script src="{{ url('admin/plugins/fastclick/fastclick.min.js') }}"></script>
    <!-- AdminLTE App -->
    <script src="{{ url('admin/dist/js/app.min.js') }}"></script>
    <!-- iCheck 1.0.1 -->
    <script src="{{ url('admin/plugins/iCheck/icheck.min.js') }}"></script>
    {{--
        <!-- AdminLTE dashboard demo (This is only for demo purposes) -->
        <script src="{{ url('admin/dist/js/demo.js') }}"></script> 
        <script src="{{ url('admin/dist/js/pages/dashboard.js') }}"></script>
    --}}
    <script src="{{ url('js/jquery.ajax-progress.js') }}"></script>
    <!-- AdminLTE for demo purposes -->
    <script src="{{ url('admin/plugins/ckeditor/ckeditor.js') }}"></script>
    <script src="{{ url('admin/plugins/dropzone/dropzone.min.js') }}"></script>
    <script type="" src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.1.3/toastr.min.js"></script>
    <script type="" src="https://cdnjs.cloudflare.com/ajax/libs/bootbox.js/4.4.0/bootbox.min.js"></script>
    

    @stack('scripts')
  </body>
</html>
