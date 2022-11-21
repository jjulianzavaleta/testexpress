<?php
/**
 * Cart renderer.
 *
 * @package WPDesk\WooCommerceCartWeight\Renderer
 */

namespace WPDesk\WooCommerceCartWeight\Renderer;

/**
 * Can render cart weight in cart.
 */
class CartWeightRenderer extends AbstractWeightRenderer {

	/**
	 * Returns action name.
	 * Cart weight will be rendered on this action.
	 *
	 * @return string
	 */
	protected function get_action_name() {
		return 'woocommerce_cart_totals_after_order_total';
	}

	/**
	 * Returns template name to render.
	 *
	 * @return string
	 */
	protected function get_template_name() {
		return 'cart-totals-after-order-total';
	}

}
