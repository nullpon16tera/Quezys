<?php
if ( ! isset( $content_width ) ) $content_width = 586;

add_filter('login_errors',create_function('$a', "return null;"));

//テーマ情報
function quezys( $theme_stats ) {
    $theme = wp_get_themes();
    $quezys = $theme["quezys"];
    if( $theme_stats == 'version' ) {
        $str = $quezys->Version;
    }else if( $theme_stats == 'name' ) {
        $str = $quezys->Name;
    }else if( $theme_stats == 'theme_url' ) {
        $str = $quezys->ThemeURI;
    }else{
        $str = 'NULL';
    }
    return $str;
    //$update_themes = get_site_transient('update_themes');
    //$checked = $update_themes->checked;
    //return $checked["quezys"];
}

// 初期出力のタグを削除
remove_action('wp_head', 'wp_generator');
remove_action('wp_head', 'rsd_link');

//ロードスクリプト
function load_script(){
    wp_enqueue_script('jquery');
}
add_action('init', 'load_script');

// Javascript読み込み
if(!is_admin()){
    function register_script(){
        $gtdu = get_template_directory_uri();
        //wp_deregister_script('jquery');
        //wp_register_script('jquery', 'http://ajax.googleapis.com/ajax/libs/jquery/1.10.1/jquery.min.js');
        wp_register_script('excore', $gtdu.'/js/ex.core.js');
        wp_register_script('explugins', $gtdu.'/js/ex.plugins.js');
        wp_register_script('exfunction', $gtdu.'/js/ex.function.js');
    }
    function add_script(){
        register_script();
        //wp_enqueue_script(array('jquery', 'excore'));
        wp_enqueue_script(array('excore', 'explugins', 'exfunction'));
    }
    add_action('wp_print_scripts','add_script',10);
}

// ?author= to redirect 404
function author_query_redirect() {
    if($_GET['author'] !== null) {
        wp_redirect( home_url('/404') );
        exit;
    }
}
add_action('init', 'author_query_redirect');

// base_url : /author/username to /users/
function change_author_base() {
    global $wp_rewrite;
    $author_slug = 'users';
    //$author_ids = 'user-'.get_the_author_meta('ID',$author->ID);
    $wp_rewrite->author_base = $author_slug;
    //$wp_rewrite->author_structure = $author_ids;
    $wp_rewrite->flush_rules();
}
add_action( 'init', 'change_author_base');

// META link
function quezys_meta_link() {
    echo '<li><a href="http://quezys.com/" title="Wordpress themes for QUEZYS" rel="nofollow">QUEZYS themes</a></li>';
}
add_action('wp_meta', 'quezys_meta_link');

//ピンバック禁止
function self_pinback(&$links) {
    $home = home_url();
    foreach($links as $l => $link) {
        if(0 === strpos($link, $home)) {
            unset($links[$l]);
        }
    }
}
add_action('pre_ping', 'self_pinback');

//アイキャッチ
add_theme_support('post-thumbnails');
add_image_size('thumb100', 100, 100, true);
add_image_size('thumb120', 120, 120, true);

//カスタムヘッダー
$temp_uri = get_template_directory_uri();
$temp_path = $temp_uri . '/images/header-visual.jpg';
$defaults = array(
    'default-image'     => $temp_path,
    'random-defa'        => false,
    'width'             => 1148,
    'height'            => 320,
    'flex-height'        => true,
    'flex-width'        => true,
    'default-text-color'=> 'f9fff8',
    'header-text'       => true,
    'uploads'           => true,
    //'wp-head-callback'  => '',
    'admin-head-callback' => 'admin_header_style',
    'admin-preview-callback' => 'admin_header_image'
);
add_theme_support( 'custom-header', $defaults );
include_once (TEMPLATEPATH . '/_inc/custom-header-style.php');

//カスタム背景
$bg_args = array(
    'default-color' => 'f0f0f0',
    'default-image' => '',
    //'wp-head-callback' => '',
    //'admin-head-callback' => '',
    //'admin-preview-callback' => ''
);
add_theme_support('custom-background', $bg_args);

//RSS
add_theme_support('automatic-feed-links');

