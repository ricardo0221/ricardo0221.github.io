<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Store_99
 */

?>

<!-- news-feed -->
<?php if (is_active_sidebar('footer-top-1') || is_active_sidebar('footer-top-2') || is_active_sidebar('footer-top-3')) : ?>
    <div class="news-feed">
        <div class="container">
            <div class="row">

                <?php

                $cols_top = 0;

                for ($i = 1; $i <= 3; $i++) {

                    if (is_active_sidebar('footer-top-' . $i))

                        $cols_top++;

                }

                $col_class_top = '';

                switch ($cols_top) {

                    case 1:

                        $col_class_top = 'col-md-12';

                        break;

                    case 2:

                        $col_class_top = 'col-md-6';

                        break;

                    case 3:

                        $col_class_top = 'col-md-4';

                        break;

                }
                ?>

                <?php

                for ($i = 1; $i <= $cols_top; $i++) {

                    if (is_active_sidebar('footer-top-' . $i)) {

                        ?>

                        <div class="<?php echo esc_attr($col_class_top); ?>">

                            <div class="footer-top-widget">

                                <?php dynamic_sidebar('footer-top-' . $i); ?>

                            </div>

                        </div>

                        <?php

                    }

                }

                ?>
            </div>
        </div>
    </div>
<?php endif; ?>

<!-- footer -->
<?php if (is_active_sidebar('footer-1') || is_active_sidebar('footer-2') || is_active_sidebar('footer-3') || is_active_sidebar('footer-4')) : ?>
    <div class="footer">
        <div class="container">
            <div class="row">
                <?php

                $cols = 0;

                for ($j = 1; $j <= 4; $j++) {

                    if (is_active_sidebar('footer-' . $j))

                        $cols++;

                }

                $col_class = '';

                switch ($cols) {

                    case 1:

                        $col_class = 'col-md-12';

                        break;

                    case 2:

                        $col_class = 'col-md-6';

                        break;

                    case 3:

                        $col_class = 'col-md-4';

                        break;

                    case 4:

                        $col_class = 'col-md-3';

                        break;

                }
                ?>

                <?php

                for ($j = 1; $j <= $cols; $j++) {

                    if (is_active_sidebar('footer-' . $j)) {

                        ?>

                        <div class="<?php echo esc_attr($col_class); ?>">

                            <div class="footer-widget">

                                <?php dynamic_sidebar('footer-' . $j); ?>

                            </div>

                        </div>

                        <?php

                    }

                }

                ?>
            </div>
        </div>
    </div>
    <?php
endif; ?>

<!-- copy-right -->
<div class="copy-right">
    <div class="container">
        <div class="copy-right-in clearfix">

                <div class="copy-text">
                    <p>Store99 by <a href="<?php echo esc_url( __('http://everestthemes.com', 'store99'));?>" target="_blank"><?php printf( __( 'Proudly powered by %s', 'store99' ), 'WordPress' ); ?></p>
                </div>

            <div class="copy-card">
                <?php
                if (get_theme_mod( 'store99_enable_payments_logo' ) != false):
                    $footer_payments_link = get_theme_mod( 'store99_payments_image_link' );
                    $footer_payments_title = get_theme_mod( 'store99_payments_image_title' );
                    $footer_payments_image = get_theme_mod( 'store99_payments_image' );
                    ?>
                    <a href="<?php echo !empty($footer_payments_link) ? esc_url($footer_payments_link) : 'javascript:void(0)'; ?>"
                       title="<?php echo !empty($footer_payments_title) ? esc_html($footer_payments_title) : ''; ?>" target="_blank">
                        <img src="<?php echo !empty($footer_payments_image) ? esc_url($footer_payments_image) : ''; ?>" alt="Payments Logo"
                             class="img-responsive">
                    </a>
                    <?php
                endif; ?>
            </div>
        </div>
    </div>
</div>

<?php wp_footer(); ?>

</body>
</html>
