<?php
$trendpress_cat_list = trendpress_Category_list();
$trendpress_posts_list = trendpress_Posts_List();
$trendpress_font_size = trendpress_font_size();
$trendpress_fonts = trendpress_fonts();
 
 /** Customizers Panels **/
 $wp_customize->add_panel(
    'trendpress_general_panel',array(
        'title' => esc_html__('General Setting','trendpress'),
        'priority' => 2,
    )
 );
 $wp_customize->add_panel(
    'trendpress_header_panel',array(
        'title' => esc_html__('Header Setting','trendpress'),
        'description' => esc_html__('All The Header Setting Available Here','trendpress'),
        'priority' => 2,
    )
 );
 $wp_customize->add_panel(
    'trendpress_home_panel',
    array(
        'title' => esc_html__('Home Setting','trendpress'),
        'description' => esc_html__('All The Setting For Home Sections','trendpress'),
        'priority' => 3
    )
 );
 $wp_customize->add_panel(
    'trendpress_typography_panel',
    array(
        'title' => esc_html__('Typography Setting','trendpress'),
        'priority' => 5
    )
 );
 $wp_customize->add_panel(
    'trendpress_footer_panel',
    array(
        'title' => esc_html__('Footer Setting','trendpress'),
        'priority' => 4
    )
 );
 
 /** Customizer Sections **/
 $wp_customize->add_section(
    'trendpress_menu_section',
    array(
        'title' => esc_html__('Menu Section','trendpress'),
        'description' => esc_html__('All The Settings For Menu','trendpress'),
        'priority' => 3,
        'panel' => 'trendpress_header_panel',
        'capability' => 'edit_theme_options',
        'theme_support' => ''
    )
 );
 $wp_customize->add_section(
    'trendpress_slider_section',
    array(
        'title' => esc_html__('Slider Section','trendpress'),
        'description' => esc_html__('All The Settings For Slider','trendpress'),
        'priority' => 5,
        'panel' => 'trendpress_header_panel',
        'capability' => 'edit_theme_options',
        'theme_support' => ''
    )
 );
 $wp_customize->add_section(
    'trendpress_page_section',
    array(
        'title' => esc_html__('Page Breadcrumb','trendpress'),
        'priority' => 6,
        'panel' => 'trendpress_general_panel',
        'capability' => 'edit_theme_options',
        'theme_support' => ''
    )
 );
 $wp_customize->add_section(
    'trendpress_about_section',
    array(
        'title' => esc_html__('About Us Section','trendpress'),
        'priority' => 3,
        'panel' => 'trendpress_home_panel',
        'capability' => 'edit_theme_options',
        'theme_support' => ''
    )
 );
 $wp_customize->add_section(
    'trendpress_feature_section',
    array(
        'title' => esc_html__('Feature Section','trendpress'),
        'priority' => 6,
        'panel' => 'trendpress_home_panel',
        'capability' => 'edit_theme_options',
        'theme_support' => ''
    )
 );
 $wp_customize->add_section(
    'trendpress_team_section',
    array(
        'title' => esc_html__('Team Section','trendpress'),
        'priority' => 8,
        'panel' => 'trendpress_home_panel',
        'capability' => 'edit_theme_options',
        'theme_support' => ''
    )
 );
 $wp_customize->add_section(
    'trendpress_portfolio_section',
    array(
        'title' => esc_html__('Portfolio Section','trendpress'),
        'priority' => 10,
        'panel' => 'trendpress_home_panel',
        'capability' => 'edit_theme_options',
        'theme_support' => ''
    )
 );
 $wp_customize->add_section(
    'trendpress_blog_section',
    array(
        'title' => esc_html__('Blog Section','trendpress'),
        'priority' => 12,
        'panel' => 'trendpress_home_panel',
        'capability' => 'edit_theme_options',
        'theme_support' => ''
    )
 );
 $wp_customize->add_section(
    'trendpress_cta_section',
    array(
        'title' => esc_html__('Call To Action Section','trendpress'),
        'priority' => 14,
        'panel' => 'trendpress_home_panel',
        'capability' => 'edit_theme_options',
        'theme_support' => ''
    )
 );
 $wp_customize->add_section(
    'trendpress_shop_section',
    array(
        'title' => esc_html__('Shop Section','trendpress'),
        'priority' => 15,
        'panel' => 'trendpress_home_panel',
        'capability' => 'edit_theme_options',
        'theme_support' => ''
    )
 );
 $wp_customize->add_section(
    'trendpress_testimonial_section',
    array(
        'title' => esc_html__('Testimonial Section','trendpress'),
        'priority' => 16,
        'panel' => 'trendpress_home_panel',
        'capability' => 'edit_theme_options',
        'theme_support' => ''
    )
 );
 $wp_customize->add_section(
    'trendpress_client_section',
    array(
        'title' => esc_html__('Client Section','trendpress'),
        'priority' => 18,
        'panel' => 'trendpress_home_panel',
        'capability' => 'edit_theme_options',
        'theme_support' => ''
    )
 );
 $wp_customize->add_section(
    'trendpress_bottom_footer_section',
    array(
        'title' => esc_html__('Bottom Footer Section','trendpress'),
        'priority' => 4,
        'panel' => 'trendpress_footer_panel',
        'capability' => 'edit_theme_options',
        'theme_support' => ''
    )
 );
 $wp_customize->add_section(
    'trendpress_body_typography_section',
    array(
        'title' => esc_html__('Body','trendpress'),
        'priority' => 4,
        'panel' => 'trendpress_typography_panel',
        'capability' => 'edit_theme_options',
        'theme_support' => ''
    )
 );
 $wp_customize->add_section(
    'trendpress_h1_typography_section',
    array(
        'title' => esc_html__('Heading 1','trendpress'),
        'priority' => 5,
        'panel' => 'trendpress_typography_panel',
        'capability' => 'edit_theme_options',
        'theme_support' => ''
    )
 );
 $wp_customize->add_section(
    'trendpress_h2_typography_section',
    array(
        'title' => esc_html__('Heading 2','trendpress'),
        'priority' => 6,
        'panel' => 'trendpress_typography_panel',
        'capability' => 'edit_theme_options',
        'theme_support' => ''
    )
 );
 $wp_customize->add_section(
    'trendpress_h3_typography_section',
    array(
        'title' => esc_html__('Heading 3','trendpress'),
        'priority' => 7,
        'panel' => 'trendpress_typography_panel',
        'capability' => 'edit_theme_options',
        'theme_support' => ''
    )
 );
 $wp_customize->add_section(
    'trendpress_h4_typography_section',
    array(
        'title' => esc_html__('Heading 4','trendpress'),
        'priority' => 8,
        'panel' => 'trendpress_typography_panel',
        'capability' => 'edit_theme_options',
        'theme_support' => ''
    )
 );
 $wp_customize->add_section(
    'trendpress_h5_typography_section',
    array(
        'title' => esc_html__('Heading 5','trendpress'),
        'priority' => 9,
        'panel' => 'trendpress_typography_panel',
        'capability' => 'edit_theme_options',
        'theme_support' => ''
    )
 );
 $wp_customize->add_section(
    'trendpress_h6_typography_section',
    array(
        'title' => esc_html__('Heading 6','trendpress'),
        'priority' => 10,
        'panel' => 'trendpress_typography_panel',
        'capability' => 'edit_theme_options',
        'theme_support' => ''
    )
 );

 /** Customizer Settings And Control **/
 $wp_customize->add_setting(
    'trendpress_search_enable',
    array(
        'default' => '',
        'sanitize_callback' => 'trendpress_sanitize_checkbox'
    )
 );
 $wp_customize->add_control(
    'trendpress_search_enable',
    array(
        'label' => esc_html__('Check Enable Search On Menu','trendpress'),
        'priority' => 2,
        'type' => 'checkbox',
        'section' => 'trendpress_menu_section'
    )
 );
 $wp_customize->add_setting(
    'trendpress_slider_enable',
    array(
        'default' => '',
        'sanitize_callback' => 'trendpress_sanitize_checkbox'
    )
 );
 $wp_customize->add_control(
    'trendpress_slider_enable',
    array(
        'label' => esc_html__('Check Enable Slider','trendpress'),
        'priority' => 1,
        'type' => 'checkbox',
        'section' => 'trendpress_slider_section'
    )
 );
 $wp_customize->add_setting(
    'trendpress_slider_cat',
    array(
        'default' => '',
        'sanitize_callback' => 'trendpress_sanitize_post_cat_list',
    )
 );
 $wp_customize->add_control(
    'trendpress_slider_cat',
    array(
        'label' => esc_html__('Slider Category','trendpress'),
        'priority' => 3,
        'type' => 'select',
        'choices' => $trendpress_cat_list,
        'section' => 'trendpress_slider_section'
    )
 );
 $wp_customize->add_setting(
    'trendpress_page_bg_image',
    array(
        'default' => '',
        'sanitize_callback' => 'esc_url_raw'
    )
 );
 $wp_customize->add_control(
       new WP_Customize_Image_Control(
           $wp_customize,
           'trendpress_page_bg_image',
           array(
               'label'      => esc_html__( 'Page Breadcrumb Backgeound Image', 'trendpress' ),
               'section'    => 'trendpress_page_section',
               'settings'   => 'trendpress_page_bg_image',
               'priority' => 10,
           )
       )
   );
 $wp_customize->add_setting(
    'trendpress_about_enable',
    array(
        'default' => '',
        'sanitize_callback' => 'trendpress_sanitize_checkbox'
    )
 );
 $wp_customize->add_control(
    'trendpress_about_enable',
    array(
        'label' => esc_html__('Enable About US','trendpress'),
        'priority' => 1,
        'type' => 'checkbox',
        'section' => 'trendpress_about_section'
    )
 );
 $wp_customize->add_setting(
    'trendpress_about_title',
    array(
        'default' => '',
        'sanitize_callback' => 'sanitize_text_field',
        'transport'=>'postMessage',
    )
 );
 $wp_customize->add_control(
    'trendpress_about_title',
    array(
        'label' => esc_html__('About Us Section Title','trendpress'),
        'type' => 'text',
        'priority' => 4,
        'section' => 'trendpress_about_section'
    )
 );
 $wp_customize->add_setting(
    'trendpress_about_sub_title',
    array(
        'default' => '',
        'transport'=>'postMessage',
        'sanitize_callback' => 'sanitize_text_field'
    )
 );
 $wp_customize->add_control(
    'trendpress_about_sub_title',
    array(
        'label' => esc_html__('About Us Section Sub Title','trendpress'),
        'type' => 'text',
        'priority' => 6,
        'section' => 'trendpress_about_section'
    )
 );
  $wp_customize->add_setting(
    'trendpress_about_post',
    array(
        'default' => '',
        'sanitize_callback' => 'trendpress_sanitize_post_select',
    )
  );
  $wp_customize->add_control(
    'trendpress_about_post',
    array(
        'label' => esc_html__('About Us Post','trendpress'),
        'type' => 'select',
        'choices' => $trendpress_posts_list,
        'section' => 'trendpress_about_section',
        'priority' => 10
    )
  );
 $wp_customize->add_setting(
    'trendpress_feature_enable',
    array(
        'default' => '',
        'sanitize_callback' => 'trendpress_sanitize_checkbox'
    )
 );
 $wp_customize->add_control(
    'trendpress_feature_enable',
    array(
        'label' => esc_html__('Enable Feature Section','trendpress'),
        'type' => 'checkbox',
        'priority' => '2',
        'section' => 'trendpress_feature_section'
    )
 );
