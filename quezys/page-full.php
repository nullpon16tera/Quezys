<?php
/*
Template Name:PAGE FullWidth
*/
?>
<?php get_header(); ?>

    <!-- エントリー開始 -->
    <div id="contents">
        <div class="page-wrap">
            <?php get_template_part('page', 'content'); ?>
        </div><!-- /.page-wrap -->

        <?php if(!is_mobile()) : ?>
        <div class="index-sns">
        <?php get_template_part( 'sns', 'index' ); ?>
        </div>
        <?php endif; ?>
    </div><!-- /#contents -->

<?php get_footer(); ?>
