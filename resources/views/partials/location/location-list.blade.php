
@if(isset($locations))
    @forelse($locations as $location)
        <li class="card-header location-item"
            data-id ="{{$location->id}}"
            data-city ="{{$location->city}}"
            data-state="{{$location->state}}"
            data-lat="{{$location->lat}}"
            data-lng="{{$location->lng}}">
                {{$location->city}}, {{$location->state}} - {{$location->zip}}
        </li>
    @empty
        <li class="card-header">no results</li>
    @endforelse
@endif
