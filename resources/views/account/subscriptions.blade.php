@extends('layouts.app')

@section('body')
    <h3 class="text-center"> My Subscriptions</h3>
    <div class="container">
        <div class="row">
            <div class="col-md-8 offset-md-2">
                @forelse($subscriptions as $subscription)
                    @php $plan = $subscription->plan(); @endphp
                <div class="card">
                        <div class="card-header">{{removeLastWord($subscription->name)}} - {{$subscription->uses ? : 0}}/{{$plan->use_limit}} uses</div>
                        <div class="card-body">
                            <p>{{$plan->description}}</p>
                            <img src="{{asset('/storage/'.$plan->featured_photo_path)}}" width="200">
                            <hr>
                            <button class="btn btn-primary show-sm-modal checkin" data-subscription-id="{{$subscription->id}}" data-plan-id="{{$plan->id}}" data-modal-target="#checkin-{{$subscription->id}}"> Check-in </button> {{-- still needs to be worked out --}}
                            <button class="btn btn-primary"> View Details </button> {{-- we need a modal for this --}}
                            <form method="POST" action=/subscription/cancel/{{$subscription->id}}" style="display: inline-block">
                                {{csrf_field()}}
                                {{method_field("DELETE")}}
                                <input type="hidden" name="is_business_account" value="0">
                                <button type="submit" class="btn btn-danger"> Cancel Subscription </button> {{-- still needs to be worked out --}}
                            </form>
                        </div>
                </div>
                @include('modals.custom.checkin-modal')
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
