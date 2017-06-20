@extends('admin.adminmaster')

@section('title')
  <title>SAG Galleries | SAG PLC</title>
@endsection

@section('breadcrumb')
  <section class="content-header">
      <h1>
        Photo Galleries
        <small>SAG PLC</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="{{ url('home')}}"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Galleries</li>
      </ol>
  </section>
@endsection

@section('content')
	
	<div class="row">
      <div class="col-md-12 col-lg-12">
          <div class="box box-primary">
            <div class="nav-tabs-custom">
              <ul class="nav nav-tabs">
                <li class="active"><a href="#tab_1" data-toggle="tab" aria-expanded="false"> <i class="fa fa-flag"></i> Upload Photos</a></li>
                <li class=""><a href="#tab_2" data-toggle="tab" aria-expanded="false"> <i class="fa fa-image"></i> Images</a></li>
                
              </ul>
              <div class="tab-content">
                <div class="tab-pane active" id="tab_1">
                  <div class="col-lg-12 col-md-12">
                    <div class="form-group">
                      <label for="inputEmail3" class="col-sm-2 control-label">Choose Gallery Type</label>
                      <div class="col-sm-10">
                        <select class="form-control" name="gallery_type">
                          <option value="events">Events</option>
                          <option value="tradeshows">Tradeshows</option>
                          <option value="public-parks">Public Parks</option>
                          <option value="textile-and-stationary-products">Textile and Stationary Products</option>
                        </select>
                      </div>
                      <div class="clearfix"></div><br>
                      <div class="dropzone col-sm-12" id="dz-upload-gallery-images"></div>
                    </div>
                  </div>
                  
                  <div class="clearfix"></div>
                </div><!-- /.tab-pane -->
                <div class="tab-pane" id="tab_2">
                  <div class="row col-md-12 col-lg-12">
                    @if(isset($galleries))
                      @if(count($galleries['events']))
                        <div class="text-center">Event Gallery Images</div>
                        <hr>
                        @foreach($galleries['events'] as $ev_images)
                          <div class="col-md-4 col-lg-4">
                            <div class="box box-widget widget-user delete_img_div">
                              <div class="widget-user-header bg-black" style="background: url({{ url('sag-galleries/'.$ev_images) }}) center center;">
                                <h4 type="submit" class="widget-user-username pull-right">
                                  <a href="#" class="delete_image_icon text-danger" title="Delete Image" style=""><i class="fa fa-close"></i></a> 
                                </h4>
                              </div>
                              <input type="hidden" name="img2delete" value="{{ $ev_images }}">
                            </div>
                          </div>
                        @endforeach
                      @endif
                      <div class="clearfix"></div>
                      @if(count($galleries['tradeshows']))
                        <div class="text-center">Tradeshows Gallery Images</div>
                        <hr>
                        @foreach($galleries['tradeshows'] as $ts_images)
                          <div class="col-md-4 col-lg-4">
                            <div class="box box-widget widget-user delete_img_div">
                              <div class="widget-user-header bg-black" style="background: url({{ url('sag-galleries/'.$ts_images) }}) center center;">
                                <h4 type="submit" class="widget-user-username pull-right">
                                  <a href="#" class="delete_image_icon text-danger" title="Delete Image" style=""><i class="fa fa-close"></i></a> 
                                </h4>
                              </div>
                              <input type="hidden" name="img2delete" value="{{ $ts_images }}">
                            </div>
                          </div>
                        @endforeach
                      @endif
                      <div class="clearfix"></div>
                      @if(count($galleries['public_parks']))
                        <div class="text-center">Public Park Images</div>
                        <hr>
                        @foreach($galleries['public_parks'] as $pp_images)
                          <div class="col-md-4 col-lg-4">
                            <div class="box box-widget widget-user delete_img_div">
                              <div class="widget-user-header bg-black" style="background: url({{ url('sag-galleries/'.$pp_images) }}) center center;">
                                <h4 type="submit" class="widget-user-username pull-right">
                                  <a href="#" class="delete_image_icon text-danger" title="Delete Image"><i class="fa fa-close"></i></a> 
                                </h4>
                              </div>
                              <input type="hidden" name="img2delete" value="{{ $pp_images }}">
                            </div>
                          </div>
                        @endforeach
                      @endif
                      <div class="clearfix"></div>
                      @if(count($galleries['txt_and_stationary']))
                        <div class="text-center">Textile and Stationary Products Gallery Images</div>
                        <hr>
                        @foreach($galleries['txt_and_stationary'] as $txt_images)
                          <div class="col-md-4 col-lg-4">
                            <div class="box box-widget widget-user delete_img_div">
                              <div class="widget-user-header bg-black" style="background: url({{ url('sag-galleries/'.$txt_images) }}) center center;">
                                <h4 type="submit" class="widget-user-username pull-right">
                                  <a href="#" class="delete_image_icon text-danger" title="Delete Image"><i class="fa fa-close"></i></a> 
                                </h4>
                              </div>
                              <input type="hidden" name="img2delete" value="{{ $txt_images }}">
                            </div>
                          </div>
                        @endforeach
                      @endif
                      <div class="clearfix"></div>
                    @endif
                  </div>
                  <div class="clearfix"></div>
                </div>
                
              </div><!-- /.tab-content -->
            </div>
          </div>
      </div>
  </div>

  <div class="clearfix"></div>
