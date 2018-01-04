<?php
add_action('customize_register','trendpress_Customizer_Control');
function trendpress_Customizer_Control($wp_customize){
    require get_template_directory() . '/inc/admin-panel/trendpress-customizer-option.php';
    require get_template_directory() . '/inc/admin-panel/trendpress-sanitize.php';
    $wp_customize->get_section( 'title_tagline' )->panel = 'trendpress_header_panel';  
    $wp_customize->get_section( 'background_image' )->panel = 'trendpress_general_panel';
    $wp_customize->get_section( 'header_image' )->panel = 'trendpress_header_panel';  
    $wp_customize->get_section( 'colors' )->panel = 'trendpress_general_panel';
}