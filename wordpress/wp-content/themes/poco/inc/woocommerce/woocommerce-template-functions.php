<?php

if (!function_exists('poco_before_content')) {
    /**
     * Before Content
     * Wraps all WooCommerce content in wrappers which match the theme markup
     *
     * @return  void
     * @since   1.0.0
     */
    function poco_before_content() {
        echo <<<HTML
<div id="primary" class="content-area">
    <main id="main" class="site-main" role="main">
HTML;

    }
}


if (!function_exists('poco_after_content')) {
    /**
     * After Content
     * Closes the wrapping divs
     *
     * @return  void
     * @since   1.0.0
     */
    function poco_after_content() {
        echo <<<HTML
	</main><!-- #main -->
</div><!-- #primary -->
HTML;

        do_action('poco_sidebar');
    }
}

if (!function_exists('poco_cart_link_fragment')) {
    /**
     * Cart Fragments
     * Ensure cart contents update when products are added to the cart via AJAX
     *
     * @param array $fragments Fragments to refresh via AJAX.
     *
     * @return array            Fragments to refresh via AJAX
     */
    function poco_cart_link_fragment($fragments) {
        ob_start();
        poco_cart_link();
        $fragments['a.cart-contents'] = ob_get_clean();

        ob_start();
        poco_handheld_footer_bar_cart_link();
        $fragments['a.footer-cart-contents'] = ob_get_clean();

        return $fragments;
    }
}

if (!function_exists('poco_cart_link')) {
    /**
     * Cart Link
     * Displayed a link to the cart including the number of items present and the cart total
     *
     * @return void
     * @since  1.0.0
     */
    function poco_cart_link() {
        ?>
        <a class="cart-contents" href="<?php echo esc_url(wc_get_cart_url()); ?>" title="<?php esc_attr_e('View your shopping cart', 'poco'); ?>">
            <?php /* translators: %d: number of items in cart */ ?>
            <span class="count"><?php echo wp_kses_data(sprintf(_n('%d', '%d', WC()->cart->get_cart_contents_count(), 'poco'), WC()->cart->get_cart_contents_count())); ?></span>
            <?php echo WC()->cart->get_cart_subtotal(); ?>
        </a>
        <?php
    }
}

if (!function_exists('poco_product_search')) {
    /**
     * Display Product Search
     *
     * @return void
     * @uses  poco_is_woocommerce_activated() check if WooCommerce is activated
     * @since  1.0.0
     */
    function poco_product_search() {
        if (!poco_get_theme_option('show-header-search', true)) {
            return;
        }
        if (poco_is_woocommerce_activated()) {
            ?>
            <div class="site-search">
                <?php the_widget('WC_Widget_Product_Search', 'title='); ?>
            </div>
            <?php
        }
    }
}

if (!function_exists('poco_header_cart')) {
    /**
     * Display Header Cart
     *
     * @return void
     * @uses  poco_is_woocommerce_activated() check if WooCommerce is activated
     * @since  1.0.0
     */
    function poco_header_cart() {
        if (poco_is_woocommerce_activated()) {
            if (!poco_get_theme_option('show-header-cart', true)) {
                return;
            }
            ?>
            <div class="site-header-cart menu">
                <?php poco_cart_link(); ?>
                <?php

                if (!apply_filters('woocommerce_widget_cart_is_hidden', is_cart() || is_checkout())) {

                    if (poco_get_theme_option('header-cart-dropdown', 'side') == 'side') {
                        wp_enqueue_script('poco-cart-canvas');
                        add_action('wp_footer', 'poco_header_cart_side');
                    } else {
                        the_widget('WC_Widget_Cart', 'title=');
                    }

                }

                ?>
            </div>
            <?php
        }
    }
}

if (!function_exists('poco_header_cart_side')) {
    function poco_header_cart_side() {
        if (poco_is_woocommerce_activated()) {
            ?>
            <div class="site-header-cart-side">
                <div class="cart-side-heading">
                    <span class="cart-side-title"><?php echo esc_html__('Shopping cart', 'poco'); ?></span>
                    <a href="#" class="close-cart-side"><?php echo esc_html__('close', 'poco') ?></a></div>
                <?php the_widget('WC_Widget_Cart', 'title='); ?>
            </div>
            <div class="cart-side-overlay"></div>
            <?php
        }
    }
}

