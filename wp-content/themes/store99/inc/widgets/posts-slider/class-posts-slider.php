<?php

/**
 * Class Everest_Posts_Slider
 */
class Everest_Posts_Slider extends WP_Widget
{

    /**
     * Register widget with WordPress.
     */
    function __construct()
    {
        parent::__construct(
            'everest-posts-slider-widget', // Base ID
            esc_html__('Everest: Posts Slider', 'store99'), // Name
            array(
                'classname' => 'everest-posts-slider-widget',
                'description' => esc_html__('Displays posts slider.', 'store99'),
            ) // Args
        );

    }

    private function widget_fields()
    {
        $args = array(
            'taxonomy' => 'category',
            'orderby' => 'name',
            'show_count' => 0,
            'pad_counts' => 0,
            'hierarchical' => 1,
            'title_li' => '',
            'hide_empty' => 0
        );

        $categories_obj = get_categories($args);
        $post_categories = array();
        $post_categories[''] = 'Select Category';

        foreach ($categories_obj as $category) {
            $post_categories[$category->term_id] = $category->name;
        }

        return array(

            'store99_cat_title' => array(
                'store99_widget_name' => 'category_title',
                'store99_widget_title' => __('Post Category Title', 'store99'),
                'store99_widget_field_type' => 'title',
            ),

            'store99_post_category' => array(
                'store99_widget_name' => 'post_category',
                'store99_widget_title' => __('Select Post Category', 'store99'),
                'store99_widget_field_type' => 'select',
                'store99_widget_field_options' => $post_categories
            ),

            'store99_post_number' => array(
                'store99_widget_name' => 'post_number',
                'store99_widget_title' => __('Number of posts to show', 'store99'),
                'store99_widget_field_type' => 'number',
            ),
        );
    }

    private function get_posts($args, $instance)
    {
        $number = !empty($instance['post_number']) ? absint($instance['post_number']) : 10;
        $category = !empty($instance['post_category']) ? sanitize_title($instance['post_category']) : '';

        $query_args = array(
            'post_type' => 'post',
            'posts_per_page' => $number,
            'post_status' => 'publish',
            'cat' => $category,
        );

        return new WP_Query(apply_filters('posts_widget_query_args', $query_args));
    }

    /**
     * Widget form.
     *
     * @see WP_Widget::form()
     *
     * @param array $instance Previously saved values from database.
     * @return string|void
     */
    function form($instance)
    {
        $widget_fields = $this->widget_fields();
        foreach ($widget_fields as $widget_field) {
            extract($widget_field);
            $store99_widget_field_value = !empty($instance[$store99_widget_name]) ? $instance[$store99_widget_name] : '';
            store99_show_widget_fields($this, $widget_field, $store99_widget_field_value);
        }

    }

    /**
     * Sanitize widget form values as they are saved.
     *
     * @see WP_Widget::update()
     *
     * @param array $new_instance Values just sent to be saved.
     * @param array $old_instance Previously saved values from database.
     *
     * @return array Updated safe values to be saved.
     */
    function update($new_instance, $old_instance)
    {
        $instance = $old_instance;
        $widget_fields = $this->widget_fields();
        foreach ($widget_fields as $widget_field) {
            extract($widget_field);
            $instance[$store99_widget_name] = store99_update_widget_fields($widget_field, $new_instance[$store99_widget_name]);
        }
        return $instance;
    }

    /**
     * Frontend display of widget.
     *
     * @see WP_Widget::widget()
     *
     * @param array $args Widget arguments.
     * @param array $instance Saved values from database.
     */
    function widget($args, $instance)
    {
        extract($args);

        $cat_title = !empty($instance['category_title']) ? $instance['category_title'] : '';
        $post_category = !empty($instance['post_category']) ? intval($instance['post_category']) : '';
        $post_number = !empty($instance['post_number']) ? intval($instance['post_number']) : '';

        if (!empty($post_category)) {
            $category = get_term($post_category, 'category');
            $category_name = $category->name;
        }
        if (($posts = $this->get_posts($args, $instance)) && $posts->have_posts()) {
            $count_posts = $posts->post_count;
            echo $before_widget;

            ?>
            <div class="col-sm-12 col-md-12 col-lg-8">
                <?php
                if (!empty($cat_title)): ?>
                    <div class="blog-post">
                        <h5><?php echo esc_attr($cat_title); ?></h5>
                    </div>
                    <?php
                endif; ?>
                <div id="blog" class="owl-carousel owl-theme">
                    <div class="blog-item">
                        <div class="item">
                            <div class="row">
                                <?php
                                $i = 1;
                                while ($posts->have_posts()) {
                                    $posts->the_post();

                                    $post_id = get_the_ID();
                                    $featured_image = wp_get_attachment_image_src(get_post_thumbnail_id($post_id), 'store99-posts-slider-grid', false);
                                    ?>

                                    <div class="col-md-6">
                                        <?php
                                        if (!empty($featured_image)): ?>
                                            <a href="<?php the_permalink(); ?>">
                                                <figure>
                                                    <img src="<?php echo esc_attr($featured_image[0]); ?>" alt="" class="img-responsive">
                                                </figure>
                                            </a>
                                            <?php
                                        endif; ?>
                                        <div class="blog-cont clearfix">
                                            <div class="blog-date">
                                                <span class="day"><?php echo esc_attr(get_the_date( 'M j' )) ?></span>
                                                <span class="month"><?php echo esc_attr(get_the_date('Y')); ?></span>
                                            </div>
                                            <div class="blog-text">
                                                <a href="<?php the_permalink(); ?>">
                                                    <h6><?php the_title(); ?></h6>
                                                </a>
                                            </div>
                                            <div class="blog-descrip">
                                                <p><?php echo esc_html(store99_excerpt(18)); ?></p>
                                            </div>
                                        </div>
                                    </div>

                                    <?php
                                    if ($i >= 2) {
                                        if ($i % 2 == 0) {
                                            echo '</div></div></div>';
                                            if ($count_posts != $i)
                                                echo '<div class="blog-item"> <div class="item"> <div class="row">';
                                        }
                                    }
                                    $i++;
                                } ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <?php

            echo $after_widget;
        }
    }

}

add_action('widgets_init', create_function('', 'register_widget("Everest_Posts_Slider");'));