<?php if(have_posts()) : while(have_posts()) : the_post(); ?>
<article class="entry-box">
    <div class="entry-data">
        <h1 class="entry-title"><?php the_title(); ?></h1>
        <?php get_template_part('entry', 'date'); ?>
        <section class="entry-post">
            <?php the_content(); ?>
            <?php wp_link_pages(); ?>
        </section>
    </div>
</article>
<?php endwhile; else : ?>
<p>ページがありません</p>
<?php endif; ?>
