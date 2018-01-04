<?php
/**
 * The sidebar containing the main widget area.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package trendpress
 */

if ( ! is_active_sidebar( 'trendpress-sidebar-1' ) ) {
	return;
}
?>

<aside id="secondary" class="widget-area" role="complementary">
	<?php dynamic_sidebar( 'trendpress-sidebar-1' ); ?>
</aside><!-- #secondary -->
