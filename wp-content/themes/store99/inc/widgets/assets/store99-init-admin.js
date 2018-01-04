jQuery(document).ready(function ($) {

    var store99_upload;
    var store99_selector;
    var store99_file_frame, thumbnails;

    function store99_add_file(event, selector) {

        var upload = $(".uploaded-file"), frame;
        var $el = $(this);
        store99_selector = selector;

        event.preventDefault();
        if (store99_upload) {
            store99_upload.open();
        } else {
            store99_upload = wp.media.frames.store99_upload = wp.media({
                title: $el.data('choose'),
                button: {
                    text: $el.data('update'),
                    close: false
                }
            });


            store99_upload.on('select', function () {
                var attachment = store99_upload.state().get('selection').first();
                console.log(attachment);
                store99_upload.close();
                store99_selector.find('.upload').val(attachment.attributes.url);
                if (attachment.attributes.type === 'image') {
                    store99_selector.find('.screenshot').empty().hide().append('<img src="' + attachment.attributes.url + '" width="50%"><a class="remove-image">Remove</a>').slideDown('fast');
                }
                store99_selector.find('.upload-button-wdgt').unbind().addClass('remove-file').removeClass('upload-button-wdgt').val(store99_l10n.remove);
                store99_selector.find('.of-background-properties').slideDown();
                store99_selector.find('.remove-image, .remove-file').on('click', function () {
                    store99_remove_file($(this).parents('.section'));
                });
            });
        }
        store99_upload.open();
    }

    function store99_remove_file(selector) {
        selector.find('.remove-image').hide();
        selector.find('.upload').val('');
        selector.find('.of-background-properties').hide();
        selector.find('.screenshot').slideUp();
        selector.find('.remove-file').unbind().addClass('upload-button-wdgt').removeClass('remove-file').val(store99_l10n.upload);
        if ($('.section-upload .upload-notice').length > 0) {
            $('.upload-button-wdgt').remove();
        }
        selector.find('.upload-button-wdgt').on('click', function (event) {
            store99_add_file(event, $(this).parents('.section'));

        });
    }

    $('body').on('click', '.remove-image, .remove-file', function () {
        console.log('dsd');
        store99_remove_file($(this).parents('.section'));
    });

    $(document).on('click', '.upload-button-wdgt', function (event) {
        store99_add_file(event, $(this).parents('.section'));
    });

});
