<?php
/**
 * Store 99 Theme Customizer
 *
 * @package Store_99
 */

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function store99_customize_register( $wp_customize ) {
	$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
	$wp_customize->get_setting( 'header_textcolor' )->transport = 'postMessage';

	/**
	 * General Section
	 */
	$wp_customize->add_section(
		'store99_sec_general_options',
		array(
			'title'    => __( 'General', 'store99' ),
			'priority' => 35,
		)
	);

	$wp_customize->add_setting(
		'store99_enable_loading_overlay',
		array(
			'default'           => true,
			'sanitize_callback' => 'store99_sanitize_checkbox'
		)
	);

	$wp_customize->add_control(
		'store99_enable_loading_overlay', array(
			'settings' => 'store99_enable_loading_overlay',
			'label'    => __( 'Show Loading Overlay', 'store99' ),
			'section'  => 'store99_sec_general_options',
			'type'     => 'checkbox',
		)
	);

	/**
	 * Header Settings
	 */
	$wp_customize->add_panel( 'store99_header_panel', array(
		'priority'       => 36,
		'capability'     => 'edit_theme_options',
		'theme_supports' => '',
		'title'          => __( 'Header Settings', 'store99' ),
	) );

	/**
	 * Header Top
	 */
	$wp_customize->add_section(
		'store99_sec_header_top_options',
		array(
			'title'    => __( 'Header Top', 'store99' ),
			'priority' => 0,
			'panel'    => 'store99_header_panel'
		)
	);

	$wp_customize->add_setting(
		'store99_enable_header_top',
		array(
			'sanitize_callback' => 'store99_sanitize_checkbox'
		)
	);

	$wp_customize->add_control(
		'store99_enable_header_top', array(
			'settings' => 'store99_enable_header_top',
			'label'    => __( 'Show Header Top', 'store99' ),
			'section'  => 'store99_sec_header_top_options',
			'type'     => 'checkbox',
		)
	);

	$wp_customize->add_setting(
		'store99_email',
		array(
			'sanitize_callback' => 'sanitize_text_field'
		)
	);

	$wp_customize->add_control(
		'store99_email', array(
			'settings' => 'store99_email',
			'label'    => __( 'Email', 'store99' ),
			'section'  => 'store99_sec_header_top_options',
			'type'     => 'text'
		)
	);

	$wp_customize->add_setting(
		'store99_phone',
		array(
			'sanitize_callback' => 'sanitize_text_field'
		)
	);

	$wp_customize->add_control(
		'store99_phone', array(
			'settings' => 'store99_phone',
			'label'    => __( 'Phone', 'store99' ),
			'section'  => 'store99_sec_header_top_options',
			'type'     => 'text'
		)
	);

	$wp_customize->add_setting(
		'store99_address',
		array(
			'sanitize_callback' => 'sanitize_text_field'
		)
	);

	$wp_customize->add_control(
		'store99_address', array(
			'settings' => 'store99_address',
			'label'    => __( 'Address', 'store99' ),
			'section'  => 'store99_sec_header_top_options',
			'type'     => 'text'
		)
	);

	/**
	 * Header Middle
	 */
	$wp_customize->add_section(
		'store99_sec_header_middle_options',
		array(
			'title'    => __( 'Header Middle', 'store99' ),
			'priority' => 0,
			'panel'    => 'store99_header_panel'
		)
	);

	$wp_customize->add_setting(
		'store99_enable_mini_cart',
		array(
			'default'           => true,
			'sanitize_callback' => 'store99_sanitize_checkbox'
		)
	);

	$wp_customize->add_control(
		'store99_enable_mini_cart', array(
			'settings' => 'store99_enable_mini_cart',
			'label'    => __( 'Show Mini Cart', 'store99' ),
			'section'  => 'store99_sec_header_middle_options',
			'type'     => 'checkbox',
		)
	);

	$wp_customize->add_setting(
		'store99_enable_search_form',
		array(
			'default'           => true,
			'sanitize_callback' => 'store99_sanitize_checkbox'
		)
	);

	$wp_customize->add_control(
		'store99_enable_search_form', array(
			'settings' => 'store99_enable_search_form',
			'label'    => __( 'Show Search Form', 'store99' ),
			'section'  => 'store99_sec_header_middle_options',
			'type'     => 'checkbox',
		)
	);

	// Slider panel
	$wp_customize->add_panel( 'store99_slider_panel', array(
		'priority'       => 37,
		'capability'     => 'edit_theme_options',
		'theme_supports' => '',
		'title'          => __( 'Main Slider', 'store99' ),
	) );

	$wp_customize->add_section(
		'store99_sec_slider_options',
		array(
			'title'    => __( 'Enable/Disable', 'store99' ),
			'priority' => 0,
			'panel'    => 'store99_slider_panel'
		)
	);


	$wp_customize->add_setting(
		'store99_main_slider_enable',
		array( 'sanitize_callback' => 'store99_sanitize_checkbox' )
	);

	$wp_customize->add_control(
		'store99_main_slider_enable', array(
			'settings' => 'store99_main_slider_enable',
			'label'    => __( 'Enable Slider on HomePage.', 'store99' ),
			'section'  => 'store99_sec_slider_options',
			'type'     => 'checkbox',
		)
	);


	$wp_customize->add_setting(
		'store99_main_slider_count',
		array(
			'default'           => '0',
			'sanitize_callback' => 'store99_sanitize_positive_number'
		)
	);

	// Select How Many Slides the User wants, and Reload the Page.
	$wp_customize->add_control(
		'store99_main_slider_count', array(
			'settings'    => 'store99_main_slider_count',
			'label'       => __( 'No. of Slides(Min:0, Max: 3)', 'store99' ),
			'section'     => 'store99_sec_slider_options',
			'type'        => 'number',
			'description' => __( 'Save the Settings, and Reload this page to Configure the Slides.', 'store99' ),

		)
	);

	for ( $i = 1; $i <= 3; $i ++ ) :

		//Create the settings Once, and Loop through it.
		static $x = 0;
		$wp_customize->add_section(
			'store99_slide_sec' . $i,
			array(
				'title'           => __( 'Slide ', 'store99' ) . $i,
				'priority'        => $i,
				'panel'           => 'store99_slider_panel',
				'active_callback' => 'store99_show_slide_sec'

			)
		);

		$wp_customize->add_setting(
			'store99_slide_img' . $i,
			array( 'sanitize_callback' => 'esc_url_raw' )
		);

		$wp_customize->add_control(
			new WP_Customize_Image_Control(
				$wp_customize,
				'store99_slide_img' . $i,
				array(
					'label'    => '',
					'section'  => 'store99_slide_sec' . $i,
					'settings' => 'store99_slide_img' . $i,
				)
			)
		);

		$wp_customize->add_setting(
			'store99_slide_title' . $i,
			array( 'sanitize_callback' => 'sanitize_text_field' )
		);

		$wp_customize->add_control(
			'store99_slide_title' . $i, array(
				'settings' => 'store99_slide_title' . $i,
				'label'    => __( 'Slide Title', 'store99' ),
				'section'  => 'store99_slide_sec' . $i,
				'type'     => 'text',
			)
		);

		$wp_customize->add_setting(
			'store99_slide_desc' . $i,
			array( 'sanitize_callback' => 'sanitize_text_field' )
		);

		$wp_customize->add_control(
			'store99_slide_desc' . $i, array(
				'settings' => 'store99_slide_desc' . $i,
				'label'    => __( 'Slide Description', 'store99' ),
				'section'  => 'store99_slide_sec' . $i,
				'type'     => 'text',
			)
		);


		$wp_customize->add_setting(
			'store99_slide_button_text' . $i,
			array( 'sanitize_callback' => 'sanitize_text_field' )
		);

		$wp_customize->add_control(
			'store99_slide_button_text' . $i, array(
				'settings' => 'store99_slide_button_text' . $i,
				'label'    => __( 'Button Text(Optional)', 'store99' ),
				'section'  => 'store99_slide_sec' . $i,
				'type'     => 'text',
			)
		);

		$wp_customize->add_setting(
			'store99_slide_button_link' . $i,
			array( 'sanitize_callback' => 'esc_url_raw' )
		);

		$wp_customize->add_control(
			'store99_slide_button_link' . $i, array(
				'settings' => 'store99_slide_button_link' . $i,
				'label'    => __( 'Target URL', 'store99' ),
				'section'  => 'store99_slide_sec' . $i,
				'type'     => 'url',
			)
		);

	endfor;

	// Active callback to see if the slide section is to be displayed or not
	function store99_show_slide_sec( $control ) {
		$option = $control->manager->get_setting( 'store99_main_slider_count' );
		global $x;
		if ( $x < $option->value() ) {
			$x ++;

			return true;
		}
	}

	/**
	 * WooCommerce Settings
	 */
	$wp_customize->add_panel( 'store99_woocommerce_panel', array(
		'priority'       => 38,
		'capability'     => 'edit_theme_options',
		'theme_supports' => '',
		'title'          => __( 'WooCommerce', 'store99' ),
	) );

	/**
	 * Product Archive
	 */
	$wp_customize->add_section(
		'store99_sec_product_archive_options',
		array(
			'title'    => __( 'Product Archive', 'store99' ),
			'priority' => 0,
			'panel'    => 'store99_woocommerce_panel'
		)
	);

	$wp_customize->add_setting(
		'store99_archive_enable_right_sidebar',
		array(
			'default'           => true,
			'sanitize_callback' => 'store99_sanitize_checkbox'
		)
	);

	$wp_customize->add_control(
		'store99_archive_enable_right_sidebar', array(
			'settings' => 'store99_archive_enable_right_sidebar',
			'label'    => __( 'Show Right Sidebar', 'store99' ),
			'section'  => 'store99_sec_product_archive_options',
			'type'     => 'checkbox',
		)
	);

	$wp_customize->add_setting(
		'store99_products_per_page',
		array(
			'default'           => '12,24,36',
			'sanitize_callback' => 'sanitize_text_field'
		)
	);

	$wp_customize->add_control(
		'store99_products_per_page', array(
			'settings'    => 'store99_products_per_page',
			'label'       => __( 'Products Per Page', 'store99' ),
			'section'     => 'store99_sec_product_archive_options',
			'type'        => 'text',
			'description' => __( 'Comma separated list of product counts.', 'store99' ),
		)
	);

	/**
	 * Single Product
	 */
	$wp_customize->add_section(
		'store99_sec_single_product_options',
		array(
			'title'    => __( 'Single Product', 'store99' ),
			'priority' => 0,
			'panel'    => 'store99_woocommerce_panel'
		)
	);

	$wp_customize->add_setting(
		'store99_product_single_enable_right_sidebar',
		array(
			'default'           => true,
			'sanitize_callback' => 'store99_sanitize_checkbox'
		)
	);

	$wp_customize->add_control(
		'store99_product_single_enable_right_sidebar', array(
			'settings' => 'store99_product_single_enable_right_sidebar',
			'label'    => __( 'Show Right Sidebar', 'store99' ),
			'section'  => 'store99_sec_single_product_options',
			'type'     => 'checkbox',
		)
	);

	$wp_customize->add_setting(
		'store99_enable_short_description',
		array(
			'default'           => true,
			'sanitize_callback' => 'store99_sanitize_checkbox'
		)
	);

	$wp_customize->add_control(
		'store99_enable_short_description', array(
			'settings' => 'store99_enable_short_description',
			'label'    => __( 'Show Short Description', 'store99' ),
			'section'  => 'store99_sec_single_product_options',
			'type'     => 'checkbox',
		)
	);

	$wp_customize->add_setting(
		'store99_enable_product_tabs',
		array(
			'default'           => true,
			'sanitize_callback' => 'store99_sanitize_checkbox'
		)
	);

	$wp_customize->add_control(
		'store99_enable_product_tabs', array(
			'settings' => 'store99_enable_product_tabs',
			'label'    => __( 'Show Products Tabs', 'store99' ),
			'section'  => 'store99_sec_single_product_options',
			'type'     => 'checkbox',
		)
	);

	$wp_customize->add_setting(
		'store99_enable_related_products',
		array(
			'default'           => true,
			'sanitize_callback' => 'store99_sanitize_checkbox'
		)
	);

	$wp_customize->add_control(
		'store99_enable_related_products', array(
			'settings' => 'store99_enable_related_products',
			'label'    => __( 'Show Related Products', 'store99' ),
			'section'  => 'store99_sec_single_product_options',
			'type'     => 'checkbox',
		)
	);

	/**
	 * Cart Page
	 */
	$wp_customize->add_section(
		'store99_sec_cart_options',
		array(
			'title'    => __( 'Cart Page', 'store99' ),
			'priority' => 0,
			'panel'    => 'store99_woocommerce_panel'
		)
	);

	$wp_customize->add_setting(
		'store99_enable_cross_sells',
		array(
			'default'           => true,
			'sanitize_callback' => 'store99_sanitize_checkbox'
		)
	);

	$wp_customize->add_control(
		'store99_enable_cross_sells', array(
			'settings' => 'store99_enable_cross_sells',
			'label'    => __( 'Show Cross Sells', 'store99' ),
			'section'  => 'store99_sec_cart_options',
			'type'     => 'checkbox',
		)
	);

	$wp_customize->add_setting(
		'store99_cart_cross_sells_count',
		array(
			'default'           => '8',
			'sanitize_callback' => 'sanitize_text_field'
		)
	);

	$wp_customize->add_control(
		'store99_cart_cross_sells_count', array(
			'settings' => 'store99_cart_cross_sells_count',
			'label'    => __( 'Cross Sells Count', 'store99' ),
			'section'  => 'store99_sec_cart_options',
			'type'     => 'text'
		)
	);

	/**
	 * Footer Section
	 */
	$wp_customize->add_section(
		'store99_sec_footer_options',
		array(
			'title'    => __( 'Footer', 'store99' ),
			'priority' => 39,
		)
	);

	$wp_customize->add_setting(
		'store99_enable_payments_logo',
		array(
			'sanitize_callback' => 'store99_sanitize_checkbox'
		)
	);

	$wp_customize->add_control(
		'store99_enable_payments_logo', array(
			'settings' => 'store99_enable_payments_logo',
			'label'    => __( 'Show Payments Logos', 'store99' ),
			'section'  => 'store99_sec_footer_options',
			'type'     => 'checkbox',
		)
	);

	$wp_customize->add_setting(
		'store99_payments_image',
		array( 'sanitize_callback' => 'esc_url_raw' )
	);

	$wp_customize->add_control(
		new WP_Customize_Image_Control(
			$wp_customize,
			'store99_payments_image',
			array(
				'label'    => '',
				'section'  => 'store99_sec_footer_options',
				'settings' => 'store99_payments_image',
			)
		)
	);

	$wp_customize->add_setting(
		'store99_payments_image_title',
		array(
			'sanitize_callback' => 'sanitize_text_field'
		)
	);

	$wp_customize->add_control(
		'store99_payments_image_title', array(
			'settings' => 'store99_payments_image_title',
			'label'    => __( 'Payments Image Title', 'store99' ),
			'section'  => 'store99_sec_footer_options',
			'type'     => 'text'
		)
	);

	$wp_customize->add_setting(
		'store99_payments_image_link',
		array(
			'sanitize_callback' => 'esc_url_raw'
		)
	);

	$wp_customize->add_control(
		'store99_payments_image_link', array(
			'settings' => 'store99_payments_image_link',
			'label'    => __( 'Payments Image Link', 'store99' ),
			'section'  => 'store99_sec_footer_options',
			'type'     => 'url'
		)
	);

	/**
	 * Help & Support Section
	 */
	$wp_customize->add_section(
		'store99_sec_help_support_options',
		array(
			'title'    => __( 'Store99 - Help & Support', 'store99' ),
			'priority' => 39,
		)
	);

	$wp_customize->add_setting(
		'store99_help_support',
		array(
			'sanitize_callback' => 'esc_textarea'
		)
	);

	$wp_customize->add_control(
		new Store99_WP_Customize_Upgrade_Control(
			$wp_customize,
			'store99_help_support',
			array(
				'label' => __('Thank You','store99'),
				'description' => '',
				'section' => 'store99_sec_help_support_options',
				'settings' => 'store99_help_support',
			)
		)
	);

	/**
	 * Sanitization Functions Common to Multiple Settings go Here,
	 * Specific Sanitization Functions are defined along with add_setting()
	 */
	/**
	 * @param $input
	 *
	 * @return int|string
	 */
	function store99_sanitize_checkbox( $input ) {
		if ( $input == 1 ) {
			return 1;
		} else {
			return '';
		}
	}

	function store99_sanitize_positive_number( $input ) {
		if ( ( $input >= 0 ) && is_numeric( $input ) ) {
			return $input;
		} else {
			return '';
		}
	}
}

add_action( 'customize_register', 'store99_customize_register' );

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function store99_customize_preview_js() {
	wp_enqueue_script( 'store99_customizer', get_template_directory_uri() . '/js/customizer.js', array( 'customize-preview' ), '20151215', true );
}

add_action( 'customize_preview_init', 'store99_customize_preview_js' );
