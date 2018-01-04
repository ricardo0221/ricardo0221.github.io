<?php
/**
 * Store 99 functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Store_99
 */

if (!function_exists('store99_setup')) :
    /**
     * Sets up theme defaults and registers support for various WordPress features.
     *
     * Note that this function is hooked into the after_setup_theme hook, which
     * runs before the init hook. The init hook is too late for some features, such
     * as indicating support for post thumbnails.
     */
    function store99_setup()
    {
        /*
         * Make theme available for translation.
         * Translations can be filed in the /languages/ directory.
         * If you're building a theme based on Store 99, use a find and replace
         * to change 'store99' to the name of your theme in all the template files.
         */
        load_theme_textdomain('store99', get_template_directory() . '/languages');

        // Add default posts and comments RSS feed links to head.
        add_theme_support('automatic-feed-links');

        /*
         * Let WordPress manage the document title.
         * By adding theme support, we declare that this theme does not use a
         * hard-coded <title> tag in the document head, and expect WordPress to
         * provide it for us.
         */
        add_theme_support('title-tag');

        /*
         * Enable support for Post Thumbnails on posts and pages.
         *
         * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
         */
        add_theme_support('post-thumbnails');

        // This theme uses wp_nav_menu() in one location.
        register_nav_menus(array(
            'top' => esc_html__('Top', 'store99'),
            'primary' => esc_html__('Primary', 'store99'),
            'category' => esc_html__('Category', 'store99'),
        ));

        /*
         * Switch default core markup for search form, comment form, and comments
         * to output valid HTML5.
         */
        add_theme_support('html5', array(
            'search-form',
            'comment-form',
            'comment-list',
            'gallery',
            'caption',
        ));

        // Set up the WordPress core custom background feature.
        add_theme_support('custom-background', apply_filters('store99_custom_background_args', array(
            'default-color' => 'ffffff',
            'default-image' => '',
        )));

	    add_theme_support( 'custom-logo', array(
		    'flex-height' => true,
		    'flex-width'  => true,
		    'header-text' => array( 'site-title', 'site-description' ),
	    ) );

        // Add theme support for selective refresh for widgets.
        add_theme_support('customize-selective-refresh-widgets');
    }
