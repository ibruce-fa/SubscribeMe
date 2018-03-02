@extends('layouts.app')

@section('body')

    <div class="container-fluid">
        <div class="text-center">
            <h2 class="">You don't have an account yet, but creating one is easy!</h2>
            <h3 class="">Our plan is simple</h3>
        </div>
        <div class="row">
            @foreach($plans as $plan)
                <div class="col-md-4 offset-md-4">
                    <div class="panel panel-default text-center">
                        <div class="panel-heading">
                            <h3>{{$plan->stripe_plan_name}}</h3>
                        </div>
                        <div class="panel-body">
                            <h4><strong>1</strong> Business</h4>
                            <h4><strong>Up to 10</strong> Service Plans</h4>
                            <p> 7% fee per subscription</p>
                        </div>
                        <div class="panel-footer">

                            <h3>Just $1 a month!</h3>
                            <a href="/subscription/subscribe/{{$plan->stripe_plan_id}}_month" class="btn btn-sm">Sign Up</a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection
