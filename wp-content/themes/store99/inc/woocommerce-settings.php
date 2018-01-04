<?php
/**
 * WooCommerce Custom Functions
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
} // Exit if accessed directly

/**
 * Global $store99_settings
 */
global $store99_settings;
$store99_settings = get_option( 'store99_theme' );

/**
 * Initiate WooCommerce
 */

add_theme_support( 'woocommerce' );

/**
 * Enable gallery features
 */
add_theme_support( 'wc-product-gallery-zoom' );
add_theme_support( 'wc-product-gallery-lightbox' );
add_theme_support( 'wc-product-gallery-slider' );

/**
 * Remove actions
 */
remove_action( 'woocommerce_before_shop_loop', 'woocommerce_result_count', 20 );
remove_action( 'woocommerce_cart_collaterals', 'woocommerce_cross_sell_display' ); // Remove Cross-Sells from default position

/**
 * Add actions
 */
add_action( 'woocommerce_before_shop_loop', 'store99_grid_list_toggle', 40 );
add_action( 'woocommerce_before_shop_loop', 'woocommerce_pagination', 50 );
add_action( 'woocommerce_after_shop_loop_item_title', 'store99_woocommerce_product_rating', 9 );
add_action( 'woocommerce_after_shop_loop_item_title', 'store99_woocommerce_single_excerpt', 9 );
add_action( 'woocommerce_after_cart', 'woocommerce_cross_sell_display' ); // Add Cross-Sells back under the cart table

// Add filters
add_filter( 'loop_shop_per_page', 'store99_loop_shop_per_page' );

/**
 * Customize breadcrumbs
 */
add_filter( 'woocommerce_breadcrumb_defaults', 'store99_everest_woocommerce_breadcrumbs' );
function store99_everest_woocommerce_breadcrumbs() {
	return array(
		'delimiter'   => '<i class="fa fa-angle-right" aria-hidden="true"></i>',
		'wrap_before' => '<div class="breadcrumbs"><div class="container"><div class="breadcrumbs-content">',
		'wrap_after'  => '</div></div></div>',
		'before'      => '<span>',
		'after'       => '</span>',
		'home'        => _x( 'Home', 'breadcrumb', 'store99' ),
	);
}

/**
 * Show grid/list toggle buttons
 */
function store99_grid_list_toggle() {
	global $store99_settings;
	$gridlist_toggle = $store99_settings['category-view-mode'];

	?>
    <div class="gridlist-toggle hidden-xs clearfix">
        <a href="javascript:void(0)" id="grid" title="<?php echo esc_html__( 'Grid View', 'store99' ) ?>"
           class="<?php echo $gridlist_toggle == 'grid' ? 'active' : ''; ?>">
            <i class="fa fa-th-large" aria-hidden="true"></i>
        </a>
        <a href="javascript:void(0)" id="list"
           class="<?php echo ( $gridlist_toggle == 'list' ) ? 'active' : ''; ?>"
           title="<?php echo esc_html__( 'List View', 'store99' ) ?>">
            <i class="fa fa-list-ul" aria-hidden="true"></i>
        </a>
    </div>
	<?php
}

// Get product count per page
function store99_loop_shop_per_page() {
	parse_str( sanitize_text_field($_SERVER['QUERY_STRING']), $params );

	// replace it with theme option
	$products_per_page = get_theme_mod( 'store99_products_per_page' );
	if ( $products_per_page != '' ) {
		$per_page = explode( ',', esc_html( $products_per_page ) );
	} else {
		$per_page = explode( ',', '12,24,36' );
	}

	$item_count = ! empty( $params['count'] ) ? $params['count'] : $per_page[0];

	return $item_count;
}

// Remove related products
if ( get_theme_mod( 'store99_enable_related_products' ) != true ) {
	remove_action( 'woocommerce_after_single_product_summary', 'woocommerce_output_related_products', 20 );
}

// Remove product description from single product pages
if ( get_theme_mod( 'store99_enable_short_description' ) != true ) {
	remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_excerpt', 20 );
}

if ( get_theme_mod( 'store99_enable_product_tabs' ) != true ) {
	add_filter( 'woocommerce_product_tabs', 'store99_remove_product_tabs', 98 );

	function store99_remove_product_tabs( $tabs ) {

		unset( $tabs['description'] );        // Remove the description tab
		unset( $tabs['reviews'] );            // Remove the reviews tab
		unset( $tabs['additional_information'] );    // Remove the additional information tab

		return $tabs;

	}
}

/**
 * Show/Hide Cross-Sells
 */

