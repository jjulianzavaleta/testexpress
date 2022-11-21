<?php 
/*** Template Redirect ***/
add_action('template_redirect', 'sanzo_template_redirect');
function sanzo_template_redirect(){
	global $wp_query, $post, $sanzo_theme_options;
	
	/* Get Page Options */
	if( is_page() || is_tax( get_object_taxonomies( 'product' ) ) || is_post_type_archive('product') ){
		if( is_page() ){
			$page_id = $post->ID;
		}
		if( is_tax( get_object_taxonomies( 'product' ) ) || is_post_type_archive('product') ){
			$page_id = get_option('woocommerce_shop_page_id', 0);
		}
		
		$page_options = sanzo_get_page_options( $page_id );
		
		if( $page_options['ts_layout_style'] != 'default' ){
			$sanzo_theme_options['ts_layout_style'] = $page_options['ts_layout_style'];
			if( $page_options['ts_layout_style'] == 'advance' ){
				$sanzo_theme_options['ts_header_layout_style'] 		= $page_options['ts_header_layout_style'];
				$sanzo_theme_options['ts_main_content_layout_style'] 	= $page_options['ts_main_content_layout_style'];
				$sanzo_theme_options['ts_footer_layout_style'] 		= $page_options['ts_footer_layout_style'];
			}
		}
		
		if( $page_options['ts_header_layout'] != 'default' ){
			$sanzo_theme_options['ts_header_layout'] = $page_options['ts_header_layout'];
		}
		
		if( $page_options['ts_breadcrumb_layout'] != 'default' ){
			$sanzo_theme_options['ts_breadcrumb_layout'] = $page_options['ts_breadcrumb_layout'];
		}
		
		if( $page_options['ts_breadcrumb_bg_parallax'] != 'default' ){
			$sanzo_theme_options['ts_breadcrumb_bg_parallax'] = $page_options['ts_breadcrumb_bg_parallax'];
		}
		
		if( trim($page_options['ts_bg_breadcrumbs']) != '' ){
			$sanzo_theme_options['ts_bg_breadcrumbs'] = $page_options['ts_bg_breadcrumbs'];
		}
		
		if( trim($page_options['ts_logo']) != '' ){
			$sanzo_theme_options['ts_logo'] = $page_options['ts_logo'];
		}
		
		if( trim($page_options['ts_logo_mobile']) != '' ){
			$sanzo_theme_options['ts_logo_mobile'] = $page_options['ts_logo_mobile'];
		}
		
		if( trim($page_options['ts_logo_sticky']) != '' ){
			$sanzo_theme_options['ts_logo_sticky'] = $page_options['ts_logo_sticky'];
		}
		
		if( $page_options['ts_menu_id'] ){
			add_filter('wp_nav_menu_args', 'sanzo_filter_wp_nav_menu_args');
		}
	}
	
	/* Archive - Category product */
	if( is_tax( get_object_taxonomies( 'product' ) ) || is_post_type_archive('product') || (function_exists('dokan_is_store_page') && dokan_is_store_page()) ){
		sanzo_set_header_breadcrumb_layout_woocommerce_page( 'shop' );
	
		add_action( 'wp_enqueue_scripts', 'sanzo_grid_list_desc_style', 1000 );
		
		sanzo_remove_hooks_from_shop_loop();
		
		if( function_exists('dokan_is_store_page') && dokan_is_store_page() && !$sanzo_theme_options['ts_prod_cat_grid_desc'] ){
			remove_action('woocommerce_after_shop_loop_item', 'sanzo_template_loop_short_description', 60);
		}
		
		/* Update product category layout */
		if( is_tax('product_cat') ){
			$term = $wp_query->queried_object;
			if( !empty($term->term_id) ){
				$bg_breadcrumbs_id = get_term_meta($term->term_id, 'bg_breadcrumbs_id', true);
				$layout = get_term_meta($term->term_id, 'layout', true);
				$left_sidebar = get_term_meta($term->term_id, 'left_sidebar', true);
				$right_sidebar = get_term_meta($term->term_id, 'right_sidebar', true);
				
				if( $bg_breadcrumbs_id != '' ){
					$bg_breadcrumbs_src = wp_get_attachment_url( $bg_breadcrumbs_id );
					if( $bg_breadcrumbs_src !== false ){
						$sanzo_theme_options['ts_bg_breadcrumbs'] = $bg_breadcrumbs_src;
					}
				}
				if( $layout != '' ){
					$sanzo_theme_options['ts_prod_cat_layout'] = $layout;
				}
				if( $left_sidebar != '' ){
					$sanzo_theme_options['ts_prod_cat_left_sidebar'] = $left_sidebar;
				}
				if( $right_sidebar != '' ){
					$sanzo_theme_options['ts_prod_cat_right_sidebar'] = $right_sidebar;
				}
			}
		}
	}
	
	/* single post */
	if( is_singular('post') ){
		$post_data = array();
		$post_custom = get_post_custom();
		foreach( $post_custom as $key => $value ){
			if( isset($value[0]) ){
				$post_data[$key] = $value[0];
			}
		}
		
		$sanzo_theme_options['ts_blog_details_layout'] = (isset($post_data['ts_post_layout']) && $post_data['ts_post_layout']!='0')?$post_data['ts_post_layout']:$sanzo_theme_options['ts_blog_details_layout'];
		$sanzo_theme_options['ts_blog_details_left_sidebar'] = (isset($post_data['ts_post_left_sidebar']) && $post_data['ts_post_left_sidebar']!='0')?$post_data['ts_post_left_sidebar']:$sanzo_theme_options['ts_blog_details_left_sidebar'];
		$sanzo_theme_options['ts_blog_details_right_sidebar'] = (isset($post_data['ts_post_right_sidebar']) && $post_data['ts_post_right_sidebar']!='0')?$post_data['ts_post_right_sidebar']:$sanzo_theme_options['ts_blog_details_right_sidebar'];
		
		/* Breadcrumb */
		$bg_breadcrumbs = get_post_meta($post->ID, 'ts_bg_breadcrumbs', true);
		if( !empty($bg_breadcrumbs) ){
			$sanzo_theme_options['ts_bg_breadcrumbs'] = $bg_breadcrumbs;
		}
	}
	
	/* Single product */
	if( is_singular('product') ){
		
		/* Add vertical thumbnail class */
		if( $sanzo_theme_options['ts_prod_thumbnails_style'] == 'vertical' ){
			add_filter('post_class', function( $classes ){
				$classes[] = 'vertical-thumbnail';
				return $classes;
			});
		}
		
		/* Remove hooks on Related and Up-Sell products */
		sanzo_remove_hooks_from_shop_loop();
		if( ! $sanzo_theme_options['ts_prod_cat_grid_desc'] ){
			remove_action('woocommerce_after_shop_loop_item', 'sanzo_template_loop_short_description', 60);
		}
	
		$prod_data = array();
		$post_custom = get_post_custom();
		foreach( $post_custom as $key => $value ){
			if( isset($value[0]) ){
				$prod_data[$key] = $value[0];
			}
		}
		
		$sanzo_theme_options['ts_prod_layout'] = (isset($prod_data['ts_prod_layout']) && $prod_data['ts_prod_layout']!='0')?$prod_data['ts_prod_layout']:$sanzo_theme_options['ts_prod_layout'];
		$sanzo_theme_options['ts_prod_left_sidebar'] = (isset($prod_data['ts_prod_left_sidebar']) && $prod_data['ts_prod_left_sidebar']!='0')?$prod_data['ts_prod_left_sidebar']:$sanzo_theme_options['ts_prod_left_sidebar'];
		$sanzo_theme_options['ts_prod_right_sidebar'] = (isset($prod_data['ts_prod_right_sidebar']) && $prod_data['ts_prod_right_sidebar']!='0')?$prod_data['ts_prod_right_sidebar']:$sanzo_theme_options['ts_prod_right_sidebar'];
		
		if( !$sanzo_theme_options['ts_prod_thumbnail'] ){
			remove_action('woocommerce_before_single_product_summary', 'woocommerce_show_product_images', 20);
		}
		
		if( !$sanzo_theme_options['ts_prod_title'] ){
			remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_title', 1);
		}
		
		if( !$sanzo_theme_options['ts_prod_label'] ){
			remove_action('sanzo_before_product_image', 'sanzo_template_loop_product_label', 10);
		}
		
		if( !$sanzo_theme_options['ts_prod_rating'] ){
			remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_rating', 3);
		}
		
		if( !$sanzo_theme_options['ts_prod_sku'] ){
			remove_action('woocommerce_single_product_summary', 'sanzo_template_single_sku', 4);
		}
		
		if( !$sanzo_theme_options['ts_prod_availability'] ){
			remove_action('woocommerce_single_product_summary', 'sanzo_template_single_availability', 2);
		}
		
		if( !$sanzo_theme_options['ts_prod_excerpt'] ){
			remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_excerpt', 20);
		}
		
		if( !$sanzo_theme_options['ts_prod_count_down'] ){
			remove_action('woocommerce_single_product_summary', 'ts_template_loop_time_deals', 20);
		}
		
		if( !$sanzo_theme_options['ts_prod_price'] ){
			remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_price', 5);
			remove_action('woocommerce_single_variation', 'woocommerce_single_variation', 10);
		}
		
		if( !$sanzo_theme_options['ts_prod_add_to_cart'] || $sanzo_theme_options['ts_enable_catalog_mode'] ){
			$terms        = get_the_terms( $post->ID, 'product_type' );
			$product_type = ! empty( $terms ) ? sanitize_title( current( $terms )->name ) : 'simple';
			if( $product_type != 'variable' ){
				remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_add_to_cart', 30);
			}
			else{
				remove_action( 'woocommerce_single_variation', 'woocommerce_single_variation_add_to_cart_button', 20 );
			}
		}
		
		if( !$sanzo_theme_options['ts_prod_sharing'] ){
			remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_sharing', 70);
		}
		
		if( !$sanzo_theme_options['ts_prod_upsells'] ){
			remove_action('woocommerce_after_single_product_summary', 'woocommerce_upsell_display', 15);
		}
		
		if( !$sanzo_theme_options['ts_prod_related'] ){
			remove_action('woocommerce_after_single_product_summary', 'woocommerce_output_related_products', 20);
		}
		
		if( isset($sanzo_theme_options['ts_prod_tabs_position']) && $sanzo_theme_options['ts_prod_tabs_position'] == 'inside_summary' ){
			remove_action('woocommerce_after_single_product_summary', 'woocommerce_output_product_data_tabs', 10);
			add_action('woocommerce_single_product_summary', 'woocommerce_output_product_data_tabs', 50);
			remove_action('woocommerce_single_product_summary', 'sanzo_template_single_meta', 60);
			add_action('sanzo_after_product_image_thumbnails', 'sanzo_template_single_meta', 10);
			if( $sanzo_theme_options['ts_prod_sharing'] ){
				remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_sharing', 70);
				add_action('sanzo_after_product_image_thumbnails', 'woocommerce_template_single_sharing', 20);
			}
		}
		
		/* Breadcrumb */
		$bg_breadcrumbs = get_post_meta($post->ID, 'ts_bg_breadcrumbs', true);
		if( !empty($bg_breadcrumbs) ){
			$sanzo_theme_options['ts_bg_breadcrumbs'] = $bg_breadcrumbs;
		}
		
		/* Disable srcset attribute */
		sanzo_disable_srcset_on_cloudzoom();
		
	}
	
	/* Single Portfolio */
	if( is_singular('ts_portfolio') ){
		$portfolio_data = array();
		$post_custom = get_post_custom();
		foreach( $post_custom as $key => $value ){
			if( isset($value[0]) ){
				$portfolio_data[$key] = $value[0];
			}
		}
		
		if( isset($portfolio_data['ts_portfolio_custom_field']) && $portfolio_data['ts_portfolio_custom_field'] == 1 ){
			$sanzo_theme_options['ts_portfolio_custom_field_title'] = isset($portfolio_data['ts_portfolio_custom_field_title'])?$portfolio_data['ts_portfolio_custom_field_title']:$sanzo_theme_options['ts_portfolio_custom_field_title'];
			$sanzo_theme_options['ts_portfolio_custom_field_content'] = isset($portfolio_data['ts_portfolio_custom_field_content'])?$portfolio_data['ts_portfolio_custom_field_content']:$sanzo_theme_options['ts_portfolio_custom_field_content'];
		}
	}
	
	/* WooCommerce - Other pages */
	if( class_exists('WooCommerce') ){
		if( is_cart() ){
			sanzo_set_header_breadcrumb_layout_woocommerce_page( 'cart' );
			
			sanzo_remove_hooks_from_shop_loop();
			
			if( ! $sanzo_theme_options['ts_prod_cat_grid_desc'] ){
				remove_action('woocommerce_after_shop_loop_item', 'sanzo_template_loop_short_description', 60);
			}
		}
		
		if( is_checkout() ){
			sanzo_set_header_breadcrumb_layout_woocommerce_page( 'checkout' );
		}
		
		if( is_account_page() ){
			sanzo_set_header_breadcrumb_layout_woocommerce_page( 'myaccount' );
		}
	}

	/* Right to left */
	if( is_rtl() ){
		$sanzo_theme_options['ts_enable_rtl'] = 1;
	}
	
	/* Remove bbpress style if not in any bbpress page */
	if( function_exists('is_bbpress') && !is_bbpress() ){
		add_filter('bbp_default_styles', function(){ return array(); });
		add_filter('bbp_default_scripts', function(){ return array(); });
	}
	
	/* Remove background image if not necessary */
	$load_bg = true;
	if( is_page_template('page-templates/fullwidth-template.php') ){
		$load_bg = false;
	}
	if( is_page() && isset($page_options['ts_layout_style']) && $load_bg ){
		if( $page_options['ts_layout_style'] == 'wide' || ( $page_options['ts_layout_style'] == 'default' && $sanzo_theme_options['ts_layout_style'] == 'wide' ) ){
			$load_bg = false;
		}
	}
	
	if( !$load_bg ){
		add_filter('theme_mod_background_image', '__return_empty_string');
	}
}

