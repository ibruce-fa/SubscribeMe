<div id="confirm-checkin-modal-{{$checkin->id}}" class="sm-modal">
    <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close hide-sm-modal" data-dismiss="modal">&times;</button>
        </div>
        <div class="modal-body">
            <h3 class="text-center">Confirming Check-in</h3>
            <div id="confirm-checkin-response-container-{{$checkin->id}}">
                <h3 class="text-center">
                    {{ getLoadingAnimation() }}

                </h3>
                <hr>
            </div>
        </div>
    </div>
</div>