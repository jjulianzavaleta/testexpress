<?php
/**
 * The Template for displaying cart weight on cart widget.
 *
 * This template can be overridden by copying it to yourtheme/woo-cart-weight/widget-shopping-cart-before-buttons.php.
 *
 * @package WPDesk\WooCommerceCartWeight
 *
 * @var $cart_weight float
 * @var $weight_unit float
 */

?><p class="woocommerce-mini-cart__total total total-weight">
	<strong><?php echo esc_attr( __( 'Total Weight:', 'woo-cart-weight' ) ); ?></strong> <?php echo esc_html( $cart_weight . ' ' . $weight_unit ); ?>
</p>