if (!function_exists('poco_upsell_display')) {
    /**
     * Upsells
     * Replace the default upsell function with our own which displays the correct number product columns
     *
     * @return  void
     * @since   1.0.0
     * @uses    woocommerce_upsell_display()
     */
    function poco_upsell_display() {
        $columns = apply_filters('poco_upsells_columns', 4);
        if (is_active_sidebar('sidebar-woocommerce-detail')) {
            $columns = 3;
        }
        woocommerce_upsell_display(-1, $columns);
    }
}

if (!function_exists('poco_sorting_wrapper')) {
    /**
     * Sorting wrapper
     *
     * @return  void
     * @since   1.4.3
     */
    function poco_sorting_wrapper() {
        echo '<div class="poco-sorting">';
    }
}

if (!function_exists('poco_sorting_wrapper_close')) {
    /**
     * Sorting wrapper close
     *
     * @return  void
     * @since   1.4.3
     */
    function poco_sorting_wrapper_close() {
        echo '</div>';
    }
}

if (!function_exists('poco_product_columns_wrapper')) {
    /**
     * Product columns wrapper
     *
     * @return  void
     * @since   2.2.0
     */
    function poco_product_columns_wrapper() {
        $columns = poco_loop_columns();
        echo '<div class="columns-' . absint($columns) . '">';
    }
}

if (!function_exists('poco_loop_columns')) {
    /**
     * Default loop columns on product archives
     *
     * @return integer products per row
     * @since  1.0.0
     */
    function poco_loop_columns() {
        $columns = 3; // 3 products per row

        if (function_exists('wc_get_default_products_per_row')) {
            $columns = wc_get_default_products_per_row();
        }

        return apply_filters('poco_loop_columns', $columns);
    }
}

if (!function_exists('poco_product_columns_wrapper_close')) {
    /**
     * Product columns wrapper close
     *
     * @return  void
     * @since   2.2.0
     */
    function poco_product_columns_wrapper_close() {
        echo '</div>';
    }
}

if (!function_exists('poco_shop_messages')) {
    /**
     * ThemeBase shop messages
     *
     * @since   1.4.4
     * @uses    poco_do_shortcode
     */
    function poco_shop_messages() {
        if (!is_checkout()) {
            echo poco_do_shortcode('woocommerce_messages');
        }
    }
}

if (!function_exists('poco_woocommerce_pagination')) {
    /**
     * ThemeBase WooCommerce Pagination
     * WooCommerce disables the product pagination inside the woocommerce_product_subcategories() function
     * but since ThemeBase adds pagination before that function is excuted we need a separate function to
     * determine whether or not to display the pagination.
     *
     * @since 1.4.4
     */
    function poco_woocommerce_pagination() {
        if (woocommerce_products_will_display()) {
            woocommerce_pagination();
        }
    }
}

if (!function_exists('poco_handheld_footer_bar')) {
    /**
     * Display a menu intended for use on handheld devices
     *
     * @since 2.0.0
     */
    function poco_handheld_footer_bar() {
        $links = array(
            'shop'       => array(
                'priority' => 5,
                'callback' => 'poco_handheld_footer_bar_shop_link',
            ),
            'my-account' => array(
                'priority' => 10,
                'callback' => 'poco_handheld_footer_bar_account_link',
            ),
            'search'     => array(
                'priority' => 20,
                'callback' => 'poco_handheld_footer_bar_search',
            ),
            'wishlist'   => array(
                'priority' => 30,
                'callback' => 'poco_handheld_footer_bar_wishlist',
            ),
            'cart'       => array(
                'priority' => 35,
                'callback' => 'poco_handheld_footer_bar_cart',
            ),
        );

        if (wc_get_page_id('myaccount') === -1) {
            unset($links['my-account']);
        }

        if (!function_exists('yith_wcwl_count_all_products') && !function_exists('woosw_init')) {
            unset($links['wishlist']);
        }

        if(!poco_is_elementor_activated()) {
            unset($links['cart']);
        }

        $links = apply_filters('poco_handheld_footer_bar_links', $links);
        ?>
        <div class="poco-handheld-footer-bar">
            <ul class="columns-<?php echo count($links); ?>">
                <?php foreach ($links as $key => $link) : ?>
                    <li class="<?php echo esc_attr($key); ?>">
                        <?php
                        if ($link['callback']) {
                            call_user_func($link['callback'], $key, $link);
                        }
                        ?>
                    </li>
                <?php endforeach; ?>
            </ul>
        </div>
        <?php
    }
}

