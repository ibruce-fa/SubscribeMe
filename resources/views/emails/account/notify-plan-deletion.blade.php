@component('mail::message')
    {{$business->name}} is no longer providing a service you were subscribed to, so your subscription is being canceled.
    Please check your notifications to see more details
    @component('mail::button', ['url' => $url])
        Notifications
    @endcomponent

    Thanks,<br>
    {{ config('app.name') }}
@endcomponent