add_action( 'init', 'store99_show_hide_cross_sells_cart_page' );
function store99_show_hide_cross_sells_cart_page() {

	if ( get_theme_mod( 'store99_enable_cross_sells' ) ) {
		add_filter( 'woocommerce_cross_sells_total', 'store99_cross_sells_limit' );
	} else {
		remove_action( 'woocommerce_cart_collaterals', 'woocommerce_cross_sell_display' );
	}
}

/**
 * Limit Cross-Sells
 * @return int
 */
function store99_cross_sells_limit() {
	$cart_cross_sells_count = get_theme_mod( 'store99_cart_cross_sells_count' );

	return (int) $cart_cross_sells_count;
}

/**
 *
 */
remove_action( 'woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_rating', 5 );
remove_action( 'woocommerce_after_shop_loop_item', 'woocommerce_template_loop_add_to_cart', 10 );
function store99_woocommerce_template_loop_add_to_cart() {
	?>
    <div class="add-links-wrap">
		<?php woocommerce_template_loop_add_to_cart(); ?>
    </div>
	<?php
}

add_action( 'woocommerce_after_shop_loop_item_title', 'store99_woocommerce_template_loop_add_to_cart', 11 );


remove_action( 'woocommerce_before_shop_loop_item', 'woocommerce_template_loop_product_link_open', 10 );
remove_action( 'woocommerce_before_shop_loop_item_title', 'woocommerce_show_product_loop_sale_flash', 10 );
remove_action( 'woocommerce_before_shop_loop_item_title', 'woocommerce_template_loop_product_thumbnail', 10 );

/**
 * Custmonize Product Image
 */
function store99_woocommerce_template_loop_product_thumbnail() { ?>
    <div class="product-image-wrapper">

		<?php
		global $post, $product;
		if ( $product->is_on_sale() ) :
			echo apply_filters( 'woocommerce_sale_flash', '<span class="onsale">' . __( 'Sale!', 'store99' ) . '</span>', $post, $product ); ?>
		<?php endif; ?>
		<?php
		global $product_label_custom;
		if ( $product_label_custom != '' ) {
			echo '<span class="labels">' . esc_attr($product_label_custom) . '</span>';
		}
		?>
        <a class="product-image" title="<?php the_title(); ?>" href="<?php the_permalink(); ?>">
			<?php
			if ( is_home() || is_front_page() ) {
				echo woocommerce_get_product_thumbnail( 'medium' );
			} else {
				echo woocommerce_get_product_thumbnail();
			}
			?>
        </a>
    </div>
	<?php
}

add_action( 'woocommerce_before_shop_loop_item_title', 'store99_woocommerce_template_loop_product_thumbnail', 10 );

/**
 * Product Block Title Area
 */
remove_action( 'woocommerce_shop_loop_item_title', 'woocommerce_template_loop_product_title', 10 );
function store99_woocommerce_template_loop_product_title() {
	?>
    <div class="product-title">
        <a title="<?php the_title(); ?>" href="<?php the_permalink(); ?>">
            <h5 class="woocommerce-loop-product__title"><?php the_title(); ?></h5>
        </a>
    </div>
<?php }

add_action( 'woocommerce_shop_loop_item_title', 'store99_woocommerce_template_loop_product_title', 10 );

/**
 * WooCommerce Product Rating
 */
function store99_woocommerce_product_rating() {
	global $woocommerce, $product;
	$average = $product->get_average_rating();

	echo '<div class="rating-wrap"><div class="star-rating">';
	echo '<span style="width:' . esc_attr(( ( $average / 5 ) * 100 )) . '%">';
	echo '<strong itemprop="ratingValue" class="rating">' . esc_attr($average) . '</strong> ' . __( 'out of 5', 'store99' ) . '</span>';
	echo '</div></div>';
}

/**
 * Product excerpt
 */
function store99_woocommerce_single_excerpt() {
	global $post;

	if ( ! $post->post_excerpt ) {
		return;
	}
	?>
    <div class="description">
		<?php echo force_balance_tags( apply_filters( 'woocommerce_short_description', $post->post_excerpt ) ) ?>
    </div>
	<?php
}

/**
 * Mini Cart
 */
if ( ! function_exists( 'store99_cart_link' ) ) {
	function store99_cart_link() { ?>
        <div class="add-card clearfix">
            <a href="javascript:void(0)" class="cart-contents"
               title="<?php __( 'View your shopping cart', 'store99' ); ?>">
                <div class="card-icon">
                    <div class="icon"><i class="fa fa-shopping-cart" aria-hidden="true"></i></div>
                    <div class="cash">
						<?php echo wp_kses_data( sprintf( WC()->cart->get_cart_contents_count() ) ); ?>
                    </div>
                </div>
            </a>
        </div>
		<?php
	}
}

