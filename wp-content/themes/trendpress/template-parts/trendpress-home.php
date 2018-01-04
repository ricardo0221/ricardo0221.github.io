<?php
/**
 * Template Name: Trendpress Home
 */
 get_header();
    $trendpress_enable_sections = trendpress_enable_disable_section();
    if($trendpress_enable_sections){
        foreach($trendpress_enable_sections as $trendpress_enable_section){
            ?>
                <section id="<?php echo esc_attr($trendpress_enable_section['id']); ?>" class="<?php echo esc_attr($trendpress_enable_section['section']).'_section'; ?>">
                    <?php
                        get_template_part('template-parts/section',$trendpress_enable_section['section']);
                    ?>                
                </section>
            <?php
        }
    }
 get_footer();