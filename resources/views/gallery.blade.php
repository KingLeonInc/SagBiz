@extends('sitemaster')

@section('title')
	<title>Gallery - SAG</title>
@endsection

@section('content')

	<div class="under_header">
			<img src="{{ url('images/assets/breadcrumbs12.png') }}" alt="#">
		</div><!-- under header -->

		<div class="page-content back_to_up">
			<div class="row clearfix mb">
				<div class="breadcrumbIn">
					<ul>
						<li><a href="{{ url('')}}" class="toptip" original-title="Homepage"> <i class="icon-home"></i> </a></li>
						<li> Gallery </li>
					</ul>
				</div><!-- breadcrumbIn -->
			</div><!-- row -->

			<div class="row row-fluid clearfix mbf">
				<div class="posts">
					<div class="def-block" style="min-height: 400px;">
						<div class="topbar">
							<div id="close" class="tbutton small tback"><span>< Back to Gallery</span></div>
							<h4 id="name">Photo Gallery</h4><span class="liner"></span>
						</div>
						<ul id="tp-grid" class="tp-grid">
							@if(isset($galleries))
								@if(count($galleries['events']))
									<!-- PILE 1 -->
									@for($i=0; $i<count($galleries['events']); $i++)
										<li data-pile="Events" class="grid_3"><a href="{{ url('sag-galleries/'.$galleries['events'][$i]) }}" data-gal="photo[Events]"><img src="{{ url('sag-galleries/'.$galleries['events'][$i]) }}" alt="#{{ $i + 1 }}" /></a></li>
									@endfor
								@endif

								@if(count($galleries['tradeshows']))
									<!-- PILE 2 -->
									@for($i=0; $i<count($galleries['tradeshows']); $i++)
										<li data-pile="Trade Shows" class="grid_3"><a href="{{ url('sag-galleries/'.$galleries['tradeshows'][$i]) }}" data-gal="photo[Trade Shows]"><img src="{{ url('sag-galleries/'.$galleries['tradeshows'][$i]) }}" alt="#{{ $i + 1 }}" /></a></li>
									@endfor
								@endif

								@if(count($galleries['public_parks']))
									<!-- PILE 3 -->
									@for($i=0; $i<count($galleries['public_parks']); $i++)
										<li data-pile="Public Parks" class="grid_3"><a href="{{ url('sag-galleries/'.$galleries['public_parks'][$i]) }}" data-gal="photo[Public Parks]"><img src="{{ url('sag-galleries/'.$galleries['public_parks'][$i]) }}" alt="#{{ $i + 1 }}" /></a></li>
									@endfor
								@endif

								@if(count($galleries['txt_and_stationary']))
									<!-- PILE 4 -->
									@for($i=0; $i<count($galleries['txt_and_stationary']); $i++)
										<li data-pile="Textile and Stationary Products" class="grid_3"><a href="{{ url('sag-galleries/'.$galleries['txt_and_stationary'][$i]) }}" data-gal="photo[Textile and Stationary Products]"><img src="{{ url('sag-galleries/'.$galleries['txt_and_stationary'][$i]) }}" alt="#{{ $i + 1 }}" /></a></li>
									@endfor
								@endif

								@if($no_gallery_photo == 0)
									<div class="mbf clearfix">
										<h3 class="text-center">No gallery photos uploaded yet.</h3>
									</div>
								@endif
							@endif
						</ul>
					</div>
				</div>

			</div>
		</div>

@endsection

@push('scripts')
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
	
@endpush