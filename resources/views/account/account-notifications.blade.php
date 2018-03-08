@extends('layouts.app')
@section('body')
    @include('partials.back')
    {{--@forelse($notifications as $notification)--}}

    {{--@empty--}}
    {{--@endforelse--}}
    <div class="row">
        <div class="col-md-8 offset-md-2">
            <h3 class="text-center">Notifications</h3>
            @forelse($notifications as $notification)
                <div class="card">
                    <div class="card-footer">
                        <p>From: <b>LocalDopeTv</b><hr></p>
                        <h4><b>{{$notification->subject}}</b></h4>
                    </div>
                    <div class="card-body">
                        @if($notification->is_template)
                            @php /** @var \App\Notification $notification */ @endphp
                            {!! $notification->renderNotificationView($notification->type) !!}
                        @else
                            {{$notification->body}}
                        @endif
                    </div>
                </div><br>
            @empty
                <div class="card">
                    <div class="card-header">
                        <h4><b>No notifications yet</b></h4>
                    </div>
                </div><br>
            @endforelse

        </div>
    </div>

@endsection