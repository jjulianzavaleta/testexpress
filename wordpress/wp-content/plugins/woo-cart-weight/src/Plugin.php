<?php
/**
 * Plugin main class.
 *
 * @package WPDesk\WooCommerceCartWeight
 */

namespace WPDesk\WooCommerceCartWeight;

use WCWeightVendor\WPDesk\PluginBuilder\Plugin\AbstractPlugin;
use WCWeightVendor\WPDesk\PluginBuilder\Plugin\HookableCollection;
use WCWeightVendor\WPDesk\PluginBuilder\Plugin\HookableParent;
use WCWeightVendor\WPDesk\View\Renderer\Renderer;
use WCWeightVendor\WPDesk\View\Renderer\SimplePhpRenderer;
use WCWeightVendor\WPDesk\View\Resolver\ChainResolver;
use WCWeightVendor\WPDesk\View\Resolver\DirResolver;
use WCWeightVendor\WPDesk\View\Resolver\WPThemeResolver;
use WPDesk\WooCommerceCartWeight\Renderer\CartWeightRenderer;
use WPDesk\WooCommerceCartWeight\Renderer\CheckoutWeightRenderer;
use WPDesk\WooCommerceCartWeight\Renderer\WidgetWeightRenderer;

/**
 * Main plugin class. The most important flow decisions are made here.
 *
 * @package WPDesk\WooCommerceCartWeight
 */
class Plugin extends AbstractPlugin implements HookableCollection {

	use HookableParent;

	/**
	 * Define plugin namespace for backward compatibility.
	 */
	const PLUGIN_NAMESPACE = 'woo-cart-weight';

	/**
	 * Plugin path
	 *
	 * @var string
	 */
	private $plugin_path;

	/**
	 * Template path
	 *
	 * @var string
	 */
	private $template_path;

	/**
	 * Renderer.
	 *
	 * @var Renderer
	 */
	private $renderer;

	/**
	 * Plugin constructor.
	 *
	 * @param \WCWeightVendor\WPDesk_Plugin_Info $plugin_info Plugin info.
	 */
	public function __construct( \WCWeightVendor\WPDesk_Plugin_Info $plugin_info ) {
		$this->plugin_info = $plugin_info;
		parent::__construct( $plugin_info );
	}

	/**
	 * Init base variables for plugin
	 */
	public function init_base_variables() {
		$this->plugin_url         = $this->plugin_info->get_plugin_url();
		$this->plugin_namespace   = self::PLUGIN_NAMESPACE;
		$this->plugin_path        = $this->plugin_info->get_plugin_dir();
		$this->template_path      = $this->plugin_info->get_text_domain();
	}

	/**
	 * Init plugin
	 */
	public function init() {
		$this->init_base_variables();
		$this->init_renderer();
		$this->load_dependencies();
		parent::init();
	}

	/**
	 * Init renderer.
	 *
	 * @return void
	 */
	private function init_renderer() {
		$resolver = new ChainResolver();
		$resolver->appendResolver( new WPThemeResolver( $this->template_path ) );
		$resolver->appendResolver( new DirResolver( trailingslashit( $this->plugin_path ) . 'templates' ) );
		$this->renderer = new SimplePhpRenderer( $resolver );
	}

	/**
	 * Load dependencies.
	 *
	 * @return void
	 */
	public function load_dependencies() {
	}

	/**
	 * Fires hooks
	 *
	 * @return void
	 */
	public function hooks() {
		parent::hooks();
		add_action( 'woocommerce_init', array( $this, 'init_renderers' ) );
		$this->hooks_on_hookable_objects();
	}

	/**
	 * Init renderers.
	 *
	 * @return void
	 */
	public function init_renderers() {
		$cart = WC()->cart;
		if ( null !== $cart ) {
			( new CartWeightRenderer( $this->renderer, $cart ) )->hooks();
			( new CheckoutWeightRenderer( $this->renderer, $cart ) )->hooks();
			( new WidgetWeightRenderer( $this->renderer, $cart ) )->hooks();
		}
	}
}
