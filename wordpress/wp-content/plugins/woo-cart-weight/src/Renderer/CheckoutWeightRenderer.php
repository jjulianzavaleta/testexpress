<?php
/**
 * Order renderer.
 *
 * @package WPDesk\WooCommerceCartWeight\Renderer
 */

namespace WPDesk\WooCommerceCartWeight\Renderer;

/**
 * Can render cart weight in checkout.
 */
class CheckoutWeightRenderer extends AbstractWeightRenderer {

	/**
	 * Returns action name.
	 * Cart weight will be rendered on this action.
	 *
	 * @return string
	 */
	protected function get_action_name() {
		return 'woocommerce_review_order_after_order_total';
	}

	/**
	 * Returns template name to render.
	 *
	 * @return string
	 */
	protected function get_template_name() {
		return 'checkout-review-order-after-order-total';
	}

}