$wp_customize->add_setting(
    'trendpress_feature_title',
    array(
        'default' => '',
        'transport'=>'postMessage',
        'sanitize_callback' => 'sanitize_text_field'
    )
 );
 $wp_customize->add_control(
    'trendpress_feature_title',
    array(
        'label' => esc_html__('Feature Section Title','trendpress'),
        'type' => 'text',
        'priority' => 4,
        'section' => 'trendpress_feature_section'
    )
 );
 $wp_customize->add_setting(
    'trendpress_feature_sub_title',
    array(
        'default' => '',
        'transport'=>'postMessage',
        'sanitize_callback' => 'sanitize_text_field'
    )
 );
 $wp_customize->add_control(
    'trendpress_feature_sub_title',
    array(
        'label' => esc_html__('Feature Section Sub Title','trendpress'),
        'type' => 'text',
        'priority' => 6,
        'section' => 'trendpress_feature_section'
    )
 );
 $wp_customize->add_setting(
    'trendpress_feature_cat',
    array(
        'default' => '',
        'sanitize_callback' => 'trendpress_sanitize_post_cat_list'
    )
 );
 $wp_customize->add_control(
    'trendpress_feature_cat',
    array(
        'label' => esc_html__('Feature Post Category','trendpress'),
        'type' => 'select',
        'choices' => $trendpress_cat_list,
        'section' => 'trendpress_feature_section',
        'priority' => 8,
    )
 );
 
 $wp_customize->add_setting(
    'trendpress_team_enable',
    array(
        'default' => '',
        'sanitize_callback' => 'trendpress_sanitize_checkbox'
    )
 );
 $wp_customize->add_control(
    'trendpress_team_enable',
    array(
        'label' => esc_html__('Enable Team','trendpress'),
        'priority' => 1,
        'type' => 'checkbox',
        'section' => 'trendpress_team_section'
    )
 );
 $wp_customize->add_setting(
    'trendpress_team_title',
    array(
        'default' => '',
        'transport'=>'postMessage',
        'sanitize_callback' => 'sanitize_text_field'
    )
 );
 $wp_customize->add_control(
    'trendpress_team_title',
    array(
        'label' => esc_html__('Team Section Title','trendpress'),
        'type' => 'text',
        'priority' => 4,
        'section' => 'trendpress_team_section'
    )
 );
 $wp_customize->add_setting(
    'trendpress_team_sub_title',
    array(
        'default' => '',
        'transport'=>'postMessage',
        'sanitize_callback' => 'sanitize_text_field'
    )
 );
 $wp_customize->add_control(
    'trendpress_team_sub_title',
    array(
        'label' => esc_html__('Team Section Sub Title','trendpress'),
        'type' => 'text',
        'priority' => 6,
        'section' => 'trendpress_team_section'
    )
 );
 $wp_customize->add_setting(
    'trendpress_team_cat',
    array(
        'default' => '',
        'sanitize_callback' => 'trendpress_sanitize_post_cat_list'
    )
 );
 $wp_customize->add_control(
    'trendpress_team_cat',
    array(
        'label' => esc_html__('Team Post Category','trendpress'),
        'type' => 'select',
        'choices' => $trendpress_cat_list,
        'section' => 'trendpress_team_section',
        'priority' => 8,
    )
 );
 $wp_customize->add_setting(
    'trendpress_portfolio_enable',
    array(
        'default' => '',
        'sanitize_callback' => 'trendpress_sanitize_checkbox'
    )
 );
 $wp_customize->add_control(
    'trendpress_portfolio_enable',
    array(
        'label' => esc_html__('Enable Portfolio','trendpress'),
        'priority' => 1,
        'type' => 'checkbox',
        'section' => 'trendpress_portfolio_section'
    )
 );
 $wp_customize->add_setting(
    'trendpress_portfolio_title',
    array(
        'default' => '',
        'transport'=>'postMessage',
        'sanitize_callback' => 'sanitize_text_field'
    )
 );
 $wp_customize->add_control(
    'trendpress_portfolio_title',
    array(
        'label' => esc_html__('Portfolio Section Title','trendpress'),
        'type' => 'text',
        'priority' => 4,
        'section' => 'trendpress_portfolio_section'
    )
 );
 $wp_customize->add_setting(
    'trendpress_portfolio_sub_title',
    array(
        'default' => '',
        'transport'=>'postMessage',
        'sanitize_callback' => 'sanitize_text_field'
    )
 );
 $wp_customize->add_control(
    'trendpress_portfolio_sub_title',
    array(
        'label' => esc_html__('Portfolio Section Sub Title','trendpress'),
        'type' => 'text',
        'priority' => 6,
        'section' => 'trendpress_portfolio_section'
    )
 );
 $wp_customize->add_setting(
    'trendpress_portfolio_cat',
    array(
        'default' => '',
        'sanitize_callback' => 'trendpress_sanitize_post_cat_list'
    )
 );
 $wp_customize->add_control(
    'trendpress_portfolio_cat',
    array(
        'label' => esc_html__('Portfolio Post Category','trendpress'),
        'type' => 'select',
        'choices' => $trendpress_cat_list,
        'section' => 'trendpress_portfolio_section',
        'priority' => 8,
    )
 );
  $wp_customize->add_setting(
    'trendpress_blog_enable',
    array(
        'default' => '',
        'sanitize_callback' => 'trendpress_sanitize_checkbox'
    )
 );
 $wp_customize->add_control(
    'trendpress_blog_enable',
    array(
        'label' => esc_html__('Enable Bolog Section','trendpress'),
        'priority' => 1,
        'type' => 'checkbox',
        'section' => 'trendpress_blog_section'
    )
 );
 $wp_customize->add_setting(
    'trendpress_blog_title',
    array(
        'default' => '',
        'transport'=>'postMessage',
        'sanitize_callback' => 'sanitize_text_field'
    )
 );
 $wp_customize->add_control(
    'trendpress_blog_title',
    array(
        'label' => esc_html__('Blog Section Title','trendpress'),
        'type' => 'text',
        'priority' => 4,
        'section' => 'trendpress_blog_section'
    )
 );
 $wp_customize->add_setting(
    'trendpress_blog_sub_title',
    array(
        'default' => '',
        'transport'=>'postMessage',
        'sanitize_callback' => 'sanitize_text_field'
    )
 );
 $wp_customize->add_control(
    'trendpress_blog_sub_title',
    array(
        'label' => esc_html__('Blog Section Sub Title','trendpress'),
        'type' => 'text',
        'priority' => 6,
        'section' => 'trendpress_blog_section'
    )
 );
 $wp_customize->add_setting(
    'trendpress_blog_cat',
    array(
        'default' => '',
        'sanitize_callback' => 'trendpress_sanitize_post_cat_list'
    )
 );
 $wp_customize->add_control(
    'trendpress_blog_cat',
    array(
        'label' => esc_html__('Blog Post Category','trendpress'),
        'type' => 'select',
        'choices' => $trendpress_cat_list,
        'section' => 'trendpress_blog_section',
        'priority' => 8,
    )
 );
 $wp_customize->add_setting(
    'trendpress_cta_enable',
    array(
        'default' => '',
        'sanitize_callback' => 'trendpress_sanitize_checkbox'
    )
 );
 $wp_customize->add_control(
    'trendpress_cta_enable',
    array(
        'label' => esc_html__('Enable Call To Action Section','trendpress'),
        'priority' => 1,
        'type' => 'checkbox',
        'section' => 'trendpress_cta_section'
    )
 );
   $wp_customize->add_setting(
    'trendpress_cta_post',
    array(
        'default' => '',
        'sanitize_callback' => 'trendpress_sanitize_post_select',
    )
  );
  $wp_customize->add_control(
    'trendpress_cta_post',
    array(
        'label' => esc_html__('CTA Post','trendpress'),
        'type' => 'select',
        'choices' => $trendpress_posts_list,
        'section' => 'trendpress_cta_section',
        'priority' => 4
    )
  );
 $wp_customize->add_setting(
    'trendpress_cta_button_text',
    array(
        'default' => '',
        'transport'=>'postMessage',
        'sanitize_callback' => 'sanitize_text_field'
    )
 );
 $wp_customize->add_control(
    'trendpress_cta_button_text',
    array(
        'label' => esc_html__('Call To Action Button Text','trendpress'),
        'type' => 'text',
        'priority' => 8,
        'section' => 'trendpress_cta_section'
    )
 );
 $wp_customize->add_setting(
    'trendpress_cta_button_link',
    array(
        'default' => '',
        'sanitize_callback' => 'esc_url_raw'
    )
 );
 $wp_customize->add_control(
    'trendpress_cta_button_link',
    array(
        'label' => esc_html__('Call To Action Button Link','trendpress'),
        'type' => 'text',
        'priority' =>10,
        'section' => 'trendpress_cta_section'
    )
 );
 $wp_customize->add_setting(
    'trendpress_cta_button_text2',
    array(
        'default' => '',
        'transport'=>'postMessage',
        'sanitize_callback' => 'sanitize_text_field'
    )
 );
 $wp_customize->add_control(
    'trendpress_cta_button_text2',
    array(
        'label' => esc_html__('Call To Action Button Text Two','trendpress'),
        'type' => 'text',
        'priority' => 11,
        'section' => 'trendpress_cta_section'
    )
 );
 $wp_customize->add_setting(
    'trendpress_cta_button_link2',
    array(
        'default' => '',
        'sanitize_callback' => 'esc_url_raw'
    )
 );
 $wp_customize->add_control(
    'trendpress_cta_button_link2',
    array(
        'label' => esc_html__('Call To Action Button Link Two','trendpress'),
        'type' => 'text',
        'priority' =>14,
        'section' => 'trendpress_cta_section'
    )
 );
 $wp_customize->add_setting(
    'trendpress_cta_bg_image',
    array(
        'default' => '',
        'sanitize_callback' => 'esc_url_raw'
    )
 );
 $wp_customize->add_control(
       new WP_Customize_Image_Control(
           $wp_customize,
           'trendpress_cta_bg_image',
           array(
               'label'      => esc_html__( 'Section Background Image', 'trendpress' ),
               'section'    => 'trendpress_cta_section',
               'settings'   => 'trendpress_cta_bg_image',
               'priority' => 15,
           )
       )
   );
 $wp_customize->add_setting(
    'trendpress_shop_enable',
    array(
        'default' => '',
        'sanitize_callback' => 'trendpress_sanitize_checkbox'
    )
 );
 $wp_customize->add_control(
    'trendpress_shop_enable',
    array(
        'label' => esc_html__('Enable Shop Section','trendpress'),
        'priority' => 1,
        'type' => 'checkbox',
        'section' => 'trendpress_shop_section'
    )
 );
 $wp_customize->add_setting(
    'trendpress_shop_title',
    array(
        'default' => '',
        'transport'=>'postMessage',
        'sanitize_callback' => 'sanitize_text_field'
    )
 );
 $wp_customize->add_control(
    'trendpress_shop_title',
    array(
        'label' => esc_html__('Shop Section Title','trendpress'),
        'type' => 'text',
        'priority' => 4,
        'section' => 'trendpress_shop_section'
    )
 );
 $wp_customize->add_setting(
    'trendpress_shop_sub_title',
    array(
        'default' => '',
        'transport'=>'postMessage',
        'sanitize_callback' => 'sanitize_text_field'
    )
 );
 $wp_customize->add_control(
    'trendpress_shop_sub_title',
    array(
        'label' => esc_html__('Shop Section Sub Title','trendpress'),
        'type' => 'text',
        'priority' => 6,
        'section' => 'trendpress_shop_section'
    )
 );
 $wp_customize->add_setting(
    'trendpress_testimonial_enable',
    array(
        'default' => '',
        'sanitize_callback' => 'trendpress_sanitize_checkbox'
    )
 );
 $wp_customize->add_control(
    'trendpress_testimonial_enable',
    array(
        'label' => esc_html__('Enable Testimonial Section','trendpress'),
        'priority' => 1,
        'type' => 'checkbox',
        'section' => 'trendpress_testimonial_section'
    )
 );
 $wp_customize->add_setting(
    'trendpress_testimonial_title',
    array(
        'default' => '',
        'transport'=>'postMessage',
        'sanitize_callback' => 'sanitize_text_field'
    )
 );
 $wp_customize->add_control(
    'trendpress_testimonial_title',
    array(
        'label' => esc_html__('Testimonial Section Title','trendpress'),
        'type' => 'text',
        'priority' => 4,
        'section' => 'trendpress_testimonial_section'
    )
 );
 $wp_customize->add_setting(
    'trendpress_testimonial_sub_title',
    array(
        'default' => '',
        'transport'=>'postMessage',
        'sanitize_callback' => 'sanitize_text_field'
    )
 );
 $wp_customize->add_control(
    'trendpress_testimonial_sub_title',
    array(
        'label' => esc_html__('Testimonial Section Sub Title','trendpress'),
        'type' => 'text',
        'priority' => 6,
        'section' => 'trendpress_testimonial_section'
    )
 );
 $wp_customize->add_setting(
    'trendpress_testimonial_cat',
    array(
        'default' => '',
        'sanitize_callback' => 'trendpress_sanitize_post_cat_list'
    )
 );
 $wp_customize->add_control(
    'trendpress_testimonial_cat',
    array(
        'label' => esc_html__('Testimonial Post Category','trendpress'),
        'type' => 'select',
        'choices' => $trendpress_cat_list,
        'section' => 'trendpress_testimonial_section',
        'priority' => 8,
    )
 );
  $wp_customize->add_setting(
    'trendpress_client_enable',
    array(
        'default' => '',
        'sanitize_callback' => 'trendpress_sanitize_checkbox'
    )
 );
 $wp_customize->add_control(
    'trendpress_client_enable',
    array(
        'label' => esc_html__('Enable Client Section','trendpress'),
        'priority' => 1,
        'type' => 'checkbox',
        'section' => 'trendpress_client_section'
    )
 );
 $wp_customize->add_setting(
    'trendpress_client_cat',
    array(
        'default' => '',
        'sanitize_callback' => 'trendpress_sanitize_post_cat_list'
    )
 );
 $wp_customize->add_control(
    'trendpress_client_cat',
    array(
        'label' => esc_html__('Client Post Category','trendpress'),
        'type' => 'select',
        'choices' => $trendpress_cat_list,
        'section' => 'trendpress_client_section',
        'priority' => 4,
    )
 );

 $wp_customize->add_setting(
    'trendpress_footer_text',
    array(
        'default' => '',
        'transport' => 'postMessage',
        'sanitize_callback' => 'sanitize_text_field'
    )
 );
 $wp_customize->add_control(
    'trendpress_footer_text',
    array(
        'label' => esc_html__('Footer Text','trendpress'),
        'type' => 'text',
        'priority' => 4,
        'section' => 'trendpress_bottom_footer_section'
    )
 );
