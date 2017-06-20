@component('mail::message')
# {{ $message['subject'] }}

{{ $message['body'] }}

Contacted By: {{ $message['contacted_by'] }} <br>
Contact Email: {{ $message['contact_email'] }}

@endcomponent

