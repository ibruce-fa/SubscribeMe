@extends('layouts.app')

@section('body')
    @include('partials.account-back')
    <h3 class="text-center"> My Subscriptions</h3>
    <div class="container">
        <div class="row">
            <div class="col-12">
                @if($mustUpdatePaymentMethod)
                    <div class="alert alert-danger">
                        Your subscriptions are suspended. Please update your payment method.
                        If you do not update your payment method soon, your subscriptions will be cancelled<br>
                        <a class="btn btn-danger btn-sm text-white m-auto" href="/account/updatePayment">
                            Update Payment Method
                        </a>
                    </div>


                @endif
            </div>
            <div class="col-md-8 offset-md-2">

                @forelse($subscriptions as $subscription)
                    @php $plan = $subscription->plan(); @endphp
                <div class="card">
                    {{--@if($mustUpdatePaymentMethod || true)--}}
                        {{--<div class="card" style="width: 100%; height: 100%; position: absolute; left: 0; top: 0px; background: rgba(0,0,0,.5)"></div>--}}
                    {{--@endif--}}
                        <div class="card-header">
                            {{removeLastWord($subscription->name)}} - {{$subscription->uses ? : 0}}/{{$plan->use_limit}} uses
                            <form method="POST" action=/subscription/cancel/{{$subscription->id}}" style="display: inline-block" class="float-right">
                                {{csrf_field()}}
                                {{method_field("DELETE")}}
                                <input type="hidden" name="is_business_account" value="0">
                                <button type="submit" class=" text-danger "> Cancel Subscription </button> {{-- still needs to be worked out --}}
                            </form>
                        </div>
                        <div class="card-body">
                            <p>{{$plan->description}}</p>
                            <img src="{{getImage($plan->featured_photo_path)}}" width="200">
                            <hr>
                            <button class="btn btn-success show-sm-modal checkin" data-subscription-id="{{$subscription->id}}" data-plan-id="{{$plan->id}}" data-modal-target="#checkin-{{$subscription->id}}" {{$mustUpdatePaymentMethod ? "disabled" : ""}}> Check-in </button> {{-- still needs to be worked out --}}
                            <button class="btn btn-info" {{$mustUpdatePaymentMethod ? "disabled" : ""}}> View Details </button> {{-- we need a modal for this --}}
                            <a class="btn btn-warning" href="{{$mustUpdatePaymentMethod ? "#" : '/business/viewService/'.$plan->id.'/#review-container'}}" > Write A Review </a>
                            <button class="btn btn-primary show-sm-modal" data-modal-target="#rate-{{$plan->id}}" {{$mustUpdatePaymentMethod ? "disabled" : ""}}>Rate <span class="fa fa-star"></span> </button>
                            <hr>
                        </div>
                </div>
                @include('modals.custom.checkin-modal')
                @include('modals.custom.ratings-modal')
                @empty
                    <div class="card">
                        <div class="card-header">No subscriptions yet!</div>
                    </div>
                @endforelse
            </div>
        </div>
    </div>
@endsection
@section('footer')
    <script src="{{asset('js/ajax/checkin.js')}}"></script>
@endsection
