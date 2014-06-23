<?php get_header(); ?>

    <!-- エントリー開始 -->
    <div id="contents">
        <div class="entry-wrap">
            <?php get_template_part('content'); ?>

            <?php comments_template(); ?>
        </div><!-- /.entry-wrap -->

        <?php get_sidebar(); ?>
    </div><!-- /#contents -->

<?php get_footer(); ?>
