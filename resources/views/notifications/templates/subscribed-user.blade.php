<h4>Thank you for your subscription to <span class="theme-color">{{$companyName}}</span> . Here are the details of your subscription</h4>
<hr>
<ul style="width: 100%">
    <li>Purchased Subscription: <h3>{{$serviceName}}</h3></li>
    <li>Price per {{$interval}}: <h3>{{$price}}</h3></li>
    <li>Usage limit: <h4>{{$usageDescription}}</h4> </li>
    <li>description: <p style="color: black">{{$description}}</p></li>
</ul>

{{--maybe--}}
<hr>
<div class="row text-center">
    @if($logoPath)

        <div class="col-12">
            <h3 class="text-center">{{$companyName}} thanks you</h3>
        </div>
        {{--<div class="col-md-8 offset-md-2">--}}
            <div style="margin: auto; margin-bottom: 5px; width: 200px; height: 200px; background: url({{ asset('/storage/'.$logoPath) }}) no-repeat; background-size: contain"> </div>
        {{--</div>--}}
    @endif
    {{--<img src="{!! $logoPath !!}" style="width: 200px; maheight: auto">--}}
</div>