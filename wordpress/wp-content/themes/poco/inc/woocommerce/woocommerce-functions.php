<?php
/**
 * Checks if the current page is a product archive
 *
 * @return boolean
 */
function poco_is_product_archive() {
    if (is_shop() || is_product_taxonomy() || is_product_category() || is_product_tag()) {
        return true;
    } else {
        return false;
    }
}

/**
 * @param $product WC_Product
 */
function poco_product_get_image($product){
	return $product->get_image();
}

/**
 * @param $product WC_Product
 */
function poco_product_get_price_html($product){
	return $product->get_price_html();
}

/**
 * Retrieves the previous product.
 *
 * @param bool $in_same_term Optional. Whether post should be in a same taxonomy term. Default false.
 * @param array|string $excluded_terms Optional. Comma-separated list of excluded term IDs. Default empty.
 * @param string $taxonomy Optional. Taxonomy, if $in_same_term is true. Default 'product_cat'.
 * @return WC_Product|false Product object if successful. False if no valid product is found.
 * @since 2.4.3
 *
 */
function poco_get_previous_product($in_same_term = false, $excluded_terms = '', $taxonomy = 'product_cat') {
    $product = new Poco_WooCommerce_Adjacent_Products($in_same_term, $excluded_terms, $taxonomy, true);
    return $product->get_product();
}

/**
 * Retrieves the next product.
 *
 * @param bool $in_same_term Optional. Whether post should be in a same taxonomy term. Default false.
 * @param array|string $excluded_terms Optional. Comma-separated list of excluded term IDs. Default empty.
 * @param string $taxonomy Optional. Taxonomy, if $in_same_term is true. Default 'product_cat'.
 * @return WC_Product|false Product object if successful. False if no valid product is found.
 * @since 2.4.3
 *
 */
function poco_get_next_product($in_same_term = false, $excluded_terms = '', $taxonomy = 'product_cat') {
    $product = new Poco_WooCommerce_Adjacent_Products($in_same_term, $excluded_terms, $taxonomy);
    return $product->get_product();
}


function poco_is_woocommerce_extension_activated($extension = 'WC_Bookings') {
    if ($extension == 'YITH_WCQV') {
        return class_exists($extension) && class_exists('YITH_WCQV_Frontend') ? true : false;
    }

    return class_exists($extension) ? true : false;
}

function osf_woocommerce_pagination_args($args) {
    $args['prev_text'] = '<i class="poco-icon poco-icon-angle-left"></i><span>' . __('PREVIOUS', 'poco').'</span>';
    $args['next_text'] ='<span>'. __('NEXT', 'poco') . '</span><i class="poco-icon poco-icon-angle-right"></i>';
    return $args;
}

add_filter('woocommerce_pagination_args', 'osf_woocommerce_pagination_args', 10, 1);
