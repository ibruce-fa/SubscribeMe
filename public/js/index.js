/**
 * Created by macbook on 11/9/17.
 */
$('.show-sm-modal').on('click', function(){
    var target = $(this).attr('data-modal-target');
    $(target).show(500);
    console.log(target);
});

$('.hide-sm-modal').on('click', function(){
    $('.sm-modal').hide(500);
});

$('.sm-modal').on('click', function(e){
    if (e.target !== this){
        return;
    }
    $(this).hide(500);
});

$('.has-business-hours').on('change', function(){
    if($(this).is(':checked'))
    {
        $('.business-hours').show();
    } else {
        $('.business-hours').hide();
    }
});
//
// $('#review-form').submit(function (event) {
//     event.preventDefault();
//     var reviewContainer = $('#review-container');
//     var userName = $(this).children('.user-name').val();
//     var reviewBody = $(this).children('.review-body').val();
//     var date = $(this).children('.date').val();
//     var review = $('<div class="review"><p>'+reviewBody+'</p><small class="text-muted">Posted by <b>'+userName+'</b> on '+date+'</small></div><hr>');
//     reviewContainer.prepend(review);
// });


function triggerTargetClick(obj) {
    event.preventDefault();
    $($(obj).attr('data-target')).trigger('click');
}

function triggerTargetSubmit(obj) {
    event.preventDefault();
    $($(obj).attr('data-target')).submit();
}
// When clicking here, we will trigger the dropzone that
// lets us choose a NEW FEATURED PHOTO for the the PLAN


