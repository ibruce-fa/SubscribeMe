@component('mail::message')
{{$business->name}} has issued the following message to their customers:<br>

{!! $body !!}

@component('mail::button', ['url' => $url])
Notifications
@endcomponent

Thanks,
{{ config('app.name') }}
@endcomponent
