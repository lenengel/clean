<?php
$menu_style = st()->get_option('menu_style_modern', '');
$footer_class = '';
if($menu_style == 8){
    $footer_class = 'main-footer--solo';
}
wp_reset_postdata();
wp_reset_query();
$footer_template = TravelHelper::st_get_template_footer(get_the_ID(), true);

if ($footer_template) {
    $vc_content = STTemplate::get_vc_pagecontent($footer_template);
    if ($vc_content) {
        echo '<div class="back-to-top" style="text-align: center;padding: 15px;">';
		echo '<a href="#" class="topbutton"><i class="fa fa-arrow-circle-up" aria-hidden="true" style="font-size: 32px; color: #999;"></i></a><br> nach oben</div>';
		echo '<footer id="main-footer" class="clearfix'. esc_attr($footer_class) .' ">';
        echo balanceTags($vc_content);
        echo ' </footer>';
    }
} else {
    ?>
    <footer id="main-footer" class="container-fluid">
        <div class="container text-center">
            <p><?php _e('Copy &copy; 2014 Shinetheme. All Rights Reserved', 'traveler') ?></p>
        </div>

    </footer>
<?php } ?>

<?php if($menu_style !=8){
    $copyright = st()->get_option('st_text_copyright');
    $card_accept = st()->get_option('st_card_accept');
    ?>
    <div class="container main-footer-sub">
        <div class="st-flex space-between">
            <div class="left mt20">
                <div class="f14">
					
                    <?php
                    if (empty($copyright)) {
                        echo sprintf( esc_html__( 'Copyright © %s by', 'traveler' ), date( 'Y' ) ); ?> <a
                            href="<?php echo esc_url( home_url( '/' ) ) ?>"
                            class="st-link"><?php bloginfo( 'name' ) ?></a>&nbsp;&nbsp;|&nbsp;&nbsp;
							<a href="<?php echo esc_url( home_url( '/impressum' ) ) ?>" class="st-link">Impressum & Datenschutz</a>&nbsp;&nbsp;|&nbsp;&nbsp;
							<a href="<?php echo esc_url( home_url( '/wp-content/uploads/2021/08/agb_gluexplatzl.pdf' ) ) ?>" target="_blank" class="st-link">AGB</a>
                        <?php
                    } else {
                        echo wp_kses($copyright, array('p' => ['class' => []], 'a' => ['class' => [], 'href' => []], 'br' => [], 'em' => [], 'strong' => []));
                    } ?>
                </div>
            </div>
            <div class="right mt20">
                <?php
                if (!empty($card_accept)) { ?>
                    <?php
                    $image_id = attachment_url_to_postid($card_accept);
                    $thumb_card_accept = wp_get_attachment_image_src($image_id, ['', '40']);
                    if (isset($thumb_card_accept[0]) && !empty($thumb_card_accept[0])) {
                        $class = Assets::build_css('height: 40px');
                        ?>
                        <img src="<?php echo esc_url($thumb_card_accept[0]) ?>" alt=""
                            class="img-responsive <?php echo esc_attr($class) ?>">
                        <?php
                    }
                } ?>
            </div>
        </div>
    </div>
<?php } ?>

<?php
if ($menu_style == 8) { //solo layout
    echo st()->load_template('layouts/modern/common/loginForm', 'solo');
    echo st()->load_template('layouts/modern/common/registerForm', 'solo');
} else {
    echo st()->load_template('layouts/modern/common/loginForm', '');
    echo st()->load_template('layouts/modern/common/registerForm', '');
}
echo st()->load_template('layouts/modern/common/resetPasswordForm', '');
?>
<?php do_action('stt_compare_link'); ?>
<?php do_action('stt_compare_popup'); ?>
<?php wp_footer(); ?>
<script>
/*
$(function() {
    var offset = 100;
    var speed = 250;
    var duration = 500;
        $(window).scroll(function(){
            if ($(this).scrollTop() < offset) {
                      $('.topbutton') .fadeOut(duration);
            } else {
                      $('.topbutton') .fadeIn(duration);
            }
        });
     $('.topbutton').on('click', function(){
            $('html, body').animate({scrollTop:0}, speed);
            return false;
            });
})();*/
</script>
</body>
</html>