function sanzo_filter_wp_nav_menu_args( $args ){
	global $post;
	if( is_page() && !is_admin() && !empty($args['theme_location']) && $args['theme_location'] == 'primary' ){
		$menu = get_post_meta($post->ID, 'ts_menu_id', true);
		if( $menu ){
			$args['menu'] = $menu;
		}
	}
	return $args;
}

add_filter('single_template', 'sanzo_change_single_portfolio_template');
function sanzo_change_single_portfolio_template( $single_template ){
	
	if( is_singular('ts_portfolio') && locate_template('single-portfolio.php') ){
		$single_template = locate_template('single-portfolio.php');
	}
	
	return $single_template;
}

function sanzo_remove_hooks_from_shop_loop(){
	global $sanzo_theme_options;
	
	if( ! $sanzo_theme_options['ts_prod_cat_thumbnail'] ){
		remove_action('woocommerce_before_shop_loop_item_title', 'sanzo_template_loop_product_thumbnail', 10);
	}
	if( ! $sanzo_theme_options['ts_prod_cat_label'] ){
		remove_action('woocommerce_after_shop_loop_item_title', 'sanzo_template_loop_product_label', 1);
	}
	if( ! $sanzo_theme_options['ts_prod_cat_cat'] ){
		remove_action('woocommerce_after_shop_loop_item', 'sanzo_template_loop_categories', 10);
	}
	if( ! $sanzo_theme_options['ts_prod_cat_title'] ){
		remove_action('woocommerce_after_shop_loop_item', 'sanzo_template_loop_product_title', 20);
	}
	if( ! $sanzo_theme_options['ts_prod_cat_sku'] ){
		remove_action('woocommerce_after_shop_loop_item', 'sanzo_template_loop_product_sku', 30);
	}
	if( ! $sanzo_theme_options['ts_prod_cat_rating'] ){
		remove_action('woocommerce_after_shop_loop_item', 'woocommerce_template_loop_rating', 40);
	}
	if( ! $sanzo_theme_options['ts_prod_cat_price'] ){
		remove_action('woocommerce_after_shop_loop_item', 'woocommerce_template_loop_price', 50);
	}
	if( ! $sanzo_theme_options['ts_prod_cat_add_to_cart'] ){
		remove_action('woocommerce_after_shop_loop_item', 'sanzo_template_loop_add_to_cart', 70); 
		remove_action('woocommerce_after_shop_loop_item_title', 'sanzo_template_loop_add_to_cart', 10005 );
	}
	
	if( !empty($sanzo_theme_options['ts_prod_cat_meta_align']) ){
		$align = $sanzo_theme_options['ts_prod_cat_meta_align'];
		add_filter('body_class', function( $classes ) use ( $align ){
			$classes[] = 'product-meta-'.$align;
			return $classes;
		});
		if( function_exists('sanzo_add_wishlist_button_to_product_list') ){
			if( ( !is_post_type_archive( 'product' ) && !is_tax( get_object_taxonomies( 'product' ) ) ) || !class_exists('Sanzo_Grid_List') ){
				remove_action( 'woocommerce_after_shop_loop_item', 'sanzo_add_wishlist_button_to_product_list', 71 );
			}
			add_action( 'woocommerce_after_shop_loop_item', 'sanzo_add_wishlist_button_to_product_list', 69 );
		}
	}
}

