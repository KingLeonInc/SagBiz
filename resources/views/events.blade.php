@extends('sitemaster')

@section('title')
	<title>{{ $page_title }}s | SAG Buisness PLC</title>
@endsection

@section('content')
	<div class="under_header">
		<img src="{{ url('images/assets/breadcrumbs14.png') }}" alt="#">
	</div><!-- under header -->

	<div class="page-content back_to_up">

		<div class="row row-fluid clearfix mbf">
			<div class="span8 posts">
				<div class="def-block">
					<ul class="tabs">
						<li><a href="#Latest" class="active"> Ongoing  </a></li>
						<li><a href="#Upcoming"> Upcoming  </a></li>
						<li><a href="#Past"> Past  </a></li>
						<li style="float: right;"><a href="#">{{ $page_title }}s</a></li>
					</ul><!-- tabs -->

					<ul class="tabs-content">
						<li id="Latest" class="active">
							<div class="def-block">
								@if(count($results['ongoing']))
									@foreach($results['ongoing'] as $ongoing)
					                    <div class="news row-fluid animtt" data-gen="fadeUp" style="opacity:0;">
					                        <div class="span5">
					                        	@if($ongoing->event_img == '')
					                        		@if($page_title == 'Event')
					                        			<a href="{{ url(strtolower($page_title).'/'.$ongoing->slug) }}"><img src="{{ url('images/assets/sag_event.png')}}" alt="{{ $ongoing->title }}" class="four-radius"></a>
					                        		@else
					                        			<a href="{{ url(strtolower($page_title).'/'.$ongoing->slug) }}"><img src="{{ url('images/assets/sag_tradeshow.png')}}" alt="{{ $ongoing->title }}" class="four-radius"></a>
					                        		@endif
					                        	@else
					                        		<a href="{{ url(strtolower($page_title).'/'.$ongoing->slug) }}"><img src="{{ url('sag-events/'.$ongoing->event_id.'/'.$ongoing->event_img)}}" alt="{{ $ongoing->title }}" class="four-radius"></a>
					                        	@endif
					                        </div>
					                        <div class="span7">
					                            <h3 class="news-title"> 
					                            	<a href="{{ url(strtolower($page_title).'/'.$ongoing->slug) }}">{{ $ongoing->title }}</a> 
					                            </h3>
					                            <p>{{ $ongoing->summary }}</p>
					                            <div class="meta">
					                                <span> 
					                                	<i class="icon-time mi"></i>{{ Carbon\Carbon::parse($ongoing->start_date)->format('M d, Y').' - '.Carbon\Carbon::parse($ongoing->end_date)->format('M d, Y') }}  
					                                </span> | 
					                                <span title="# Registred Users"> 
					                                	<i class="icon-user"></i> {{ App\EventReg::where('event_id', $ongoing->event_id)->count() }} 
					                                </span>
					                            </div><!-- meta -->
					                            <a href="{{ url(strtolower($page_title).'/'.$ongoing->slug) }}" class="sign-btn tbutton small"><span>Read More</span></a>
					                        </div><!-- span7 -->
					                    </div><!-- news -->
				                    @endforeach
			                    @else
									<h3 class="text text-center">No Ongoing {{ $page_title }}.</h3>
								@endif
			                </div>
						</li><!-- tab content -->

						<li id="Upcoming">
							<div class="def-block">
								@if(count($results['upcoming']))
									@foreach($results['upcoming'] as $upcoming)
					                    <div class="news row-fluid animtt" data-gen="fadeUp" style="opacity:0;">
					                        <div class="span5">
					                        	@if($upcoming->event_img == '')
					                        		@if($page_title == 'Event')
					                        			<a href="{{ url(strtolower($page_title).'/'.$upcoming->slug) }}"><img src="{{ url('images/assets/sag_event.png')}}" alt="{{ $upcoming->title }}" class="four-radius"></a>
					                        		@else
					                        			<a href="{{ url(strtolower($page_title).'/'.$upcoming->slug) }}"><img src="{{ url('images/assets/sag_tradeshow.png')}}" alt="{{ $upcoming->title }}" class="four-radius"></a>
					                        		@endif
					                        	@else
					                        		<a href="{{ url(strtolower($page_title).'/'.$upcoming->slug) }}"><img src="{{ url('sag-events/'.$upcoming->event_id.'/'.$upcoming->event_img)}}" alt="{{ $upcoming->title }}" class="four-radius"></a>
					                        	@endif
					                        </div>
					                        <div class="span7">
					                            <h3 class="news-title"> 
					                            	<a href="{{ url(strtolower($page_title).'/'.$upcoming->slug) }}">{{ $upcoming->title }}</a> 
					                            </h3>
					                            <p>{{ $upcoming->summary }}</p>
					                            <div class="meta">
					                                <span> 
					                                	<i class="icon-time mi"></i>{{ Carbon\Carbon::parse($upcoming->start_date)->format('M d, Y').' - '.Carbon\Carbon::parse($upcoming->end_date)->format('M d, Y') }}  
					                                </span> | 
					                                <span> 
					                                	<i class="icon-user"></i> {{ App\EventReg::where('event_id', $upcoming->event_id)->count() }} 
					                                </span>
					                            </div><!-- meta -->
					                            <a href="{{ url(strtolower($page_title).'/'.$upcoming->slug) }}" class="sign-btn tbutton small"><span>Read More</span></a>
					                        </div><!-- span7 -->
					                    </div><!-- news -->
				                    @endforeach
			                    @else
									<h3 class="text text-center">No upcoming {{ $page_title }}.</h3>
								@endif
							</div>
						</li><!-- tab content -->

						<li id="Past">
							<div class="def-block">
								@if(count($results['past']))
									@foreach($results['past'] as $past)
					                    <div class="news row-fluid animtt" data-gen="fadeUp" style="opacity:0;">
					                        <div class="span5">
					                        	@if($past->event_img == '')
					                        		@if($page_title == 'Event')
					                        			<a href="{{ url(strtolower($page_title).'/'.$past->slug) }}"><img src="{{ url('images/assets/sag_event.png')}}" alt="{{ $past->title }}" class="four-radius"></a>
					                        		@else
					                        			<a href="{{ url(strtolower($page_title).'/'.$past->slug) }}"><img src="{{ url('images/assets/sag_tradeshow.png')}}" alt="{{ $past->title }}" class="four-radius"></a>
					                        		@endif
					                        	@else
					                        		<a href="{{ url(strtolower($page_title).'/'.$past->slug) }}"><img src="{{ url('sag-events/'.$past->event_id.'/'.$past->event_img)}}" alt="{{ $past->title }}" class="four-radius"></a>
					                        	@endif
					                        	<?php 
													/*$imgs = explode(',', $past->images);
													foreach ($imgs as $img) {
														if (trim($img) != "") {
															if (file_exists(public_path('events/'.$past->event_id.'/'.$img))) {
																echo '<a href="'.url('event/'.$past->slug).'"><img src="'.url('events/'.$past->event_id.'/'.$img).'" alt="'.$past->title.'" class="four-radius"></a>';
																break;
															}
														}
													}*/
												?>
					                        	<!-- <img class="four-radius" src="images/assets/fe.jpg" alt="#"> -->
					                        </div>
					                        <div class="span7">
					                            <h3 class="news-title"> 
					                            	<a href="{{ url(strtolower($page_title).'/'.$past->slug) }}">{{ $past->title }}</a> 
					                            </h3>
					                            <p>{{ $past->summary }}</p>
					                            <div class="meta">
					                                <span> 
					                                	<i class="icon-time mi"></i>{{ Carbon\Carbon::parse($past->start_date)->format('M d, Y').' - '.Carbon\Carbon::parse($past->end_date)->format('M d, Y') }}  
					                                </span> | 
					                                <span> 
					                                	<i class="icon-user"></i> {{ App\EventReg::where('event_id', $past->event_id)->count() }} 
					                                </span>
					                            </div><!-- meta -->
					                            <a href="{{ url(strtolower($page_title).'/'.$past->slug) }}" class="sign-btn tbutton small"><span>Read More</span></a>
					                        </div><!-- span7 -->
					                    </div><!-- news -->
				                    @endforeach
			                    @else
									<h3 class="text text-center">No Past {{ $page_title }}.</h3>
								@endif
							</div>
						</li><!-- tab content -->
					</ul><!-- end tabs -->
				</div><!-- def block -->
			</div><!-- posts -->
			<div class="span4 sidebar">
				@include('includes.sag_ads')
				
				@include('includes.ad_here')
				@include('includes.newsletter')
			</div>

		</div><!-- row clearfix -->
	</div><!-- end page content -->
@endsection

@push('scripts')
	@include('includes.scripts')
@endpush