$('.checkin').on('click', function () {
    let zis     = $(this);
    let planId = zis.attr('data-plan-id');

    let subscriptionId = zis.attr('data-subscription-id');
    let url = "/subscription/checkin/"+planId+"/"+subscriptionId;
    let checkinModal = $('#checkin-'+subscriptionId);
    let postdata = {
        "planId": planId,
        "subscriptionId": subscriptionId
    };

    $.post(url, postdata).done(function (data) {
        checkinModal.find('.checkin-code').text(data);
        zis.html("code: "+ data);
    });

});