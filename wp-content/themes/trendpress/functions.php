<?php
/**
 * trendpress functions and definitions.
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package trendpress
 */

if ( ! function_exists( 'trendpress_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function trendpress_setup() {
	/*
	 * Make theme available for translation.
	 * Translations can be filed in the /languages/ directory.
	 * If you're building a theme based on trendpress, use a find and replace
	 * to change 'trendpress' to the name of your theme in all the template files.
	 */
	load_theme_textdomain( 'trendpress', get_template_directory() . '/languages' );

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	/*
	 * Let WordPress manage the document title.
	 * By adding theme support, we declare that this theme does not use a
	 * hard-coded <title> tag in the document head, and expect WordPress to
	 * provide it for us.
	 */
	add_theme_support( 'title-tag' );

	
	add_theme_support( 'post-thumbnails' );

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus( array(
		'primary' => esc_html__( 'Primary', 'trendpress' ),
	) );

	/*
	 * Switch default core markup for search form, comment form, and comments
	 * to output valid HTML5.
	 */
	add_theme_support( 'html5', array(
		'search-form',
		'comment-form',
		'comment-list',
		'gallery',
		'caption',
	) );

	// Set up the WordPress core custom background feature.
	add_theme_support( 'custom-background', apply_filters( 'trendpress_custom_background_args', array(
		'default-color' => 'ffffff',
		'default-image' => '',
	) ) );
    
    /** Image Size **/
    add_image_size('trendpress-slider-image',1920,700,true);
    add_image_size('trendpress-feature-image',75,75,true);
    add_image_size('trendpress-portfolio-image',400,400,true);
    add_image_size('trendpress-blog-image',375,250,true);
    add_image_size('trendpress-testimonial-image',90,90,true);
    add_image_size('trendpress-client-image',175,135,true);
    add_image_size('trendpress-recent-post-image',60,55,true);
    add_image_size('trendpress-single-page',1243,500,true);
    add_image_size('trendpress-client-logo',195,160,true);
    add_image_size('trendpress-team-image',200,275,true);
}
endif;
add_action( 'after_setup_theme', 'trendpress_setup' );
/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function trendpress_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'trendpress_content_width', 640 );
}
add_action( 'after_setup_theme', 'trendpress_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function trendpress_widgets_init() {
	register_sidebar( array(
		'name'          => esc_html__( 'Sidebar', 'trendpress' ),
		'id'            => 'trendpress-sidebar-1',
		'description'   => esc_html__( 'Add widgets here.', 'trendpress' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
    register_sidebar( array(
		'name'          => esc_html__( 'Bottom Footer One', 'trendpress' ),
		'id'            => 'trendpress-footer-1',
		'description'   => esc_html__( 'Add widgets here.', 'trendpress' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
    register_sidebar( array(
		'name'          => esc_html__( 'Bottom Footer Two', 'trendpress' ),
		'id'            => 'trendpress-footer-2',
		'description'   => esc_html__( 'Add widgets here.', 'trendpress' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
    register_sidebar( array(
		'name'          => esc_html__( 'Bottom Footer Three', 'trendpress' ),
		'id'            => 'trendpress-footer-3',
		'description'   => esc_html__( 'Add widgets here.', 'trendpress' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
    register_sidebar( array(
		'name'          => esc_html__( 'Bottom Footer Four', 'trendpress' ),
		'id'            => 'trendpress-footer-4',
		'description'   => esc_html__( 'Add widgets here.', 'trendpress' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
}
add_action( 'widgets_init', 'trendpress_widgets_init' );
/**
 * Enqueue scripts and styles.
 */
function trendpress_scripts() {
    $trendpress_font_query_args = array('family' => 'Merriweather+Sans:300,300i,400,400i,700,700i,800,800i|Droid+Sans:400,700|Merriweather:300,300i,400,400i,700,700i');
    wp_enqueue_style( 'trendpress-google-fonts', add_query_arg($trendpress_font_query_args, "//fonts.googleapis.com/css"));
    wp_enqueue_style( 'font-awesome',get_template_directory_uri() . '/css/font-awesome/css/font-awesome.min.css');
    wp_enqueue_style( 'trendpress-style', get_stylesheet_uri() );
    wp_enqueue_style( 'owl-carousel',get_template_directory_uri(). '/js/owl-carousel/owl.carousel.min.css');
    wp_enqueue_style( 'woocommerce-style',get_template_directory_uri(). '/woocommerce/woocommerce-style.css');
    wp_enqueue_style( 'trendpress-responsive',get_template_directory_uri(). '/responsive.css');
    wp_enqueue_style( 'animation',get_template_directory_uri(). '/js/wow-animation/animate.min.css');
    
    
    wp_enqueue_script( 'isotope-pkgd', get_template_directory_uri(). '/js/isotope/isotope.pkgd.min.js',array('jquery'));
    wp_enqueue_script( 'packery-mode-pkgd', get_template_directory_uri(). '/js/isotope/packery-mode.pkgd.min.js',array('jquery'));
    wp_enqueue_script( 'trendpress-navigation', get_template_directory_uri() . '/js/navigation.js', array(), '20151215', true );
    wp_enqueue_script( 'parallax', get_template_directory_uri() . '/js/parallax.min.js', array('jquery') );
    wp_enqueue_script( 'owl-carousel',get_template_directory_uri() . '/js/owl-carousel/owl.carousel.min.js',array('jquery'));
    wp_enqueue_script( 'trendpress-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), '20151215', true );
    wp_enqueue_script( 'wow', get_template_directory_uri() . '/js/wow-animation/wow.min.js', array('jquery'));
    wp_enqueue_script( 'trendpress-custom-script', get_template_directory_uri() . '/js/custom.js',array('jquery','owl-carousel','wow','parallax','isotope-pkgd','packery-mode-pkgd','imagesloaded'));
    
	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'trendpress_scripts' );

/** Customizer Enqueue **/
function bloggerbuz_customizer_enqueue() {
        wp_enqueue_style('bloggerbuz-customizer-style', get_template_directory_uri() . '/inc/admin-panel/css/customizer-style.css');
        wp_enqueue_script( 'bloggerbuz-customizer-script', get_template_directory_uri() . '/inc/admin-panel/js/customizer-js.js', array( 'jquery', 'customize-controls' ), false );
   }
add_action( 'customize_controls_enqueue_scripts', 'bloggerbuz_customizer_enqueue' );

/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Custom functions that act independently of the theme templates.
 */
require get_template_directory() . '/inc/extras.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';
/**
 * Customizer Option Fields
 */
require get_template_directory() . '/inc/admin-panel/trendpress-customizer.php';
/**
 * trendpress Function
 */
 require get_template_directory() . '/inc/trendpress-function.php';
/**
 * Woocommerce File
 */
require get_template_directory() . '/woocommerce/woocommerce-function.php';
/**
 * Dynamic CSS
 */
require get_template_directory() . '/css/dynamic-css.php';