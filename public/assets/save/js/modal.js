jQuery(document).ready(function($) {
    //open popup
    $('.c-modal-trigger').on('click', function(event) {
        event.preventDefault();
        $('.c-modal').addClass('is-visible');
    });

    //close popup
    $('.c-modal').on('click', function(event) {
        if ($(event.target).is('.c-modal-close') || $(event.target).is('.c-modal')) {
            event.preventDefault();
            $(this).removeClass('is-visible');
        }
    });
    //close popup when clicking the esc keyboard button
    $(document).keyup(function(event) {
        if (event.which === '27') {
            $('.c-modal').removeClass('is-visible');
        }
    });

    $('.m-modal-trigger').on('click', function(event) {
        event.preventDefault();
        $('.m-modal').addClass('is-visible');
    });

    //close popup
    $('.m-modal').on('click', function(event) {
        if ($(event.target).is('.m-modal-close') || $(event.target).is('.m-modal')) {
            event.preventDefault();
            $(this).removeClass('is-visible');
        }
    });
    //close popup when clicking the esc keyboard button
    $(document).keyup(function(event) {
        if (event.which === '27') {
            $('.m-modal').removeClass('is-visible');
        }
    });
});