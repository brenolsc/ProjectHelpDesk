$(document).ready(function() {
    $('.btn-delete-project').click(function(){
        $(this).prop('disable', true);
        let projectImageId = $(this).data('projectImageID');
        $.post('delete-project-image', {id: projectImageId})
            .done(function (){
                $("#project-form__image-containere-"+projectImageId).remove();
            })
            .fail(function() {
                $('.btn-delete-project').prop('disable', false);
                $('#project-form__image-error-message-'+projectImageID).text('Failed to delete image');
            })

    });
});