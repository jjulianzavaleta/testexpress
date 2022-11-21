<?php

if (!defined('ABSPATH'))
    exit;

class MVVWO_Backend
{

    /**
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

    /**
     * The token.
     * @var     string
     * @access  public
     * @since   1.0.0
     */
    public $_token;

    /**
     * The main plugin file.
     * @var     string
     * @access  public
     * @since   1.0.0
     */
    public $file;

    /**
     * The main plugin directory.
     * @var     string
     * @access  public
     * @since   1.0.0
     */
    public $dir;

    /**
     * The plugin assets directory.
     * @var     string
     * @access  public
     * @since   1.0.0
     */
    public $assets_dir;

    /**
     * Suffix for Javascripts.
     * @var     string
     * @access  public
     * @since   1.0.0
     */
    public $script_suffix;

    /**
     * The plugin assets URL.
     * @var     string
     * @access  public
     * @since   1.0.0
     */
    public $assets_url;

    /**
     * Constructor function.
     * @access  public
     * @since   1.0.0
     * @return  void
     */
    public function __construct($file = '', $version = '1.0.0')
    {
        $this->_version = $version;
        $this->_token = MVVWO_TOKEN;
        $this->file = $file;
        $this->dir = dirname($this->file);
        $this->assets_dir = trailingslashit($this->dir) . 'assets';
        $this->assets_url = esc_url(trailingslashit(plugins_url('/assets/', $this->file)));

        $this->script_suffix = defined('SCRIPT_DEBUG') && SCRIPT_DEBUG ? '' : '.min';

        register_activation_hook($this->file, array($this, 'install'));
        register_deactivation_hook($this->file, array($this, 'deactivation'));

        add_action('admin_enqueue_scripts', array($this, 'admin_enqueue_scripts'), 10, 1);


        add_action('admin_menu', array($this, 'register_root_page'));

        $plugin = plugin_basename($this->file);
        add_filter("plugin_action_links_$plugin", array($this, 'add_settings_link'));

        add_action('pll_init', array($this, 'pll_init')); // polylang init
        add_action('init', array($this, 'gutenberg_register_block'));

        add_action('admin_head', array($this, 'admin_css'));

    }

    /**
     *
     *
     *
     *
     * @since 1.0.0
     * @static
     * @see WordPress_Plugin_Template()
     * @return Main MVVWO instance
     */
    public static function instance($file = '', $version = '1.0.0')
    {
        if (is_null(self::$_instance)) {
            self::$_instance = new self($file, $version);
        }
        return self::$_instance;
    }

    function gutenberg_register_block()
    {
        wp_register_script(
            MVVWO_TOKEN . '_block',
            esc_url($this->assets_url) . 'js/gutenberg.js',
            array('wp-blocks', 'wp-i18n', 'wp-element', 'wp-editor', 'underscore')
        );


        register_block_type(basename($this->dir) . '/' . MVVWO_TOKEN . '-block', array(
            'editor_script' => MVVWO_TOKEN . '_block',
        ));
    }

    public function pll_init()
    {
        $ml = new MVVWO_Ml();
        if ($ml->is_active()) {
            $ml->settings_to_ml_poly();
        }

    }

    public function admin_css()
    {
        $config = get_option(MVVWO_SETTINGS_KEY, false);
        if ($config !== false) {
            include(plugin_dir_path(__FILE__) . 'views/admin-head.php');
        }
    }

    public function add_settings_link($links)
    {
        $settings = '<a href="' . admin_url('options-general.php?page=mvvwo_admin_ui') . '">' . __('Settings') . '</a>';
        array_push($links, $settings);
        return $links;


    }

    public function register_root_page()
    {

        $this->hook_suffix[] = add_options_page(
            __('WhatsApp Button', 'orders-on-whatsapp-for-woocommerce')
            , __('WhatsApp Button', 'orders-on-whatsapp-for-woocommerce'),
            'manage_options',
            'mvvwo_admin_ui', array($this, 'admin_ui'));

    }

    public function admin_ui()
    {
        MVVWO_Backend::view('admin-root', []);
    }

    static function view($view, $data = array())
    {
        extract($data);
        include(plugin_dir_path(__FILE__) . 'views/' . $view . '.php');
    }


