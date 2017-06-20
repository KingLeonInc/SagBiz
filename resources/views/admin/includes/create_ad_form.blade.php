<div class="">
    @if(Session::has('message'))
        @include('success.message', ['message' =>  Session::get('message') ])
    @endif
</div>
<div class="form-group col-md-4">
    {!! Form::label('Ad Title') !!}
    {!! Form::text('ad_title', null, ['class' => 'form-control', 'required' => 'required']) !!}
</div>
<div class="form-group col-md-4">
  <label>Ad Type</label>
  <select name="ad_type" class="form-control">
    @if(isset($results['ad']))
      @if($results['ad']->ad_type == 'photo')
        <option value="photo" selected>Photo Ad</option>
        <option value="video">Video Ad</option>
      @else
        <option value="photo">Photo Ad</option>
        <option value="video" selected>Video Ad</option>
      @endif
    @else
      <option value="photo">Photo Ad</option>
      <option value="video">Video Ad</option>
    @endif
  </select>
</div>
<div class="form-group col-md-4">
    {!! Form::label('Ad Link') !!}
    {!! Form::text('ad_link', null, ['class' => 'form-control', 'required' => 'required']) !!}
</div>
<div class="clarfix"></div>
@if(isset($results['ad']))
  @if($results['ad']->ad_type == 'photo')
    <div class="form-group col-md-6">
      <img src="{{ url('sag-ads/'.$results['ad']->ad_id.'/'.$results['ad']->ad_background_photo) }}" style="width: 100%;">
      <label>Change Background Image</label>
      <input type="file" name="ad_background_image">
    </div>
    <div class="form-group col-md-6" id="showIfadtypeIsVideo" style="display:none;">
      {!! Form::label('Video Link') !!}
      {!! Form::text('ad_video_link', null, ['class' => 'form-control']) !!}
    </div>
  @else
    <div class="form-group col-md-6">
      <img src="{{ url('sag-ads/'.$results['ad']->ad_id.'/'.$results['ad']->ad_background_photo) }}" style="width: 100%;">
      <label>Change Background Image</label>
      <input type="file" name="ad_background_image">
    </div>
    <div class="form-group col-md-6" id="showIfadtypeIsVideo">
      {!! Form::label('Video Link') !!}
      {!! Form::text('ad_video_link', null, ['class' => 'form-control']) !!}
      {{-- 
        @if($results['ad']->ad_video_file != "")
          <video src="{{ url('sag-ads/'.$results['ad']->ad_id.'/'.$results['ad']->ad_video_file) }}"></video>
          <label>Change Video</label>
          <input type="file" name="ad_video_file" value="change video">
        @elseif($results['ad']->ad_video_link != "")
          
        @endif
      --}}
    </div>
  @endif
@else
  <div class="form-group col-md-6">
    <label>Upload Ad Background Image</label>
    <input type="file" name="ad_background_image" required>
  </div>
  <div class="form-group col-md-6" id="showIfadtypeIsVideo" style="display: none;">
    <!-- <label>Upload a video file.</label>
    <input type="file" name="ad_video_file" value="Upload Video"> 
    <p class="text-center">-- OR --</p> -->
    <label>Video Link</label>
    <input type="text" name="ad_video_link" class="form-control" placeholder="copy and paste video link here">
  </div>
@endif

<div class="clearfix"></div>

<div class="form-group">
    <div class="col-md-6 col-lg-6">
      <label>Set Date:</label>
      <div class="input-group">
          <div class="input-group-addon">
            <i class="fa fa-clock-o"></i>
          </div>
          @if(isset($results['ad']))
            <input type="text" class="form-control pull-right" name="add_start_and_end_date" id="add_start_and_end_date" value="{{ Carbon\Carbon::parse($results['ad']->ad_start_date)->format('m/d/Y h:m A').' - '.Carbon\Carbon::parse($results['ad']->ad_end_date)->format('m/d/Y h:m A') }}" required>
          @else
            <input type="text" class="form-control pull-right" name="add_start_and_end_date" id="add_start_and_end_date" value="" required>
          @endif
      </div><!-- /.input group -->
    </div>
    <div class="col-md-6 col-lg-6">        
        <label>
          @if(isset($results['ad']))
            @if($results['ad']->enabled == 1 || $results['ad']->enabled == '1')
              <input name="enabled" value="1" type="checkbox" class="flat-red" checked> <span style="cursor: pointer;">Publish Ad? </span>
            @else
              <input name="enabled" value="1" type="checkbox" class="flat-red"> <span style="cursor: pointer;">Publish Ad? </span>
            @endif
          @else
            <input name="enabled" value="1" type="checkbox" class="flat-red" checked> <span style="cursor: pointer;">Publish Ad? </span>
          @endif
        </label>
    </div>
</div>
<div class="clearfix"></div>

<div class="form-group">
    <input type="hidden" name="create_or_update" value="{{ $createOrUpdate }}">
    <input type="hidden" name="ad_id" value="@if(isset($results['ad'])){{ $results['ad']->ad_id }}@else{{0}}@endif">
</div>
<div class="form-group col-md-4 col-md-offset-4">
    {!! Form::submit( $submitBtnText, ['class' => 'btn btn-primary btn-block btn-lg']) !!}
</div>

<div class="clearfix"></div>

