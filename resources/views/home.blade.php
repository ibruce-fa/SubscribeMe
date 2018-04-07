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
                <button class="btn btn-default form-control" style="background: white" onclick="triggerTargetSubmit(event, this)" data-target="#search-form"><span class="fa fa-search"></span></button>
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
                    <p>{{$totalResultCount}} {{$totalResultCount == 1 ? 'result' : 'results'}} within {{$miles}} miles of {{$location->city}}, {{$location->state}}</p>
                </div>
            </div>
        @else
            <div class="col-md-12">
                <div class="search-result bg-gray">
                    <h2>Local deals in your area</h2>
                </div>
            </div>
        @endif

        @if($totalResultCount >= $maxResults)
            {{--PAGINATION--}}
            <div class="col-md-12">
                @php
                    $totalPages             = ceil($totalResultCount/$maxResults); // total pages needed for pagination
                    $currentPageInterval    = $searchFrom ? floor($searchFrom/125) + 1 : 1; // we will paginate in increments of 5. this determines which interval of 5 we will be on
                    $loopStart              = $currentPageInterval < 2 ? 1 : ($currentPageInterval - 1) * 5; // which multiple of 5 we should start our loop based on the current interval
                    $loopEnd                = $totalPages - $loopStart >= 5 ? ($currentPageInterval * 5) : $totalPages + 1 - $loopStart;
                    $rightArrow             = $totalPages > 5 && (!$searchFrom || $searchFrom < 125)  || ( ( $totalResultCount - ( floor($searchFrom/125) * 125 ) ) / $maxResults ) > 5;
                    $rightArrowFrom         = ($currentPageInterval * 125 );
                    var_dump($currentPageInterval);
                    var_dump($loopStart);
                    var_dump($loopEnd);
                @endphp
                
                @for($i = $loopStart; $i <= $loopEnd; $i++)
                    <a href="#" class="{{ !$searchFrom && $i == 1 || $searchFrom == ($i - 1) * $maxResults ? 'theme-color' : ''}}" data-from="{{$i == 1 ? $i - 1 : ($i - 1) * $maxResults}}" onclick="triggerTargetSubmit(event, this)" data-target="#search-form">| {{$i}}</a>
                    
                @endfor
                @if($rightArrow)
                    <a href="#" data-from="{{$rightArrowFrom}}"><span class="fa fa-arrow-right"></span></a>
                @endif

                {{--@for($i = $pages > 10 ? $pages - 10 : 1; $i <= $pages + 1; $i++)--}}
                    {{--@if($pages < $i)--}}
                        {{--<a href="#" data-from="{{$i}}" onclick="triggerTargetSubmit(event, this)" data-target="#search-form"><span class="fa fa-arrow-right"></span> </a>--}}
                    {{--@else--}}
                        {{--<a href="#" class="{{$searchFrom == $i ? 'text-info' : ''}}" data-from="{{$i}}" onclick="triggerTargetSubmit(event, this)" data-target="#search-form">{{$i}} | </a>--}}
                    {{--@endif--}}
                {{--@endfor--}}
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
