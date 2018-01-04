<?php
/**
 * Feature Section
 */
 $construciton_feature_section_title = get_theme_mod('trendpress_feature_title');
 $construciton_feature_section_sub_title = get_theme_mod('trendpress_feature_sub_title');

 ?>
 
<?php if($construciton_feature_section_title || $construciton_feature_section_sub_title){ ?>
    <div class="section-titles-wrap wow fadeInUp">
        <div class="tp-container">
            <?php if($construciton_feature_section_title){ ?><div class="section-title"><h5><?php echo esc_attr($construciton_feature_section_title); ?></h5></div><?php } ?>
            <?php if($construciton_feature_section_sub_title) { ?><div class="section-sub-title"><h2><?php echo esc_attr($construciton_feature_section_sub_title); ?></h2></div><?php } ?>
        </div>
    </div>
<?php } ?>
<?php
    $trendpress_feature_category = get_theme_mod('trendpress_feature_cat');
    if($trendpress_feature_category){
        wp_reset_postdata();
        $trendpress_feature_args = array(
            'poat_type' => 'post',
            'order' => 'DESC',
            'posts_per_page' => -1,
            'post_status' => 'publish',
            'category_name' => $trendpress_feature_category
        );
        $trendpress_feature_query = new WP_Query($trendpress_feature_args);
        if($trendpress_feature_query->have_posts()):
        ?>
            <div class="posts-feature wow fadeInUp">
                <div class="tp-container clearfix">
                    <div class="feature-post-wraps">
                    <?php while($trendpress_feature_query->have_posts()): $trendpress_feature_query->the_post();
                    $trendpress_feature_image_src = wp_get_attachment_image_src(get_post_thumbnail_id(),'trendpress-feature-image');
                    $trendpress_feature_image_url = $trendpress_feature_image_src[0];
                        if(get_the_title() || get_the_content() || $trendpress_feature_image_url){ ?>
                            <div class="posts-content-main">
                                <div class="feature-post-content-wrap clearfix">
                                <?php if(get_the_title() || get_the_content()){ ?>
                                    <div class="service-titles">
                                        <?php if(get_the_title()){ ?><div class="tp-feature-title"><h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3></div><?php } ?>
                                        <?php if(get_the_content()){ ?><div class="tp-desc-wrap"><?php echo esc_attr(wp_trim_words(get_the_content(),'15','...')); ?></div><?php } ?>
                                    </div>
                                <?php } ?>
                                <?php if($trendpress_feature_image_url){ ?>
                                    <div class="feature-image">
                                        <img src="<?php echo esc_url($trendpress_feature_image_url); ?>" alt="<?php the_title_attribute() ?>" title="<?php the_title_attribute() ?>" />
                                    </div>
                                <?php } ?>
                            </div>
                            </div>
                        <?php } ?>
                    <?php endwhile; ?>
                    </div>
                </div>
            </div>
        <?php 
        endif;
        } ?>