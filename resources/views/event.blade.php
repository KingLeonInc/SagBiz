@extends('sitemaster')

@section('title')
	<title>{{ $results['event']->title }} | SAG Buisness PLC</title>
@endsection

@section('content')
	
	<style type="text/css">
		/*	contactForm
		----------------------------------------------------------------------------------------------------*/
		#contactForm2 span {
			margin: 11px 10px;
			display: inline-block;
			color: #F00;
		}
		#contactForm2 span strong {
			color: #F00;
		}
		#contactForm2 i {
			color: #fff;
			margin: 0 10px 0 0
		}
		#contactForm2 #senderName, 
		#contactForm2 #senderEmail, 
		#contactForm2 #message {
			display: block;
			width: 100%;
			border: 1px solid #EAEAEA;
			-webkit-border-radius: 2px;
			-moz-border-radius: 2px;
			border-radius: 2px;
			padding: 16px 10px;
			background: #F7F7F7;
			box-shadow: none;
			-webkit-box-shadow: none;
			-webkit-box-sizing: border-box;
			-moz-box-sizing: border-box;
			box-sizing: border-box;
			-webkit-transition: all 0.3s;
			transition: all 0.3s;
		}
		#contactForm2 #senderEmail {
			float: right;
		}
		#contactForm2 .flr {
			margin: 0 0 10px 0 !important;
		}
		#contactForm2 .fll {
			margin: 0 0px 10px 0 !important;
		}
		#contactForm2 #senderName:focus, 
		#contactForm2 #senderEmail:focus, 
		#contactForm2 #message:focus {
			background: #fff;
			border: 1px solid #FF0078
		}
		.fieldtrue {
			border: 1px solid #1ABC5B !important
		}
		.fielderror {
			border-color: #F00 !important;
		}
		#contactForm2 #sendMessage {
			width: auto;
			margin-top: 10px;
			float: right;
			padding: 8px 10px;
			font-family: Oswald, Tahoma, Helvetica;
			display:inline-block;
			cursor:pointer;
			position:relative;
			word-spacing:0.2em;
			background:#ff0078;
			border: 0 !important;
			-webkit-border-radius: 2px;
			border-radius: 2px;
			color:#fff!important;
			white-space: nowrap;	
			text-transform:uppercase;
			text-shadow:0 -1px 0 rgba(0,0,0,0.2);
			border:1px solid rgba(0,0,0,0.1);
			background-image: linear-gradient(bottom, rgba(0,0,0,0.08) 0%, rgba(128,128,128,0.08) 50%, rgba(255,255,255,0.08) 100%);
			background-image: -o-linear-gradient(bottom, rgba(0,0,0,0.08) 0%, rgba(128,128,128,0.08) 50%, rgba(255,255,255,0.08) 100%);
			background-image: -moz-linear-gradient(bottom, rgba(0,0,0,0.08) 0%, rgba(128,128,128,0.08) 50%, rgba(255,255,255,0.08) 100%);
			background-image: -webkit-linear-gradient(bottom, rgba(0,0,0,0.08) 0%, rgba(128,128,128,0.08) 50%, rgba(255,255,255,0.08) 100%);
			background-image: -ms-linear-gradient(bottom, rgba(0,0,0,0.08) 0%, rgba(128,128,128,0.08) 50%, rgba(255,255,255,0.08) 100%);
			background-image: -webkit-gradient(linear,left bottom,left top,color-stop(0, rgba(0,0,0,0.08)),color-stop(0.5, rgba(128,128,128,0.08)),color-stop(1, rgba(255,255,255,0.08)));
			-moz-box-shadow:inset 0 0 1px rgba(0,0,0,0.1);
			-webkit-box-shadow:inset 0 0 1px rgba(0,0,0,0.1);
			box-shadow:inset 0 0 1px rgba(0,0,0,0.1);
			-webkit-transition: all 0.2s ease;
			transition: all 0.2s ease;
		}
		#contactForm2 #sendMessage:hover {
			background:#8e0545
		}
		.error {
			color: red
		}
		.load-color {
			background: #191919 !important;
			cursor: default !important;
		}
		#contactForm2 textarea {
			width: 98%;
		}
		#contactForm2 #comment-button {
			background: #2C3E50;
			color: #FFF;
			margin: 20px 0 0 0;
			padding: 10px 20px;
			border: 0;
			-webkit-border-radius: 3px;
			border-radius: 3px;
			text-transform: uppercase;
			-webkit-transition: all 0.3s;
			transition: all 0.3s;
			cursor: pointer;
		}
		#contactForm2 #comment-button:hover {
			background: #1ABC9C
		}
	</style>
	<div class="under_header">
		<!-- <img src="images/assets/breadcrumbs14.png" alt="#"> -->
	</div><!-- under header -->
	<div class="page-content back_to_up">
		<div class="row clearfix mb">
			<div class="breadcrumbIn">
				<ul>
					<li><a href="{{ url('') }}" class="toptip" title="Homepage"> <i class="icon-home"></i> </a></li>
					@if(strtolower($page_title) == 'event')
						<li> <a href="{{ url('our-events') }}"> Events</a> </li>
					@else
						<li> <a href="{{ url('tradeshows') }}"> Tradeshows </a> </li>
					@endif
					<li> {{  $results['event']->title  }} </li>
					@if($results['show_reg_form'])
						<li> <a href="#register-now">Register Now</a></li>
					@endif
				</ul>
			</div><!-- breadcrumb -->
		</div><!-- row -->

		<div class="row row-fluid clearfix mbf">
			<div class="span8 posts">
				<div class="def-block">
					<div class="post row-fluid clearfix">
						@include('includes.site_errors')
						@if($results['event_status'] == 'upcoming')
							<div class="span7">
								<h3 class="post-title"> 
									<i class="icon-flag"></i>
									<a href="#">{{ $results['event']->title }}</a> 
								</h3>
							</div>
							<div class="span5">
								<div class="span3 tac">
									<span class="event-date" id="days">0</span>
									<span class="event-month" style="font-size: 10px;">days</span>
								</div><div class="span3 tac">
									<span class="event-date" id="hrs">0</span>
									<span class="event-month" style="font-size: 10px;">hours</span>
								</div><div class="span3 tac">
									<span class="event-date" id="mins">0</span>
									<span class="event-month" style="font-size: 10px;">min</span>
								</div><div class="span3 tac">
									<span class="event-date" id="secs">0</span>
									<span class="event-month" style="font-size: 10px;">sec</span>
								</div>
							</div>
							<div class="clearfix"></div>
						@else
							<h3 class="post-title"> 
								<i class="icon-flag"></i>
								<a href="#">{{ $results['event']->title }}</a> 
							</h3>
						@endif
						@if($results['event']->event_img == '')
                    		@if($page_title == 'Event')
                    			<a href="{{ url(strtolower($page_title).'/'.$results['event']->slug) }}"><img src="{{ url('images/assets/sag_event.png')}}" alt="{{ $results['event']->title }}" class="four-radius" style="width: 100%;"></a>
                    		@else
                    			<a href="{{ url(strtolower($page_title).'/'.$results['event']->slug) }}"><img src="{{ url('images/assets/sag_tradeshow.png')}}" alt="{{ $results['event']->title }}" class="four-radius" style="width: 100%;"></a>
                    		@endif
                    	@else
                    		<a href="{{ url(strtolower($page_title).'/'.$results['event']->slug) }}"><img src="{{ url('sag-events/'.$results['event']->event_id.'/'.$results['event']->event_img)}}" style="width: 100%;" alt="{{ $results['event']->title }}" class="four-radius"></a>
                    	@endif

						{!! $results['event']->description !!}
						<div class="clearfix"></div> <br>
						<div class="meta">
							<span> <i class="icon-map-marker mi"></i> Addis Ababa, Ethiopia </span>
							<span> <i class="icon-time mi"></i>{{ $results['date_range'] }} </span>
							@if($results['registered_so_far'] >= 1)
								<span> <a href="#"><i class="icon-user"></i> {{ $results['registered_so_far'] }} @if($results['registered_so_far'] == 1) person @else people @endif registered.</a> </span> 
							@endif
						</div> 
						@if(!is_null(App\EventHost::find($results['event']->event_host)))
							<div class="clearfix"></div>
							<div class="meta">
								<span><i class="icon-h-sign"></i> Hosted By : {{ App\EventHost::find($results['event']->event_host)->company }}</span>
							</div>
						@endif
						@if($results['show_reg_form'])
							<div class="mtf clearfix" id="register-now">
								<hr class="dotted">
							</div>
							<div class="clearfix"></div> <br>
							<h4>Register For this {{ $page_title }}</h4>
							<p>Register now and save upto 25% of the {{ $page_title }}'s Price.</p>
							<div class="clearfix"></div> 
							<!-- <div class="grid_4">.</div> -->
							<div class="grid_12">
								<h4 class="text-center">Price ETB {{ $results['event']->price }}</h4>
							</div>
							<!-- <div class="grid_4">.</div> -->
							<div class="clearfix"></div><br>
							{!! Form::open(['url'=>'register-for-an-event', 'id'=>'contactForm2'])!!}
								<div class="clearfix">
									@include('includes.site_errors')
									<div class="grid_6 alpha fll">
										<label>Full Name*</label>
										<input type="text" name="senderName" id="" placeholder="Name *" class="requiredField" style="display: block; width:100%;" required />
									</div>
									<div class="grid_6 omega flr">
										<label>Your Email*</label>
										<input type="email" name="senderEmail" id="" placeholder="Email Address *" class="requiredField email"  style="display: block; width:100%;" required />
									</div> <div class="clearfix"></div>
									<div class="grid_6 omega fll">
										<label>Phone*</label>
										<input type="text" name="senderPhone" id="senderPhone" placeholder="Phone *"  style="display: block; width:100%;" required />
									</div>
									<div class="grid_6 omega flr">
										<label>Gender</label>
										<select name="gender" style="display: block; width:100%;">
											<option value="male">Male</option>
											<option value="female">Female</option>
										</select> 
									</div>
									<div class="grid_6 omega fll">
										<label>Company(if any)</label>
										<input type="text" name="senderCompany" id="senderCompany" placeholder="Company *"  style="display: block; width:100%;" />
									</div>
									
									<input type="hidden" name="event_id" value="{{ $results['event']->event_id }}">
									<input type="hidden" name="event_type" value="{{ $page_title }}">
								</div>
								<div class="">
									<button type="submit" class="tbutton large" style="padding: 10px 0px 10px 0px;"> &nbsp; Register &nbsp; </button>
								</div>
								<span>  </span>
							{!! Form::close() !!}
						@endif

						@if(count($results['event_images']))
							<div class="topbar">
								<div id="close" class="tbutton small tback"><span>< Back to Images</span></div>
								<h4 id="name">Event Images</h4><span class="liner"></span>
							</div>
							<ul class=""> <!-- id="tp-grid" class="tp-grid" -->
								@for($i=0; $i<count($results['event_images']); $i++)
									<li data-pile="Events" class="grid_4"><a href="{{ url('sag-events/'.$results['event_images'][$i]) }}" data-gal="photo"><img src="{{ url('sag-events/'.$results['event_images'][$i]) }}" alt="#{{ $i + 1 }}" /></a></li>
								@endfor
							</ul>
							<div class="clearfix"></div>
						@endif
					</div><!-- post -->
				</div><!-- def block -->
			</div><!-- span8 posts -->

			<div class="span4 sidebar">
				@include('includes.sag_ads')

				@include('includes.ad_here')
				
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
													<!-- <span> <i class="icon-map-marker mid"></i>Addis Ababa, E </span> -->
													<span> <i class="icon-time mid"></i>{{ Carbon\Carbon::parse($sim_ev->start_date)->format('M d, Y').' - '.Carbon\Carbon::parse($sim_ev->end_date)->format('M d, Y') }} </span>
												</li>
											@endif
										@endforeach
									</ul>
								</div>
							</div>
						</div><!-- widget content -->
					</div><!-- def block widget popular items -->
				@endif
				
				@include('includes.newsletter')
			</div><!-- span4 sidebar -->
		</div><!-- row clearfix -->
	</div><!-- end page content -->
