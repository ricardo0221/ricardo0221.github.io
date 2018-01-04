<?php
/** 
 * Woocommerce Functions & Hook
*/
remove_action('woocommerce_before_main_content','woocommerce_breadcrumb',20);
add_action('woocommerce_before_main_content','trendpress_woocommerce_breadcrumb',20);
add_action('woocommerce_before_main_content','trendpress_woocommerce_wrap_start',22);
add_action('woocommerce_after_main_content','trendpress_woocommerce_wrap_end',12);
add_action('woocommerce_before_shop_loop_item_title','trendpress_show_product_loop_sale_flash_start',8);
add_action('woocommerce_before_shop_loop_item_title','trendpress_show_product_loop_sale_flash_end',11);
add_action('woocommerce_before_single_product_summary','trendpress_show_product_loop_sale_flash_start',8);
add_action('woocommerce_before_single_product_summary','trendpress_show_product_loop_sale_flash_end',12);
remove_action('woocommerce_before_shop_loop_item_title','woocommerce_template_loop_product_thumbnail',10);
add_action('woocommerce_before_shop_loop_item_title','woocommerce_template_loop_product_thumbnail',12);
add_filter('woocommerce_sale_flash', 'trendpress_change_sale_to_percentage', 21, 3);
remove_action( 'woocommerce_sidebar','woocommerce_get_sidebar',10 );
remove_action('woocommerce_before_main_content','woocommerce_output_content_wrapper',10);
remove_action('woocommerce_after_main_content','woocommerce_output_content_wrapper_end',10);
add_action('woocommerce_shop_loop_item_title','trendpress_title_price_rating_wrap_start',8);
add_action('woocommerce_after_shop_loop_item_title','trendpress_title_price_rating_wrap_end',12);
function trendpress_woocommerce_breadcrumb(){
    do_action('trendpress_header_banner');
}

function trendpress_woocommerce_wrap_start(){
    ?>
    <div class="tp-container">
    	<div id="primary" class="content-area">
    		<main id="main" class="site-main" role="main">
    <?php
}

function trendpress_woocommerce_wrap_end(){
    ?>
            </main>
        </div>
        <?php get_sidebar(); ?>
    </div>
    <?php
}

function trendpress_show_product_loop_sale_flash_start(){
    ?>
        <div class="shop-flash-wrap">
    <?php
}

function trendpress_show_product_loop_sale_flash_end(){
    ?>
        </div>
    <?php
}

function trendpress_change_sale_to_percentage($content, $post, $product){

    if (!$product->is_in_stock()) return;
    $sale_price = get_post_meta($product->id, '_price', true);
    $regular_price = get_post_meta($product->id, '_regular_price', true);
        
        if (!empty($regular_price) && !empty($sale_price) && $regular_price > $sale_price){
            $sale = ceil((($regular_price - $sale_price) / $regular_price) * 100);
            $content = '<span class="onsale">-' . $sale . '%</span>';
            return $content;
        }
}

add_action( 'wp_ajax_nopriv_trendpress_ajax_woocommerce', 'trendpress_ajax_woocommerce' );
add_action( 'wp_ajax_trendpress_ajax_woocommerce', 'trendpress_ajax_woocommerce' );
function trendpress_ajax_woocommerce() {
	$product_id = $_POST['product_id'];
    $trendpress_feature_posts = new WP_Query(array('post_type' => 'product', 'post__in' => array($product_id)));
    if($trendpress_feature_posts->have_posts()):
        while($trendpress_feature_posts->have_posts()):$trendpress_feature_posts->the_post();
            echo $trendpress_price = get_post_meta($product_id,'_regular_price',true);
            $trendpress_woo_image_src = wp_get_attachment_image_src(get_post_thumbnail_id(),'');
            $trendpress_woo_image_url = $trendpress_woo_image_src[0];?>
            <div class="cart-grid-box">
                <div class="cart-grid-box-img">
                    <img class="img-responsive" src="<?php echo esc_url($trendpress_woo_image_url); ?>" alt="">
                </div>
                <div class="cart-grid-box-title">
                    <a href="<?php the_permalink() ?>"> <?php the_title(); ?> </a>
                    <p class="price"> <?php echo absint($trendpress_price); ?></p>
                </div>
                <div class="cart-grid-box-del">
                    <a href="#"><i class="fa fa-times"></i></a>
                </div>
            </div>
            <?php
        endwhile;
    endif;
	die();
}


function trendpress_title_price_rating_wrap_start(){
    ?>
        <div class="clearfix title-proce-rating">
    <?php
}

function trendpress_title_price_rating_wrap_end(){
    ?>
    </div>
    <?php
}