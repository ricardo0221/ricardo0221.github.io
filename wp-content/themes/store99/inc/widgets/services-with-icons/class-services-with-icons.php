<?php

class Everest_Services_With_Icons extends WP_Widget {

	/**
	 * Register widget with WordPress.
	 */
	public function __construct() {

		parent::__construct(
			'services-widget-classes', // Base ID
			__( 'Everest: Services With Images', 'store99' ),
			array(
				'classname'   => 'services-widget-classes',
				'description' => __( 'Display services with image.', 'store99' )
			) // Args
		);

	}

	/**
	 * Frontend display of widget.
	 *
	 * @see WP_Widget::widget()
	 *
	 * @param array $args Widget arguments.
	 * @param array $instance Saved values from database.
	 */
	public function widget( $args, $instance ) {

		extract( $args, EXTR_SKIP );

		$title = ( ! empty( $instance['title'] ) ) ? $instance['title'] : __( 'Services', 'store99' );
		$title = apply_filters( 'widget_title', $title, $instance, $this->id_base );

		$services = ( ! empty( $instance['services'] ) ) ? $instance['services'] : array();

		echo $before_widget;

		?>
        <div class="content">
            <div class="container">
                <div class="row">
					<?php

					foreach ( $services as $service ) {
						$title             = $service['title'];
						$featured_image    = $service['featured_image'];
						$featured_image_id = store99_get_image_id_by_link( $featured_image );
						$image_links       = wp_get_attachment_image_src( $featured_image_id, 'store99-services-grid' );
						$image_link        = $image_links[0];
						$description       = $service['description'];

						?>
                        <div class="col-sm-12 col-md-4">
                            <div class="support clearfix">
                                <img src="<?php echo ! empty( $image_link ) ? esc_url($image_link) : esc_attr(get_template_directory_uri() . '/img/call.jpg'); ?>"
                                     alt="">
                                <div class="text">
                                    <h6><?php echo esc_attr($title); ?></h6>
                                    <p><?php echo esc_attr($description); ?></p>
                                </div>
                            </div>
                        </div>
						<?php
					}

					?>
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
	public function update( $new_instance, $old_instance ) {

		$instance = $old_instance;

		$instance['title'] = strip_tags( $new_instance['title'] );

		foreach ( $new_instance['services'] as $service ) {
			$service['title']          = strip_tags( $service['title'] );
			$service['description']    = strip_tags( $service['description'] );
			$service['featured_image'] = strip_tags( $service['featured_image'] );
		}
		$instance['services'] = $new_instance['services'];

		return $instance;

	} // end widget

	/**
	 * Widget form.
	 *
	 * @see WP_Widget::form()
	 *
	 * @param array $instance Previously saved values from database.
	 *
	 * @return string|void
	 */
	public function form( $instance ) {

		$instance = wp_parse_args(
			(array) $instance
		);

		$title = isset( $instance['title'] ) ? esc_attr( $instance['title'] ) : ''; ?>
        <p><label for="<?php echo esc_attr($this->get_field_id( 'title' )); ?>"><?php __( 'Title:', 'store99' ); ?></label>
            <input class="widefat" id="<?php echo esc_attr($this->get_field_id( 'title' )); ?>"
                   name="<?php echo esc_attr($this->get_field_name( 'title' )); ?>" type="text" value="<?php echo esc_attr($title); ?>"/>
        </p>
		<?php

		$services = ( ! empty( $instance['services'] ) ) ? $instance['services'] : array(); ?>
        <span class="services-widget-classes-additional">

            <?php
            $c = 0;
            if ( count( $services ) > 0 ) {
	            foreach ( $services as $service ) {
		            if ( isset( $service['title'] ) || isset( $service['description'] ) || isset( $service['featured_image'] ) ) { ?>
                        <div class="repeater-item">
                            <p>
                                <label for="<?php echo esc_attr($this->get_field_id( 'services' )) . '-' . esc_attr($c) . '-title'; ?>"><?php __( 'Title:', 'store99' ); ?></label>
                                <input class="widefat"
                                       id="<?php echo esc_attr($this->get_field_id( 'services' )) . '-' . esc_attr($c) . '-title'; ?>"
                                       name="<?php echo esc_attr($this->get_field_name( 'services' )) . '[' . esc_attr($c) . '][title]'; ?>"
                                       type="text" value="<?php echo esc_attr($service['title']); ?>"/>
                            </p>

				            <?php
				            $output    = '';
				            $id_input  = $this->get_field_id( 'services' ) . '-' . $c . '-featured-image';
				            $id_button = $this->get_field_id( 'services' ) . '-' . $c . '-upload-button';
				            $class     = '';
				            $int       = '';
				            $value     = $service['featured_image'];
				            $name      = $this->get_field_name( 'services' ) . '[' . $c . '][featured_image]';

				            if ( $value ) {
					            $class = ' has-file';
				            }
				            $output .= '<div class="sub-option section widget-upload">';
				            $output .= '<label for="' . $id_input . '">Featured Image</label><br/>';
				            $output .= '<input id="' . $id_input . '" class="upload' . $class . '" type="text" name="' . $name . '" value="' . $value . '" placeholder="No file chosen">';

				            if ( function_exists( 'wp_enqueue_media' ) ) {
					            if ( ( $value == '' ) ) {
						            $output .= '<input id="upload-' . $id_button . '" class="upload-button-wdgt button" type="button" value="' . __( 'Upload', 'store99' ) . '" />' . "\n";
					            } else {
						            $output .= '<input id="remove-' . $id_button . '" class="remove-file button" type="button" value="' . __( 'Remove', 'store99' ) . '" />' . "\n";
					            }
				            } else {
					            $output .= '<p><i>' . __( 'Upgrade your version of WordPress for full media support.', 'store99' ) . '</i></p>';
				            }

				            $output .= '</div>' . "\n";
				            echo $output;
				            ?>

                            <p>
                                <label for="<?php echo esc_attr($this->get_field_id( 'services' )) . '-' . esc_attr($c) . '-description'; ?>"><?php __( 'Description:', 'store99' ); ?></label>
                                <input type="text" class="widefat"
                                       id="<?php echo esc_attr($this->get_field_id( 'services' )) . '-' . esc_attr($c) . '-description'; ?>"
                                       name="<?php echo esc_attr($this->get_field_name( 'services' )) . '[' . esc_attr($c) . '][description]'; ?>"
                                       value="<?php echo esc_attr($service['description']); ?>">
                            </p>
                            <a href="javascript:void(0)" class="button-link services-widget-classes-remove delete"
                               style="color: #a00;">Remove Service</a>
                        </div>
			            <?php
			            $c = $c + 1;
		            }
	            }
            }
            ?>
        </span>
        <p>
            <a href="javascript:void(0)" class="button-link services-widget-classes-add"
               style="color: #0073aa;"><?php esc_attr_e( 'Add Service', 'store99' ); ?></a>
        </p>
        <script type="text/javascript">
            jQuery(document).ready(function ($) {
                var count = 0;
                jQuery(".services-widget-classes-add").unbind("click").click(function (event) {
                    event.preventDefault();
                    var additional = $(this).parent().parent().parent().find('.services-widget-classes-additional');
                    var container = $(this).parent().parent().parent().parent().parent();
                    var container_class = container.attr('id');
                    var container_class_array = container_class.split("services-widget-classes-").reverse();
                    var instance = container_class_array[0];
                    count = additional.find('div.repeater-item').length;

                    if (count >= 3) {
                        alert('Please upgrade to pro to add unlimited number of services!');
                        return false;
                    }

                    additional.append('<div class="repeater-item">' +
                        '<p><label for="widget-services-widget-classes-' + instance + '-services-' + count + '-title">Title</label>' +
                        '<input class="widefat" id="widget-services-widget-classes-' + instance + '-services-' + count + '-title" name="widget-services-widget-classes[' + instance + '][services][' + count + '][title]" type="text" value="" /><p>' +

                        '<div class="sub-option section widget-upload">' +
                        '<label for="widget-services-widget-classes-' + instance + '-services-' + count + '-featured-image">Featured Image</label><br>' +
                        '<input class="upload" id="widget-services-widget-classes-' + instance + '-services-' + count + '-featured-image" name="widget-services-widget-classes[' + instance + '][services][' + count + '][featured_image]" type="text" placeholder="No file chosen" />' +
                        '<input id="widget-services-widget-classes-' + instance + '-services-' + count + '-upload-button" class="upload-button-wdgt button" type="button" value="Upload" /></div>' +

                        '<p><label for="widget-services-widget-classes-' + instance + '-services-' + count + '-description">Description</label>' +
                        '<input type="text" class="widefat" id="widget-services-widget-classes-' + instance + '-services-' + count + '-description" name="widget-services-widget-classes[' + instance + '][services][' + count + '][description]" value=""></p>' +
                        '<a href="javascript:void(0)" class="button-link services-widget-classes-remove delete" style="color: #a00;">Remove Service</a></div>');
                });
                jQuery(".services-widget-classes-remove").live('click', function () {
                    jQuery(this).parent().remove();
                });
            });
        </script>
		<?php

	}

}

add_action( 'widgets_init', create_function( '', 'register_widget("Everest_Services_With_Icons");' ) );