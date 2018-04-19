@extends('layouts.app')
@section('body')
    @include('partials.account-back')
    <div class="row">
        <div class="col-md-8 offset-md-2">
            @if(count($inactiveSubscriptions))
                <div class="alert-warning">
                    You have inactive subscriptions. please update your payment and then reactivate your subscriptions
                </div>

                <ul class="list-group">
                    @foreach($inactiveSubscriptions as $sub)
                        <li class="list-group-item">Subscription: <b>{{removeLastWord($sub->name)}}</b> <i class="text-danger">inactive</i><br>
                            <button class="btn-sm text-danger {{$hasValidPaymentMethod ? "" : "update-card-first"}}" >Reactivate</button></li>
                    @endforeach
                </ul>
                <br><br>
            @endIf
            <div class="card">
                <div class="card-header">
                    <h4 class="text-center">Payment Method</h4>
                </div>
                @if(!empty($user->card_last_four))
                    <ul class="m-2">
                        <li><u><b>Current card details</b></u></li>
                        <li>Card Type: {{$user->card_brand}}</li>
                        <li>CC Number: ****{{$user->card_last_four}}</li>
                    </ul>
                @else
                    <ul>
                        <li><h3><b>*No card on file*</b></h3></li>
                    </ul>
                @endif
                <form action="/account/updatePaymentMethod" method="POST" class="mt-4 text-center">
                    <script
                            src="https://checkout.stripe.com/checkout.js" class="stripe-button"
                            data-key="pk_test_GQCUjPm3eovgzCUVD2RmzTjU"
                            data-image="{{getOtruvezLogoImg()}}"
                            data-name="Your Website Name"
                            data-panel-label="Update Card Details"
                            data-label="Update Card Details"
                            data-allow-remember-me=false
                            data-locale="auto"
                            {{--data-email="{{$user->email}}"--}}
                    >

                    </script>
                    {{csrf_field()}}
                </form>
            </div>
        </div>
    </div>
    <script>
        $(document).ready(function(){
            $(this).find('.stripe-button').css('background','theme-background');
        });
    </script>
@endsection