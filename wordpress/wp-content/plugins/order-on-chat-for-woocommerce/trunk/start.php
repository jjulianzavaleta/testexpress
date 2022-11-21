<?php
/*
 * Plugin Name: WhatsButton - Leads and Order over Chat
 * Version: 1.5.7
 * Plugin URI:
 * Description:WhatsApp chat button - Leads and WooCommerce Order over WhatsApp
 * Author URI:http://mvvapps.com
 * Author:mvvapps
 * Requires at least: 4.0
 * Tested up to: 5.5.1
 * Text Domain:order-on-chat-for-woocommerce
 * WC requires at least: 3.3.0
 * WC tested up to: 4.6.1
 */

if ( function_exists( 'oocfw_fs' ) ) {
    oocfw_fs()->set_basename( false, __FILE__ );
} else {
    if (!function_exists('oocfw_fs')) {


    }
}


if ( ! function_exists( 'oocfw_fs' ) ) {
    // Create a helper function for easy SDK access.
    function oocfw_fs() {
        global $oocfw_fs;

        if ( ! isset( $oocfw_fs ) ) {
            // Include Freemius SDK.
            require_once dirname(__FILE__) . '/freemius/start.php';

            $oocfw_fs = fs_dynamic_init( array(
                'id'                  => '4846',
                'slug'                => 'order-on-chat-for-woocommerce',
                'type'                => 'plugin',
                'public_key'          => 'pk_41b05d5b6bfce0443d269fcb34832',
                'is_premium'          => false,
                'has_addons'          => false,
                'has_paid_plans'      => true,
                'menu'                => array(
                    'slug'           => 'mvvwo_admin_ui',
                    'account'        => false,
                    'contact'        => false,
                    'parent'         => array(
                        'slug' => 'options-general.php',
                    ),
                ),
            ) );
        }

        return $oocfw_fs;
    }

    // Init Freemius.
    oocfw_fs();
    // Signal that SDK was initiated.
    do_action( 'oocfw_fs_loaded' );
}
define('MVVWO_SETTINGS_KEY', 'mvvwo_settings_key');

define('MVVWO_TOKEN', 'mvvwo');

define('MVVWO_VERSION', '1.5.7');
define('MVVWO_FILE', __FILE__);
define('MVVWO_TEXT_DOMAIN', 'order-on-chat-for-woocommerce');

define('MVVWO_PLUGIN_NAME', 'Order on Chat(WhatsApp) for Woocommerce');


require_once(realpath(plugin_dir_path(__FILE__)) . DIRECTORY_SEPARATOR . 'includes/helpers.php');
if (!function_exists('mvvwo_init')) {

    function mvvwo_init()
    {
        $plugin_rel_path = basename(dirname(__FILE__)) . '/languages'; /* Relative to WP_PLUGIN_DIR */
        load_plugin_textdomain('mvvwo', false, $plugin_rel_path);
    }

}


if (!function_exists('mvvwo_autoloader')) {

    function mvvwo_autoloader($class_name)
    {
        if (0 === strpos($class_name, 'MVVWO')) {
            $classes_dir = realpath(plugin_dir_path(__FILE__)) . DIRECTORY_SEPARATOR . 'includes' . DIRECTORY_SEPARATOR;
            $class_file = 'class-' . str_replace('_', '-', strtolower($class_name)) . '.php';
            require_once $classes_dir . $class_file;
        }
    }

}

if (!function_exists('MVVWO')) {

    function MVVWO()
    {
        $instance = MVVWO_Backend::instance(__FILE__, MVVWO_VERSION);
        return $instance;
    }

}
add_action('plugins_loaded', 'mvvwo_init');
spl_autoload_register('mvvwo_autoloader');
if (is_admin()) {
    MVVWO();
}

new MVVWO_Api();
new MVVWO_Front_End(__FILE__, MVVWO_VERSION);