@endsection

@push('scripts')
    {{-- @include('includes.scripts') --}}
	<script type="text/javascript" src="{{ url('js/jquery.min.js') }}"></script>
	<script type="text/javascript" src="{{ url('js/modernizr.custom.63321.js') }}"></script>
	<script type="text/javascript" src="{{ url('js/theme20.js') }}"></script>
	<script type="text/javascript" src="{{ url('bootstrap/js/bootstrap.min.js') }}"></script>
	<script type="text/javascript" src="{{ url('js/jquery.stapel.js') }}"></script>
	<script type="text/javascript" src="{{ url('js/jquery.prettyPhoto.js') }}"></script>
	<script type="text/javascript" src="{{ url('js/jquery.flexslider-min.js') }}"></script>
	<script type="text/javascript" src="{{ url('js/twitter/jquery.tweet.js') }}"></script>
	<script type="text/javascript" src="{{ url('js/custom.js') }}"></script>
	<script type="text/javascript" src="{{ url('customize/script.js') }}"></script>
	<link rel="stylesheet" type="text/css" href="{{ url('customize/style.css') }}" media="screen" />

    @if($results['event_status'] == 'upcoming')
	    <script>
	    	// Set the date we're counting down to
			var countDownDate = new Date("{{ $results['event']->start_date }}").getTime();
			//var countDownDate = new Date("Nov 5, 2017 15:37:25").getTime();

			// Update the count down every 1 second
			var x = setInterval(function() {

			  // Get todays date and time
			  var now = new Date().getTime();

			  // Find the distance between now an the count down date
			  var distance = countDownDate - now;

			  // Time calculations for days, hours, minutes and seconds
			  var days = Math.floor(distance / (1000 * 60 * 60 * 24));
			  var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
			  var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
			  var seconds = Math.floor((distance % (1000 * 60)) / 1000);

			  // Display the result in the element with id="demo"
			  //document.getElementById("demo").innerHTML = days + "d " + hours + "h "
			  document.getElementById("days").innerHTML = days;
			  document.getElementById("hrs").innerHTML = hours;
			  document.getElementById("mins").innerHTML = minutes;
			  document.getElementById("secs").innerHTML = seconds;

			  // If the count down is finished, write some text 
			  if (distance < 0) {
			    clearInterval(x);
			    //document.getElementById("demo").innerHTML = "EXPIRED";
			    document.getElementById("days").innerHTML = '0';
				  document.getElementById("hrs").innerHTML = '0';
				  document.getElementById("mins").innerHTML = '0';
				  document.getElementById("secs").innerHTML = '0';
			  }
			}, 1000);
	    </script>
    @endif
@endpush