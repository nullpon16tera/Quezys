<?php get_header(); ?>

    <!-- エントリー開始 -->
    <div id="contents">
        <div class="entry-wrap search-archive">
    <?php
    global $wp_query;
    $total_results = $wp_query->found_posts;
    ?>
            <h2 class="archive-title" style="margin-bottom: 0;">【 <?php the_search_query(); ?> 】の検索結果</h2>
            <p style="margin: 6px 0 28px; padding-left: 32px;"><span style="color: #c43;"><?php echo $total_results; ?>件</span>が見つかりました。</p>
            <?php if(have_posts()) : while(have_posts()) : the_post(); ?>
<div class="entry-box">
    <div class="thumbs"><a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>">
        <?php if(has_post_thumbnail()) : ?>
        <?php
        $title = get_the_title();
        the_post_thumbnail(array(100,100),array('alt' =>$title, 'title' => $title));
        ?>
        <?php else: //no thumbnail ?>
        <img src="<?php echo get_template_directory_uri(); ?>/images/not-image.gif" width="100" alt="not image" title="not image">
        <?php endif; ?>
    </a></div>
    <div class="top-data">
        <h3 class="entry-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
        <?php get_template_part('entry', 'date'); ?>
        <div class="top-entry-post">
            <?php echo mb_substr(get_the_excerpt(), 0, 30); ?>
        </div>
    </div>
</div>
<?php endwhile; endif; ?>

            <?php if (function_exists("pagination")) {
                pagination($additional_loop->max_num_pages);
            } ?>
        </div><!-- /.entry-wrap -->

        <?php get_sidebar(); ?>
    </div><!-- /#contents -->

<?php get_footer(); ?>
