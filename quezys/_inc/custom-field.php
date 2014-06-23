<?php
//カスタムフィールド「サイト説明」を追加
function add_post_meta_box() {
    add_meta_box('site_descreption', 'ページ説明', 'site_desc_form', 'post', 'normal', 'high');
    add_meta_box('site_descreption', 'ページ説明', 'site_desc_form', 'page', 'normal', 'high');
}
add_action('add_meta_boxes', 'add_post_meta_box');

function site_desc_form() {
    global $post;
    wp_nonce_field(wp_create_nonce(__FILE__), 'my_nonce');
?>
    <div id="site_descreption">
        <p>ページの説明を入力します。このフィールドの内容は&lt;meta name="description"&gt;で使用されます。<br>※未入力の場合は、設定されませんので、ご注意ください。</p>
        <p>
            <label>ページ説明（任意）：<br>
            <input type="text" name="pagedesc" value="<?php echo esc_html(get_post_meta($post->ID, 'pagedesc', true)); ?>" style="width: 100%;"></label>
        </p>
    </div>
<?php }

function site_desc_save($post_id) {
    global $post;
    $my_nonce = isset($_POST['my_nonce']) ? $_POST['my_nonce'] : null;
    if(!wp_verify_nonce($my_nonce, wp_create_nonce(__FILE__))) {
        return $post_id;
    }
    if(defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) { return $post_id; }
    if(!current_user_can('edit_post', $post->ID)) { return $post_id; }
    if($_POST['post_type'] == 'post' || $_POST['post_type'] == 'page') {
        update_post_meta($post->ID, 'pagedesc', $_POST['pagedesc']);
    }
}
add_action('save_post', 'site_desc_save');
?>
