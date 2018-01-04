<?php
/**
 * Sanitize Functions
 */
 
/** Customizer Font Size Sanitize **/
function trendpress_sanitize_font_size($input){
    $trendpress_font_size = trendpress_font_size();
    if(array_key_exists($input,$trendpress_font_size)){
        return $input;
    }
    else{
        return  '';
    }
}

/** Customizer Textarea Sanitize **/
function trendpress_sanitize_textarea($input){
    return wp_kses_post(force_balance_tags($input));
}

/** Customizer Category List Sanitize **/
function trendpress_sanitize_post_cat_list($input){
    $trendpress_cat_list = trendpress_Category_list();
    if(array_key_exists($input,$trendpress_cat_list)){
        return $input;
    }
    else{
        return '';
    }
}

/** Customizer Checkbox Sanitize **/
function trendpress_sanitize_checkbox($input){
    if($input == 1){
        return 1;
    }
    else{
        return '';
    }
}

/** Customizer Post List Sanitize **/
function trendpress_sanitize_post_select($input){
    $trendpress_posts_list = trendpress_Posts_List();
    if(array_key_exists($input,$trendpress_posts_list)){
        return $input;
    }
    else{
        return  '';
    }
}

