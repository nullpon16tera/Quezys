
var topic = {
    // 新着の表示件数を変更する
    remover: function(elem,mins) {
        var _element = ex.param(elem,'#topics > dl');
        var min = ex.param(mins,1);
        var topicElem = $(_element);
        var max = topicElem.length;
        for(var i=min; i < max; i++) {
            topicElem.eq(i).remove();
        }
    },
    // Topicsの画像設定とリンク設定
    imageLink: function(elem,find){
        var elem = ex.param(elem,'#topicList dl');
        $(elem).each(function(){
            var figure = $(this).find(ex.param(find,'figure'));
            var image = figure.data('image');
            var video = figure.data('video');
            var href = $(this).find('a').attr('href');
            var url = location.href;
            if(image !== undefined && video === undefined) {
                figure.css('background-image', 'url(' + image + ')');
                $(this).css('cursor','pointer');
                $(this).on('click',function(){
                    window.location.href = href;
                });
            }else{
                figure.css('background-image', 'url(images/top/other.png)');
            }
        });
    }
};

var movie = {
    vimeo: function(elem) {
        var elem = ex.param(elem,'#movieList dl');
        var btnClose = '<div class="closeBtn"><img src="./images/btn_close.png" title="閉じる" alt="閉じる"></div>'
        $('body').before('<div id="videoWindow">' + btnClose + '<div class="player"></div></div>');
        var windowObj = $('#videoWindow');
        var player = '.player';
        $(elem).each(function(){
            var figure = $(this).find('figure');
            var movie = figure.data('video');
            var image = figure.data('image');
            if(movie !== undefined) {
                var videoArr = movie.split('/');
                var videoLeng = videoArr.length-1;
                if((movie.indexOf('vimeo.com') != -1)) {
                    var vimeoId = videoArr[videoLeng];
                    $.getJSON('http://www.vimeo.com/api/v2/video/' + vimeoId + '.json?callback=?', {format: "json"}, function(data) {
                        figure.css('background-image', 'url(' + data[0].thumbnail_medium + ')');
                    });
                }else{
                    figure.html('動画がありません');
                    console.log('not vimeo')
                }
            }else{
                figure.css('background-image', 'url(images/top/other.png)');
            }
            if(image === undefined || image === '' || movie !== undefined) {
                $(this).css({ cursor: 'pointer' });
                $(this).on('click',function(){
                    windowObj.fadeIn('fast',function(){
                        $(this).find(player).html('<iframe src="//player.vimeo.com/video/' + videoArr[videoLeng] + '?autoplay=1" width="100%" height="100%" webkitallowfullscreen mozallowfullscreen allowfullscreen></iframe>');
                    });
                });
            }
        });
        $('div:first').find('.closeBtn').on('click',function(){
            windowObj.fadeOut('fast');
            windowObj.find(player).html('');
        });
        $('div:first').on('click',function(){
            $(this).fadeOut('fast');
            $(this).find(player).html('');
        });
        $(window).on('load resize',function(){
            var width = parseInt((($(this).width()+120)/2)/16);
            var videoWidth = (width*16);
            var videoHeight = (width*9);
            /*windowObj.css({
                width: $(window).width(),
                height: $(window).height()
            });*/
            $('.closeBtn').stop().animate({
                marginTop: -(videoHeight/2+14),
                marginLeft: (videoWidth/2-14)
            });
            $(player).stop().animate({
                width: videoWidth,
                height: videoHeight,
                marginTop: -(videoHeight/2),
                marginLeft: -(videoWidth/2)
            });
        });
    }
};
$(function(){
    movie.vimeo();
    
});

// ドロップダウンメニュー
var menu = {
    dropdown: function(elem,find) {
        var elem = ex.param(elem,'#naviList li');
        var subelem = ex.param(find,'ul.submenu');
        var subobj = $(subelem);
        subobj.hide();
        var subLength = subobj.length-1;
        if(0 != subLength) {
            $(subelem).eq(subLength).css({
                'right' : 0,
                'margin-right' : 0
            });
        }
        $(elem).each(function(){
            $(this).hover(function(){
                $(subelem,this).stop(false,true).slideDown('fast');
            },function(){
                $(subelem,this).stop(false,true).fadeOut('fast');
            });
        });
    }
};


window.onload = function(){
    var __element = document.getElementsByTagName('body').item(0);
    if(ex.isUA('Windows')) {
        __element.style.fontFamily = '"メイリオ", Meiryo, "ＭＳ Ｐゴシック", "MS PGothic", sans-serif';
    }else{
        __element.style.fontFamily = '"ヒラギノ丸ゴ ProN", "Hiragino Maru Gothic ProN", sans-serif';
    }
}