$wp_customize->add_setting(
    'trendpress_body_font_size',
    array(
        'default' => '',
        'transport'=>'postMessage',
        'sanitize_callback'=>'trendpress_sanitize_font_size'
    )
);
 $wp_customize->add_control(
    'trendpress_body_font_size',
    array(
        'label' => esc_html__('Body Font Size','trendpress'),
        'priority' => 2,
        'type' => 'select',
        'choices' => $trendpress_font_size,
        'section' => 'trendpress_body_typography_section'
    )
 );
$wp_customize->add_setting(
    'trendpress_h1_font_size',
    array(
        'default' => '',
        'transport'=>'postMessage',
        'sanitize_callback'=>'trendpress_sanitize_font_size'
    )
);
$wp_customize->add_control(
    'trendpress_h1_font_size',
    array(
        'label' => esc_html__('Heading 1 Font Size','trendpress'),
        'priority' => 2,
        'type' => 'select',
        'choices' => $trendpress_font_size,
        'section' => 'trendpress_h1_typography_section'
    )
 );
$wp_customize->add_setting(
    'trendpress_h2_font_size',
    array(
        'default' => '',
        'transport'=>'postMessage',
        'sanitize_callback'=>'trendpress_sanitize_font_size'
    )
);
$wp_customize->add_control(
    'trendpress_h2_font_size',
    array(
        'label' => esc_html__('Heading 2 Font Size','trendpress'),
        'priority' => 2,
        'type' => 'select',
        'choices' => $trendpress_font_size,
        'section' => 'trendpress_h2_typography_section'
    )
 );
