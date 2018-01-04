<?php
/**
 * The Template for displaying product archives, including the main shop page which is a post type archive
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/archive-product.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see        https://docs.woocommerce.com/document/template-structure/
 * @author        WooThemes
 * @package    WooCommerce/Templates
 * @version     2.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

get_header( 'shop' ); ?>

<?php
$layout_classes = '';

if ( get_theme_mod( 'store99_archive_enable_right_sidebar' ) ) {
	$layout_classes = 'col-md-9';
} else {
	$layout_classes = 'col-md-12';
}

?>

<?php
/**
 * woocommerce_before_main_content hook.
 *
 * @hooked woocommerce_output_content_wrapper - 10 (outputs opening divs for the content)
 * @hooked woocommerce_breadcrumb - 20
 * @hooked WC_Structured_Data::generate_website_data() - 30
 */
do_action( 'woocommerce_before_main_content' );
?>

<div class="content-area">
    <div class="container">
        <div class="row">

            <div class="<?php echo esc_attr($layout_classes); ?>">

                <div class="shop-contro">

                    <div class="woocommerce-products-header">

						<?php if ( apply_filters( 'woocommerce_show_page_title', true ) ) : ?>

                            <h5 class="woocommerce-products-header__title page-title"><?php woocommerce_page_title(); ?></h5>

						<?php endif; ?>

						<?php
						/**
						 * woocommerce_archive_description hook.
						 *
						 * @hooked woocommerce_taxonomy_archive_description - 10
						 * @hooked woocommerce_product_archive_description - 10
						 */
						do_action( 'woocommerce_archive_description' );
						?>

                    </div>

                </div>

				<?php if ( have_posts() ) : ?>

                    <div class="shop-cata">
                        <div class="row">
                            <div class="before-shop-loop">
								<?php
								/**
								 * woocommerce_before_shop_loop hook.
								 *
								 * @hooked wc_print_notices - 10
								 * @hooked woocommerce_result_count - 20 : removed
								 * @hooked woocommerce_catalog_ordering - 30
								 */
								do_action( 'woocommerce_before_shop_loop' );
								?>
                            </div>
                        </div>
                    </div>

                    <div class="archive-products">

						<?php woocommerce_product_loop_start(); ?>

						<?php woocommerce_product_subcategories(); ?>

						<?php while ( have_posts() ) : the_post(); ?>

							<?php
							/**
							 * woocommerce_shop_loop hook.
							 *
							 * @hooked WC_Structured_Data::generate_product_data() - 10
							 */
							do_action( 'woocommerce_shop_loop' );
							?>

							<?php wc_get_template_part( 'content', 'product' ); ?>

						<?php endwhile; // end of the loop. ?>

						<?php woocommerce_product_loop_end(); ?>

                    </div>

				<?php endif; ?>

                <div class="shop-cata shop-cata-bottom">
                    <div class="row">
                        <div class="after-shop-loop">
							<?php
							/**
							 * woocommerce_after_shop_loop hook.
							 *
							 * @hooked woocommerce_pagination - 10
							 */
							do_action( 'woocommerce_after_shop_loop' );
							?>
                        </div>
                    </div>
                </div>

            </div>

			<?php
			/**
			 * woocommerce_sidebar hook.
			 *
			 * @hooked woocommerce_get_sidebar - 10
			 */
			if ( get_theme_mod( 'store99_archive_enable_right_sidebar' ) ) {
				do_action( 'woocommerce_sidebar' );
			}
			?>

        </div>
    </div>
</div>

<?php
/**
 * woocommerce_after_main_content hook.
 *
 * @hooked woocommerce_output_content_wrapper_end - 10 (outputs closing divs for the content)
 */
do_action( 'woocommerce_after_main_content' );
?>

<?php get_footer( 'shop' ); ?>
