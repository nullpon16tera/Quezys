<?php if(have_posts()) : while(have_posts()) : the_post(); ?>
<article class="entry-box">
    <div class="thumbs"><a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>">
        <?php if(has_post_thumbnail()) : ?>
        <?php
        $title = get_the_title();
        the_post_thumbnail(array(150,150),array('alt' =>$title, 'title' => $title));
        ?>
        <?php else: //no thumbnail ?>
        <img src="<?php echo get_template_directory_uri(); ?>/images/not-image.gif" width="100" alt="not image" title="not image">
        <?php endif; ?>
    </a></div>
    <div class="top-data">
        <h3 class="entry-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
        <div>
            <span class="like_count"><?php echo get_sns_count(sns_api('facebook'), get_the_permalink()); ?> likes</span>
            <span class="tweet_count"><?php echo get_sns_count(sns_api('twitter'), get_the_permalink()); ?> tweets</span>
            <span class="hatena_count"><?php echo get_sns_count(sns_api('hatena'), get_the_permalink()); ?> users</span>
        </div>
        <?php if(!is_mobile()) : ?>
        <?php get_template_part('entry', 'date'); ?>
        <div class="top-entry-post">
            <?php echo mb_substr(get_the_excerpt(), 0, 160); ?>
        </div>
        <?php endif; ?>
    </div>
    <?php if(is_mobile()) : ?>
    <?php get_template_part('entry', 'date'); ?>
    <?php endif;?>
</article>
<?php endwhile; endif; ?>
