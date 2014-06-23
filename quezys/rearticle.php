<aside class="rearticle">
    <h3 class="kanren-title">関連記事</h3>
<?php
$categories = get_the_category($post->ID);
$category_ID = array();
foreach($categories as $category) :
    array_push($category_ID, $category->cat_ID);
endforeach;
$args = array(
    'post__not_in' => array($post->ID),
    'posts_per_page' => 6,
    'category__in' => $category_ID,
    'orderby' => 'rand'
);
$my_query = new WP_Query($args);
?>
<?php if($my_query->have_posts()) : ?>
    <?php while($my_query->have_posts()) : $my_query->the_post(); ?>
    <dl>
        <dt><a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>">
        <?php if(has_post_thumbnail()) : ?>
        <?php echo get_the_post_thumbnail($post->ID, 'thumb100'); ?>
        <?php else: //no thumbnail ?>
        <img src="<?php echo get_template_directory_uri(); ?>/images/not-image.gif" width="100" alt="not image" title="not image">
        <?php endif; ?></a></dt>
        <dd>
            <h4 class="re-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h4>
            <?php
            if(!is_mobile()) {
                get_template_part('entry', 'date');
            }
            ?>
        </dd>
    </dl>
    <?php endwhile; ?>
<?php else : ?>
    <p>entry not found.</p>
<?php
endif;
wp_reset_postdata();
?>
</aside>
