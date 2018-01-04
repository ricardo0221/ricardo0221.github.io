<?php
/**
 * CTA Section
 */
 $trendpress_cta_post = get_theme_mod('trendpress_cta_post');
 $tp_cta_button_text = get_theme_mod('trendpress_cta_button_text');
 $tp_cta_button_text2 = get_theme_mod('trendpress_cta_button_text2');
 $tp_cta_button_link = get_theme_mod('trendpress_cta_button_link');
 $tp_cta_button_link2 = get_theme_mod('trendpress_cta_button_link2');
 $tp_cta_posts = new WP_Query(array('post_type' => 'post', 'post__in' => array($trendpress_cta_post)));
 if($trendpress_cta_post || $tp_cta_button_text || $tp_cta_button_link || $tp_cta_button_link2){
    ?>
        <div class="tp-container">
            <div class="cta-wrap wow fadeInUp">
                <?php if($tp_cta_posts->have_posts()){
                        while($tp_cta_posts->have_posts()){
                            $tp_cta_posts->the_post();
                        if(get_the_title()){ ?>
                            <div class="content-title-cta"><?php the_title(); ?></div>
                        <?php }
                        if(get_the_content()){ ?>
                            <div class="content-desc-cta"><?php the_content(); ?></div>
                        <?php }
                        }
                    } ?>
                    <div class="button-wrap-cta">
		                <?php if($tp_cta_button_link){ ?>
			                <div class="cta-button cta-button1">
				                <a href="<?php echo esc_url($tp_cta_button_link); ?>">
				                	<?php echo esc_attr($tp_cta_button_text); ?>
				                </a>
			                </div>
		                <?php } ?>
		                <?php if($tp_cta_button_link2){ ?>
			                <div class="cta-button cta-button2">
				                <a href="<?php echo esc_url($tp_cta_button_link2); ?>">
				                	<?php echo esc_attr($tp_cta_button_text2); ?>
				                </a>
			                </div>
		                <?php } ?>
                	</div>
            </div>
        </div>
    <?php
 }