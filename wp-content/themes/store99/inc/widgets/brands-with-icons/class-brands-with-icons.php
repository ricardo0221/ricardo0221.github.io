<?php

class Everest_Brands_With_Icons extends WP_Widget
{

    /**
     * Register widget with WordPress.
     */
    public function __construct()
    {

        parent::__construct(
            'brands-widget-classes', // Base ID
            __('Everest: Brands With Images', 'store99'),
            array(
                'classname' => 'brands-widget-classes',
                'description' => __('Display brands with image.', 'store99')
            ) // Args
        );

	    /**
	     ** Enqueue scripts for file uploader
	     **/
	    if (!function_exists('store99_media_scripts')) {
		    function store99_media_scripts($hook)
		    {

			    if ('widgets.php' != $hook)
				    return;

			    if (function_exists('wp_enqueue_media'))
				    wp_enqueue_media();
			    wp_enqueue_script('store99-media-uploader', get_template_directory_uri() . '/inc/widgets/assets/store99-init-admin.js', array('jquery', 'customize-controls'), 1.0);
			    wp_localize_script('store99-media-uploader', 'store99_l10n', array(
				    'upload' => __('Upload', 'store99'),
				    'remove' => __('Remove', 'store99')
			    ));

		    }
	    }
	    add_action('admin_enqueue_scripts', 'store99_media_scripts');
    }

    private function store99_get_image_id_by_link($link)
    {
        global $wpdb;

        $link = preg_replace('/-\d+x\d+(?=\.(jpg|jpeg|png|gif)$)/i', '', $link);

        return $wpdb->get_var("SELECT ID FROM {$wpdb->posts} WHERE BINARY guid='$link'");
    }

    /**
     * Frontend display of widget.
     *
     * @see WP_Widget::widget()
     *
     * @param array $args Widget arguments.
     * @param array $instance Saved values from database.
     */
    public function widget($args, $instance)
    {

        extract($args, EXTR_SKIP);

        $title = (!empty($instance['title'])) ? $instance['title'] : __('Brands', 'store99');
        $title = apply_filters('widget_title', $title, $instance, $this->id_base);

        $brands = (!empty($instance['brands'])) ? $instance['brands'] : array();

        echo $before_widget;

        ?>
        <div class="col-sm-12 col-md-12 col-lg-4">
            <div class="brand">
                <?php
                if (!empty($title)): ?>
                    <div class="top-brand">
                        <h5><?php echo esc_attr($title); ?></h5>
                    </div>
                    <?php
                endif; ?>
                <div id="brand" class="owl-carousel owl-theme">
                    <div class="brand-item">
                        <div class="item">
                            <div class="row">
                                <?php
                                $i = 1;
                                $count_brands = count($brands);
                                foreach ($brands as $brand) {
                                    $title = $brand['title'];
                                    $link = $brand['link'];
                                    $featured_image = $brand['featured_image'];
                                    $featured_image_id = store99_get_image_id_by_link($featured_image);
                                    $image_link = '';
                                    if (!empty($featured_image_id))
                                        $image_link = wp_get_attachment_image_src($featured_image_id, '');
                                    ?>
                                    <div class="col-md-6 <?php echo $i % 2 == 0 ? 'even': 'odd'; ?>">
                                        <a href="<?php echo !empty($link) ? esc_url($link) : 'javascript:void(0)'; ?>"
                                           target="_blank">
                                            <?php if (isset($image_link[0]) && !empty($image_link[0])): ?>
                                                <img src="<?php echo esc_url($image_link[0]); ?>" alt="<?php echo esc_attr($title); ?>"
                                                     class="">
                                            <?php else:
                                                ?>
                                                <img src="<?php echo esc_url(wc_placeholder_img_src()); ?>" alt=""
                                                     class="img-responsive"
                                                     width="150"
                                                     height="150">
                                                <?php
                                            endif; ?>
                                        </a>
                                    </div>
                                    <?php
                                    if ($i >= 6) {
                                        if ($i % 6 == 0) {
                                            echo '</div></div></div>';
                                            if ($count_brands != $i)
                                                echo '<div class="brand-item"> <div class="item"> <div class="row">';
                                        }
                                    }
                                    $i++;
                                }
                                ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php

        echo $after_widget;

    } // end widget

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
    public function update($new_instance, $old_instance)
    {

        $instance = $old_instance;

        $instance['title'] = strip_tags($new_instance['title']);

        foreach ($new_instance['brands'] as $brand) {
            $brand['title'] = strip_tags($brand['title']);
            $brand['link'] = strip_tags($brand['link']);
            $brand['featured_image'] = strip_tags($brand['featured_image']);
        }
        $instance['brands'] = $new_instance['brands'];

        return $instance;

    } // end widget

