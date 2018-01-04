<?php
function store99_update_widget_fields($widget_field, $new_field_value)
{
    extract($widget_field);

    if ($store99_widget_field_type == 'number') {
        return absint($new_field_value);
    } elseif ($store99_widget_field_type == 'textarea') {
        if (!isset($store99_widget_allowed_tags)) {
            $store99_widget_allowed_tags = '<p><strong><em><a>';
        }
        return strip_tags($new_field_value, $store99_widget_allowed_tags);
    } elseif ($store99_widget_field_type == 'url') {
        return esc_url_raw($new_field_value);
    } elseif ($store99_widget_field_type == 'title') {
        return wp_kses_post($new_field_value);
    } elseif ($store99_widget_field_type == 'checkboxes') {
        return wp_kses_post($new_field_value);
    } else {
        return strip_tags($new_field_value);
    }
}