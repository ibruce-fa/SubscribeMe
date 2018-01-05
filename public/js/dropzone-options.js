/**
 * Created by macbook on 11/9/17.
 */
let dropzones = $('.dropzone');

Dropzone.autoDiscover = false;

$(function() {
    // Now that the DOM is fully loaded, create the dropzone, and setup the
    // event listeners;

    dropzones.each(function(index){
        let dropzone = new Dropzone('#' + $(this).attr('id'));
        dropzone.paramName = 'file[]';
        dropzone.maxFiles = 4;
        dropzone.uploadMultiple = true;
        dropzone.on("sending", function(file) {
            /* Maybe display some more file information on your page */
            $('#loading').show();
        });
        dropzone.on("complete", function(file) {
            /* Maybe display some more file information on your page */
            $('#loading').hide();
            location.reload();
        });

        dropzone.on('sending', function (file, xhr, formData) {
            // formData.append("_token", $(this).children('_token').val());
        });
    });

});