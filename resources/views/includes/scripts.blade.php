<script type="text/javascript" src="{{ url('js/jquery.min.js') }}"></script>
<script type="text/javascript" src="{{ url('js/theme20.js') }}"></script>
<script type="text/javascript" src="{{ url('bootstrap/js/bootstrap.min.js') }}"></script>
<script type="text/javascript" src="{{ url('js/rs-plugin/pluginsources/jquery.themepunch.plugins.min.js') }}"></script>	
<script type="text/javascript" src="{{ url('js/rs-plugin/js/jquery.themepunch.revolution.min.js') }}"></script>
<script type="text/javascript" src="{{ url('js/jquery.prettyPhoto.js') }}"></script>
<script type="text/javascript" src="{{ url('js/jquery.flexslider-min.js') }}"></script>
<script type="text/javascript" src="{{ url('js/jquery.jplayer.js') }}"></script>
<script type="text/javascript" src="{{ url('js/ttw-music-player-min.js') }}"></script>
<script type="text/javascript" src="{{ url('music/myplaylist.js') }}"></script>
<script type="text/javascript" src="{{ url('js/jquery.nanoscroller.js') }}"></script>
<script type="text/javascript" src="{{ url('js/twitter/jquery.tweet.js') }}"></script>
<script type="text/javascript" src="{{ url('js/custom.js') }}"></script>
<script type="text/javascript">	
/* <![CDATA[ */
	var tpj=jQuery;
	tpj.noConflict();
	tpj(document).ready(function() {
	if (tpj.fn.cssOriginal!=undefined)
		tpj.fn.css = tpj.fn.cssOriginal;
		var api= tpj('.revolution').revolution({
			delay:9000,
			startheight:380,
			startwidth:960,
			hideThumbs:200,
			thumbWidth:80,
			thumbHeight:50,
			thumbAmount:5,
			navigationType:"none",
			navigationArrows:"verticalcentered",
			navigationStyle:"square",	
			touchenabled:"on", 
			onHoverStop:"on", 
			navOffsetHorizontal:0,
			navOffsetVertical:20,
			shadow:0
		});
	});
/* ]]> */
</script>