function sanzo_grid_list_desc_style(){
	$custom_css = ".products.list .short-description.list{display: inline-block !important;}";
	$custom_css .= ".products.grid .short-description.grid{display: inline-block !important;}";
    wp_add_inline_style('sanzo-reset', $custom_css);
}

function sanzo_set_header_breadcrumb_layout_woocommerce_page( $page = 'shop' ){
	global $sanzo_theme_options;
	/* Header Layout */
	$header_layout = get_post_meta(wc_get_page_id( $page ), 'ts_header_layout', true);
	if( $header_layout != 'default' && $header_layout != '' ){
		$sanzo_theme_options['ts_header_layout'] = $header_layout;
	}
	
	/* Breadcrumb Layout */
	$breadcrumb_layout = get_post_meta(wc_get_page_id( $page ), 'ts_breadcrumb_layout', true);
	if( $breadcrumb_layout != 'default' && $breadcrumb_layout != '' ){
		$sanzo_theme_options['ts_breadcrumb_layout'] = $breadcrumb_layout;
	}
}

function sanzo_disable_srcset_on_cloudzoom(){
	add_filter('wp_get_attachment_image_attributes', 'sanzo_unset_srcset_on_cloudzoom', 9999);
	add_filter('wp_calculate_image_sizes', '__return_false', 9999);
	add_filter('wp_calculate_image_srcset', '__return_false', 9999);
	remove_filter('the_content', 'wp_make_content_images_responsive');
}

function sanzo_unset_srcset_on_cloudzoom( $attr ){
	if( isset($attr['sizes']) ){
		unset($attr['sizes']);
	}
	if( isset($attr['srcset']) ){
		unset($attr['srcset']);
	}
	return $attr;
}
?>