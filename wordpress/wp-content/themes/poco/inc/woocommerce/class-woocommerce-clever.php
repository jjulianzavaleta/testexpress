<?php
if (!defined('ABSPATH')) {
    exit;
}

if (!class_exists('Poco_WooCommerce_Clever')) :


    class Poco_WooCommerce_Clever {
        public function __construct() {

            $this->check_activate();
            $this->add_hook();

            add_action('tgmpa_register', [$this, 'register_required_plugins']);
        }

        private function check_activate() {
            if (is_admin() && current_user_can('administrator')) {

                $check = get_option('clever_plugin_first_activate', false);
                if (!$check) {

                    update_option('woosw_button_position_archive', '0');
                    update_option('woosw_button_position_single', '0');

                    update_option('clever_plugin_first_activate', true);
                }
            }
        }

        public function add_hook() {

            if (function_exists('woosw_init')) {
                if (get_option('woosw_button_position_archive') == "0") {
                    add_action('poco_woocommerce_product_loop_image', [$this, 'wishlist_button'], 5);
                }

                if (get_option('woosw_button_position_single') == "0") {
                    add_action('woocommerce_after_add_to_cart_button', [$this, 'wishlist_button'], 10);
                }
            }
        }

        public function register_required_plugins() {
            /**
             * Array of plugin arrays. Required keys are name and slug.
             * If the source is NOT from the .org repo, then source is also required.
             */
            $plugins = array(
                array(
                    'name'     => 'WPC Smart Wishlist for WooCommerce',
                    'slug'     => 'woo-smart-wishlist',
                    'required' => false,
                )
            );

            /*
             * Array of configuration settings. Amend each line as needed.
             *
             * TGMPA will start providing localized text strings soon. If you already have translations of our standard
             * strings available, please help us make TGMPA even better by giving us access to these translations or by
             * sending in a pull-request with .po file(s) with the translations.
             *
             * Only uncomment the strings in the config array if you want to customize the strings.
             */
            $config = array(
                'id'           => 'poco',
                // Unique ID for hashing notices for multiple instances of TGMPA.
                'default_path' => '',
                // Default absolute path to bundled plugins.
                'menu'         => 'tgmpa-install-plugins',
                // Menu slug.
                'has_notices'  => true,
                // Show admin notices or not.
                'dismissable'  => true,
                // If false, a user cannot dismiss the nag message.
                'dismiss_msg'  => '',
                // If 'dismissable' is false, this message will be output at top of nag.
                'is_automatic' => false,
                // Automatically activate plugins after installation or not.
                'message'      => '',
            );

            tgmpa($plugins, $config);
        }

        public function quickview_button() {
            echo do_shortcode('[woosq]');
        }

        public function compare_button() {
            echo do_shortcode('[woosc]');
        }

        public function wishlist_button() {
            echo do_shortcode('[woosw]');
        }

    }

    return new Poco_WooCommerce_Clever();
endif;
