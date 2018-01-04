<?php
/**
 * About Sectin
*/
$trendpress_about_title = get_theme_mod('trendpress_about_title');
$trendpress_about_sub_title = get_theme_mod('trendpress_about_sub_title');
$trendpress_about_post = get_theme_mod('trendpress_about_post');
$trendpress_about_args = new WP_Query(array('post_type' => 'post', 'post__in' => array($trendpress_about_post)));
if($trendpress_about_title || $trendpress_about_sub_title || $trendpress_about_post){ ?>

        <div class="tp-container">
            <?php if($trendpress_about_args->have_posts()):
                while($trendpress_about_args->have_posts()): 
                $trendpress_about_args->the_post(); ?>
                
                    <div class="about-section-wrap clearfix">
                        <div class="about-top-content wow fadeInUp">
                            <?php if($trendpress_about_title || $trendpress_about_sub_title){ ?>
                                <div class="section-titles-wrap wow fadeInUp">
                                    <?php if($trendpress_about_title){ ?><div class="section-title"><h5><?php echo esc_attr($trendpress_about_title); ?></h5></div><?php } ?>
                                    <?php if($trendpress_about_sub_title) { ?><div class="section-sub-title"><h2><?php echo esc_attr($trendpress_about_sub_title); ?></h2></div><?php } ?>
                                </div>
                            <?php } ?>
                            <?php if(get_the_title() || get_the_content()){ ?>
                            <div class="about-content">
                                <?php if(get_the_title()){ ?><div class="tp-about-title"><a href="<?php the_permalink(); ?>"><h5><?php the_title(); ?></h5></a></div><?php } ?>
                                <?php if(get_the_content()){ ?><div class="tp-about-content"><?php echo esc_attr(wp_trim_words(get_the_content(),'50','...')) ?></div><?php } ?>
                                <span class="tp-about-btn"><a href="<?php the_permalink(); ?>"><?php esc_html_e('Read More','trendpress'); ?></a></span>
                            </div>
                        <?php } ?>
                        </div>
                        <?php
                            $trendpress_image_src = wp_get_attachment_image_src(get_post_thumbnail_id(),'');
                            if($trendpress_image_src){
                        ?>
                        <div class="about-image-bottom wow fadeInUp">
                            <div class="tp-about-image"><img src="<?php echo esc_url($trendpress_image_src[0]); ?>" /></div>
                        </div>
                        <?php } ?>
                    </div>
                    
                <?php endwhile; ?>
            <?php endif; ?>
        </div>
        
<?php }