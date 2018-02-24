@extends('layouts.app')
@section('body')
    <div class="row">
        <div class="col-md-8 offset-md-2">
            <div class="card">
                <div class="card-header">
                    <h4>Are you sure you want to delete your business account?</h4>
                    <p class="text-danger">Note* All subscriptions that have over a week left will be refunded</p>
                </div>
                <div class="card-body">
                <a href="/business" class="btn theme-background text-white pull-left">Back</a>

                    <button class="btn btn-danger pull-right show-sm-modal" data-modal-target="#confirm-delete-business-modal">Delete Account</button>
                </div>
            </div>
        </div>
    </div>
    @include('modals.custom.confirm-delete-business-modal')
@endsection