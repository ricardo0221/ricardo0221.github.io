<?php
/**
 * Portfolio Section
 */
 $trendpress_portfolio_section_title = get_theme_mod('trendpress_portfolio_title');
 $trendpress_portfolio_section_sub_title = get_theme_mod('trendpress_portfolio_sub_title');
 $trendpress_portfolio_section_sub_title = get_theme_mod('trendpress_portfolio_sub_title');
 $trendpress_portfolio_cat = get_theme_mod('trendpress_portfolio_cat');
 $trendpress_cat_id = get_category_by_slug( $trendpress_portfolio_cat )->term_id;


$trendpress_port_args = array('post_type' => 'post', 'cat' => $trendpress_cat_id, 'order' => 'DESC', 'posts_per_page' => -1);
$trendpress_port_query = new WP_Query($trendpress_port_args);

$trendpress_fil_categories = get_categories(array('type' => 'post', 'parent' => $trendpress_cat_id, 'hide_empty' => false));
?>
<div class="tp-container">
    <!-- Portfolio Filter -->
    <div class="portfolio-post-filter clearfix">
        <?php if($trendpress_portfolio_section_title || $trendpress_portfolio_section_sub_title){ ?>
                <div class="tp-container">
                    <div class="section-titles-wrap wow fadeInUp">
                        <?php if($trendpress_portfolio_section_title){ ?><div class="section-title"><h5><?php echo esc_attr($trendpress_portfolio_section_title); ?></h5></div><?php } ?>
                        <?php if($trendpress_portfolio_section_sub_title) { ?><div class="section-sub-title"><h2><?php echo esc_attr($trendpress_portfolio_section_sub_title); ?></h2></div><?php } ?>
                    </div>
                </div>
            <?php } ?>
        <div class="titles-port fadeInUp">
            <div class="filter active" data-filter="*"><?php esc_html_e('All', 'trendpress'); ?></div>
            <?php foreach ($trendpress_fil_categories as $trendpress_fil_cat) : ?>
                <div class="filter" data-filter=".category-<?php echo esc_attr($trendpress_fil_cat->term_id); ?>"><?php echo esc_attr($trendpress_fil_cat->name); ?></div>
            <?php endforeach; ?>
        </div>
    </div>

    <?php if ($trendpress_port_query->have_posts() && $trendpress_cat_id) : ?> 
        <div class="portfolio-postse wow fadeInUp clearfix">
            
            <?php while ($trendpress_port_query->have_posts()) : $trendpress_port_query->the_post(); ?>
                <?php
                    $trendpress_cats = get_the_category();
                    $trendpress_cat_list = '';
                    foreach ($trendpress_cats as $trendpress_cat) :
                        if ($trendpress_cat->term_id != $trendpress_cat_id) {
                            $trendpress_cat_list .= 'category-' . $trendpress_cat->term_id . ' ';
                        }
                    endforeach;

                    
                    $trendpress_img = wp_get_attachment_image_src(get_post_thumbnail_id(), 'trendpress-portfolio-image');
                    $trendpress_img_src = $trendpress_img[0];
                ?>
                <div class="portfolio-post-wrape <?php echo esc_attr($trendpress_cat_list); ?>">
                    <div class="overflow">
                        <a href="<?php the_permalink(); ?>">
                            <figure>
                                <?php if (has_post_thumbnail()) : ?>
                                    <img src="<?php echo esc_url($trendpress_img_src); ?>" title="<?php the_title_attribute(); ?>" alt="<?php the_title_attribute(); ?>" />
                                <?php endif; ?>

                                <div class="hm-port-excerpt">
                                    <h4 class="hm-port-title" ><?php the_title(); ?></h4>
                                </div>
                            </figure>
                        </a>
                    </div>
                </div>
            <?php endwhile; ?>
        </div>
        <?php endif; ?>
</div>