@endsection

@push('scripts')
  <script>
    (function(document, window, $) {
    
      $(document).ready(function($) {
        Dropzone.autoDiscover = false;
        $('input[name="availability"]').change(function(){
          if ($(this).val() == 'unlimited') {
            $('#show_max_guest').hide();
            $('input[name="max_guest"]').val(-1);
          }else{
            $('#show_max_guest').show();
            $('input[name="max_guest"]').val(50);
          }
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
                      url: "{{ url('admin/delete-gallery-image') }}",
                      data: "_token={{ csrf_token() }}&img2delete="+img2delete,
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
        var dzAddEditSong = $('#dz-upload-gallery-images').dropzone({
          url: "{{ url('admin/upload-gallery-images') }}",
          //autoProcessQueue: false,
          paramName: 'file',
          maxFiles: 10,
          maxFileSize: 100,
          dictDefaultMessage: "First Select Gallery Type On Top and then Drop files here to upload, choose only Image files.<br>(650x525) are good image sizes for the gallery.",
          uploadMultiple: false,
          headers: {
              "X-CSRF-Token": "{{csrf_token()}}"
          },
          accept: function(file, done){
            var fname = file.name;
            var file_arr = fname.split('.');
            var ext = file_arr[file_arr.length - 1].toLowerCase();
            //done();
            //return;
            if (ext == 'jpg' || ext == 'jpeg' || ext == 'png' || ext == 'gif') {
              done();
            }else{
              //console.log('not a zip file');
              toastr.error('Please upload only an image file.', 'Error');
              done('Only Image files are allowed!!');
            }
          },
          sending: function(file, xhr, formData) {
            formData.append("gallery_type", $('select[name="gallery_type"]').val());
          },
          init: function(){
            this.on('success', function(file, response){
              console.log(response);
              var $this = this;
              if (response.success) {
                toastr.success(response.msg, 'Success');
              }else{
                //$this.removeAllFiles();
                //console.log(response.msg);
                toastr.error(response.msg, 'Error', {
                  "closeButton" : true,
                  "timeOut" : -1,
                  "extendedTimeOut": -1,
                  //"positionClass" : "toast-top-full-width"
                });
              }
              //console.log(JSON.parse(response));
            });
            this.on("maxfilesexceeded", function(file) {
              toastr.error('Please upload upto 10 Images at once.', 'Error', {
                //positionClass: 'toastr-top-center',
                timeOut: -1,
                extendedTimeOut: -1,
                closeButton: true
              });
              this.removeAllFiles();
              this.addFile(file);
            });
          }
        });
      });

      // -------------------
      (function() {
        
        
      })();

    })(document, window, jQuery);
  </script>
@endpush