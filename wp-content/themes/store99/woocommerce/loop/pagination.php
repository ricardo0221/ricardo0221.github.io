<?php
/**
 * Pagination - Show numbered pagination for catalog pages
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/loop/pagination.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see        https://docs.woocommerce.com/document/template-structure/
 * @author        WooThemes
 * @package    WooCommerce/Templates
 * @version     2.2.2
 */

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly
}

global $wp_query, $store99_setting;

$store99_settings = get_option('store99_theme');

if ($wp_query->max_num_pages <= 1) {
    return;
}

if (get_theme_mod('store99_products_per_page'))
    $per_page = explode(',', get_theme_mod('store99_products_per_page'));
else
    $per_page = explode(',', '12,24,36');

$page_count = store99_loop_shop_per_page();
?>
<nav class="woocommerce-pagination">

    <form class="woocommerce-viewing" method="get">
        <span>View</span>
        <select name="count" class="count">
            <?php foreach ($per_page as $count) : ?>
                <option value="<?php echo esc_attr($count); ?>" <?php selected($page_count, $count); ?>><?php echo esc_html($count); ?></option>
            <?php endforeach; ?>
        </select>
        <input type="hidden" name="paged" value=""/>
        <?php
        // Keep query string vars intact
        foreach ($_GET as $key => $val) {
            if ('count' === $key || 'submit' === $key || 'paged' === $key) {
                continue;
            }
            if (is_array($val)) {
                foreach ($val as $innerVal) {
                    echo '<input type="hidden" name="' . esc_attr($key) . '[]" value="' . esc_attr($innerVal) . '" />';
                }
            } else {
                echo '<input type="hidden" name="' . esc_attr($key) . '" value="' . esc_attr($val) . '" />';
            }
        }
        ?>
    </form>

    <?php
    echo paginate_links(apply_filters('woocommerce_pagination_args', array(
        'base' => esc_url_raw(str_replace(999999999, '%#%', remove_query_arg('add-to-cart', get_pagenum_link(999999999, false)))),
        'format' => '',
        'add_args' => false,
        'current' => max(1, get_query_var('paged')),
        'total' => $wp_query->max_num_pages,
        'prev_text' => '<i class="fa fa-angle-left" aria-hidden="true"></i>',
        'next_text' => '<i class="fa fa-angle-right" aria-hidden="true"></i>',
        'type' => 'list',
        'end_size' => 3,
        'mid_size' => 3,
    )));
    ?>
</nav>