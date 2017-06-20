@if(isset($sag_photo_ads))
	@if(count($sag_photo_ads))
		@if(count($sag_photo_ads) == 1)
			<div class="def-block widget">
				<h4> {{ $sag_photo_ads[0]->ad_title }} </h4><span class="liner"></span>
				<div class="widget-content tac">
					<a href="{{ $sag_photo_ads[0]->ad_link }}" target="_blank" title="{{ $sag_photo_ads[0]->ad_title }}">
						<img src="{{ url('sag-ads/'.$sag_photo_ads[0]->ad_id.'/'.$sag_photo_ads[0]->ad_background_photo) }}" alt="{{ $sag_photo_ads[0]->ad_title}}">
					</a>
				</div>
			</div>
		@else
			<div class="def-block widget animtt" data-gen="fadeUp" style="opacity:0;">
				<h4> Photo Ads </h4><span class="liner"></span>
				<div class="widget-content row-fluid">
					<div class="videos clearfix flexslider">
						<ul class="slides">
							@foreach($sag_photo_ads as $photo_ad)
								<li class="featured-video">
									<a href="{{ $photo_ad->ad_link }}" target="_blank" title="{{ $photo_ad->ad_title }}" class="grid_12">
										<img src="{{ url('sag-ads/'.$photo_ad->ad_id.'/'.$photo_ad->ad_background_photo)}}" style="height: 250px;" alt="{{ $photo_ad->ad_title }}">
										<!-- <i class="icon-play-sign"></i> -->
										<h3>{{ $photo_ad->ad_title }}</h3>
										<a href="{{ $photo_ad->ad_link }}" target="_blank"><span>Visit Page</span></a>
									</a>
								</li>
							@endforeach
						</ul>
					</div>
				</div>
			</div>
		@endif
	@endif
@endif
@if(isset($sag_video_ads))
	@if(count($sag_video_ads))
		@if(count($sag_video_ads) == 1)
				<div class="def-block widget">	
					<a href="{{ $sag_video_ads[0]->ad_link }}" target="_blank"><h4>{{ $sag_video_ads[0]->ad_title }}</h4></a>
					<div class="video-grid" style="padding-top: 10px;">
						<a href="{{ url($sag_video_ads[0]->ad_video_link)}}" title="{{ $sag_video_ads[0]->ad_title }}" data-gal="photo" class="grid_12">
							<img src="{{ url('sag-ads/'.$sag_video_ads[0]->ad_id.'/'.$sag_video_ads[0]->ad_background_photo) }}" alt="{{ $sag_video_ads[0]->ad_title }}">
						</a>
					</div>
				</div>
		@else
			<div class="def-block widget animtt" data-gen="fadeUp" style="opacity:0;">
				<h4> Featured Video Ads </h4><span class="liner"></span>
				<div class="widget-content row-fluid">
					<div class="videos clearfix flexslider">
						<ul class="slides">
							@foreach($sag_video_ads as $video_ad)
								<li class="featured-video">
									<a href="{{ url($video_ad->ad_video_link)}}" title="{{ $video_ad->ad_title }}" data-gal="photo" class="grid_12">
										<img src="{{ url('sag-ads/'.$video_ad->ad_id.'/'.$video_ad->ad_background_photo)}}" style="height: 250px;" alt="{{ $video_ad->ad_title }}">
										<i class="icon-play-sign"></i>
										<h3>{{ $video_ad->ad_title }}</h3>
										<a href="{{ $video_ad->ad_link }}" target="_blank"><span>Visit Page</span></a>
									</a>
								</li>
							@endforeach
						</ul>
					</div>
				</div>
			</div>
		@endif
	@endif
@endif