<?php
function trendpress_dynamic_css(){
    $trendpress_breadcrumb_bg_image = get_theme_mod('trendpress_page_bg_image');
    if($trendpress_breadcrumb_bg_image){
        ?>
        <style>
            .header-banner-container{
                background: url('<?php echo esc_url($trendpress_breadcrumb_bg_image) ?>') no-repeat center fixed;
            }
        </style>
        <?php
    }
    $trendpress_cta_bg_image = get_theme_mod('trendpress_cta_bg_image');
    if($trendpress_cta_bg_image){
        ?>
        <style>
            .cta_section{
                background: url('<?php echo esc_url($trendpress_cta_bg_image) ?>')  no-repeat center fixed;
            }
        </style>
        <?php
    }
    $trendpress_body_font_size = get_theme_mod('trendpress_body_font_size');
    $trendpress_h1_font_size = get_theme_mod('trendpress_h1_font_size');
    $trendpress_h2_font_size = get_theme_mod('trendpress_h2_font_size');
    $trendpress_h3_font_size = get_theme_mod('trendpress_h3_font_size');
    $trendpress_h4_font_size = get_theme_mod('trendpress_h4_font_size');
    $trendpress_h5_font_size = get_theme_mod('trendpress_h5_font_size');
    $trendpress_h6_font_size = get_theme_mod('trendpress_h6_font_size');
    if($trendpress_body_font_size){
        ?>
        <style>
            body, .tp-about-content, .posts-content-main .tp-desc-wrap, 
            .member-description, .blog_section .blogs-loop .blog-content, 
            .testimonial_section .tp-desc-testimonial, .top-footer-desc{
                font-size: <?php echo absint($trendpress_body_font_size).'px !important' ?>;
            }
        </style>
        <?php
    }
    if($trendpress_h1_font_size){
        ?>
        <style>
            h1{
                font-size: <?php echo absint($trendpress_h1_font_size).'px !important' ?>;
            }
        </style>
        <?php
    }
    if($trendpress_h2_font_size){
        ?>
        <style>
            h2{
                font-size: <?php echo absint($trendpress_h2_font_size).'px !important' ?>;
            }
        </style>
        <?php
    }
    if($trendpress_h3_font_size){
        ?>
        <style>
            h3{
                font-size: <?php echo absint($trendpress_h3_font_size).'px !important' ?>;
            }
        </style>
        <?php
    }
    if($trendpress_h4_font_size){
        ?>
        <style>
            h4{
                font-size: <?php echo absint($trendpress_h4_font_size).'px !important' ?>;
            }
        </style>
        <?php
    }
    if($trendpress_h5_font_size){
        ?>
        <style>
            h5{
                font-size: <?php echo absint($trendpress_h5_font_size).'px !important' ?>;
            }
        </style>
        <?php
    }
    if($trendpress_h6_font_size){
        ?>
        <style>
            h6{
                font-size: <?php echo absint($trendpress_h6_font_size).'px !important' ?>;
            }
        </style>
        <?php
    }
    $trendpress_body_font = get_theme_mod('trendpress_body_font');
    $trendpress_h1_font = get_theme_mod('trendpress_h1_font');
    $trendpress_h2_font = get_theme_mod('trendpress_h2_font');
    $trendpress_h3_font = get_theme_mod('trendpress_h3_font');
    $trendpress_h4_font = get_theme_mod('trendpress_h4_font');
    $trendpress_h5_font = get_theme_mod('trendpress_h5_font');
    $trendpress_h6_font = get_theme_mod('trendpress_h6_font');
    if($trendpress_body_font){
        wp_register_style('trendpress-body-font', '//fonts.googleapis.com/css?family='.esc_attr($trendpress_body_font));
               wp_enqueue_style( 'trendpress-body-font');
               ?>
                <style>
                    body{
                        font-family:<?php echo esc_attr($trendpress_body_font).'!important' ?>;
                    }
                </style>
               <?php
    }
    if($trendpress_h1_font){
        wp_register_style('trendpress-h1-font', '//fonts.googleapis.com/css?family='.esc_attr($trendpress_h1_font));
               wp_enqueue_style( 'trendpress-h1-font');
               ?>
                <style>
                    h1{
                        font-family:<?php echo esc_attr($trendpress_h1_font).'!important' ?>;
                    }
                </style>
               <?php
    }
    if($trendpress_h2_font){
        wp_register_style('trendpress-h2-font', '//fonts.googleapis.com/css?family='.esc_attr($trendpress_h2_font));
               wp_enqueue_style( 'trendpress-h2-font');
               ?>
                <style>
                    h2{
                        font-family:<?php echo esc_attr($trendpress_h2_font).'!important' ?>;
                    }
                </style>
               <?php
    }
    if($trendpress_h3_font){
        wp_register_style('trendpress-h3-font', '//fonts.googleapis.com/css?family='.esc_attr($trendpress_h3_font));
               wp_enqueue_style( 'trendpress-h3-font');
               ?>
                <style>
                    h3{
                        font-family:<?php echo esc_attr($trendpress_h3_font).'!important' ?>;
                    }
                </style>
               <?php
    }
    if($trendpress_h4_font){
        wp_register_style('trendpress-h4-font', '//fonts.googleapis.com/css?family='.esc_attr($trendpress_h4_font));
               wp_enqueue_style( 'trendpress-h4-font');
               ?>
                <style>
                    h4{
                        font-family:<?php echo esc_attr($trendpress_h4_font).'!important' ?>;
                    }
                </style>
               <?php
    }
    if($trendpress_h5_font){
        wp_register_style('trendpress-h5-font', '//fonts.googleapis.com/css?family='.esc_attr($trendpress_h1_font));
               wp_enqueue_style( 'trendpress-h5-font');
               ?>
                <style>
                    h5{
                        font-family:<?php echo esc_attr($trendpress_h5_font).'!important' ?>;
                    }
                </style>
               <?php
    }
    if($trendpress_h6_font){
        wp_register_style('trendpress-h6-font', '//fonts.googleapis.com/css?family='.esc_attr($trendpress_h6_font));
               wp_enqueue_style( 'trendpress-h6-font');
               ?>
                <style>
                    h6{
                        font-family:<?php echo esc_attr($trendpress_h6_font).'!important' ?>;
                    }
                </style>
               <?php
    }
    $trendpress_disable_about_image_frame = get_theme_mod('trendpress_disable_feature_image_frame');
    if($trendpress_disable_about_image_frame){
        ?>
            <style>
                .about-section-wrap .about-image-bottom:before{
                    border: none!important;
                }
            </style>
        <?php
    }
}

add_action('wp_head', 'trendpress_dynamic_css',100);