@component('mail::message')
{!! $body !!}

@component('mail::button', ['url' => $url])
Go to your subscriptions
@endcomponent

Thanks,
{{ config('app.name') }}
@endcomponent
