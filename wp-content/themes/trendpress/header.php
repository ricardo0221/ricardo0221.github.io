<?php
$trendpress_post_lists = get_posts(array('posts_per_page' => -1));
/**
 * The header for our theme.
 *
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package trendpress
 */

?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="profile" href="http://gmpg.org/xfn/11">

<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<div id="page" class="site">
	<a class="skip-link screen-reader-text" href="#content"><?php esc_html_e( 'Skip to content', 'trendpress' ); ?></a>

	<header id="masthead" class="site-header" role="banner">
        <div class="tp-container clearfix">
    		<div class="site-branding">
            <?php if(get_header_image()){ ?>
                    <a href="<?php echo esc_url( home_url( '/' ) ); ?>"><img src="<?php header_image(); ?>" alt="<?php echo esc_html__('Header Logo','trendpress'); ?>" /></a>
    			<?php }
                else{
        			?>
        				<p class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></p>
        			<?php
                    $description = get_bloginfo( 'description','display' );
        			if ( $description || is_customize_preview() ) : ?>
        				<p class="site-description"><?php echo esc_attr($description); /* WPCS: xss ok. */ ?></p>
        			<?php
        			endif;
                } ?>
    		</div><!-- .site-branding -->
    
    		<nav id="site-navigation" class="main-navigation" role="navigation">
                <div id="toggle" class="">
                    <div class="one"></div>
                    <div class="two"></div>
                    <div class="three"></div>
                </div>
    			<?php wp_nav_menu( array( 'theme_location' => 'primary', 'menu_id' => 'primary-menu' ) ); ?>
    		</nav><!-- #site-navigation -->
            <?php $trendpress_header_search_enable = get_theme_mod('trendpress_search_enable');
             if($trendpress_header_search_enable){ ?>
             <div class="search-toggle">
                <a href="javascript:void(0)" class="search-icon"><i class="fa fa-search"></i></a>
				<div class="ak-search">
				    <?php get_search_form(); ?>
				</div>
            </div>
            <?php } ?>
        </div>
	</header><!-- #masthead -->
    <?php
    if(is_home() || is_front_page()){
        if(get_theme_mod('trendpress_slider_enable')){
            do_action('trendpress_slider_action');
        }
    }
    ?>
	<div id="content" class="site-content">
