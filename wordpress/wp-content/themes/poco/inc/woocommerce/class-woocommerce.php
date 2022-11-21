<?php
if (!defined('ABSPATH')) {
    exit;
}

if (!class_exists('Poco_WooCommerce')) :

    /**
     * The Poco WooCommerce Integration class
     */
    class Poco_WooCommerce {

        public $list_shortcodes;

        private $prefix = 'remove';

        /**
         * Setup class.
         *
         * @since 1.0
         */
        public function __construct() {
            $this->list_shortcodes = array(
                'recent_products',
                'sale_products',
                'best_selling_products',
                'top_rated_products',
                'featured_products',
                'related_products',
                'product_category',
                'products',
            );
            $this->init_shortcodes();

            add_action('after_setup_theme', array($this, 'setup'));
            add_filter('body_class', array($this, 'woocommerce_body_class'));
            add_action('widgets_init', array($this, 'widgets_init'));
            add_filter('poco_theme_sidebar', array($this, 'set_sidebar'), 20);
            add_action('wp_enqueue_scripts', array($this, 'woocommerce_scripts'), 20);
            add_filter('woocommerce_enqueue_styles', '__return_empty_array');
            add_filter('woocommerce_output_related_products_args', array($this, 'related_products_args'));
            add_filter('woocommerce_product_thumbnails_columns', array($this, 'thumbnail_columns'));
            add_filter('woocommerce_breadcrumb_defaults', array($this, 'change_breadcrumb_delimiter'));

            if (defined('WC_VERSION') && version_compare(WC_VERSION, '2.5', '<')) {
                add_action('wp_footer', array($this, 'star_rating_script'));
            }

            if (defined('WC_VERSION') && version_compare(WC_VERSION, '3.3', '<')) {
                add_filter('loop_shop_per_page', array($this, 'products_per_page'));
            }

            // Remove Shop Title
            add_filter('woocommerce_show_page_title', '__return_false');

            add_filter('wc_get_template_part', array($this, 'change_template_part'), 10, 3);

            add_action('wp_ajax_poco_ajax_search_products', array($this, 'ajax_search_products'));
            add_action('wp_ajax_nopriv_poco_ajax_search_products', array($this, 'ajax_search_products'));
            add_action('pre_get_product_search_form', array($this, 'ajax_search_result'));
            add_action('wp_footer', array($this, 'ajax_live_search_template'));

            add_filter('poco_register_nav_menus', [$this, 'add_location_menu']);
            add_filter('wp_nav_menu_items', [$this, 'add_extra_item_to_nav_menu'], 10, 2);

            add_filter('woocommerce_single_product_image_gallery_classes', function ($wrapper_classes) {
                $wrapper_classes[] = 'woocommerce-product-gallery-' . poco_get_theme_option('single-product-gallery-layout', 'horizontal');

                return $wrapper_classes;
            });

            add_action('woocommerce_grouped_product_list_before_label', array(
                $this,
                'grouped_product_column_image'
            ), 10, 1);

            // Elementor Admin
            add_action('admin_action_elementor', array($this, 'register_elementor_wc_hook'), 1);

            add_action('product_cat_add_form_fields', array($this, 'custom_taxonomy_add_meta_field'), 10, 2);
            add_action('product_cat_edit_form_fields', array($this, 'custom_taxonomy_edit_meta_field'), 10, 2);
            add_action('edited_product_cat', array($this, 'save_taxonomy_custom_meta'), 10, 2);
            add_action('create_product_cat', array($this, 'save_taxonomy_custom_meta'), 10, 2);
            add_filter('list_product_cats', array($this, 'filter_list_product_cats'), 10, 2);
        }

        public function filter_list_product_cats($name, $cat) {

            $term_meta = get_option("taxonomy_" . $cat->term_id);
            if ($term_meta['meta_icon']) {
                $name = '<i class="' . $term_meta['meta_icon'] . '"></i><span>' . $name . '</span>';
            }
            return $name;
        }

        public function custom_taxonomy_add_meta_field() {
            ?>
            <div class="form-field">
                <label for="term_meta[meta_icon]"><?php echo esc_html__('Icon Class', 'poco'); ?></label>
                <input type="text" name="term_meta[meta_icon]" id="term_meta[meta_icon]">
            </div>
            <?php
        }

        public function custom_taxonomy_edit_meta_field($term) {

            //getting term ID
            $term_id = $term->term_id;

            // retrieve the existing value(s) for this meta field. This returns an array
            $term_meta = get_option("taxonomy_" . $term_id);
            ?>
            <tr class="form-field">
                <th scope="row" valign="top">
                    <label for="term_meta[meta_icon]"><?php echo esc_html__('Icon Class', 'poco'); ?></label></th>
                <td>
                    <input type="text" name="term_meta[meta_icon]" id="term_meta[meta_icon]" value="<?php echo esc_attr($term_meta['meta_icon']) ? esc_attr($term_meta['meta_icon']) : ''; ?>">
                </td>
            </tr>

            <?php
        }

        public function save_taxonomy_custom_meta($term_id) {
            if (isset($_POST['term_meta'])) {
                $term_meta = get_option("taxonomy_" . $term_id);
                $cat_keys  = array_keys($_POST['term_meta']);
                foreach ($cat_keys as $key) {
                    if (isset($_POST['term_meta'][$key])) {
                        $term_meta[$key] = $_POST['term_meta'][$key];
                    }
                }
                // Save the option array.
                update_option("taxonomy_" . $term_id, $term_meta);
            }
        }

        public function register_elementor_wc_hook() {
            wc()->frontend_includes();
            require_once get_theme_file_path('inc/woocommerce/woocommerce-template-hooks.php');
            require_once get_theme_file_path('inc/woocommerce/template-hooks.php');
        }

        public function add_extra_item_to_nav_menu($items, $args) {
            if ($args->theme_location == 'my-account') {
                $items .= '<li><a href="' . esc_url(wp_logout_url(home_url())) . '">' . esc_html__("Logout", 'poco') . '</a></li>';
            }

            return $items;
        }

        public function add_location_menu($locations) {
            $locations['my-account'] = esc_html__('My Account', 'poco');

            return $locations;
        }

        /**
         * Sets up theme defaults and registers support for various WooCommerce features.
         *
         * Note that this function is hooked into the after_setup_theme hook, which
         * runs before the init hook. The init hook is too late for some features, such
         * as indicating support for post thumbnails.
         *
         * @return void
         * @since 2.4.0
         */
        public function setup() {
            $single_product  = poco_get_theme_option('woocommerce_product_single_width', ['width' => '800']);
            $archive_product = poco_get_theme_option('woocommerce_product_thumbnail_width', ['width' => '450']);
            add_theme_support(
                'woocommerce', apply_filters(
                    'zicare_woocommerce_args', array(
                        'single_image_width'    => $single_product['width'],
                        'thumbnail_image_width' => $archive_product['width'],
                        'product_grid'          => array(
                            'default_columns' => 3,
                            'default_rows'    => 4,
                            'min_columns'     => 1,
                            'max_columns'     => 6,
                            'min_rows'        => 1,
                        ),
                    )
                )
            );


            /**
             * Add 'poco_woocommerce_setup' action.
             *
             * @since  2.4.0
             */
            do_action('poco_woocommerce_setup');
        }

        private function init_shortcodes() {
            foreach ($this->list_shortcodes as $shortcode) {
                add_filter('shortcode_atts_' . $shortcode, array($this, 'set_shortcode_attributes'), 10, 3);
                add_action('woocommerce_shortcode_before_' . $shortcode . '_loop', array(
                    $this,
                    'style_loop_start'
                ));
                add_action('woocommerce_shortcode_before_' . $shortcode . '_loop', array(
                    $this,
                    'shortcode_loop_start'
                ));
                add_action('woocommerce_shortcode_after_' . $shortcode . '_loop', array($this, 'style_loop_end'));
                add_action('woocommerce_shortcode_after_' . $shortcode . '_loop', array(
                    $this,
                    'shortcode_loop_end'
                ));
            }
        }

        public function shortcode_loop_end($atts = array()) {
            $function_to_call = $this->prefix . '_filter';
            if (isset($atts['product_layout'])) {
                if ($atts['product_layout'] === 'list') {
                    if (!empty($atts['show_rating'])) {
                        $function_to_call('poco_product_template_arg', 'poco_woocommerce_list_show_rating_arg', 10);
                    }
                    $function_to_call('wc_get_template_part', 'poco_woocommerce_change_path_shortcode', 10);
                } elseif ($atts['product_layout'] === 'carousel') {
                    echo '</div>';
                } elseif ($atts['product_layout'] === 'list-carousel') {
                    if (!empty($atts['show_rating'])) {
                        $function_to_call('poco_product_template_arg', 'poco_woocommerce_list_show_rating_arg', 10);
                    }
                    $function_to_call('wc_get_template_part', 'poco_woocommerce_change_path_shortcode', 10);
                    echo '</div>';
                }
            }

            if (!empty($atts['image_size'])) {
                $function_to_call('woocommerce_product_get_image', array($this, 'set_image_size_list'), 10);
            }
        }

        public function shortcode_loop_start($atts = array()) {
            if (isset($atts['product_layout'])) {
                if ($atts['product_layout'] === 'list') {
                    if (!empty($atts['show_rating'])) {
                        add_filter('poco_product_template_arg', 'poco_woocommerce_list_show_rating_arg', 10, 1);
                    }
                    add_filter('wc_get_template_part', 'poco_woocommerce_change_path_shortcode', 10, 3);
                    if (!empty($atts['image_size'])) {
                        $this->list_size = $atts['image_size'];
                        add_filter('woocommerce_product_get_image', array($this, 'set_image_size_list'), 10, 2);
                    }
                } elseif ($atts['product_layout'] === 'carousel') {
                    echo '<div class="woocommerce-carousel" data-settings=\'' . $atts['carousel_settings'] . '\'>';
                } elseif ($atts['product_layout'] === 'list-carousel') {
                    if (!empty($atts['show_rating'])) {
                        add_filter('poco_product_template_arg', 'poco_woocommerce_list_show_rating_arg', 10, 1);
                    }
                    add_filter('wc_get_template_part', 'poco_woocommerce_change_path_shortcode', 10, 3);
                    echo '<div class="woocommerce-carousel" data-settings=\'' . $atts['carousel_settings'] . '\'>';
                }
            }
        }

        public function style_loop_start($atts = array()) {

            if ($atts['product_layout'] === 'list' || $atts['product_layout'] === 'list-carousel') {

                if (!empty($atts['show_category'])) {
                    add_action('poco_product_list_content_before', 'poco_woocommerce_get_product_category', 10);
                }

                if (!empty($atts['show_button'])) {
                    add_action('poco_product_list_content_after', 'woocommerce_template_loop_add_to_cart', 20);
                }

                if (!empty($atts['show_except'])) {
                    add_action('poco_product_list_content_after', 'poco_woocommerce_get_product_short_description', 10);
                }
                if (!empty($atts['show_time_sale'])) {
                    add_action('poco_product_list_content_after', 'poco_woocommerce_time_sale', 30);
                }
            }

        }


        public function style_loop_end($atts = array()) {

            if ($atts['product_layout'] === 'list' || $atts['product_layout'] === 'list-carousel') {

                if (!empty($atts['show_category'])) {
                    remove_action('poco_product_list_content_before', 'poco_woocommerce_get_product_category', 10);
                }

                if (!empty($atts['show_button'])) {
                    remove_action('poco_product_list_content_after', 'woocommerce_template_loop_add_to_cart', 20);
                }

                if (!empty($atts['show_except'])) {
                    remove_action('poco_product_list_content_after', 'poco_woocommerce_get_product_short_description', 10);
                }
                if (!empty($atts['show_time_sale'])) {
                    remove_action('poco_product_list_content_after', 'poco_woocommerce_time_sale', 30);
                }
            }

        }

        public function set_shortcode_attributes($out, $pairs, $atts) {
            $out = wp_parse_args($atts, $out);

            return $out;
        }


        /**
         * Assign styles to individual theme mod.
         *
         * @return void
         * @since 2.1.0
         * @deprecated 2.3.1
         */
        public function set_poco_style_theme_mods() {
            if (function_exists('wc_deprecated_function')) {
                wc_deprecated_function(__FUNCTION__, '2.3.1');
            } else {
                _deprecated_function(__FUNCTION__, '2.3.1');
            }
        }

        /**
         * Add WooCommerce specific classes to the body tag
         *
         * @param array $classes css classes applied to the body tag.
         *
         * @return array $classes modified to include 'woocommerce-active' class
         */
        public function woocommerce_body_class($classes) {
            $classes[] = 'woocommerce-active';

            // Remove `no-wc-breadcrumb` body class.
            $key = array_search('no-wc-breadcrumb', $classes, true);

            if (false !== $key) {
                unset($classes[$key]);
            }

            $style   = poco_get_theme_option('wocommerce_block_style', 1);
            $layout  = poco_get_theme_option('woocommerce_archive_layout', 'default');
            $sidebar = poco_get_theme_option('woocommerce_archive_sidebar', 'left');

            $classes[] = 'product-style-' . $style;

            if (poco_is_product_archive()) {
                $classes[] = 'poco-archive-product';

                if (is_active_sidebar('sidebar-woocommerce-shop')) {
                    if ($layout == 'default' && $sidebar == 'left') {
                        $classes[] = 'poco-sidebar-left';
                    }

                    if ($layout == 'canvas') {
                        $classes[] = 'poco-full-width-content';
                    }

                    if ($layout == 'dropdown') {
                        $classes[] = 'poco-full-width-content shop_filter_dropdown';
                    }
                } else {
                    $classes[] = 'poco-full-width-content';
                }

            }
            $classes[] = 'single-product-' . poco_get_theme_option('wocommerce_single_style', '1');

            if (is_product()) {
                $classes[] = 'poco-full-width-content';
                if (is_active_sidebar('sidebar-woocommerce-detail')) {
                    $classes = array_diff($classes, array(
                        'poco-full-width-content',
                    ));
                }
            }


            return $classes;
        }

        /**
         * WooCommerce specific scripts & stylesheets
         *
         * @since 1.0.0
         */
        public function woocommerce_scripts() {
            global $poco_version;

            $suffix = (defined('SCRIPT_DEBUG') && SCRIPT_DEBUG) ? '' : '.min';
            wp_enqueue_style('poco-woocommerce-style', get_template_directory_uri() . '/assets/css/woocommerce/woocommerce.css', array(), $poco_version);
            wp_style_add_data('poco-woocommerce-style', 'rtl', 'replace');

            // QuickView
            wp_dequeue_style('yith-quick-view');

            wp_register_script('poco-header-cart', get_template_directory_uri() . '/assets/js/woocommerce/header-cart' . $suffix . '.js', array(), $poco_version, true);
            wp_enqueue_script('poco-header-cart');

            wp_enqueue_script('poco-handheld-footer-bar', get_template_directory_uri() . '/assets/js/footer' . $suffix . '.js', array(), $poco_version, true);

            if (is_product()) {
                wp_register_script('poco-sticky-add-to-cart', get_template_directory_uri() . '/assets/js/sticky-add-to-cart' . $suffix . '.js', array(), $poco_version, true);
            }

            if (defined('WC_VERSION') && version_compare(WC_VERSION, '3.3', '<')) {
                wp_enqueue_style('poco-woocommerce-legacy', get_template_directory_uri() . '/assets/css/woocommerce/woocommerce-legacy.css', array(), $poco_version);
                wp_style_add_data('poco-woocommerce-legacy', 'rtl', 'replace');
            }

            if (is_shop() || is_product() || is_product_taxonomy() || poco_elementor_check_type('poco-products')) {
                wp_enqueue_script('tooltipster');
                wp_enqueue_style('tooltipster');
            }

            wp_enqueue_script('poco-products', get_template_directory_uri() . '/assets/js/woocommerce/main' . $suffix . '.js', array(
                'jquery',
                'tooltipster'
            ), $poco_version, true);

            // wp_enqueue_script('poco-input-quantity', get_template_directory_uri() . '/assets/js/woocommerce/quantity' . $suffix . '.js', array('jquery'), $poco_version, true);

            if (is_product()) {
                wp_enqueue_script('slick');
                wp_enqueue_script('poco-single-product', get_template_directory_uri() . '/assets/js/woocommerce/single' . $suffix . '.js', array(
                    'jquery',
                    'slick'
                ), $poco_version, true);
            }

            if (poco_is_product_archive() && is_active_sidebar('sidebar-woocommerce-shop')) {
                wp_enqueue_script('poco-off-canvas', get_template_directory_uri() . '/assets/js/woocommerce/off-canvas' . $suffix . '.js', array(), $poco_version, true);
            }

            wp_register_script('poco-cart-canvas', get_template_directory_uri() . '/assets/js/woocommerce/cart-canvas' . $suffix . '.js', array(), $poco_version, true);
        }

        /**
         * Star rating backwards compatibility script (WooCommerce <2.5).
         *
         * @since 1.6.0
         */
        public function star_rating_script() {
            if (is_product()) {
                ?>
                <script type="text/javascript">
                    var starsEl = document.querySelector('#respond p.stars');
                    if (starsEl) {
                        starsEl.addEventListener('click', function (event) {
                            if (event.target.tagName === 'A') {
                                starsEl.classList.add('selected');
                            }
                        });
                    }
                </script>
                <?php
            }
        }

        /**
         * Related Products Args
         *
         * @param array $args related products args.
         *
         * @return  array $args related products args
         * @since 1.0.0
         */
        public function related_products_args($args) {
            $product_items = 4;
            if (is_active_sidebar('sidebar-woocommerce-detail')) {
                $product_items = 3;
            }

            $args = apply_filters(
                'poco_related_products_args', array(
                    'posts_per_page' => $product_items,
                    'columns'        => $product_items,
                )
            );

            return $args;
        }

        /**
         * Product gallery thumbnail columns
         *
         * @return integer number of columns
         * @since  1.0.0
         */
        public function thumbnail_columns() {
            $columns = poco_get_theme_option('single-product-gallery-column', 4);

            if (poco_get_theme_option('single-product-gallery-layout', 'horizontal') == 'vertical') {
                $columns = 1;
            }

            return intval(apply_filters('poco_product_thumbnail_columns', $columns));
        }

        /**
         * Products per page
         *
         * @return integer number of products
         * @since  1.0.0
         */
        public function products_per_page() {
            return intval(apply_filters('poco_products_per_page', 12));
        }

        /**
         * Query WooCommerce Extension Activation.
         *
         * @param string $extension Extension class name.
         *
         * @return boolean
         */
        public function is_woocommerce_extension_activated($extension = 'WC_Bookings') {
            return class_exists($extension) ? true : false;
        }

        /**
         * Remove the breadcrumb delimiter
         *
         * @param array $defaults The breadcrumb defaults.
         *
         * @return array           The breadcrumb defaults.
         * @since 2.2.0
         */
        public function change_breadcrumb_delimiter($defaults) {
            $defaults['delimiter'] = '<span class="breadcrumb-separator"> / </span>';
//            $defaults['wrap_before'] = '<div class="poco-breadcrumb"><div class="breadcrum-inner">' . poco_get_breadcrumb_header() . '<nav class="woocommerce-breadcrumb">';
//            $defaults['wrap_after']  = '</nav></div></div>';

            return $defaults;
        }

        public function change_template_part($template, $slug, $name) {
            if (isset($_GET['layout'])) {
                if ($slug == 'content' && $name == 'product' && $_GET['layout'] == 'list') {
                    $template = wc_get_template_part('content', 'product-list');
                }
            }

            return $template;
        }

        public function widgets_init() {
            register_sidebar(array(
                'name'          => __('WooCommerce Shop', 'poco'),
                'id'            => 'sidebar-woocommerce-shop',
                'description'   => __('Add widgets here to appear in your sidebar on blog posts and archive pages.', 'poco'),
                'before_widget' => '<div id="%1$s" class="widget %2$s">',
                'after_widget'  => '</div>',
                'before_title'  => '<span class="gamma widget-title">',
                'after_title'   => '</span>',
            ));
            register_sidebar(array(
                'name'          => __('WooCommerce Detail', 'poco'),
                'id'            => 'sidebar-woocommerce-detail',
                'description'   => __('Add widgets here to appear in your sidebar on blog posts and archive pages.', 'poco'),
                'before_widget' => '<div id="%1$s" class="widget %2$s">',
                'after_widget'  => '</div>',
                'before_title'  => '<span class="gamma widget-title">',
                'after_title'   => '</span>',
            ));
        }

        public function set_sidebar($name) {
            $layout = poco_get_theme_option('woocommerce_archive_layout', 'default');
            if (poco_is_product_archive()) {
                if (is_active_sidebar('sidebar-woocommerce-shop') && $layout == 'default') {
                    $name = 'sidebar-woocommerce-shop';
                } else {
                    $name = '';
                }
            }
            if (is_product()) {
                if (is_active_sidebar('sidebar-woocommerce-detail')) {
                    $name = 'sidebar-woocommerce-detail';
                } else {
                    $name = '';
                }
            }


            return $name;
        }

        public function ajax_search_products() {
            global $woocommerce;

            $search_keyword = $_REQUEST['query'];

            $ordering_args = $woocommerce->query->get_catalog_ordering_args('date', 'desc');
            $suggestions   = array();

            $args = array(
                's'                   => apply_filters('poco_ajax_search_products_search_query', $search_keyword),
                'post_type'           => 'product',
                'post_status'         => 'publish',
                'ignore_sticky_posts' => 1,
                'orderby'             => $ordering_args['orderby'],
                'order'               => $ordering_args['order'],
                'posts_per_page'      => apply_filters('poco_ajax_search_products_posts_per_page', 8),

            );

            $products = get_posts($args);

            if (!empty($products)) {
                foreach ($products as $post) {
                    $product       = wc_get_product($post);
                    $product_image = wp_get_attachment_image_src(get_post_thumbnail_id($product->get_id()));

                    $suggestions[] = apply_filters('poco_suggestion', array(
                        'id'    => $product->get_id(),
                        'value' => strip_tags($product->get_title()),
                        'url'   => $product->get_permalink(),
                        'img'   => esc_url($product_image[0]),
                        'price' => $product->get_price_html(),
                    ), $product);
                }
            } else {
                $suggestions[] = array(
                    'id'    => -1,
                    'value' => __('No results', 'poco'),
                    'url'   => '',
                );
            }
            wp_reset_postdata();

            echo json_encode($suggestions);
            die();
        }

        public function ajax_search_result() {
            ?>
            <div class="ajax-search-result" style="display:none;">
            </div>
            <?php
        }

        public function ajax_live_search_template() {
            echo <<<HTML
        <script type="text/html" id="tmpl-ajax-live-search-template">
        <div class="product-item-search">
            <# if(data.url){ #>
            <a class="product-link" href="{{{data.url}}}" title="{{{data.title}}}">
            <# } #>
                <# if(data.img){#>
                <img src="{{{data.img}}}" alt="{{{data.title}}}">
                 <# } #>
                <div class="product-content">
                <h3 class="product-title">{{{data.title}}}</h3>
                <# if(data.price){ #>
                {{{data.price}}}
                 <# } #>
                </div>
                <# if(data.url){ #>
            </a>
            <# } #>
        </div>
        </script>
HTML;
        }

        public function grouped_product_column_image($grouped_product_child) {
            echo '<td class="woocommerce-grouped-product-image">' . $grouped_product_child->get_image('thumbnail') . '</td>';
        }

    }

endif;

return new Poco_WooCommerce();
