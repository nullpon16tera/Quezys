<!doctype html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo('charset'); ?>" />
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
<?php if(is_category()) : ?>
<?php elseif(is_archive()): ?>
<meta name="robots" content="noindex" />
<?php elseif(is_tag()) : ?>
<meta name="robots" content="noindex" />
<?php elseif(is_404()) : ?>
<meta name="robots" content="noindex" />
<?php endif; ?>
<title><?php
global $page, $paged;
if(is_front_page()):
bloginfo('name');
elseif(is_single()):
wp_title('');
elseif(is_page()):
wp_title('');
elseif(is_archive()):
wp_title('|',true,'right');
bloginfo('name');
elseif(is_search()):
wp_title('-',true,'right');
elseif(is_404()):
echo'404 - ';
bloginfo('name');
endif;
if($paged >= 2 || $page >= 2):
echo'-'.sprintf('%sページ',
max($paged,$page));
endif;
?></title>
<?php
$description = esc_html(get_post_meta($post->ID, 'pagedesc', true));
$categories = get_the_category($post->ID);
$cats = $categories[0];
$output = '';
if(is_front_page()) : ?>
<meta name="date" content="<?php the_time('c'); ?>" />
<meta name="description" content="<?php bloginfo('description'); ?>" />
<?php
elseif(is_page()) :
    if($description !== null || $description != "") { ?>
<meta name="description" content="<?php echo $description; ?>" />
<?php
    $login_name = get_the_author_meta('user_login',$author->ID);
    $disp_name = get_the_author_meta('display_name',$author->ID);

    if($login_name !== $disp_name) { ?>
<meta name="author" content="<?php echo $disp_name; ?>">
<?php } ?>
<?php } //  ?>
<meta name="date" content="<?php the_time('c'); ?>" />
<?php
elseif(is_single()) :
    if($categories) {
        foreach($categories as $category) {
            $output .= $category->cat_name.',';
        }
    }
    $cat_out = $cats->cat_name.' &gt; ';
    if($cats->parent != 0) {
        $ancestors = array_reverse(get_ancestors($cats->cat_ID, 'category'));
        foreach($ancestors as $ancestor) {
            $cat_out = get_cat_name($ancestor).' &gt; ';
        }
    }
    if($description != null || $description != "") { ?>
<meta name="description" content="<?php echo $cat_out; ?><?php echo $description; ?>" />
<?php } ?>
<meta name="keywords" content="<?php echo rtrim($output, ','); ?>" />
<meta name="classification" content="<?php echo rtrim($output, ','); ?>" />
<meta name="date" content="<?php the_time('c'); ?>" />
<?php
    $users = get_users($post->ID);
    $user_id = $users[0]->ID;
    $user_names = get_the_author_meta('display_name',$user_id);
    $user_logins = get_the_author_meta('user_login',$user_id);
    if($user_names !== $user_logins) { ?>
<meta name="author" content="<?php echo $user_names; ?>">
<?php } ?>
<?php endif; ?>
<?php //ビューポート
if(is_mobile()) : ?>
<meta name="viewport" content="width=device-width, initial-scale=1.0,minimum-scale=1.0">
<meta name="format-detection" content="telephone=no">
<?php endif; ?>
<link href='//fonts.googleapis.com/css?family=Muli' rel='stylesheet' type='text/css'>
<link href="<?php echo get_template_directory_uri(); ?>/css/default.css" rel="stylesheet">
<?php if(is_mobile()) : ?>
<link href="<?php echo get_template_directory_uri(); ?>/sp.css" rel="stylesheet">
<?php else : ?>
<link href="<?php bloginfo('stylesheet_url'); ?>" rel="stylesheet">
<?php endif; ?>
<?php if(is_404()) : ?>
<link href="<?php echo get_template_directory_uri(); ?>/css/404.css" rel="stylesheet">
<?php endif; ?>
<link rel="shortcut icon" href="<?php echo get_template_directory_uri(); ?>/favicon.ico" type="image/vnd.microsoft.icon">
<link rel="apple-touch-icon" href="<?php echo get_template_directory_uri(); ?>/images/apple-touch-icon.png">
<link rel="alternate" type="application/rss+xml" title="<?php bloginfo('name'); ?> RSS Feed" href="<?php bloginfo('rss2_url'); ?>" />
<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />
<!--[if lt IE 9]><script src="<?php echo get_template_directory_uri(); ?>/js/html5shiv.js"></script><![endif]-->

<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php if(!is_mobile()) { $bgcolor = ' style="background-color: #'.get_background_color().';"'; } ?>
<div id="wrap"<?php echo $bgcolor; ?>>
    <header id="header">
<?php
if(get_header_textcolor()) {
    $txt_color = ' style="color: #'.get_header_textcolor().';"';
} ?>
    <?php if(is_mobile()) : ?>
        <div class="container">
            <p class="sitename"><a href="<?php echo home_url(); ?>"<?php echo $txt_color; ?>><?php bloginfo('name'); ?></a></p>
            <?php if(is_home()) { ?>
            <h1 class="desc"<?php echo $txt_color; ?>><?php bloginfo('description'); ?></h1>
            <?php }else{ ?>
            <p class="desc"<?php echo $txt_color; ?>><?php bloginfo('description'); ?></p>
            <?php } ?>
        </div>
    <?php else : ?>
        <?php if(get_header_image()) { ?>
        <div class="container" style="background-image: url(<?php header_image(); ?>);">
        <?php }else{ ?>
        <div class="container">
        <?php } ?>
        <?php if(!display_header_text()) {
            $display_txt = ' style="display: none"';
        } ?>
            <div class="inner"<?php echo $display_txt; ?>>
                
                <p class="sitename"><a href="<?php echo home_url(); ?>"<?php echo $txt_color; ?>><?php bloginfo('name'); ?></a></p>
                <?php if(is_home()) { ?>
                <h1 class="desc"<?php echo $txt_color; ?>><?php bloginfo('description'); ?></h1>
                <?php }else{ ?>
                <p class="desc"<?php echo $txt_color; ?>><?php bloginfo('description'); ?></p>
                <?php } ?>
            </div>
        </div>
    <?php endif; ?>
    </header><!-- /#header -->
    
    <?php if(is_mobile()) : ?>
    <!-- スマホナビ -->
    <div class="sp-navi-btn">
        <button id="sp-btn" data-menu="#sp-menu" class="btn">
            <span class="line"></span>
            <span class="line"></span>
            <span class="line"></span>
        </button>
        <div class="btn-text">
            <a href="<?php echo home_url(); ?>">HOME</a>
            <span>Navi</span>
        </div>
        <nav id="sp-menu" class="sp-navi">
            <ul><?php sp_navi(); ?></ul>
        </nav>
    </div>
    
    <?php else : ?>
    <!-- メインナビ -->
    <nav class="mainnavi">
        <div class="container">
            <ul><?php main_navi(); ?></ul>
        </div>
    </nav><!-- /.mainnavi -->
    <?php endif; ?>
    <?php
    if(!is_author()) {
        get_template_part( 'bread', 'list' );
    }
    ?>
