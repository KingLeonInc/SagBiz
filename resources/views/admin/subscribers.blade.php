@extends('admin.adminmaster')

@section('title')
	<title>Subscribers | SAG PLC</title>
@endsection

@section('breadcrumb')
  <section class="content-header">
      <h1>
        Subscribers
        <small>SAG PLC</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="{{ url('home')}}"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="{{ url('admin/subscribers')}}"><i class="fa fa-users"></i> Subscribers</a></li>
      </ol>
  </section>
@endsection

@section('content')
	
	<div class="row">
		<div class="col-md-3 col-sm-6 col-xs-12">
          <div class="info-box bg-yellow">
            <span class="info-box-icon">
            	@if($results['title'] == 'Events')
            		<a href="{{ url('admin/event/create') }}" style="color: white;"><i class="fa fa-plus"></i></a>
            	@else
            		<a href="{{ url('admin/tradeshow/create') }}" style="color: white;"><i class="fa fa-plus"></i></a>
            	@endif
            </span> 
            <div class="info-box-content">
              <span class="info-box-text">Total Subscribers</span>
              <span class="info-box-number">{{ $results['subscribers']['total'] }}</span>
              <div class="progress">
                <div class="progress-bar" style="width: 100%"></div>
              </div>
              <span class="progress-description">
              	@if($results['title'] == 'Events')
                	<a href="{{ url('admin/event/create') }}" style="color: white;"> Create New</a>
                @else
                	<a href="{{ url('admin/tradeshow/create') }}" style="color: white;"> Create New</a>
                @endif
              </span>
            </div> <!--/.info-box-content -->
          </div><!-- /.info-box -->
        </div>
        <div class="col-md-3 col-sm-6 col-xs-6">
          <div class="info-box bg-green">
            <span class="info-box-icon"><i class="fa fa-bookmark-o"></i></span>
            <div class="info-box-content">
              <span class="info-box-text">Last Week</span>
              <span class="info-box-number">{{ $results['subscribers']['last_week'] }}</span>
              <div class="progress">
              	@if($results['subscribers']['total'] == 0)
                	<div class="progress-bar" style="width: 0%"></div>
                @else
                	<div class="progress-bar" style="width: {{ (int)($results['subscribers']['last_week']/$results['subscribers']['total']*100) }}%"></div>
                @endif
              </div>
              <span class="progress-description">
                Subscribers
              </span>
            </div><!-- /.info-box-content -->
          </div><!-- /.info-box -->
        </div><!-- /.col -->
        <div class="col-md-3 col-sm-6 col-xs-6">
          <div class="info-box bg-aqua">
            <span class="info-box-icon"><i class="fa fa-thumbs-o-up"></i></span>
            <div class="info-box-content">
              <span class="info-box-text">Past Month</span>
              <span class="info-box-number">{{ $results['subscribers']['last_month'] }}</span>
              <div class="progress">
	              @if($results['subscribers']['total'] == 0)
		           	<div class="progress-bar" style="width: 0%"></div>
		          @else
		           	<div class="progress-bar" style="width: {{ (int)($results['subscribers']['last_month']/$results['subscribers']['total']*100) }}%"></div>
		          @endif
		      </div>
              <span class="progress-description">
                Subscribers
              </span>
            </div><!-- /.info-box-content -->
          </div><!-- /.info-box -->
        </div><!-- /.col -->
        <div class="col-md-3 col-sm-6 col-xs-6">
          <div class="info-box bg-red">
            <span class="info-box-icon"><i class="fa fa-calendar"></i></span>
            <div class="info-box-content">
              <span class="info-box-text">Past Year</span>
              <span class="info-box-number">{{ $results['subscribers']['last_year'] }}</span>
              <div class="progress">
                @if($results['subscribers']['total'] == 0)
                	<div class="progress-bar" style="width: 0%"></div>
                @else
                	<div class="progress-bar" style="width: {{ (int)($results['subscribers']['last_year']/$results['subscribers']['total']*100) }}%"></div>
                @endif
              </div>
              <span class="progress-description">
                Subscribers
              </span>
            </div><!-- /.info-box-content -->
          </div><!-- /.info-box -->
        </div><!-- /.col -->
        
    </div><!-- /.row -->
	
    <hr>

	<!-- DATATABLE -->
	<div class="row">
		@if($results['subscribers']['total'] != 0)
		    <div class="col-xs-12">
		      <div class="box">
		        <div class="box-header">
		          <h3 class="box-title">Subscribers</h3>
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
		          <table id="sag-subscribers-table" class="table table-hover">
			            <thead>
				            <tr>
				              <th>ID</th>
				              <th>Name</th>
				              <th>Email</th>
				              <th class="text-center" style="width: 100px;">Subscribed On</th>
				              <th>Status</th>
				              <th class="text-center" style="width: 100px;">Action</th>
				            </tr>
				        </thead>
			            <tbody>
				        </tbody>
				        <tfoot>
				            <tr>
				              <th>ID</th>
				              <th>Name</th>
				              <th>Email</th>
				              <th class="text-center" style="width: 100px;">Subscribed On</th>
				              <th>Status</th>
				              <th class="text-center" style="width: 100px;">Action</th>
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
	              <h3><i class="fa fa-warning text-yellow"></i> Oops! No Subscribers found.</h3>
	              <p>It seems like no one has subscribed to any newslleter yet.</p>
	            </div><!-- /.error-content -->
	        </div><!-- /.error-page -->
	    @endif
	</div>
	
@endsection

@push('scripts')

<script>
	function loadSagSubscribers() {
	  $('#sag-subscribers-table').DataTable({
	      processing: true,
	      serverSide: true,
	      destroy: true,
	      ajax: "{{ url('datatables/get-all-subscribers') }}",
	      columns: [
	          {data: 'sid', name: 'sid'},
	          {data: 'name', name: 'name'},
	          {data: 'email', name: 'email'},
	          {data: 'created_at', name: 'created_at'},
	          {data: 'status', name: 'status'},
	          {data: 'action', name: 'action'}
	      ]
	  });
	}
	function deleteSagSubscriber(subsn_id){
	  bootbox.confirm({
	      title: "<h2>Delete Subscriber!</h2>",
	      message: "Are you sure you want to delete this Subscriber? <br> This action is irrivercible.",
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
		            url: "{{ url('admin/delete-subscriber')}}/"+subsn_id,
		            success: function(data){
		              if(data.success){
		                toastr.success(data.msg, 'Success');
		                $(location).attr('href', "{{ url('admin/subscribers') }}");
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
	    
	    loadSagSubscribers();

	  });

	  // -------------------
	  (function() {
	    
	    
	  })();

	})(document, window, jQuery);
</script>
@endpush