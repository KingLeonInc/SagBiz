@component('mail::message')
# Thank You!

Thanks for registering to this @if($event->event_type == 1) event @else tradeshow @endif.

@component('mail::table')
| @if($event->event_type == 1) Event @else Tradeshow @endif |    Start Date   |     End Date     |      Price      |
| ------------- |:-------------:|:-------------:|:-------------:|
| {{ $event->title }} | {{ Carbon\Carbon::parse($event->start_date)->format('m/d/Y m:h A') }} | {{ Carbon\Carbon::parse($event->end_date)->format('m/d/Y m:h A') }} | ETB {{ $event->price }}
@endcomponent

@component('mail::button', ['url' => url('event/'.$event->slug)])
@if($event->event_type == 1) Event @else Tradeshow @endif Details
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
