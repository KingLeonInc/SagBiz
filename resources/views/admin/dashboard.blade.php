@extends('admin.adminmaster')

@section('title')
	<title>Dashboard - Admin | SAG PLC</title>
@endsection

@section('content')
	
	<!-- Small boxes (Stat box) -->
	  <div class="row col-lg-10 col-md-10 col-lg-offset-1 col-md-offset-1">
	    <div class="col-lg-6 col-md-6 col-xs-6">
	      <!-- small box -->
	      <div class="small-box bg-aqua">
	        <div class="inner">
	          <h3>{{ $results['events']['total'] }}</h3>
	          <p>Events</p>
	        </div>
	        <div class="icon">
	          <i class="ion ion-flag"></i>
	        </div>
	        <div class="row">
	        	<div class="col-md-4 col-sm-4 text-center"><h3>{{ $results['events']['ongoing'] }}</h3>Ongoing</div>
	        	<div class="col-md-4 col-sm-4 text-center"><h3>{{ $results['events']['upcoming'] }}</h3>Upcoming</div>
	        	<div class="col-md-4 col-sm-4 text-center"><h3>{{ $results['events']['past'] }}</h3>Past</div>
	        </div> <br>
	        <div class="clearfix"></div>
	        <a href="{{ url('admin/events')}}" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
	      </div>
	    </div><!-- ./col -->
	    <div class="col-lg-6 col-md-6 col-xs-6">
	      <!-- small box -->
	      <div class="small-box bg-green">
	        <div class="inner">
	          <h3>{{ $results['tradeshows']['total'] }}</h3>
	          <p>Tradeshows</p>
	        </div>
	        <div class="icon">
	          <i class="ion ion-star"></i>
	        </div>
	        <div class="row">
	        	<div class="col-md-4 col-sm-4 text-center"><h3>{{ $results['tradeshows']['ongoing'] }}</h3>Ongoing</div>
	        	<div class="col-md-4 col-sm-4 text-center"><h3>{{ $results['tradeshows']['upcoming'] }}</h3>Upcoming</div>
	        	<div class="col-md-4 col-sm-4 text-center"><h3>{{ $results['tradeshows']['past'] }}</h3>Past</div>
	        </div> <br>
	        <div class="clearfix"></div>
	        <a href="{{ url('admin/tradeshows')}}" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
	      </div>
	    </div><!-- ./col -->
	    <div class="clearfix"></div>
	    <div class="col-lg-6 col-md-6 col-xs-6">
	      <!-- small box -->
	      <div class="small-box bg-yellow">
	        <div class="inner">
	          <h3>{{ $results['subscribers']['total'] }}</h3>
	          <p>Subscribers</p>
	        </div>
	        <div class="icon">
	          <i class="ion ion-person-add"></i>
	        </div>
	        <div class="row">
	        	<div class="col-md-4 col-sm-4 text-center"><h3>{{ $results['subscribers']['last_week'] }}</h3>Past Week</div>
	        	<div class="col-md-4 col-sm-4 text-center"><h3>{{ $results['subscribers']['last_month'] }}</h3>Past Month</div>
	        	<div class="col-md-4 col-sm-4 text-center"><h3>{{ $results['subscribers']['last_year'] }}</h3>Past year</div>
	        </div> <br>
	        <a href="{{ url('admin/subscriptions')}}" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
	      </div>
	    </div><!-- ./col -->
	    <div class="col-lg-6 col-md-6 col-xs-6">
	      <!-- small box -->
	      <div class="small-box bg-purple">
	        <div class="inner">
	          <h3>{{ $results['ads']['total'] }}</h3>
	          <p>Ads</p>
	        </div>
	        <div class="icon">
	          <i class="ion ion-person-add"></i>
	        </div>
	        <div class="row">
	        	<div class="col-lg-6 col-md-6 col-sm-6 text-center"><h3>{{ $results['ads']['photo_ads'] }}</h3>Photo Ads</div>
	        	<div class="col-lg-6 col-md-6 col-sm-6 text-center"><h3>{{ $results['ads']['video_ads'] }}</h3>Video Ads</div>
	        </div> <br>
	        <a href="{{ url('admin/ads')}}" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
	      </div>
	    </div><!-- ./col -->
	  </div><!-- /.row -->
	  <!-- Main row -->
	  <div class="clearfix"></div>
@endsection