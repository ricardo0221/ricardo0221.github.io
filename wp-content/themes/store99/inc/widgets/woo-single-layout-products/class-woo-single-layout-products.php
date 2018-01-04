<?php

/**
 * Class Everest_Woo_Single_Layout_Products
 */
class Everest_Woo_Single_Layout_Products extends WP_Widget
{

    /**
     * Register widget with WordPress.
     */
    function __construct()
    {
        parent::__construct(
            'everest-woo-single-layout-products-widget', // Base ID
            esc_html__('Everest: Woo Single Layout Products', 'store99'), // Name
            array(
                'classname' => 'everest-woo-single-layout-products-widget',
                'description' => esc_html__('Displays WooCommerce products with having layout design.', 'store99'),
            ) // Args
        );

    }

    private function widget_fields()
    {
        return array(

            'title' => array(
                'store99_widget_name' => 'title',
                'store99_widget_title' => __('Title', 'store99'),
                'store99_widget_field_type' => 'title',
            ),

            'number' => array(
                'store99_widget_name' => 'number',
                'store99_widget_title' => __('Number of products to show', 'store99'),
                'store99_widget_field_type' => 'number'
            ),

            'show' => array(
                'store99_widget_name' => 'show',
                'store99_widget_title' => __('Show', 'store99'),
                'store99_widget_field_type' => 'select',
                'store99_widget_field_options' => array(
                    '' => __('All products', 'store99'),
                    'featured' => __('Featured products', 'store99'),
                    'onsale' => __('On-sale products', 'store99'),
                ),
            ),

            'orderby' => array(
                'store99_widget_name' => 'orderby',
                'store99_widget_title' => __('Order by', 'store99'),
                'store99_widget_field_type' => 'select',
                'store99_widget_field_options' => array(
                    'date' => __('Date', 'store99'),
                    'price' => __('Price', 'store99'),
                    'rand' => __('Random', 'store99'),
                    'sales' => __('Sales', 'store99'),
                ),
            ),

            'order' => array(
                'store99_widget_name' => 'order',
                'store99_widget_title' => __('Sorting Order', 'store99'),
                'store99_widget_field_type' => 'select',
                'store99_widget_field_options' => array(
                    'asc' => __('ASC', 'store99'),
                    'desc' => __('DESC', 'store99'),
                ),
            ),

            'hide_free' => array(
                'store99_widget_name' => 'hide_free',
                'store99_widget_title' => __('Hide Free Products', 'store99'),
                'store99_widget_field_type' => 'checkbox'
            ),

            'show_hidden' => array(
                'store99_widget_name' => 'show_hidden',
                'store99_widget_title' => __('Show Hidden Products', 'store99'),
                'store99_widget_field_type' => 'checkbox'
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
        //oh, the product is variable to $sale_price is empty? Lets get a variation price
        if ($regular_price == "") {
            #Step 1: Get product varations
            $available_variations = $product->get_available_variations();
            if ($available_variations) {
                #Step 2: Get product variation id
                $variation_id = $available_variations[0]['variation_id']; // Getting the variable id of just the 1st product. You can loop $available_variations to get info about each variation.
                #Step 3: Create the variable product object
                $variable_product1 = new WC_Product_Variation($variation_id);
                #Step 4: You have the data. Have fun :)
                $regular_price = $variable_product1->regular_price;
            }
        }

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

        $title = !empty($instance['title']) ? $instance['title'] : 'Featured';

        if (($products = $this->get_products($args, $instance)) && $products->have_posts()) {

            echo $before_widget;

            ?>

            <div class="col-sm-12 col-md-8 col-lg-9">
                <?php
                if (!empty($title)): ?>
                    <div class="hot-deal">
                        <h5><?php echo esc_attr($title); ?></h5>
                    </div>
                    <?php
                endif; ?>
                <div id="hot-product" class="owl-carousel owl-theme">
                    <?php
                    while ($products->have_posts()) {
                        $products->the_post();

                        $post_id = get_the_ID();
                        $image = wp_get_attachment_image_src(get_post_thumbnail_id($post_id), 'store99-product-single-layout-slider-grid', false);

                        ?>
                        <div class="item" <?php the_ID(); ?>>
                            <div class="product">
                                <div class="product-wrap clearfix">
                                  <div class="row">
                                      <div class="col-xs-12 col-sm-5 col-md-5">
                                        <div class="img-info">
                                            <a href="<?php the_permalink(); ?>">
                                                <?php
                                                if (!empty($image)): ?>
                                                    <img src="<?php echo esc_url($image[0]); ?>" alt="" class="img-responsive">
                                                    <?php
                                                else:
                                                    ?>
                                                    <img src="<?php echo esc_url(wc_placeholder_img_src()); ?>" alt=""
                                                         class="img-responsive" width="327" height="327">
                                                    <?php
                                                endif;
                                                ?>
                                            </a>
                                        </div>  
                                      </div>
                                      <div class="col-xs-12 col-sm-7 col-md-7">
                                        <div class="detail clearfix">
                                            <h5>
                                                <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                                            </h5>
                                            <?php
                                            if (get_option('woocommerce_enable_review_rating') === 'yes'):
                                                $rating = $this->store99_get_product_rating_count($post_id);
                                                echo wc_get_rating_html($rating);
                                                ?>
                                                <?php
                                            endif; ?>
                                            <span><?php $this->store99_the_product_price($products->the_post()); ?></span>
                                            <p><?php echo esc_html( $products->post->post_excerpt ); ?></p>
                                            <div class="add-to-card">
                                                <?php woocommerce_template_loop_add_to_cart(); ?>
                                            </div>
                                            <div class="quick-view">
                                                <a href="<?php echo home_url('/'); ?>wp-admin-ajax.php?action=store99_quick_view_ajax_call&product=<?php the_ID(); ?>"
                                                   class="open-popup-link">
                                                    <span>
                                                        <i class="fa fa-eye" aria-hidden="true"></i>
                                                    </span>
                                                </a>
                                            </div>
                                        </div>                                          
                                      </div>

                                  </div>  
                                    

                                </div>
                            </div>
                        </div>
                        <?php
                    } ?>
                </div>
            </div>

            <?php

            echo $after_widget;
        }
    }

}

add_action('widgets_init', create_function('', 'register_widget("Everest_Woo_Single_Layout_Products");'));