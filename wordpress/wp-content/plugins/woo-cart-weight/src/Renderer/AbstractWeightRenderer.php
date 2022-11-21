<?php
/**
 * Abstract renderer.
 *
 * @package WPDesk\WooCommerceCartWeight\Renderer
 */

namespace WPDesk\WooCommerceCartWeight\Renderer;

use WCWeightVendor\WPDesk\PluginBuilder\Plugin\Hookable;
use WCWeightVendor\WPDesk\View\Renderer\Renderer;

/**
 * Can render cart weight.
 */
abstract class AbstractWeightRenderer implements Hookable {

	/**
	 * Renderer.
	 *
	 * @var Renderer
	 */
	private $renderer;

	/**
	 * Cart.
	 *
	 * @var \WC_Cart
	 */
	private $cart;

	/**
	 * CartTotals constructor.
	 *
	 * @param Renderer $renderer .
	 * @param \WC_Cart $cart .
	 */
	public function __construct( Renderer $renderer, \WC_Cart $cart ) {
		$this->renderer = $renderer;
		$this->cart = $cart;
	}

	/**
	 * Hooks.
	 */
	public function hooks() {
		add_action( $this->get_action_name(), array( $this, 'render_weight' ) );
	}

	/**
	 * @return void
	 * @internal
	 */
	public function render_weight() {
		$cart_weight = $this->get_cart_weight();
		if ( $this->should_display_cart_weight( $cart_weight ) ) {
			$template_params = array(
				'cart_weight' => $cart_weight,
				'weight_unit' => $this->get_weight_unit(),
			);
			echo $this->renderer->render( $this->get_template_name(), $template_params ); // phpcs:ignore
		};
	}

	/**
	 * @return float
	 */
	private function get_cart_weight() {
		/**
		 * Filters cart weight.
		 *
		 * @param float $cart_weight Weight from WooCommerce cart.
		 */
		return apply_filters( 'woo_cart_weight/cart_weight', $this->cart->get_cart_contents_weight() );
	}

	/**
	 * @param float $cart_weight .
	 *
	 * @return bool
	 */
	private function should_display_cart_weight( $cart_weight ) {
		return $this->cart->needs_shipping() && ! empty( $cart_weight );
	}

	/**
	 * @return string
	 */
	private function get_weight_unit() {
		/**
		 * Filters weight unit.
		 *
		 * @param string $weight_unit Weight unit from WooCommerce settings.
		 */
		return apply_filters( 'woo_cart_weight/weight_unit', get_option( 'woocommerce_weight_unit' ) );
	}

	/**
	 * Returns action name.
	 * Cart weight will be rendered on this action.
	 *
	 * @return string
	 */
	abstract protected function get_action_name();

	/**
	 * Returns template name to render.
	 *
	 * @return string
	 */
	abstract protected function get_template_name();

}