if (!function_exists('poco_handheld_footer_bar_search')) {
    /**
     * The search callback function for the handheld footer bar
     *
     * @since 2.0.0
     */
    function poco_handheld_footer_bar_search() {
        echo '<a href=""><span class="title">' . esc_attr__('Search', 'poco') . '</span></a>';
        poco_product_search();
    }
}

if (!function_exists('poco_handheld_footer_bar_cart_link')) {
    /**
     * The cart callback function for the handheld footer bar
     *
     * @since 2.0.0
     */
    function poco_handheld_footer_bar_cart_link() {
        ?>
        <a class="footer-cart-contents" href="<?php echo esc_url(wc_get_cart_url()); ?>" title="<?php esc_attr_e('View your shopping cart', 'poco'); ?>">
            <span class="count"><?php echo wp_kses_data(WC()->cart->get_cart_contents_count()); ?></span>
            <span class="title"><?php echo esc_html__('Cart', 'poco'); ?></span>
        </a>
        <?php
    }
}

if (!function_exists('poco_handheld_footer_bar_account_link')) {
    /**
     * The account callback function for the handheld footer bar
     *
     * @since 2.0.0
     */
    function poco_handheld_footer_bar_account_link() {
        echo '<a href="' . esc_url(get_permalink(get_option('woocommerce_myaccount_page_id'))) . '"><span class="title">' . esc_attr__('My Account', 'poco') . '</span></a>';
    }
}

if (!function_exists('poco_handheld_footer_bar_shop_link')) {
    /**
     * The shop callback function for the handheld footer bar
     *
     * @since 2.0.0
     */
    function poco_handheld_footer_bar_shop_link() {
        echo '<a href="' . esc_url(get_permalink(get_option('woocommerce_shop_page_id'))) . '"><span class="title">' . esc_attr__('Shop', 'poco') . '</span></a>';
    }
}

if (!function_exists('poco_handheld_footer_bar_wishlist')) {
    /**
     * The wishlist callback function for the handheld footer bar
     *
     * @since 2.0.0
     */
    function poco_handheld_footer_bar_wishlist() {
        if (function_exists('yith_wcwl_count_all_products')) {
            ?>
            <a class="footer-wishlist" href="<?php echo esc_url(get_permalink(get_option('yith_wcwl_wishlist_page_id'))); ?>">
                <span class="title"><?php echo esc_html__('Wishlist', 'poco'); ?></span>
                <span class="count"><?php echo esc_html(yith_wcwl_count_all_products()); ?></span>
            </a>
            <?php
        }elseif (function_exists('woosw_init')) {
            $key = WPCleverWoosw::get_key();

            ?>
            <a class="footer-wishlist" href="<?php echo esc_url(WPCleverWoosw::get_url( $key, true )); ?>">
                <span class="title"><?php echo esc_html__('Wishlist', 'poco'); ?></span>
                <span class="count"><?php echo esc_html(WPCleverWoosw::get_count($key)); ?></span>
            </a>
            <?php
        }
    }

}

if (!function_exists('poco_handheld_footer_bar_cart')) {
    /**
     * The cart callback function for the handheld footer bar
     *
     * @since 2.0.0
     */
    function poco_handheld_footer_bar_cart() {
        ?>
        <a class="footer-cart-contents" href="<?php echo esc_url(wc_get_cart_url()); ?>"
           title="<?php esc_attr_e('View your shopping cart', 'poco'); ?>">
				<span class="count"><?php echo wp_kses_data(sprintf(_n('%d', '%d', WC()->cart->get_cart_contents_count(), 'poco'), WC()->cart->get_cart_contents_count())); ?></span>
            <span class="title"><?php echo esc_html__('Cart', 'poco'); ?></span>
        </a>
        <?php
    }
}

