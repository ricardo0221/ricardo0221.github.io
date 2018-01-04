<?php
function trendpress_esc_slider_content($input){
    $trendpress_slider_content = array(
        'a' => array(
            'class' => array(),
            'href' => array(),
            'targer' => array(),
        ),
        'div'=>array(
            'class' => array(),
            'id' => array(),
        ),
        'span'=>array(
            'class' => array(),
            'id' => array(),
        )
    );
    return wp_kses($input,$trendpress_slider_content);
}
function trendpress_Slider_Control(){
    $trendpress_slider_cat = get_theme_mod('trendpress_slider_cat');
    if($trendpress_slider_cat){
        $trendpress_slider_args = array(
            'post_type' => 'post',
            'order' => 'DESC',
            'posts_per_page' => -1,
            'post_status' => 'publish',
            'category_name' => $trendpress_slider_cat
        );
        $trendpress_slider_query = new WP_Query($trendpress_slider_args);
        if($trendpress_slider_query->have_posts()):
            ?>
            <div class="main-header-slider">
                <div id="secondary-wrap">
                    <?php
                        while($trendpress_slider_query->have_posts()):
                            $trendpress_slider_query->the_post();
                            $trendpress_slider_image_src = wp_get_attachment_image_src(get_post_thumbnail_id(),'trendpress-slider-image');
                            $trendpress_image_url = $trendpress_slider_image_src[0];
                            if($trendpress_image_url || get_the_title() || get_the_content()){
                                ?>
                                    <div class="content-main-wrap">
                                        <?php if($trendpress_image_url){ ?>
                                            <div class="main-image"><img src="<?php echo esc_url($trendpress_image_url); ?>" alt="<?php the_title_attribute(); ?>" title="<?php the_title_attribute(); ?>" /></div>
                                        <?php } ?>
                                        <?php if(get_the_title() || get_the_content()){ ?>
                                                <div class="slider-text-wrap">
                                                    <div class="tp-container">
                                                        <?php if(get_the_title()){ ?><div class="slider-title"><?php the_title(); ?></div><?php } ?>
                                                        <?php if(get_the_content()){ ?><div class="slider-content"> <?php echo trendpress_esc_slider_content(get_the_content()); ?></div><?php } ?>
                                                    </div>
                                                </div>
                                        <?php } ?>
                                    </div>
                                <?php
                            }
                        endwhile;
                    ?>
                </div>
            </div>
            <?php
        endif;
    }
}
add_action('trendpress_slider_action','trendpress_Slider_Control');

function trendpress_Category_list(){
    $trendpress_cat_lists = get_categories(
        array(
            'hide_empty' => '0',
            'exclude' => '1',
        )
    );
    $trendpress_cat_array = array();
    $trendpress_cat_array[''] = esc_html__('--Choose--','trendpress');
    foreach($trendpress_cat_lists as $trendpress_cat_list){
        $trendpress_cat_array[$trendpress_cat_list->slug] = $trendpress_cat_list->name;
    }
    return $trendpress_cat_array;
}
function trendpress_Posts_List(){
    wp_reset_postdata();
    $trendpress_post_lists = get_posts(array('posts_per_page' => -1));
    $trendpress_post_list_array = array();
    $trendpress_post_list_array[''] = esc_html__('--Choose--','trendpress');
    foreach($trendpress_post_lists as $trendpress_post_list){
        $trendpress_post_list_array[$trendpress_post_list->ID] = $trendpress_post_list->post_title;
    }
    return $trendpress_post_list_array;
}
function trendpress_enable_disable_section(){
    $trendpress_sections = array('about','feature','team','portfolio','shop','cta','blog','testimonial','client');
    $trendpress_enable_sections = array();
    foreach($trendpress_sections as $trendpress_section){
        if(get_theme_mod('trendpress_'.$trendpress_section.'_enable')){
            $trendpress_enable_sections[] = array(
                'id' => 'trendpress_'.$trendpress_section.'_section',
                'section' => $trendpress_section,
            );
        }
    }
    return $trendpress_enable_sections;
}

