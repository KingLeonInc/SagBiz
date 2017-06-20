@extends('admin.adminmaster')

@section('title')
	<title>{{ $results['title'] }} | SAG PLC</title>
@endsection

@section('breadcrumb')
  <section class="content-header">
      <h1>
        {{ $results['title'] }}
        <small>SAG PLC</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="{{ url('home')}}"><i class="fa fa-dashboard"></i> Home</a></li>
    	<li><a href="{{ url('admin/ads')}}"><i class="fa fa-flag"></i> {{ $results['title'] }}</a></li>
    	<li class="active"><a href="{{ url('admin/ad/create')}}"><i class="fa fa-plus"></i> Create an Ad</a></li>
      </ol>
  </section>
@endsection

@section('content')
	
	<div class="row">
		<div class="col-md-6">
          <!-- Widget: user widget style 1 -->
          <div class="box box-widget widget-user">
            <!-- Add the bg color to the header using any of the bg-* classes -->
            <div class="widget-user-header bg-aqua-active">
              <h3 class="widget-user-username">{{ $results['counts']['photo_ads']['total'] }}</h3>
              <h5 class="widget-user-desc">Photo Ads</h5>
            </div>
            <div class="widget-user-image">
              <img class="img-circle" src="{{ url('images/photo-ads.png')}}" alt="User Avatar">
            </div>
            <div class="box-footer">
              <div class="row">
                <div class="col-sm-4 border-right">
                  <div class="description-block">
                    <h5 class="description-header">{{ $results['counts']['photo_ads']['ongoing'] }}</h5>
                    <span class="description-text">ONGOING</span>
                  </div><!-- /.description-block -->
                </div><!-- /.col -->
                <div class="col-sm-4 border-right">
                  <div class="description-block">
                    <h5 class="description-header">{{ $results['counts']['photo_ads']['upcoming'] }}</h5>
                    <span class="description-text">UPCOMING</span>
                  </div><!-- /.description-block -->
                </div><!-- /.col -->
                <div class="col-sm-4">
                  <div class="description-block">
                    <h5 class="description-header">{{ $results['counts']['photo_ads']['past'] }}</h5>
                    <span class="description-text">PAST</span>
                  </div><!-- /.description-block -->
                </div><!-- /.col -->
              </div><!-- /.row -->
            </div>
          </div><!-- /.widget-user -->
        </div>
        <div class="col-md-6">
          <!-- Widget: user widget style 1 -->
          <div class="box box-widget widget-user">
            <!-- Add the bg color to the header using any of the bg-* classes -->
            <div class="widget-user-header bg-aqua-active">
              <h3 class="widget-user-username">{{ $results['counts']['video_ads']['total'] }}</h3>
              <h5 class="widget-user-desc">Video Ads</h5>
            </div>
            <div class="widget-user-image">
              <img class="img-circle" src="{{ url('images/video-ads.png')}}" alt="User Avatar">
            </div>
            <div class="box-footer">
              <div class="row">
                <div class="col-sm-4 border-right">
                  <div class="description-block">
                    <h5 class="description-header">{{ $results['counts']['video_ads']['ongoing'] }}</h5>
                    <span class="description-text">ONGOING</span>
                  </div><!-- /.description-block -->
                </div><!-- /.col -->
                <div class="col-sm-4 border-right">
                  <div class="description-block">
                    <h5 class="description-header">{{ $results['counts']['video_ads']['upcoming'] }}</h5>
                    <span class="description-text">UPCOMING</span>
                  </div><!-- /.description-block -->
                </div><!-- /.col -->
                <div class="col-sm-4">
                  <div class="description-block">
                    <h5 class="description-header">{{ $results['counts']['video_ads']['past'] }}</h5>
                    <span class="description-text">PAST</span>
                  </div><!-- /.description-block -->
                </div><!-- /.col -->
              </div><!-- /.row -->
            </div>
          </div><!-- /.widget-user -->
        </div>
        <div class="clearfix"></div>
        
    </div><!-- /.row -->
	
    <hr>

	<!-- DATATABLE -->
	<div class="row">
		@if($results['counts']['total'] != 0)
		    <div class="col-xs-12">
		      <div class="box">
		        <div class="box-header">
		          <h3 class="box-title">{{ $results['title'] }}</h3>
		          <!-- <div class="box-tools">
		            <div class="input-group input-group-sm" style="width: 150px;">
		              <input type="text" name="table_search" class="form-control pull-right" placeholder="Search">
		              <div class="input-group-btn">
		                <button type="submit" class="btn btn-default"><i class="fa fa-search"></i></button>
		              </div>
		            </div>
		          </div> -->
		        </div><!-- /.box-header -->
		        <div class="box-body table-responsive">
		          <table id="sag-ads-table" class="table table-hover">
			            <thead>
				            <tr>
				              <th>ID</th>
				              <th>{{ $results['title'] }} Title</th>
				              <th>{{ $results['title'] }} Type</th>
				              <th class="text-center" style="width: 100px;">Date</th>
				              <th>Status</th>
				              <th class="text-center" style="width: 200px;">Action</th>
				            </tr>
				        </thead>
			            <tbody>
				        </tbody>
				        <tfoot>
				            <tr>
				              <th>ID</th>
				              <th>{{ $results['title'] }} Title</th>
				              <th>{{ $results['title'] }} Type</th>
				              <th class="text-center" style="width: 100px;">Date</th>
				              <th>Status</th>
				              <th class="text-center" style="width: 200px;">Action</th>
				            </tr>
				        </tfoot>
				   </table>
		        </div><!-- /.box-body -->
		      </div><!-- /.box -->
		    </div>
	    @else
	    	<div class="error-page">
	            <h2 class="headline text-yellow"> <i class="fa fa-times-circle-o"></i></h2>
	            <div class="error-content">
	              <h3><i class="fa fa-warning text-yellow"></i> Oops! No {{ $results['title'] }} found.</h3>
	              <p>
	                It looks like you've not created any ad yet. You can go ahead and create a new one now.
	              </p>
	              <a href="{{ url('admin/ad/create') }}" class="btn btn-warning btn-block btn-flat">Create an Ad</a>
	            </div><!-- /.error-content -->
	        </div><!-- /.error-page -->
	    @endif
	</div>
	
