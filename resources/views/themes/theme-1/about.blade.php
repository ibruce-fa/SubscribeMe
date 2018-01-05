@extends('layouts.theme.theme-1-layout')
@section('body')
    <div class="container" style="margin-bottom: 1000px">
        <div class="row">
            <div class="col-md-8 offset-md-2">

                <div class="card mt-4">
                    <h4 class="card-header">About {{$business->name}}</h4>
                    <div class="card-body">
                        <p class="card-text">{{$business->description}}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection