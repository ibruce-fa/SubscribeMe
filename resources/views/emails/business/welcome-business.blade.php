@component('mail::message')
{{$body}}
@component('mail::button', ['url' => $url])
Business Profile
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