@endsection

@push('scripts')

<script>
	function loadAds() {
	  $('#sag-ads-table').DataTable({
	      processing: true,
	      serverSide: true,
	      destroy: true,
	      ajax: "{{ url('datatables/get-all-ads/') }}",
	      columns: [
	          {data: 'ad_id', name: 'ad_id'},
	          {data: 'ad_title', name: 'ad_title'},
	          {data: 'ad_type', name: 'ad_type'},
	          {data: 'date_range', name: 'date_range'},
	          {data: 'status', name: 'status'},
	          {data: 'action', name: 'action'}
	      ]
	  });
	}
	function deleteAd(addId){
	  bootbox.confirm({
	      title: "<h2>Delete AD?</h2>",
	      message: "Are you sure you want to delete this ad? <br> This action is irrivercible.",
	      className: "modal-center example-modal-sm",
	      buttons: {
	          confirm: {
	              label: 'Yes',
	              className: 'btn-success'
	          },
	          cancel: {
	              label: 'No',
	              className: 'btn-danger'
	          }
	      },
	      callback: function (result) {
	          //console.log('This was logged in the callback: ' + result);
	          if (result == true) {
	            $.ajax({
		            type: 'GET',
		            url: "{{ url('admin/delete-ad')}}/"+addId,
		            success: function(data){
		              if(data.success){
		                toastr.success(data.msg, 'Success');
		                $(location).attr('href', "{{ url('admin/ads') }}");
		              }else{
		                toastr.error(data.msg, 'Error');
		              }
		            }
		        });
	          }
	      }
	  });
	}

	(function(document, window, $) {
	  
	  $(document).ready(function($) {
	    //Site.run();
	    
	    loadAds();

	  });

	  // -------------------
	  (function() {
	    
	    
	  })();

	})(document, window, jQuery);
</script>
@endpush