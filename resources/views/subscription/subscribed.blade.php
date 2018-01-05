@extends('layouts.app')

@section('body')
    @php
    $planName = "nail color and fill";
    $price = 7000;
    $interval = "month";
    @endphp

    <style>
    </style>
    <div class="container-fluid">
        <a class="btn btn-info" href="{{ URL::previous() }}">Back</a>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-md-8 offset-md-2">
                <div class="card card-header">
                    <h1 class="text-center">Thanks for your subscription to {{$planName}}</h1>
                </div>
                <div class="card card-body">
                    <h2><u>Details</u></h2>
                    <h3 class="text-center">Price: <strong>{{$price}}</strong> per <strong>{{$interval}}</strong></h3>
                    <a href="" class="btn btn-primary float-left">Go to my subscriptions</a>
                    <a href="" class="btn btn-primary float-right">Find more services</a>
                </div>
            </div>
        </div>

@endsection
