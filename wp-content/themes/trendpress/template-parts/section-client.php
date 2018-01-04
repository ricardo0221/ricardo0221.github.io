<?php
/**
 * Section Client
 */
 $trendpress_client_cat = get_theme_mod('trendpress_client_cat');
 if($trendpress_client_cat){
  $trendpress_client_args = array(
        'post_type' => 'post',
        'order' => 'DESC',
        'posts_per_page' => -1,
        'post_status' => 'publish',
        'category_name' => $trendpress_client_cat
      );
      $trendpress_client_query = new WP_Query($trendpress_client_args);
  if($trendpress_client_query->have_posts()):
    ?>
    <div class="tp-container">
        <div class="partners-logo wow fadeInUp">
            <div class="tp-logo-wrap">
                <?php
                    while($trendpress_client_query->have_posts()):
                        $trendpress_client_query->the_post();
                        $trendpress_client_logo_src = wp_get_attachment_image_src(get_post_thumbnail_id(),'trendpress-client-logo');
                        $trendpress_client_logo_url = $trendpress_client_logo_src[0];
                        if($trendpress_client_logo_url){
                            ?>
                                <div class="tp-partners">
                                    <div class="tp-client-logo">
                                        <img src="<?php echo esc_url($trendpress_client_logo_url); ?>" alt="<?php the_title_attribute() ?>" title="<?php the_title_attribute() ?>" />
                                    </div>
                                </div>
                            <?php
                        }
                    endwhile;
                ?>
            </div>
        </div>
    </div>
    <?php
  endif;
 }