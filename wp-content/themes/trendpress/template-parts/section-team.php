<?php
/**
 * Team section
 */
 $trendpress_team_section_title = get_theme_mod('trendpress_team_title');
 $trendpress_team_section_sub_title = get_theme_mod('trendpress_team_sub_title');
 $trendpress_team_cat = get_theme_mod('trendpress_team_cat');
 if($trendpress_team_section_title || $trendpress_team_section_sub_title || is_active_sidebar('trendpress-team-member')){
 ?>
 <div class="tp-container">
     <?php if($trendpress_team_section_title || $trendpress_team_section_sub_title){ ?>
        <div class="section-titles-wrap wow fadeInUp">
            <?php if($trendpress_team_section_title){ ?><div class="section-title"><h5><?php echo esc_attr($trendpress_team_section_title); ?></h5></div><?php } ?>
            <?php if($trendpress_team_section_sub_title) { ?><div class="section-sub-title"><h2><?php echo esc_attr($trendpress_team_section_sub_title); ?></h2></div><?php } ?>
        </div>
    <?php } ?>
    <?php
    if($trendpress_team_cat){
        $trendpress_team_args = array('post_type' => 'post', 'category_name' => $trendpress_team_cat, 'order' => 'DESC', 'posts_per_page' => -1);
        $trendpress_team_query = new WP_Query($trendpress_team_args);
        if($trendpress_team_query->have_posts()){
            ?>
                <div class="team-wrap-main">
                    <div class="team-members">
                        <?php
                            while($trendpress_team_query->have_posts()){
                                $trendpress_team_query->the_post();
                                $trendpress_team_image = wp_get_attachment_image_src(get_post_thumbnail_id(),'trendpress-team-image');
                                if($trendpress_team_image[0] || get_the_title() || get_the_content()){
                                ?>
                                    <div class="member-team">
                                        <div class="image-content">
                                            <?php if($trendpress_team_image[0]){ ?>
                                                <div class="images-team">
                                                    <img title="<?php the_title_attribute(); ?>" alt="<?php the_title_attribute(); ?>" src="<?php echo esc_url($trendpress_team_image[0]); ?>" />
                                                </div>
                                            <?php } 
                                            ?>
                                            <?php if(get_the_title() || get_the_content()){ ?>
                                            <div class="title-conten">
                                                <div class="title-conten-wrap">
                                                <?php if(get_the_title()){ ?><a href="<?php the_permalink() ?>"><h2><?php the_title(); ?></h2></a><?php } ?>
                                                <?php if(get_the_content()){ ?>
                                                <div class="contents-team">
                                                    <?php echo esc_attr(wp_trim_words(get_the_content(),'18','...')); ?>
                                                </div>
                                                <?php } ?>
                                            </div>
                                            </div>
                                            <?php } ?>
                                        </div>
                                    </div>
                                <?php
                                }
                            }
                        ?>
                    </div>
                </div>
            <?php
        }
    }
    ?>
 </div>
 <?php
 }