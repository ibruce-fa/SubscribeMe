@extends('layouts.app')

@section('body')
    @if(!session('planName'))
        <div class="container">
            <div class="row">
                <div class="col-md-4 offset-md-4 text-center">
                    <h1>Why are you here?</h1>
                    <h2 class="btn btn-primary">
                        Dave Chappelle.....GO HOME!!!
                    </h2>
                </div>
            </div>
        </div>
    @else
    <div class="container">
        <div class="row">
            <div class="col-md-8 offset-md-2">
                <div class="card card-header">
                    <h1 class="text-center">Thanks for your subscription to {{session('planName')}}</h1>
                </div>
                <div class="card card-body">
                    <h2 class="text-center"><u>Details</u></h2>
                    <h3 class="text-center">Price: <strong>{{formatPrice(session('price'))}}</strong> per <strong>{{session('interval')}}</strong></h3>
                    <hr>
                    <p class="text-center">To use this service now, <a href="/account/mysubscriptions">click here to go to your subscriptions</a></p>
                    <a href="/home" class="btn btn-primary">Find more services</a>
                </div>
            </div>
        </div>
    </div>
    @endif

@endsection
