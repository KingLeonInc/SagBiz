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
        @if( $results['title'] == 'Events' )
        	<li><a href="{{ url('admin/events')}}"><i class="fa fa-flag"></i> {{ $results['title'] }}</a></li>
        	<li class="active"><a href="{{ url('admin/event/create')}}"><i class="fa fa-plus"></i> Create Event</a></li>
        @else
        	<li><a href="{{ url('admin/tradeshows')}}"><i class="fa fa-flag"></i> {{ $results['title'] }}</a></li>
        	<li class="active"><a href="{{ url('admin/tradeshow/create')}}"><i class="fa fa-plus"></i> Create Tradeshow</a></li>
        @endif
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
              <span class="info-box-text">Total {{ $results['title'] }}</span>
              <span class="info-box-number">{{ $results['counts']['total'] }}</span>
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
              <span class="info-box-text">Ongoing</span>
              <span class="info-box-number">{{ $results['counts']['ongoing'] }}</span>
              <div class="progress">
              	@if($results['counts']['total'] == 0)
                	<div class="progress-bar" style="width: 0%"></div>
                @else
                	<div class="progress-bar" style="width: {{ (int)($results['counts']['ongoing']/$results['counts']['total']*100) }}%"></div>
                @endif
              </div>
              <span class="progress-description">
                {{ $results['title'] }}
              </span>
            </div><!-- /.info-box-content -->
          </div><!-- /.info-box -->
        </div><!-- /.col -->
        <div class="col-md-3 col-sm-6 col-xs-6">
          <div class="info-box bg-aqua">
            <span class="info-box-icon"><i class="fa fa-thumbs-o-up"></i></span>
            <div class="info-box-content">
              <span class="info-box-text">Upcoming</span>
              <span class="info-box-number">{{ $results['counts']['upcoming'] }}</span>
              <div class="progress">
	              @if($results['counts']['total'] == 0)
		           	<div class="progress-bar" style="width: 0%"></div>
		          @else
		           	<div class="progress-bar" style="width: {{ (int)($results['counts']['upcoming']/$results['counts']['total']*100) }}%"></div>
		          @endif
		      </div>
              <span class="progress-description">
                {{ $results['title'] }}
              </span>
            </div><!-- /.info-box-content -->
          </div><!-- /.info-box -->
        </div><!-- /.col -->
        <div class="col-md-3 col-sm-6 col-xs-6">
          <div class="info-box bg-red">
            <span class="info-box-icon"><i class="fa fa-calendar"></i></span>
            <div class="info-box-content">
              <span class="info-box-text">Past</span>
              <span class="info-box-number">{{ $results['counts']['past'] }}</span>
              <div class="progress">
                @if($results['counts']['total'] == 0)
                	<div class="progress-bar" style="width: 0%"></div>
                @else
                	<div class="progress-bar" style="width: {{ (int)($results['counts']['past']/$results['counts']['total']*100) }}%"></div>
                @endif
              </div>
              <span class="progress-description">
                {{ $results['title'] }}
              </span>
            </div><!-- /.info-box-content -->
          </div><!-- /.info-box -->
        </div><!-- /.col -->
        
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
		          <table id="sag-events-table" class="table table-hover">
			            <thead>
				            <tr>
				              <th>ID</th>
				              <th>{{ substr($results['title'], 0, strlen($results['title']) - 1) }} Title</th>
				              <th>{{ substr($results['title'], 0, strlen($results['title']) - 1) }} Host</th>
				              <th class="text-center" style="width: 80px;">Date</th>
				              <th>Status</th>
				              <th class="text-center" style="width: 300px;">Action</th>
				            </tr>
				        </thead>
			            <tbody>
				        </tbody>
				        <tfoot>
				            <tr>
				              <th>ID</th>
				              <th>{{ substr($results['title'], 0, strlen($results['title']) - 1) }} Title</th>
				              <th>{{ substr($results['title'], 0, strlen($results['title']) - 1) }} Host</th>
				              <th class="text-center" style="width: 80px;">Date</th>
				              <th>Status</th>
				              <th class="text-center" style="width: 300px;">Action</th>
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
	                It looks like you've not created any {{ strtolower(substr($results['title'], 0, strlen($results['title']) - 1)) }} yet. You can go ahead and create a new one now.
	              </p>
	              @if($results['title'] == 'Events')
	              	<a href="{{ url('admin/event/create')}}" class="btn btn-warning btn-block btn-flat">Create new Event</a>
	              @else
	              	<a href="{{ url('admin/tradeshow/create')}}" class="btn btn-warning btn-block btn-flat">Create new Tradeshow</a>
	              @endif
	            </div><!-- /.error-content -->
	        </div><!-- /.error-page -->
	    @endif
	</div>
	
@endsection

@push('scripts')

<script>
	function loadSagEvents() {
	  $('#sag-events-table').DataTable({
	      processing: true,
	      serverSide: true,
	      destroy: true,
	      ajax: "{{ url('datatables/get-all-events/'.$results['event_type']) }}",
	      columns: [
	          {data: 'event_id', name: 'event_id'},
	          {data: 'title', name: 'title'},
	          {data: 'event_host', name: 'event_host'},
	          {data: 'date_range', name: 'date_range'},
	          {data: 'status', name: 'status'},
	          {data: 'action', name: 'action'}
	      ]
	  });
	}
	function deleteSagEvent(eventId){
	  bootbox.confirm({
	      title: "<h2>Delete {{ $results['title']}}!</h2>",
	      message: "Are you sure you want to delete this {{ strtolower(substr($results['title'], 0, strlen($results['title']) - 1)) }}? <br> This action is irrivercible.",
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
		            url: "{{ url('admin/delete-event')}}/"+eventId,
		            success: function(data){
		              if(data.success){
		                toastr.success(data.msg, 'Success');
		                $(location).attr('href', "{{ url('admin/'.strtolower($results['title'])) }}");
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
	    
	    loadSagEvents();

	  });

	  // -------------------
	  (function() {
	    
	    
	  })();

	})(document, window, jQuery);
</script>
@endpush