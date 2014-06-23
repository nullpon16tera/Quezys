<?php
//フィード取得
function quezys_feed_dashboard($quezys_url, $quezys_quantity) {
    //include_once ABSPATH . WPINC . '/feed.php';

    // URLがquezys.comか調べ、マッチすればそれ以下の処理を中断させる
    $get_urls = home_url();
    if(!strstr($get_urls, 'quezys.com')) {
        // 以下フィード読み込み（quezys.comでなければ処理する）
        $quezys_feed = fetch_feed($quezys_url);
        if(is_wp_error($quezys_feed)) {
            $maxitems = 0;
        }else{
            $maxitems = $quezys_feed->get_item_quantity($quezys_quantity);
            $items = $quezys_feed->get_items(0, $maxitems);
        }
        echo '<style type="text/css">';
        echo '#quezys-feed dl:after { content: ""; display: block; clear: both; }';
        echo '#quezys-feed dl dt { float: left; }';
        echo '#quezys-feed dl dd { margin-left: 88px; }';
        echo '</style>';
        if($maxitems) {
            echo '<div id="quezys-feed">';
            foreach($items as $item) {
                echo '<dl>';
                echo '<dt><span>'.$item->get_date("Y/m/d").'</span></dt>';
                echo '<dd><a href="'.$item->get_permalink().'" rel="nofollow" target="_blank">'.$item->get_title().'</a></dd>';
                echo '</dl>';
            }
            echo '</div>';
        }else{
            echo '<p>ニュースがありません。</p>';
        }
    }
}
?>
