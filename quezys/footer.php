    <div id="pagetop">
        <div class="container">
            <a href="#wrap" id="top-btn">TOP</a>
        </div>
    </div>
    <!-- フッター -->
    <footer id="footer">
        <div class="container">
            <div class="inner">
                <!-- 著作権表示 -->
                <p class="copy"><small>Copyright&copy; <?php the_date('Y'); ?> <?php bloginfo('name'); ?><?php if(is_mobile()) echo '<br>'; ?> All Rights Reserved.</small></p>
                <p class="quezys"><a href="http://quezys.com/" rel="nofollow">WordPress Themes <?php echo quezys('name'); ?> <?php echo quezys('version'); ?></a></p>
            </div>
        </div>
    </footer><!-- /#footer -->
</div><!-- /#wrap -->

<!-- Google Analytics Code -->
<?php if (is_active_sidebar( 'ga' )) : dynamic_sidebar( 'ga' ); endif; ?>
<!-- /Google Analytics Code -->
<?php wp_footer(); ?>
</body>
</html>
