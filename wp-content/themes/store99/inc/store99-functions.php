<?php
/**
 * Array to JSON
 */
if ( ! function_exists( 'store99_array2json' ) ):

	function store99_array2json( $arr ) {

		if ( function_exists( 'json_encode' ) ) {
			return json_encode( $arr );
		} //Lastest versions of PHP already has this functionality.

		$parts = array();

		$is_list = false;


		//Find out if the given array is a numerical array

		$keys = array_keys( $arr );

		$max_length = count( $arr ) - 1;

		if ( ( $keys[0] == 0 ) and ( $keys[ $max_length ] == $max_length ) ) {//See if the first key is 0 and last key is length - 1

			$is_list = true;

			for ( $i = 0; $i < count( $keys ); $i ++ ) { //See if each key correspondes to its position

				if ( $i != $keys[ $i ] ) { //A key fails at position check.

					$is_list = false; //It is an associative array.

					break;

				}

			}

		}


		foreach ( $arr as $key => $value ) {

			if ( is_array( $value ) ) { //Custom handling for arrays

				if ( $is_list ) {
					$parts[] = store99_array2json( $value );
				} /* :RECURSION: */

				else {
					$parts[] = '"' . $key . '":' . store99_array2json( $value );
				} /* :RECURSION: */

			} else {

				$str = '';

				if ( ! $is_list ) {
					$str = '"' . $key . '":';
				}


				//Custom handling for multiple data types

				if ( is_numeric( $value ) ) {
					$str .= $value;
				} //Numbers

				elseif ( $value === false ) {
					$str .= 'false';
				} //The booleans

				elseif ( $value === true ) {
					$str .= 'true';
				} else {
					$str .= '"' . addslashes( $value ) . '"';
				} //All other things


				$parts[] = $str;

			}

		}

		$json = implode( ',', $parts );


		if ( $is_list ) {
			return '[' . $json . ']';
		}//Return numerical JSON

		return '{' . $json . '}';//Return associative JSON

	}

endif;

/**
 * Get media file by link
 *
 * @param $link
 *
 * @return null|string
 */
function store99_get_image_id_by_link( $link ) {
	global $wpdb;

	$link = preg_replace( '/-\d+x\d+(?=\.(jpg|jpeg|png|gif)$)/i', '', $link );

	return $wpdb->get_var( "SELECT ID FROM {$wpdb->posts} WHERE BINARY guid='$link'" );
}

/**
 * Limit Excerpt Length
 *
 * @param $limit
 *
 * @return array|mixed|string
 */
function store99_excerpt( $limit ) {
	$excerpt = explode( ' ', get_the_excerpt(), $limit );
	if ( count( $excerpt ) >= $limit ) {
		array_pop( $excerpt );
		$excerpt = implode( " ", $excerpt ) . '...';
	} else {
		$excerpt = implode( " ", $excerpt );
	}
	$excerpt = preg_replace( '`\[[^\]]*\]`', '', $excerpt );

	return $excerpt;
}

/**
 * Count number of items inside widget
 *
 * @param $sidebar_id
 *
 * @return int
 */
function store99_get_widgets_count( $sidebar_id ) {
	$sidebars_widgets = wp_get_sidebars_widgets();

	return (int) count( (array) $sidebars_widgets[ $sidebar_id ] );
}

/**
 * Query WooCommerce activation
 */
if ( ! function_exists( 'store99_is_woocommerce_activated' ) ) {
	function store99_is_woocommerce_activated() {
		return class_exists( 'WooCommerce' ) ? true : false;
	}
}

/**
 * Check if a wooCommerce page
 *
 * @return bool
 */
if ( ! function_exists( 'store99_is_woocommerce_page' ) ) {
	function store99_is_woocommerce_page() {
		if ( store99_is_woocommerce_activated() != true ) {
			return false;
		}
		if ( is_checkout() || is_cart() || is_account_page() ) {
			return true;
		}
	}
}

/**
 * Normal Search Form
 */
function store99_normal_search() {

	$form = '<form role="search" method="get" class="main-form clearfix"  action="' .esc_url( home_url( '/' ) ) . '">
                 <div class="input-group" id="normal-search">
                    <input type="text" value="' . get_search_query() . '" name="s" id="s" class="normal-search form-control" placeholder="' . esc_attr__( 'Search for:', 'store99' ) . '"/>
                    <div class="input-group-btn">
                        <div class="btn-group" role="group">
                            <button type="submit" class="btn btn-primary">
                                <i class="fa fa-search" aria-hidden="true"></i>
                            </button>
                        </div>
                    </div>
                </div>
            </form>';
	echo $form;
}

/**
 * Backwards comaptibility function for logo
 */
function store99_logo() {
	if ( function_exists( 'the_custom_logo' ) ) {
		the_custom_logo();
	}
}

/**
 * @return bool
 */
function store99_has_logo() {
	if ( function_exists( 'has_custom_logo' ) ) {
		if ( has_custom_logo() ) {
			return true;
		}
	} else {
		return false;
	}
}

if ( class_exists( 'WP_Customize_Control' ) ) {
	class Store99_WP_Customize_Upgrade_Control extends WP_Customize_Control {
		/**
		 * Render the control's content.
		 */
		public function render_content() {
			printf(
				'<label class="customize-control-upgrade"><span class="customize-control-title">%s</span> %s</label>',
				esc_attr($this->label),
				'Thank You for Choosing Store99 Theme by <a href="'.esc_url('http://everestthemes.com/').'">Everest Themes.</a> Store99 is a modern, responsive & powerful WooCommerce WordPress theme. It has all the basic and advanced features needed to run an E-Commerce site. For any Help related to this theme, please visit  <a href="'.esc_url('https://everestthemes.com/support-forum/').'" target="_blank">Store99 Help & Support</a>.'
			);
		}
	}
}