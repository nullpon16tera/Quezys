/*
Name : ex.plugins.js
Version : 1.6
Auther : ぬるぽん＠２合
URL : http://webs-k.com/
Blog : http://ga.nullppon.net/
Last modify : 2014/05/26 GMT-22:11
*/

;(function($){
    $.fn.isVisible = function() {
        return $.expr.filters.visible(this[0]);
    };

    $.fn.iframeAutoResizer = function(options){
        var defaults = {
            Video: true,
            GoogleMaps: true,
            SlideShare: true,
            VideoHeight: 9,
            GoogleHeight: 12,
            SlideHeight: 13
        };
        var option = $.extend(defaults, options);
        var elem = this;
        elem.find('iframe').each(function(){
            var iframeNum = elem.find('iframe').index(this);
            var iframe = $(this),
                iframeSrc = iframe.attr('src');
            var width = function() {
                return parseInt((iframe.parent(elem).width())/16)
            };
            var frameSize = function(obj) {
                return obj.css({ width: width()*16, height: (width()*option.VideoHeight) })
            };
            var googleMaps = function(obj) {
                return obj.css({ width: width()*16, height: (width()*option.GoogleHeight) })
            };
            var slideShare = function(obj) {
                return obj.css({ width: width()*16, height: (width()*option.SlideHeight) })
            };
            var isVideo = function(domains) {
                return (iframeSrc.indexOf(domains) !== -1);
            };
            if(isVideo('vimeo.com') || isVideo('youtube.com') || isVideo('dailymotion.com')) {
                if(option.Video === true) {
                    frameSize(iframe);
                }
            }else if(isVideo('myspace.com') && isVideo('video')) {
                    if(option.Video === true) {
                        frameSize(iframe);
                    }
            }else if(isVideo('google.com') && isVideo('maps')){
                if(option.GoogleMaps === true) {
                    googleMaps(iframe);
                }
            }else if(isVideo('slideshare.net')) {
                if(option.SlideShare === true) {
                    slideShare(iframe);
                }
            }else{
                return this;
            }
            $(window).on('resize',function(){
                if(isVideo('vimeo.com') || isVideo('youtube.com') || isVideo('dailymotion.com')) {
                    if(option.Video === true) {
                        frameSize(iframe);
                    }else{
                        return false;
                    }
                }else if(isVideo('myspace.com') && isVideo('video')) {
                    if(option.Video === true) {
                        frameSize(iframe);
                    }else{
                        return false;
                    }
                }else if(isVideo('google.com') && isVideo('maps')){
                    if(option.GoogleMaps === true) {
                        googleMaps(iframe);
                    }else{
                        return false;
                    }
                }else if(isVideo('slideshare.net')) {
                    if(option.SlideShare === true) {
                        slideShare(iframe);
                    }else{
                        return false;
                    }
                }else{
                    return false;
                }
            });
        });
        return this;
    };

    $.fn.embedAutoSize = function(options){
        var defaults = {
            Video: true,
            VideoHeight: 9
        };
        var option = $.extend(defaults, options);
        var elem = this;
        elem.find('embed').each(function(){
            var embedNum = elem.find('embed').index(this);
            var embed = $(this),
                embedSrc = embed.attr('src');
            var embedWidth = embed.attr('width'),
                embedHeight = embed.attr('height');
            console.log(embedWidth);
            var width = function() {
                return parseInt((embed.parent(elem).width())/16)
            };
            var embedSize = function(obj) {
                return obj.css({ width: width()*16, height: (width()*option.VideoHeight) })
            };
            var embedSizeAttrWidth = function(obj) {
                return obj.attr('width', (width()*16))
            };
            var embedSizeAttrHeight = function(obj) {
                return obj.attr('height', (width()*option.VideoHeight))
            };
            var isVideo = function(domains) {
                return (embedSrc.indexOf(domains) !== -1)
            };
            
            if(isVideo('v.wordpress.com') || isVideo('videopress.com')) {
                if(option.Video === true) {
                    embedSize(embed);
                    embedSizeAttrWidth(embed);
                    embedSizeAttrHeight(embed);
                }
            }else{
                return this;
            }
        });
        return this;
    };

    // show() Toggle function
    $.fn.showToggle = function(){
        var elem = this;
        elem.each(function(){
            if($(this).isVisible()) {
                $(this).hide();
            }else{
                $(this).show();
            }
        });
        return this;
    };

    // Lightbox手前味噌
    $.fn.quezysLibox = function(){
        var elem = this;
        elem.find('img').each(function() {
            $(this).parent('a').on('click', function(event) {
                var hrefCheck = $(this).attr('href');
                if(hrefCheck.indexOf('attachment') !== -1 || !hrefCheck.match(/.jpg|.png|.gif/)) { return };
                event.preventDefault();
                //if(ex.isMobile()) { return false; }
                var imgSrc = $(this).attr('href');
                if(!$('#quezys-window').size() > 0) {
                    $('<div/>', {
                        'id': 'quezys-window',
                        click: function() {
                            $(this).fadeToggle('fast','swing',function(){
                                $(this).delay(300).remove();
                            });
                        }
                    }).css({height: $('#wrap').height()}).appendTo('body');
                }
                $('#quezys-window').html('<a id="close" href="javascript: void(0);" title="閉じる">Close</a><div id="image-box"><img src="'+imgSrc+'" /></div>');
                $('#quezys-window').find('img').on('load',function() {
                    var _this_ = $(this);
                    var w = $(window).width(),
                        h = $(window).height();
                    var img_w = _this_.width(),
                        img_h = _this_.height();
                    var padding = (8*2);

                    var isImageSize = function() {
                        sizeArray = [];
                        imgWidth = (w/16)*12;
                        imgHeight = (h-160);
                        if(img_w < img_h) { // 画像が縦長
                            sizeArray = ['auto', imgHeight];
                        }else{ // 画像が横長
                            sizeArray = [imgWidth, 'auto'];
                        }
                        return _this_.css({ width: sizeArray[0], height: sizeArray[1] });
                    };
                    // サイズ判定
                    if(w < img_w || (h-40) < img_h) { // ウィンドウサイズが画像より小さければ処理
                        if(ex.isMobile()) {
                            $(this).css({
                                width: w,
                                height: 'auto'
                            })
                        }else{
                            if(w < 980) {
                                $(this).css({
                                    width: (($('#contents').width()-80)-padding),
                                    height: 'auto'
                                });
                            }else{
                                if(w < img_w) { // ウィンドウの幅が画像の幅より小さければ
                                    isImageSize();
                                }else if((h-40) < img_h) {
                                    isImageSize();
                                }
                            }
                        }
                    }

                    $(this).hide();
                    var imgBox = $(this).parent('#image-box');
                    var top = $(window).scrollTop()+($(window).height()/2);

                    imgBox.css({
                        top: top,
                        left: '50%',
                        marginTop: -32,
                        marginLeft: -32
                    });

                    if(ex.isMobile()) {
                        imgBox.stop().delay(700).animate({
                            width: $(this).width(),
                            height: $(this).height(),
                            marginTop: -(($(this).height()/2)),
                            marginLeft : -(($(this).width()/2))
                        },'fast');
                    }else{
                        imgBox.stop().delay(700).animate({
                            width: $(this).width()+padding,
                            height: $(this).height()+padding,
                            marginTop: -(($(this).height()/2)+(padding/2)),
                            marginLeft : -(($(this).width()/2)+(padding/2))
                        },'fast');
                    }
                    
                    // 閉じるボタン処理
                    var pos = imgBox.position();
                    var closeElem = $('#close');
                    closeElem.hide();
                        closeElem.css({
                            top: top,
                            left: '50%'
                        });
                    
                    if(ex.isMobile()) {
                        closeElem.css({
                            marginTop: -(($(this).height()/2)+36),
                            marginLeft: ((_this_.width()/2)-36)
                        }).stop().delay(850).fadeIn('fast');
                    }else{
                        closeElem.css({
                            marginTop: -(($(this).height()/2)+18),
                            marginLeft: ((_this_.width()/2)-14)
                        }).stop().delay(850).fadeIn('fast');
                    }
                    
                    $(this).stop().delay(700).fadeIn('slow');
                }); // on(load)
            });
        }); // Lightbox
        return this;
    };
})(jQuery);

