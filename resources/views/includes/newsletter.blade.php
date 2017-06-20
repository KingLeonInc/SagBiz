<div class="def-block widget">
	<h4> NewsLetters </h4><span class="liner"></span>
	<div class="widget-content">
		<p>Subscribe to our newsletter and get instant news and messages.</p>
		{!! Form::open(['url'=>'newsletter-subscription', 'id'=>'newsletters']) !!}
			<input type="email" name="email" placeholder="Type Your Email" required="required">
			<input type="text" name="name" style="margin-top: 10px;" placeholder="Your Name">
			<button type="submit"><i class="icon-ok"></i></button>
			<p id="subsn_msg"></p>
		{!! Form::close() !!}
	</div>
</div>