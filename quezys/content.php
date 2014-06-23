<?php if(have_posts()) : while(have_posts()) : the_post(); ?>
<article class="entry-box" itemscope itemtype="http://schema.org/BlogPosting">
    <div class="entry-data">
        <h1 class="entry-title" itemprop="name"><?php the_title(); ?></h1>
        <?php get_template_part('entry', 'date'); ?>
        <section class="entry-post" itemprop="articleBody">
            <?php the_content(); ?>
            <?php quezys_link_pages(); ?>
        </section>
        <?php
        if(is_mobile()) {
            get_template_part('sns', 'sp');
        }else{
            get_template_part('sns');
        } ?>
        <div class="adsense">
        <?php
        if ( is_active_sidebar( 'ad' ) ) :
            dynamic_sidebar( 'ad' );
        endif;
        ?></div>
    </div>

    <?php single_post_nav(); ?>
    
    <!-- 関連記事パート -->
    <?php get_template_part('rearticle'); ?>
    <!-- /関連記事パート -->

    <div class="adsense">
        <?php
        if ( is_active_sidebar( 'ad' ) ) :
            dynamic_sidebar( 'ad' );
        endif;
        ?></div>
    <?php single_post_nav(); ?>
</article>
<?php endwhile; else : ?>
<p>記事がありません</p>
<?php endif; ?>