//画像に重ねる文字の色
define('HEADER_TEXTCOLOR', '');

//画像に重ねる文字を非表示にする
define('NO_HEADER_TEXT',true);

//カスタムメニュー
add_theme_support('menus');
register_nav_menus(array('navimenu' => 'ナビゲーションメニュー'));
add_filter('nav_menu_css_class', 'css_attr_filter', 100, 1);
add_filter('nav_menu_item_id', 'css_attr_filter', 100, 1);
add_filter('page_css_class', 'css_attr_filter', 100, 1);
function css_attr_filter($var) {
    return is_array($var) ? array_intersect($var, array('current-menu-item')) : '';
}

//ナビゲーション
function main_navi() {
    if(is_home()) {
        echo '<li class="current-menu-item"><a href="'.home_url().'">ホーム</a></li>';
    } else {
        echo '<li><a href="'.home_url().'">ホーム</a></li>';
    }
    $args = array(
        'theme_location' => 'navimenu',
        'container' => false,
        'items_wrap' => '%3$s'
    );
    wp_nav_menu($args);
}
function sp_navi() {
    $args = array(
        'theme_location' => 'navimenu',
        'container' => false,
        'items_wrap' => '%3$s'
    );
    wp_nav_menu($args);
}

//ウィジェット
/* サイドバー */
register_sidebar( array(
    'name' => 'サイドバー',
    'id' => 'blog-widget',
    'description' => 'サイドバーのウィジェットをここに設定します。',
    'before_widget' => '<div id="%1$s" class="widget %2$s">',
    'after_widget' => '</div>',
    'before_title' => '<h4 class="menu_name">',
    'after_title' => '</h4>'
));
/* Google Analytics widget */
register_sidebar( array(
    'name' => 'Google Analytics',
    'id' => 'ga',
    'description' => 'Google Analyticsのコードをここに設定します。',
    'before_widget' => '',
    'after_widget' => '',
));

/* Google AdSense */
register_sidebar( array(
    'name' => 'Google AdSense',
    'id' => 'ad',
    'description' => 'Google AdSenseのコードをここに設定します。推奨の横幅250以下',
    'before_widget' => '',
    'after_widget' => '',
));

//更新日
function get_mtime($format) {
    $mtime = get_the_modified_time('Ymd');
    $ptime = get_the_time('Ymd');
    if($ptime >= $mtime) {
        return null;
    }else{
        return get_the_modified_time($format);
    }
}

//moreリンク
function content_more_links($output) {
    $output = preg_replace('/#more-[\d]+/i', '', $output);
    return $output;
}

//ページネーション
function pagination($pages = '', $range = 2) {
    $showitems = ($range * 2)+1;
    global $paged;
    if(empty($paged)) $paged = 1;
    if($pages == '') {
        global $wp_query;
        $pages = $wp_query->max_num_pages;
        if(!$pages) {
            $pages = 1;
        }
    }
    if(1 != $pages) {
        echo "<div class=\"pagination\"><span>Page ".$paged." of ".$pages."</span>";
        if($paged > 2 && $paged > $range+1 && $showitems < $pages) echo "<a href=\"".get_pagenum_link(1)."\">&laquo;</a>";
        if($paged > 1 && $showitems < $pages) echo "<a href=\"".get_pagenum_link($paged - 1)."\">&lsaquo;</a>";
        for ($i=1; $i <= $pages; $i++) {
            if (1 != $pages &&( !($i >= $paged+$range+1 || $i <= $paged-$range-1) || $pages <= $showitems )) {
                echo ($paged == $i)? "<span class=\"current\">".$i."</span>":"<a href=\"".get_pagenum_link($i)."\" class=\"inactive\" >".$i."</a>";
            }
        }
        if ($paged < $pages && $showitems < $pages) echo "<a href=\"".get_pagenum_link($paged + 1)."\">&rsaquo;</a>";
        if ($paged < $pages-1 &&  $paged+$range-1 < $pages && $showitems < $pages) echo "<a href=\"".get_pagenum_link($pages)."\">&raquo;</a>";
        echo "</div>\n";
    }
}

// コメントフォーム
// URLへのリンクを設定しない
remove_filter( 'comment_text', 'make_clickable', 9);

