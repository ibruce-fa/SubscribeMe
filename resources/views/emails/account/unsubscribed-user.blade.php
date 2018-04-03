@component('mail::message')
    {!! $body !!}

@component('mail::button', ['url' => $url])
    Notifications
@endcomponent

    Thanks,
    {{ config('app.name') }}
@endcomponent
