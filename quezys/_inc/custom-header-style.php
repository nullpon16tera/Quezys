<?php function admin_header_style() { ?>
<style type="text/css">
    #headimg {
        max-width: 1148px;
        background-color: #fff;
    }
    #headimg .container {
        max-width: 1148px;
        min-height: 320px;
        padding: 24px;
        background-image: url(<?php header_image(); ?>);
        background-repeat: no-repeat;
        background-position: 50%;
        -webkit-background-size: cover;
                background-size: cover;
    }
    #headimg .inner {
        <?php if(display_header_text()) { ?>
        display: inline-block;
        <?php }else{ ?>
        display: none;
        <?php } ?>
        max-width: 460px;
        padding: 14px;
        /*background: #333;
        filter: alpha(opacity=60);
        -moz-opacity: 0.6;
             opacity: 0.6;*/
    }
    #headimg p {
        margin: 0;
    }
    #headimg .sitename,#headimg .desc {
        font-family: "ヒラギノ角ゴ ProN", "Hiragino Kaku Gothic ProN", "メイリオ", Meiryo, "ＭＳ Ｐゴシック", "MS PGothic", sans-serif !important;
    }
    #headimg .sitename {
        margin-bottom: 10px;
    }
    #headimg .sitename {
        font-size: 150%;
        font-weight: bold;
        color: #<?php header_textcolor(); ?>;
    }
    #headimg .desc {
        line-height: 1.2;
        font-size: 80%;
        font-weight: normal;
        color: #<?php header_textcolor(); ?>;
    }
</style>
<?php }

function admin_header_image() { ?>
    <div id="headimg">
        <div class="container">
            <div class="inner">
                <p class="sitename"><?php echo bloginfo('name'); ?></p>
                <p class="desc"><?php bloginfo('description'); ?></p>
            </div>
        </div>
    </div>
<?php } ?>