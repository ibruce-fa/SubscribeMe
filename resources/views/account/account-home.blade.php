@extends('layouts.app')

@section('body')
    <h3 class="text-center">Account Home</h3>
    <div class="container">
        <div class="row">
            <div class="col-md-8 offset-md-2">
                    <ul class="list-group text-center" style="border: none">
                        <a href="/account/subscriptions" class="list-group-item theme-background text-default">My Subscriptions</a>
                        <a href="/account/notifications" class="list-group-item theme-background text-default"> Notifications</a>
                        <a href="/account/details" class="list-group-item theme-background text-default"> My Account</a>
                        <a href="/account/support" class="list-group-item theme-background text-default"> Customer Support</a>
                    </ul>
            </div>
        </div>
    </div>
@endsection
