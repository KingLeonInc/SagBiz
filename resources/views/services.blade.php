@extends('sitemaster')

@section('title')
	<title>@if(isset($serv_title)) {{ $serv_title }} | @endif Services | SAG Buisness PLC</title>
@endsection

@section('content')

	<div class="under_header">
			<img src="{{ url('images/assets/breadcrumbs14.png') }}" alt="#">
	</div><!-- under header -->

	<div class="page-content left-sidebar back_to_up">
		<div class="row clearfix mb">
			<div class="breadcrumbIn">
				<ul>
					<li><a href="{{ url('')}}" class="toptip" title="Homepage"> <i class="icon-home"></i> </a></li>
					@if(Request::is('services'))
						<li> Our Services </li>
					@else
						<li><a href="{{url('services') }}">Our Services</a></li>
						<li>{{ $serv_title }}</li>
					@endif
				</ul>
			</div><!-- breadcrumb -->
		</div><!-- row -->

		<div class="row row-fluid clearfix mbf">
			<div class="span8 posts">
				<div class="def-block">
					@if(Request::is('services'))
						<div class="post row-fluid clearfix">
							<h2 class="text-center"> Our Services </h2>
						</div><!-- post -->
						<div class="post row-fluid clearfix">
							<a href="{{ url('services/public_park_development')}}"><img src="{{ url('images/assets/public_park1.JPG') }}" alt="#"></a>
							<h3 class="post-title"> <i class="icon-play"></i><a href="#">Public Park Development</a> </h3>
							<p>we strive to create vibrant socially active parks for the society by collaboratlly working hand in hand with 
								the government, the society, business and NGOs to make Addis Ababa one of the greenest and cleanest cities in the world.</p>
							<a href="{{ url('services/public_park_development')}}" class="Rmore tbutton small"><span>Read More</span></a>
						</div><!-- post -->
						<div class="post row-fluid clearfix">
							<a href="{{ url('services/land_scape_managment')}}"><img src="{{ url('images/assets/landscape_manag1.jpg') }}" alt="#"></a>
							<h3 class="post-title"> <i class="icon-play"></i><a href="{{ url('services/land_scape_managment')}}">Landscape Managment</a> </h3>
							<p>We offer a fully comprehensive one stop shop for all aspects of landscape maintenance. Our services extend from the smallest house lawn care to the very complicated public parks and recreational centers. We have a "no job is too small" approach to providing a service with high standard; taking in to consideration the wants and needs of our clients.</p>
							<a href="{{ url('services/land_scape_managment')}}" class="Rmore tbutton small"><span>Read More</span></a>
						</div><!-- post -->
						<div class="post row-fluid clearfix">
							<a href="{{ url('services/textile_and_stationary_product')}}"><img src="{{ url('images/assets/textile3.jpg') }}" alt="#"></a>
							<h3 class="post-title"> <i class="icon-play"></i><a href="{{ url('services/textile_and_stationary_product')}}">Textile and Stationary Products</a> </h3>
							<p>Our foundation is laid in providing superior quality products at a competitive price delivered by unmatched customer service. we offer a large product range of textile and stationary supplies.</p>
							<a href="{{ url('services/textile_and_stationary_product')}}" class="Rmore tbutton small"><span>Read More</span></a>
						</div><!-- post -->
						<div class="post row-fluid clearfix">
							<a href="{{ url('services/cleaning_supplies')}}"><img src="{{ url('images/assets/cleaning2.JPG') }}" alt="#"></a>
							<h3 class="post-title"> <i class="icon-play"></i><a href="{{ url('services/cleaning_supplies')}}">Cleaning Supplies</a> </h3>
							<p>we are a company that is attentive to the needs of our customers and dedicate to providing a complete range of high quality cleaning products and cleaning services at a reasonable price for buildings, hotels, hospitals, offices, house hold, etc...</p>
							<a href="{{ url('services/cleaning_supplies')}}" class="Rmore tbutton small"><span>Read More</span></a>
						</div><!-- post -->
					@else
						<div class="post row-fluid clearfix">
							<a href="#"><img src="{{ url(''.$serv_img) }}" alt="#"></a>
							<h3 class="post-title"> <i class="icon-play"></i><a href="#">{{ $serv_title }}</a> </h3>
							<p>{{ $serv_desc }}</p>
						</div><!-- post -->
						{{-- 
							<div class="post row-fluid clearfix">
								<a href="{{ url('services')}}"><img src="{{ url('images/assets/sag_services.png') }}" alt="#"></a>
							</div>
						--}}
					@endif

					

				</div><!-- def block -->
			</div><!-- span8 posts -->

			<div class="span4 sidebar">

                @include('includes.sag_ads')
                
                @include('includes.ad_here')
                
                @include('includes.newsletter')

			</div><!-- span4 sidebar -->
		</div><!-- row clearfix -->
	</div><!-- end page content -->

@endsection

@push('scripts')
	@include('includes.scripts')
@endpush