<header id="header" class="glue">
			<div class="row clearfix">
				<div class="little-head">
					<div id="Login_PopUp_Link" class="sign-btn tbutton small"><span>Sign In</span></div>

					<div class="social social-head">
						<a href="https://twitter.com/SAG_Bisuness" class="bottomtip" title="Follow us on Twitter" target="_blank"><i class="icon-twitter"></i></a>
						<a href="https://www.facebook.com/SAG-Business-PLC-1042680655867726" class="bottomtip" title="Like us on Facebook" target="_blank"><i class="icon-facebook"></i></a>
						<a href="https://plus.google.com/103893065977442858694" class="bottomtip" title="GooglePlus" target="_blank"><i class="icon-google-plus"></i></a>
						<a href="https://www.instagram.com/pages/SAG-Biz/154664684553091" class="bottomtip" title="instagram" target="_blank"><i class="icon-instagram"></i></a>
						<!-- <a href="#" class="bottomtip" title="Dribbble" target="_blank"><i class="icon-dribbble"></i></a>
						<a href="#" class="bottomtip" title="Soundcloud" target="_blank"><i class="icon-cloud"></i></a>
						<a href="#" class="bottomtip" title="Linkedin" target="_blank"><i class="icon-linkedin"></i></a> -->
					</div><!-- end social -->

					<!-- <div class="search">
						<form action="#" id="search" method="get">
							<input id="inputhead" name="search" type="text" onfocus="if (this.value=='Start Searching...') this.value = '';" onblur="if (this.value=='') this.value = 'Start Searching...';" value="Start Searching..." placeholder="Start Searching ...">
							<button type="submit"><i class="icon-search"></i></button>
						</form>
					</div> -->
				</div><!-- little head -->
			</div><!-- row -->

			<div class="headdown">
				<div class="row clearfix">
					<div class="logo bottomtip" title="We guarentee best services">
						<a href="{{ url('')}}"><img src="{{ url('images/logo3.png') }}" alt="SAG Logo"></a>
					</div><!-- end logo -->

					<nav>
						<ul class="sf-menu">
							<li class="@if(Request::is('/')) current @endif"><a href="{{ url('')}}">Home<span class="sub">start here</span></a></li>
							<li class="@if(Request::is('services') || Request::is('services/*')) current  @endif"><a href="{{ url('services')}}">Services <span class="sub">what we offer</span></a>
								{{-- <ul>
									<li><a href="{{ url('services/public_park_development')}}">Public Park Development</a></li>
									<li><a href="{{ url('services/land_scape_managment')}}">Landscape Managment</a></li>
									<li><a href="{{ url('services/textile_and_stationary_product')}}">Textile and Stationary Products</a></li>
									<li><a href="{{ url('services/cleaning_supplies')}}">Cleaning Supplies</a></li>
								</ul> --}}
							</li>
							<li class="@if(Request::is('our-events') || Request::is('event/sample')) current @endif"><a href="{{ url('our-events')}}">Events<span class="sub">What's new</span></a></li>
							<li class="@if(Request::is('tradeshows') || Request::is('tradeshow/sample')) current @endif"><a href="{{ url('tradeshows')}}">Tradeshows<span class="sub">What's new</span></a></li>
							<li class="@if(Request::is('gallery')) current @endif"><a href="{{ url('gallery')}}">Gallery<span class="sub">latest pics</span></a></li>
							<li class="@if(Request::is('contact')) current @endif"><a href="{{ url('contact')}}">Contact<span class="sub">stay in touch</span></a></li>
							
						</ul><!-- end menu -->
					</nav><!-- end nav -->
				</div><!-- row -->
			</div><!-- headdown -->
		</header><!-- end header -->