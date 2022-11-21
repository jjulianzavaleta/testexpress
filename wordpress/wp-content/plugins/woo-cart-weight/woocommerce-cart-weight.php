<?php
/**
 * Plugin Name: WooCommerce Cart Weight
 * Plugin URI: https://wordpress.org/plugins/woo-cart-weight/
 * Description: Displays total order weight in cart.
 * Version: 1.3.5
 * Author: WP Desk
 * Author URI: https://www.wpdesk.net/
 * Text Domain: woo-cart-weight
 * Domain Path: /lang/
 * Requires at least: 5.2
 * Tested up to: 5.7
 * WC requires at least: 4.8
 * WC tested up to: 5.3
 * Requires PHP: 7.0
 *
 * Copyright 2019 WP Desk Ltd.
 *
 * This program is free software; you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation; either version 3 of the License, or
 * (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program; if not, write to the Free Software
 * Foundation, Inc., 59 Temple Place, Suite 330, Boston, MA  02111-1307  USA
 *
 * @package WPDesk\WooCommerceCartWeight
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
} // Exit if accessed directly


/* THIS VARIABLE CAN BE CHANGED AUTOMATICALLY */
$plugin_version = '1.3.5';

$plugin_name        = 'WooCommerce Cart Weight';
$plugin_class_name  = '\WPDesk\WooCommerceCartWeight\Plugin';
$plugin_text_domain = 'woo-cart-weight';
$product_id         = 'WooCommerce Cart Weight';
$plugin_file        = __FILE__;
$plugin_dir         = dirname( __FILE__ );

$requirements = array(
	'php'     => '5.6',
	'wp'      => '4.5',
	'plugins' => array(
		array(
			'name'      => 'woocommerce/woocommerce.php',
			'nice_name' => 'WooCommerce',
		),
	),
);

require __DIR__ . '/vendor_prefixed/wpdesk/wp-plugin-flow/src/plugin-init-php52-free.php';