if (!function_exists('poco_single_product_pagination')) {
    /**
     * Single Product Pagination
     *
     * @since 2.3.0
     */
    function poco_single_product_pagination() {
//		if ( get_theme_mod( 'poco_product_pagination' ) !== true ) {
//			return;
//		}

        // Show only products in the same category?
        $in_same_term   = apply_filters('poco_single_product_pagination_same_category', true);
        $excluded_terms = apply_filters('poco_single_product_pagination_excluded_terms', '');
        $taxonomy       = apply_filters('poco_single_product_pagination_taxonomy', 'product_cat');

        $previous_product = poco_get_previous_product($in_same_term, $excluded_terms, $taxonomy);
        $next_product     = poco_get_next_product($in_same_term, $excluded_terms, $taxonomy);

        if ((!$previous_product && !$next_product) || !is_product()) {
            return;
        }

        ?>
        <div class="poco-product-pagination-wrap">
            <nav class="poco-product-pagination" aria-label="<?php esc_attr_e('More products', 'poco'); ?>">
                <?php if ($previous_product) : ?>
                    <a href="<?php echo esc_url($previous_product->get_permalink()); ?>" rel="prev">
                        <span class="pagination-prev "><i class="poco-icon-angle-left"></i></span>
                        <div class="product-item">
                            <?php echo sprintf('%s', $previous_product->get_image()); ?>
                            <div class="poco-product-pagination-content">
                                <span class="poco-product-pagination__title"><?php echo sprintf('%s', $previous_product->get_name()); ?></span>
                                <?php if ($price_html = $previous_product->get_price_html()) :
                                    printf('<span class="price">%s</span>', $price_html);
                                endif; ?>
                            </div>
                        </div>
                    </a>
                <?php endif; ?>

                <?php if ($next_product) : ?>
                    <a href="<?php echo esc_url($next_product->get_permalink()); ?>" rel="next">
                        <span class="pagination-next"><i class="poco-icon-angle-right"></i></span>
                        <div class="product-item">
                            <?php echo sprintf('%s', $next_product->get_image()); ?>
                            <div class="poco-product-pagination-content">
                                <span class="poco-product-pagination__title"><?php echo sprintf('%s', $next_product->get_name()); ?></span>
                                <?php if ($price_html = $next_product->get_price_html()) :
                                    printf('<span class="price">%s</span>', $price_html);
                                endif; ?>
                            </div>
                        </div>
                    </a>
                <?php endif; ?>
            </nav><!-- .poco-product-pagination -->
        </div>
        <?php

    }
}

if (!function_exists('poco_sticky_single_add_to_cart')) {
    /**
     * Sticky Add to Cart
     *
     * @since 2.3.0
     */
    function poco_sticky_single_add_to_cart() {
        global $product;

        if (!is_product()) {
            return;
        }

        $show = false;

        if ($product->is_purchasable() && $product->is_in_stock()) {
            $show = true;
        } else if ($product->is_type('external')) {
            $show = true;
        }

        if (!$show) {
            return;
        }

        $params = apply_filters(
            'poco_sticky_add_to_cart_params', array(
                'trigger_class' => 'entry-summary',
            )
        );

        wp_localize_script('poco-sticky-add-to-cart', 'poco_sticky_add_to_cart_params', $params);
        wp_dequeue_script('poco-sticky-header');
        wp_enqueue_script('poco-sticky-add-to-cart');
        ?>

        <section class="poco-sticky-add-to-cart">
            <div class="col-full">
                <div class="poco-sticky-add-to-cart__content">
                    <?php echo woocommerce_get_product_thumbnail(); ?>
                    <div class="poco-sticky-add-to-cart__content-product-info">
						<span class="poco-sticky-add-to-cart__content-title"><?php esc_attr_e('You\'re viewing:', 'poco'); ?>
							<strong><?php the_title(); ?></strong></span>
                        <span class="poco-sticky-add-to-cart__content-price"><?php echo sprintf('%s', $product->get_price_html()); ?></span>
                        <?php echo wc_get_rating_html($product->get_average_rating()); ?>
                    </div>
                    <a href="<?php echo esc_url($product->add_to_cart_url()); ?>" class="poco-sticky-add-to-cart__content-button button alt">
                        <?php echo esc_attr($product->add_to_cart_text()); ?>
                    </a>
                </div>
            </div>
        </section><!-- .poco-sticky-add-to-cart -->
        <?php
    }
}

if (!function_exists('poco_woocommerce_product_loop_start')) {
    function poco_woocommerce_product_loop_start() {
        echo '<div class="product-block">';
    }
}

if (!function_exists('poco_woocommerce_product_loop_end')) {
    function poco_woocommerce_product_loop_end() {
        echo '</div>';
    }
}

if (!function_exists('poco_woocommerce_product_caption_start')) {
    function poco_woocommerce_product_caption_start() {
        echo '<div class="product-caption">';
    }
}

if (!function_exists('poco_woocommerce_product_caption_end')) {
    function poco_woocommerce_product_caption_end() {
        echo '</div>';
    }
}

