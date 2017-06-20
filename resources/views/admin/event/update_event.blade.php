@extends('admin.adminmaster')

@section('title')
  <title>Update {{ $results['title'] }} | SAG PLC</title>
@endsection

@section('breadcrumb')
  <section class="content-header">
      <h1>
        Update {{ $results['title'] }}
        <small>SAG PLC</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="{{ url('home')}}"><i class="fa fa-dashboard"></i> Home</a></li>
        @if($results['title'] == 'Event')
          <li><a href="{{ url('admin/events')}}"><i class="fa fa-flag"></i> Events</a></li>
        @else
          <li><a href="{{ url('admin/tradeshows')}}"><i class="fa fa-flag"></i> Tradeshows</a></li>
        @endif
        <li class="active"><a href=""><i class=""></i> {{ $results['event']->title }}</a></li>
        <li class="active">Update </li>
      </ol>
  </section>
@endsection

@section('content')
  <style>
      
      #actions {
        margin: 2em 0;
      }


      /* Mimic table appearance */
      div.table {
        display: table;
      }
      div.table .file-row {
        display: table-row;
      }
      div.table .file-row > div {
        display: table-cell;
        vertical-align: top;
        border-top: 1px solid #ddd;
        padding: 8px;
      }
      div.table .file-row:nth-child(odd) {
        background: #f9f9f9;
      }



      /* The total progress gets shown by event listeners */
      #total-progress {
        opacity: 0;
        transition: opacity 0.3s linear;
      }

      /* Hide the progress bar when finished */
      #previews .file-row.dz-success .progress {
        opacity: 0;
        transition: opacity 0.3s linear;
      }

      /* Hide the delete button initially */
      #previews .file-row .delete {
        display: none;
      }

      /* Hide the start and cancel buttons and show the delete button */

      #previews .file-row.dz-success .start,
      #previews .file-row.dz-success .cancel {
        display: none;
      }
      #previews .file-row.dz-success .delete {
        display: block;
      }
      a#crate_new_event_link: hover{
        color: blue;
      }
      .btn-ap>.badge {
          position: absolute;
          top: -3px;
          right: -10px;
          font-size: 10px;
          font-weight: 400;
      }
  </style>
	
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
          <div class="box box-primary">
            <div class="nav-tabs-custom">
              <ul class="nav nav-tabs">
                <li class="@if($results['tab']=='event') active @endif"><a href="#tab_1" data-toggle="tab" aria-expanded="false"> <i class="fa fa-flag"></i> Event</a></li>
                <li class="@if($results['tab']=='uploaded-images') active @endif"><a href="#tab_2" data-toggle="tab" aria-expanded="false"> <i class="fa fa-image"></i> Images</a></li>
                <li class="@if($results['tab']=='registrations') active @endif"><a href="#tab_3" data-toggle="tab" aria-expanded="false"> <i class="fa fa-users"></i> Registrations</a></li>
                @if($results['title'] == 'Event')
                  <li class="pull-right"><a href="{{ url('admin/event/create')}}" id="crate_new_event_link" class="text-muted" style="color: black;"><i class="fa fa-plus"></i> Create New Event</a></li>
                @else
                  <li class="pull-right"><a href="{{ url('admin/tradeshow/create')}}" id="crate_new_event_link" class="text-muted" style="color: black;"><i class="fa fa-plus"></i> Create New Tradeshow</a></li>
                @endif
              </ul>
              <div class="tab-content">
                <div class="tab-pane @if($results['tab']=='event') active @endif" id="tab_1">
                  {!! Form::model($results['event'], ['url' => 'admin/event/create', 'id'=>'create_update_event_tradeshow_form', 'class' => 'form', 'enctype' => 'multipart/form-data']) !!}
                      @include('admin.includes.update_form', ['createOrUpdate'=>'update', 'submitBtnText' => 'Update '.$results['title'], 'event' => $results['event'], 'eventType' => $results['event_type'], 'type' => $results['title']])
                  {!! Form::close() !!}
                </div><!-- /.tab-pane -->
                <div class="tab-pane @if($results['tab']=='uploaded-images') active @endif" id="tab_2">
                  <div id="actions" class="row">
                    <div class="col-lg-7">
                      <!-- The fileinput-button span is used to style the file input field as button -->
                      <span class="btn btn-success fileinput-button">
                          <i class="glyphicon glyphicon-plus"></i>
                          <span>Add files...</span>
                      </span>
                      <button type="submit" class="btn btn-primary start">
                          <i class="glyphicon glyphicon-upload"></i>
                          <span>Start upload</span>
                      </button>
                      <button type="reset" class="btn btn-warning cancel">
                          <i class="glyphicon glyphicon-ban-circle"></i>
                          <span>Cancel upload</span>
                      </button>
                    </div>

                    <div class="col-lg-5">
                      <!-- The global file processing state -->
                      <span class="fileupload-process">
                        <div id="total-progress" class="progress progress-striped active" role="progressbar" aria-valuemin="0" aria-valuemax="100" aria-valuenow="0">
                          <div class="progress-bar progress-bar-success" style="width:0%;" data-dz-uploadprogress></div>
                        </div>
                      </span>
                    </div>
                  </div>
                  <div class="table table-striped" class="files" id="previews">
                    <div id="" class="template file-row">
                      <!-- This is used as the file preview template -->
                      <div>
                          <span class="preview"><img data-dz-thumbnail /></span>
                      </div>
                      <div>
                          <p class="name" data-dz-name></p>
                          <strong class="error text-danger" data-dz-errormessage></strong>
                      </div>
                      <div>
                          <p class="size" data-dz-size></p>
                          <div class="progress progress-striped active" role="progressbar" aria-valuemin="0" aria-valuemax="100" aria-valuenow="0">
                            <div class="progress-bar progress-bar-success" style="width:0%;" data-dz-uploadprogress></div>
                          </div>
                      </div>
                      <div>
                        <button class="btn btn-primary start">
                            <i class="glyphicon glyphicon-upload"></i>
                            <span>Start</span>
                        </button>
                        <button data-dz-remove class="btn btn-warning cancel">
                            <i class="glyphicon glyphicon-ban-circle"></i>
                            <span>Cancel</span>
                        </button>
                        <button data-dz-remove class="btn btn-danger delete">
                          <i class="glyphicon glyphicon-trash"></i>
                          <span>Delete</span>
                        </button>
                      </div>
                    </div>
                  </div>
                  <hr>
                  <div class="row">
                    @if(count($results['images']))
                        @foreach($results['images'] as $ev_images)
                          <div class="col-md-4 col-lg-4">
                            <div class="box box-widget widget-user delete_img_div">
                              <div class="widget-user-header bg-black" style="background: url({{ url('sag-events/'.$ev_images) }}) center center;">
                                <h4 type="submit" class="widget-user-username pull-right">
                                  <a href="#" class="delete_image_icon text-danger" title="Delete Image" style=""><i class="fa fa-close"></i></a> 
                                </h4>
                              </div>
                              <input type="hidden" name="img2delete" value="{{ $ev_images }}">
                            </div>
                          </div>
                        @endforeach
                    @endif
                  </div>
                  <div class="clearfix"></div>
                </div><!-- /.tab-pane -->
                <div class="tab-pane @if($results['tab']=='registrations') active @endif" id="tab_3">
                  <h3 class="box-title text-primary">Users regiestred for this event
                    @if($results['event_regs'])
                      <button class="pull-right" data-toggle="modal" data-target="#massEmailModal"><i class="fa fa-envelope"></i> Mass Email</button>
                    @endif
                  </h3>
                  <div class="clearfix"></div>
                  @if($results['event_regs'])
                    <table id="event-registeres-table" class="table table-hover table-responsive">
                        <thead>
                            <tr><!-- 
                              <th>ID</th> -->
                              <th>Name</th>
                              <th>Email</th>
                              <th>Phone</th>
                              <th>Gender</th>
                              <th>Company</th>
                              <th>Registred On</th>
                              <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                        <tfoot>
                            <tr><!-- 
                              <th>ID</th> -->
                              <th>Name</th>
                              <th>Email</th>
                              <th>Phone</th>
                              <th>Gender</th>
                              <th>Company</th>
                              <th>Registred On</th>
                              <th>Action</th>
                            </tr>
                        </tfoot>
                    </table>
                  @else
                    <h4 class="text-center">No one has registred for this {{ $results['title'] }} yet.</h4>
                  @endif
                  <div class="clearfix"></div>
                </div>
                
              </div><!-- /.tab-content -->
            </div>
          </div>
      </div>
  </div>
  <!-- Create Host Modal -->
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

  <!-- Mass Email Modal -->
  <div class="modal fade" id="massEmailModal" tabindex="-1" role="dialog" aria-labelledby="massEmail">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        {!! Form::open(['url'=>'admin/mass-email', 'id'=>'send_mass_email_form', 'class'=>'form form-horizontal']) !!}
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title" id="massEmail">Mass Email to Users</h4>
          </div>
          <div class="modal-body">
            <div class="form-group clearfix">
              <label for="host_name" class="col-sm-2 control-label">Subject</label>
              <div class="col-sm-10">
                <input type="text" name="subject" class="form-control clear_input_field" id="host_name" placeholder="Email Subject" required>
              </div>
            </div>
            
            <div class="form-group clearfix">
              <label for="address" class="col-sm-2 control-label">Message</label>
              <div class="col-sm-10">
                <textarea name="message" class="form-control clear_input_field" rows="5" id="message" required></textarea>
              </div>
            </div>
            <p class="text-center">This Email will be sent to {{ $results['event_regs'] }} users.</p>
            <input type="hidden" name="event_id" value="{{ $results['event']->event_id }}">
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
            <button type="submit" id="creat_new_host_btn" class="btn btn-primary">Send Email</button>
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
    function loadEventRegistredMembers() {
      $('#event-registeres-table').DataTable({
          processing: true,
          serverSide: true,
          destroy: true,
          ajax: "{{ url('datatables/get-all-event-registred-members/'.$results['event']->event_id) }}",
          columns: [
              //{data: 'event_reg_id', name: 'event_reg_id'},
              {data: 'name', name: 'name'},
              {data: 'email', name: 'email'},
              {data: 'phone', name: 'phone'},
              {data: 'gender', name: 'gender'},
              {data: 'company', name: 'company'},
              {data: 'created_at', name: 'created_at'},
              {data: 'action', name: 'action'}
          ]
      });
    }
    function deleteEventReg(regId){
      bootbox.confirm({
          title: '<h2>Delete Registred User!</h2>',
          message: "Are you sure you want to delete this user?",
          className: "modal-center example-modal-sm",
          buttons: {
              confirm: {
                  label: 'Yes',
                  className: 'btn-success'
              },
              cancel: {
                  label: 'No',
                  className: 'btn-danger'
              }
          },
          callback: function (result) {
              //console.log('This was logged in the callback: ' + result);
              if (result == true) {
                $.ajax({
                  type: 'GET',
                  url: "{{ url('delete-event-registred-member')}}/"+regId,
                  success: function(data){
                    if(data.success){
                      toastr.success(data.msg, 'Success');
                      loadEventRegistredMembers();
                    }else{
                      toastr.error(data.msg, 'Error');
                    }
                  }
              });
              }
          }
      });
    }
    (function(document, window, $) {
    
      $(document).ready(function($) {
        // LOAD EVENT REGS
        loadEventRegistredMembers();
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
        $("#upload").change(function(){ 
            readURL(this);
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
                if (response.create_or_update == 'create') {
                  $('#create_update_event_tradeshow_form input[type="text"]').val('');
                  $('#create_update_event_tradeshow_form input[type="number"]').val('');
                  $('#create_update_event_tradeshow_form textarea').val('');
                  CKEDITOR.instances.description.setData('');
                };
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
        // CREATE NEW HOST
        $('#send_mass_email_form').submit(function(e){
          e.preventDefault();
          $.ajax({
            method: 'POST',
            url: $(this).attr('action'),
            data: $(this).serialize(),
            beforeSend: function(){
              console.log('...');
              //$('#create_update_event_tradeshow_form input[type="submit"]').val('Processing...'); 
              $('#ajaxProgressModal').appendTo('body').modal('show');
            },
            progress: function(e) {
                //make sure we can compute the length
                if(e.lengthComputable) {
                    //calculate the percentage loaded
                    var pct = (e.loaded / e.total) * 100;

                    //log percentage loaded
                    console.log(pct);
                }
                //this usually happens when Content-Length isn't set
                else {
                    console.warn('Content Length not reported!');
                }
            },
            success: function(response){
              console.log(response);
              $('#ajaxProgressModal').appendTo('body').modal('hide');
              if (response.success) {
                toastr.success(response.msg, 'Success', {
                  "closeButton": true,
                  "debug": true,
                  "positionClass": "toast-top-right",
                  "timeOut": "-1",
                  "extendedTimeOut": "-1",
                });
                // HIDE MODAL
                $('#massEmailModal').appendTo('body').modal('hide');
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
        // DELETE IMAGE
        $('.delete_image_icon').click(function(){
          //e.preventDefault();
          var div = $(this).parent().parent().parent();
          var img2delete = div.find('input[name="img2delete"]').val();
          bootbox.confirm({
              title: "Delete Image?",
              message: "Are you sure you want to permanently delete this image? This cannot be undone.",
              buttons: {
                  cancel: {
                      label: '<i class="fa fa-times"></i> Cancel'
                  },
                  confirm: {
                      label: '<i class="fa fa-check"></i> Confirm'
                  }
              },
              callback: function (result) {
                  console.log('Image 2 delete: ' + img2delete + ' Delete - '+result);
                  if (result) {
                    $.ajax({
                      method: 'POST',
                      url: "{{ url('admin/delete-event-image') }}",
                      data: "_token={{ csrf_token() }}&event={{ $results['event']->event_id }}&img2delete="+img2delete,
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
                          div.hide();
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
                  };
              }
          });
        });
      });

      // -------------------
      (function() {
        
        
      })();

    })(document, window, jQuery);
  </script>
  <script>
    Dropzone.autoDiscover = false;
    // IMAGE UPLOAD
        var previewNode = document.querySelector(".template");
        previewNode.id = "";
        var previewTemplate = previewNode.parentNode.innerHTML;
        previewNode.parentNode.removeChild(previewNode);

        var myDropzone = new Dropzone(document.body, { // Make the whole body a dropzone
          url: "{{ url('admin/event/'.$results['event']->slug.'/images') }}", // Set the url
          thumbnailWidth: 80,
          thumbnailHeight: 80,
          parallelUploads: 20,
          previewTemplate: previewTemplate,
          autoQueue: false, // Make sure the files aren't queued until manually added
          previewsContainer: "#previews", // Define the container to display the previews
          clickable: ".fileinput-button", // Define the element that should be used as click trigger to select files.
          headers: {
            "X-CSRF-Token": "{{csrf_token()}}"
          },
        });

        myDropzone.on("addedfile", function(file) {
          // Hookup the start button
          file.previewElement.querySelector(".start").onclick = function() { myDropzone.enqueueFile(file); };
        });

        // Update the total progress bar
        myDropzone.on("totaluploadprogress", function(progress) {
          document.querySelector("#total-progress .progress-bar").style.width = progress + "%";
        });

        myDropzone.on("sending", function(file, xhr, formData) {
          // Show the total progress bar when upload starts
          document.querySelector("#total-progress").style.opacity = "1";
          // And disable the start button
          file.previewElement.querySelector(".start").setAttribute("disabled", "disabled");
          formData.append("sag_event_id", "{{ $results['event']->event_id }}");
        });

        // Hide the total progress bar when nothing's uploading anymore
        myDropzone.on("queuecomplete", function(progress) {
          document.querySelector("#total-progress").style.opacity = "0";
        });

        // Setup the buttons for all transfers
        // The "add files" button doesn't need to be setup because the config
        // `clickable` has already been specified.
        document.querySelector("#actions .start").onclick = function() {
          myDropzone.enqueueFiles(myDropzone.getFilesWithStatus(Dropzone.ADDED));
        };
        document.querySelector("#actions .cancel").onclick = function() {
          myDropzone.removeAllFiles(true);
        };

        // SERVER RESPONSE
        myDropzone.on("success", function(file, response){
            console.log(response);
            if (response.success) {
              toastr.success(response.msg, 'Success');
            }else{
              toastr.error(response.msg, 'Error', {
                "closeButton": true,
                "debug": true,
                "positionClass": "toast-top-right",
                "timeOut": "-1",
                "extendedTimeOut": "-1",
              });
            }
        });
  </script>
@endpush