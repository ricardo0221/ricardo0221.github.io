<?php
/**
 * The template for displaying all single posts.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package trendpress
 */

get_header();
$trendpress_feature_category = get_theme_mod('trendpress_feature_cat');
$trendpress_feature_cats = get_the_category( get_the_ID() );
foreach($trendpress_feature_cats as $trendpress_feature_cat){
    $trendpress_feature_class = '';
    if($trendpress_feature_category == $trendpress_feature_cat->slug){
        $trendpress_feature_class = 'feature-cat-post';
    }
}
do_action('trendpress_header_banner');?>
    <div class="tp-container">
    	<div id="primary" class="content-area <?php echo esc_attr($trendpress_feature_class); ?>">
    		<main id="main" class="site-main" role="main">
    
    		<?php
    		while ( have_posts() ) : the_post();
    
    			get_template_part( 'template-parts/content', get_post_format() );
    
    			the_post_navigation();
    
    			// If comments are open or we have at least one comment, load up the comment template.
    			if ( comments_open() || get_comments_number() ) :
    				comments_template();
    			endif;
    
    		endwhile; // End of the loop.
    		?>
    
    		</main><!-- #main -->
    	</div><!-- #primary -->
    
<?php
get_sidebar();
?> </div> <?php
get_footer();
