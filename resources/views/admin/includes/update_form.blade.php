@if(session('response'))
  <div class="col-md-12 col-lg-12">
    <div class="alert @if(session('response')['success']) alert-success @else alert-danger @endif alert-dismissible">
      <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
      <h4><i class="icon fa @if(session('response')['success']) fa-check @else fa-ban @endif"></i> @if(session('response')['success']) Success @else Error! @endif</h4>
      {{ session('response')['msg'] }}
    </div>
  </div>
  <div class="clearfix"></div>
@endif
<div class="form-group col-md-6 col-lg-6">
    {!! Form::label('title') !!}
    {!! Form::text('title', null, ['class' => 'form-control', 'required' => 'required']) !!}
    <br>
    {!! Form::label('Summary') !!}
    {!! Form::textarea('summary', null, ['class' => 'form-control', 'rows' => '4', 'required' => 'required']) !!}
</div>

<div class="form-group col-md-6 col-lg-6">
  <label>{{ $results['title'] }} Image</label>
  <input type='file' id="upload" name="new_event_image"/>
  @if($results['event']->event_img == '')
    @if($results['title'] == 'Event')
      <img src="{{ url('images/assets/sag_event.png') }}" id="img" style="height: 150px;">
    @else
      <img src="{{ url('images/assets/sag_event.png') }}" id="img" style="height: 150px;">
    @endif
  @else
     <img src="{{ url('sag-events/'.$results['event']->event_id.'/'.$results['event']->event_img) }}" id="img" style="height: 150px;">
  @endif
</div> 
<div class="clearfix"></div>

<div class="form-group col-md-12 col-lg-12">
    {!! Form::label('Description') !!}
    {!! Form::textarea('description', null, ['class' => 'form-control', 'required' => 'required']) !!}
</div>

<div class="form-group">
    <div class="col-md-6 col-lg-6">
        <div class="form-group">
          <div class="">
            <label class="box-title">Event Host</label>
            <div class="box-tools pull-right">
              <button type="button" class="btn btn-box-tool" data-toggle="modal" data-target="#createNewEventOrTradeshowHostModal"><i class="fa fa-plus"></i> New Host</button>
            </div>
          </div>
          <select class="form-control" name="event_host">
            @if(isset($results['hosts']))
              @foreach($results['hosts'] as $ev_host)
                @if($results['event']->event_host == $ev_host->event_host_id)
                  <option value="{{ $ev_host->event_host_id }}" selected> {{ $ev_host->name }} | <b>{{ $ev_host->company }}</b></option>
                @else
                  <option value="{{ $ev_host->event_host_id }}"> {{ $ev_host->name }} | <b>{{ $ev_host->company }}</b></option>
                @endif
              @endforeach
            @else
              <option value="1">option 1</option>
              <option value="2">option 2</option>
              <option value="3">option 3</option>
            @endif
          </select>
        </div>
    </div>
    <div class="col-md-6 col-lg-6">
      <label>Event Date:</label>
      <div class="input-group">
          <div class="input-group-addon">
            <i class="fa fa-clock-o"></i>
          </div>
          <input type="text" class="form-control pull-right" name="event_start_and_end_date" id="event_start_and_end_date" value="{{ $results['date_range'] }}" required>
      </div><!-- /.input group -->
    </div><div class="clearfix"></div>
    <div class="col-md-6 col-lg-6">
      <label>Availablity</label>
      @if($results['event']->availability == "limited")
        <div class="radio">
          <label>
            <input type="radio" name="availability" id="" value="limited" checked="">Limited
          </label>
        </div>
        <div class="radio">
          <label>
            <input type="radio" name="availability" id="" value="unlimited">Unlimited
          </label>
        </div>
        <div id="show_max_guest">
          <label>Maximum Guests</label>
          <input type="number" class="form-control" name="max_guest" value="{{ (int)$results['event']->max_guest }}">
        </div>
      @else
        <div class="radio">
          <label>
            <input type="radio" name="availability" id="" value="limited">Limited
          </label>
        </div>
        <div class="radio">
          <label>
            <input type="radio" name="availability" id="" value="unlimited" checked="">Unlimited
          </label>
        </div>
        <div id="show_max_guest" style="display: none;">
          <label>Maximum Guests</label>
          <input type="number" class="form-control" name="max_guest" value="-1">
        </div>
      @endif
    </div>
    <div class="col-md-6 col-lg-6">
        <label>Price</label>
        <input type="number" name="price" class="form-control" value="{{ $results['event']->price }}" required> <br>
        @if($results['event'] -> enabled == '1')
            <label>
                <input name="enabled" value="1" type="checkbox" class="flat-red" checked> <span style="cursor: pointer;">Publish {{ $type }}? </span><span class="label label-success"> Published</span>
            </label>
        @else
            <label>
                <input name="enabled" value="0" type="checkbox" class="flat-red"> <span style="cursor: pointer;">Publish {{ $type }}?</span> <span class="label label-danger"> Not Published</span>
            </label>
        @endif
    </div>
</div>
<div class="clearfix"></div>

<div class="form-group">{{--
    {!! Form::checkbox('status', 'published') !!} Publish?--}}
    <input type="hidden" name="create_or_update" value="{{ $createOrUpdate }}">
    <input type="hidden" name="type" value="{{ $type }}">
    <input type="hidden" name="event_type" value="{{ $eventType }}">
    <input type="hidden" name="event_slug" value="{{ $results['event']->slug }}">
</div>
<div class="form-group col-md-4 col-md-offset-4">
    {!! Form::submit( $submitBtnText, ['class' => 'btn btn-primary btn-block btn-lg']) !!}
</div>

<div class="clearfix"></div>