$wp_customize->add_setting(
    'trendpress_h3_font_size',
    array(
        'default' => '',
        'transport'=>'postMessage',
        'sanitize_callback'=>'trendpress_sanitize_font_size'
    )
);
$wp_customize->add_control(
    'trendpress_h3_font_size',
    array(
        'label' => esc_html__('Heading 3 Font Size','trendpress'),
        'priority' => 2,
        'type' => 'select',
        'choices' => $trendpress_font_size,
        'section' => 'trendpress_h3_typography_section'
    )
 );
$wp_customize->add_setting(
    'trendpress_h4_font_size',
    array(
        'default' => '',
        'transport'=>'postMessage',
        'sanitize_callback'=>'trendpress_sanitize_font_size'
    )
);
$wp_customize->add_control(
    'trendpress_h4_font_size',
    array(
        'label' => esc_html__('Heading 4 Font Size','trendpress'),
        'priority' => 2,
        'type' => 'select',
        'choices' => $trendpress_font_size,
        'section' => 'trendpress_h4_typography_section'
    )
 );
$wp_customize->add_setting(
    'trendpress_h5_font_size',
    array(
        'default' => '',
        'transport'=>'postMessage',
        'sanitize_callback'=>'trendpress_sanitize_font_size'
    )
);
$wp_customize->add_control(
    'trendpress_h5_font_size',
    array(
        'label' => esc_html__('Heading 5 Font Size','trendpress'),
        'priority' => 2,
        'type' => 'select',
        'choices' => $trendpress_font_size,
        'section' => 'trendpress_h5_typography_section'
    )
 );
