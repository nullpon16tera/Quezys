<!-- サイドバー -->
<div id="sidebar">
    <?php
    if ( is_active_sidebar( 'ad' ) ) :
        dynamic_sidebar( 'ad' );
    endif;
    ?>
    <div class="feedly">
        <a href='http://cloud.feedly.com/#subscription/feed/<?php bloginfo('rss2_url'); ?>' target='blank'><img id='feedlyFollow' src='http://s3.feedly.com/img/follows/feedly-follow-rectangle-flat-big_2x.png' alt='follow us in feedly' width='131' height='56'></a>
    </div>
    <?php
    /*if(is_single()) {
        get_template_part('rearticle');
    }*/
    ?>
    <?php
    if ( is_active_sidebar( 'blog-widget' ) ) :
        dynamic_sidebar( 'blog-widget' );
    else : ?>
    <div class="widget">
        <h4 class="widgettitle">No Widget</h4>
        <p>ウィジットが設定されていません。</p>
    </div>
    <?php endif; ?>
</div><!-- /.sidebar -->
