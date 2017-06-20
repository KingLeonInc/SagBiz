@extends('admin.adminmaster')

@section('title')
	<title>{{ $results['create_or_update'].' '.$results['title'] }} | SAG PLC</title>
@endsection

@section('breadcrumb')
  <section class="content-header">
      <h1>
        {{ $results['create_or_update'] }} a New {{ $results['title'] }}
        <small>SAG PLC</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="{{ url('home')}}"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="{{ url('admin/ads')}}"><i class="fa fa-flag"></i> {{ $results['title'] }}s</a></li>
        <li class="active">{{ $results['create_or_update'] }} {{ $results['title'] }}</li>
      </ol>
  </section>
@endsection

@section('content')
	<div class="row">
      <div class="col-md-3 col-lg-3">
        @if(count($results['recent_ads']))
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Recent {{ $results['title'] }}</h3>
            </div><!-- /.box-header -->
            <div class="box-body">
              <ul class="products-list product-list-in-box">
                  @foreach($results['recent_ads'] as $ad)
                    <li class="item">
                      <!-- <div class="product-img">
                        <img src="{{ url('admin/dist/img/default-50x50.gif') }}" alt="Product Image">
                      </div> -->
                      <div class="">
                        <a href="{{ url('admin/ad/'.$ad->ad_id) }}" class="product-title">{{ $ad->ad_title }} </a>
                        <span class="product-description">
                          {{ Carbon\Carbon::parse($ad->add_start_date)->format('m/d/Y').' - '.Carbon\Carbon::parse($ad->add_end_date)->format('m/d/Y') }}
                        </span>
                      </div>
                    </li><!-- /.item -->
                  @endforeach
              </ul>
            </div><!-- /.box-body -->
            <div class="box-footer text-center">
              <a href="{{ url('admin/ads')}}" class="uppercase">View All Ads</a>
            </div><!-- /.box-footer -->
          </div>
        @else
          <div class="box box-primary">
            <div class="box-body box-profile">
              <h3 class="profile-username text-center">No Ads Yet</h3>
              <p class="text-muted text-center">SAG BIZ</p>

              <ul class="list-group list-group-unbordered">
                <li class="list-group-item">
                  <b>Photo Ads</b> <a class="pull-right">0</a>
                </li>
                <li class="list-group-item">
                  <b>Video Ads</b> <a class="pull-right">0</a>
                </li>
              </ul>
              <a href="{{ url('admin/ad/create') }}" class="btn btn-primary btn-block"><b>Create an Ad</b></a>
            </div><!-- /.box-body -->
          </div>
        @endif
      </div>
      <div class="col-md-9 col-lg-9">
          <div class="box box-success">
              <div class="box-header">
                  <h3 class="text-primary">{{ $results['create_or_update'] }} an Ad</h3>
                  <div class="box-tools pull-right"><a href="{{ url('admin/ad/create') }}"><span class="fa fa-plus"></span> Create An Ad</a></div>
              </div>
              <div class="box-body">
                  @if(session('response'))
                    <div class="alert @if(session('response')['success']) alert-success @else alert-danger @endif alert-dismissible">
                      <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                      <h4><i class="icon fa @if(session('response')['success']) fa-check @else fa-ban @endif"></i> @if(session('response')['success']) Success @else Error @endif</h4>
                      {{ session('response')['msg'] }}
                    </div>
                  @endif
                  @if($results['create_or_update'] == 'Create')
                    {!! Form::open(['url' => 'admin/ad/create', 'id'=>'', 'class' => 'form', 'enctype'=>'multipart/form-data']) !!}
                        @include('admin.includes.create_ad_form', ['createOrUpdate'=>'create', 'submitBtnText' => 'Create Ad' ])
                    {!! Form::close() !!}
                  @elseif($results['create_or_update'] == 'Update')
                    {!! Form::model($results['ad'], ['url' => 'admin/ad/create', 'id'=>'', 'class' => 'form', 'enctype'=>'multipart/form-data']) !!}
                        @include('admin.includes.create_ad_form', ['createOrUpdate'=>'update', 'submitBtnText' => 'Update Ad' ])
                    {!! Form::close() !!}
                  @endif
              </div>
          </div>
      </div>
  </div>
  <!-- Modal -->
  <div class="modal fade" id="createNewEventOrTradeshowHostModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        {!! Form::open(['url'=>'admin/create-host', 'id'=>'creat_new_host_form', 'class'=>'form form-horizontal']) !!}
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title" id="myModalLabel">Create a New Event/Tradeshow Host</h4>
          </div>
          <div class="modal-body">
            <div class="form-group clearfix">
              <label for="host_name" class="col-sm-2 control-label">Name</label>
              <div class="col-sm-10">
                <input type="text" name="name" class="form-control clear_input_field" id="host_name" placeholder="Name" required>
              </div>
            </div>
            <div class="form-group clearfix">
              <label for="host_company" class="col-sm-2 control-label">Company</label>
              <div class="col-sm-10">
                <input type="text" name="company" class="form-control clear_input_field" id="host_company" placeholder="Company Name" required>
              </div>
            </div>
            <div class="form-group clearfix">
              <label for="host_phone" class="col-sm-2 control-label">Phone</label>
              <div class="col-sm-10">
                <input type="text" name="phone" class="form-control clear_input_field" id="host_phone" placeholder="Phone Number" required>
              </div>
            </div>
            <div class="form-group clearfix">
              <label for="host_email" class="col-sm-2 control-label">Email</label>
              <div class="col-sm-10">
                <input type="email" name="email" class="form-control clear_input_field" id="host_email" placeholder="Email" value="" required>
              </div>
            </div>
            <div class="form-group clearfix">
              <label for="address" class="col-sm-2 control-label">Address</label>
              <div class="col-sm-10">
                <textarea name="address" class="form-control clear_input_field" rows="3" id="address" value=""></textarea>
              </div>
            </div>
            <div class="form-group clearfix">
              <label for="additional_info" class="col-sm-2 control-label">Additional Info</label>
              <div class="col-sm-10">
                <textarea name="additional_info" class="form-control clear_input_field" rows="3" id="additional_info" value=""></textarea>
              </div>
            </div>
            <input type="hidden" name="enabled" value="1">
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
            <button type="submit" id="creat_new_host_btn" class="btn btn-primary">Create Host</button>
          </div>
        {!! Form::close() !!}
      </div>
    </div>
  </div>

  <div class="clearfix"></div>
