<?php

if (!defined('ABSPATH'))
    exit;

class MVVWO_Api
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
    private $settings = array();
    private $_active = false;

    public function __construct()
    {

        add_action(
            'rest_api_init',
            function () {
                register_rest_route(
                    MVVWO_TOKEN . '/v1',
                    '/save/',
                    array(
                        'methods' => 'POST',
                        'callback' => array($this, 'saveConfig'),
                        'permission_callback' => array($this, 'get_permission')
                    )
                );

            }
        );
    }

    /**
     *
     * Ensures only one instance of AWDP is loaded or can be loaded.
     *
     * @since 1.0.0
     * @static
     * @see WordPress_Plugin_Template()
     * @return Main AWDP instance
     */
    public static function instance($file = '', $version = '1.0.0')
    {
        if (is_null(self::$_instance)) {
            self::$_instance = new self($file, $version);
        }
        return self::$_instance;
    }


    function saveConfig($data)
    {
        $config = $data->get_params();
        $numbers = false;
        $temp = false;
        if (isset($config['config']['mobile']) && !empty($config['config']['mobile'])) {
            $temp = [
                'avatar' => isset($config['config']['temp']['avatar']) ? sanitize_text_field($config['config']['temp']['avatar']) : false,
                'number' => sanitize_text_field($config['config']['mobile']),
                'name' => isset($config['config']['temp']['name']) && $config['config']['temp']['name'] ? sanitize_text_field($config['config']['temp']['name']) : false,
                'availDays' => false,
                'availTime' => false,
            ];
        }
        if (isset($config['config']['numbers']) && is_array($config['config']['numbers']) && count($config['config']['numbers']) > 0) {
            $numbers = [];
            foreach ($config['config']['numbers'] as $i => $va) {
                $numbers[] = [
                    'avatar' => sanitize_text_field($va['avatar']),
                    'number' => sanitize_text_field($va['number']),
                    'name' => sanitize_text_field($va['name']),
                    'active' => $va['active'] ? true : false,
                    'availDays' => $va['availDays'],
                    'availTime' => $va['availTime'],
                ];
            }

        }
        $newConf = [
            'mobile' => sanitize_text_field($config['config']['mobile']),
            'numbers' => $numbers,
            'temp' => $temp,
            'floating' => [
                "enable" => ($config['config']['floating']['enable']) ? true : false,
                "hideDesktop" => ($config['config']['floating']['hideDesktop']) ? true : false,
                "position" => sanitize_textarea_field($config['config']['floating']['position']),
                "text" => sanitize_textarea_field($config['config']['floating']['text']),
                "delay" => sanitize_textarea_field($config['config']['floating']['delay']),
                "message" => sanitize_textarea_field($config['config']['floating']['message']),
                "size" => [
                    'width' => intval(sanitize_text_field($config['config']['floating']['size']['width'])),
                    'height' => intval(sanitize_text_field($config['config']['floating']['size']['height'])),
                    "padding" => intval(sanitize_text_field($config['config']['floating']['size']['padding'])),
                ],
                "design" => [
                    'txtBg' => sanitize_text_field($config['config']['floating']['design']['txtBg']),
                    'txtColor' => sanitize_text_field($config['config']['floating']['design']['txtColor']),
                    "iconColor" => sanitize_text_field($config['config']['floating']['design']['iconColor']),
                    "bg" => sanitize_text_field($config['config']['floating']['design']['bg']),
                ]
            ],
            'chatBox' => [
                "enable" => ($config['config']['chatBox']['enable']) ? true : false,
                "message" => sanitize_textarea_field($config['config']['chatBox']['message']),
                "text" => sanitize_text_field($config['config']['chatBox']['text']),
                "design" => [
                    "headBg" => sanitize_text_field($config['config']['chatBox']['design']['headBg']),
                    "headTxt" => sanitize_text_field($config['config']['chatBox']['design']['headTxt']),
                ]
            ],
            'product' => [
                "enable" => ($config['config']['product']['enable']) ? true : false,
                "hideDesktop" => ($config['config']['product']['hideDesktop']) ? true : false,
                "message" => sanitize_textarea_field($config['config']['product']['message']),
                "text" => sanitize_text_field($config['config']['product']['text']),
                "action_hook" => sanitize_text_field($config['config']['product']['action_hook']),
                "design" => [
                    "iconColor" => sanitize_text_field($config['config']['product']['design']['iconColor']),
                    "textColor" => sanitize_text_field($config['config']['product']['design']['textColor']),
                    "bg" => sanitize_text_field($config['config']['product']['design']['bg']),
                ]
            ],

            'shortcode' => [
                "hideDesktop" => ($config['config']['shortcode']['hideDesktop']) ? true : false,
                "message" => sanitize_textarea_field($config['config']['shortcode']['message']),
                "text" => sanitize_text_field($config['config']['shortcode']['text']),
                "design" => [
                    "iconColor" => sanitize_text_field($config['config']['shortcode']['design']['iconColor']),
                    "textColor" => sanitize_text_field($config['config']['shortcode']['design']['textColor']),
                    "bg" => sanitize_text_field($config['config']['shortcode']['design']['bg']),
                ]
            ],
            'visibility' => [
                'general' => $config['config']['visibility']['general'],
                'woo' => $config['config']['visibility']['woo'],
            ],
            'version'=>'pro_'.MVVWO_VERSION

        ];

        update_option(MVVWO_SETTINGS_KEY, $newConf);
        $ml = new MVVWO_Ml();
        if ($ml->is_active()) {
            $ml->settings_to_wpml();
        }
        return new WP_REST_Response(["status" => true], 200);
    }


    /**
     * Permission Callback
     **/
    public function get_permission()
    {

        if (current_user_can('administrator') || current_user_can('manage_woocommerce')) {
            return true;
        } else {
            return false;
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