if (!function_exists('poco_woocommerce_product_loop_image')) {
    function poco_woocommerce_product_loop_image() {
        ?>
        <div class="product-transition"><?php do_action('poco_woocommerce_product_loop_image') ?></div>
        <?php
    }
}

if (!function_exists('poco_woocommerce_product_loop_action')) {
    function poco_woocommerce_product_loop_action() {
        ?>
        <div class="group-action">
            <div class="shop-action">
                <?php do_action('poco_woocommerce_product_loop_action'); ?>
            </div>
        </div>
        <?php
    }
}
if (!function_exists('poco_stock_label')) {
    function poco_stock_label() {
        global $product;
        if ($product->is_in_stock()) {
            echo '<span class="inventory_status">' . esc_html__('In Stock', 'poco') . '</span>';
        } else {
            echo '<span class="inventory_status out-stock">' . esc_html__('Out of Stock', 'poco') . '</span>';
        }
    }
}

if (!function_exists('poco_single_product_extra')) {
    function poco_single_product_extra() {
        global $product;
        $product_extra = poco_get_theme_option('single-product-content-meta', '');
        $product_extra = get_post_meta($product->get_id(), '_extra_info', true) !== '' ? get_post_meta($product->get_id(), '_extra_info', true) : $product_extra;

        echo html_entity_decode($product_extra);
    }
}

if (!function_exists('poco_woocommerce_single_product_image_thumbnail_html')) {
    function poco_woocommerce_single_product_image_thumbnail_html($image, $attachment_id) {
        return wc_get_gallery_image_html($attachment_id, true);
    }
}

if (!function_exists('poco_template_loop_product_thumbnail')) {
    function poco_template_loop_product_thumbnail($size = 'woocommerce_thumbnail', $deprecated1 = 0, $deprecated2 = 0) {
        global $product;
        if ($product) {
            echo '<div class="product-image">' . $product->get_image('shop_catalog') . '</div>';
        }
    }
}

if (!function_exists('woocommerce_template_loop_product_title')) {

    /**
     * Show the product title in the product loop.
     */
    function woocommerce_template_loop_product_title() {
        echo '<h3 class="woocommerce-loop-product__title"><a href="' . esc_url_raw(get_the_permalink()) . '">' . get_the_title() . '</a></h3>';
    }
}

if (!function_exists('poco_woocommerce_get_product_category')) {
    function poco_woocommerce_get_product_category() {
        global $product;
        echo wc_get_product_category_list($product->get_id(), ', ', '<div class="posted-in">', '</div>');
    }
}

if (!function_exists('poco_woocommerce_get_product_description')) {
    function poco_woocommerce_get_product_description() {
        global $post;

        $short_description = apply_filters('woocommerce_short_description', $post->post_excerpt);

        if ($short_description) {
            ?>
            <div class="short-description">
                <?php echo sprintf('%s', $short_description); ?>
            </div>
            <?php
        }
    }
}

if (!function_exists('poco_woocommerce_get_product_short_description')) {
    function poco_woocommerce_get_product_short_description() {
        global $post;
        $short_description = wp_trim_words(apply_filters('woocommerce_short_description', $post->post_excerpt), 15);
        if ($short_description) {
            ?>
            <div class="short-description">
                <?php echo sprintf('%s', $short_description); ?>
            </div>
            <?php
        }
    }
}


if (!function_exists('poco_woocommerce_product_loop_wishlist_button')) {
    function poco_woocommerce_product_loop_wishlist_button() {
        if (poco_is_woocommerce_extension_activated('YITH_WCWL')) {
            echo poco_do_shortcode('yith_wcwl_add_to_wishlist');
        }
    }
}

if (!function_exists('poco_woocommerce_product_loop_compare_button')) {
    function poco_woocommerce_product_loop_compare_button() {
        if (poco_is_woocommerce_extension_activated('YITH_Woocompare')) {
            global $yith_woocompare;
            if (get_option('yith_woocompare_compare_button_in_products_list', 'no') == 'yes') {
                remove_action('woocommerce_after_shop_loop_item', array(
                    $yith_woocompare->obj,
                    'add_compare_link'
                ), 20);
            }

            echo poco_do_shortcode('yith_compare_button');
        }
    }
}

