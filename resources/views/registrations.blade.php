@extends('sitemaster')

@section('title')
	<title>{{ $response['type'] }} Registrations | SAG Buisness PLC</title>
@endsection

@section('content')
	<div class="under_header">
		<!-- <img src="images/assets/breadcrumbs14.png" alt="#"> -->
	</div><!-- under header -->
	<div class="page-content back_to_up">
		<div class="row clearfix mb">
			<div class="breadcrumbIn">
				<ul>
					<li><a href="{{ url('') }}" class="toptip" title="Homepage"> <i class="icon-home"></i> </a></li>
					@if(strtolower($response['type']) == 'event')
						<li><a href="{{ url('our-events') }}" class="toptip" title="Homepage"> <i class="icon-flag"></i> Events</a></li>
					@else
						<li><a href="{{ url('tradeshows') }}" class="toptip" title="Homepage"> <i class="icon-flag"></i> Tradeshows</a></li>
					@endif
					<li> {{ $response['type'] }} Registrations </li>
				</ul>
			</div><!-- breadcrumb -->
		</div><!-- row -->

		<div class="row row-fluid clearfix mbf">
			<div class="span8 posts">
				<div class="def-block clearfix">
					<h4> Event Registrations </h4><span class="liner"></span>
					<div class="mbf clearfix">
						@if($response['success'])
							<div class="notification-box notification-box-success">
								<p><i class="icon-ok"></i>{{ $response['msg'] }}</p>
								<a href="#" class="notification-close notification-close-success"><i class="icon-remove"></i></a>
							</div>
						@else
							<div class="notification-box notification-box-error">
								<p><i class="icon-remove-sign"></i>{{ $response['msg'] }}</p>
								<a href="#" class="notification-close notification-close-error"><i class="icon-remove"></i></a>
							</div>
						@endif
					</div>
					@if($response['success'])
						<div class="mbf clearfix">
							<ul class="tt-toggle">
								<li class="sub-toggle">
									<div class="toggle-head">
										<div class="toggle-head-sign"></div>
										<p>Your Information</p>
									</div>
									<div class="toggle-content">
										<ul class="the-list grid_6">
											<li><i class="icon-ok mid"></i>Name: {{ $response['registred_by']->name }}</li>
											<li><i class="icon-ok mid"></i>Email: {{ $response['registred_by']->email }}</li>
											<li><i class="icon-ok mid"></i>Phone: {{ $response['registred_by']->phone }}</li>
											<li><i class="icon-ok mid"></i>Company: {{ $response['registred_by']->company }}</li>
											<li><i class="icon-ok mid"></i>Gender: {{ $response['registred_by']->gender }}</li>
										</ul>
									</div>
								</li>
								<li class="sub-toggle">
									<div class="toggle-head">
										<div class="toggle-head-sign"></div>
										<p>@if(strtolower($response['type']) == 'event') Event @else Tradeshow @endif for which you are registred for</p>
									</div>
									<div class="toggle-content">
										<h3>{{ $response['event']->title }}</h3>
										<p>{{ $response['event']->summary }}</p>
										<div class="clearfix"></div> <br>
										<ul class="the-list grid_12">
											<li> <i class="icon-map-marker mi"></i> Addis Ababa, Ethiopia </li>
											<li> <i class="icon-time mi"></i>{{ $response['date_range'] }} </li>
											<li> <a href="#"><i class="icon-users"></i> {{ $response['registered_so_far'] }} @if($response['registered_so_far'] == 1) person @else people @endif registered.</a> </li> 
										</ul>
									</div>
								</li>
							</ul>
						</div>
					@endif
				</div><!-- def block -->
			</div><!-- span8 posts -->

			<div class="span4 sidebar">
				@if(isset($results))
					@if(count($results['related_events']))
						<div class="def-block widget">
							<h4> Related {{ $page_title }}s </h4><span class="liner"></span>
							<div class="widget-content row-fluid">
								<div class="mtracks">
									<div class="content">
										<ul class="tab-content-items">
											@foreach($results['related_events'] as $sim_ev)
												@if($sim_ev->event_id != $results['event']->event_id)
													<li class="clearfix">
														<h3><a href="{{ url($results['type'].'/'.$sim_ev->slug) }}">{{ $results['event']->title }}</a></h3>
														<span> Location </span>
														<span> {{ Carbon\Carbon::parse($sim_ev->start_date)->format('M d, Y').' - '.Carbon\Carbon::parse($sim_ev->end_date)->format('M d, Y') }} </span>
														<span> May 2, 2017 - 2 Days left </span>
													</li>
												@endif
											@endforeach
											<!-- <li class="clearfix">
												<a class="m-thumbnail" href="{{ url('event/sample') }}"><img width="50" height="50" src="{{ url('images/assets/sag_tradeshow_square.png') }}" alt="#"></a>
												<h3><a href="{{ url('event/sample') }}">That's My Kind Of Night </a></h3>
												<span> Alexander Mikoole </span>
												<span> Jan 2, 2017 - 12 Days left </span>
											</li> -->
										</ul>
									</div>
								</div>
							</div><!-- widget content -->
						</div><!-- def block widget popular items -->
					@endif
				@endif

				@include('includes.newsletter')

				@include('includes.ad_here')

				

			</div><!-- span4 sidebar -->
		</div><!-- row clearfix -->
	</div><!-- end page content -->
@endsection

@push('scripts')
    @include('includes.scripts')
@endpush