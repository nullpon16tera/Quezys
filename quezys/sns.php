<?php if(!is_preview()) : ?>
<div class="sns-btn">
    <ul>
        <li>
            <a href="https://twitter.com/share" class="twitter-share-button" data-url="<?php the_permalink(); ?>" data-text="<?php the_title(); ?>" data-lang="ja" data-count="vertical">ツイート</a>
            <script>!function(d,s,id) { var js, fjs = d.getElementsByTagName(s)[0], p = /^http:/.test(d.location)?'http':'https'; if(!d.getElementById(id)) { js = d.createElement(s); js.id = id; js.src = p+'://platform.twitter.com/widgets.js'; fjs.parentNode.insertBefore(js,fjs); }}(document, 'script', 'twitter-wjs');</script>
        </li>
        <li>
            <iframe src="//www.facebook.com/plugins/like.php?href=<?php the_permalink(); ?>&amp;width=72&amp;layout=box_count&amp;action=like&amp;show_faces=false&amp;share=false&amp;height=65&amp;appId=408633299258016" scrolling="no" frameborder="0" style="border:none; overflow:hidden; width:72px; height:65px;" allowTransparency="true"></iframe>
        </li>
        <li>
            <a href="http://b.hatena.ne.jp/entry/<?php the_permalink(); ?>" class="hatena-bookmark-button" data-hatena-bookmark-title="<?php the_title(); ?>" data-hatena-bookmark-layout="vertical-balloon" data-hatena-bookmark-lang="ja" title="このエントリーをはてなブックマークに追加"><img src="http://b.st-hatena.com/images/entry-button/button-only@2x.png" alt="このエントリーをはてなブックマークに追加" width="20" height="20" style="border: none;" /></a>
            <script type="text/javascript" src="http://b.st-hatena.com/js/bookmark_button.js" charset="utf-8" async="async"></script>
        </li>
        <li>
            <div class="g-plusone" data-size="tall" data-href="<?php the_permalink(); ?>"></div>
            <script>window.___gcfg = {lang: 'ja'}; (function() { var po = document.createElement('script'); po.type = 'text/javascript'; po.async = true; po.src = 'https://apis.google.com/js/platform.js'; var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(po, s); })();</script>
        </li>
        <li>
            <a data-pocket-label="pocket" data-pocket-count="vertical" class="pocket-btn" data-lang="ja"></a>
            <script>!function(d,i) { if(!d.getElementById(i)) { var j = d.createElement("script"); j.id = i; j.src = "https://widgets.getpocket.com/v1/j/btn.js?v=1"; var w = d.getElementById(i); d.body.appendChild(j); }}(document,"pocket-btn-js");</script>
        </li>
    </ul>
</div>
<?php endif; ?>