if (!function_exists('poco_header_wishlist')) {
    function poco_header_wishlist() {
        if (function_exists('yith_wcwl_count_all_products')) {
            if (!poco_get_theme_option('show-header-wishlist', true)) {
                return;
            }
            ?>
            <div class="site-header-wishlist">
                <a class="header-wishlist" href="<?php echo esc_url(get_permalink(get_option('yith_wcwl_wishlist_page_id'))); ?>">
                    <i class="poco-icon-heart"></i>
                    <span class="count"><?php echo esc_html(yith_wcwl_count_all_products()); ?></span>
                </a>
            </div>
            <?php
        }elseif (function_exists('woosw_init')) {
            if (!poco_get_theme_option('show-header-wishlist', true)) {
                return;
            }
            $key = WPCleverWoosw::get_key();

            ?>
            <div class="site-header-wishlist">
                <a class="header-wishlist" href="<?php echo esc_url(WPCleverWoosw::get_url( $key, true )); ?>">
                    <i class="poco-icon-heart"></i>
                    <span class="count"><?php echo esc_html(WPCleverWoosw::get_count($key)); ?></span>
                </a>
            </div>
            <?php
        }
    }
}

if (defined('YITH_WCWL') && !function_exists('yith_wcwl_ajax_update_count')) {
    function yith_wcwl_ajax_update_count() {
        wp_send_json(array(
            'count' => yith_wcwl_count_all_products()
        ));
    }

    add_action('wp_ajax_yith_wcwl_update_wishlist_count', 'yith_wcwl_ajax_update_count');
    add_action('wp_ajax_nopriv_yith_wcwl_update_wishlist_count', 'yith_wcwl_ajax_update_count');
}

if (!function_exists('poco_button_grid_list_layout')) {
    function poco_button_grid_list_layout() {
        ?>
        <div class="gridlist-toggle desktop-hide-down">
            <a href="<?php echo esc_url(add_query_arg('layout', 'grid')); ?>" id="grid" class="<?php echo isset($_GET['layout']) && $_GET['layout'] == 'list' ? '' : 'active'; ?>" title="<?php echo esc_html__('Grid View', 'poco'); ?>"><i class="poco-icon-th-large"></i></a>
            <a href="<?php echo esc_url(add_query_arg('layout', 'list')); ?>" id="list" class="<?php echo isset($_GET['layout']) && $_GET['layout'] == 'list' ? 'active' : ''; ?>" title="<?php echo esc_html__('List View', 'poco'); ?>"><i class="poco-icon-th-list"></i></a>
        </div>
        <?php
    }
}

if (!function_exists('poco_woocommerce_change_path_shortcode')) {
    function poco_woocommerce_change_path_shortcode($template, $slug, $name) {
        wc_get_template('content-widget-product.php', apply_filters('poco_product_template_arg', array('show_rating' => false)));
    }
}

if (!function_exists('poco_woocommerce_list_show_rating_arg')) {
    function poco_woocommerce_list_show_rating_arg($arg) {
        $arg['show_rating'] = true;

        return $arg;
    }
}

if (!function_exists('poco_woocommerce_list_get_excerpt')) {
    function poco_woocommerce_list_show_excerpt() {
        echo '<div class="product-excerpt">' . get_the_excerpt() . '</div>';
    }
}

if (!function_exists('poco_woocommerce_list_get_rating')) {
    function poco_woocommerce_list_show_rating() {
        global $product;
        echo wc_get_rating_html($product->get_average_rating());
    }
}

if (!function_exists('poco_single_product_quantity_label')) {
    function poco_single_product_quantity_label() {
        echo '<label class="quantity_label">' . __('Quantity', 'poco') . ' </label>';
    }
}