@endsection

@push('scripts')
<script>
  function CKupdate(){
      for ( instance in CKEDITOR.instances )
          CKEDITOR.instances[instance].updateElement();
  }
  $(function () {
      /*$('input[type="checkbox"].flat-red').iCheck({
          checkboxClass: 'icheckbox_flat-green'
      });*/
      //CKEDITOR.replace('description', {});        
      $('#add_start_and_end_date').daterangepicker({timePicker: true, timePickerIncrement: 30, format: 'MM/DD/YYYY h:mm A'});
      $('select[name="ad_type"]').change(function(){
        if ($(this).val() == 'photo') {
          $('#showIfadtypeIsVideo').hide();
          //$('input[name="ad_video_link"]').val('');
        }else{
          $('#showIfadtypeIsVideo').show();
        }
      });
      // FORM SUBMIT
      $('#create_update_ad_tradeshow_form2').submit(function(e){
        e.preventDefault();
        CKupdate();
        $.ajax({
          method: 'POST',
          url: $(this).attr('action'),
          data: $(this).serialize(),
          beforeSend: function(){
            console.log('...');
            //$('#create_update_ad_tradeshow_form input[type="submit"]').val('Processing...');
          },
          success: function(response){
            console.log(response);
            if (response.success) {
              toastr.success(response.msg, 'Success', {
                "closeButton": true,
                "debug": true,
                "positionClass": "toast-top-right",
                "timeOut": "-1",
                "extendedTimeOut": "-1",
              });
              $('#create_update_ad_tradeshow_form input[type="text"]').val('');
              $('#create_update_ad_tradeshow_form input[type="number"]').val('');
              $('#create_update_ad_tradeshow_form textarea').val('');
              CKEDITOR.instances.description.setData('');
            }else{
              toastr.error(response.msg, 'Error', {
                "closeButton": true,
                "debug": true,
                "positionClass": "toast-top-right",
                "timeOut": "-1",
                "extendedTimeOut": "-1",
              });
            }
          }
        });
      });
  });
</script>
@endpush