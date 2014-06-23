<?php
/*
    TinyMCE custmize editor
*/
//カスタムエディターCSS
add_editor_style('editor-style.css');
function mce_editor_style($init){
    $init['body_class'] = 'editor-area';
    $init['extended_valid_elements'] = "iframe[id|class|title|style|align|frameborder|height|longdesc|marginheight|marginwidth|name|scrolling|src|width]";
    return $init;
}
add_filter('tiny_mce_before_init', 'mce_editor_style');

//エディターボタン1
function tinymce1_btn_edit($buttons) {
    $buttons = array($buttons, 'fontsizeselect', 'bold', 'italic', 'strikethrough', 'underline', 'bullist', 'numlist', 'blockquote', 'hr', 'alignleft', 'aligncenter', 'alignright', 'wp_more', 'wp_page', 'spellchecker', 'fullscreen', 'wp_adv');
    return $buttons;
}
add_filter('mce_buttons', 'tinymce1_btn_edit');

//エディターボタン2
function tinymce2_btn_edit($buttons){
    $buttons = array($buttons, 'fontselect', 'forecolor', 'backcolor', 'copy', 'cut', 'paste', 'pastetext', 'outdent', 'indent', 'removeformat', 'charmap', 'undo', 'redo', 'wp_help');
    return $buttons;
}
add_filter('mce_buttons_2', 'tinymce2_btn_edit');

//エディターボタン3
function tinymce3_btn_edit($buttons) {
    $buttons = array($buttons, 'formatselect', 'link', 'unlink', 'media');
    return $buttons;
}
add_filter('mce_buttons_3', 'tinymce3_btn_edit');

//フォーマット変更
function customize_tinymce_settings($init) {
    global $wp_version;
    if(version_compare($wp_version, '3.9', '>=')) {
        //フォーマット
        if(get_bloginfo('language') == "ja") {
            // language japanese setting
            $init['block_formats'] = 'Paragraph=p; Address=address; Pre=pre; Code=code; 見出し2=h2; 見出し3=h3; 見出し4=h4; 見出し5=h5; 見出し6=h6';
        }else{
            // language other setting
            $init['block_formats'] = 'Paragraph=p; Address=address; Pre=pre; Code=code; Heading 2=h2; Heading 3=h3; Heading 4=h4; Heading 5=h5; Heading 6=h6';
        }
        //フォントサイズ
        $init['fontsize_formats'] = '8pt 10pt 12pt 14pt 16pt 18pt 20pt 22pt 24pt 26pt 28pt 30pt 32pt 34pt 36pt 38pt 40pt 42pt 44pt 46pt 48pt';
    }else{
        //フォーマット
        $init['theme_advanced_blockformats'] = 'p,address,pre,code,h2,h3,h4,h5,h6';
        $init['theme_advanced_font_sizes'] = '8pt,10pt,12pt,14pt,16pt,18pt,20pt,22pt,24pt,26pt,28pt,30pt,32pt,34pt,36pt,38pt,40pt,42pt,44pt,46pt,48pt';
    }
    return $init;
}
add_filter('tiny_mce_before_init', 'customize_tinymce_settings');

//エディターボタン非表示
/*function tinymce2_btn_del($buttons) {
    $buttons = array_diff($buttons, array('alignjustify', 'pastetext', 'wp_help'));
    return $buttons;
}
add_filter('mce_buttons_2', 'tinymce2_btn_del');*/

// HTMLエディターにnextpageボタン追加
function add_quicktag_buttons() {
    echo <<< EOF
    <script type="text/javascript">
    edButtons[121] = new edButton('nextpage', 'nextpage', '<!--nextpage-->', '', 'n');
    </script>
EOF;
}
add_action('admin_print_footer_scripts', 'add_quicktag_buttons');

?>
