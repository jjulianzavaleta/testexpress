<?php

namespace WCWeightVendor\WPDesk\Helper\Integration;

use WCWeightVendor\WPDesk\Helper\Page\SettingsPage;
use WCWeightVendor\WPDesk\PluginBuilder\Plugin\Hookable;
use WCWeightVendor\WPDesk\PluginBuilder\Plugin\HookableCollection;
use WCWeightVendor\WPDesk\PluginBuilder\Plugin\HookableParent;
/**
 * Integrates WP Desk main settings page with WordPress
 *
 * @package WPDesk\Helper
 */
class SettingsIntegration implements \WCWeightVendor\WPDesk\PluginBuilder\Plugin\Hookable, \WCWeightVendor\WPDesk\PluginBuilder\Plugin\HookableCollection
{
    use HookableParent;
    /** @var SettingsPage */
    private $settings_page;
    public function __construct(\WCWeightVendor\WPDesk\Helper\Page\SettingsPage $settingsPage)
    {
        $this->add_hookable($settingsPage);
    }
    /**
     * @return void
     */
    public function hooks()
    {
        $this->hooks_on_hookable_objects();
    }
}
