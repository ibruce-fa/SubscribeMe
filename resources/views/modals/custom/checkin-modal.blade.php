<div id="checkin-{{$subscription->id}}" class="sm-modal" role="dialog" tabindex="-1" aria-hidden="true">
    <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close hide-sm-modal" data-dismiss="modal">&times;</button>
        </div>
        <div class="modal-body">
            <h1 class="text-center">Check-in</h1>
            <div id="checkin-response-container">
                <h3 class="text-center">Give this 5 digit code to the service worker to use their service.</h3>
                <hr>
                <h1 class="text-center checkin-code">{{getLoadingAnimation()}}</h1>
            </div>
        </div>
    </div>
</div>