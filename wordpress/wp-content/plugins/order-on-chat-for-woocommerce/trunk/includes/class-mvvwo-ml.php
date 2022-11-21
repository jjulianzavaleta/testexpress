<?php

if (!defined('ABSPATH'))
    exit;

class MVVWO_Ml
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
    public $default_lang;
    public $current_lang;
    private $_active = false;

    public function __construct()
    {

        if (class_exists('SitePress')) {
            $this->_active = 'wpml';

        } else if (defined('POLYLANG_VERSION')) {
            $this->_active = 'polylang';

        }
    }


    public static function instance($file = '', $version = '1.0.0')
    {
        if (is_null(self::$_instance)) {
            self::$_instance = new self($file, $version);
        }
        return self::$_instance;
    }

    public function is_active()
    {
        return $this->_active !== false;
    }


    public function settings_to_wpml()
    {


        $config = get_option(MVVWO_SETTINGS_KEY, false);
        do_action('wpml_register_single_string', MVVWO_TEXT_DOMAIN, 'Floating Button Message', $config['floating']['message']);
        do_action('wpml_register_single_string', MVVWO_TEXT_DOMAIN, 'Floating Button Text', $config['floating']['text']);
        do_action('wpml_register_single_string', MVVWO_TEXT_DOMAIN, 'Product Page Button Text', $config['product']['text']);
        do_action('wpml_register_single_string', MVVWO_TEXT_DOMAIN, 'Product Page Button Message', $config['product']['message']);
        do_action('wpml_register_single_string', MVVWO_TEXT_DOMAIN, 'Block Editor Button Message', $config['shortcode']['message']);


    }

    public function settings_to_ml_poly()
    {

        if (function_exists('pll_register_string')) {
            $config = get_option(MVVWO_SETTINGS_KEY, false);
            pll_register_string('Floating Button Message', $config['floating']['message'], MVVWO_PLUGIN_NAME);
            pll_register_string('Floating Button Text', $config['floating']['text'], MVVWO_PLUGIN_NAME);
            pll_register_string('Product Page Button Text', $config['product']['text'], MVVWO_PLUGIN_NAME);
            pll_register_string('Product Page Button Message', $config['product']['message'], MVVWO_PLUGIN_NAME);
            pll_register_string('Block Editor Button Message', $config['shortcode']['message'], MVVWO_PLUGIN_NAME);


        }
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

}
