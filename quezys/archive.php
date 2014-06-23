<?php get_header(); ?>

    <!-- エントリー開始 -->
    <div id="contents">
        <div class="entry-wrap">
            <h2 class="archive-title">【<?php
            if(is_category()) {
                single_cat_title();
            }elseif(is_tag()) {
                single_tag_title();
            }elseif(is_tax()) {
                single_term_title();
            }elseif(is_day()) {
                echo '日別アーカイブ：'.get_the_time('Y年m月d日');
            }elseif(is_month()) {
                echo '月別アーカイブ：'.get_the_time('Y年m月');
            }elseif(is_year()) {
                echo '年別アーカイブ：'.get_the_time('Y年');
            }elseif(is_author()) {

            }elseif(isset($_GET['paged']) && !empty($_GET['paged'])) {
                echo '記事アーカイブ';
            }
            ?>】の一覧</h2>
            <?php get_template_part( 'index', 'loop' ); ?>

            <?php if (function_exists("pagination")) {
                pagination($additional_loop->max_num_pages);
            } ?>
        </div><!-- /.entry-wrap -->

        <?php get_sidebar(); ?>
    </div><!-- /#contents -->

<?php get_footer(); ?>
