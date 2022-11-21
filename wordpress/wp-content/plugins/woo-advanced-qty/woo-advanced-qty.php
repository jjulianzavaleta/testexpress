<?php
	/**
	 * Plugin Name:          WooCommerce Advanced Quantity
	 * Plugin URI:           http://morningtrain.dk
	 * Description:          Make the most out of your WooCommerce product quantity selection. This plugin allows you to make more specific product quantity incrementation.
	 * Version:              3.0.3
	 * Author:               Morning Train Technologies ApS
	 * Author URI:           http://morningtrain.dk
	 * License:              GPL-2.0+
	 * License URI:          http://www.gnu.org/licenses/gpl-2.0.txt
	 * Text Domain:          woo-advanced-qty
	 * Domain Path:          /languages
	 * Requires at least:    3.6.0
	 * Tested up to:         5.5.3
	 * WC requires at least: 3.2.0
	 * WC tested up to:      4.7.1
	 */

	// If this file is called directly, abort.
	if(!defined('WPINC')) die;

	require_once(__DIR__ . '/lib/class.plugin-init.php');
	\Morningtrain\WooAdvancedQTY\PluginInit::registerPlugin(__FILE__);