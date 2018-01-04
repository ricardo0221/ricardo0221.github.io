<?php
/**
 * Page breadcrumb function
 */
if ( ! function_exists( 'store99_breadcrumbs_section' ) ) {
	function store99_breadcrumbs_section() {
		breadcrumb_trail();
	}
}
add_action( 'store99-breadcrumb', 'store99_breadcrumbs_section' );