    /**
     * Load admin Javascript.
     * @access  public
     * @since   1.0.0
     * @return  void
     */
    public function admin_enqueue_scripts($hook = '')
    {

        if (!isset($this->hook_suffix) || empty($this->hook_suffix)) {
            return;
        }


        $screen = get_current_screen();
        $newConf = [
            'mobile' => '',
            'floating' => [
                "enable" => false,
                "hideDesktop" => false,
                "message" => 'Hello, I\'m looking for ',
                "text" => 'Click to Chat!',
                "delay" => 2000,
                "position" => 'right',
                "size" => [
                    'width' => 60,
                    'height' => 60,
                    'padding' => 13,
                ],
                "design" => [
                    "txtBg" => "#ffffff",
                    "txtColor" => "#333333",
                    "iconColor" => "#ffffff",
                    "bg" => "#25D367",
                ]
            ],
            'product' => [
                "enable" => false,
                "hideDesktop" => false,
                "message" => "Hello, I want to purchase \n{PRODUCT_NAME}\nURL: {PRODUCT_URL} \nPrice: {PRODUCT_PRICE}",
                "text" => 'Order on WhatsApp',
                "action_hook" => 'woocommerce_after_add_to_cart_button',
                "design" => [
                    "textColor" => "#ffffff",
                    "iconColor" => "#ffffff",
                    "bg" => "#1ebea5",
                ]
            ],
            'version'=>'pro_'.MVVWO_VERSION

        ];

        $config = get_option(MVVWO_SETTINGS_KEY, $newConf);

        if (!isset($config['floating']['design']['txtBg'])) {
            $config['floating']['design']['txtBg'] = '#ffffff';
        }
        if (!isset($config['floating']['design']['txtColor'])) {
            $config['floating']['design']['txtColor'] = '#333333';
        }

        if (!isset($config['floating']['position'])) {
            $config['floating']['position'] = 'right';
        }
        if (!isset($config['floating']['delay'])) {
            $config['floating']['delay'] = 2000;
        }
        if (!isset($config['product']['action_hook'])) {
            $config['product']['action_hook'] = 'woocommerce_after_add_to_cart_button';
        }
        if (!isset($config['floating']['size'])) {
            $config['floating']['size'] = [
                'width' => 60,
                'height' => 60,
                'padding' => 13,
            ];
        }
        if (!isset($config['chatBox'])) {
            $config['chatBox'] = [
                "enable" => false,
                "message" => 'Hello, I want to ask ',
                "text" => 'We are here to help. Chat with us on WhatsApp for any queries.',
                "design" => [
                    "headBg" => "#2E8C7D",
                    "headTxt" => "#ffffff",
                ]
            ];
        }

        if (!isset($config['visibility'])) {
            $config['visibility'] = ['general' => [], 'woo' => []];
        }
        if (!isset($config['shortcode'])) {
            $config['shortcode'] = [
                "hideDesktop" => false,
                "message" => 'Hello, I want to purchase ',
                "text" => 'Order on WhatsApp',
                "design" => [
                    "textColor" => "#ffffff",
                    "iconColor" => "#ffffff",
                    "bg" => "#1ebea5",
                ]
            ];
        }
        if (!isset($config['version'])) {

            $config['product']['message'] = $config['product']['message']."\n{PRODUCT_NAME}\n{PRODUCT_URL}";
        }
        wp_enqueue_media();
        wp_enqueue_script('jquery');
        if (in_array($screen->id, $this->hook_suffix)) {
            if (!wp_script_is('wp-i18n', 'registered')) {
                wp_register_script('wp-i18n', esc_url($this->assets_url) . 'js/i18n.min.js', array(), $this->_version, true);
            }
            wp_enqueue_script('wp-i18n');
            wp_enqueue_script($this->_token . '-backend', esc_url($this->assets_url) . 'js/backend.js', array('wp-i18n'), $this->_version, true);
            wp_localize_script($this->_token . '-backend', $this->_token . '_object', array(
                    'api_nonce' => wp_create_nonce('wp_rest'),
                    'root' => rest_url($this->_token . '/v1/'),
                    'upgradeUrl' => admin_url('options-general.php?page=mvvwo_admin_ui-pricing'),
                    'assets_url' => $this->assets_url,
                    'config' => $config
                )
            );

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


    /**
     * Cloning is forbidden.
     *
     * @since 1.0.0
     */
    public function __clone()
    {
        _doing_it_wrong(__FUNCTION__, __('Cheatin&#8217; huh?'), $this->_version);
    }

    /**
     * Unserializing instances of this class is forbidden.
     *
     * @since 1.0.0
     */
    public function __wakeup()
    {
        _doing_it_wrong(__FUNCTION__, __('Cheatin&#8217; huh?'), $this->_version);
    }

    /**
     * Installation. Runs on activation.
     * @access  public
     * @since   1.0.0
     * @return  void
     */
    public function install()
    {
        $this->_log_version_number();


    }

    /**
     * Log the plugin version number.
     * @access  public
     * @since   1.0.0
     * @return  void
     */
    private function _log_version_number()
    {
        update_option($this->_token . '_version', $this->_version);
    }


    public function deactivation()
    {

    }

}
