<?php 
/*** Include files in includes folder ***/
require_once get_template_directory().'/framework/includes/class-tgm-plugin-activation.php';

/*** Include files in framework folder ***/
require_once get_template_directory().'/framework/theme_functions.php';
require_once get_template_directory().'/framework/woo_term.php';
require_once get_template_directory().'/framework/woo_filter_by_color.php';
require_once get_template_directory().'/framework/woo_functions.php';
require_once get_template_directory().'/framework/woo_hooks.php';
require_once get_template_directory().'/framework/quickshop.php';
require_once get_template_directory().'/framework/theme_control.php';
require_once get_template_directory().'/framework/theme_filter.php';
require_once get_template_directory().'/framework/mega_menu.php';
require_once get_template_directory().'/framework/register_sidebar.php';
require_once get_template_directory().'/framework/grid_list_toggle.php';

/*** Require Metaboxes ***/
require_once get_template_directory().'/framework/metaboxes/metaboxes.php';

/*** Include widget files ***/
include_once get_template_directory().'/framework/widgets/feedburner_subscription.php';
include_once get_template_directory().'/framework/widgets/product_filter_by_color.php';
include_once get_template_directory().'/framework/widgets/product_filter_by_availability.php';
include_once get_template_directory().'/framework/widgets/social_icons.php';
include_once get_template_directory().'/framework/widgets/products.php';
include_once get_template_directory().'/framework/widgets/blogs.php';
include_once get_template_directory().'/framework/widgets/recent_comments.php';
include_once get_template_directory().'/framework/widgets/facebook_page.php';
include_once get_template_directory().'/framework/widgets/flickr.php';
include_once get_template_directory().'/framework/widgets/instagram.php';
include_once get_template_directory().'/framework/widgets/product_categories.php';
include_once get_template_directory().'/framework/widgets/menus.php';

/*** Visual Composer plugin ***/
if( class_exists('Vc_Manager') && class_exists('WPBakeryVisualComposerAbstract') ){
	require_once get_template_directory().'/framework/vc_extension/vc_map.php';
	require_once get_template_directory().'/framework/vc_extension/update_param.php';
	
	vc_set_shortcodes_templates_dir(get_template_directory() . '/framework/vc_extension/templates');
	
	/* Disable VC Frontend Editor */
	vc_disable_frontend();
}
?>