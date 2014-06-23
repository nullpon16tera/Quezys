// jQUery 各種呼び出しfunction
jQuery(document).ready(function($) {
    $(document).on('touchstart touchmove touchend',function(event){});
    $('#sp-btn').on('touchstart touchmove touchend',function(event) {
        var menu_id = $(this).attr('data-menu');
        if(event.type === 'touchend') {
            $(menu_id).showToggle();
        }
    });
});
