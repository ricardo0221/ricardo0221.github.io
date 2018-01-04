<?php
function store99_show_widget_fields($instance = '', $widget_field = '', $store99_field_value = '')
{

    //list category list in array
    $store99_category_list[0] = array(
        'value' => 0,
        'label' => 'Select Categories'
    );
    $store99_posts = get_categories();
    foreach ($store99_posts as $store99_post) :
        $store99_category_list[$store99_post->term_id] = array(
            'value' => $store99_post->term_id,
            'label' => $store99_post->name
        );
    endforeach;


    // Store Posts in array
    $store99_pagelist[0] = array(
        'value' => 0,
        'label' => 'Select Pages'
    );
    $arg = array('posts_per_page' => -1);
    $store99_pages = get_pages($arg);
    foreach ($store99_pages as $store99_page) :
        $store99_pagelist[$store99_page->ID] = array(
            'value' => $store99_page->ID,
            'label' => $store99_page->post_title
        );
    endforeach;

    extract($widget_field);

    switch ($store99_widget_field_type) {

        // Text field
        case 'text' :
            ?>
            <p>
                <label for="<?php echo esc_attr($instance->get_field_id($store99_widget_name)); ?>"><?php echo esc_attr($store99_widget_title); ?>
                    :</label>
                <input class="widefat" id="<?php echo esc_attr($instance->get_field_id($store99_widget_name)); ?>"
                       name="<?php echo esc_attr($instance->get_field_name($store99_widget_name)); ?>" type="text"
                       value="<?php echo esc_attr($store99_field_value); ?>"/>
            </p>
            <?php
            break;

        // Title field
        case 'title' :
            ?>
            <p>
                <label for="<?php echo esc_attr($instance->get_field_id($store99_widget_name)); ?>"><?php echo esc_attr($store99_widget_title); ?>
                    :</label>
                <input class="widefat" id="<?php echo esc_attr($instance->get_field_id($store99_widget_name)); ?>"
                       name="<?php echo esc_attr($instance->get_field_name($store99_widget_name)); ?>" type="text"
                       value="<?php echo esc_attr($store99_field_value); ?>"/>
            </p>
            <?php
            break;

        case 'group_start' :
            ?>
            <div class="store99-main-group" id="ap-font-awesome-list <?php echo esc_attr($instance->get_field_id(($store99_widget_name))); ?>">
            <div class="store99-main-group-heading"
                 style="font-size: 15px;  font-weight: bold;  padding-top: 12px;"><?php echo esc_attr($store99_widget_title); ?>
                <span class="toogle-arrow"></span></div>
            <div class="store99-main-group-wrap">

            <?php
            break;

        case 'group_end':
            ?></div>
            </div><?php
            break;

        // Textarea field
        case 'textarea' :
            ?>
            <p>
                <label for="<?php echo esc_attr($instance->get_field_id($store99_widget_name)); ?>"><?php echo esc_attr($store99_widget_title); ?>
                    :</label>
                <textarea class="widefat" rows="<?php echo esc_attr($store99_widget_row); ?>"
                          id="<?php echo esc_attr($instance->get_field_id($store99_widget_name)); ?>"
                          name="<?php echo esc_attr($instance->get_field_name($store99_widget_name)); ?>"><?php echo esc_attr($store99_field_value); ?></textarea>
            </p>
            <?php
            break;

        // Checkbox field
        case 'checkbox' :
            ?>
            <p>
                <input id="<?php echo esc_attr($instance->get_field_id($store99_widget_name)); ?>"
                       name="<?php echo esc_attr($instance->get_field_name($store99_widget_name)); ?>" type="checkbox"
                       value="1" <?php checked('1', $store99_field_value); ?>/>
                <label for="<?php echo esc_attr($instance->get_field_id($store99_widget_name)); ?>"><?php echo esc_attr($store99_widget_title); ?></label>
            </p>
            <?php
            break;

        // Radio fields
        case 'radio' :
            ?>
            <p>
                <?php
                echo esc_attr($store99_widget_title);
                echo '<br />';
                foreach ($store99_widget_field_options as $store99_option_name => $store99_option_title) {
                    ?>
                    <input id="<?php echo esc_attr($instance->get_field_id($store99_option_name)); ?>"
                           name="<?php echo esc_attr($instance->get_field_name($store99_widget_name)); ?>" type="radio"
                           value="<?php echo esc_attr($store99_option_name); ?>" <?php checked($store99_option_name, $store99_field_value); ?> />
                    <label for="<?php echo esc_attr($instance->get_field_id($store99_option_name)); ?>"><?php echo esc_attr($store99_option_title); ?></label>
                    <br/>
                <?php } ?>

                <?php if (isset($store99_widget_description)) { ?>
                    <small><?php echo esc_attr($store99_widget_description); ?></small>
                <?php } ?>
            </p>
            <?php
            break;

        // Select field
        case 'select' :
            ?>
            <p>
                <label for="<?php echo esc_attr($instance->get_field_id($store99_widget_name)); ?>"><?php echo esc_attr($store99_widget_title); ?>
                    :</label>
                <select name="<?php echo esc_attr($instance->get_field_name($store99_widget_name)); ?>"
                        id="<?php echo esc_attr($instance->get_field_id($store99_widget_name)); ?>" class="widefat">
                    <?php foreach ($store99_widget_field_options as $store99_option_name => $store99_option_title) { ?>
                        <option value="<?php echo esc_attr($store99_option_name); ?>"
                                id="<?php echo esc_attr($instance->get_field_id($store99_option_name)); ?>" <?php selected($store99_option_name, $store99_field_value); ?>><?php echo esc_attr($store99_option_title); ?></option>
                    <?php } ?>
                </select>
            </p>
            <?php
            break;

        // Select pages fields
        case 'selectpage' :
            ?>
            <p>
                <label for="<?php echo esc_attr($instance->get_field_id($store99_widget_name)); ?>"><?php echo esc_attr($store99_widget_title); ?>
                    :</label>
                <select name="<?php echo esc_attr($instance->get_field_name($store99_widget_name)); ?>"
                        id="<?php echo esc_attr($instance->get_field_id($store99_widget_name)); ?>" class="widefat">
                    <?php foreach ($store99_pagelist as $store99_page) { ?>
                        <option value="<?php echo esc_attr($store99_page['value']); ?>"
                                id="<?php echo esc_attr($instance->get_field_id($store99_page['label'])); ?>" <?php selected($store99_page['value'], $store99_field_value); ?>><?php echo $store99_page['label']; ?></option>
                    <?php } ?>
                </select>
            </p>
            <?php
            break;

        case 'number' :
            ?>
            <p>
                <label for="<?php echo esc_attr($instance->get_field_id($store99_widget_name)); ?>"><?php echo esc_attr($store99_widget_title); ?>
                    :</label><br/>
                <input name="<?php echo esc_attr($instance->get_field_name($store99_widget_name)); ?>" type="number" step="4"
                       min="4" id="<?php echo esc_attr($instance->get_field_id($store99_widget_name)); ?>"
                       value="<?php echo !empty($store99_field_value) ? esc_attr($store99_field_value) : 10; ?>" class="widefat"/>
            </p>
            <?php
            break;

        // Select category field
        case 'select_category' :
            ?>
            <p>
                <label for="<?php echo esc_attr($instance->get_field_id($store99_widget_name)); ?>"><?php echo esc_attr($store99_widget_title); ?>
                    :</label>
                <select name="<?php echo esc_attr($instance->get_field_name($store99_widget_name)); ?>"
                        id="<?php echo esc_attr($instance->get_field_id($store99_widget_name)); ?>" class="widefat">
                    <?php foreach ($store99_category_list as $store99_single_post) { ?>
                        <option value="<?php echo esc_attr($store99_single_post['value']); ?>"
                                id="<?php echo esc_attr($instance->get_field_id($store99_single_post['label'])); ?>" <?php selected($store99_single_post['value'], $store99_field_value); ?>><?php echo esc_attr($store99_single_post['label']); ?></option>
                    <?php } ?>
                </select>
            </p>
            <?php
            break;

        // Checkboxes
        case 'checkboxes' :

            if (isset($store99_mulicheckbox_title)) { ?>
                <label><?php echo esc_attr($store99_mulicheckbox_title); ?>:</label>
            <?php }
            echo '<div class="store99-checkboxes" style="height: 150px; overflow: auto; border: 1px solid #ccc; padding: 0 10px; margin: 1em 0;">';
            foreach ($store99_widget_field_options as $store99_option_name => $store99_option_title) {
                if (isset($store99_field_value[$store99_option_name])) {
                    $store99_field_value[$store99_option_name] = 1;
                } else {
                    $store99_field_value[$store99_option_name] = 0;
                }
                ?>
                <p>
                    <input id="<?php echo $instance->get_field_id($store99_option_name); ?>"
                           name="<?php echo esc_attr($instance->get_field_name($store99_widget_name)) . '[' . esc_attr($store99_option_name) . ']'; ?>"
                           type="checkbox"
                           value="1" <?php checked('1', $store99_field_value[$store99_option_name]); ?>/>
                    <label for="<?php echo esc_attr($instance->get_field_id($store99_option_name)); ?>"><?php echo esc_attr($store99_option_title); ?></label>
                </p>
                <?php
            }
            echo '</div>';
            if (isset($store99_widget_description)) {
                ?>
                <small><em><?php echo esc_attr($store99_widget_description); ?></em></small>
                <?php
            }

            break;

        case 'upload' :

            $output = '';
            $id = $instance->get_field_id($store99_widget_name);
            $class = '';
            $int = '';
            $value = $store99_field_value;
            $name = $instance->get_field_name($store99_widget_name);

            if ($value) {
                $class = ' has-file';
            }
            $output .= '<div class="sub-option section widget-upload">';
            $output .= '<label for="' . $instance->get_field_id($store99_widget_name) . '">' . $store99_widget_title . '</label><br/>';
            $output .= '<input id="' . $id . '" class="upload' . $class . '" type="text" name="' . $name . '" value="' . $value . '" placeholder="' . __('No file chosen', 'store99') . '" />' . "\n";

            if (function_exists('wp_enqueue_media')) {
                if (($value == '')) {
                    $output .= '<input id="upload-' . $id . '" class="upload-button-wdgt button" type="button" value="' . __('Upload', 'store99') . '" />' . "\n";
                } else {
                    $output .= '<input id="remove-' . $id . '" class="remove-file button" type="button" value="' . __('Remove', 'store99') . '" />' . "\n";
                }
            } else {
                $output .= '<p><i>' . __('Upgrade your version of WordPress for full media support.', 'store99') . '</i></p>';
            }

            $output .= '<div class="screenshot team-thumb" id="' . $id . '-image">' . "\n";
            if ($value != '') {
                $remove = '<a class="button-link remove-image">Remove</a>';
                $image = preg_match('/(^.*\.jpg|jpeg|png|gif|ico*)/i', $value);
                if ($image) {
                    $output .= '<img src="' . $value . '" alt="" width="50%" />' . $remove;
                } else {
                    $parts = explode("/", $value);
                    for ($i = 0; $i < sizeof($parts); ++$i) {
                        $title = $parts[$i];
                    }
                    $output .= '';
                    $title = __('View File', 'store99');
                    $output .= '<div class="no-image"><span class="file_link"><a href="' . $value . '" target="_blank" rel="external">' . $title . '</a></span></div>';
                }
            }
            $output .= '</div></div>' . "\n";
            echo $output;
            break;

        case 'button' :
            ?>
            <p>
                <a class="nama-widget-classes-add"><?php __('Add Row', 'store99'); ?></a>
            </p>
            <?php
            break;
    }
}