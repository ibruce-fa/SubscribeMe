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
                        <h4><b>The subject goes here</b></h4>
                    </div>
                    <div class="card-body">
                        The body of the message goes here and should be able to handle a lot of text know what i'm saying?
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