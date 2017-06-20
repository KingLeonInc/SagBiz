@component('mail::message')
# {{ $massmail['subject'] }}

{{ $massmail['message'] }}


Regards,<br>
{{ config('app.name') }}
@endcomponent
