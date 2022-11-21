<?php
$theme            = wp_get_theme( 'poco' );
$poco_version = $theme['Version'];

/**
 * Set the content width based on the theme's design and stylesheet.
 */
if ( ! isset( $content_width ) ) {
	$content_width = 980; /* pixels */
}
require get_theme_file_path('inc/class-tgm-plugin-activation.php');
$poco = (object) array(
	'version' => $poco_version,
	/**
	 * Initialize all the things.
	 */
	'main'    => require 'inc/class-main.php',
);

require get_theme_file_path('inc/functions.php');
require get_theme_file_path('inc/template-hooks.php');
require get_theme_file_path('inc/template-functions.php');

require_once get_theme_file_path('inc/merlin/vendor/autoload.php');
require_once get_theme_file_path('inc/merlin/class-merlin.php');
require_once get_theme_file_path('inc/merlin-config.php');

$poco->options = require get_theme_file_path('inc/options/class-options.php');

if ( poco_is_woocommerce_activated() ) {
	$poco->woocommerce = require get_theme_file_path('inc/woocommerce/class-woocommerce.php');

	require get_theme_file_path('inc/woocommerce/class-woocommerce-adjacent-products.php');

	require get_theme_file_path('inc/woocommerce/woocommerce-functions.php');
	require get_theme_file_path('inc/woocommerce/woocommerce-template-functions.php');
	require get_theme_file_path('inc/woocommerce/woocommerce-template-hooks.php');
	require get_theme_file_path('inc/woocommerce/template-hooks.php');
	require get_theme_file_path('inc/woocommerce/class-woocommerce-size-chart.php');
	require get_theme_file_path('inc/woocommerce/class-woocommerce-clever.php');
}

if ( poco_is_elementor_activated() ) {
	require get_theme_file_path('inc/elementor/functions-elementor.php');
	$poco->elementor = require get_theme_file_path('inc/elementor/class-elementor.php');
	$poco->megamenu  = require get_theme_file_path('inc/megamenu/megamenu.php');

	if(defined('ELEMENTOR_PRO_VERSION')){
		require get_theme_file_path('inc/elementor/class-elementor-pro.php');
	}
}
