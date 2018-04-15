@component('mail::message')
    Hi {{$user->first}},<br>
    we had to suspend your subscription to
    <span class="theme-color"><b><i>{{$plan->stripe_plan_name}}</i></b></span>
    because your payment didn't go through
@component('mail::button', ['url' => env('APP_URL').'/account/paymentMethod'])
Update Payment
@endcomponent

Thanks,
{{ config('app.name') }}
@endcomponent
