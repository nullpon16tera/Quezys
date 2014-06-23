<div class="pankuzu">
    <div class="container">
        <?php if(!is_home()) : ?>
        <div class="bread-list">
            <ul itemprop="breadcrumb">
                <li itemscope itemtype="http://data-vocabulary.org/Breadcrumb"><a href="<?php echo home_url(); ?>" itemprop="url"><span itemprop="title">ホーム</span></a></li>
                <li>&gt;</li>
                <?php if(is_search()) : /* 検索結果表示 */ ?>
                <li itemscope itemtype="http://data-vocabulary.org/Breadcrumb"><span itemprop="title">【 <?php the_search_query(); ?> 】の検索結果</span></li>
                <?php elseif(is_tag()) : /* タグアーカイブ */ ?>
                <li itemscope itemtype="http://data-vocabulary.org/Breadcrumb">TAG: <span itemprop="title"><?php single_tag_title(); ?></span></li>
                <?php elseif(is_404()) : /* 404 Not Found */ ?>
                <li><span>404 Not Found!</span></li>
                <?php elseif(is_date()) : /* 日付アーカイブ */ ?>
                    <?php if(is_day()) : /* 日別 */?>
                    <li itemscope itemtype="http://data-vocabulary.org/Breadcrumb"><a href="<?php echo get_year_link(get_query_var('year')); ?>" itemprop="url"><span itemprop="title"><?php echo get_query_var('year'); ?>年</span></a></li>
                    <li>&gt;</li>
                    <li itemscope itemtype="http://data-vocabulary.org/Breadcrumb"><a href="<?php echo get_month_link(get_query_var('year'), get_query_var('monthnum')); ?>" itemprop="url"><span itemprop="title"><?php echo get_query_var('monthnum'); ?>月</span></a></li>
                    <li>&gt;</li>
                    <li itemscope itemtype="http://data-vocabulary.org/Breadcrumb"><span itemprop="title"><?php echo get_query_var('day'); ?>日</span></li>
                    <?php elseif(is_month()) : /* 月別 */ ?>
                    <li itemscope itemtype="http://data-vocabulary.org/Breadcrumb"><a href="<?php echo get_year_link(get_query_var('year')); ?>" itemprop="url"><span itemprop="title"><?php echo get_query_var('year'); ?>年</span></a></li>
                    <li>&gt;</li>
                    <li itemscope itemtype="http://data-vocabulary.org/Breadcrumb"><span itemprop="title"><?php echo get_query_var('monthnum'); ?>月</span></li>
                    <?php elseif(is_year()) : /* 年別 */ ?>
                    <li itemscope itemtype="http://data-vocabulary.org/Breadcrumb"><span itemprop="title"><?php echo get_query_var('year'); ?>年</span></li>
                    <?php endif; ?>
                <?php elseif(is_category()) : /* カテゴリーアーカイブ */ ?>
                    <?php $cat = get_queried_object(); ?>
                    <?php if($cat -> parent != 0): ?>
                        <?php $ancestors = array_reverse(get_ancestors( $cat -> cat_ID, 'category' )); ?>
                        <?php foreach($ancestors as $ancestor) : ?>
                        <li itemscope itemtype="http://data-vocabulary.org/Breadcrumb"><a href="<?php echo get_category_link($ancestor); ?>" itemprop="url"><span itemprop="title"><?php echo get_cat_name($ancestor); ?></span></a></li>
                        <li>&gt;</li>
                        <?php endforeach; ?>
                    <?php endif; ?>
                    <li><?php echo $cat -> cat_name; ?></li>
                <?php elseif(is_author()) : /* 投稿者アーカイブ */ ?>
                    <li itemscope itemtype="http://data-vocabulary.org/Breadcrumb"><span itemprop="title"><?php the_author_meta('display_name', get_query_var('author')); ?></span></li>
                <?php elseif(is_page()) : /* 固定ページ */ ?>
                    <?php if($post -> post_parent != 0) : ?>
                    <?php $ancestors = array_reverse($post-> ancestors); ?>
                    <?php foreach($ancestors as $ancestor) : ?>
                    <li itemscope itemtype="http://data-vocabulary.org/Breadcrumb"><a href="<?php echo get_permalink($ancestor); ?>" itemprop="url"><span itemprop="title"><?php echo get_the_title($ancestor); ?></span></a></li>
                    <li>&gt;</li>
                    <?php endforeach; ?>
                    <?php endif; ?>
                    
                <?php elseif(is_attachment()) : /* 添付ファイルページ */ ?>
                    <?php if($post -> post_parent != 0) : ?>
                        <li itemscope itemtype="http://data-vocabulary.org/Breadcrumb"><a href="<?php echo get_permalink($post -> post_parent); ?>" itemprop="url"><span itemprop="title"><?php echo get_the_title($post -> post_parent); ?></span></a></li>
                        <li>&gt;</li>
                    <?php endif; ?>
                    
                <?php elseif(is_single()) : /* ブログ記事 */ ?>
                    <?php $categories = get_the_category($post->ID); ?>
                    <?php $cat = $categories[0]; ?>
                    <?php if($cat -> parent != 0) : ?>
                    <?php $ancestors = array_reverse(get_ancestors($cat -> cat_ID, 'category')); ?>
                    <?php foreach($ancestors as $ancestor) : ?>
                    <li itemscope itemtype="http://data-vocabulary.org/Breadcrumb"><a href="<?php echo get_category_link($ancestor); ?>" itemprop="url"><span itemprop="title"><?php echo get_cat_name($ancestor); ?></span></a></li>
                    <li>&gt;</li>
                    <?php endforeach ?>
                    <?php endif; ?>
                    <li itemscope itemtype="http://data-vocabulary.org/Breadcrumb"><a href="<?php echo get_category_link($cat -> cat_ID); ?>" itemprop="url"><span itemprop="title"><?php echo $cat-> cat_name; ?></span></a></li>
                    <li>&gt;</li>
                    
                <?php else : /* 上記以外 */ ?>
                    <li itemscope itemtype="http://data-vocabulary.org/Breadcrumb"><span itemprop="title"><?php wp_title('', true); ?></span></li>
                <?php endif; ?>
            </ul>
        </div>
        <?php endif; ?>
    </div>
</div>
