<?php
/**
 * Blog Section
 */
 $trendpress_blog_section_title = get_theme_mod('trendpress_blog_title');
 $trendpress_blog_section_sub_title = get_theme_mod('trendpress_blog_sub_title');
 $trendpress_blog_cat = get_theme_mod('trendpress_blog_cat');
 if($trendpress_blog_section_title || $trendpress_blog_section_sub_title || $trendpress_blog_cat){
    ?>
    <div class="tp-container">
        <div class="blog-wrap-contents">
            <?php if($trendpress_blog_section_title || $trendpress_blog_section_sub_title){ ?>
                
                    <div class="section-titles-wrap wow fadeInUp">
                        <?php if($trendpress_blog_section_title){ ?><div class="section-title"><h5><?php echo esc_attr($trendpress_blog_section_title); ?></h5></div><?php } ?>
                        <?php if($trendpress_blog_section_sub_title) { ?><div class="section-sub-title"><h2><?php echo esc_attr($trendpress_blog_section_sub_title); ?></h2></div><?php } ?>
                    </div>
                
            <?php } ?>
            <?php
            if($trendpress_blog_cat){
                $trendpress_blog_args = array(
                    'poat_type' => 'post',
                    'order' => 'DESC',
                    'posts_per_page' => 6,
                    'post_status' => 'publish',
                    'category_name' => $trendpress_blog_cat
                );
                $trendpress_blog_query = new WP_Query($trendpress_blog_args);
                if($trendpress_blog_query->have_posts()):
                    ?>
                        <div class="blogs-contents clearfix">
                            <div id="blog-content-wrap">
                                <?php while($trendpress_blog_query->have_posts()):
                                        $trendpress_blog_query->the_post();
                                        $trendpress_blog_image_src = wp_get_attachment_image_src(get_post_thumbnail_id(),'trendpress-blog-image');
                                        $trendpress_blog_image_url = $trendpress_blog_image_src[0]; 
                                        if($trendpress_blog_image_url || get_the_title() || get_the_content()){?>
                                            <div class="blogs-loop wow fadeInUp">
                                                <div class="blogs-loop-wrap">
                                                <?php if($trendpress_blog_image_url){ ?>
                                                    <div class="blog-left">
                                                        <div class="image-date">
                                                            <a href="<?php the_permalink() ?>"><img src="<?php echo esc_url($trendpress_blog_image_url); ?>" title="<?php the_title_attribute() ?>" alt="<?php the_title_attribute() ?>" /></a>
                                                        </div>
                                                    </div>
                                                    <div class="auther-date-blog-content-wrap">
                                                    <div class="author-date">
                                                            <div class="post-date">
                                                                    <?php echo esc_attr(get_the_date()); ?>
                                                                    |
                                                                    <?php esc_html_e('By','trendpress'); ?>
                                                                    <?php echo esc_attr(get_the_author()); ?>
                                                            </div>
                                                        </div>
                                                <?php } ?>
                                                <?php if(get_the_title() || get_the_content()){ ?>
                                                    <div class="blog-contents">
                                                        <?php if(get_the_title()){ ?><div class="blog-title"><a href="<?php the_permalink() ?>"><h5><?php the_title(); ?></h5></a></div><?php } ?>
                                                        <?php if(get_the_content()){ ?>
                                                            <div class="blog-content">
                                                                <?php echo esc_attr(wp_trim_words(get_the_content(),'20','...')); ?>
                                                            </div>
                                                        <?php } ?>
                                                        
                                                    </div>
                                                    </div>
                                                    <div class="blog-post-footer clearfix">
                                                            <a href="<?php the_permalink(); ?>">
                                                                <?php esc_html_e('Read More','trendpress') ?>
                                                            </a>
                                                            <div class="post-comment">
                                                                <a href="<?php comments_link(); ?>">
                                                                    <i class="fa fa-comment-o"></i>
                                                                    <?php comments_number(0); ?>
                                                                </a>
                                                            </div>
                                                        </div>
                                                <?php } ?>
                                            </div>
                                            </div>
                                        <?php } ?>
                                <?php endwhile; ?>
                            </div>
                        </div>
                    <?php
                endif;
            }
            ?>
        </div>
    </div>
    <?php
 }