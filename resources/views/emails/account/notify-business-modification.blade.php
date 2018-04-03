@component('mail::message')
    {{$business->name}} made some changes to their business's details. We thought you should know.
    Please check your notifications for more details.

    @component('mail::button', ['url' => $url])
        Notifications
    @endcomponent

    Thanks,<br>
    {{ config('app.name') }}
@endcomponent
