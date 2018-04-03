@component('mail::message')
{!! $body !!}
@component('mail::button', ['url' => $url])
Business Profile
@endcomponent

Thanks,
{{ config('app.name') }}
@endcomponent
