<?php
/**
 * trendpress Theme Customizer.
 *
 * @package trendpress
 */

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function trendpress_customize_register( $wp_customize ) {
	$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
	$wp_customize->get_setting( 'header_textcolor' )->transport = 'postMessage';
    /** Upgrade to trendpress **/
    $wp_customize->register_section_type( 'trendpress_Link_Section' );
       
    // Register sections.
    $wp_customize->add_section(
        new trendpress_Link_Section(
            $wp_customize,
            'trendpress-pro',
            array(
                'title'    => esc_html__( 'Upgrade To trendpress Pro', 'trendpress' ),
                'pro_text' => esc_html__( 'Go Pro','trendpress' ),
                'pro_url'  => 'https://buzthemes.com/wordpress_themes/trendpress-pro/',
                'priority' => 1,
            )
        )
    ); 
       
    /** Theme Info section **/
    $wp_customize->add_section(
        'trendpress_theme_info_section',
        array(
            'title'		=> esc_html__( 'Theme Info', 'trendpress' ),
            'priority'  => 1,
        )
    ); 
    // More Themes
    $wp_customize->add_setting(
        'trendpress_por_information', 
        array(
            'type'              => 'theme_info',
            'capability'        => 'edit_theme_options',
            'sanitize_callback' => 'esc_attr',
        )
    ); 
    $wp_customize->add_control( new trendpress_Theme_Info( 
        $wp_customize ,
        'trendpress_por_information',
            array(
              'label' => esc_html__( 'trendpress Pro Theme' , 'trendpress' ),
              'section' => 'trendpress_theme_info_section',
            )
        )
    ); 
}
add_action( 'customize_register', 'trendpress_customize_register' );

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function trendpress_customize_preview_js() {
	wp_enqueue_script( 'trendpress_customizer', get_template_directory_uri() . '/js/customizer.js', array( 'customize-preview' ), '20151215', true );
    /**
     * Customizer Font Live preview js
     */
    wp_enqueue_script( 'webfont', get_template_directory_uri() . '/js/webfont.js');
    /**
     * Customizer Live preview js
     */
    wp_enqueue_script('trendpress-live-preview',get_template_directory_uri().'/js/customizer-live-preview.js',array( 'jquery','customize-preview' ),true);
}
add_action( 'customize_preview_init', 'trendpress_customize_preview_js' );


    if( class_exists( 'WP_Customize_Control' ) ):
    /**
     * Theme info
     */
    class trendpress_Theme_Info extends WP_Customize_Control {
        public function render_content(){

            $our_theme_infos = array(
                'demo' => array(
                   'link' => esc_url( 'http://themeruler.com/demo/trendpress-pro' ),
                   'text' => esc_html__( 'View Demo', 'trendpress' ),
                ),
                'documentation' => array(
                   'link' => esc_url( 'http://themeruler.com/documentation/trendpress-pro/' ),
                   'text' => esc_html__( 'Documentation', 'trendpress' ),
                ),
                'support' => array(
                   'link' => esc_url( 'https://buzthemes.com/forums/forum/trendpress-pro/' ),
                   'text' => esc_html__( 'Support', 'trendpress' ),
                ),
            );
            foreach ( $our_theme_infos as $our_theme_info ) {
                echo '<p><a target="_blank" href="' . $our_theme_info['link'] . '" >' . esc_html( $our_theme_info['text'] ) . ' </a></p>';
            }
        ?>
        	<label>
        	    <h2 class="customize-title"><?php echo esc_html( $this->label ); ?></h2>
        	    <span class="customize-text_editor_desc">                 
        	        <ul class="admin-pro-feature-list">
        	            <li><span><?php esc_html_e('Modern and elegant design','trendpress'); ?> </span></li>
                        <li><span><?php esc_html_e('4 Homepage Layouts','trendpress'); ?> </span></li>
        	            <li><span><?php esc_html_e('100% Responsive theme','trendpress'); ?> </span></li>
        	            <li><span><?php esc_html_e('Advanced Typography','trendpress'); ?> </span></li>
        	            <li><span><?php esc_html_e('Breadcrumb Settings','trendpress'); ?> </span></li>
        	            <li><span><?php esc_html_e('Highly configurable home page','trendpress'); ?> </span></li>
        	            <li><span><?php esc_html_e('Four Footer Widget Areas','trendpress'); ?> </span></li>
        	            <li><span><?php esc_html_e('Sidebar Options','trendpress'); ?> </span></li>
        	            <li><span><?php esc_html_e('Translation ready','trendpress'); ?> </span></li>
                        <li><span><?php esc_html_e('WordPress Live Customizer Based','trendpress'); ?> </span></li>
        	        </ul>
        	        <?php $trendpress_pro_link = 'https://buzthemes.com/wordpress_themes/trendpress-pro-multipurpose-theme/'; ?>
        	        <a href="<?php echo esc_url($trendpress_pro_link); ?>" class="button button-primary buynow" target="_blank"><?php esc_html_e('Buy Now','trendpress'); ?></a>
        	    </span>
        	</label>
        <?php
        }
    }
    
    /**  trendpressPro Link **/
        class trendpress_Link_Section extends WP_Customize_Section {
    
            public $type = 'trendpress-pro';
    
            public $pro_text = '';
    
            public $pro_url = '';
    
            public function json() {
                $json = parent::json();
                $json['pro_text'] = $this->pro_text;
                $json['pro_url']  = esc_url( $this->pro_url );
                return $json;
            }
            protected function render_template() { ?>
    
                <li id="custom-section-{{ data.id }}" class="custom-section control-section control-section-{{ data.type }} cannot-expand">
                    <h3 class="custom-section-title">
                        {{ data.title }}
                        <# if ( data.pro_text && data.pro_url ) { #>
                            <a href="{{ data.pro_url }}" class="button button-custom alignright" target="_blank">{{ data.pro_text }}</a>
                        <# } #>
                    </h3>
                </li>
            <?php }
        }
    endif;