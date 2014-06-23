// jQUery 各種呼び出しfunction
jQuery(document).ready(function($) {
    // iFrame 自動調整
    $('.entry-post').iframeAutoResizer({
        GoogleHeight: 12
    });
    // embed自動調整（WordPressTVのみ）
    $('.entry-post').embedAutoSize();

    // スクロール
    $('#top-btn').hide();
    $(window).on('scroll', function() {
        var scTop = $(this).scrollTop();
        var pageTop = $('#top-btn'),
            snsBtn = $('.index-sns');
        var contOffset = $('#contents').offset(),
            paddingTop = 22;

        if(scTop >= 300) {
            pageTop.stop().fadeIn('fast');
        }else{
            pageTop.stop().fadeOut('fast');
        }
        if(!ex.isMobile()) {
            if(scTop > contOffset.top) {
                snsBtn.stop().animate({
                    marginTop: $(this).scrollTop() - contOffset.top + paddingTop
                });
            }else{
                snsBtn.stop().animate({
                    marginTop: 0
                });
            }
        }
    });

    $('a[href^=#]').on('mousedown touchend',function(e){
        e.preventDefault();
        var obj = $(this).attr('href');
        var pos = $(obj).offset().top;
        $('html, body').animate({
            scrollTop: pos
        }, 500);
    });

    if(ex.isMobile()) {
        $(document).on('touchstart touchmove touchend',function(event){});
        $('#sp-btn').on('touchstart touchmove touchend',function(event) {
            var menu_id = $(this).data('menu');
            if(event.type === 'touchend') {
                $(menu_id).showToggle();
            }
        });
    }

    // Lightbox手前味噌
    $('.entry-post a').quezysLibox();
});
