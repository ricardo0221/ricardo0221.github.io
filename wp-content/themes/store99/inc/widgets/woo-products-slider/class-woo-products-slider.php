<?php

/**
 * Class Everest_Woo_Products_Slider
 */
class Everest_Woo_Products_Slider extends WP_Widget
{

    /**
     * Register widget with WordPress.
     */
    function __construct()
    {
        parent::__construct(
            'everest-woo-products-slider-widget', // Base ID
            esc_html__('Everest: Woo Products Slider', 'store99'), // Name
            array(
                'classname' => 'everest-woo-products-slider-widget',
                'description' => esc_html__('Displays WooCommerce products slider.', 'store99'),
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
        $woocommerce_categories[''] = 'Select Category';

        foreach ($woocommerce_categories_obj as $category) {
            $woocommerce_categories[$category->term_id] = $category->name;
        }

        return array(

            'store99_cat_title' => array(
                'store99_widget_name' => 'category_title',
                'store99_widget_title' => __('Product Category Title', 'store99'),
                'store99_widget_field_type' => 'title',
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

    private function get_products($args, $instance)
    {
        $number = !empty($instance['number']) ? absint($instance['number']) : 10;
        $show = !empty($instance['show']) ? sanitize_title($instance['show']) : '';
        $orderby = !empty($instance['orderby']) ? sanitize_title($instance['orderby']) : 'date';
        $order = !empty($instance['order']) ? sanitize_title($instance['order']) : 'desc';
        $product_visibility_term_ids = wc_get_product_visibility_term_ids();

        $query_args = array(
            'posts_per_page' => $number,
            'post_status' => 'publish',
            'post_type' => 'product',
            'no_found_rows' => 1,
            'order' => $order,
            'meta_query' => array(),
            'tax_query' => array(
                'relation' => 'AND',
            ),
        );

        if (empty($instance['show_hidden'])) {
            $query_args['tax_query'][] = array(
                'taxonomy' => 'product_visibility',
                'field' => 'term_taxonomy_id',
                'terms' => is_search() ? $product_visibility_term_ids['exclude-from-search'] : $product_visibility_term_ids['exclude-from-catalog'],
                'operator' => 'NOT IN',
            );
            $query_args['post_parent'] = 0;
        }

        if (!empty($instance['hide_free'])) {
            $query_args['meta_query'][] = array(
                'key' => '_price',
                'value' => 0,
                'compare' => '>',
                'type' => 'DECIMAL',
            );
        }

        if ('yes' === get_option('woocommerce_hide_out_of_stock_items')) {
            $query_args['tax_query'] = array(
                array(
                    'taxonomy' => 'product_visibility',
                    'field' => 'term_taxonomy_id',
                    'terms' => $product_visibility_term_ids['outofstock'],
                    'operator' => 'NOT IN',
                ),
            );
        }

        switch ($show) {
            case 'featured' :
                $query_args['tax_query'][] = array(
                    'taxonomy' => 'product_visibility',
                    'field' => 'term_taxonomy_id',
                    'terms' => $product_visibility_term_ids['featured'],
                );
                break;
            case 'onsale' :
                $product_ids_on_sale = wc_get_product_ids_on_sale();
                $product_ids_on_sale[] = 0;
                $query_args['post__in'] = $product_ids_on_sale;
                break;
        }

        switch ($orderby) {
            case 'price' :
                $query_args['meta_key'] = '_price';
                $query_args['orderby'] = 'meta_value_num';
                break;
            case 'rand' :
                $query_args['orderby'] = 'rand';
                break;
            case 'sales' :
                $query_args['meta_key'] = 'total_sales';
                $query_args['orderby'] = 'meta_value_num';
                break;
            default :
                $query_args['orderby'] = 'date';
        }

        return new WP_Query(apply_filters('woocommerce_products_widget_query_args', $query_args));
    }

    private function store99_the_product_price($product)
    {
        //get the sale price of the product whether it be simple, grouped or variable
        $sale_price = get_post_meta(get_the_ID(), '_price', true);
        //get the regular price of the product, but of a simple product
        $regular_price = get_post_meta(get_the_ID(), '_regular_price', true);
        
        $currency_symbol = get_woocommerce_currency_symbol();

        if (!empty($sale_price)) {
            echo '<ins>' . esc_attr($currency_symbol) . esc_attr($sale_price) . '</ins>  ';
        }
        echo esc_attr($currency_symbol) . esc_attr($regular_price);
    }

    private function store99_get_product_rating_count($product_id, $rating = null)
    {
        global $wpdb;
        $where_meta_value = $rating ? $wpdb->prepare(" AND meta_value = %d", $rating) : " AND meta_value > 0";
        $count = $wpdb->get_var($wpdb->prepare("
                                          SELECT COUNT(meta_value) FROM $wpdb->commentmeta
                                          LEFT JOIN $wpdb->comments ON $wpdb->commentmeta.comment_id = $wpdb->comments.comment_ID
                                          WHERE meta_key = 'rating'
                                          AND comment_post_ID = %d
                                          AND comment_approved = '1'
                                          ", $product_id) . $where_meta_value);
        return $count;
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

        if (!empty($product_category)) {
            $category = get_term($product_category, 'product_cat');
            $category_name = $category->name;
        }
        if (($products = $this->get_products($args, $instance)) && $products->have_posts()) {
            $count_products = $products->post_count;
            echo $before_widget;

            ?>
            <div class="col-sm-12 col-md-4 col-lg-3">
                <?php
                if (!empty($cat_title)): ?>
                    <div class="new-arrivals">
                        <h5><?php echo esc_attr($cat_title); ?></h5>
                    </div>
                    <?php
                endif; ?>

                <div id="new-arrival" class="owl-carousel owl-theme">
                    <div class="item">
                        <div class="new">
                            <?php
                            $i = 1;
                            while ($products->have_posts()) {
                                $products->the_post();

                                $post_id = get_the_ID();
                                $image = wp_get_attachment_image_src(get_post_thumbnail_id($post_id), 'store99-product-small-slider-grid', false);
                                ?>
                                <div class="holder clearfix">
                                    <div class="left-img">
                                        <?php
                                        if (!empty($image)): ?>
                                            <img src="<?php echo esc_url($image[0]); ?>" alt="" class="">
                                            <?php
                                        else:
                                            ?>
                                            <img src="<?php echo esc_url(wc_placeholder_img_src()); ?>" alt=""
                                                 class="" width="81" height="81">
                                            <?php
                                        endif;
                                        ?>
                                    </div>
                                    <div class="right-text">
                                        <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                                        <?php
                                        if (get_option('woocommerce_enable_review_rating') === 'yes'):
                                            $rating = $this->store99_get_product_rating_count($post_id);
                                            echo wc_get_rating_html($rating);
                                            ?>
                                            <?php
                                        endif; ?>
                                        <span><?php $this->store99_the_product_price($products->the_post()); ?></span>
                                    </div>
                                </div>
                                <?php
                                if ($i % 3 == 0) {
                                    echo '</div></div>';
                                    if ($count_products != $i)
                                        echo '<div class="item"> <div class="new">';
                                }
                                $i++;
                            } ?>

                        </div>
                    </div>
                </div>
            </div>
            <?php

            echo $after_widget;
        }
    }

}

add_action('widgets_init', create_function('', 'register_widget("Everest_Woo_Products_Slider");'));