@extends('layouts.app')

@section('body')
<div class="container-fluid">
    <div class="row page-search">
                <!-- Store Search -->
        <form action="/home" method="get" class="col-md-5 offset-md-1 " id="search-form">
            <div class="block d-flex">
                    <input type="hidden" name="location_id" id="location_id" value="{{getAuthUser()->location_id ?: 0}}">
                    <input type="text" class="form-control mb-2 mr-sm-2 mb-sm-0" value="{{$searchField ?: ''}}" id="searchField" name="searchField" placeholder="What are you looking for?" style="background: white ">
            </div>
            <hr>
            <a class="text-white" data-toggle="collapse" data-target="#more-criteria" aria-expanded="false" aria-controls="more-criteria">
               <span class="fa fa-plus-circle"></span> Advanced search
            </a>
            <div class="block form-group collapse" id="more-criteria">
                <label class="text-white">Distance in miles:</label>
                <input id="miles" name="miles" type="number" value="{{$miles}}" class="form-control bg-white" min="1" max="100" placeholder="Distance in miles">
            </div>
            <hr>
        </form>

        <form class="col-md-3 col-sm-12" id="location-form">
            <div class="block d-flex location-label-container">
                <label class="form-control" id="location-label" style="background: white"><span class="fa fa-location-arrow fa-2x"></span> {{sprintf("%s, %s",$location->city, $location->state) }}</label>
                <input class="form-control {{$location ? 'hide' : ''}}" name="location" id="location" placeholder="Enter your location" autocomplete="off" style="background: white ">
            </div>

            <div id="location-list-container" class="col-md-8 card">
                <ul style="list-style: none;" id="location-list">
                    <li class="card-header">Loading...</li>
                </ul>
            </div>

        </form>
        <div class="col-md-2 col-sm-12">
            <div class="block d-flex">
                <button class="btn btn-default form-control" style="background: white" onclick="triggerTargetSubmit(this)" data-target="#search-form"><span class="fa fa-search"></span></button>
            </div>
        </div>
    </div>
</div>

<div class="container">
    <div class="row">
        @if(count($plans) || $queryString)
            <div class="col-md-12">
                <div class="search-result bg-gray">
                                                        {{--using default distance here--}}
                    <h4>Results For "{{$queryString}}" </h4>
                    <p>{{$count}} {{$count == 1 ? 'result' : 'results'}} within {{$miles}} miles of {{$location->city}}, {{$location->state}}</p>
                </div>
            </div>
        @else
            <div class="col-md-12">
                <div class="search-result bg-gray">
                    <h2>Local deals in your area</h2>
                </div>
            </div>
        @endif

        @if($count >= $maxResults)
            {{--PAGINATION--}}
            <div class="col-md-12">
                @php
                    $totalPages = ceil($count/$maxResults);
                    $pages = ceil((request()->get('from') ?: 1)/10) * 10;
                @endphp
                @if($pages > 10)
                <a href="#" data-from="{{$pages-11}}" onclick="triggerTargetSubmit(this)" data-target="#search-form"><span class="fa fa-arrow-left"></span> </a>
                @endif
                @for($i = $pages > 10 ? $pages - 10 : 1; $i <= $pages + 1; $i++)
                    @if($pages < $i)
                        <a href="#" data-from="{{$i}}" onclick="triggerTargetSubmit(this)" data-target="#search-form"><span class="fa fa-arrow-right"></span> </a>
                    @else
                        <a href="#" class="{{$searchFrom == $i ? 'text-info' : ''}}" data-from="{{$i}}" onclick="triggerTargetSubmit(this)" data-target="#search-form">{{$i}} | </a>
                    @endif
                @endfor
            </div>
        @endif

        @forelse($plans as $plan)
                <div class="col-sm-12 col-md-4">
                    <!-- product card -->
                    <div class="product-item bg-light">
                        <div class="card">
                            <div class="thumb-content" style="width: 100%; height: 200px; background: url({{asset('/storage/'.$plan->featured_photo_path)}}) no-repeat; background-size: contain; background-position: center">

                            </div>
                            <div class="card-body">
                                <h4 class="card-title"><a href="">{{$plan->stripe_plan_name}}</a></h4>
                                <ul class="list-inline product-meta">
                                    <li class="list-inline-item">
                                        <a href=""><i class="fa fa-briefcase"></i>{{$plan->business['name']}}</a>
                                    </li>

                                    <li class="list-item">
                                        <a href=""><i class="fa fa-location-arrow"></i>{{$plan->business['city']}}, {{$plan->business['state']}} - {{howFarAway($location->lat,$location->lng,$plan->business['lat'],$plan->business['lng'])}} mi</a>
                                    </li>
                                </ul>
                                <div class="product-ratings">
                                    <ul class="list-inline">
                                        <span class="text-warning">
                                            {{getRatingStars($plan->rating)}}
                                        </span>
                                        <a class=" list-inline-item float-right">{{formatPrice($plan->month_price)}} - {{formatPrice($plan->year_price)}}</a>
                                    </ul>

                                </div>
                            </div>
                            <div class="card-header">
                                <a href="/business/viewService/{{$plan->id}}" class="text-info">view service</a>
                                <a href="/business/viewStore/{{$plan->business['id']}}" class="float-right text-info">Go to store</a>
                            </div>
                        </div>
                    </div>
                </div>

        @empty
            <br>
        @endforelse
    </div>
</div>

@endsection

@section('footer')
<script src="{{asset('/js/location/setLocation.js')}}"></script>
<script src="{{asset('/js/index.js')}}"></script>
@endsection
