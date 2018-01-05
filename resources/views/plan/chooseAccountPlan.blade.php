@extends('layouts.app')

@section('body')
    <div class="container">
        <div class="row">
            <div class="col-md-8 offset-md-2">
                <div class="panel panel-primary">
                    <h1 class="text-center">Choose Your Plan</h1>
                    @foreach($appPlans as $plan)
                        <a href="/subscription/subscribe/{{$plan->stripe_plan_id}}">
                            <div class="col-md-3" >
                                <h3>{{$plan->stripe_plan_name}}</h3>
                                <h4>{{formatPrice($plan->price)}}</h4>
                            </div>
                        </a>
                    @endforeach
                </div>
            </div>
        </div>

@endsection