if ( ! function_exists( 'store99_cart_link_fragment' ) ) {

	function store99_cart_link_fragment( $fragments ) {
		global $woocommerce;

		ob_start();
		store99_cart_link();
		$fragments['a.cart-contents'] = ob_get_clean();

		return $fragments;
	}
}

add_filter( 'add_to_cart_fragments', 'store99_cart_link_fragment' );


/**
 * Product Search Form
 */
function store99_product_search() {
	$args               = array(
		'number'     => '',
		'orderby'    => 'name',
		'order'      => 'ASC',
		'hide_empty' => true
	);
	$product_categories = get_terms( 'product_cat', $args );
	$categories_show    = '<option value="">' . __( 'All Categories', 'store99' ) . '</option>';
	$check              = '';
	if ( is_search() ) {
		if ( isset( $_GET['term'] ) && $_GET['term'] != '' ) {
			$check = sanitize_text_field(sanitize_text_field($_GET['term']));
		}
	}
	$checked = '';

	foreach ( $product_categories as $category ) {
		if ( isset( $category->slug ) ) {
			if ( trim( $category->slug ) == trim( $check ) ) {
				$checked = 'selected="selected"';
			}
			$categories_show .= '<option ' . $checked . ' value="' . esc_attr( $category->slug ) . '">' . esc_html( $category->name ) . '</option>';
			$checked         = '';
		}
	}

	$form = '<form role="search" method="get" id="searchform" class="main-form clearfix"  action="' .  esc_url( home_url( '/' ) ) . '">
             <input type="text" value="' . get_search_query() . '" name="s" id="s" class="search-input typeahead" placeholder="' . esc_attr__( 'Search for products', 'store99' ) . '" />
             <select id="search-from-categories" name="term">' . $categories_show . '</select>
             <input type="hidden" name="post_type" value="product" />
             <input type="hidden" name="taxonomy" value="product_cat" />
             <button type="submit"><i class="fa fa-search" aria-hidden="true"></i></button>
            </form>';
	echo $form;
}

/**
 * Show mini cart widget in all pages
 */
add_filter( 'woocommerce_widget_cart_is_hidden', 'store99_always_show_cart_widget', 40, 0 );
function store99_always_show_cart_widget() {
	return false;
}

/**
 * Search Products (Ajax Call)
 */
function store99_search_products() {
	if ( isset( $_GET['query'] ) ) {

		$search_keyword = sanitize_text_field(sanitize_text_field($_GET['query']));

		$args = array(
			's'                   => apply_filters( 'store99_ajax_search_products_search_query', $search_keyword ),
			'post_type'           => 'product',
			'post_status'         => 'publish',
			'ignore_sticky_posts' => 1,
			'orderby'             => 'title',
			'order'               => 'ASC',
			'posts_per_page'      => 10,
			'suppress_filters'    => false
		);

		if ( isset( $_GET['category'] ) ) {
			$args['tax_query'] = array(
				'relation' => 'AND',
				array(
					'taxonomy' => 'product_cat',
					'field'    => 'slug',
					'terms'    => sanitize_text_field(sanitize_text_field($_GET['category']))
				)
			);
		}

		if ( version_compare( WC()->version, '2.7.0', '<' ) ) {
			$args['meta_query'] = array(
				array(
					'key'     => '_visibility',
					'value'   => array( 'search', 'visible' ),
					'compare' => 'IN'
				),
			);
		} else {
			$product_visibility_term_ids = wc_get_product_visibility_term_ids();
			$args['tax_query'][]         = array(
				'taxonomy' => 'product_visibility',
				'field'    => 'term_taxonomy_id',
				'terms'    => $product_visibility_term_ids['exclude-from-search'],
				'operator' => 'NOT IN',
			);
		}

		$products    = get_posts( $args );
		$suggestions = array();

		if ( ! empty( $products ) ) {
			foreach ( $products as $post ) {
				$product = wc_get_product( $post );

				$suggestions[] = apply_filters( 'store99_suggestion', array(
					'id'    => $product->get_id(),
					'title' => strip_tags( $product->get_title() ),
					'slug'  => $product->get_permalink()
				), $product );
			}
		} else {
			$suggestions[] = array(
				'id'    => - 1,
				'title' => esc_html__('Nothing found.','store99'),
				'slug'  => ''
			);
		}
		header( 'Content-Type: application/json' );
		wp_send_json( $suggestions );
		die();
	}
}

add_action( 'wp_ajax_store99_search_ajax_call', 'store99_search_products' );
add_action( 'wp_ajax_nopriv_store99_search_ajax_call', 'store99_search_products' );//for users that are not logged in.