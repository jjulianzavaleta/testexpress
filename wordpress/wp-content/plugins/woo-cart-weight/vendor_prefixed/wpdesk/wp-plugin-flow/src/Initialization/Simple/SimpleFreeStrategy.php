<?php

namespace WCWeightVendor\WPDesk\Plugin\Flow\Initialization\Simple;

use WCWeightVendor\WPDesk\Plugin\Flow\Initialization\ActivationTrait;
use WCWeightVendor\WPDesk\Plugin\Flow\Initialization\BuilderTrait;
use WCWeightVendor\WPDesk\Plugin\Flow\Initialization\InitializationStrategy;
use WCWeightVendor\WPDesk\PluginBuilder\Plugin\SlimPlugin;
/**
 * Initialize free plugin
 * - just build it already
 */
class SimpleFreeStrategy implements \WCWeightVendor\WPDesk\Plugin\Flow\Initialization\InitializationStrategy
{
    use HelperInstanceAsFilterTrait;
    use TrackerInstanceAsFilterTrait;
    use BuilderTrait;
    /** @var \WPDesk_Plugin_Info */
    private $plugin_info;
    /** @var SlimPlugin */
    private $plugin;
    public function __construct(\WCWeightVendor\WPDesk_Plugin_Info $plugin_info)
    {
        $this->plugin_info = $plugin_info;
    }
    /**
     * Run tasks that prepares plugin to work. Have to run before plugin loaded.
     *
     * @param \WPDesk_Plugin_Info $plugin_info
     *
     * @return SlimPlugin
     */
    public function run_before_init(\WCWeightVendor\WPDesk_Plugin_Info $plugin_info)
    {
        $this->plugin = $this->build_plugin($plugin_info);
        $this->init_register_hooks($plugin_info, $this->plugin);
    }
    /**
     * Run task that integrates plugin with other dependencies. Can be run in plugins_loaded.
     *
     * @param \WPDesk_Plugin_Info $plugin_info
     *
     * @return SlimPlugin
     */
    public function run_init(\WCWeightVendor\WPDesk_Plugin_Info $plugin_info)
    {
        if (!$this->plugin) {
            $this->plugin = $this->build_plugin($plugin_info);
        }
        $this->prepare_helper_action();
        $this->prepare_tracker_action();
        $this->store_plugin($this->plugin);
        $this->init_plugin($this->plugin);
        return $this->plugin;
    }
}
