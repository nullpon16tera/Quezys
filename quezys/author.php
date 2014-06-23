<?php get_header(); ?>
<div class="pankuzu">
    <div class="container">
        <div class="bread-list">
            <ul>
                <li itemscope itemtype="http://data-vocabulary.org/Breadcrumb"><a href="http://wordpress.local" itemprop="url"><span itemprop="title">ホーム</span></a></li>
                <li>&gt;</li>
                <li><span>404 Not Found!</span></li>
            </ul>
        </div>
    </div>
</div>
<link href="<?php echo get_template_directory_uri(); ?>/css/404.css" rel="stylesheet">
    <!-- エントリー開始 -->
    <div id="contents">
        <div class="entry-wrap">
            <?php get_template_part( '404' ); ?>
        </div><!-- /.entry-wrap -->
    </div><!-- /#contents -->

<?php get_footer(); ?>
