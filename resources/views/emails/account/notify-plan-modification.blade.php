@component('mail::message')
    {{$business->name}} made some changes to service you are subscribed to. We thought you should know.
    Please check your notifications for more details.

@component('mail::button', ['url' => $url])
    Notifications
@endcomponent

    Thanks,
    {{ config('app.name') }}
@endcomponent
