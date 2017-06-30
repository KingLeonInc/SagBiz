@extends('admin.adminmaster')

@section('title')
	<title>Create {{ $results['title'] }} | SAG PLC</title>
@endsection

@section('breadcrumb')
  <section class="content-header">
      <h1>
        Create a New {{ $results['title'] }}
        <small>SAG PLC</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="{{ url('home')}}"><i class="fa fa-dashboard"></i> Home</a></li>
        @if($results['title'] == 'Event')
          <li><a href="{{ url('admin/events')}}"><i class="fa fa-flag"></i> {{ $results['title'] }}s</a></li>
        @else
          <li><a href="{{ url('admin/tradeshows')}}"><i class="fa fa-flag"></i> {{ $results['title'] }}s</a></li>
        @endif
        <li class="active">Create {{ $results['title'] }}</li>
      </ol>
  </section>
@endsection

@section('content')
	<div class="row">
      <div class="col-md-3 col-lg-3">
        @if(count($results['recent_events']))
          <div class="box box-success">
            <div class="box-header with-border">
              <h3 class="box-title">Recent {{ $results['title'] }}s</h3>
              
            </div><!-- /.box-header -->
            <div class="box-body">
              <ul class="products-list product-list-in-box">
                  @foreach($results['recent_events'] as $evnt)
                    <li class="item">
                      <!-- <div class="product-img">
                        <img src="{{ url('admin/dist/img/default-50x50.gif') }}" alt="Product Image">
                      </div> -->
                      <div class="">
                        @if($results['title'] == 'Event')
                          <a href="{{ url('admin/event/'.$evnt->slug) }}" class="product-title">{{ $evnt->title }} <span class="label label-success pull-right">{{ $evnt->price }}</span></a>
                        @else
                          <a href="{{ url('admin/tradeshow/'.$evnt->slug) }}" class="product-title">{{ $evnt->title }} <span class="label label-success pull-right">{{ $evnt->price }}</span></a>
                        @endif
                        <span class="product-description">
                          {{ $evnt->summary }}
                        </span>
                      </div>
                    </li><!-- /.item -->
                  @endforeach
              </ul>
            </div><!-- /.box-body -->
            <div class="box-footer text-center">
              @if($results['title'] == 'Event')
                <a href="{{ url('admin/events')}}" class="uppercase">View All Events</a>
              @else
                <a href="{{ url('admin/tradeshows')}}" class="uppercase">View All Tradeshows</a>
              @endif
            </div><!-- /.box-footer -->
          </div>
        @else
          <div class="box box-primary">
            <div class="box-body box-profile">
              {{--<img class="profile-user-img img-responsive img-circle" src="{{ url('images/logo3.png')}}" alt="No {{ $results['title'] }} picture">--}}
              <h3 class="profile-username text-center">No {{ $results['title'] }}s</h3>
              <p class="text-muted text-center">SAG BIZ</p>

              <ul class="list-group list-group-unbordered">
                <li class="list-group-item">
                  <b>Events</b> <a class="pull-right">0</a>
                </li>
                <li class="list-group-item">
                  <b>Tradeshows</b> <a class="pull-right">0</a>
                </li>
                <li class="list-group-item">
                  <b>Ads</b> <a class="pull-right">{{ App\Ad::count() }}</a>
                </li>
              </ul>
              @if($results['title'] == 'Event')
                <a href="{{ url('admin/tradeshow/create') }}" class="btn btn-primary btn-block"><b>Create Tradeshow</b></a>
              @else
                <a href="{{ url('admin/event/create') }}" class="btn btn-primary btn-block"><b>Create Event</b></a>
              @endif
            </div><!-- /.box-body -->
          </div>
        @endif
      </div>
      <div class="col-md-9 col-lg-9">
          <div class="box box-success">
              @include('admin.includes.admin_errors')
              <div class="box-header">
                  <h3 class="text-primary">Create A New {{ $results['title'] }}</h3>
              </div>
              <div class="box-body">
                      {!! Form::open(['url' => 'admin/event/create', 'id'=>'create_update_event_tradeshow_form', 'class' => 'form', 'enctype' => 'multipart/form-data']) !!}
                          @include('admin.includes.create_form', ['createOrUpdate'=>'create', 'submitBtnText' => 'Create '.$results['title'], 'eventType' => $results['event_type'], 'type' => $results['title'] ])
                      {!! Form::close() !!}
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
  function readURL(input) {
      var url = input.value;
      var ext = url.substring(url.lastIndexOf('.') + 1).toLowerCase();
      if (input.files && input.files[0]&& (ext == "gif" || ext == "png" || ext == "jpeg" || ext == "jpg")) {
          var reader = new FileReader();

          reader.onload = function (e) {
              $('#img').attr('src', e.target.result);
          }

          reader.readAsDataURL(input.files[0]);
      }
  }
  function CKupdate(){
      for ( instance in CKEDITOR.instances )
          CKEDITOR.instances[instance].updateElement();
  }
  $(function () {
      /*$('input[type="checkbox"].flat-red').iCheck({
          checkboxClass: 'icheckbox_flat-green'
      });*/
      $("#upload").change(function(){ 
          readURL(this);
      });
      CKEDITOR.replace('description', {});        
      $('#event_start_and_end_date').daterangepicker({timePicker: true, timePickerIncrement: 30, format: 'MM/DD/YYYY h:mm A'});
      $('input[name="availability"]').change(function(){
        if ($(this).val() == 'unlimited') {
          $('#show_max_guest').hide();
          $('input[name="max_guest"]').val(-1);
        }else{
          $('#show_max_guest').show();
          $('input[name="max_guest"]').val(50);
        }
      });
      // FORM SUBMIT
      $('#create_update_event_tradeshow_form2').submit(function(e){
        e.preventDefault();
        CKupdate();
        $.ajax({
          method: 'POST',
          url: $(this).attr('action'),
          data: $(this).serialize(),
          beforeSend: function(){
            console.log('...');
            //$('#create_update_event_tradeshow_form input[type="submit"]').val('Processing...');
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
              $('#create_update_event_tradeshow_form input[type="text"]').val('');
              $('#create_update_event_tradeshow_form input[type="number"]').val('');
              $('#create_update_event_tradeshow_form textarea').val('');
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
      // CREATE NEW HOST
      $('#creat_new_host_form').submit(function(e){
        e.preventDefault();
        $.ajax({
          method: 'POST',
          url: $(this).attr('action'),
          data: $(this).serialize(),
          beforeSend: function(){
            console.log('...');
            //$('#create_update_event_tradeshow_form input[type="submit"]').val('Processing...');
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
              // Place the new host
              var hosts = response.hosts;
              var hosts_html = '';
              for(var hst of hosts){
                if (hst.event_host_id == response.new_host) {
                  hosts_html += '<option value="'+hst.event_host_id+'" selected>'+hst.name+' | '+hst.company+'</option>';
                }else{
                  hosts_html += '<option value="'+hst.event_host_id+'">'+hst.name+' | '+hst.company+'</option>';
                }
              }
              $('select[name="event_host"]').html(hosts_html);
              // CLEAR ALL FIELDS
              $('#creat_new_host_form .clear_input_field').val('');
              // HIDE MODAL
              $('#createNewEventOrTradeshowHostModal').appendTo('body').modal('hide');
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