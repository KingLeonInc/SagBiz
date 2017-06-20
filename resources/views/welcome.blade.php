
@extends('sitemaster')

@section('title')
    <title>Welcome | SAG Business PLC</title>
@endsection

@section('content')
    <!-- Start Revolution Slider -->
    <div class="sliderr">
        <div class="fullwidthbanner-container">                 
            <div class="revolution">
                <ul>
                    <!-- <li data-transition="random" data-slotamount="7" data-masterspeed="300" >
                        <img src="images/slides/s1.jpg" alt="slider" >
                                                
                        <div class="tp-caption fade"  
                             data-x="566" 
                             data-y="306" 
                             data-speed="300" 
                             data-start="800" 
                             data-easing="easeInOutExpo"  ><img src="images/slides/slide1-cap1.png" alt="Image 2"></div>
                                        
                        <div class="tp-caption sfl"  
                             data-x="566" 
                             data-y="305" 
                             data-speed="300" 
                             data-start="1200" 
                             data-easing="easeInOutExpo"  ><img src="images/slides/sag-letter.png" alt="Image 3"></div>
                                        
                        <div class="tp-caption sfr"  
                             data-x="741" 
                             data-y="305" 
                             data-speed="300" 
                             data-start="1200" 
                             data-easing="easeInOutExpo"  ><img src="images/slides/sag-biz.png" alt="Image 4"></div>
                                        
                        <div class="tp-caption sfr"  
                             data-x="711" 
                             data-y="374" 
                             data-speed="300" 
                             data-start="2000" 
                             data-easing="easeInOutExpo"  ><a href="mp3_single_half.html"><img src="images/slides/slide1-cap4.png" alt="Image 5"></a></div>
                                        
                        <div class="tp-caption sfl"  
                             data-x="714" 
                             data-y="375" 
                             data-speed="300" 
                             data-start="2000" 
                             data-easing="easeInOutExpo"  ><img src="images/slides/slide1-cap5.png" alt="Image 6"></div>
                    </li>

                    <li data-transition="random" data-slotamount="7" data-masterspeed="300" >
                        <img src="images/slides/s2.png" alt="slider2" >
                                                
                        <div class="tp-caption big_black randomrotate"  
                             data-x="603" 
                             data-y="384" 
                             data-speed="500" 
                             data-start="1200" 
                             data-easing="easeInOutExpo"  >New Attraction, New Excitment</div>
                                        
                        <div class="tp-caption big_orange randomrotate"  
                             data-x="701" 
                             data-y="328" 
                             data-speed="500" 
                             data-start="1700" 
                             data-easing="easeInOutExpo"  >Addis Ababa </div>
                    </li> -->

                    <li data-transition="random" data-slotamount="7" data-masterspeed="300" >
                        <img src="images/slides/s3.png" alt="slider3" >
                                                                
                        <div class="tp-caption large_text randomrotate"  
                             data-x="559" 
                             data-y="253" 
                             data-speed="500" 
                             data-start="1000" 
                             data-easing="easeInOutExpo"  >SAG Buisness PLC</div>
                                        
                        <div class="tp-caption medium_text randomrotate"  
                             data-x="563" 
                             data-y="313" 
                             data-speed="500" 
                             data-start="1500" 
                             data-easing="easeInOutExpo"  >Awesome Products</div>
                                        
                        <div class="tp-caption medium_text randomrotate"  
                             data-x="565" 
                             data-y="345" 
                             data-speed="500" 
                             data-start="2000" 
                             data-easing="easeInOutExpo"  >Wonderful Services</div>
                                        
                        <div class="tp-caption medium_text randomrotate"  
                             data-x="567" 
                             data-y="377" 
                             data-speed="500" 
                             data-start="2500" 
                             data-easing="easeInOutExpo"  >Good Reputations</div>
                                        
                        <div class="tp-caption small_text randomrotate"  
                             data-x="566" 
                             data-y="407" 
                             data-speed="500" 
                             data-start="3000" 
                             data-easing="easeInOutExpo"  >and Much More ...</div>
                    </li>
                </ul><!-- End Slides -->
                <div class="tp-bannertimer"></div><!-- Timer -->                                        
            </div>                  
        </div>
    </div>
    <!-- End Revolution Slider -->

    <div class="page-content">
        <div class="row clearfix mbf">
            <!-- <div class="music-player-list"></div> -->
        </div><!-- row music player -->

        <div class="row row-fluid clearfix mbf">
            <div class="span8">
                <div class="def-block">
                    @if(isset($results))
                        @if(count($results['latest_events']))
                            <h4> Events </h4><span class="liner"></span>
                            @foreach($results['latest_events'] as $latest_event)
                                <div class="news row-fluid animtt" data-gen="fadeUp" style="opacity:0;">
                                    <div class="span5">
                                        @if($latest_event->event_img == '')
                                           <a href="{{ url('event/'.$latest_event->slug) }}"><img src="{{ url('images/assets/sag_event.png')}}" alt="{{ $latest_event->title }}" class="four-radius"></a>
                                        @else
                                            <a href="{{ url('event/'.$latest_event->slug) }}"><img src="{{ url('sag-events/'.$latest_event->event_id.'/'.$latest_event->event_img)}}" alt="{{ $latest_event->title }}" class="four-radius"></a>
                                        @endif
                                    </div>
                                    <div class="span7">
                                        <h3 class="news-title"> 
                                            <a href="{{ url('event/'.$latest_event->slug) }}">{{ $latest_event->title }}</a> 
                                        </h3>
                                        <p>{{ $latest_event->summary }}</p>
                                        <div class="meta">
                                            <span> 
                                                <i class="icon-time mi"></i>{{ Carbon\Carbon::parse($latest_event->start_date)->format('M d, Y').' - '.Carbon\Carbon::parse($latest_event->end_date)->format('M d, Y') }}  
                                            </span> | 
                                            <span title="# Registred Users"> 
                                                <i class="icon-user"></i> {{ App\EventReg::where('event_id', $latest_event->event_id)->count() }} 
                                            </span>
                                        </div><!-- meta -->
                                        <a href="{{ url('event/'.$latest_event->slug) }}" class="sign-btn tbutton small"><span>Read More</span></a>
                                    </div><!-- span7 -->
                                </div><!-- news -->
                            @endforeach
                            <div class="load-news tac"><a href="{{ url('our-events')}}" class="tbutton small"><span>Show all</span></a></div>
                        @endif
                        <div class="clearfix"></div>
                        @if(count($results['latest_tradeshows']))
                            <h4> Tradeshows </h4><span class="liner"></span>
                            @foreach($results['latest_tradeshows'] as $latest_event)
                                <div class="news row-fluid animtt" data-gen="fadeUp" style="opacity:0;">
                                    <div class="span5">
                                        @if($latest_event->event_img == '')
                                           <a href="{{ url('tradeshow/'.$latest_event->slug) }}"><img src="{{ url('images/assets/sag_event.png')}}" alt="{{ $latest_event->title }}" class="four-radius"></a>
                                        @else
                                            <a href="{{ url('tradeshow/'.$latest_event->slug) }}"><img src="{{ url('sag-events/'.$latest_event->event_id.'/'.$latest_event->event_img)}}" alt="{{ $latest_event->title }}" class="four-radius"></a>
                                        @endif
                                    </div>
                                    <div class="span7">
                                        <h3 class="news-title"> 
                                            <a href="{{ url('tradeshow/'.$latest_event->slug) }}">{{ $latest_event->title }}</a> 
                                        </h3>
                                        <p>{{ $latest_event->summary }}</p>
                                        <div class="meta">
                                            <span> 
                                                <i class="icon-time mi"></i>{{ Carbon\Carbon::parse($latest_event->start_date)->format('M d, Y').' - '.Carbon\Carbon::parse($latest_event->end_date)->format('M d, Y') }}  
                                            </span> | 
                                            <span title="# Registred Users"> 
                                                <i class="icon-user"></i> {{ App\EventReg::where('event_id', $latest_event->event_id)->count() }} 
                                            </span>
                                        </div><!-- meta -->
                                        <a href="{{ url('tradeshow/'.$latest_event->slug) }}" class="sign-btn tbutton small"><span>Read More</span></a>
                                    </div><!-- span7 -->
                                </div><!-- news -->
                            @endforeach
                            <div class="load-news tac"><a href="{{ url('tradeshows')}}" class="tbutton small"><span>Show all</span></a></div>
                        @endif
                        <div class="clearfix"></div>
                        @if($results['total'] == 0)
                            <h4>Our Services</h4>
                            <div class="news row-fluid animtt">
                                <div class="span5">
                                    <a href="{{ url('services/public_park_development')}}">
                                        <img src="{{ url('images/assets/public_park1.JPG') }}" alt="#">
                                    </a>
                                </div>
                                <div class="span7">
                                    <h3 class="news-title"> <i class="icon-play"></i> <a href="{{ url('services/public_park_development')}}">Public Park Development</a> </h3>
                                    <p>we strive to create vibrant socially active parks for the society by collaboratlly working hand in hand with 
                                        the government, the society, business and NGOs to make Addis Ababa one of the greenest and cleanest cities in the world.</p>
                                    <a href="{{ url('services/public_park_development')}}" class="Rmore tbutton small"><span>Read More</span></a>
                                </div>
                            </div>
                            <div class="news row-fluid animtt">
                                <div class="span5">
                                    <a href="{{ url('services/land_scape_managment')}}"><img src="{{ url('images/assets/landscape_manag1.jpg') }}" alt="#"></a>
                                </div>
                                <div class="span7">
                                    <h3 class="news-title"> <i class="icon-play"></i> <a href="{{ url('services/land_scape_managment')}}">Landscape Managment</a> </h3>
                                    <p>We offer a fully comprehensive one stop shop for all aspects of landscape maintenance. Our services extend from the smallest house lawn care to the very complicated public parks and recreational centers. We have a "no job is too small" approach to providing a service with high standard; taking in to consideration the wants and needs of our clients.</p>
                                    <a href="{{ url('services/land_scape_managment')}}" class="Rmore tbutton small"><span>Read More</span></a>
                                </div><!-- post -->
                            </div>
                            <div class="news row-fluid animtt">
                                <div class="span5">
                                    <a href="{{ url('services/textile_and_stationary_product')}}"><img src="{{ url('images/assets/textile3.jpg') }}" alt="#"></a>
                                </div>
                                <div class="span7">
                                    <h3 class="news-title"> <i class="icon-play"></i> <a href="{{ url('services/textile_and_stationary_product')}}">Textile and Stationary Products</a> </h3>
                                    <p>Our foundation is laid in providing superior quality products at a competitive price delivered by unmatched customer service. we offer a large product range of textile and stationary supplies.</p>
                                    <a href="{{ url('services/textile_and_stationary_product')}}" class="Rmore tbutton small"><span>Read More</span></a>
                                </div>
                            </div>
                        @endif
                    @endif

                </div><!-- def block -->
            </div><!-- span8 news -->

            <div class="span4">
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


