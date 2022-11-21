<?php
/**
 * Widget renderer.
 *
 * @package WPDesk\WooCommerceCartWeight\Renderer
 */

namespace WPDesk\WooCommerceCartWeight\Renderer;

/**
 * Can render cart weight in cart widget.
 */
class WidgetWeightRenderer extends AbstractWeightRenderer {

	/**
	 * Returns action name.
	 * Cart weight will be rendered on this action.
	 *
	 * @return string
	 */
	protected function get_action_name() {
		return 'woocommerce_widget_shopping_cart_before_buttons';
	}

	/**
	 * Returns template name to render.
	 *
	 * @return string
	 */
	protected function get_template_name() {
		return 'widget-shopping-cart-before-buttons';
	}

}
