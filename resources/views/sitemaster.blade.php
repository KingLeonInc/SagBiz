<!DOCTYPE html>
<!--[if IE 7 ]><html class="ie7" lang="en"> <![endif]-->
<!--[if IE 8 ]><html class="ie8" lang="en"> <![endif]-->
<!--[if IE 9 ]><html class="ie9" xmlns="http://www.w3.org/1999/xhtml" lang="en-US"> <![endif]-->
<!--[if (gte IE 10)|!(IE)]><!-->
<html xmlns="http://www.w3.org/1999/xhtml" lang="en-US">
<!--<![endif]-->
<head>
	@yield('title')
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1" />
	<!-- Seo Meta -->
		<meta name="description" content="Remix - Music & Band Site Template HTML5 and CSS3">
		<meta name="keywords" content="remix, music, light, dark, themeforest, multi purpose, band, css3, html5">

	<!-- Styles -->
		<link rel="stylesheet" type="text/css" href="{{ url('bootstrap/css/bootstrap.min.css') }}" media="screen" />
		<link rel="stylesheet" type="text/css" href="{{ url('bootstrap/css/bootstrap-responsive.min.css') }}" media="screen" />
		@if( Date("H") >= 12 && Date("H") <=24 )
			<link rel="stylesheet" type="text/css" href="{{ url('style.css') }}" id="dark" media="screen" />
		@else	
			<link rel="stylesheet" type="text/css" href="{{ url('style.css') }}" id="dark" media="screen" />
			<link rel="stylesheet" type="text/css" href="{{ url('styles/light.css')}}" id="light" media="screen" />
		@endif
		<link rel="stylesheet" type="text/css" href="{{ url('js/rs-plugin/css/settings.css') }}" media="screen" />
		<link rel="stylesheet" type="text/css" href="{{ url('styles/icons/icons.css') }}" media="screen" />
		<link href='http://fonts.googleapis.com/css?family=Oswald' rel='stylesheet' type='text/css'>

	<!-- Favicon -->
		<link rel="shortcut icon" href="{{ url('images/favicon.ico') }}">
		<link rel="apple-touch-icon" href="{{ url('images/apple-touch-icon.png') }}">

	<!--[if IE]>
		<meta http-equiv="X-UA-Compatible" content="IE=9; IE=8; IE=EmulateIE8; IE=EDGE" />
		<script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
		<link rel="stylesheet" type="text/css" href="styles/icons/font-awesome-ie7.min.css" />
	<![endif]-->

	<style type="text/css">
		#contactForm #sendMessage, .tp-caption.big_orange, #commentform .send-message, ul.showcomments .reply a:hover, #loginform #login-button, .dropcap, #toTop:hover, li.track:hover .buy, .playing .buy, .tbutton, .sf-menu li.back .left, .ttw-music-player .elapsed {
		    background-color: #99CB34 !important; // 2d690a
		}
	</style>
</head>
<body id="fluidGridSystem">
	<div id="layout" class="full">
		<!-- popup login -->
		<div id="popupLogin">
			<div class="def-block widget">
				<h4> Sign In </h4><span class="liner"></span>
				<div class="widget-content row-fluid">
					<form id="popup_login_form" action="{{ url('login') }}" action="POST">
						{{ csrf_field() }}
						<input type="email" name="login_username" id="login_username" value="" placeholder="Email" style="color: black;" required>
						<input type="password" name="login_password" id="login_password" value="" placeholder="Password" style="color: black;" required>
						<button type="submit" class="tbutton small"><span>Sign In</span></button>
						<!-- <a href="#" class="tbutton color2 small"><span>Register</span></a> -->
						<p id="login_msg"></p>
					</form><!-- login form -->
				</div><!-- content -->
			</div><!-- widget -->
			<div id="popupLoginClose">x</div>
		</div><!-- popup login -->
		<div id="LoginBackgroundPopup"></div>
		<!-- popup login -->

		@include('includes.header')

		@yield('content')

		@include('includes.footer')

	</div><!-- end layout -->


<!-- Scripts -->
@stack('scripts')

<script>
	jQuery(document).ready(function($){
		var version = 'dark';
		var twelve_hrs = 12*60*60*1000;
		//var time = new Date();
		setInterval(function(){
			//console.log('Hrs = ' + time.getHours());
			if( version == 'light' ){
				//$('head').append('<link rel="stylesheet" type="text/css" href="/laravel_5.4/sag/public/styles/light.css" id="light" media="screen" />');
				//$('.logo a').html('<img src="images/logo_light.png" alt="Best and Most Popular Musics">');
				//version = 'dark';
			} else if(version == 'dark') {
				$('head #light').remove();
				//$('.logo a').html('<img src="images/logo.png" alt="Best and Most Popular Musics">');
				//version = 'light';
			}
		}, 10000);
		/* LOGIN A USER */
		$('#popup_login_form').submit(function(e){
			e.preventDefault();
			$.ajax({
				url: $(this).attr('action'),
				method: 'POST',
				data: $(this).serialize(),
				success: function(response){
					console.log(response);
					if (response.success) {
						$(location).attr('href', "{{ url('home')}}");
					}else{
						$('#login_msg').html('<p class="text-danger">'+response.msg+'</div>');
						$('#login_username').val('');
						$('#login_password').val('');
					}
				}
			});
		});
		// NEWSLETTER SUBSCRIPTION
		$('#newsletters').submit(function(e){
			e.preventDefault();
			$.ajax({
				url: $(this).attr('action'),
				method: 'POST',
				data: $(this).serialize(),
				success: function(response){
					console.log(response);
					if (response.success) {
						$('#subsn_msg').html('<p class="text-success">'+response.msg+'</div>');
						$('#newsletters input[type="text"]').val('');
						$('#newsletters input[type="email"]').val('');
					}
				}
			});
		});
	});
</script>
	
</body>
</html>