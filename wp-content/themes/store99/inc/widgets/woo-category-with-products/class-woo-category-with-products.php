<?php

/**
 * Class Everest_Woo_Category_With_Products
 */
class Everest_Woo_Category_With_Products extends WP_Widget
{

    /**
     * Register widget with WordPress.
     */
    function __construct()
    {
        parent::__construct(
            'everest-woo-category-with-products-widget', // Base ID
            esc_html__('Everest: Woo Category With Products', 'store99'), // Name
            array(
                'classname' => 'everest-woo-category-with-products-widget',
                'description' => esc_html__('Displays WooCommerce category featured image with selected products.', 'store99'),
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
        $woocommerce_categories[''] = esc_html__('Select Category','store99');

        foreach ($woocommerce_categories_obj as $category) {
            $woocommerce_categories[$category->term_id] = $category->name;
        }

        return array(

            'store99_cat_title' => array(
                'store99_widget_name' => 'category_title',
                'store99_widget_title' => __('Product Category Title', 'store99'),
                'store99_widget_field_type' => 'title',
            ),

            'store99_category_image' => array(
                'store99_widget_name' => 'store99_category_image',
                'store99_widget_title' => __('Select Category Image', 'store99'),
                'store99_widget_field_type' => 'upload'
            ),

            'store99_woo_category' => array(
                'store99_widget_name' => 'product_category',
                'store99_widget_title' => __('Select Product Category', 'store99'),
                'store99_widget_field_type' => 'select',
                'store99_widget_field_options' => $woocommerce_categories
            ),

            'store99_product_number' => array(
                'store99_widget_name' => 'product_number',
                'store99_widget_title' => __('Number of products to show', 'store99'),
                'store99_widget_field_type' => 'number',
            ),
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

        $cat_title = !empty($instance['category_title']) ? $instance['category_title'] : '';
        $product_category = !empty($instance['product_category']) ? intval($instance['product_category']) : '';
        $product_number = !empty($instance['product_number']) ? intval($instance['product_number']) : '';
        $store99_category_image = !empty($instance['store99_category_image']) ? $instance['store99_category_image'] : '';

        if (!empty($product_category)) {
            $category = get_term($product_category, 'product_cat');
            $category_name = $category->name;
            $category_link = $category->slug;
        }

        if (!empty($store99_category_image)) {
            $thumbnail_id = store99_get_image_id_by_link($store99_category_image);
            $image_links  = wp_get_attachment_image_src($thumbnail_id, 'store99-woo-category-with-products-grid');
            $image_link   = $image_links[0];
        } else {
            $thumbnail_id = get_term_meta($category->term_id, 'thumbnail_id', true);
            $image_link = wp_get_attachment_image_src($thumbnail_id, 'store99-woo-category-with-products-grid');
            $image_link   = $image_links[0];
        }

        echo $before_widget;

        ?>
        <!-- smart-phone -->
        <div class="smart-phone">
            <div class="container">
                <div class="phone">
                    <h5><?php echo !empty($cat_title) ? esc_attr($cat_title) : esc_attr($category_name); ?></h5>
                </div>
                <div class="row">
                    <?php if (!empty($image_link)): ?>
                            <div class="col-sm-6 col-md-4 col-lg-3">
                                <div class="phone-add">
                                    <div class="cont">
                                        <a href="<?php echo esc_url(home_url()) . '/product-category/' . esc_url($category_link); ?>">
                                            <div>
                                                <img src="<?php echo esc_url($image_link); ?>" alt="" class="img-responsive">
                                            </div>
                                        </a>
                                    </div>
                                </div>
                            </div>
                    <?php endif; ?>
                    <div class="<?php echo !empty($image_link) ? 'col-sm-6 col-md-8 col-lg-9' : 'col-sm-12 col-md-12 col-lg-12'; ?>">
                        <ul class="owl-carousel owl-theme no-cat-image category-with-products">
                            <?php
                            $args_product = array(
                                'post_type' => 'product',
                                'tax_query' => array(
                                    array(
                                        'taxonomy' => 'product_cat',
                                        'field' => 'id',
                                        'terms' => $product_category
                                    )),
                                'posts_per_page' => $product_number
                            );

                            $query = new WP_Query($args_product);

                            if ($query->have_posts()):
                                while ($query->have_posts()): $query->the_post();

                                    wc_get_template_part('content', 'product');

                                endwhile;
                            endif;
                            wp_reset_query(); ?>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <?php

        echo $after_widget;
    }

}

add_action('widgets_init', create_function('', 'register_widget("Everest_Woo_Category_With_Products");'));