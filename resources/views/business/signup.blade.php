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
                            <p><strong>1</strong> Business</p>
                            <p><strong>3</strong> Service Plans</p>
                            <p><strong>$5</strong> / month for every additional business</p>
                            <p><strong>$1</strong> / month for every additional service</p>
                            <p></p>
                        </div>
                        <div class="panel-footer">

                            <h3>{{formatPrice($plan->month_price)}}</h3>
                            <h4>per month</h4>
                            <a href="/subscription/subscribe/{{$plan->stripe_plan_id}}_month" class="btn btn-sm">Sign Up</a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection
