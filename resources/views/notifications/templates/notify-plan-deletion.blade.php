<h4>Heads up! A subscription you own will be cancelled because we have removed it from our services:</h4>
<hr>
<ul style="width: 100%">
    <li>Subscription name: <h3>{{$serviceName}}</h3></li>

    <li>Confirmation ID: <p style="color: black">{{$confirmationId}}</p></li>

    <li>Refund Status: {{$refund ? 'A refund will be issued to your bank card' : 'no refund is due since the cancellation is not with in the refundable period'}}</li>

</ul>

<p>We apologize for any inconvenience this may have caused</p>
<hr>
<div class="row text-center">
    @if($logoPath)
        <div class="col-12">
            <h3 class="text-center">{{$companyName}} thanks you</h3>
        </div>
        <div style="margin: auto; margin-bottom: 5px; width: 70px; height: 70px; background: url({{ asset('/storage/'.$logoPath) }}) no-repeat; background-size: contain"> </div>
    @endif
</div>