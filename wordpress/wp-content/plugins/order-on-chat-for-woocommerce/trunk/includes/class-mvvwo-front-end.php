<?php

if (!defined('ABSPATH'))
    exit;

class MVVWO_Front_End
{

    static $cart_error = array();
    /**
     * The single instance of WordPress_Plugin_Template_Settings.
     * @var    object
     * @access  private
     * @since    1.0.0
     */
    private static $_instance = null;

    /**
     * The version number.
     * @var     string
     * @access  public
     * @since   1.0.0
     */
    public $_version;

    public $config;
    /**
     * The token.
     * @var     string
     * @access  public
     * @since   1.0.0
     */
    public $_token;
    /**
     * The plugin assets URL.
     * @var     string
     * @access  public
     * @since   1.0.0
     */
    public $assets_url;
    /**
     * The main plugin file.
     * @var     string
     * @access  public
     * @since   1.0.0
     */
    public $file;

    /**
     * Check if price has to be display in cart and checkout
     * @var type
     * @var boolean
     * @access private
     * @since 3.4.2
     */


    function __construct($file = '', $version = '1.0.0')
    {
// Load frontend JS & CSS

        $this->_version = $version;
        $this->_token = MVVWO_TOKEN;
        /**api
         * Check if WooCommerce is active
         * */


        $this->file = $file;
        $this->assets_url = esc_url(trailingslashit(plugins_url('/assets/', $this->file)));

        add_action('wp_footer', array($this, 'wp_footer'), 10);
        add_action('wp_footer', array($this, 'footer_scripts'), 11);
        add_action('wp_head', array($this, 'wp_head'), 10);
//        woocommerce_after_add_to_cart_button
        add_action('woocommerce_before_single_product', array($this, 'before_single_product'), 10);

        add_shortcode('mvv_whatsbutton', array($this, 'mvv_whatsbutton'));

    }

    public static function instance($parent)
    {
        if (is_null(self::$_instance)) {
            self::$_instance = new self($parent);
        }
        return self::$_instance;
    }

    public function mvv_whatsbutton($atts)
    {
        $atts = shortcode_atts(array(
            'text' => '',
        ), $atts);
        $html = '';
        $config = get_option(MVVWO_SETTINGS_KEY, false);
        if ($config !== false) {
            include(plugin_dir_path(__FILE__) . 'views/shortcode-button.php');
        }
        return $html;
    }

    public function wp_footer()
    {
        $config = get_option(MVVWO_SETTINGS_KEY, false);
        if ($config !== false) {
            if ($config !== false && $config['floating']['enable'] === true) {

                if (isset($config['visibility']) && isset($config['visibility']['general'])) {
                    foreach ($config['visibility']['general'] as $page) {
                        switch ($page) {
                            case 'frontPage':
                                if (is_front_page() || is_home()) {
                                    return;
                                }
                                break;
                            case 'blog':
                                if ((is_archive() || is_author() || is_category() || is_home() ||
                                        is_single() || is_tag()) && 'post' == get_post_type()) {
                                    return;
                                }
                                break;
                            case '404Page':
                                if (is_404()) {
                                    return;
                                }
                                break;
                            case 'archive':
                                if ((is_archive() || is_author() || is_category() || is_home() ||
                                    is_single() || is_tag())) {
                                    return;
                                }
                                break;
                            case 'page':
                                if (is_page() && !is_front_page() && !is_home()) {
                                    return;
                                }
                                break;
                            case 'post':
                                if (is_single() && 'post' == get_post_type()) {
                                    return;
                                }
                                break;
                        }
                    }
                }
                if ($this->check_woocommerce_active() && isset($config['visibility']) && isset($config['visibility']['woo'])) {
                    foreach ($config['visibility']['woo'] as $page) {
                        switch ($page) {
                            case 'shop':
                                if (is_shop() || is_product_category() || is_product_tag()) {
                                    return;
                                }
                                break;
                            case 'product':
                                if (is_product()) {
                                    return;
                                }
                                break;
                            case 'cart':
                                if (is_cart()) {
                                    return;
                                }
                                break;
                            case 'checkout':
                                if (is_checkout()) {
                                    return;
                                }
                                break;
                            case 'account':
                                if (is_account_page()) {
                                    return;
                                }
                                break;
                        }
                    }
                }
                include(plugin_dir_path(__FILE__) . 'views/footer.php');
            }
        }

    }

    public function check_woocommerce_active()
    {
        if (in_array('woocommerce/woocommerce.php', apply_filters('active_plugins', get_option('active_plugins')))) {
            return true;
        }
        if (is_multisite()) {
            $plugins = get_site_option('active_sitewide_plugins');
            if (isset($plugins['woocommerce/woocommerce.php']))
                return true;
        }
        return false;
    }

    public function wp_head()
    {
        $config = get_option(MVVWO_SETTINGS_KEY, false);
        if ($config !== false) {
            include(plugin_dir_path(__FILE__) . 'views/header.php');
        }
    }

    public function footer_scripts()
    {
        $config = get_option(MVVWO_SETTINGS_KEY, false);
        if ($config !== false) {
            include(plugin_dir_path(__FILE__) . 'views/footer-scripts.php');
        }
    }

    public function before_single_product()
    {
        $this->config = get_option(MVVWO_SETTINGS_KEY, false);
        if ($this->config !== false && $this->config['product']['enable'] === true) {
            if (isset($this->config['product']['action_hook']) && !empty($this->config['product']['action_hook'])) {
                $action = $this->config['product']['action_hook'];
            } else {
                $action = 'woocommerce_after_add_to_cart_button';
            }
            add_action($action, array($this, 'render_button'));
        }
    }

    public function render_button()
    {
        $config = $this->config;
        include(plugin_dir_path(__FILE__) . 'views/cart-button.php');

    }






// End enqueue_scripts ()
// End instance()
}
