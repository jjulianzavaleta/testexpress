<?php
/**
 * The Template for displaying cart weight on cart page.
 *
 * This template can be overridden by copying it to yourtheme/woo-cart-weight/cart-totals-after-order-total.php.
 *
 * @package WPDesk\WooCommerceCartWeight
 *
 * @var $cart_weight float
 * @var $weight_unit float
 */

?><tr class="total-weight">
	<th><?php echo esc_attr( __( 'Total Weight', 'woo-cart-weight' ) ); ?></th>
	<td data-title="<?php echo esc_attr( __( 'Total Weight', 'woo-cart-weight' ) ); ?>"><?php echo esc_html( $cart_weight . ' ' . $weight_unit ); ?></td>
</tr>
