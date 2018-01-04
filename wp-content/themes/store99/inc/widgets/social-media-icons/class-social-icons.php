<?php

/**
 * Class Everest_Social_Icons
 */
class Everest_Social_Icons extends WP_Widget
{

    /**
     * Register widget with WordPress.
     */
    function __construct()
    {
        parent::__construct(
            'everest-social-icons-widget', // Base ID
            esc_html__('Everest: Social Icons', 'store99'), // Name
            array(
                'classname' => 'everest-social-icons-widget',
                'description' => esc_html__('Displays a links of social icons.', 'store99'),
            ) // Args
        );

    }

    private $social_media_icons = array(
        'Facebook' => 'facebook',
        'Twitter' => 'twitter',
        'Google+' => 'google-plus',
        'LinkedIn' => 'linkedin',
        'Instagram' => 'instagram',
        'YouTube' => 'youtube',
        'Pinterest' => 'pinterest',
        'Email' => 'envelope',
        'RSS Feed' => 'rss',
        'Tumblr' => 'tumblr',
        'Reddit' => 'reddit',
        'Vimeo' => 'vimeo',
        'Dribbble' => 'dribbble',
        'Flickr' => 'flickr',
        'WhatsApp' => 'whatsapp',
    );

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
        foreach ($this->social_media_icons as $site => $id) {
            if (!isset($instance[$id])) {
                $instance[$id] = '';
            }
        }

        if (!isset($instance['title'])) {
            $instance['title'] = '';
        }
        ?>

        <div class="social_media_icons_widget">

            <p><label for="<?php echo esc_attr($this->get_field_id('title')); ?>">Title:</label>
                <input class="widefat" type="text" id="<?php echo esc_attr($this->get_field_id('title')); ?>"
                       name="<?php echo esc_attr($this->get_field_name('title')); ?>"
                       value="<?php echo esc_attr($instance['title']); ?>"/></p>

            <ul class="social_accounts">
                <?php foreach ($this->social_media_icons as $site => $id) : ?>
                    <li>
                        <label for="<?php echo esc_attr($this->get_field_id($id)); ?>"
                               class="<?php echo esc_attr($id); ?>"><?php echo esc_attr($site); ?>:</label>
                        <input class="widefat" type="text" id="<?php echo esc_attr($this->get_field_id($id)); ?>"
                               name="<?php echo esc_attr($this->get_field_name($id)); ?>"
                               value="<?php echo esc_attr($instance[$id]); ?>"/>
                    </li>
                <?php endforeach; ?>
            </ul>

        </div>
        <?php
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
        $instance = array();

        foreach ($this->social_media_icons as $site => $id) {
            $instance[$id] = $new_instance[$id];
        }

        $instance['title'] = $new_instance['title'];

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

        $siw_title = empty($instance['title']) ? '' : apply_filters('widget_title', $instance['title']);

        echo $before_widget;

        if (!empty($siw_title))
            echo $before_title . apply_filters('widget_title', $siw_title, $instance, $this->id_base) . $after_title;

        echo '<ul class="everest-social-media-icons">';

        foreach ($this->social_media_icons as $si_title => $id) :
            $instance_id = esc_attr($instance[$id]);
            if (!empty($instance_id))
                echo '<li> <a href="' . esc_attr($instance[$id]) . '" target="_blank"> <i class="fa fa-' . esc_attr($id) . '" aria-hidden="true"></i> </a> </li>';
        endforeach;

        echo '</ul>';

        echo $after_widget;
    }

}

add_action('widgets_init', create_function('', 'register_widget("Everest_Social_Icons");'));