if (!function_exists('poco_woocommerce_time_sale')) {
    function poco_woocommerce_time_sale() {
        /**
         * @var $product WC_Product
         */
        global $product;

        if (!$product->is_on_sale()) {
            return;
        }

        $time_sale = get_post_meta($product->get_id(), '_sale_price_dates_to', true);
        if ($time_sale) {
            $time_sale += (get_option('gmt_offset') * HOUR_IN_SECONDS);
            wp_enqueue_script('poco-countdown');
            ?>
            <div class="time-sale">
                <div class="deal-text"><i class="poco-icon poco-icon-fire"></i>
                    <spam><?php echo esc_html__('Hungry Up ! Deals end in :', 'poco'); ?></spam>
                </div>
                <div class="poco-countdown" data-countdown="true" data-date="<?php echo esc_html($time_sale); ?>">
                    <div class="countdown-item">
                        <span class="countdown-digits countdown-days"></span>
                        <span class="countdown-label"><?php echo esc_html__('DAYS', 'poco') ?></span>
                    </div>
                    <div class="countdown-item">
                        <span class="countdown-digits countdown-hours"></span>
                        <span class="countdown-label"><?php echo esc_html__('HRS', 'poco') ?></span>
                    </div>
                    <div class="countdown-item">
                        <span class="countdown-digits countdown-minutes"></span>
                        <span class="countdown-label"><?php echo esc_html__('MIN', 'poco') ?></span>
                    </div>
                    <div class="countdown-item">
                        <span class="countdown-digits countdown-seconds"></span>
                        <span class="countdown-label"><?php echo esc_html__('SEC', 'poco') ?></span>
                    </div>
                </div>
            </div>
            <?php
        }
    }
}

if (!function_exists('poco_button_shop_canvas')) {
    function poco_button_shop_canvas() {
        if (is_active_sidebar('sidebar-woocommerce-shop')) { ?>
            <button class="filter-toggle" aria-expanded="false">
                <i class="poco-icon-filter"></i><span><?php esc_html_e('Filter', 'poco'); ?></span></button>
            <?php
        }
    }
}

if (!function_exists('poco_button_shop_dropdown')) {
    function poco_button_shop_dropdown() {
        if (is_active_sidebar('sidebar-woocommerce-shop')) { ?>
            <button class="filter-toggle-dropdown" aria-expanded="false">
                <i class="poco-icon-filter"></i><span><?php esc_html_e('Filter', 'poco'); ?></span></button>
            <?php
        }
    }
}

if (!function_exists('poco_render_woocommerce_shop_canvas')) {
    function poco_render_woocommerce_shop_canvas() {
        if (is_active_sidebar('sidebar-woocommerce-shop') && poco_is_product_archive()) {
            ?>
            <div id="poco-canvas-filter" class="poco-canvas-filter">
                <span class="filter-close"><?php esc_html_e('HIDE FILTER', 'poco'); ?></span>
                <div class="poco-canvas-filter-wrap">
                    <?php dynamic_sidebar('sidebar-woocommerce-shop'); ?>
                </div>
            </div>
            <div class="poco-overlay-filter"></div>
            <?php
        }
    }
}

if (!function_exists('poco_render_woocommerce_shop_mobile')) {
    function poco_render_woocommerce_shop_mobile() {
        if (is_active_sidebar('sidebar-woocommerce-shop') && poco_is_product_archive()) {
            ?>
            <div id="poco-canvas-filter" class="poco-canvas-filter">
                <span class="filter-close"><?php esc_html_e('HIDE FILTER', 'poco'); ?></span>
                <div class="poco-canvas-filter-wrap">
                </div>
            </div>
            <div class="poco-overlay-filter"></div>
            <?php
        }
    }
}


if (!function_exists('poco_render_woocommerce_shop_dropdown')) {
    function poco_render_woocommerce_shop_dropdown() {
        ?>
        <div id="poco-dropdown-filter" class="poco-dropdown-filter">
            <div class="poco-dropdown-filter-wrap">
                <?php dynamic_sidebar('sidebar-woocommerce-shop'); ?>
            </div>
        </div>
        <?php
    }
}

if (!function_exists('woocommerce_checkout_order_review_start')) {

    function woocommerce_checkout_order_review_start() {
        echo '<div class="checkout-review-order-table-wrapper">';
    }
}

if (!function_exists('woocommerce_checkout_order_review_end')) {

    function woocommerce_checkout_order_review_end() {
        echo '</div>';
    }
}

if (!function_exists('poco_woocommerce_get_product_label_stock')) {
    function poco_woocommerce_get_product_label_stock() {
        /**
         * @var $product WC_Product
         */
        global $product;
        if ($product->get_stock_status() == 'outofstock') {
            echo '<span class="stock-label">' . esc_html__('Out Of Stock', 'poco') . '</span>';
        }
    }
}

if (!function_exists('poco_woocommerce_single_content_wrapper_start')) {
    function poco_woocommerce_single_content_wrapper_start() {
        echo '<div class="content-single-wrapper">';
    }
}

if (!function_exists('poco_woocommerce_single_content_wrapper_end')) {
    function poco_woocommerce_single_content_wrapper_end() {
        echo '</div>';
    }
}

?>