function trendpress_header_social_link(){
                $social_link = array('facebook','twitter','youtube','pinterest','instagram','linkedin','googleplus','flickr');
                foreach($social_link as $social_links){
                    
                    $social_links_val = get_theme_mod('trendpress_'.$social_links.'_link');
                    if($social_links == 'googleplus'){
                        if($social_links_val){
                            echo '<div class="fa_link_wrap">';
                            ?> <a target="_blank" href="<?php echo esc_url($social_links_val); ?>"> <?php
                                echo '<span class="fa_wrap">';
                                    echo '<i class="fa fa-google-plus" aria-hidden="true"></i>';
                                echo '</span>';
                                echo '<div class="link_wrap">';
                                    ?>
                                        <?php echo esc_attr($social_links); ?>  
                                    <?php
                                echo '</div>';
                                ?></a>   <?php
                            echo '</div>';
                        }
                    }
                    elseif($social_links == 'pinterest'){
                        if($social_links_val){
                            echo '<div class="fa_link_wrap">';
                            ?><a target="_blank" href="<?php echo esc_url($social_links_val); ?>"><?php
                                echo '<span class="fa_wrap">';
                                echo '<i class="fa fa-pinterest-p" aria-hidden="true"></i>';
                                echo '</span>';
                                echo '<div class="link_wrap">';
                                    ?>
                                        <?php echo esc_attr($social_links); ?>   
                                    <?php
                                echo '</div>';
                                ?> </a> <?php
                            echo '</div>';
                        }
                    }
                    else{
                            if($social_links_val){
                            echo '<div class="fa_link_wrap">';
                            ?> <a target="_blank" href="<?php echo esc_url($social_links_val) ?>"> <?php
                                echo '<span class="fa_wrap">';
                                    ?>
                                        <i class="fa fa-<?php echo esc_attr($social_links); ?>"></i>
                                    <?php
                                echo '</span>';
                                echo '<div class="link_wrap">';
                                    ?>
                                        <?php echo esc_attr($social_links); ?>    
                                    <?php
                                echo '</div>';
                                ?> </a> <?php
                            echo '</div>';
                        }
                    }
                }
}
add_action('trendpress_header_social_link_acrion','trendpress_header_social_link');
function trendpress_header_banner_x() {
	if(is_home() || is_front_page()) :
	else :
		?>
			<div class="header-banner-container">
                <div class="tp-container">
    				<div class="page-title-wrap">
    					<?php
    						if(is_archive()) {
    							the_archive_title( '<h1 class="page-title">', '</h1>' );
    							the_archive_description( '<div class="taxonomy-description">', '</div>' );
    						} elseif(is_single() || is_singular('page')) {
    							wp_reset_postdata();
    							the_title('<h1 class="page-title">', '</h1>');
    						} elseif(is_search()) {
                                ?>
                                <h1 class="page-title"><?php printf( esc_html__( 'Search Results for: %s', 'trendpress' ), '<span>' . get_search_query() . '</span>' ); ?></h1>
                                <?php
                            } elseif(is_404()) {
                                ?>
                                <h1 class="page-title"><?php esc_html_e( '404 Error', 'trendpress' ); ?></h1>
                                <?php
                            }
    					?>
    					<?php trendpress_breadcrumbs(); ?>
    				</div>
                </div>
			</div>
		<?php
	endif;
}
add_action('trendpress_header_banner', 'trendpress_header_banner_x');
function trendpress_sanitize_bradcrumb($input){
    $all_tags = array(
        'a'=>array(
            'href'=>array()
        )
     );
    return wp_kses($input,$all_tags);
    
}
function trendpress_breadcrumbs() {
    global $post;
    $showOnHome = 0; // 1 - show breadcrumbs on the homepage, 0 - don't show

    $delimiter = '&gt;';

    $showCurrent = 1; // 1 - show current post/page title in breadcrumbs, 0 - don't show
    $homeLink = esc_url( home_url() );

    if (is_home() || is_front_page()) {

        if ($showOnHome == 1)
            echo '<div id="trendpress-breadcrumb"><a href="' . $homeLink . '">' . esc_html__('Home', 'trendpress') . '</a></div></div>';
    } else {

        echo '<div id="trendpress-breadcrumb"><a href="' . $homeLink . '">' . esc_html__('Home', 'trendpress') . '</a> ' . esc_attr($delimiter) . ' ';

        if (is_category()) {
            $thisCat = get_category(get_query_var('cat'), false);
            if ($thisCat->parent != 0)
                echo get_category_parents($thisCat->parent, TRUE, ' ' . esc_attr($delimiter) . ' ');
            echo '<span class="current">' . esc_html__('Archive by category','trendpress').' "' . single_cat_title('', false) . '"' . '</span>';
        } elseif (is_search()) {
            echo '<span class="current">' . esc_html__('Search results for','trendpress'). '"' . get_search_query() . '"' . '</span>';
        } elseif (is_day()) {
            echo '<a href="' . esc_url(get_year_link(get_the_time('Y'))) . '">' . esc_attr(get_the_time('Y')) . '</a> ' . esc_attr($delimiter) . ' ';
            echo '<a href="' . esc_url(get_month_link(get_the_time('Y')), esc_attr(get_the_time('m'))) . '">' . esc_attr(get_the_time('F')) . '</a> ' . esc_attr($delimiter) . ' ';
            echo '<span class="current">' . esc_attr(get_the_time('d')) . '</span>';
        } elseif (is_month()) {
            echo '<a href="' . esc_url(get_year_link(get_the_time('Y'))) . '">' . esc_attr(get_the_time('Y')) . '</a> ' . esc_attr($delimiter) . ' ';
            echo '<span class="current">' . esc_attr(get_the_time('F')) . '</span>';
        } elseif (is_year()) {
            echo '<span class="current">' . esc_attr(get_the_time('Y')) . '</span>';
        } elseif (is_single() && !is_attachment()) {
            if (get_post_type() != 'post') {
                $post_type = get_post_type_object(get_post_type());
                $slug = $post_type->rewrite;
                echo '<a href="' . esc_url($homeLink) . '/' . esc_attr($slug['slug']) . '/">' . esc_attr($post_type->labels->singular_name) . '</a>';
                if ($showCurrent == 1)
                    echo ' ' . esc_attr($delimiter) . ' ' . '<span class="current">' . esc_attr(get_the_title()) . '</span>';
            } else {
                $cat = get_the_category();
                $cat = $cat[0];
                $cats = get_category_parents($cat, TRUE, ' ' . $delimiter . ' ');
                if ($showCurrent == 0)
                    $cats = preg_replace("#^(.+)\s$delimiter\s$#", "$1", $cats);
                echo trendpress_sanitize_bradcrumb($cats);
                if ($showCurrent == 1)
                    echo '<span class="current">' . esc_attr(get_the_title()) . '</span>';
            }
        } elseif (!is_single() && !is_page() && get_post_type() != 'post' && !is_404()) {
            $post_type = get_post_type_object(get_post_type());
            if($post_type){
            echo '<span class="current">' . esc_attr($post_type->labels->singular_name) . '</span>';
            }
        } elseif (is_attachment()) {
            if ($showCurrent == 1) echo ' ' . '<span class="current">' . esc_attr(get_the_title()) . '</span>';
        } elseif (is_page() && !$post->post_parent) {
            if ($showCurrent == 1)
                echo '<span class="current">' . esc_attr(get_the_title()) . '</span>';
        } elseif (is_page() && $post->post_parent) {
            $parent_id = $post->post_parent;
            $breadcrumbs = array();
            while ($parent_id) {
                $page = get_page($parent_id);
                $breadcrumbs[] = '<a href="' . get_permalink($page->ID) . '">' . get_the_title($page->ID) . '</a>';
                $parent_id = $page->post_parent;
            }
            $breadcrumbs = array_reverse($breadcrumbs);
            for ($i = 0; $i < count($breadcrumbs); $i++) {
                echo trendpress_sanitize_bradcrumb($breadcrumbs[$i]);
                if ($i != count($breadcrumbs) - 1)
                    echo ' ' . esc_attr($delimiter). ' ';
            }
            if ($showCurrent == 1)
                echo ' ' . esc_attr($delimiter) . ' ' . '<span class="current">' . esc_attr(get_the_title()) . '</span>';
        } elseif (is_tag()) {
            echo '<span class="current">' . esc_html__('Posts tagged','trendpress').' "' . esc_attr(single_tag_title('', false)) . '"' . '</span>';
        } elseif (is_author()) {
            global $author;
            $userdata = get_userdata($author);
            echo '<span class="current">' . esc_html__('Articles posted by ','trendpress'). esc_attr($userdata->display_name) . '</span>';
        } elseif (is_404()) {
            echo '<span class="current">' . esc_html__('Error 404','trendpress') . '</span>';
        }

        if (get_query_var('paged')) {
            if (is_category() || is_day() || is_month() || is_year() || is_search() || is_tag() || is_author())
                echo ' (';
            echo esc_html__('Page', 'trendpress') . ' ' . get_query_var('paged');
            if (is_category() || is_day() || is_month() || is_year() || is_search() || is_tag() || is_author())
                echo ')';
        }

        echo '</div>';
    }
}
function trendpress_font_size(){
     $font_size[''] = 'Default';
    for($i=12;$i<=70;$i++)
    {
        $font_size[$i] = $i;
    }
   
    return $font_size;
}
function trendpress_fonts()
{
    return $fonts = array(
        ''=>'Default',
        'Raleway'=> esc_html__( 'Raleway', 'trendpress' ),
        'Source Sans Pro'=> esc_html__( 'Source Sans Pro', 'trendpress' ),
        'Josefin Sans'=> esc_html__( 'Josefin Sans', 'trendpress' ),
    );
}