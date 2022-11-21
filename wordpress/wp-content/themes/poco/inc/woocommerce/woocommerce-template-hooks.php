<?php
/**
 * Poco WooCommerce hooks
 *
 * @package poco
 */

/**
 * Layout
 *
 * @see  poco_before_content()
 * @see  poco_after_content()
 * @see  woocommerce_breadcrumb()
 * @see  poco_shop_messages()
 */
remove_action('woocommerce_before_main_content', 'woocommerce_breadcrumb', 20);
remove_action('woocommerce_before_main_content', 'woocommerce_output_content_wrapper', 10);
remove_action('woocommerce_after_main_content', 'woocommerce_output_content_wrapper_end', 10);
remove_action('woocommerce_sidebar', 'woocommerce_get_sidebar', 10);

add_action('woocommerce_before_main_content', 'poco_before_content', 10);
add_action('woocommerce_after_main_content', 'poco_after_content', 10);


add_action('woocommerce_before_shop_loop', 'poco_sorting_wrapper', 19);
add_action('woocommerce_before_shop_loop', 'poco_button_shop_canvas', 19);
add_action('woocommerce_before_shop_loop', 'poco_button_shop_dropdown', 19);
add_action('woocommerce_before_shop_loop', 'poco_button_grid_list_layout', 25);
add_action('woocommerce_before_shop_loop', 'poco_sorting_wrapper_close', 31);

add_action('wp_footer', 'poco_render_woocommerce_shop_mobile', 1);

if (poco_get_theme_option('woocommerce_archive_layout') == 'dropdown') {
    add_action('woocommerce_before_shop_loop', 'poco_render_woocommerce_shop_dropdown', 35);
}


if (poco_get_theme_option('woocommerce_archive_layout') == 'canvas') {
    add_action('wp_footer', 'poco_render_woocommerce_shop_canvas', 1);
}



//Position label onsale
remove_action('woocommerce_before_single_product_summary', 'woocommerce_show_product_sale_flash', 10);
add_action('woocommerce_before_single_product_summary', 'woocommerce_show_product_sale_flash', 30);

//Wrapper content single
add_action('woocommerce_before_single_product_summary', 'poco_woocommerce_single_content_wrapper_start', 0);
add_action('woocommerce_single_product_summary', 'poco_single_product_extra', 70);
add_action('woocommerce_single_product_summary', 'poco_woocommerce_single_content_wrapper_end', 99);
//add_action('woocommerce_single_product_summary', 'poco_woocommerce_bought_together_product', 39);

remove_action('woocommerce_single_product_summary','woocommerce_template_single_rating',10);
add_action('woocommerce_single_product_summary','woocommerce_template_single_rating',6);
remove_action('woocommerce_single_product_summary','woocommerce_template_single_excerpt',20);
add_action('woocommerce_single_product_summary','woocommerce_template_single_excerpt',9);


// Legacy WooCommerce columns filter.
if (defined('WC_VERSION') && version_compare(WC_VERSION, '3.3', '<')) {
    add_filter('loop_shop_columns', 'poco_loop_columns');
    add_action('woocommerce_before_shop_loop', 'poco_product_columns_wrapper', 40);
    add_action('woocommerce_after_shop_loop', 'poco_product_columns_wrapper_close', 40);
}

/**
 * Products
 *
 * @see poco_upsell_display()
 * @see poco_single_product_pagination()
 */


remove_action('woocommerce_product_thumbnails', 'woocommerce_show_product_thumbnails', 20);
add_action('woocommerce_product_thumbnails', 'woocommerce_show_product_thumbnails', 21);
add_action('yith_quick_view_custom_style_scripts', function () {
    wp_enqueue_script('flexslider');
});


add_action('woocommerce_single_product_summary', 'poco_woocommerce_time_sale', 11);

// Wishlist
add_action('woocommerce_after_add_to_cart_button', 'poco_woocommerce_product_loop_wishlist_button', 10);

add_action('woocommerce_share', 'poco_social_share', 10);

$product_single_style = poco_get_theme_option('wocommerce_single_style', 1);
switch ($product_single_style) {
    case 1:
        add_theme_support('wc-product-gallery-zoom');
        add_theme_support('wc-product-gallery-lightbox');
        add_theme_support('wc-product-gallery-slider');
        break;
    case 2:

        add_theme_support('wc-product-gallery-lightbox');
        add_filter('woocommerce_single_product_image_thumbnail_html', 'poco_woocommerce_single_product_image_thumbnail_html', 10, 2);
        break;
}

/**
 * Cart fragment
 *
 * @see poco_cart_link_fragment()
 */
if (defined('WC_VERSION') && version_compare(WC_VERSION, '2.3', '>=')) {
    add_filter('woocommerce_add_to_cart_fragments', 'poco_cart_link_fragment');
} else {
    add_filter('add_to_cart_fragments', 'poco_cart_link_fragment');
}

remove_action('woocommerce_cart_collaterals', 'woocommerce_cross_sell_display');
add_action('woocommerce_after_cart', 'woocommerce_cross_sell_display');

add_action('woocommerce_checkout_order_review', 'woocommerce_checkout_order_review_start', 5);
add_action('woocommerce_checkout_order_review', 'woocommerce_checkout_order_review_end', 15);

/*
 *
 * Layout Product
 *
 * */
function poco_include_hooks_product_blocks() {

    remove_action('woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_rating', 5);
    remove_action('woocommerce_before_shop_loop_item', 'woocommerce_template_loop_product_link_open', 10);
    remove_action('woocommerce_after_shop_loop_item', 'woocommerce_template_loop_product_link_close', 5);
    remove_action('woocommerce_before_shop_loop_item_title', 'woocommerce_template_loop_product_thumbnail', 10);
    remove_action('woocommerce_after_shop_loop_item', 'woocommerce_template_loop_add_to_cart', 10);

    add_action('woocommerce_before_shop_loop_item', 'poco_woocommerce_product_loop_start', -1);
    /**
     * Integrations
     *
     * @see poco_template_loop_product_thumbnail()
     *
     */
    add_action('woocommerce_before_shop_loop_item_title', 'poco_woocommerce_product_loop_image', 10);
    // Wishlist
    add_action('poco_woocommerce_product_loop_image', 'poco_woocommerce_product_loop_wishlist_button', 5);
    add_action('poco_woocommerce_product_loop_image', 'poco_template_loop_product_thumbnail', 10);
    add_action('poco_woocommerce_product_loop_image', 'woocommerce_template_loop_product_link_open', 99);
    add_action('poco_woocommerce_product_loop_image', 'woocommerce_template_loop_product_link_close', 99);

    add_action('woocommerce_shop_loop_item_title', 'poco_woocommerce_product_caption_start', -1);
    add_action('woocommerce_shop_loop_item_title', 'woocommerce_template_loop_rating', 5);

    add_action('woocommerce_shop_loop_item_title', 'poco_woocommerce_get_product_short_description', 20);
    add_action('woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_add_to_cart', 5);
    add_action('woocommerce_after_shop_loop_item', 'poco_woocommerce_product_caption_end', 998);
    add_action('woocommerce_after_shop_loop_item', 'poco_woocommerce_product_loop_end', 999);

}

poco_include_hooks_product_blocks();