    /**
     * Widget form.
     *
     * @see WP_Widget::form()
     *
     * @param array $instance Previously saved values from database.
     * @return string|void
     */
    public function form($instance)
    {

        $instance = wp_parse_args(
            (array)$instance
        );

        $title = isset($instance['title']) ? esc_attr($instance['title']) : ''; ?>
        <p><label for="<?php echo esc_attr($this->get_field_id('title')); ?>"><?php __('Title:', 'store99'); ?></label>
            <input class="widefat" id="<?php echo esc_attr($this->get_field_id('title')); ?>"
                   name="<?php echo esc_attr($this->get_field_name('title')); ?>" type="text" value="<?php echo esc_attr($title); ?>"/></p>
        <?php

        $brands = (!empty($instance['brands'])) ? $instance['brands'] : array(); ?>
        <span class="brands-widget-classes-additional">

            <?php
            $c = 0;
            if (count($brands) > 0) {
                foreach ($brands as $brand) {
                    if (isset($brand['title']) || isset($brand['link']) || isset($brand['featured_image'])) { ?>
                        <div class="repeater-item">
                            <p>
                                <label for="<?php echo esc_attr($this->get_field_id('brands')) . '-' . esc_attr($c) . '-title'; ?>"><?php __('Title:', 'store99'); ?></label>
                                <input class="widefat"
                                       id="<?php echo esc_attr($this->get_field_id('brands')) . '-' . esc_attr($c) . '-title'; ?>"
                                       name="<?php echo esc_attr($this->get_field_name('brands')) . '[' . esc_attr($c) . '][title]'; ?>"
                                       type="text" value="<?php echo esc_attr($brand['title']); ?>"/>
                            </p>

                            <p>
                                <label for="<?php echo esc_attr($this->get_field_id('brands')) . '-' . esc_attr($c) . '-link'; ?>"><?php __('Link:', 'store99'); ?></label>
                                <input class="widefat"
                                       id="<?php echo esc_attr($this->get_field_id('brands')) . '-' . esc_attr($c) . '-link'; ?>"
                                       name="<?php echo esc_attr($this->get_field_name('brands')) . '[' . esc_attr($c) . '][link]'; ?>"
                                       type="text" value="<?php echo esc_attr($brand['link']); ?>"/>
                            </p>


                            <?php
                            $output = '';
                            $id_input = $this->get_field_id('brands') . '-' . $c . '-featured-image';
                            $id_button = $this->get_field_id('brands') . '-' . $c . '-upload-button';
                            $class = '';
                            $int = '';
                            $value = $brand['featured_image'];
                            $name = esc_attr($this->get_field_name('brands')) . '[' . $c . '][featured_image]';

                            if ($value) {
                                $class = ' has-file';
                            }
                            $output .= '<div class="sub-option section widget-upload">';
                            $output .= '<label for="' . $id_input . '">Featured Image</label><br/>';
                            $output .= '<input id="' . $id_input . '" class="upload' . $class . '" type="text" name="' . $name . '" value="' . $value . '" placeholder="No file chosen">';

                            if (function_exists('wp_enqueue_media')) {
                                if (($value == '')) {
                                    $output .= '<input id="upload-' . $id_button . '" class="upload-button-wdgt button" type="button" value="' . __('Upload', 'store99') . '" />' . "\n";
                                } else {
                                    $output .= '<input id="remove-' . $id_button . '" class="remove-file button" type="button" value="' . __('Remove', 'store99') . '" />' . "\n";
                                }
                            } else {
                                $output .= '<p><i>' . __('Upgrade your version of WordPress for full media support.', 'store99') . '</i></p>';
                            }

                            $output .= '</div>' . "\n";
                            echo $output;
                            ?>

                            <a href="javascript:void(0)" class="button-link brands-widget-classes-remove delete"
                               style="color: #a00;">Remove Brand</a>
                        </div>
                        <?php
                        $c = $c + 1;
                    }
                }
            }
            ?>
        </span>
        <p>
            <a href="javascript:void(0)" class="button-link brands-widget-classes-add"
               style="color: #0073aa;"><?php esc_attr_e('Add Brand', 'store99'); ?></a>
        </p>
        <script type="text/javascript">
            jQuery(document).ready(function ($) {
                var count = 0;
                jQuery(".brands-widget-classes-add").unbind("click").click(function (event) {
                    event.preventDefault();
                    var additional = $(this).parent().parent().parent().find('.brands-widget-classes-additional');
                    var container = $(this).parent().parent().parent().parent().parent();
                    var container_class = container.attr('id');
                    var container_class_array = container_class.split("brands-widget-classes-").reverse();
                    var instance = container_class_array[0];
                    count = additional.find('div.repeater-item').length;

                    additional.append('<div class="repeater-item">' +
                        '<p><label for="widget-brands-widget-classes-' + instance + '-brands-' + count + '-title">Title</label>' +
                        '<input class="widefat" id="widget-brands-widget-classes-' + instance + '-brands-' + count + '-title" name="widget-brands-widget-classes[' + instance + '][brands][' + count + '][title]" type="text" value="" /><p>' +

                        '<p><label for="widget-brands-widget-classes-' + instance + '-brands-' + count + '-link">Link</label>' +
                        '<input class="widefat" id="widget-brands-widget-classes-' + instance + '-brands-' + count + '-link" name="widget-brands-widget-classes[' + instance + '][brands][' + count + '][link]" type="text" value="" /><p>' +

                        '<div class="sub-option section widget-upload">' +
                        '<label for="widget-brands-widget-classes-' + instance + '-brands-' + count + '-featured-image">Featured Image</label><br>' +
                        '<input class="upload" id="widget-brands-widget-classes-' + instance + '-brands-' + count + '-featured-image" name="widget-brands-widget-classes[' + instance + '][brands][' + count + '][featured_image]" type="text" placeholder="No file chosen" />' +
                        '<input id="widget-brands-widget-classes-' + instance + '-brands-' + count + '-upload-button" class="upload-button-wdgt button" type="button" value="Upload" /></div>' +

                        '<a href="javascript:void(0)" class="button-link brands-widget-classes-remove delete" style="color: #a00;">Remove Brand</a></div>');
                });
                jQuery(".brands-widget-classes-remove").live('click', function () {
                    jQuery(this).parent().remove();
                });
            });
        </script>
        <?php

    }

}

add_action('widgets_init', create_function('', 'register_widget("Everest_Brands_With_Icons");'));