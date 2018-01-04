<?php

/**
 * Class Everest_Woo_Categories
 */
class Everest_Woo_Categories extends WP_Widget
{

    /**
     * Register widget with WordPress.
     */
    function __construct()
    {
        parent::__construct(
            'everest-woo-categories-widget', // Base ID
            esc_html__('Everest: Woo Categories', 'store99'), // Name
            array(
                'classname' => 'everest-woo-categories-widget',
                'description' => esc_html__('Displays WooCommerce categories.', 'store99'),
            ) // Args
        );

    }

    private function widget_fields()
    {
        $args = array(
            'taxonomy' => 'product_cat',
            'orderby' => 'name',
            'show_count' => 0,
            'pad_counts' => 0,
            'hierarchical' => 1,
            'title_li' => '',
            'hide_empty' => 0
        );

        $woocommerce_categories_obj = get_categories($args);
        $woocommerce_categories = array();

        foreach ($woocommerce_categories_obj as $category) {
            $woocommerce_categories[$category->term_id] = $category->name;
        }

        return array(

            'store99_cat_title' => array(
                'store99_widget_name' => 'title',
                'store99_widget_title' => __('Title', 'store99'),
                'store99_widget_field_type' => 'title',
            ),

            'store99_woo_category' => array(
                'store99_widget_name' => 'product_categories',
                'store99_widget_title' => __('Select Categories', 'store99'),
                'store99_widget_field_type' => 'checkboxes',
                'store99_widget_field_options' => $woocommerce_categories
            )
        );
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

        $title = !empty($instance['title']) ? $instance['title'] : '';
        $categories = !empty($instance['product_categories']) ? $instance['product_categories'] : '';

        echo $before_widget;

        ?>

        <div class="our-catagories" style="margin-top: 30px">
            <div class="container">
                <?php
                if (!empty($title)): ?>
                    <div class="catagories">
                        <h5><?php echo $title; ?></h5>
                    </div>
                <?php endif; ?>

                <div class="catagories-product clearfix">
                    <?php
                    $i = 1;
                    $count_categories = count($categories);

                    foreach ($categories as $c_key => $c_val):
                        $cat = get_term($c_key, 'product_cat');
                        $cat_name = $cat->name;
                        $term_link = get_term_link($c_key);
                        $meta = get_term_meta($c_key);

                        $thumb_url = "";
                        if (isset($meta['thumbnail_id'][0])):
                            $thumb_id = $meta['thumbnail_id'][0];
                            $thumb_url = wp_get_attachment_image_url($thumb_id, 'store99-product-category-list-grid');
                        endif;
                        ?>
                        <div class="contro clearfix">
                            <div class="product-img">
                                <?php
                                if (!empty($thumb_url)): ?>
                                    <img src="<?php echo !empty($thumb_url) ? esc_url($thumb_url) : esc_url(wc_placeholder_img_src()); ?>"
                                         alt="" class="img-responsive" width="174" height="174">
                                    <?php
                                else:
                                    ?>
                                    <img src="<?php echo esc_url(wc_placeholder_img_src()); ?>" alt="" class="" width="174"
                                         height="174">
                                    <?php
                                endif
                                ?>
                            </div>
                            <div class="product-text">

                                <a href="<?php echo esc_url($term_link); ?>">
                                    <h6>
                                        <?php echo esc_attr($cat_name); ?>
                                    </h6>
                                </a>
                                <?php
                                $sub_cat_args = array(
                                    'taxonomy' => 'product_cat',
                                    'child_of' => 0,
                                    'parent' => $c_key,
                                    'orderby' => 'name',
                                    'show_count' => 0,
                                    'pad_counts' => 0,
                                    'hierarchical' => 1,
                                    'title_li' => '',
                                    'hide_empty' => 0
                                );
                                $sub_cats = get_categories($sub_cat_args);
                                if ($sub_cats) {
                                    echo '<ul>';
                                    foreach ($sub_cats as $sub_cat) {
                                        echo '<li><a href="' . esc_url(get_term_link($sub_cat->term_id)) . '">' . esc_attr($sub_cat->name) . '</a></li>';
                                    }
                                    echo '</ul>';
                                }
                                ?>
                            </div>
                        </div>
                        <?php
                        if ($i % 3 == 0) {
                            echo '</div>';
                            if ($count_categories != $i)
                                echo '<div class="catagories-product clearfix">';
                        }
                        $i++;
                    endforeach;
                    ?>
                </div>
            </div>
        </div>

        <?php

        echo $after_widget;
    }

}

add_action('widgets_init', create_function('', 'register_widget("Everest_Woo_Categories");'));