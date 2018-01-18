@extends('layouts.app')

@section('body')
    <h3 class="text-center"> My Subscriptions</h3>
    <div class="container">
        <div class="row">
            <div class="col-md-8 offset-md-2">
                <div class="card">
                    @forelse($subscriptions as $subscription)
                    @empty
                    @endforelse
                    <div class="card-header">

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