// ページング
/* シングル用 */
function single_post_nav() { ?>
    <div id="postnation">
        <?php if(get_next_post()) : ?>
        <span class="next"><?php next_post_link('%link', '%title', false); ?></span>
        <?php endif; ?>
        <?php if(get_previous_post()) : ?>
        <span class="prev"><?php previous_post_link('%link', '%title', false); ?></span>
        <?php endif; ?>
    </div><!-- / #page-nation -->
    <?php
}

/* wp_link_pages() */
function quezys_link_pages() {
    $args = array(
        'before' => '<div id="link-pager"><span class="pages">ページ</span>',
        'after' => '</div>',
        'link_before' => '<span>',
        'link_after' => '</span>',
        'next_or_number' => 'number',
        'nextpagelink' => __('Next page'),
        'previouspagelink' => __('Previous page'),
        'pagelink' => '%',
        'more_file' => '',
        'echo' => 1
    );
    wp_link_pages($args);
}

// the_excerpt()
function new_excerpt_more($more) {
    return ' ...';
}
add_filter('excerpt_more', 'new_excerpt_more');

//スマホ表示分岐
function is_mobile(){
    $useragents = array(
        'iPhone', // iPhone
        'iPod', // iPod touch
        'Android.*Mobile', // 1.5+ Android *** Only mobile
        'Windows.*Phone', // *** Windows Phone
        'dream', // Pre 1.5 Android
        'CUPCAKE', // 1.5+ Android
        'blackberry9500', // Storm
        'blackberry9530', // Storm
        'blackberry9520', // Storm v2
        'blackberry9550', // Storm v2
        'blackberry9800', // Torch
        'webOS', // Palm Pre Experimental
        'incognito', // Other iPhone browser
        'webmate' // Other iPhone browser
    );
    $pattern = '/'.implode('|', $useragents).'/i';
    return preg_match($pattern, $_SERVER['HTTP_USER_AGENT']);
}

//カスタムエディター
include_once (TEMPLATEPATH . '/_inc/custom-editor.php');

//カスタムフィールド
include_once (TEMPLATEPATH . '/_inc/custom-field.php');

//QUEZYS ニュースフィード
include_once (TEMPLATEPATH . '/_inc/dashboard-rss.php');

// ダッシュボード表示用RSS取得
function quezys_dashboard_content() {
    quezys_feed_dashboard('http://quezys.com/category/news/feed', 5);
}
//ダッシュボードにウィジェット追加
function quezys_dashboard_widget() {
    wp_add_dashboard_widget('quezys_news_widget', 'QUEZYS ニュース', 'quezys_dashboard_content');
}
add_action('wp_dashboard_setup', 'quezys_dashboard_widget');

//WP3.8以上よりソートが有効になります。
//ダッシュボード　左側ソート
function normal_dashboard_sort() {
    global $wp_meta_boxes;
    $normal_dashboard = $wp_meta_boxes['dashboard']['normal']['core'];
    $quezys_normal_backup = array(
        $normal_dashboard['dashboard_right_now'],
        $normal_dashboard['dashboard_activity']
    );
    unset($quezys_normal_backup[0],$quezys_normal_backup[1]);
    $sorted_dashboard = array_merge($quezys_normal_backup, $normal_dashboard);
    $wp_meta_boxes['dashboard']['normal']['core'] = $sorted_dashboard;
}
add_action('wp_dashboard_setup', 'normal_dashboard_sort');

//ダッシュボード右側ソート
function side_dashboard_sort() {
    global $wp_meta_boxes;
    $side_dashboard = $wp_meta_boxes['dashboard']['side']['core'];
    $quezys_side_backup = array(
        $side_dashboard['dashboard_quick_press'],
        $side_dashboard['quezys_dashboard_widget'],
        $side_dashboard['dashboard_primary']
    );
    unset($quezys_side_backup[0],$quezys_side_backup[1],$quezys_side_backup[2]);
    $sorted_dashboard = array_merge($quezys_side_backup, $side_dashboard);
    $wp_meta_boxes['dashboard']['side']['core'] = $sorted_dashboard;
}
add_action('wp_dashboard_setup', 'side_dashboard_sort');
?>
