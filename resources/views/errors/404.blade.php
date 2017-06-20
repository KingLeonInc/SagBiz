@extends('sitemaster')

@section('title')
	<title> Page not found | SAG Buisness PLC</title>
@endsection

@section('content')
	<div class="under_header">
		<img src="images/assets/breadcrumbs14.png" alt="#">
	</div><!-- under header -->

	<div class="page-content back_to_up">
		<div class="row clearfix mb">
			<div class="breadcrumbIn">
				<ul>
					<li><a href="{{ url('')}}" class="toptip" original-title="Homepage"> <i class="icon-home"></i> </a></li>
					<li> Page Not Found </li>
				</ul>
			</div><!-- breadcrumb -->
		</div><!-- row -->

		<div class="row row-fluid clearfix mbf">
			<div class="posts">
				<div class="def-block">
					<div class="tac error-page clearfix">
						<i class="icon-warning-sign"></i>
						<h2 class="tac"> PAGE NOT FOUND <small> The page you are looking for might have been removed / had its name changed. </small></h2>
						<a href="{{ url('')}}" class="tbutton medium"><span>Back To Homepage</span></a>
					</div>
				</div><!-- def block -->
			</div><!-- posts -->

		</div><!-- row clearfix -->
	</div><!-- end page content -->
@endsection

@push('scripts')
	@include('includes.scripts')
@endpush