<?php
/**
 * Poco WooCommerce Size Chart Class
 *
 * @package  poco
 * @since    2.4.3
 */

if (!defined('ABSPATH')) {
    exit;
}

if (!class_exists('Poco_WooCommerce_Size_Chart')) :

    /**
     * The Poco WooCommerce Size Chart Class
     */
    class Poco_WooCommerce_Size_Chart {

        public function __construct() {
            if (poco_is_elementor_activated()) {
                add_filter('woocommerce_product_data_tabs', array($this, 'sizechart_product_tabs'));
                add_filter('woocommerce_product_data_panels', array(
                    $this,
                    'sizechart_options_product_tab_content'
                ));
                add_action('woocommerce_process_product_meta', array($this, 'save_sizechart_option_fields'));

                add_action('woocommerce_single_product_summary', array($this, 'render_sizechart_button'), 25);
                add_action('wp_footer', array($this, 'render_sizechart_template'), 1);
                add_action('wp_enqueue_scripts', [$this, 'add_css']);
            }
        }

        public function sizechart_product_tabs($tabs) {

            $tabs['sizechart'] = array(
                'label'    => __('Size Chart', 'poco'),
                'target'   => 'sizechart_options',
                'class'    => array(),
                'priority' => 80,
            );

            $tabs['extrainfo'] = array(
                'label'    => __('Extra info', 'poco'),
                'target'   => 'extrainfo_options',
                'class'    => array(),
                'priority' => 80,
            );

            return $tabs;

        }

        private function check_chart($slug = '') {

            if ($slug) {

                $queried_post = get_page_by_path($slug, OBJECT, 'elementor_library');

                if (isset($queried_post->ID)) {
                    return $queried_post->ID;
                }
            }

            return false;
        }

        public function sizechart_options_product_tab_content() {

            global $post;

            ?>
            <div id='sizechart_options' class='panel woocommerce_options_panel'>
                <div class='options_group'><?php

                    $value = get_post_meta($post->ID, '_sizechart_select', true);
                    if (empty($value)) {
                        $value = '';
                    }
                    $options[''] = __('Select size chart', 'poco');

                    $args = array(
                        'post_type'      => 'elementor_library',
                        'posts_per_page' => -1,
                        'orderby'        => 'title',
                        's'              => 'SizeChart ',
                        'order'          => 'ASC',
                    );

                    $query1 = new WP_Query($args);
                    while ($query1->have_posts()) {
                        $query1->the_post();
                        $options[$post->post_name] = $post->post_title;
                    }

                    woocommerce_wp_select(array(
                        'id'      => '_sizechart_select',
                        'label'   => __('Size chart', 'poco'),
                        'options' => $options,
                        'value'   => $value,
                    ));

                    ?></div>

            </div>

            <div id='extrainfo_options' class='panel woocommerce_options_panel'>
                <div class='options_group'>
                   <?php
                   woocommerce_wp_textarea_input(array(
                       'id'      => '_extra_info',
                       'label'   => __('Extra info', 'poco'),
                   ));
                   ?></div>
            </div>
            <?php

        }

        public function save_sizechart_option_fields($post_id) {
            if (isset($_POST['_sizechart_select'])) {
                update_post_meta($post_id, '_sizechart_select', esc_attr($_POST['_sizechart_select']));
            }
            if (isset($_POST['_extra_info'])) {
                update_post_meta($post_id, '_extra_info', esc_attr($_POST['_extra_info']));
            }
        }

        public function add_css() {
            global $post;
            if (!is_product()) {
                return;
            }
            $slug     = get_post_meta($post->ID, '_sizechart_select', true);
            $chart_id = $this->check_chart($slug);
            if (!empty($slug) && $chart_id) {
                Elementor\Core\Files\CSS\Post::create($chart_id)->enqueue();
            }
        }

        public function render_sizechart_button() {
            global $post;
            if (!is_product()) {
                return;
            }
            $slug     = get_post_meta($post->ID, '_sizechart_select', true);
            $chart_id = $this->check_chart($slug);
            if (!empty($slug) && $chart_id) {
                echo '<a href="#" class="sizechart-button">' . esc_html__('Size Guide', 'poco') . '</a>';
            }
        }

        public function render_sizechart_template() {
            global $post;
            if (!is_product()) {
                return;
            }
            $slug     = get_post_meta($post->ID, '_sizechart_select', true);
            $chart_id = $this->check_chart($slug);
            if (!empty($slug) && $chart_id) {
                echo '<div class="sizechart-popup"><a href="#" class="sizechart-close"><i class="poco-icon-times-circle"></i></a>' . Elementor\Plugin::instance()->frontend->get_builder_content($chart_id) . '</div><div class="sizechart-overlay"></div>';
            }
        }
    }

    return new Poco_WooCommerce_Size_Chart();

endif;
