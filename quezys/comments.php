<div id="comments">
    <?php if(have_comments()) : ?>
    <h3 class="comment-respons">Comment</h3>
    <ol class="comments-list">
    <?php wp_list_comments('avatar_size=32'); ?>
    </ol>
    <?php
    endif;

    $args=array('title_reply' => 'Message',
        'lavel_submit' => ('Submit Comment')
    );
    comment_form($args);
    ?>
</div><!-- /#comments -->
