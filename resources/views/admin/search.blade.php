@extends('admin.adminmaster')

@section('title')
	<title>{{ $results['searchFor'] }} - Admin | SAG PLC</title>
@endsection

@section('content')
	
  <!-- Small boxes (Stat box) -->
  <div class="row">
  	@if($results['totalFound'] == 0)
  		<div class="error-page">
            <h2 class="headline text-yellow"> 404</h2>
            <div class="error-content">
              <h3><i class="fa fa-warning text-yellow"></i> Oops! "{{ $results['searchFor'] }}" not found.</h3>
              <p>
                We could not find what you were looking for.
                Meanwhile, you may <a href="{{ url('') }}">return to dashboard</a> or try using the search form.
              </p>
    		  {!! Form::open(['url' => 'admin/search', 'class'=>'search-form']) !!}
                <div class="input-group">
                  <input type="text" name="search" class="form-control" placeholder="Search" required>
                  <div class="input-group-btn">
                    <button type="submit" name="submit" class="btn btn-warning btn-flat"><i class="fa fa-search"></i></button>
                  </div>
                </div><!-- /.input-group -->
              {!! Form::close() !!}
            </div><!-- /.error-content -->
        </div><!-- /.error-page -->
  	@else
  		<div class="col-md-12">
  			<div class="box-header">
              <h3 class="box-title">Search results For "{{ $results['searchFor'] }}"</h3>
              <div class="box-tools">
                Result/s found : {{ $results['totalFound'] }}
              </div>
            </div>
  			<ul class="timeline timeline-inverse">
  				@if(count($results['eventsFound']))
	              <!-- timeline time label -->
	              <li class="time-label">
	                <span class="bg-red">
	                  {{ count($results['eventsFound']) }} Events/Tradeshows Found
	                </span>
	              </li>
	              <!-- /.timeline-label -->
	              @foreach($results['eventsFound'] as $ev)
		              <!-- timeline item -->
		              <li>
		                <i class="fa fa-envelope bg-blue"></i>
		                <div class="timeline-item">
		                  <span class="time"><i class="fa fa-clock-o"></i> {{ $ev->created_at }}</span>
		                  <h3 class="timeline-header"><a href="#">{{ $ev->title }}</a> Event/Tradeshow</h3>
		                  <div class="timeline-body">
		                    {{ $ev->summary }}
		                  </div>
		                  <div class="timeline-footer">
		                    <a class="btn btn-primary btn-xs">Read more</a>
		                    <a class="btn btn-danger btn-xs">Delete</a>
		                  </div>
		                </div>
		              </li>
		              <!-- END timeline item -->
	              @endforeach
	            @endif

	            @if(count($results['hostsFound']))
	            	<li class="time-label">
	                    <span class="bg-green">
	                      {{ count($results['hostsFound']) }} Event/Tradeshow Hosts Found
	                    </span>
	                </li>
	                <li>
                        <i class="fa fa-envelope bg-blue"></i>
                        <div class="timeline-item">
                          <span class="time"><i class="fa fa-clock-o"></i> 12:05</span>
                          <h3 class="timeline-header"><a href="#">Hosts Found</a> > {{ count($results['hostsFound']) }}</h3>
                          <div class="timeline-body">
                          	<table class="table table-hover table-striped">
			                	<tbody>
			                		<tr>
			                			<th>Name</th>
			                			<th>Company</th>
			                			<th>Phone</th>
			                			<th>Email</th>
			                			<th>Address</th>
			                			<th>Additioal Info</th>
			                		</tr>
			                		@foreach($results['hostsFound'] as $host)
			                			<tr>
			                				<td>{{ $host->name }}</td>
			                				<td>{{ $host->company }}</td>
			                				<td>{{ $host->phone }}</td>
			                				<td>{{ $host->email }}</td>
			                				<td>{{ $host->address }}</td>
			                				<td>{{ $host->additional_info }}</td>
			                			</tr>
			                		@endforeach
			                	</tbody>
			                </table>
                          </div>
                        </div>
                    </li>
	            @endif
            </ul>
  		</div>
    @endif
  </div><!-- /.row -->
  <!-- Main row -->
	  
	
@endsection