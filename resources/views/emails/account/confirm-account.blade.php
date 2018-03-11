@component('mail::message')
<b>Hi, {{$name}}.</b>

Thank you for registering. Click the button below to confirm your account and login

@component('mail::button', ['url' => $url])
Confirm Account
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
