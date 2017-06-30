@extends('sitemaster')

@section('title')
	<title>Contact Us | SAG Buisness PLC</title>
@endsection

@section('content')
	<div class="under_header">
			<img src="{{ url('images/assets/breadcrumbs11.png') }}" alt="#">
		</div><!-- under header -->

		<div class="page-content back_to_up">
			<div class="row clearfix mb">
				<div class="breadcrumbIn">
					<ul>
						<li><a href="{{ url('')}}" class="toptip" title="Homepage"> <i class="icon-home"></i> </a></li>
						<li> Contact </li>
					</ul>
				</div><!-- breadcrumb -->
			</div><!-- row -->
			
			<div class="row row-fluid clearfix mbf">
				<div class="span8 posts">
					@include('includes.site_errors')
					@if(session('success'))
						<div class="def-block clearfix">
							<div class="notification-box notification-box-success">
								<p><i class="icon-ok"></i>{{ session('success') }}</p>
								<a href="#" class="notification-close notification-close-success"><i class="icon-remove"></i></a>
							</div>
						</div>
					@endif
					<div class="def-block clearfix">
						<h4> Contact With US </h4><span class="liner"></span>
						<p>Our customer support teams provide the best service in the industry. We're passionate about our products as well as our coustomers and it shows in the level of service that we provide. We're always happy to help find the solution for your needs. If a solution doesn't already exist, we'll create a new solution that resolves your issue. </p>
						{!! Form::open(['id'=>'contactForm']) !!}
							<div class="clearfix">
								<div class="grid_6 alpha fll"><input type="text" name="senderName" id="senderName" placeholder="Name *" class="requiredField" required /></div>
								<div class="grid_6 omega flr"><input type="text" name="senderEmail" id="senderEmail" placeholder="Email Address *" class="requiredField email" required /></div>
							</div>
							<div><textarea name="message" id="message" placeholder="Message *" class="requiredField" rows="8" required></textarea></div>
							<input type="submit" id="sendMessage" name="sendMessage" value="Send Email" />
							<span>  </span>
						{!! Form::close() !!}
					</div><!-- def block -->
				</div><!-- span8 posts -->

				<div class="span4 sidebar">
					<div class="def-block widget">
						<h4> Get in Touch </h4><span class="liner"></span>
						<div class="widget-content">
							<div class="mb">
								<iframe src="https://www.google.com/maps/embed?pb=!1m14!1m12!1m3!1d63052.4200856315!2d38.85214739999999!3d8.99272485!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!5e0!3m2!1sam!2set!4v1494193006700" width="100%" height="250" frameborder="0" style="border:0" allowfullscreen></iframe>
							</div>
							<!-- <div id="map" class="mb"></div> -->
							<p>We're friendly and available to chat, Reach out to us any time and we'll happily answer your questions.</p>
							<p>Phone: <strong>  +251-91-121-5028 </strong> <br> Email: <strong> contact@sag-biz.com</strong></p>
						</div><!-- widget content -->
					</div><!-- def block widget details -->

	                @include('includes.sag_ads')
	                
	                @include('includes.ad_here')
	                
	                @include('includes.newsletter')

				</div><!-- span4 sidebar -->
			</div><!-- row clearfix -->
		</div><!-- end page content -->
@endsection

@push('scripts')
    <script type="text/javascript" src="{{ url('js/jquery.min.js') }}"></script>
	<script type="text/javascript" src="{{ url('js/theme20.js') }}"></script>
	<script type="text/javascript" src="{{ url('bootstrap/js/bootstrap.min.js') }}"></script>
	<script type="text/javascript" src="{{ url('js/jquery.prettyPhoto.js') }}"></script>
	<script type="text/javascript" src="{{ url('js/jquery.flexslider-min.js') }}"></script>
	<script type="text/javascript" src="{{ url('js/jquery.nanoscroller.js') }}"></script>
	<script type="text/javascript" src="{{ url('js/twitter/jquery.tweet.js') }}"></script>
	<script type="text/javascript" src="{{ url('js/custom.js') }}"></script>
	<script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=false"></script>
	<script type="text/javascript" src="{{ url('js/gmap3.js') }}"></script>
	<script type="text/javascript">
	/* <![CDATA[ */
		jQuery(function () {
		    jQuery("#map").gmap3({
		        marker: {
		            address: "2252 Chicago"
		        },
		        map: {
		            options: {
		                zoom: 10
		            }
		        }
		    });
		});
	/* ]]> */
	</script>
	<script type="text/javascript" src="{{ url('customize/script.js') }}"></script>
	<link rel="stylesheet" type="text/css" href="{{ url('customize/style.css') }}" media="screen" />
           
@endpush