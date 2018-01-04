<?php
/**
 * Testimonial Section
 */
 $trendpress_test_title = get_theme_mod('trendpress_testimonial_title');
 $trendpress_test_sub_title = get_theme_mod('trendpress_testimonial_sub_title');
 $trendpress_test_cat = get_theme_mod('trendpress_testimonial_cat');
 if($trendpress_test_title || $trendpress_test_sub_title || $trendpress_test_cat){ ?>
    <div class="tp-container">
        <?php if($trendpress_test_title || $trendpress_test_sub_title){ ?>
            <div class="section-titles-wrap wow fadeInUp">
                <?php if($trendpress_test_title){ ?><div class="section-title"><h5><?php echo esc_attr($trendpress_test_title); ?></h5></div><?php } ?>
                <?php if($trendpress_test_sub_title) { ?><div class="section-sub-title"><h2><?php echo esc_attr($trendpress_test_sub_title); ?></h2></div><?php } ?>
            </div>
        <?php } ?>
        <?php if($trendpress_test_cat){ ?>
            <div class="test-main-wrap  wow fadeInUp">
                <div class="tp-test-secondary-wrap">
                    <?php $trendpress_test_args = array(
                            'post_type' => 'post',
                            'order' => 'DESC',
                            'posts_per_page' => -1,
                            'post_status' => 'publish',
                            'category_name' => $trendpress_test_cat
                        );
                        wp_reset_postdata();
                        $trendpress_test_query = new WP_Query($trendpress_test_args);
                        if($trendpress_test_query->have_posts()): 
                            while($trendpress_test_query->have_posts()): $trendpress_test_query->the_post();
                                $trendpress_test_image_src = wp_get_attachment_image_src(get_post_thumbnail_id(),'trendpress-testimonial-image');
                                $trendpress_test_image_url = $trendpress_test_image_src[0];
                                if($trendpress_test_image_url || get_the_title() || get_the_content()){?>
                                    <div class="tp-testimonial-content">
                                        <?php if($trendpress_test_image_url){ ?><div class="image-test"><img src="<?php echo esc_url($trendpress_test_image_url) ?>" alt="<?php the_title_attribute() ?>" title="<?php the_title_attribute() ?>" /></div><?php } ?>
                                        <?php if(get_the_title() || get_the_content()){ ?>
                                            <div class="tp-title-desc">
                                                <?php if(get_the_content()){ ?><div class="tp-desc-testimonial"><p><?php echo  esc_attr(wp_trim_words(get_the_content(),'30','...')); ?></p></div><?php } ?>
                                                <?php if(get_the_title()){ ?><div class="tp-title-testimonial"><?php echo esc_attr(get_the_title()); ?></div><?php } ?>
                                            </div>
                                        <?php } ?>
                                    </div>
                                <?php }
                            endwhile;
                        endif; ?>
                </div>
            </div>
        <?php } ?>
    </div>
 <?php } ?>