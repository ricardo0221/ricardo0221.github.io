<?php
/**
 * Template Name: Front Page Template
 */

get_header();
?>
<?php
get_template_part( 'owl-slider' );

if ( is_active_sidebar( 'home-1' ) ) {
	dynamic_sidebar( 'home-1' );
}

if ( is_active_sidebar( 'home-2' ) || is_active_sidebar( 'home-3' ) ): ?>
    <div class="hot-product">
        <div class="container">
            <div class="row">
				<?php
				if ( is_active_sidebar( 'home-2' ) ) {
					dynamic_sidebar( 'home-2' );
				}
				?>
				<?php
				if ( is_active_sidebar( 'home-3' ) ) {
					dynamic_sidebar( 'home-3' );
				}
				?>

            </div>
        </div>
    </div>
	<?php
endif; ?>

<?php
if ( is_active_sidebar( 'home-4' ) ) {
	dynamic_sidebar( 'home-4' );
}
if ( is_active_sidebar( 'home-5' ) ) {
	dynamic_sidebar( 'home-5' );
}
if ( is_active_sidebar( 'home-6' ) ) {
	dynamic_sidebar( 'home-6' );
}
if ( is_active_sidebar( 'home-7' ) || is_active_sidebar( 'home-8' ) ): ?>

    <!-- blog/brands -->
    <div class="store99-blog">
        <div class="container">
            <div class="row">
				<?php
				if ( is_active_sidebar( 'home-7' ) ) {
					dynamic_sidebar( 'home-7' );
				}
				?>
				<?php
				if ( is_active_sidebar( 'home-8' ) ) {
					dynamic_sidebar( 'home-8' );
				}
				?>
            </div>
        </div>
    </div>
	<?php
endif; ?>
<?php
get_footer();