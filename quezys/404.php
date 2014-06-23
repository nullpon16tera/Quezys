<?php get_header(); ?>

    <!-- エントリー開始 -->
    <div id="error">
        <div class="error-wrap">
            <?php if(get_bloginfo('language') == "ja") : ?>
            <h2>404 Not Found!</h2>
            <p>探してるページが見つけられなかったよ(´・ω・｀)</p>
            <?php else : ?>
            <h2>404 Not Found!</h2>
            <p>404 Error! There was no article.(-_-`)</p>
            <?php endif; ?>
            <div class="box s40 a1"></div>
            <div class="box s60 a2"></div>
            <div class="box s20 a3"></div>
            <div class="box s20 a4"></div>
            <div class="box s40 a5"></div>
            <div class="box s80 a6"></div>
            <div class="box s100 a7"></div>
            <div class="box s40 a8"></div>
            <div class="box s60 a9"></div>
            <div class="box s80 a10"></div>
            <div class="box s20 a11"></div>
            <div class="box s60 a12"></div>
        </div><!-- /.error-wrap -->
    </div><!-- /#error -->

<?php get_footer(); ?>
