<div class="entry-post-data">
    <?php if(is_mobile()) {
        $font_size = ' fs16';
    } else {
        $font_size = ' fs14';
    } ?>
    <p>
        <time class="entry-time<?php echo $font_size; ?>" datetime="<?php echo get_post_time('c'); ?>"><?php echo get_post_time('Y/m/d'); ?></time>&nbsp;
        <?php if($mtime = get_mtime('Y.m.d')) { ?>
        <span class="entry-update-time<?php echo $font_size; ?>"><?php echo get_mtime('Y/m/d'); ?></span>&nbsp;
        <?php } ?>
        <?php
        $login_name = get_the_author_meta('user_login',$author->ID);
        $disp_name = get_the_author_meta('display_name',$author->ID);
        if($login_name !== $disp_name) { ?>
            <small class="entry-author<?php echo $font_size; ?>" itemprop="author"><?php echo $disp_name; ?></small>
        <?php } ?>
    </p>
    <?php if(!is_page()) { ?>
    <p itemprop="keywords">
        <span class="entry-cat<?php echo $font_size; ?>"><?php the_category(', '); ?></span>&nbsp;
        <span class="entry-tag<?php echo $font_size; ?>"><?php the_tags('', ', '); ?></span>
    </p>
    <?php } ?>
</div>