$wp_customize->add_setting(
    'trendpress_h6_font_size',
    array(
        'default' => '',
        'transport'=>'postMessage',
        'sanitize_callback'=>'trendpress_sanitize_font_size'
    )
);
$wp_customize->add_control(
    'trendpress_h6_font_size',
    array(
        'label' => esc_html__('Heading 6 Font Size','trendpress'),
        'priority' => 2,
        'type' => 'select',
        'choices' => $trendpress_font_size,
        'section' => 'trendpress_h6_typography_section'
    )
 );
$wp_customize->add_setting(
    'trendpress_body_font',
    array(
        'default' => '',
        'transport'=>'postMessage',
        'sanitize_callback'=>'sanitize_text_field'
    )
);
$wp_customize->add_control(
    'trendpress_body_font',
    array(
        'label' => esc_html__('Body Font','trendpress'),
        'priority' => 4,
        'type' => 'select',
        'choices' => $trendpress_fonts,
        'section' => 'trendpress_body_typography_section'
    )
 );
$wp_customize->add_setting(
    'trendpress_h1_font',
    array(
        'default' => '',
        'transport'=>'postMessage',
        'sanitize_callback'=>'sanitize_text_field'
    )
);
$wp_customize->add_control(
    'trendpress_h1_font',
    array(
        'label' => esc_html__('Heading 1 Font','trendpress'),
        'priority' => 4,
        'type' => 'select',
        'choices' => $trendpress_fonts,
        'section' => 'trendpress_h1_typography_section'
    )
 );
