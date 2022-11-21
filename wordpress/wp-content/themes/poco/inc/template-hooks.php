<?php
/**
 * =================================================
 * Hook poco_page
 * =================================================
 */
add_action('poco_page', 'poco_page_header', 10);
add_action('poco_page', 'poco_page_content', 20);

/**
 * =================================================
 * Hook poco_single_post_top
 * =================================================
 */
add_action('poco_single_post_top', 'poco_post_thumbnail', 10);

/**
 * =================================================
 * Hook poco_single_post
 * =================================================
 */
add_action('poco_single_post', 'poco_post_header', 10);
add_action('poco_single_post', 'poco_post_content', 30);

/**
 * =================================================
 * Hook poco_single_post_bottom
 * =================================================
 */
add_action('poco_single_post_bottom', 'poco_post_taxonomy', 5);
add_action('poco_single_post_bottom', 'poco_post_nav', 10);
add_action('poco_single_post_bottom', 'poco_display_comments', 20);

/**
 * =================================================
 * Hook poco_loop_post
 * =================================================
 */
add_action('poco_loop_post', 'poco_post_thumbnail', 10);
add_action('poco_loop_post', 'poco_post_header', 15);
add_action('poco_loop_post', 'poco_post_content', 30);

/**
 * =================================================
 * Hook poco_footer
 * =================================================
 */
add_action('poco_footer', 'poco_footer_default', 20);

/**
 * =================================================
 * Hook poco_after_footer
 * =================================================
 */

/**
 * =================================================
 * Hook wp_footer
 * =================================================
 */
add_action('wp_footer', 'poco_template_account_dropdown', 1);
add_action('wp_footer', 'poco_mobile_nav', 1);

/**
 * =================================================
 * Hook wp_head
 * =================================================
 */
add_action('wp_head', 'poco_pingback_header', 1);

/**
 * =================================================
 * Hook poco_before_header
 * =================================================
 */

/**
 * =================================================
 * Hook poco_before_content
 * =================================================
 */
add_action('poco_before_content', 'poco_breadcrumb', 10);

/**
 * =================================================
 * Hook poco_content_top
 * =================================================
 */

/**
 * =================================================
 * Hook poco_post_header_before
 * =================================================
 */

/**
 * =================================================
 * Hook poco_post_content_before
 * =================================================
 */

/**
 * =================================================
 * Hook poco_post_content_after
 * =================================================
 */

/**
 * =================================================
 * Hook poco_sidebar
 * =================================================
 */
add_action('poco_sidebar', 'poco_get_sidebar', 10);

/**
 * =================================================
 * Hook poco_loop_after
 * =================================================
 */
add_action('poco_loop_after', 'poco_paging_nav', 10);

/**
 * =================================================
 * Hook poco_page_after
 * =================================================
 */
add_action('poco_page_after', 'poco_display_comments', 10);

/**
 * =================================================
 * Hook poco_woocommerce_before_shop_loop_item
 * =================================================
 */

/**
 * =================================================
 * Hook poco_woocommerce_before_shop_loop_item_title
 * =================================================
 */

/**
 * =================================================
 * Hook poco_woocommerce_shop_loop_item_title
 * =================================================
 */

/**
 * =================================================
 * Hook poco_woocommerce_after_shop_loop_item_title
 * =================================================
 */

/**
 * =================================================
 * Hook poco_woocommerce_after_shop_loop_item
 * =================================================
 */