endif;
add_action('after_setup_theme', 'store99_setup');

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function store99_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'store99_content_width', 640 );
}
add_action( 'after_setup_theme', 'store99_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function store99_widgets_init()
{
    register_sidebar(array(
        'name' => esc_html__('Sidebar', 'store99'),
        'id' => 'sidebar-1',
        'description' => esc_html__('Add widgets here.', 'store99'),
        'before_widget' => '<section id="%1$s" class="widget %2$s">',
        'after_widget' => '</section>',
        'before_title' => '<h6 class="widget-title">',
        'after_title' => '</h6>',
    ));

    register_sidebar(array(
        'name' => esc_html__('Home 1/3 - Full Width', 'store99'),
        'id' => 'home-1',
        'description' => esc_html__('Add widgets here.', 'store99'),
        'before_widget' => '<section id="%1$s" class="widget %2$s">',
        'after_widget' => '</section>',
        'before_title' => '<h6 class="widget-title">',
        'after_title' => '</h6>',
    ));

    register_sidebar(array(
        'name' => esc_html__('Home 2 - 2/3 Width', 'store99'),
        'id' => 'home-2',
        'description' => esc_html__('Add widgets here.', 'store99'),
        'before_widget' => '<section id="%1$s" class="widget %2$s">',
        'after_widget' => '</section>',
        'before_title' => '<h6 class="widget-title">',
        'after_title' => '</h6>',
    ));

    register_sidebar(array(
        'name' => esc_html__('Home 3 - 1/3 Width', 'store99'),
        'id' => 'home-3',
        'description' => esc_html__('Add widgets here.', 'store99'),
        'before_widget' => '<section id="%1$s" class="widget %2$s">',
        'after_widget' => '</section>',
        'before_title' => '<h6 class="widget-title">',
        'after_title' => '</h6>',
    ));

    register_sidebar(array(
        'name' => esc_html__('Home 4 - Full Width', 'store99'),
        'id' => 'home-4',
        'description' => esc_html__('Add widgets here.', 'store99'),
        'before_widget' => '<section id="%1$s" class="widget %2$s">',
        'after_widget' => '</section>',
        'before_title' => '<h6 class="widget-title">',
        'after_title' => '</h6>',
    ));

    register_sidebar(array(
        'name' => esc_html__('Home 5 - Full Width', 'store99'),
        'id' => 'home-5',
        'description' => esc_html__('Add widgets here.', 'store99'),
        'before_widget' => '<section id="%1$s" class="widget %2$s">',
        'after_widget' => '</section>',
        'before_title' => '<h6 class="widget-title">',
        'after_title' => '</h6>',
    ));

    register_sidebar(array(
        'name' => esc_html__('Home 6 - Full  Width', 'store99'),
        'id' => 'home-6',
        'description' => esc_html__('Add widgets here.', 'store99'),
        'before_widget' => '<section id="%1$s" class="widget %2$s">',
        'after_widget' => '</section>',
        'before_title' => '<h6 class="widget-title">',
        'after_title' => '</h6>',
    ));

    register_sidebar(array(
        'name' => esc_html__('Home 7 - 2/3 Width', 'store99'),
        'id' => 'home-7',
        'description' => esc_html__('Add widgets here.', 'store99'),
        'before_widget' => '<section id="%1$s" class="widget %2$s">',
        'after_widget' => '</section>',
        'before_title' => '<h6 class="widget-title">',
        'after_title' => '</h6>',
    ));

    register_sidebar(array(
        'name' => esc_html__('Home 8 - 1/3 Width', 'store99'),
        'id' => 'home-8',
        'description' => esc_html__('Add widgets here.', 'store99'),
        'before_widget' => '<section id="%1$s" class="widget %2$s">',
        'after_widget' => '</section>',
        'before_title' => '<h6 class="widget-title">',
        'after_title' => '</h6>',
    ));

    register_sidebar(array(
        'name' => esc_html__('Footer Top Widget 1', 'store99'),
        'id' => 'footer-top-1',
        'description' => esc_html__('Add widgets here.', 'store99'),
        'before_widget' => '<section id="%1$s" class="widget %2$s">',
        'after_widget' => '</section>',
        'before_title' => '<h5 class="widget-title">',
        'after_title' => '</h5>',
    ));

    register_sidebar(array(
        'name' => esc_html__('Footer Top Widget 2', 'store99'),
        'id' => 'footer-top-2',
        'description' => esc_html__('Add widgets here.', 'store99'),
        'before_widget' => '<section id="%1$s" class="widget %2$s">',
        'after_widget' => '</section>',
        'before_title' => '<h5 class="widget-title">',
        'after_title' => '</h5>',
    ));

    register_sidebar(array(
        'name' => esc_html__('Footer Top Widget 3', 'store99'),
        'id' => 'footer-top-3',
        'description' => esc_html__('Add widgets here.', 'store99'),
        'before_widget' => '<section id="%1$s" class="widget %2$s">',
        'after_widget' => '</section>',
        'before_title' => '<h5 class="widget-title">',
        'after_title' => '</h5>',
    ));

    register_sidebar(array(
        'name' => esc_html__('Footer Widget 1', 'store99'),
        'id' => 'footer-1',
        'description' => esc_html__('Add widgets here.', 'store99'),
        'before_widget' => '<section id="%1$s" class="widget %2$s">',
        'after_widget' => '</div></section>',
        'before_title' => '<h6 class="widget-title">',
        'after_title' => '</h6><div class="widget-content">',
    ));

    register_sidebar(array(
        'name' => esc_html__('Footer Widget 2', 'store99'),
        'id' => 'footer-2',
        'description' => esc_html__('Add widgets here.', 'store99'),
        'before_widget' => '<section id="%1$s" class="widget %2$s">',
        'after_widget' => '</div></section>',
        'before_title' => '<h6 class="widget-title">',
        'after_title' => '</h6><div class="widget-content">',
    ));

    register_sidebar(array(
        'name' => esc_html__('Footer Widget 3', 'store99'),
        'id' => 'footer-3',
        'description' => esc_html__('Add widgets here.', 'store99'),
        'before_widget' => '<section id="%1$s" class="widget %2$s">',
        'after_widget' => '</div></section>',
        'before_title' => '<h6 class="widget-title">',
        'after_title' => '</h6><div class="widget-content">',
    ));

    register_sidebar(array(
        'name' => esc_html__('Footer Widget 4', 'store99'),
        'id' => 'footer-4',
        'description' => esc_html__('Add widgets here.', 'store99'),
        'before_widget' => '<section id="%1$s" class="widget %2$s">',
        'after_widget' => '</div></section>',
        'before_title' => '<h6 class="widget-title">',
        'after_title' => '</h6><div class="widget-content">',
    ));

    register_sidebar(array(
        'name' => esc_html__('Footer Bottom Widget 1', 'store99'),
        'id' => 'footer-bottom-1',
        'description' => esc_html__('Add widgets here.', 'store99'),
        'before_widget' => '<section id="%1$s" class="widget %2$s">',
        'after_widget' => '</section>',
        'before_title' => '<h6 class="widget-title">',
        'after_title' => '</h6>',
    ));

    register_sidebar(array(
        'name' => esc_html__('Footer Bottom Widget 2', 'store99'),
        'id' => 'footer-bottom-2',
        'description' => esc_html__('Add widgets here.', 'store99'),
        'before_widget' => '<section id="%1$s" class="widget %2$s">',
        'after_widget' => '</section>',
        'before_title' => '<h6 class="widget-title">',
        'after_title' => '</h6>',
    ));
}

add_action('widgets_init', 'store99_widgets_init');

/**
 * Enqueue scripts and styles.
 */
function store99_scripts()
{
    $store99_theme = wp_get_theme();
    $theme_version = $store99_theme->get('Version');

	/**
	 * Styles
	 */
    wp_enqueue_style('store99_montserrat', 'https://fonts.googleapis.com/css?family=Montserrat:400,500,700');
    wp_enqueue_style('poppins', 'https://fonts.googleapis.com/css?family=Poppins:400,500,600,700');
    wp_enqueue_style('lato', 'https://fonts.googleapis.com/css?family=Lato:400,700');
    wp_enqueue_style('bootstrap', get_template_directory_uri() . '/css/bootstrap.min.css');
    wp_enqueue_style('font-awesome', get_template_directory_uri() . '/css/font-awesome.min.css');
    wp_enqueue_style('owl-carousel', get_template_directory_uri() . '/css/owl.carousel.min.css');
    wp_enqueue_style('owl-carousel-theme', get_template_directory_uri() . '/css/owl.theme.default.min.css');
    wp_enqueue_style('flexslider', get_template_directory_uri() . '/css/flexslider.css');
    wp_enqueue_style('animate', get_template_directory_uri() . '/css/animate.min.css');
    wp_enqueue_style('store99-reset', get_template_directory_uri() . '/css/reset.css');
    wp_enqueue_style('store99-theme-style', get_template_directory_uri() . '/css/etstyle.css');
    wp_enqueue_style('store99-style', get_stylesheet_uri());

    /**
     * Scripts
     */
	wp_enqueue_script('bootstrap', get_template_directory_uri() . '/js/bootstrap.min.js', array('jquery'), esc_attr($theme_version), true);
    wp_enqueue_script('store99-bootstrap-touch-slider', get_template_directory_uri() . '/js/bootstrap-touch-slider-min.js', array('jquery'), esc_attr($theme_version), true);
    wp_enqueue_script('owl-carousel', get_template_directory_uri() . '/js/owl.carousel.min.js', array('jquery'), esc_attr($theme_version), true);
    wp_enqueue_script('flexslider', get_template_directory_uri() . '/js/jquery.flexslider-min.js', array('jquery'), esc_attr($theme_version), true);
    wp_enqueue_script('typeahead', get_template_directory_uri() . '/js/typeahead.bundle.min.js', array('jquery'), esc_attr($theme_version), true);
    wp_enqueue_script('store99-app', get_template_directory_uri() . '/js/app.js', array('jquery'), esc_attr($theme_version), true);

    $store99_url = array('site_url' => site_url());
    wp_localize_script('store99-app', 'store99_url', $store99_url);

    wp_enqueue_script('store99-navigation', get_template_directory_uri() . '/js/navigation.js', array(), esc_attr($theme_version), true);

    wp_enqueue_script('store99-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), esc_attr($theme_version), true);

    if (is_singular() && comments_open() && get_option('thread_comments')) {
        wp_enqueue_script('comment-reply');
    }
}

add_action('wp_enqueue_scripts', 'store99_scripts');

/**
 * Enqueue admin scripts and styles
 */
function store99_wp_admin_style()
{
    $store99_theme = wp_get_theme();
    $theme_version = $store99_theme->get('Version');

    wp_register_style('store99-admin', get_template_directory_uri() . '/inc/css/store99-admin.css', false, $theme_version);
    wp_enqueue_style('store99-admin');
}

add_action('admin_enqueue_scripts', 'store99_wp_admin_style');

/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Additional features to allow styling of the templates.
 */
require get_template_directory() . '/inc/template-functions.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
require get_template_directory() . '/inc/jetpack.php';

/**
 * Include WooCommerce Functions
 */
include_once(ABSPATH . 'wp-admin/includes/plugin.php');
if (is_plugin_active('woocommerce/woocommerce.php')) {
    include_once(get_template_directory() . '/inc/woocommerce-settings.php');
}

/**
 * Load Store99 functions
 */
require get_template_directory() . '/inc/store99-functions.php';


/**
 * Load the TGM init file
 */
require_once(get_template_directory() . '/inc/admin/tgm-plugin-activation/tgm-init.php');

/**
 * 
 */
require_once(get_template_directory() . '/inc/widgets/store99-show-widget-fields.php');
require_once(get_template_directory() . '/inc/widgets/store99-update-widget-fields.php');

/**
 * Load Social Media Widgets
 */
include_once(get_template_directory() . '/inc/widgets/social-media-icons/class-social-icons.php');

/**
 * Load WooCommerce Category With Products Widgets
 */
if (store99_is_woocommerce_activated() == true)
	include_once(get_template_directory() . '/inc/widgets/woo-category-with-products/class-woo-category-with-products.php');

/**
 * Load WooCommerce Categories Widgets
 */
if (store99_is_woocommerce_activated() == true)
	include_once(get_template_directory() . '/inc/widgets/woo-categories/class-woo-categories.php');

/**
 * Load WooCommerce Single Product Layout Widget
 */
if (store99_is_woocommerce_activated() == true)
	include_once(get_template_directory() . '/inc/widgets/woo-single-layout-products/class-woo-single-layout-products.php');

/**
 * Load Services Widget
 */
include_once(get_template_directory() . '/inc/widgets/services-with-icons/class-services-with-icons.php');

/**
 * Load Brands Widget
 */
include_once(get_template_directory() . '/inc/widgets/brands-with-icons/class-brands-with-icons.php');

/**
 * Load Products Slider Widget
 */
if (store99_is_woocommerce_activated() == true)
	include_once(get_template_directory() . '/inc/widgets/woo-products-slider/class-woo-products-slider.php');

/**
 * Load Posts Widget
 */
include_once(get_template_directory() . '/inc/widgets/posts-slider/class-posts-slider.php');

/**
 * Load Bootstrap menu walker
 */
require_once get_template_directory() . '/inc/wp-bootstrap-navwalker.php';

/**
 * Load Hooks
 */
require_once(get_template_directory() . '/inc/breadcrumbs.php');
require_once(get_template_directory() . '/inc/hook-breadcrumbs.php');

/**
 * Add custom image sizes
 */

add_image_size('store99-slider-grid', 1600, 695, true);
add_image_size('store99-services-grid', 60, 60, true);
add_image_size('store99-woo-category-with-products-grid', 270, 410, true);
add_image_size('store99-product-small-slider-grid', 9999, 67);
add_image_size('store99-posts-slider-grid', 370, 240, true);
add_image_size('store99-post-single-grid', 9999, 500);
add_image_size('store99-product-single-layout-slider-grid', 327, 327);
add_image_size('store99-product-slider-grid', 230, 230);
add_image_size('store99-product-category-list-grid', 174, 174);
add_image_size('store99-product-slider-home-grid', 9999, 230);