$wp_customize->add_setting(
    'trendpress_h2_font',
    array(
        'default' => '',
        'transport'=>'postMessage',
        'sanitize_callback'=>'sanitize_text_field'
    )
);
$wp_customize->add_control(
    'trendpress_h2_font',
    array(
        'label' => esc_html__('Heading 2 Font','trendpress'),
        'priority' => 4,
        'type' => 'select',
        'choices' => $trendpress_fonts,
        'section' => 'trendpress_h2_typography_section'
    )
 );
$wp_customize->add_setting(
    'trendpress_h3_font',
    array(
        'default' => '',
        'transport'=>'postMessage',
        'sanitize_callback'=>'sanitize_text_field'
    )
);
$wp_customize->add_control(
    'trendpress_h3_font',
    array(
        'label' => esc_html__('Heading 3 Font','trendpress'),
        'priority' => 4,
        'type' => 'select',
        'choices' => $trendpress_fonts,
        'section' => 'trendpress_h3_typography_section'
    )
 );
$wp_customize->add_setting(
    'trendpress_h4_font',
    array(
        'default' => '',
        'transport'=>'postMessage',
        'sanitize_callback'=>'sanitize_text_field'
    )
);
$wp_customize->add_control(
    'trendpress_h4_font',
    array(
        'label' => esc_html__('Heading 4 Font','trendpress'),
        'priority' => 4,
        'type' => 'select',
        'choices' => $trendpress_fonts,
        'section' => 'trendpress_h4_typography_section'
    )
 );
$wp_customize->add_setting(
    'trendpress_h5_font',
    array(
        'default' => '',
        'transport'=>'postMessage',
        'sanitize_callback'=>'sanitize_text_field'
    )
);
$wp_customize->add_control(
    'trendpress_h5_font',
    array(
        'label' => esc_html__('Heading 5 Font','trendpress'),
        'priority' => 4,
        'type' => 'select',
        'choices' => $trendpress_fonts,
        'section' => 'trendpress_h5_typography_section'
    )
 );
$wp_customize->add_setting(
    'trendpress_h6_font',
    array(
        'default' => '',
        'transport'=>'postMessage',
        'sanitize_callback'=>'sanitize_text_field'
    )
);
$wp_customize->add_control(
    'trendpress_h6_font',
    array(
        'label' => esc_html__('Heading 6 Font','trendpress'),
        'priority' => 4,
        'type' => 'select',
        'choices' => $trendpress_fonts,
        'section' => 'trendpress_h6_typography_section'
    )
 );