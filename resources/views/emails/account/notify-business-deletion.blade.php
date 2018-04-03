@component('mail::message')
    {{$business->name}} is no longer in business with us at Otruvez.
    Any subscription you had with them will be canceled.
Please check your notifications to see more details

@component('mail::button', ['url' => $url])
Notifications
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
