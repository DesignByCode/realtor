@component('mail::message')

#Welcome {{ $name }}

##You have been invited to become an agent on the website of {{ config('app.name') }}


Email: {{ $email }}

Password: {{ $password }}



Thanks,<br>
{{ config('app.name') }}

@endcomponent
