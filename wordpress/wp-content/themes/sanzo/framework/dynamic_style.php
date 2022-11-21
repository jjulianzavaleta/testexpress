<?php 
global $sanzo_theme_options;
if( !isset($data) ){
	$data = $sanzo_theme_options;
}

$data = sanzo_array_atts(
			array(
				/* FONTS */
				'ts_body_font_enable_google_font'					=> 1
				,'ts_body_font_family'								=> "Arial"
				,'ts_body_font_google'								=> "Open sans"
				
				,'ts_secondary_body_font_enable_google_font'		=> 1
				,'ts_secondary_body_font_family'					=> "Arial"
				,'ts_secondary_body_font_google'					=> "Montserrat"
				
				,'ts_thirdary_body_font_enable_google_font'			=> 1
				,'ts_thirdary_body_font_family'						=> "Arial"
				,'ts_thirdary_body_font_google'						=> "Roboto"
				
				,'ts_menu_font_enable_google_font'					=> 1
				,'ts_menu_font_family'								=> "Arial"
				,'ts_menu_font_google'								=> "Montserrat"
				
				,'ts_sub_menu_font_enable_google_font'				=> 1
				,'ts_sub_menu_font_family'							=> "Arial"
				,'ts_sub_menu_font_google'							=> "Roboto"
				
				,'ts_custom_font_ttf'								=> ""
				
				/* COLORS */
				,'ts_primary_color'									=> "#f5a72c"
				,'ts_text_color_in_bg_primary'						=> "#ffffff"

				,'ts_secondary_color'								=> "#1f1f1f"
				,'ts_text_color_in_bg_second'						=> "#ffffff"

				,'ts_heading_color'									=> "#535353"

				,'ts_main_content_background_color'					=> "#ffffff"
				,'ts_widget_content_background_color'				=> "#ffffff"
				,'ts_text_color'									=> "#666666"

				,'ts_link_color'									=> "#f5a72c"
				,'ts_link_color_hover'								=> "#f5a72c"

				,'ts_border_color'									=> "#d9d9d9"

				,'ts_button_text_color'								=> "#1f1f1f"
				,'ts_button_text_color_hover'						=> "#ffffff"
				,'ts_button_border_color'							=> "#d9d9d9"
				,'ts_button_border_color_hover'						=> "#1f1f1f"
				,'ts_button_background_color'						=> "#ffffff"
				,'ts_button_background_color_hover'					=> "#1f1f1f"

				/* HEADER */
				,'ts_top_header_background_color'					=> "#f5f5f5"
				,'ts_top_header_text_color'							=> "#666666"
				,'ts_middle_header_background_color'				=> "#ffffff"
				,'ts_middle_header_text_color'						=> "#f5f5f5"
				,'ts_bottom_header_background_color'				=> "#1f1f1f"
				
				,'ts_bottom_header_padding'							=> 1
				,'ts_popup_heading_color'							=> "#1f1f1f"
				,'ts_bg_search_image'								=> ""
				
				,'ts_header_categories_product_name_color'			=> "#d9d9d9"
				,'ts_header_categories_product_name_hover_color'	=> "#ffffff"
				,'ts_header_categories_product_border_color'		=> "#d9d9d9"
				,'ts_search_background_color'						=> "#656565"
				,'ts_search_border_color'							=> "#656565"
				,'ts_search_categories_text_color'					=> "#e5e5e5"
				,'ts_search_categories_hightlighted_color'			=> "#ffffff"
				,'ts_search_input_text_background_color'			=> "#656565"
				,'ts_search_input_text_color'						=> "#e5e5e5"

				/* MENU */
				,'ts_vertical_menu_icon_color'						=> "#ffffff"
				,'ts_vertical_menu_title_text'						=> "#ffffff"
				,'ts_vertical_menu_title_background_color'			=> "#f5a72c"
				,'ts_vertical_menu_title_text_hover'				=> "#ffffff"
				,'ts_vertical_menu_title_background_color_hover'	=> "#f5a72c"
				
				,'ts_menu_top_line_color'							=> "#d9d9d9"
				,'ts_menu_text_color'								=> "#1f1f1f"
				,'ts_menu_text_color_hover'							=> "#f5a72c"

				,'ts_sub_menu_background_color'						=> "#ffffff"
				,'ts_sub_menu_text_color'							=> "#666666"
				,'ts_sub_menu_text_color_hover'						=> "#f5a72c"
				,'ts_sub_menu_heading_color'						=> "#1f1f1f"
				,'ts_sub_menu_item_line_color'						=> "#e9e9e9"
				
				/* BREADCRUMB */
				,'ts_breadcrumb_text_color'							=> "#666666"
				,'ts_breadcrumb_heading_color'						=> "#1f1f1f"
				,'ts_breadcrumb_background_color'					=> "#ffffff"
				
				/* FOOTER */
				,'ts_footer_subscription_background_color'			=> "#595959"
				,'ts_footer_subscription_text_color'				=> "#ffffff"
				,'ts_footer_social_icon_border_color'				=> "#666666"
				,'ts_footer_social_icon_color'						=> "#e5e5e5"
				,'ts_footer_background_color'						=> "#252525"
				,'ts_footer_text_color'								=> "#d9d9d9"
				,'ts_footer_heading_color'							=> "#ffffff"
				,'ts_footer_end_background_color'					=> "#000000"
				,'ts_footer_end_text_color'							=> "#f5f5f5"
				,'ts_footer_end_text_hover_color'					=> "#f5a72c"

				/* PRODUCT */
				,'ts_product_hotdeal_background_color'				=> "#f5f5f5"
				,'ts_product_hotdeal_text_color'					=> "#1f1f1f"
				,'ts_product_hotdeal_border_color'					=> "#d9d9d9"
				,'ts_product_hotdeal_ref_background_color'			=> "#77d23f"
				,'ts_product_hotdeal_ref_text_color'				=> "#ffffff"
				
				,'ts_rating_color'									=> "#f5a72c"
				
				,'ts_product_name_text_color'						=> "#666666"

				,'ts_product_button_text_color'						=> "#1f1f1f"
				,'ts_product_button_text_color_hover'				=> "#ffffff"
				,'ts_product_button_background_color'				=> "#ffffff"
				,'ts_product_button_background_color_hover'			=> "#f5a72c"
				,'ts_product_button_border_color'					=> "#d9d9d9"
				,'ts_product_button_border_color_hover'				=> "#f5a72c"

				,'ts_product_sale_label_text_color'					=> "#ffffff"
				,'ts_product_sale_label_background_color'			=> "#31aae8"
				,'ts_product_feature_label_text_color'				=> "#ffffff"
				,'ts_product_feature_label_background_color'		=> "#f5a72c"
				,'ts_product_new_label_text_color'					=> "#ffffff"
				,'ts_product_new_label_background_color'			=> "#77d23f"
				,'ts_product_outstock_label_text_color'				=> "#ffffff"
				,'ts_product_outstock_label_background_color'		=> "#d4d4d4"

				,'ts_product_price_color'							=> "#1f1f1f"
				,'ts_product_sale_price_color'						=> "#f5a72c"
				
				,'ts_effect_hover_product_style'					=> 'style-1'

				/* MESSAGE BOX */
				,'ts_message_text_color'							=> "#666666"
				,'ts_message_border_color'							=> "#77d23f"
				,'ts_info_message_text_color'						=> "#666666"
				,'ts_info_message_border_color'						=> "#21c2f8"
				,'ts_error_message_text_color'						=> "#666666"
				,'ts_error_message_border_color'					=> "#e94b4b"
				,'ts_warning_message_text_color'					=> "#666666"
				,'ts_warning_message_border_color'					=> "#f5d817"
				
				/* RESPONSIVE */
				,'ts_responsive'									=> 1
				,'ts_enable_rtl'									=> 0
				
				/* FONT SIZE */
				/* Body */
				,'ts_font_size_body'								=> 13
				,'ts_line_height_body'								=> 26
				
				/* Menu */
				,'ts_font_size_menu'								=> 14
				,'ts_line_height_menu'								=> 18
				
				/* Button */
				,'ts_font_size_button'								=> 12
				,'ts_line_height_button'							=> 14
				
				
				/* Heading */
				,'ts_font_size_heading_1'							=> 34
				,'ts_line_height_heading_1'							=> 42
				,'ts_font_size_heading_2'							=> 30
				,'ts_line_height_heading_2'							=> 38
				,'ts_font_size_heading_3'							=> 22
				,'ts_line_height_heading_3'							=> 28
				,'ts_font_size_heading_4'							=> 18
				,'ts_line_height_heading_4'							=> 24
				,'ts_font_size_heading_5'							=> 16
				,'ts_line_height_heading_5'							=> 24
				,'ts_font_size_heading_6'							=> 14
				,'ts_line_height_heading_6'							=> 22
				
				/* Custom CSS */
				,'ts_custom_css_code'								=> ''
		), $data);		
		
$data = sanzo_of_filter_load_media_upload( $data ); /* Filter [site_url] */
$data = apply_filters('sanzo_custom_style_data', $data);

extract( $data );

/* font-body */
if( $data['ts_body_font_enable_google_font'] ){
	$ts_body_font				= $data['ts_body_font_google'];
}
else{
	$ts_body_font				= $data['ts_body_font_family'];
}

if( $data['ts_secondary_body_font_enable_google_font'] ){
	$ts_secondary_body_font		= $data['ts_secondary_body_font_google'];
}
else{
	$ts_secondary_body_font		= $data['ts_secondary_body_font_family'];
}
if( $data['ts_thirdary_body_font_enable_google_font'] ){
	$ts_thirdary_body_font		= $data['ts_thirdary_body_font_google'];
}
else{
	$ts_thirdary_body_font		= $data['ts_thirdary_body_font_family'];
}
/* FONT MENU */
if( $data['ts_menu_font_enable_google_font'] ){
	$ts_menu_font				= $data['ts_menu_font_google'];
}
else{
	$ts_menu_font				= $data['ts_menu_font_family'];
}

if( $data['ts_sub_menu_font_enable_google_font'] ){
	$ts_sub_menu_font			= $data['ts_sub_menu_font_google'];
}
else{
	$ts_sub_menu_font			= $data['ts_sub_menu_font_family'];
}

?>	
	
	/*
	1. FONT FAMILY
	2. GENERAL COLORS
	3. HEADER COLORS
	4. MENU COLORS
	5. FOOTER COLORS
	6. PRODUCT COLORS
	7. WOOCOMMERCE MESSAGE COLORS
	8. FONT SIZE
	9. RESPONSIVE
	10. PRODUCT HOVER
	*/
	/* ============= 1. FONT FAMILY ============== */
	<?php 
	/* Custom Font */
	if( $ts_custom_font_ttf ):
	?>
	@font-face {
		font-family: 'CustomFont';
		src:url('<?php echo esc_url($ts_custom_font_ttf); ?>') format('truetype');
		font-weight: normal;
		font-style: normal;
	}
	<?php endif; ?>
	html, 
	body,
	label,
	input, 
	textarea, 
	keygen, 
	select, 
	button,
	.font-body,
	.mc4wp-form-fields label,
	.ts-banner .heading-body,
	.ts-button.fa,
	li.fa,
	h3.product-name > a, 
	h3.product-name,
	body .rev_slider_wrapper .rev-btn.ts-button,
	body rs-module-wrap .rev-btn.ts-button,
	body.wpb-js-composer .vc_tta.vc_general.vc_tta-tabs-position-left .vc_tta-tab a,
	body.wpb-js-composer .vc_tta.vc_general.vc_tta-tabs-position-right .vc_tta-tab a,
	.woocommerce div.product .woocommerce-tabs ul.tabs li a, 
	.ts-testimonial-wrapper.text-light .testimonial-content h4.name a,
	.ts-twitter-slider.text-light .twitter-content h4.name > a,
	.vc_toggle_default .vc_toggle_title h4,
	.vc_tta-accordion .vc_tta-panel .vc_tta-panel-title,
	.ts-milestone h3.subject, 
	.cart_totals table th,
	.woocommerce #order_review table.shop_table tfoot td, 
	.woocommerce table.shop_table.order_details tfoot th, 
	.woocommerce #order_review table.shop_table tfoot th, 
	body.wpb-js-composer .vc_tta-accordion .vc_tta-panel .vc_tta-panel-title > a,
	body.wpb-js-composer .vc_tta.vc_general .vc_tta-tab > a,
	body div.pp_default .pp_nav .currentTextHolder,
	body .theme-default .nivo-caption,
	.dokan-category-menu .sub-block h3,
	.menu-wrapper nav > ul.menu li .menu-desc,
	.widget-container .vertical-menu > ul.menu li .menu-desc{
		font-family:<?php echo esc_html($ts_body_font) ?>, sans-serif;
	}
	h1,h2,h3,h4,h5,h6,
	.h1,.h2,.h3,.h4,.h5,.h6,
	.ts-banner .heading-big,
	h1.wpb_heading,
	h2.wpb_heading,
	h3.wpb_heading,
	h4.wpb_heading,
	h5.wpb_heading,
	h6.wpb_heading,
	.author h3.heading-title > a,
	.type-topic .bbp-topic-title > a,
	#favorite-toggle a, 
	#subscription-toggle a,
	.column-tabs .tabs li,
	body div.pp_woocommerce .pp_description,
	#ts-search-result-container .view-all-wrapper a,
	.wp-caption p.wp-caption-text,
	.ts-price-table .table-info .price,
	.amount,
	.quantity,
	.ts-banner header .price,
	.shopping-cart-wrapper .cart-number,
	#order_review_heading,
	.ts-portfolio-wrapper .filter-bar li,
	.ts-search-by-category div.select-category > a,
	.ts-search-by-category select,
	.ts-banner-feature.show_image .banner-info,
	.woocommerce .products .product .product-label span, 
	.pp_woocommerce div.product .images .product-label span,
	.woocommerce div.product .images .product-label span,
	.vc_column_container .vc_btn, 
	.vc_column_container .wpb_button,
	.woocommerce > form > fieldset legend,
	.variations label,
	.shipping-calculator-button,
	.widget-container .post_list_widget > li a
	{
		font-family:<?php echo esc_html($ts_secondary_body_font) ?>, sans-serif;
	}
	.woocommerce .products .product.product-category h3,
	.ts-single-products-slider-wrapper .products .product .product-categories a,
	.ts-banner header h3,
	.counter-wrapper,
	.vc_progress_bar .vc_single_bar .vc_label,
	.ts-product .shop-more-button,
	ul.product_list_widget li .product-categories a,
	ul.product_list_widget li .product-categories,
	.woocommerce .products .product .product-categories a,
	.woocommerce .products .product .product-categories,
	.list-cats li,
	a.view-more,
	span.author a,
	.widget-container .post_list_widget > li .author a,
	.button,
	button,
	html input[type="button"], 
	html input[type="submit"],
	html body #yith-woocompare table.compare-list tr.add-to-cart td a,
	.header-product-categories .category-name h3,
	.total-title,
	.entry-format .sharing-title,
	body #yith-woocompare table.compare-list tr.stock span,
	.wishlist_table tr td.product-stock-status span,
	.woocommerce div.product p.availability.stock, 
	.pp_woocommerce div.product p.availability.stock,
	body #yith-woocompare table.compare-list .add-to-cart td a,
	#to-top a,
	.vc_progress_bar .vc_single_bar .vc_bar:before{
		font-family: <?php echo esc_html($ts_thirdary_body_font) ?>, sans-serif;
	}
	
	/* ============= 2. GENERAL COLORS ============== */
	
	/* Background Content Color */
	.ts-heading.style-3 > h1,
	.ts-heading.style-3 > h2,
	.ts-heading.style-3 > h3,
	.ts-heading.style-3 > h4,
	body > .dataTables_wrapper,
	body #main,
	body.boxed header.ts-header .header-v1 .header-bottom,
	body.header-boxed header.ts-header,
	body.dokan-store #main:before,
	body div.pp_pic_holder,
	#cboxLoadedContent,
	.woocommerce .woocommerce-ordering .orderby ul:before,
	.shopping-cart-wrapper .dropdown-container:before,
	.my-account-wrapper .dropdown-container:before,
	#lang_sel_click ul ul:before,
	.wpml-ls ul ul.wpml-ls-sub-menu:before,
	.header-currency ul:before,
	form.checkout div.create-account,
	#main > .page-container,
	#main > .fullwidth-template,
	section.feedburner-subscription input[type="text"],
	.thumbnails.loading:before,
	.ts-testimonial-wrapper.loading:before,
	.ts-twitter-slider.loading:before,
	.ts-logo-slider-wrapper.loading .content-wrapper:before,
	.related-posts.loading .content-wrapper:before,
	.ts-portfolio-wrapper.loading:before,
	.ts-blogs-wrapper.loading .content-wrapper:before,
	.ts-product-filter-wrapper .icon
	{
		background-color:<?php echo esc_html($ts_main_content_background_color) ?>;
	}

	/* Widget & Shortcode Background */
	footer .widget-container,
	footer .ts-shortcode,
	footer .vc_tta-container,
	footer .vc_tta-panels{
		background:transparent;
	}
	.ts-product-in-category-tab-wrapper .column-products .owl-nav > div,
	.ts-countdown .counter-wrapper > div,
	.owl-nav,
	.ts-product.nav-bottom .owl-nav:before,
	.woocommerce .widget_price_filter .ui-slider .ui-slider-handle,
	.images-thumbnails >.thumbnails .owl-nav > div,
	body.wpb-js-composer .vc_tta.vc_general .vc_tta-tab,
	.ts-product .shop-more-button,
	.widget-container,
	.vc_tta-container .vc_general,
	table.shop_table,
	.single-navigation > div .product-info:before,
	#yith-wcwl-popup-message,
	html input[type="search"],
	html input[type="text"], 
	html input[type="password"],
	html input[type="email"], 
	html input[type="number"], 
	html input[type="tel"], 
	html select, 
	html textarea,
	#bbpress-forums #bbp-your-profile fieldset input, 
	#bbpress-forums #bbp-your-profile fieldset textarea,
	.bbp-login-form .bbp-username input, 
	.bbp-login-form .bbp-email input, 
	.bbp-login-form .bbp-password input,
	.chosen-container a.chosen-single,
	.woocommerce-checkout .form-row .chosen-container-single .chosen-single,
	.woocommerce form .form-row input.input-text, 
	.woocommerce form .form-row textarea, 
	.woocommerce table.cart td.actions .coupon .input-text, 
	.select2-container .select2-choice,
	.widget-container .gallery.loading figure:before,
	.list-posts article .gallery.loading:before,
	.thumbnail.loading:before,
	.images.loading:before,
	.ts-product-category-slider-wrapper .content-wrapper.loading:before,
	.ts-product-in-category-tab-wrapper .column-logos.loading:before,
	.ts-product-in-category-tab-wrapper .column-products.loading:before,
	.ts-product .content-wrapper.loading:before,
	.tab-contents.loading:before,
	.ts-products-widget .ts-products-widget-wrapper.loading:before,
	.ts-product-deals-widget .ts-product-deals-slider-wrapper.loading:before,
	.ts-blogs-widget .ts-blogs-widget-wrapper.loading:before,
	.ts-recent-comments-widget .ts-recent-comments-widget-wrapper.loading:before,
	.blogs article a.gallery.loading:before,
	.single .gallery.loading:before,
	.ts-portfolio-wrapper.loading:before,
	.woocommerce div.product .woocommerce-tabs ul.tabs li,
	body.wpb-js-composer .vc_tta.vc_general .vc_tta-panels-container .vc_tta-panels,
	body.wpb-js-composer .vc_tta.vc_general.vc_tta-tabs-position-left .vc_tta-tab.vc_active a,
	body.wpb-js-composer .vc_tta.vc_general.vc_tta-tabs-position-left .vc_tta-tab a:hover,
	body.wpb-js-composer .vc_tta.vc_general.vc_tta-tabs-position-right .vc_tta-tab.vc_active a,
	body.wpb-js-composer .vc_tta.vc_general.vc_tta-tabs-position-right .vc_tta-tab a:hover,
	.woocommerce div.product .woocommerce-tabs ul.tabs li.active a, 
	.woocommerce div.product .woocommerce-tabs ul.tabs li:hover a, 
	.woocommerce #payment div.payment_box, 
	.ts-feature-wrapper .feature-icon,
	.ts-blogs article .content-meta,
	.list-posts article,
	.ts-team-member .content-info,
	.vc_toggle,
	.woocommerce div.product .woocommerce-tabs .panel,
	.ts-product-in-category-tab-wrapper,
	body .flexslider .slides,
	body .wpb_gallery_slides.wpb_slider_nivo,
	.ts-product-filter-wrapper .widgets,
	/* Compare table */
	#cboxLoadingOverlay,
	/* Forum */
	#bbpress-forums ul.bbp-lead-topic, 
	#bbpress-forums ul.bbp-topics, 
	#bbpress-forums ul.bbp-forums, 
	#bbpress-forums ul.bbp-replies, 
	#bbpress-forums ul.bbp-search-results
	{
		background-color:<?php echo esc_html($ts_widget_content_background_color) ?>;
	}

	.tab-content.loading:before,
	.yith-wcwl-add-to-wishlist .loading:after{
		background-color:<?php echo esc_html($ts_widget_content_background_color) ?>;
	}

	.woocommerce-checkout #payment div.payment_box:before{
		border-bottom-color:<?php echo esc_html($ts_widget_content_background_color) ?>;
	}

	/* BODY COLOR */

	body,
	p > label,
	table label,
	fieldset div > label,
	.gridlist-toggle a,
	.widget-container .tagcloud a,
	.product-categories a,
	body .single-post .single-navigation > a,
	body .star-rating.no-rating:before,
	.ts-social-icons .background-big li .ts-tooltip,
	.pp_woocommerce div.product .summary div[itemprop="description"], 
	.woocommerce div.product.summary div[itemprop="description"], 
	.entry-bottom .ts-social-sharing li a,
	.ts-product-category-slider-wrapper .category-name h3 > a,
	.header-v2 .shopping-cart-wrapper .cart-number,
	.ts-list-of-product-categories-wrapper .list-categories li a,
	.woocommerce .widget_layered_nav .woocommerce-widget-layered-nav-list li a,
	.woocommerce .widget-container .price_slider_amount .price_label,
	.ts-price-table .table-description ul li,
	.ts-social-sharing .sharing-title,
	.cats-link,
	.tags-link,
	.cats-link a,
	.tags-link a,
	.widget-container ul li > a,
	.dokan-widget-area .widget ul li > a,
	.dokan-orders-content .dokan-orders-area ul.order-statuses-filter li a,
	.dokan-dashboard .dokan-dashboard-content ul.dokan_tabs li.active > a,
	.dokan-dashboard .dokan-dashboard-content ul.dokan_tabs li > a:hover,
	.dokan-dashboard .dokan-dashboard-content a,
	.dokan-dashboard .dokan-dashboard-content a.dokan-btn-default:hover,
	.product-categories span.count,
	blockquote,
	#lang_sel_click ul ul a,
	.header-currency ul li a:not(.button),
	.woocommerce .quantity span,
	.wishlist_table tr td.product-stock-status span.wishlist-in-stock,
	.woocommerce .ts-single-products-slider-wrapper .products .product .short-description,
	.woocommerce-order-received table.shop_table tfoot th,
	/* Widget */
	p.lost_password a,
	span.bbp-admin-links a,
	span.bbp-admin-links,
	.ts-product-attribute > div a,
	.comment_list_widget .comment-body,
	header.ts-header .header-template .my-account-wrapper .forgot-pass a,
	.woocommerce .woocommerce-ordering ul li a, 
	.sku-wrapper span,
	article .social-sharing li a, 
	div.product .social-sharing li a,
	.woocommerce table.shop_attributes td, 
	.woocommerce table.shop_attributes th, 
	.woocommerce p.stars a,
	.woocommerce-product-rating .woocommerce-review-link,
	table tfoot th,
	.woocommerce table.shop_table.customer_details th,
	.ts-team-member .image-thumbnail .social,
	.woocommerce-checkout #payment div.payment_box,
	body div.pp_default .pp_nav .currentTextHolder,
	.dashboard-widget.products ul li a,
	.ts-team-member .member-social a,
	.single-portfolio .cat-links > a,
	.bbp-login-links a,
	#bbpress-forums .status-category > li > .bbp-forums-list > li a,
	li.bbp-forum-freshness a, 
	li.bbp-topic-freshness a{
		color:<?php echo esc_html($ts_text_color) ?>;
	}
	.select2-container--default.select2-container--open .select2-selection--single .select2-selection__arrow b{
		border-bottom-color:<?php echo esc_html($ts_text_color) ?>;
	}
	.select2-container--default .select2-selection--single .select2-selection__arrow b{
		border-top-color:<?php echo esc_html($ts_text_color) ?>;
	}
	::-webkit-input-placeholder {
		color:<?php echo esc_html($ts_text_color) ?>;
	}

	:-moz-placeholder { /* Firefox 18- */
		color:<?php echo esc_html($ts_text_color) ?>;
	}

	::-moz-placeholder {  /* Firefox 19+ */
		color:<?php echo esc_html($ts_text_color) ?>;
	}

	:-ms-input-placeholder {  
		color:<?php echo esc_html($ts_text_color) ?>;
	}
	/* Quick view */
	select,
	textarea,
	html input[type="search"],
	html input[type="text"], 
	html input[type="email"],
	html input[type="password"],
	html input[type="tel"],
	#bbpress-forums #bbp-your-profile fieldset input, 
	#bbpress-forums #bbp-your-profile fieldset textarea,
	.bbp-login-form .bbp-username input, 
	.bbp-login-form .bbp-email input, 
	.bbp-login-form .bbp-password input,
	.select2-drop{
		color:<?php echo esc_html($ts_text_color) ?>;
		border-color:<?php echo esc_html($ts_border_color) ?>;
	}
	html input[type="search"]:hover,
	html input[type="text"]:hover, 
	html input[type="email"]:hover,
	html input[type="password"]:hover,
	html input[type="tel"]:hover,
	html textarea:hover,
	html input[type="search"]:focus,
	html input[type="text"]:focus, 
	html input[type="email"]:focus,
	html input[type="password"]:focus,
	html input[type="tel"]:focus,
	input:-webkit-autofill, 
	textarea:-webkit-autofill, 
	select:-webkit-autofill,
	html textarea:focus,
	html input:focus:invalid:focus, 
	html select:focus:invalid:focus,
	.woocommerce form .form-row textarea:hover, 
	.woocommerce form .form-row textarea:focus, 
	#bbpress-forums #bbp-your-profile fieldset input:hover, 
	#bbpress-forums #bbp-your-profile fieldset textarea:hover,
	#bbpress-forums #bbp-your-profile fieldset input:focus, 
	#bbpress-forums #bbp-your-profile fieldset textarea:focus,
	.bbp-login-form .bbp-username input:hover, 
	.bbp-login-form .bbp-email input:hover, 
	.bbp-login-form .bbp-password input:hover,
	.bbp-login-form .bbp-username input:focus, 
	.bbp-login-form .bbp-email input:focus, 
	.bbp-login-form .bbp-password input:focus,
	.select2-container .select2-choice,
	.select2-dropdown-open.select2-drop-above .select2-choice, 
	.select2-dropdown-open.select2-drop-above .select2-choices,
	.woocommerce form .form-row.woocommerce-validated .select2-container, 
	.woocommerce form .form-row.woocommerce-validated input.input-text, 
	.woocommerce form .form-row.woocommerce-validated select{
		border-color:<?php echo sanzo_calc_color($ts_border_color, '#282828', false) ?>;/* Mau border + - */
		color:<?php echo sanzo_calc_color($ts_text_color, '#222222', false) ?>;/* Mau text + - */
	}
	.owl-dots > div > span:before{
		border-color:<?php echo sanzo_calc_color($ts_border_color, '#303030', false) ?>;/* Mau border + - */
	}
	body .theme-default .nivo-controlNav a:before{
		border-color:<?php echo esc_html($ts_border_color) ?>;
	}
	body .theme-default .nivo-controlNav a:hover:before,
	body .theme-default .nivo-controlNav a.active:before{
		background-color:<?php echo esc_html($ts_border_color) ?>;
		border-color:<?php echo esc_html($ts_border_color) ?>;
	}

	/* HEADING COLOR */

	h1,h2,h3,h4,h5,h6,
	.h1,.h2,.h3,.h4,.h5,.h6,
	.woocommerce .products .product.product-category h3{
		color:<?php echo esc_html($ts_heading_color) ?>;
	}
	body.error404 h1:before{
		border-color:<?php echo esc_html($ts_text_color) ?>;
	}

	/* LINK COLOR */

	a{
		color:<?php echo esc_html($ts_link_color) ?>;
	}
	a:hover,
	a:active{
		color:<?php echo esc_html($ts_link_color_hover) ?>;
	}


	/* PRIMARY TEXT COLOR */

	.counter-wrapper > div .number-wrapper{
		color:<?php echo esc_html($ts_text_color_in_bg_second) ?>;
	}
	table thead th,
	label ,
	.wpcf7 p,
	span.author a,
	.primary-text,
	.banner-fullwidth-wrapper .banner_detail a.banner-button,
	/* Widget */
	.widget-container .tagcloud a:hover,
	.widget.ts-products-widget > .widgettitle,
	/* Product Detail */
	h3.heading-title > a,
	body.wpb-js-composer .vc_tta-accordion .vc_tta-panel .vc_tta-panel-title > a,
	body.wpb-js-composer .vc_tta.vc_general .vc_tta-tab > a,
	.ts-heading h1,
	.ts-heading h2,
	.ts-heading h3,
	.ts-heading h4,
	.avatar-name a,
	h1 > a,
	h2 > a,
	h3 > a,
	h4 > a,
	h5 > a,
	.woocommerce > form > fieldset legend,
	.widget-title-wrapper a.block-control,
	#bbpress-forums .status-category .bbp-forum-title,
	.type-forum .bbp-forum-title,
	#bbpress-forums li.bbp-footer,
	span.bbp-admin-links a:hover,
	.widget_categories > ul li.cat-parent > span.icon-toggle,
	.ts-product-categories-widget ul.product-categories span.icon-toggle,
	.ts-portfolio-wrapper .filter-bar li,
	.vc_toggle .vc_toggle_icon:before,
	.vc_toggle_default .vc_toggle_title h4,
	.vc_tta-accordion .vc_tta-panel .vc_tta-panel-title,
	p.currentTextHolder,
	.list-cats li a,
	.comments-area .reply a,
	.ts-product .shop-more-button,
	fieldset legend,
	.mc4wp-form-fields > h2.title,
	a.view-more,
	.secondary-color,
	.widget-title,
	.widget-container .post_list_widget > li a,
	.entry-author .author-info .role,
	.woocommerce .checkout #order_review table thead th,
	body.wpb-js-composer .vc_tta.vc_general .vc_tta-tab.vc_active > a,
	body.wpb-js-composer .vc_tta.vc_general .vc_tta-tab > a:hover,
	body.wpb-js-composer .vc_tta.vc_general.vc_tta-tabs-position-left .vc_tta-tab a,
	body.wpb-js-composer .vc_tta.vc_general.vc_tta-tabs-position-right .vc_tta-tab a,
	.woocommerce div.product .woocommerce-tabs ul.tabs li a, 
	.vc_progress_bar .vc_single_bar .vc_label,
	.ts-banner h2,
	.ts-banner h3,
	.ts-banner h4,
	.ts-banner .heading-big,
	.sku-wrapper,
	.dropdown-footer span.total-title,
	.total span.total-title,
	.pp_woocommerce div.product .product_title, 
	.woocommerce div.product .product_title,
	body .woocommerce .style-2 .product.product-category h3 a,
	body.woocommerce .style-2 .product.product-category h3 a,
	.woocommerce #reviews #comments ol.commentlist li .comment-text p.meta,
	.woocommerce p.stars a:hover,
	.woocommerce-account div.woocommerce h3,
	.woocommerce-MyAccount-content h2,
	.woocommerce-order-details h2,
	.woocommerce-cart .cart-collaterals .cart_totals table td, 
	.woocommerce-cart .cart-collaterals .cart_totals table th,
	.shipping-calculator-button,
	.woocommerce-billing-fields > h3,
	.woocommerce-shipping-fields > h3,
	.woocommerce-account div.woocommerce > h2,
	#customer_login .col-1 > h2,
	#customer_login .col-2 > h2,
	.heading-wrapper > h2,
	.heading-shortcode > h3,
	.theme-title > h3,
	.cross-sells > h2,
	.upsells > h2,
	.related > h2,
	.cart_totals h2,
	.mc4wp-form-fields h2.title,
	.wp-caption p.wp-caption-text,
	#order_review_heading,
	#ship-to-different-address, 
	form.checkout p.create-account > label,
	.woocommerce form.login, 
	.woocommerce form.register, 
	.woocommerce .checkout #order_review table th,
	.desc-big,
	.feedburner-subscription .widgettitle,
	.column-tabs .tabs li,
	.woocommerce #reviews #reply-title,
	.woocommerce .ts-product-deals-slider-wrapper.list .products .product .short-description,
	.dashboard-widget.products ul li a,
	.row-heading-tabs ul li,
	.row-heading-tabs ul li a,
	.widget-container .tagcloud a:hover,
	.ts-price-table .table-info .price,
	.heading-title,
	body div.pp_woocommerce .pp_description,
	.ts-single-products-slider-wrapper h3.product-name > a,
	.woocommerce-account .woocommerce-MyAccount-navigation li a,
	.ts-product-category-slider-wrapper .category-name h3 > a:hover,
	.woocommerce div.wishlist-title h2,
	.vc_progress_bar .vc_single_bar .vc_bar:before,
	.woocommerce-order-received .woocommerce > h2,
	.woocommerce-order-received .woocommerce header > h2,
	.woocommerce-order-received .woocommerce .title > h3,
	.ts-product-category-slider-wrapper.style-3 .category-name h3 > a,
	/* Quantity */
	.pp_woocommerce .quantity .minus:hover,
	.pp_woocommerce .quantity .plus:hover,
	.woocommerce .quantity .minus:hover, 
	.woocommerce .quantity .plus:hover, 
	.pp_woocommerce .quantity .minus:focus,
	.pp_woocommerce .quantity .plus:focus,
	.woocommerce .quantity .minus:focus, 
	.woocommerce .quantity .plus:focus,
	/* Portfolio */
	.portfolio-info p,
	.single-portfolio .info-content .entry-title,
	.vc_pie_chart .vc_pie_chart_value,
	/* Team */
	.ts-team-member header > h3 a,
	/* Forum */
	.type-topic .bbp-topic-title > a,
	#bbpress-forums div.bbp-topic-author a.bbp-author-name, 
	#bbpress-forums div.bbp-reply-author a.bbp-author-name,
	.bbp-meta .bbp-topic-permalink,
	.bbp-topic-title-meta a,
	#bbpress-forums #bbp-single-user-details #bbp-user-navigation a,
	#favorite-toggle a, 
	#subscription-toggle a,
	#bbpress-forums #bbp-user-wrapper h2.entry-title,
	/* Compare table */
	.woocommerce table.my_account_orders th,
	.woocommerce .woocommerce-MyAccount-content table.order_details th,
	.woocommerce .woocommerce-table--order-details.shop_table th,
	body #yith-woocompare table.compare-list th{
		color:<?php echo esc_html($ts_secondary_color) ?>;
	}
	body div.ppt,
	.cart-list li .cart-item-wrapper a.remove,
	.woocommerce .widget_shopping_cart .cart_list li a.remove, 
	.woocommerce.widget_shopping_cart .cart_list li a.remove,
	body .yith-woocompare-widget ul.products-list a.remove,
	body .yith-woocompare-widget ul.products-list a.removebefore,
	body .pp_nav .pp_play:before, 
	body .pp_nav .pp_pause:before,
	body .pp_arrow_previous:before, 
	body .pp_arrow_next:before,
	body div.pp_woocommerce.pp_pic_holder .pp_arrow_previous:before, 
	body div.pp_woocommerce.pp_pic_holder .pp_arrow_next:before{
		color:<?php echo esc_html($ts_secondary_color) ?> !important;
	}
	footer .widget_product_tag_cloud .tagcloud a:hover,
	footer .widget_tag_cloud .tagcloud a:hover,
	/* Forum */
	#bbpress-forums ul.bbp-replies > .bbp-header,
	#bbpress-forums ul.bbp-lead-topic .bbp-header, 
	#bbpress-forums ul.bbp-topics .bbp-header, 
	#bbpress-forums ul.bbp-forums .bbp-header, 
	#bbpress-forums ul.bbp-replies > .bbp-header,
	#bbpress-forums ul.bbp-search-results .bbp-header,
	.woocommerce table.cart th,
	.woocommerce-order-received table.shop_table thead th{
		background:<?php echo esc_html($ts_secondary_color) ?>;
	}
	body div.pp_woocommerce .pp_gallery ul li a:hover, 
	body div.pp_woocommerce .pp_gallery ul li.selected a,
	body div.pp_default .pp_gallery ul li a:hover, 
	body div.pp_default .pp_gallery ul li.selected a,
	.product-filter-by-color ul li a:before,
	.ts-heading.style-2 > h1:before,
	.ts-heading.style-2 > h2:before,
	.ts-heading.style-2 > h3:before,
	.ts-heading.style-2 > h4:before,
	.ts-heading.style-2 > h1:after,
	.ts-heading.style-2 > h2:after,
	.ts-heading.style-2 > h3:after,
	.ts-heading.style-2 > h4:after,
	.ts-product-attribute > div.color a:before{
		border-color:<?php echo esc_html($ts_secondary_color) ?>;
	}
	.woocommerce-account .woocommerce-MyAccount-navigation li:hover a,
	.woocommerce-account .woocommerce-MyAccount-navigation li.is-active a,
	.pp_woocommerce div.product form.cart .button, 
	.woocommerce div.product form.cart .button, 
	.woocommerce .button.button-secondary,
	.woocommerce .button.button-transparent:hover,
	body .button.button-transparent:hover,
	body .button.button-secondary,
	.woocommerce .button.button-primary:hover,
	body .button.button-primary:hover,
	body input.wpcf7-submit,
	body .rev_slider_wrapper .rev-btn.ts-button,
	body rs-module-wrap .rev-btn.ts-button,
	.woocommerce form.login .button, 
	.woocommerce #payment #place_order:hover, 
	.woocommerce #respond input#submit.disabled, 
	.woocommerce #respond input#submit:disabled, 
	.woocommerce #respond input#submit:disabled[disabled], 
	.woocommerce a.button.disabled, 
	.woocommerce a.button:disabled, 
	.woocommerce a.button:disabled[disabled], 
	.woocommerce button.button.disabled, 
	.woocommerce button.button:disabled, 
	.woocommerce button.button:disabled[disabled], 
	.woocommerce input.button.disabled, 
	.woocommerce input.button:disabled, 
	.woocommerce input.button:disabled[disabled],
	.woocommerce div.product .woocommerce-tabs ul.tabs li:hover a,
	.woocommerce div.product .woocommerce-tabs ul.tabs li.active a,
	body.wpb-js-composer .vc_tta.vc_general.vc_tta-tabs-position-left .vc_tta-tab.vc_active a,
	body.wpb-js-composer .vc_tta.vc_general.vc_tta-tabs-position-right .vc_tta-tab.vc_active a,
	body.wpb-js-composer .vc_tta.vc_general.vc_tta-tabs-position-left .vc_tta-tab:hover a,
	body.wpb-js-composer .vc_tta.vc_general.vc_tta-tabs-position-right .vc_tta-tab:hover a,
	body .vc_tta-tabs:not([class*=vc_tta-gap]):not(.vc_tta-o-no-fill).vc_tta-tabs-position-left .vc_tta-tab.vc_active > a,
	body .vc_tta-tabs:not([class*=vc_tta-gap]):not(.vc_tta-o-no-fill).vc_tta-tabs-position-right .vc_tta-tab.vc_active > a,
	body.wpb-js-composer .vc_tta-accordion .vc_tta-panel.vc_active .vc_tta-panel-title > a,
	body.wpb-js-composer .vc_tta-accordion .vc_tta-panel .vc_tta-panel-title > a:hover,
	body .vc_toggle_default.vc_toggle_active .vc_toggle_title h4,
	body .vc_toggle_default .vc_toggle_title:hover h4,
	body.wpb-js-composer .vc_tta.vc_general .vc_tta-tab.vc_active > a,
	body.wpb-js-composer .vc_tta.vc_general .vc_tta-tab > a:hover,
	.woocommerce .woocommerce-ordering:hover ul.orderby,
	/* Forum */
	#bbpress-forums #bbp-single-user-details #bbp-user-navigation a:hover,
	#bbpress-forums #bbp-single-user-details #bbp-user-navigation li.current a,
	.widget_calendar caption{
		background-color:<?php echo esc_html($ts_secondary_color) ?>;
		color:<?php echo esc_html($ts_text_color_in_bg_second) ?>;
		border-color:<?php echo esc_html($ts_secondary_color) ?>;
	}
	body .rev_slider .rev-btn-secondary-transparent:hover,
	body .rev_slider .rev-btn-secondary,
	body rs-module-wrap .rev-btn-secondary-transparent:hover,
	body rs-module-wrap .rev-btn-secondary{
		background-color:<?php echo esc_html($ts_secondary_color) ?> !important;
		color:<?php echo esc_html($ts_text_color_in_bg_second) ?> !important;
		border-color:<?php echo esc_html($ts_secondary_color) ?> !important;
	}
	body .vc_toggle .vc_toggle_title:hover .vc_toggle_icon:before,
	body .vc_toggle .vc_toggle_title:hover h4:before,
	body .vc_toggle_active .vc_toggle_title .vc_toggle_icon:before,
	body .vc_toggle_active .vc_toggle_title h4:before{
		color:<?php echo esc_html($ts_text_color_in_bg_second) ?>;
	}
	/* Remove button */
	.pp_woocommerce div.product form.cart table .button:hover, 
	.woocommerce div.product form.cart table .button:hover,
	.woocommerce form.login .button:hover,
	.woocommerce .button.button-secondary.transparent:hover,
	body .button.button-secondary.transparent:hover{
		background-color:transparent;
		color:<?php echo esc_html($ts_secondary_color) ?>;
		border-color:<?php echo esc_html($ts_secondary_color) ?>;
	}
	body .rev_slider .rev-btn-secondary:hover,
	body .rev_slider .rev-btn-secondary-transparent,
	body rs-module-wrap .rev-btn-secondary:hover,
	body rs-module-wrap .rev-btn-secondary-transparent{
		background-color:transparent !important;
		color:<?php echo esc_html($ts_secondary_color) ?> !important;
		border-color:<?php echo esc_html($ts_secondary_color) ?> !important;
	}
	/* Button Dots Slider */
	.owl-nav > div,
	div.product .single-navigation > div > a,
	/* Slider Icon Thumbnail */
	.images-thumbnails > .thumbnails .owl-nav > div{
		color:<?php echo esc_html($ts_secondary_color) ?>;
	}
	/* Slider Icon Thumbnail */
	.images-thumbnails > .thumbnails .owl-nav > div:hover,
	div.product .single-navigation a:hover,
	.text-light .owl-nav > div:hover:before,
	.text-light .owl-nav > div:hover,
	.owl-nav > div:hover,
	.style-light .owl-nav > div:hover,
	.ts-portfolio-wrapper.no-title.ts-slider .owl-nav > div:hover,
	.single-navigation > a:hover,
	.owl-dots > div > span:hover:before,
	.owl-dots > div.active > span:before{
		color:<?php echo esc_html($ts_primary_color) ?>;
		border-color:<?php echo esc_html($ts_primary_color) ?>;
	}

	/* PRIMARY COLOR */

	.ts-dropcap.style-2,
	.ts-social-icons .ts-tooltip,
	body .vc_toggle_active .vc_toggle_icon:before,
	.widget-container.ts-menus-widget .widget-title,
	/* Price Table */
	.ts-price-table header h3,
	/* Compare table */
	body.woocommerce > h1{
		color:<?php echo esc_html($ts_text_color_in_bg_primary) ?>;
	}
	.primary-color,
	.ul-style li:before,
	.ts-dropcap,
	h1 > a:hover,
	h2 > a:hover,
	h3 > a:hover,
	h4 > a:hover,
	h5 > a:hover,
	.comments-area .reply a:hover,
	ul.product_list_widget li .product-categories a:hover,
	#lang_sel_click ul ul a:hover,
	header.ts-header .header-top .wpml-ls ul li a:hover,
	.header-currency ul li:hover a:not(.button),
	.cats-link a:hover,
	.tags-link a:hover,
	.widget-container ul.product_list_widget li .ts-wg-meta > a:hover,
	.woocommerce .widget-container ul.product_list_widget li .ts-wg-meta > a:hover,
	a.view-more:hover,
	.woocommerce .ts-single-products-slider-wrapper .products .product .product-categories,
	.woocommerce .ts-single-products-slider-wrapper .products .product .product-categories a,
	body .woocommerce .style-2 .product.product-category h3 a:hover,
	body.woocommerce .style-2 .product.product-category h3 a:hover,
	.ts-single-products-slider-wrapper h3.product-name > a:hover,
	/* Product Detail */
	.order-number a,
	label a:hover,
	.widget-container ul > li a:hover,
	.dokan-widget-area .widget ul li > a:hover,
	.dokan-orders-content .dokan-dashboard-content ul.dokan_tabs li a,
	.dokan-orders-content .dokan-orders-area ul.order-statuses-filter li.active a,
	.dokan-orders-content .dokan-orders-area ul.order-statuses-filter li:hover a,
	.dokan-dashboard .dokan-dashboard-content a:hover,
	.dokan-dashboard .dokan-dashboard-content li.active > a,
	span.author a:hover,
	section.widget_nav_menu > div > ul > li > a:hover,
	.widget-container ul ul li > a:hover,
	.list-posts .heading-title a:hover,
	.blog-like-wrapper .number-like,
	p.lost_password a:hover,
	.products .product.product-category a:hover h3, 
	.woocommerce .products .product.product-category a:hover h3, 
	header.ts-header .header-template .my-account-wrapper .forgot-pass a:hover,
	.woocommerce .products .product .product-categories a:hover, 
	.woocommerce .widget-container il li .product-categories a:hover,
	.widget-container ul li .product-categories a:hover,
	.widget.ts-products-widget .product-categories a:hover,
	.woocommerce .widget_layered_nav .woocommerce-widget-layered-nav-list li:hover a,
	.woocommerce .widget_layered_nav .woocommerce-widget-layered-nav-list li:hover span.count,
	.woocommerce .widget_layered_nav .woocommerce-widget-layered-nav-list li.chosen a,
	.woocommerce .widget_layered_nav .woocommerce-widget-layered-nav-list li.chosen span.count,
	.ts-product-attribute > div:hover a,
	.ts-product-attribute > div.selected a,
	.ts-product-categories-widget ul.product-categories span.icon-toggle:hover,
	.widget_categories > ul li.cat-parent > span.icon-toggle:hover,
	.ts-product-categories-widget ul.product-categories li.current > a,
	.ts-product-categories-widget ul.product-categories li a:hover,
	.widget_categories > ul li.current-cat > a,
	.widget_categories > ul li a:hover,
	.ts-testimonial-wrapper.text-light .testimonial-content h4.name a:hover,
	.ts-twitter-slider.text-light .twitter-content h4.name > a:hover,
	.woocommerce .ts-product-deals-slider-wrapper .products .product .product-categories a:hover,
	.woocommerce .ts-product-deals-slider-wrapper .products .center .product-name a:hover,
	.gridlist-toggle a:hover,
	.gridlist-toggle a.active,
	.woocommerce .woocommerce-ordering ul li a:hover, 
	.shipping-calculator-button:hover,
	.widget-container .post_list_widget > li a:hover,
	.blog-like-wrapper .ic-like .ts-tooltip:before,
	.single-portfolio .cat-links > a:hover,
	body.error404 article h1,
	body.error404 .icon-404 i,
	.ts-list-of-product-categories-wrapper .list-categories li a:hover,
	.ts-blogs-split-wrapper .item-large article a:hover,
	.ts-tiny-cart-wrapper .ic-cart:before,
	body .single-post .single-navigation > a:hover,
	.woocommerce .checkout-login-coupon-wrapper .woocommerce-info:before,
	.woocommerce .checkout-login-coupon-wrapper .woocommerce-info,
	.woocommerce .checkout-login-coupon-wrapper .woocommerce-info a,
	/* Header */
	.header-v5 .header-middle .shopping-cart-wrapper:hover .cart-control,
	.header-v5 .header-middle #lang_sel_click:hover > ul > li > a,
	.header-v5 .header-middle .wpml-ls:hover > ul > li > a, 
	.header-v5 .header-middle .shopping-cart-wrapper:hover .ic-cart:before,
	.header-v5 .header-middle .header-currency:hover .wcml_currency_switcher > a,
	.header-v5 .header-middle .my-account-wrapper:hover .account-control > a:before,
	.header-v5 .header-middle .my-wishlist-wrapper:hover a:before,
	.header-v5 .header-middle .header-currency:hover .wcml_currency_switcher > a:before,
	.header-v5 .header-middle .ic-menu-button:hover:after,
	.header-v5 .header-middle .search-wrapper:hover i,
	.header-v5 .header-middle a.ic-home:hover i,
	.ic-mobile-menu-close-button:hover,
	a.ic-home:hover i,
	/* Menu phone */
	.mobile-menu-wrapper li:hover > a,
	.mobile-menu-wrapper li .ts-menu-drop-icon:hover,
	.mobile-menu-wrapper li.current-menu-item > a,
	.mobile-menu-wrapper li.current_page_item > a,
	.mobile-menu-wrapper li:hover:before,
	.mobile-menu-wrapper li.current-menu-item:before,
	.mobile-menu-wrapper li.current_page_item:before,
	.group-button-icon-header .shopping-cart-wrapper span.cart-number,
	.ts-product-category-slider-wrapper.style-3 .category-name h3 > a:hover,
	/* Portfolio */
	.ts-portfolio-wrapper .filter-bar li:hover,
	.ts-portfolio-wrapper .filter-bar li.current,
	/* Team */
	.ts-team-member header > h3 a:hover,
	/* Product detail */
	.pp_woocommerce div.product form.cart .variations td .reset_variations,
	.woocommerce div.product form.cart .variations td .reset_variations, 
	.woocommerce div.product p.stock span, 
	.pp_woocommerce div.product p.stock span,
	body #yith-woocompare table.compare-list tr.stock span,
	.wishlist_table tr td.product-stock-status span,
	/* Product */
	.ts-product .shop-more-button:hover,
	.cart_list span.quantity,
	#ts-search-result-container .view-all-wrapper a:hover,
	#ts-search-result-container ul li a:hover,
	/* Product name */
	.list-cats li a:hover,
	.widget-container .product_list_widget li a:hover,
	.woocommerce .widget-container .product_list_widget li a:hover,
	.widget.ts-products-widget .ts-wg-meta > a:hover,
	header.ts-header .header-top h3.product-name > a:hover,
	h3.product-name > a:hover, 
	h3.product-name:hover,
	.product-name a:hover,
	.group_table a:hover,
	/* Forum */
	.bbp-login-links a:hover,
	#bbpress-forums .status-category > .bbp-forum-info > a.bbp-forum-title:hover,
	.type-forum .bbp-forum-title:hover,
	.bbp-topic-started-in > a:hover,
	#bbpress-forums .status-category > li > .bbp-forums-list > li a:hover,
	li.bbp-forum-freshness a:hover, 
	li.bbp-topic-freshness a:hover,
	.type-topic .bbp-topic-title > a:hover,
	#bbpress-forums div.bbp-topic-author a.bbp-author-name:hover, 
	#bbpress-forums div.bbp-reply-author a.bbp-author-name:hover,
	.bbp-meta .bbp-topic-permalink:hover,
	.bbp-topic-title-meta a:hover,
	#favorite-toggle a:hover,
	#subscription-toggle a:hover,
	.dashboard-widget.products ul li a:hover{
		color:<?php echo esc_html($ts_primary_color) ?>;
	}
	.ts-social-icons li.custom .ts-tooltip:before{
		border-top-color:<?php echo esc_html($ts_primary_color) ?>;
	}
	.ts-social-icons .background-big li.custom:hover a i,
	footer#colophon .ts-social-icons .background-big li.custom:hover a i,
	body .pp_nav .pp_play:hover:before, 
	body .pp_nav .pp_pause:hover:before,
	body .pp_arrow_previous:hover:before, 
	body .pp_arrow_next:hover:before,
	body div.pp_woocommerce.pp_pic_holder .pp_arrow_previous:hover:before, 
	body div.pp_woocommerce.pp_pic_holder .pp_arrow_next:hover:before,
	body .rev_slider_wrapper .ts-button-style-2-light:hover
	body rs-module-wrap .ts-button-style-2-light:hover{
		color:<?php echo esc_html($ts_primary_color) ?> !important;
	}
	.ts-feature-wrapper .feature-icon,
	.woocommerce .checkout-login-coupon-wrapper .woocommerce-info,
	.menu-wrapper > .ic-close-menu-button:hover,
	.woocommerce .widget_price_filter .ui-slider .ui-slider-handle,
	.woocommerce div.product div.thumbnails li:hover a img,
	.pp_woocommerce div.product div.thumbnails li:hover a img,
	.ts-price-table.active-table:before,
	.ts-footer-block .widget-container ul li.custom:hover > a,
	footer#colophon .ts-social-icons li.custom:hover a,
	.ts-social-icons .background-big li.custom a,
	footer#colophon .ts-social-icons .background-big li.custom a,
	.gridlist-toggle a:hover,
	.gridlist-toggle a.active,
	blockquote:after,
	.woocommerce div.product .woocommerce-tabs ul.tabs li.active a:after, 
	.woocommerce div.product .woocommerce-tabs ul.tabs li:hover a:after, 
	.ts-product-filter-wrapper .icon:hover,
	.ts-product-filter-wrapper .icon.active{
		border-color:<?php echo esc_html($ts_primary_color) ?>;
	}
	.ts-dropcap.style-2,
	.woocommerce .widget_price_filter .ui-slider-horizontal .ui-slider-range:before,
	.ts-product-filter-wrapper .icon:hover,
	.ts-product-filter-wrapper .icon.active,
	/* Portfolio */
	.portfolio-inner .icon-group a:hover,
	/* Team icon custom */
	.ts-team-member .image-thumbnail .social a.custom:hover,
	/* Price Table */
	.ts-price-table header,
	/* Compare table */
	body.woocommerce > h1,
	/* Social */
	.ts-social-icons li.custom:hover a,
	footer#colophon .ts-social-icons li.custom:hover a,
	.ts-social-icons li.custom  .ts-tooltip,
	.ts-social-icons .background-big li.custom a,
	footer#colophon .ts-social-icons .background-big li.custom a,
	footer#colophon .ts-social-icons li.custom .ts-tooltip,
	/* Header */
	.ts-tiny-cart-wrapper .ic-cart:after,
	.widget-container.ts-menus-widget .widget-title
	{
		background-color:<?php echo esc_html($ts_primary_color) ?>;
	}
	.mc4wp-form-fields input[type="submit"]:hover,
	.woocommerce .cart_totals a.checkout-button.button,
	.blog-like-wrapper .ic-like .ts-tooltip,
	.blog-like-wrapper .ic-like:hover,
	.blog-like-wrapper .already-like .ic-like:hover,
	.woocommerce .button.button-primary,
	body .button.button-primary,
	body input.wpcf7-submit:hover,
	.pp_woocommerce div.product form.cart .button:hover, 
	.woocommerce div.product form.cart .button:hover, 
	.ts-feature-wrapper .feature-icon:hover,
	.woocommerce form.register .button:hover, 
	.woocommerce #payment #place_order, 
	.woocommerce #respond input#submit.disabled:hover, 
	.woocommerce #respond input#submit:disabled:hover, 
	.woocommerce #respond input#submit:disabled[disabled]:hover, 
	.woocommerce a.button.disabled:hover, 
	.woocommerce a.button:disabled:hover, 
	.woocommerce a.button:disabled[disabled]:hover, 
	.woocommerce button.button.disabled:hover, 
	.woocommerce button.button:disabled:hover, 
	.woocommerce button.button:disabled[disabled]:hover, 
	.woocommerce input.button.disabled:hover, 
	.woocommerce input.button:disabled:hover, 
	.woocommerce input.button:disabled[disabled]:hover,
	.woocommerce form.register .button,
	.ts-price-table .table-description > a.button:hover,
	.portfolio-inner .icon-group a:hover,
	body .button.button-border-primary:hover,
	body.woocommerce .button.button-border-primary:hover,
	/* Quick view hover */
	body #cboxClose:hover,
	#ts-search-popup .search-button input:hover,
	#ts-search-popup .ts-button-close:hover,
	body div.ts-product-video.pp_pic_holder .pp_close:hover,
	body .pp_nav .pp_play:hover, 
	body .pp_nav .pp_pause:hover,
	body div.pp_default .pp_close:hover,
	body div.pp_woocommerce.pp_pic_holder .pp_close:hover,
	body div.pp_woocommerce.pp_pic_holder .pp_expand:hover,
	body div.pp_woocommerce.pp_pic_holder .pp_contract:hover,
	body div.pp_default .pp_expand:hover,
	body div.pp_default.pp_contract:hover{
		background-color:<?php echo esc_html($ts_primary_color) ?>;
		color:<?php echo esc_html($ts_text_color_in_bg_primary) ?>;
		border-color:<?php echo esc_html($ts_primary_color) ?>;
	}
	body .rev_slider .rev-btn-border-primary:hover,
	body .rev_slider .rev-btn-primary,
	body rs-module-wrap .rev-btn-border-primary:hover,
	body rs-module-wrap .rev-btn-primary{
		background-color:<?php echo esc_html($ts_primary_color) ?> !important;
		color:<?php echo esc_html($ts_text_color_in_bg_primary) ?> !important;
		border-color:<?php echo esc_html($ts_primary_color) ?> !important;
	}
	body .button.button-border-primary,
	body.woocommerce .button.button-border-primary,
	body .rev_slider .rev-btn-primary:hover,
	body .rev_slider .rev-btn-border-primary,
	body rs-module-wrap .rev-btn-primary:hover,
	body rs-module-wrap .rev-btn-border-primary,
	.woocommerce .product .thumbnail-wrapper .loop-add-to-cart a.button:hover,
	.woocommerce .product .thumbnail-wrapper .button-in:hover a,
	.button-in a:hover,
	.product-group-button .loop-add-to-cart a:hover,
	.blog-like-wrapper .already-like .ic-like,
	.woocommerce .cart_totals a.checkout-button.button:hover,
	.woocommerce .cart_totals a.checkout-button.button:focus,
	.woocommerce form.register .button:hover,
	.woocommerce .button.button-primary.transparent:hover,
	body .button.button-primary.transparent:hover{
		color:<?php echo esc_html($ts_primary_color) ?>;
		background:transparent;
		border-color:<?php echo esc_html($ts_primary_color) ?>;
	}
	body .rev_slider .rev-btn-primary:hover,
	body .rev_slider .rev-btn-border-primary,
	body rs-module-wrap .rev-btn-primary:hover,
	body rs-module-wrap .rev-btn-border-primary{
		color:<?php echo esc_html($ts_primary_color) ?> !important;
		background:transparent !important;
		border-color:<?php echo esc_html($ts_primary_color) ?> !important;
	}

	/* INPUT COLOR */
	
	*,
	* :before,
	* :after,
	body #yith-woocompare table.compare-list tr th, 
	body #yith-woocompare table.compare-list tr td,
	.dokan-dashboard .dokan-dashboard-content .edit-account fieldset,
	body > table.compare-list,
	header.ts-header .header-v2 .search-content input[type="text"],
	.woocommerce table.my_account_orders tbody tr:first-child td:first-child,
	body .woocommerce table.my_account_orders td.order-actions,
	body div.pp_woocommerce .pp_gallery ul li a, 
	.select2-drop.select2-drop-above.select2-drop-active,
	.select2-drop.select2-drop-above,
	.select2-container .select2-choice,
	body .vc_separator.border-color .vc_sep_line,
	.quantity input[type="number"],
	.pp_woocommerce .quantity input.qty,
	.woocommerce .quantity input.qty, 
	.woocommerce table.shop_attributes th, 
	.woocommerce table.shop_attributes td, 
	.woocommerce .widget_layered_nav .woocommerce-widget-layered-nav-list, 
	.woocommerce table.shop_table, 
	.woocommerce table.shop_table td, 
	body .wpb_flexslider.flexslider,
	.select2-container .select2-choice,
	.woocommerce table.wishlist_table thead th, 
	.woocommerce table.wishlist_table tbody td,
	.widget_product_search, 
	.widget_search, 
	.widget_display_search,
	.widget-container.widget_calendar,
	.entry-bottom .ts-social-sharing li a,
	.woocommerce p.stars a.star-1, 
	.woocommerce p.stars a.star-2, 
	.woocommerce p.stars a.star-3, 
	.woocommerce p.stars a.star-4, 
	.woocommerce p.stars a.star-5,
	.woocommerce #reviews #comments ol.commentlist li .comment-text,
	.woocommerce table.shop_attributes, 
	.woocommerce div.product .woocommerce-tabs ul.tabs li.active,
	.woocommerce div.product .woocommerce-tabs ul.tabs li,
	body .vc_tta.vc_tta-tabs.vc_tta-tabs-position-left .vc_tta-panels-container,
	body .vc_tta.vc_tta-tabs.vc_tta-tabs-position-right .vc_tta-panels-container,
	.woocommerce div.product .woocommerce-tabs ul.tabs li a, 
	body.wpb-js-composer .vc_tta-accordion .vc_tta-panel .vc_tta-panel-title > a,
	body.wpb-js-composer .vc_tta-accordion .vc_tta-panel-body,
	body.wpb-js-composer .vc_tta.vc_general.vc_tta-tabs-position-left .vc_tta-tab a,
	body.wpb-js-composer .vc_tta.vc_general.vc_tta-tabs-position-right .vc_tta-tab a,
	body.wpb-js-composer .vc_tta.vc_general .vc_tta-tab.vc_active > a:after,
	body.wpb-js-composer .vc_tta.vc_general .vc_tta-tab.vc_active > a:before,
	body .vc_toggle_default .vc_toggle_title h4,
	body.wpb-js-composer .vc_tta.vc_general .vc_tta-tab > a,
	body .vc_toggle .vc_toggle_icon,
	.woocommerce #reviews #comments ol.commentlist li ,
	#yith-woocompare > *,
	.woocommerce div.product div.thumbnails li a img,
	.pp_woocommerce div.product div.images-thumbnails img,
	.woocommerce div.product div.images-thumbnails img,
	/* Forum */
	#bbpress-forums li.bbp-body ul.forum, 
	#bbpress-forums li.bbp-body ul.topic,
	#bbpress-forums ul.bbp-lead-topic, 
	#bbpress-forums ul.bbp-topics, 
	#bbpress-forums ul.bbp-forums, 
	#bbpress-forums ul.bbp-replies, 
	#bbpress-forums ul.bbp-search-results,
	#bbpress-forums div.bbp-the-content-wrapper textarea.bbp-the-content,
	#bbpress-forums div.bbp-forum-header, 
	#bbpress-forums div.bbp-topic-header, 
	#bbpress-forums div.bbp-reply-header,
	#bbpress-forums li.bbp-header, 
	#bbpress-forums li.bbp-footer,
	#bbpress-forums #bbp-single-user-details #bbp-user-navigation a{
		border-color:<?php echo esc_html($ts_border_color) ?>;
	}
	#bbpress-forums div.bbp-the-content-wrapper div.quicktags-toolbar,
	.ts-product-attribute > div:before,
	.woocommerce div.product .woocommerce-tabs ul.tabs:before,
	.single-portfolio .ic-like{
		background-color:<?php echo esc_html($ts_border_color) ?>;
	}

	/* REVOLUTION SLIDER */

	.vc_images_carousel .vc_left .icon-prev:after, 
	.vc_images_carousel .vc_right .icon-next:after,
	.tp-leftarrow.tparrows:after,
	.tp-rightarrow.tparrows:after,
	.wpb_gallery .wpb_flexslider .flex-direction-nav a:after,
	.theme-default .nivo-directionNav a:after{
		background-color:<?php echo esc_html($ts_text_color_in_bg_second) ?> !important;
	}
	.vc_images_carousel .vc_left .icon-prev:before, 
	.vc_images_carousel .vc_right .icon-next:before,
	.tp-leftarrow.tparrows:before,
	.tp-rightarrow.tparrows:before,
	.wpb_gallery .wpb_flexslider .flex-direction-nav a:before,
	.theme-default .nivo-directionNav a:before{
		color:<?php echo esc_html($ts_secondary_color) ?> !important;
	}
	.vc_images_carousel .vc_left:hover .icon-prev:after, 
	.vc_images_carousel .vc_right:hover .icon-next:after,
	.tp-leftarrow.tparrows:hover:after,
	.tp-rightarrow.tparrows:hover:after,
	.wpb_gallery .wpb_flexslider .flex-direction-nav a:hover:after,
	.theme-default .nivo-directionNav a:hover:after{
		background-color:<?php echo esc_html($ts_secondary_color) ?> !important;
	}
	.vc_images_carousel .vc_left:hover .icon-prev:before, 
	.vc_images_carousel .vc_right:hover .icon-next:before,
	.tp-leftarrow.tparrows:hover:before,
	.tp-rightarrow.tparrows:hover:before,
	.wpb_gallery .wpb_flexslider .flex-direction-nav a:hover:before,
	.theme-default .nivo-directionNav a:hover:before{
		color:<?php echo esc_html($ts_text_color_in_bg_second) ?> !important;
	}

	/* BUTTON */

	#to-top a:hover,
	a.button:hover,
	button:hover, 
	input[type="submit"]:hover, 
	.shopping-cart p.buttons a:hover, 
	.woocommerce #respond input#submit:hover, 
	.woocommerce a.button:hover, 
	.woocommerce button.button:hover, 
	.woocommerce input.button:hover, 
	.woocommerce #respond input#submit.alt:hover, 
	.woocommerce a.button.alt:hover, 
	.woocommerce button.button.alt:hover, 
	.woocommerce input.button.alt:hover, 
	.woocommerce .widget_price_filter .price_slider_amount .button:hover,
	.woocommerce .widget_price_filter .price_slider_amount .button:focus,
	.woocommerce #respond input#submit.alt.disabled,
	.woocommerce #respond input#submit.alt.disabled:hover,
	.woocommerce #respond input#submit.alt:disabled,
	.woocommerce #respond input#submit.alt:disabled:hover,
	.woocommerce #respond input#submit.alt:disabled[disabled],
	.woocommerce #respond input#submit.alt:disabled[disabled]:hover,
	.woocommerce a.button.alt.disabled,
	.woocommerce a.button.alt.disabled:hover,
	.woocommerce a.button.alt:disabled,
	.woocommerce a.button.alt:disabled:hover,
	.woocommerce a.button.alt:disabled[disabled],
	.woocommerce a.button.alt:disabled[disabled]:hover,
	.woocommerce button.button.alt.disabled,
	.woocommerce button.button.alt.disabled:hover,
	.woocommerce button.button.alt:disabled,
	.woocommerce button.button.alt:disabled:hover,
	.woocommerce button.button.alt:disabled[disabled],
	.woocommerce button.button.alt:disabled[disabled]:hover,
	.woocommerce input.button.alt.disabled,
	.woocommerce input.button.alt.disabled:hover,
	.woocommerce input.button.alt:disabled,
	.woocommerce input.button.alt:disabled:hover,
	.woocommerce input.button.alt:disabled[disabled],
	.woocommerce input.button.alt:disabled[disabled]:hover,

	body #yith-woocompare table.compare-list .add-to-cart td a:hover,
	/* Pagination */
	.woocommerce nav.woocommerce-pagination ul li a.next:hover, 
	.woocommerce nav.woocommerce-pagination ul li a.prev:hover, 
	.ts-pagination ul li a.prev:hover,
	.ts-pagination ul li a.next:hover,

	.woocommerce nav.woocommerce-pagination ul li a.next:focus, 
	.woocommerce nav.woocommerce-pagination ul li a.prev:focus, 
	.ts-pagination ul li a.prev:focus,
	.ts-pagination ul li a.next:focus,

	.dokan-pagination-container .dokan-pagination li:hover a,
	.dokan-pagination-container .dokan-pagination li.active a,
	.ts-pagination ul li a:hover,
	.ts-pagination ul li a:focus,
	.ts-pagination ul li span.current,
	.woocommerce nav.woocommerce-pagination ul li a:hover, 
	.woocommerce nav.woocommerce-pagination ul li span.current, 
	.woocommerce nav.woocommerce-pagination ul li a:focus, 
	 
	.woocommerce nav.woocommerce-pagination ul li a.next:focus 
	.woocommerce nav.woocommerce-pagination ul li a.prev:focus, 

	.woocommerce nav.woocommerce-pagination ul li a.next:hover, 
	.woocommerce nav.woocommerce-pagination ul li a.prev:hover, 

	.bbp-pagination-links a:hover, 
	.bbp-pagination-links span.current
	{
		background-color:<?php echo esc_html($ts_button_background_color_hover) ?>;
		border-color:<?php echo esc_html($ts_button_border_color_hover) ?>;
		color:<?php echo esc_html($ts_button_text_color_hover) ?>;
	}
	.pp_woocommerce div.product form.cart table .button, 
	.woocommerce div.product form.cart table .button, 
	#to-top a,
	a.button,
	button,
	input[type="submit"],
	.shopping-cart p.buttons a,
	.woocommerce #respond input#submit,
	.woocommerce a.button,
	.woocommerce button.button,
	.woocommerce input.button,
	.woocommerce #respond input#submit.alt,
	.woocommerce a.button.alt,
	.woocommerce button.button.alt,
	.woocommerce input.button.alt,
	.woocommerce .widget_price_filter .price_slider_amount .button,
	.blog-like-wrapper .ic-like,
	body #yith-woocompare table.compare-list .add-to-cart td a{
		background-color:<?php echo esc_html($ts_button_background_color) ?>;
		color:<?php echo esc_html($ts_button_text_color) ?>;
		border-color:<?php echo esc_html($ts_button_border_color) ?>;
	}
	.woocommerce table.shop_table .product-remove a{
		background-color:<?php echo esc_html($ts_button_background_color) ?>;
		color:<?php echo esc_html($ts_button_text_color) ?> !important;
		border-color:<?php echo esc_html($ts_button_border_color) ?>;
	}
	
	/* Pagination */
	
	.ts-pagination ul li a,
	.dokan-pagination-container .dokan-pagination li a,
	.woocommerce nav.woocommerce-pagination ul li a, 
	.woocommerce nav.woocommerce-pagination ul li span, 
	.bbp-pagination-links a{
		background-color:<?php echo esc_html($ts_button_background_color) ?>;
		color:<?php echo sanzo_calc_color($ts_button_text_color, '#272727', true) ?>;
		border-color:<?php echo esc_html($ts_button_border_color) ?>;
	}
	
	/* Breadcrumb */
	
	.breadcrumb-title-wrapper{
		background-color:<?php echo esc_html($ts_breadcrumb_background_color) ?>;
	}
	.breadcrumb-title-wrapper .breadcrumb-title *{
		color:<?php echo esc_html($ts_breadcrumb_text_color) ?>;
	}
	.breadcrumb-title-wrapper .breadcrumb-title a:hover{
		color:<?php echo esc_html($ts_primary_color) ?>;
	}
	.breadcrumb-title-wrapper .breadcrumb-title h1{
		color:<?php echo esc_html($ts_breadcrumb_heading_color) ?>;
	}

	/* ============= 3. HEADER COLORS ============== */
	
	/* Header top */
	header.ts-header .header-top{
		background-color:<?php echo esc_html($ts_top_header_background_color) ?>;
	}
	header.ts-header .header-top a:not(.button),
	header.ts-header .header-top,
	.header-v4 a.cart-control span.amount,
	.header-v3 a.cart-control span.amount,
	.header-v8 .group-meta-header .shopping-cart-wrapper a.cart-control span.amount{
		color:<?php echo esc_html($ts_top_header_text_color) ?>;
	}
	/* Text Hover header top */
	.header-v8 .group-meta-header .shopping-cart-wrapper:hover a.cart-control span.amount,
	.header-top .my-account-wrapper .account-control > a:hover,
	.header-top .header-top-right .my-wishlist-wrapper a:hover,
	.header-top #lang_sel_click > ul > li > a:hover,
	.header-top .wpml-ls > ul > li.wpml-ls-item > a:hover,
	.header-top .header-currency > div > a:hover{
		color:<?php echo esc_html($ts_primary_color) ?>;
	}
	.header-v5 .group-meta-header > div:before,
	.header-top-right .group-meta-header > div:last-child:before,
	.header-top-right .group-meta-header > div:before{
		border-color:<?php echo esc_html($ts_top_header_text_color) ?>;
	}
	.ts-header .header-top .ts-social-sharing li a{
		color:<?php echo esc_html($ts_top_header_text_color) ?>;
	}
	/* Header middle */
	.header-v5 .header-middle .shopping-cart-wrapper .cart-control,
	.header-v5 .header-middle #lang_sel_click > ul > li > a, 
	.header-v5 .header-middle .wpml-ls > ul > li.wpml-ls-item > a,
	.header-v5 .header-middle .shopping-cart-wrapper .ic-cart:before,
	.header-v5 .header-middle .header-currency .wcml_currency_switcher > a,
	.header-v5 .header-middle .my-account-wrapper .account-control > a:before,
	.header-v5 .header-middle .my-wishlist-wrapper a:before,
	.header-v5 .header-middle .header-currency .wcml_currency_switcher > a:before,
	.header-v5 .header-middle .ic-menu-button:after,
	.header-v5 .header-middle .search-wrapper i,
	.header-middle a.ic-home i{
		color:<?php echo esc_html($ts_middle_header_text_color) ?>;
	}
	.header-middle,
	.header-v3 .header-product-categories.loading:before,
	.header-v6 .banner-middle-content{
		background-color:<?php echo esc_html($ts_middle_header_background_color) ?>;
	}
	.header-v5 .header-middle:before{
		border-top-color:<?php echo esc_html($ts_middle_header_background_color) ?>;
	}
	#ts-search-popup{
		background:<?php echo esc_html($ts_popup_heading_color); ?>;
	}
	#ts-search-popup .ts-popup-content{
		background-image:url(<?php echo esc_html($ts_bg_search_image); ?>)
	}
	#ts-search-popup .search-wrapper h3{
		color:<?php echo esc_html($ts_popup_heading_color); ?>;
	}
	#ts-search-popup .search-button input[type="submit"]{
		background-color:<?php echo esc_html($ts_popup_heading_color) ?>;
		border-color:<?php echo esc_html($ts_popup_heading_color) ?>;
	}
	/* Header bottom */
	body.boxed .header-v1 .header-bottom .container,
	body.header-boxed header.ts-header .header-v1 .header-bottom .container,
	header.ts-header .header-bottom,
	.header-product-categories.loading:before{
		background-color:<?php echo esc_html($ts_bottom_header_background_color) ?>;
	}
	.header-product-categories .category-name h3 a,
	.header-product-categories .owl-nav > div:before{
		color:<?php echo esc_html($ts_header_categories_product_name_color) ?>;
	}
	.header-product-categories .category-name h3 a:hover,
	.header-product-categories .owl-nav > div:hover:before{
		color:<?php echo esc_html($ts_header_categories_product_name_hover_color) ?>;
	}
	.header-product-categories .item:before{
		border-color:<?php echo esc_html($ts_header_categories_product_border_color) ?>;
	}

	/* Shopping Cart */
	.header-v1 .shopping-cart-wrapper .ic-cart,
	.header-v6 .shopping-cart-wrapper .ic-cart{
		background-color:<?php echo esc_html($ts_primary_color) ?>;
	}
	.shopping-cart-wrapper .ts-tiny-cart-wrapper{
		border-color:<?php echo esc_html($ts_primary_color) ?>;
	}
	.header-v1 .shopping-cart-wrapper .ic-cart:before,
	.header-v1 .shopping-cart-wrapper .cart-number{
		color:<?php echo esc_html($ts_text_color_in_bg_primary) ?>;
	}
	/* Header Search */
	.ts-header .ts-search-by-category{
		border-color:<?php echo esc_html($ts_search_border_color) ?>;
		background-color:<?php echo esc_html($ts_search_background_color) ?>;
	}
	.ts-header .search-wrapper input[type="text"]{
		border-color:<?php echo esc_html($ts_search_border_color) ?>;
	}
	body .category-dropdown .select2-dropdown,
	.ts-header .ts-search-by-category select,
	.ts-header .ts-search-by-category option,
	.ts-header .ts-search-by-category form > .select2{
		background-color:<?php echo esc_html($ts_search_background_color) ?>;
		border-color:<?php echo esc_html($ts_search_border_color) ?>;
	}
	.header-v2 .ts-search-by-category:before,
	.header-v6 .ts-search-by-category:before{
		border-color:<?php echo esc_html($ts_search_border_color) ?>;
	}
	.select2-results .select2-ajax-error, 
	.select2-results .select2-no-results, 
	.select2-results .select2-searching, 
	.select2-results .select2-selection-limit{
		background-color:<?php echo esc_html($ts_search_background_color) ?>;
		color:<?php echo esc_html($ts_search_categories_text_color) ?>;
	}
	.category-dropdown .select2-choice,
	.category-dropdown li,
	header .select2-container--default .select2-selection--single .select2-selection__rendered,
	.ts-header .ts-search-by-category select{
		color:<?php echo esc_html($ts_search_categories_text_color) ?>;
	}
	header .select2-container--default .select2-selection--single .select2-selection__arrow b{
		border-top-color:<?php echo esc_html($ts_search_categories_text_color) ?>;
	}
	header .select2-container--default.select2-container--open .select2-selection--single .select2-selection__arrow b{
		border-bottom-color:<?php echo esc_html($ts_search_categories_text_color) ?>;
	}
	body .category-dropdown .select2-search--dropdown .select2-search__field{
		border-color:<?php echo esc_html($ts_search_border_color) ?>;
	}
	body .category-dropdown .select2-results__option[aria-selected=true], 
	body .category-dropdown .select2-results__option--highlighted[aria-selected]{
		color:<?php echo esc_html($ts_search_categories_hightlighted_color) ?>;
	}
	header.ts-header .search-content input[type="text"]{
		color:<?php echo esc_html($ts_search_input_text_color) ?>;
	}
	header.ts-header .search-content ::-webkit-input-placeholder {
		color:<?php echo esc_html($ts_search_input_text_color) ?>;
	}

	header.ts-header .search-content :-moz-placeholder { /* Firefox 18- */
		color:<?php echo esc_html($ts_search_input_text_color) ?>;
	}

	header.ts-header .search-content ::-moz-placeholder {  /* Firefox 19+ */
		color:<?php echo esc_html($ts_search_input_text_color) ?>;
	}

	header.ts-header .search-content:-ms-input-placeholder {  
		color:<?php echo esc_html($ts_search_input_text_color) ?>;
	}
	header.ts-header .search-content input[type="text"]{
		background-color:<?php echo esc_html($ts_search_input_text_background_color) ?>;
	}
	
	/* ============= 4. MENU COLORS ============== */
	
	header.ts-header .header-bottom{
		border-color:<?php echo esc_html($ts_menu_top_line_color) ?>;
	}
	/* Color Vertical Menu */
	.vertical-menu-wrapper .vertical-menu-heading{
		background-color:<?php echo esc_html($ts_vertical_menu_title_background_color) ?>;
		color:<?php echo esc_html($ts_vertical_menu_title_text) ?>;
	}
	.vertical-menu-wrapper .vertical-menu-heading:before{
		color:<?php echo esc_html($ts_vertical_menu_icon_color) ?>;
	}
	.vertical-menu-wrapper:hover .vertical-menu-heading{
		background-color:<?php echo esc_html($ts_vertical_menu_title_background_color_hover) ?>;
		color:<?php echo esc_html($ts_vertical_menu_title_text_hover) ?>;
	}
	.vertical-menu-wrapper:hover .vertical-menu-heading:before{
		color:<?php echo esc_html($ts_vertical_menu_title_text_hover) ?>;
	}
	/* End Color Vertical Menu */
	.menu-wrapper nav > ul.menu > li > a,
	.widget-container .vertical-menu > ul.menu > li > a,
	.menu-wrapper nav > ul.menu > li ul .title-heading a,
	.title-heading a,
	.vertical-menu-wrapper .vertical-menu-heading{
		font-family: <?php echo esc_html($ts_menu_font) ?>, sans-serif;
	}
	.group-meta > .my-wishlist-wrapper > a,
	.group-meta > .my-account-wrapper .account-control > a,
	.group-meta > .shopping-cart-wrapper .ic-cart:before,
	.ts-menu > nav.pc-menu > ul.menu > li >.ts-menu-drop-icon,
	.menu-wrapper nav > ul.menu > li > a,
	.widget-container .vertical-menu > ul.menu > li > a,
	.menu-wrapper nav > ul.menu li.fa:before{
		color:<?php echo esc_html($ts_menu_text_color) ?>;
	}
	.group-button-icon-header .my-wishlist-wrapper a, 
	.group-button-icon-header .account-control, 
	.group-button-icon-header .my-account-wrapper .account-control > a{
		color:<?php echo esc_html($ts_menu_text_color) ?>;
	}
	.header-v3 .menu-wrapper nav > ul.menu > li > a:before,
	.group-button-icon-header > div:after{
		border-color:<?php echo esc_html($ts_menu_text_color) ?>;
	}
	.group-meta .shopping-cart-wrapper .ic-cart .cart-number,
	.group-meta > .my-wishlist-wrapper:hover > a,
	.group-meta > .my-account-wrapper .account-control:hover > a,
	.group-meta > .shopping-cart-wrapper:hover .ic-cart:before,
	/* Menu version 5 */
	#page > .menu-wrapper nav > ul.menu > li:hover > a,
	#page > .menu-wrapper nav > ul.menu li.fa:hover:before,
	#page > .menu-wrapper nav > ul.menu > li.fa.current-menu-parent:before,
	#page > .menu-wrapper nav > ul.menu > li.fa.current_page_item:before,
	#page > .menu-wrapper nav > ul.menu > li.fa.current-menu-item:before,
	#page > .menu-wrapper nav > ul.menu > li.fa.current_page_parent:before,
	#page > .menu-wrapper nav > ul.menu > li.fa.current-menu-parent:before,
	#page > .menu-wrapper nav > ul.menu > li.fa.current-menu-ancestor:before,
	#page > .menu-wrapper nav > ul.menu > li.current_page_item > a,
	#page > .menu-wrapper nav > ul.menu > li.current-menu-item > a,
	#page > .menu-wrapper nav > ul.menu > li.current_page_parent > a,
	#page > .menu-wrapper nav > ul.menu > li.current-menu-parent > a,
	#page > .menu-wrapper nav > ul.menu > li.current-menu-ancestor > a,
	#page > .menu-wrapper nav > ul.menu li.current-product_cat-ancestor > a,
	#page > .menu-wrapper nav > ul.menu > li.current_page_item >.ts-menu-drop-icon,
	#page > .menu-wrapper nav > ul.menu > li.current-menu-item >.ts-menu-drop-icon,
	#page > .menu-wrapper nav > ul.menu > li.current_page_parent >.ts-menu-drop-icon,
	#page > .menu-wrapper nav > ul.menu > li.current-menu-parent >.ts-menu-drop-icon,
	#page > .menu-wrapper nav > ul.menu > li.current-menu-ancestor >.ts-menu-drop-icon,
	#page > .menu-wrapper nav > ul.menu li.current-product_cat-ancestor >.ts-menu-drop-icon,
	.ts-menu > nav.pc-menu > ul.menu li:hover >.ts-menu-drop-icon,
	.ts-menu > nav.pc-menu > ul.menu li.current_page_item >.ts-menu-drop-icon,
	.ts-menu > nav.pc-menu > ul.menu li.current-menu-item >.ts-menu-drop-icon,
	.ts-menu > nav.pc-menu > ul.menu li.current_page_parent >.ts-menu-drop-icon,
	.ts-menu > nav.pc-menu > ul.menu li.current-menu-parent >.ts-menu-drop-icon,
	.ts-menu > nav.pc-menu > ul.menu li.current-menu-ancestor >.ts-menu-drop-icon,
	.ts-menu > nav.pc-menu > ul.menu li.current-product_cat-ancestor >.ts-menu-drop-icon,
	.ic-close-menu-button:hover,
	.menu-wrapper nav > ul.menu > li:hover > a,
	.menu-wrapper nav > ul.menu li.fa:hover:before,
	.menu-wrapper nav > ul.menu > li.fa.current-menu-parent:before,
	.menu-wrapper nav > ul.menu > li.fa.current_page_item:before,
	.menu-wrapper nav > ul.menu > li.fa.current-menu-item:before,
	.menu-wrapper nav > ul.menu > li.fa.current_page_parent:before,
	.menu-wrapper nav > ul.menu > li.fa.current-menu-parent:before,
	.menu-wrapper nav > ul.menu > li.fa.current-menu-ancestor:before,
	.menu-wrapper nav > ul.menu > li.current_page_item > a,
	.menu-wrapper nav > ul.menu > li.current-menu-item > a,
	.menu-wrapper nav > ul.menu > li.current_page_parent > a,
	.menu-wrapper nav > ul.menu > li.current-menu-parent > a,
	.menu-wrapper nav > ul.menu > li.current-menu-ancestor > a,
	.menu-wrapper nav > ul.menu li.current-product_cat-ancestor > a,
	.ts-menu-drop-icon.active:before,
	.group-button-icon-header .my-wishlist-wrapper a:hover, 
	.group-button-icon-header .my-account-wrapper .account-control > a:hover,
	.group-button-icon-header .account-control:hover{
		color:<?php echo esc_html($ts_menu_text_color_hover) ?>;
	}
	/* Vertical sub menu */
	.menu-wrapper .vertical-menu-wrapper nav > ul.menu li.fa:before,
	.widget-container .vertical-menu > ul.menu li.fa:before{
		color:<?php echo esc_html($ts_sub_menu_heading_color) ?>;
	}
	.menu-wrapper .vertical-menu-wrapper nav > ul.menu > li > a,
	header.ts-header .ts-menu .vertical-menu-wrapper > ul.menu > ul > li > a,
	.widget-container .vertical-menu > ul.menu > li > a,
	.widget-container .vertical-menu > ul.menu > ul > li > a{
		color:<?php echo esc_html($ts_sub_menu_heading_color) ?>;
	}
	.menu-wrapper .vertical-menu > ul.menu > li > .ts-menu-drop-icon,
	.widget-container .vertical-menu .ts-menu-drop-icon,
	.menu-wrapper .vertical-menu-wrapper nav > ul.menu > li:hover > a,
	header.ts-header .ts-menu .vertical-menu-wrapper > ul.menu > ul > li:hover > a,
	.menu-wrapper .vertical-menu-wrapper nav > ul.menu > li.current_page_item > a,
	.menu-wrapper .vertical-menu-wrapper nav > ul.menu > li.current-menu-item > a,
	.menu-wrapper .vertical-menu-wrapper nav > ul.menu > li.current_page_parent > a,
	.menu-wrapper .vertical-menu-wrapper nav > ul.menu > li.current-menu-parent > a,
	.menu-wrapper .vertical-menu-wrapper nav > ul.menu > li.current-menu-ancestor > a,
	.menu-wrapper .vertical-menu-wrapper nav > ul.menu > li.current-product_cat-ancestor > a,
	.widget-container .vertical-menu > ul.menu > li:hover > a,
	.widget-container .vertical-menu > ul.menu > ul > li:hover > a,
	.widget-container .vertical-menu > ul.menu > li.current_page_item > a,
	.widget-container .vertical-menu > ul.menu > li.current-menu-item > a,
	.widget-container .vertical-menu > ul.menu > li.current_page_parent > a,
	.widget-container .vertical-menu > ul.menu > li.current-menu-parent > a,
	.widget-container .vertical-menu > ul.menu > li.current-menu-ancestor > a,
	.widget-container .vertical-menu > ul.menu > li.current-product_cat-ancestor > a{
		color:<?php echo esc_html($ts_sub_menu_heading_color) ?>;
	}
	.menu-wrapper .vertical-menu > ul.menu > li:hover > .ts-menu-drop-icon,
	.widget-container .vertical-menu > ul.menu > li:hover > .ts-menu-drop-icon,
	.widget-container .vertical-menu > ul.menu > li.current_page_item > .ts-menu-drop-icon,
	.widget-container .vertical-menu > ul.menu > li.current-menu-item > .ts-menu-drop-icon,
	.widget-container .vertical-menu > ul.menu > li.current_page_parent > .ts-menu-drop-icon,
	.widget-container .vertical-menu > ul.menu > li.current-menu-parent > .ts-menu-drop-icon,
	.widget-container .vertical-menu > ul.menu > li.current-menu-ancestor > .ts-menu-drop-icon,
	.widget-container .vertical-menu > ul.menu > li.current-product_cat-ancestor > .ts-menu-drop-icon,
	.widget-container .vertical-menu > ul.menu li.fa:hover:before,
	.widget-container .vertical-menu > ul.menu > li.fa.current-menu-parent:before,
	.widget-container .vertical-menu > ul.menu > li.fa.current_page_item:before,
	.widget-container .vertical-menu > ul.menu > li.fa.current-menu-item:before,
	.widget-container .vertical-menu > ul.menu > li.fa.current_page_parent:before,
	.widget-container .vertical-menu > ul.menu > li.fa.current-menu-parent:before,
	.widget-container .vertical-menu > ul.menu > li.fa.current-menu-ancestor:before,
	.menu-wrapper .vertical-menu-wrapper nav > ul.menu li.fa:hover:before,
	.menu-wrapper .vertical-menu-wrapper nav > ul.menu > li.fa.current-menu-parent:before,
	.menu-wrapper .vertical-menu-wrapper nav > ul.menu > li.fa.current_page_item:before,
	.menu-wrapper .vertical-menu-wrapper nav > ul.menu > li.fa.current-menu-item:before,
	.menu-wrapper .vertical-menu-wrapper nav > ul.menu > li.fa.current_page_parent:before,
	.menu-wrapper .vertical-menu-wrapper nav > ul.menu > li.fa.current-menu-parent:before,
	.menu-wrapper .vertical-menu-wrapper nav > ul.menu > li.fa.current-menu-ancestor:before{
		color:<?php echo esc_html($ts_sub_menu_heading_color) ?>;
	}
	
	/* MENU PC SUB */
	.menu-wrapper .vertical-menu > ul.menu > li, 
	.menu-wrapper nav > ul.menu > li > ul.sub-menu,
	.widget-container .vertical-menu > ul.menu > li > ul.sub-menu,
	.menu-wrapper .vertical-menu > ul.menu > li li ul.sub-menu:before,
	.menu-wrapper nav > ul.menu > li li ul.sub-menu:before, 
	.widget-container .vertical-menu > ul.menu > li li ul.sub-menu:before,
	.vertical-menu-wrapper .vertical-menu{
		background-color:<?php echo esc_html($ts_sub_menu_background_color) ?>;
	}
	
	/* Menu sub heading */
	.menu-wrapper nav > ul.menu ul.sub-menu h1,
	.menu-wrapper nav > ul.menu ul.sub-menu h2,
	.menu-wrapper nav > ul.menu ul.sub-menu h3,
	.menu-wrapper nav > ul.menu ul.sub-menu h4,
	.menu-wrapper nav > ul.menu ul.sub-menu h5,
	.menu-wrapper nav > ul.menu ul.sub-menu h6,
	.menu-wrapper nav > ul.menu ul.sub-menu .h1,
	.menu-wrapper nav > ul.menu ul.sub-menu .h2,
	.menu-wrapper nav > ul.menu ul.sub-menu .h3,
	.menu-wrapper nav > ul.menu ul.sub-menu .h4,
	.menu-wrapper nav > ul.menu ul.sub-menu .h5,
	.menu-wrapper nav > ul.menu ul.sub-menu .h6,
	.widget-container .vertical-menu > ul.menu ul.sub-menu h1,
	.widget-container .vertical-menu > ul.menu ul.sub-menu h2,
	.widget-container .vertical-menu > ul.menu ul.sub-menu h3,
	.widget-container .vertical-menu > ul.menu ul.sub-menu h4,
	.widget-container .vertical-menu > ul.menu ul.sub-menu h5,
	.widget-container .vertical-menu > ul.menu ul.sub-menu h6,
	.widget-container .vertical-menu > ul.menu ul.sub-menu .h1,
	.widget-container .vertical-menu > ul.menu ul.sub-menu .h2,
	.widget-container .vertical-menu > ul.menu ul.sub-menu .h3,
	.widget-container .vertical-menu > ul.menu ul.sub-menu .h4,
	.widget-container .vertical-menu > ul.menu ul.sub-menu .h5,
	.widget-container .vertical-menu > ul.menu ul.sub-menu .h6,
	h1.wpb_heading,
	h2.wpb_heading,
	h3.wpb_heading,
	h4.wpb_heading,
	h5.wpb_heading,
	h6.wpb_heading{
		color:<?php echo esc_html($ts_sub_menu_heading_color) ?>;
	}

	/* Menu sub text */
	.menu-wrapper nav > ul.menu ul.sub-menu > li > a,
	.menu-wrapper nav div.list-link li > a,
	.menu-wrapper nav > ul.menu li.widget_nav_menu li > a,
	.widget-container .vertical-menu > ul.menu ul.sub-menu > li > a,
	.widget-container .vertical-menu div.list-link li > a,
	.widget-container .vertical-menu > ul.menu li.widget_nav_menu li > a{
		color:<?php echo esc_html($ts_sub_menu_text_color) ?>;
		font-family:<?php echo esc_html($ts_sub_menu_font) ?>, sans-serif;
	}
	.ts-menu > nav.pc-menu > ul.menu ul li >.ts-menu-drop-icon{
		color:<?php echo esc_html($ts_sub_menu_text_color) ?>;
	}
	/* Menu sub a hover */
	.ts-menu > nav.pc-menu > ul.menu ul li:hover >.ts-menu-drop-icon,
	.ts-menu > nav.pc-menu > ul.menu ul li.current_page_item >.ts-menu-drop-icon,
	.ts-menu > nav.pc-menu > ul.menu ul li.current-menu-item >.ts-menu-drop-icon,
	.ts-menu > nav.pc-menu > ul.menu ul li.current_page_parent >.ts-menu-drop-icon,
	.ts-menu > nav.pc-menu > ul.menu ul li.current-menu-parent >.ts-menu-drop-icon,
	.ts-menu > nav.pc-menu > ul.menu ul li.current-menu-ancestor >.ts-menu-drop-icon,
	.ts-menu > nav.pc-menu > ul.menu ul li.current-product_cat-ancestor >.ts-menu-drop-icon,
	.vertical-menu-wrapper > .vertical-menu > ul.menu ul li:hover >.ts-menu-drop-icon,
	.vertical-menu-wrapper > .vertical-menu > ul.menu li.current_page_item >.ts-menu-drop-icon,
	.vertical-menu-wrapper > .vertical-menu > ul.menu li.current-menu-item >.ts-menu-drop-icon,
	.vertical-menu-wrapper > .vertical-menu > ul.menu li.current_page_parent >.ts-menu-drop-icon,
	.vertical-menu-wrapper > .vertical-menu > ul.menu li.current-menu-parent >.ts-menu-drop-icon,
	.vertical-menu-wrapper > .vertical-menu > ul.menu li.current-menu-ancestor >.ts-menu-drop-icon,
	.vertical-menu-wrapper > .vertical-menu > ul.menu ul li.current-product_cat-ancestor >.ts-menu-drop-icon,
	.widget-container .vertical-menu > ul.menu li:hover > .ts-menu-drop-icon,
	.widget-container .vertical-menu > ul.menu li.current_page_item > .ts-menu-drop-icon,
	.widget-container .vertical-menu > ul.menu li.current-menu-item > .ts-menu-drop-icon,
	.widget-container .vertical-menu > ul.menu li.current_page_parent > .ts-menu-drop-icon,
	.widget-container .vertical-menu > ul.menu li.current-menu-parent > .ts-menu-drop-icon,
	.widget-container .vertical-menu > ul.menu li.current-menu-ancestor > .ts-menu-drop-icon,
	.widget-container .vertical-menu > ul.menu li.current-product_cat-ancestor > .ts-menu-drop-icon,
	.menu-wrapper nav > ul.menu ul.sub-menu > li > a:hover,
	.menu-wrapper nav div.list-link li > a:hover,
	.menu-wrapper nav > ul.menu li.widget_nav_menu li > a:hover,
	.menu-wrapper nav > ul.menu li.widget_nav_menu li.current-menu-item > a,
	.menu-wrapper nav > ul.menu ul.sub-menu li.current-menu-item > a,
	.menu-wrapper nav > ul.menu ul.sub-menu li.current_page_parent > a,
	.menu-wrapper nav > ul.menu ul.sub-menu li.current-menu-parent > a,
	.menu-wrapper nav > ul.menu ul.sub-menu li.current_page_item > a,
	.menu-wrapper nav > ul.menu ul.sub-menu li.current-menu-ancestor > a,
	.menu-wrapper nav > ul.menu ul.sub-menu li.current-product_cat-ancestor > a,
	.widget-container .vertical-menu > ul.menu ul.sub-menu > li > a:hover,
	.widget-container .vertical-menu div.list-link li > a:hover,
	.widget-container .vertical-menu > ul.menu li.widget_nav_menu li > a:hover,
	.widget-container .vertical-menu > ul.menu li.widget_nav_menu li.current-menu-item > a,
	.widget-container .vertical-menu > ul.menu ul.sub-menu li.current-menu-item > a,
	.widget-container .vertical-menu > ul.menu ul.sub-menu li.current_page_parent > a,
	.widget-container .vertical-menu > ul.menu ul.sub-menu li.current-menu-parent > a,
	.widget-container .vertical-menu > ul.menu ul.sub-menu li.current_page_item > a,
	.widget-container .vertical-menu > ul.menu ul.sub-menu li.current-menu-ancestor > a,
	.widget-container .vertical-menu > ul.menu ul.sub-menu li.current-product_cat-ancestor > a{
		color:<?php echo esc_html($ts_sub_menu_text_color_hover) ?>;
	}

	/* ============= 5. FOOTER COLORS ============== */
	
	/* Subscription */
	footer .style-fullwidth .feedburner-subscription .subscribe-email,
	footer .feedburner-subscription input[type="text"],
	footer .mc4wp-form-fields .mailchimp-input,
	footer .mc4wp-form-fields .mailchimp-input2 > input[type="email"]{
		background-color:<?php echo esc_html($ts_footer_subscription_background_color) ?>;
	}
	footer .feedburner-subscription input[type="text"],
	footer .mc4wp-form-fields input[type="email"],
	footer .mc4wp-form-fields input[type="email"]:focus{
		color:<?php echo esc_html($ts_footer_subscription_text_color) ?>;
	}
	footer .feedburner-subscription ::-webkit-input-placeholder,
	footer .mc4wp-form-fields ::-webkit-input-placeholder {
		color:<?php echo esc_html($ts_footer_subscription_text_color) ?>;
	}

	footer .feedburner-subscription :-moz-placeholder,
	footer .mc4wp-form-fields :-moz-placeholder { /* Firefox 18- */
		color:<?php echo esc_html($ts_footer_subscription_text_color) ?>;
	}

	footer .feedburner-subscription ::-moz-placeholder,
	footer .mc4wp-form-fields ::-moz-placeholder {  /* Firefox 19+ */
		color:<?php echo esc_html($ts_footer_subscription_text_color) ?>;
	}

	footer .feedburner-subscription :-ms-input-placeholder,
	footer .mc4wp-form-fields :-ms-input-placeholder {  
		color:<?php echo esc_html($ts_footer_subscription_text_color) ?>;
	}
	/* Social */
	.ts-social-icons li a,
	footer#colophon .ts-social-icons a{
		border-color:<?php echo esc_html($ts_footer_social_icon_border_color) ?>;
		color:<?php echo esc_html($ts_footer_social_icon_color) ?>;
	}
	footer .end-footer{
		background-color:<?php echo esc_html($ts_footer_end_background_color) ?>;
	}
	footer .footer-container,
	footer .images.loading:before,
	footer .header-product-categories.loading:before,
	footer .tab-content.loading:before,
	footer .tab-contents.loading:before,
	footer .list-posts article .gallery.loading:before,
	footer .widget-container .gallery.loading figure:before,
	footer .related-posts.loading .content-wrapper:before,
	footer .ts-product .content-wrapper.loading:before,
	footer .thumbnail.loading:before,
	footer .thumbnails.loading:before,
	footer .ts-logo-slider-wrapper.loading .content-wrapper:before,
	footer .ts-products-widget .ts-products-widget-wrapper.loading:before,
	footer .ts-product-deals-widget .ts-product-deals-slider-wrapper.loading:before,
	footer .ts-blogs-widget .ts-blogs-widget-wrapper.loading:before,
	footer .ts-recent-comments-widget .ts-recent-comments-widget-wrapper.loading:before,
	footer .blogs article a.gallery.loading:before,
	footer .ts-blogs-wrapper.loading .content-wrapper:before,
	footer .ts-testimonial-wrapper.loading:before,
	footer .ts-twitter-slider.loading:before,
	footer .single .gallery.loading:before,
	footer .ts-portfolio-wrapper.loading:before,
	footer .ts-product-category-slider-wrapper .content-wrapper.loading:before,
	footer .ts-product-in-category-tab-wrapper .column-logos.loading:before,
	footer .ts-product-in-category-tab-wrapper .column-products.loading:before{
		background-color:<?php echo esc_html($ts_footer_background_color) ?>;
	}
	footer .widget_calendar caption{
		color:<?php echo esc_html($ts_footer_background_color) ?>;
	}
	footer#colophon,
	footer#colophon a,
	footer#colophon dt,
	footer .mc4wp-form-fields label,
	.widget_calendar th,
	footer .comment_list_widget .comment-body,
	footer .ts-social-icons .background-big li .ts-tooltip{
		color:<?php echo esc_html($ts_footer_text_color) ?>;
	}
	footer .mc4wp-form-fields h2.title,
	footer .mc4wp-form-fields > h2.title,
	footer#colophon a:hover,
	footer#colophon h1,
	footer#colophon h2,
	footer#colophon h3,
	footer#colophon h4,
	footer#colophon h5,
	footer#colophon h6,
	footer#colophon .h1,
	footer#colophon .h2,
	footer#colophon .h3,
	footer#colophon .h4,
	footer#colophon .h5,
	footer#colophon .h6,
	footer#colophon h1.wpb_heading,
	footer#colophon h2.wpb_heading,
	footer#colophon h3.wpb_heading,
	footer#colophon h4.wpb_heading,
	footer#colophon h5.wpb_heading,
	footer#colophon h6.wpb_heading
	footer#colophon a:hover,
	footer#colophon .woocommerce ul.cart_list li span.amount, 
	footer#colophon .woocommerce ul.product_list_widget li span.amount, 
	footer#colophon .ts-blogs-widget-wrapper ul li a,
	footer#colophon .ts-recent-comments-widget-wrapper ul li a,
	.info-company li{
		color:<?php echo esc_html($ts_footer_heading_color) ?>;
	}
	footer .widget_calendar caption{
		background-color:<?php echo esc_html($ts_footer_heading_color) ?>;
	}
	/* Footer End */
	footer#colophon .end-footer,
	footer#colophon .end-footer a{
		color:<?php echo esc_html($ts_footer_end_text_color) ?>;
	}
	footer#colophon .end-footer a:hover{
		color:<?php echo esc_html($ts_footer_end_text_hover_color) ?>;
	}
	
	/* ============= 6. PRODUCT COLORS ============== */
	
	.ts-product-deals-slider-wrapper .counter-wrapper > div,
	.counter-wrapper > div{
		background-color:<?php echo esc_html($ts_product_hotdeal_background_color) ?>;
		border-color:<?php echo esc_html($ts_product_hotdeal_border_color) ?>;
	}
	.counter-wrapper > div:after{
		border-color:<?php echo esc_html($ts_product_hotdeal_border_color) ?>;
	}
	.counter-wrapper > div .number-wrapper .number{
		color:<?php echo esc_html($ts_product_hotdeal_text_color) ?>;
	}
	.counter-wrapper > div .ref-wrapper{
		background-color:<?php echo esc_html($ts_product_hotdeal_ref_background_color) ?>;
		color:<?php echo esc_html($ts_product_hotdeal_ref_text_color) ?>;
	}
	/* Rating Product */
	.woocommerce .products .star-rating,
	.star-rating:before, 
	.pp_woocommerce .star-rating:before, 
	.woocommerce .star-rating:before, 
	.testimonial-content .rating:before{
		color:<?php echo esc_html($ts_rating_color) ?>;
	}
	.star-rating span:before,
	.pp_woocommerce .star-rating span:before, 
	.woocommerce .star-rating span:before, 
	.testimonial-content .rating span:before{
		color:<?php echo esc_html($ts_rating_color) ?>;
	}
	/* Name Product */
	#ts-search-result-container ul li a,
	#ts-search-result-container .view-all-wrapper a,
	.widget-container ul.product_list_widget li .ts-wg-meta > a,
	.woocommerce .widget-container ul.product_list_widget li .ts-wg-meta > a,
	.widget.ts-products-widget .ts-wg-meta > a,
	header.ts-header .header-top h3.product-name > a,
	h3.product-name > a, 
	h3.product-name,
	.product-name a,
	.single-navigation > div .product-info,
	.group_table a,
	body #yith-woocompare table.compare-list tr.title td{
		color:<?php echo esc_html($ts_product_name_text_color) ?>;
	}
	/* Button Product */
	.single-portfolio .ic-like,
	.meta-wrapper div.wishlist a,
	.meta-wrapper div.compare a,
	.woocommerce .summary div.yith-wcwl-add-to-wishlist a,
	.woocommerce .product .meta-wrapper a.added_to_cart,
	.woocommerce .product .meta-wrapper a.button,
	.woocommerce .product .meta-wrapper .wishlist a,
	html body #yith-woocompare table.compare-list tr.add-to-cart td a{
		background-color:<?php echo esc_html($ts_product_button_background_color) ?>;
		border-color:<?php echo esc_html($ts_product_button_border_color) ?>;
		color:<?php echo esc_html($ts_product_button_text_color) ?>;
	}
	.single-portfolio .ic-like:hover,
	.quickshop .button-tooltip,
	.wishlist .button-tooltip,
	.compare .button-tooltip,
	.woocommerce .summary div.yith-wcwl-add-to-wishlist a:hover,
	.woocommerce .summary .compare:hover,
	/* Added hover */
	.woocommerce .product .meta-wrapper a.added_to_cart:hover, 
	.woocommerce .product .meta-wrapper a.button:hover,
	.woocommerce .product .meta-wrapper a.added_to_cart:focus, 
	.woocommerce .product .meta-wrapper a.button:focus,
	.woocommerce .product .meta-wrapper .wishlist a:hover,
	.woocommerce .product .meta-wrapper .wishlist a:focus,
	.meta-wrapper div.wishlist a:hover,
	.meta-wrapper div.compare a:hover,
	.ts-product-deals-widget .loop-add-to-cart a:hover{
		background-color:<?php echo esc_html($ts_product_button_background_color_hover) ?>;
		border-color:<?php echo esc_html($ts_product_button_border_color_hover) ?>;
		color:<?php echo esc_html($ts_product_button_text_color_hover) ?>;
	}
	.quickshop .button-tooltip:after, 
	.wishlist .button-tooltip:after, 
	.compare .button-tooltip:after{
		border-top-color:<?php echo esc_html($ts_product_button_background_color_hover) ?>;
	}

	/* Label Product */
	.woocommerce .product .product-label .onsale,
	.pp_woocommerce div.product .images .product-label span.onsale{
		color:<?php echo esc_html($ts_product_sale_label_text_color) ?>;
		background:<?php echo esc_html($ts_product_sale_label_background_color) ?>;
	}
	.woocommerce .product .product-label .onsale.amount,
	.pp_woocommerce div.product .images .product-label span.onsale.amount{
		color:<?php echo esc_html($ts_product_sale_label_text_color) ?>;
	}
	.woocommerce .product .product-label .new,
	.pp_woocommerce div.product .images .product-label span.new{
		color:<?php echo esc_html($ts_product_new_label_text_color) ?>;
		background:<?php echo esc_html($ts_product_new_label_background_color) ?>;
	}
	.woocommerce .product .product-label .featured,
	.pp_woocommerce div.product .images .product-label span.featured{
		color:<?php echo esc_html($ts_product_feature_label_text_color) ?>;
		background:<?php echo esc_html($ts_product_feature_label_background_color) ?>;
	}
	.woocommerce .product .product-label .out-of-stock,
	.pp_woocommerce div.product .images .product-label span.out-of-stock{
		color:<?php echo esc_html($ts_product_outstock_label_text_color) ?>;
		background:<?php echo esc_html($ts_product_outstock_label_background_color) ?>;
	}
	/* Amount Product */
	.amount,
	.woocommerce .products .product .price,
	.woocommerce .products .product .amount,
	.woocommerce div.product p.price, 
	.woocommerce div.product span.price, 
	.single-navigation > div .product-info .price,
	/* Compare table */
	body #yith-woocompare table.compare-list tr.price td{
		color:<?php echo esc_html($ts_product_price_color) ?>;
	}
	ins .amount,
	.cart-list .quantity,
	.woocommerce .products .product ins .amount{
		color:<?php echo esc_html($ts_product_sale_price_color) ?>;
	}
	
	/* ============= 7. WOOCOMMERCE MESSAGE COLORS ============== */
	
	.woocommerce-message,
	.woocommerce .woocommerce-message,
	.alert.alert-success,
	div.wpcf7-mail-sent-ok,
	.vc_color-alert-success.vc_message_box{
		color:<?php echo esc_html($ts_message_text_color) ?>;
		background:transparent;
		border-color:<?php echo esc_html($ts_message_border_color) ?>;
	}
	.woocommerce-message a,
	.woocommerce .woocommerce-message a{
		color:<?php echo esc_html($ts_message_text_color) ?>;
	}
	.woocommerce-message:before,
	.woocommerce .woocommerce-message:before,
	.alert.alert-success:before{
		color:<?php echo esc_html($ts_message_border_color) ?>;
	}
	.woocommerce-info,
	.woocommerce .woocommerce-info,
	.alert.alert-info,
	.vc_color-alert-info.vc_message_box{
		color:<?php echo esc_html($ts_info_message_text_color) ?>;
		background:transparent;
		border-color:<?php echo esc_html($ts_info_message_border_color) ?>;
	}
	.woocommerce-info a, 
	.woocommerce .woocommerce-info a{
		color:<?php echo esc_html($ts_info_message_text_color) ?>;
	}
	.woocommerce-info:before,
	.woocommerce .woocommerce-info:before,
	.alert.alert-info:before{
		color:<?php echo esc_html($ts_info_message_border_color) ?>;
	}
	.woocommerce-error,
	.woocommerce .woocommerce-error,
	.alert.alert-error,
	div.wpcf7-validation-errors,
	div.wpcf7-mail-sent-ng,
	.vc_color-alert-danger.vc_message_box{
		border-color:<?php echo esc_html($ts_error_message_border_color) ?>;
		background:transparent;
		color:<?php echo esc_html($ts_error_message_text_color) ?>;
	}
	.woocommerce-error a,
	.woocommerce .woocommerce-error a{
		color:<?php echo esc_html($ts_error_message_text_color) ?>;
	}
	.woocommerce-error:before,
	.woocommerce .woocommerce-error:before,
	.alert.alert-error:before{
		color:<?php echo esc_html($ts_error_message_border_color) ?>;
	}
	.alert.alert-warning,
	div.wpcf7-spam-blocked,
	.vc_color-alert-warning.vc_message_box{
		color:<?php echo esc_html($ts_warning_message_text_color) ?>;
		background:transparent;
		border-color:<?php echo esc_html($ts_warning_message_border_color) ?>;
	}
	.alert.alert-warning:before{
		color:<?php echo esc_html($ts_warning_message_text_color) ?>;
	}
	.alert.alert-warning a,
	div.wpcf7-spam-blocked a,
	.vc_color-alert-warning.vc_message_box a{
		color:<?php echo esc_html($ts_warning_message_border_color) ?>;
	}
	.woocommerce-message a.button,
	.woocommerce .woocommerce-message a.button{
		color:<?php echo esc_html($ts_message_border_color) ?>;
		background:transparent;
		border-color:<?php echo esc_html($ts_message_border_color) ?>;
	}
	.woocommerce-message a.button:hover,
	.woocommerce .woocommerce-message a.button:hover{
		background:<?php echo esc_html($ts_message_border_color) ?>;
		color:#ffffff;
		border-color:<?php echo esc_html($ts_message_border_color) ?>;
	}
	.woocommerce-error a.button,
	.woocommerce .woocommerce-error a.button{
		border-color:<?php echo esc_html($ts_error_message_text_color) ?>;
		background:transparent;
		color:<?php echo esc_html($ts_error_message_text_color) ?>;
	}
	.woocommerce-error a.button:hover,
	.woocommerce .woocommerce-error a.button:hover{
		background:<?php echo esc_html($ts_error_message_border_color) ?>;
		color:#ffffff;
		border-color:<?php echo esc_html($ts_error_message_border_color) ?>;
	}
	.woocommerce-info a.button,
	.woocommerce .woocommerce-info a.button{
		color:<?php echo esc_html($ts_info_message_border_color) ?>;
		background:transparent;
		border-color:<?php echo esc_html($ts_info_message_border_color) ?>;
	}
	.woocommerce-info a.button:hover,
	.woocommerce .woocommerce-info a.button:hover{
		background:<?php echo esc_html($ts_info_message_border_color) ?>;
		color:#ffffff;
		border-color:<?php echo esc_html($ts_info_message_border_color) ?>;
	}
	@media only screen and (max-device-width : 1229px){
		.list-posts .ts-social-sharing li a{
			color:<?php echo esc_html($ts_text_color) ?>;/* text default color */
		}
	}
	@media only screen and (max-width : 1229px){
		.list-posts .ts-social-sharing li a{
			color:<?php echo esc_html($ts_text_color) ?>;/* text default color */
		}
		.portfolio-inner h3 a{
			color:<?php echo esc_html($ts_secondary_color) ?>; /* primary text color */
		}
		.portfolio-inner h3 a:hover{
			color:<?php echo esc_html($ts_primary_color) ?>;
		}
		.portfolio-inner .icon-group a{
			background-color:<?php echo esc_html($ts_text_color_in_bg_second) ?>;
			color:<?php echo esc_html($ts_button_text_color) ?>;
			border-color:<?php echo esc_html($ts_button_border_color) ?>;
		}
	}
	
	/* ============= 8. FONT SIZE ============== */
	
	html, 
	body,
	.mc4wp-form-fields label,
	.woocommerce .products .product .short-description,
	ul li .ts-megamenu-container,
	.comment-text,
	.shopping-cart-wrapper .ts-tiny-cart-wrapper,
	.woocommerce .order_details li,  
	.woocommerce table.my_account_orders td, 
	.comment_list_widget .comment-body,
	#bbpress-forums,
	.woocommerce ul.products li.product .price del,
	.woocommerce ul.products li.product .price,
	.shopping-cart-wrapper .form-content > label,
	.widget_calendar th, 
	.widget_calendar td,
	.woocommerce .widget-container .price_slider_amount .price_label,
	#ts-search-result-container ul li a,
	#ts-search-result-container .view-all-wrapper a,
	body .rev_slider_wrapper .rev-btn.ts-button,
	body rs-module-wrap .rev-btn.ts-button,
	#lang_sel_click > ul li a,
	.wpml-ls > ul > li.wpml-ls-item a,
	.header-currency ul li a:not(.button),
	select option,
	.woocommerce-product-rating .woocommerce-review-link,
	.woocommerce #reviews #comments ol.commentlist li .comment-text p.meta,
	.yith-wcwl-share h4.yith-wcwl-share-title,
	.woocommerce-cart .cart-collaterals .cart_totals table td, 
	.woocommerce-cart .cart-collaterals .cart_totals table th,
	.woocommerce table.wishlist_table,
	body #yith-woocompare table.compare-list tr.image td, 
	body #yith-woocompare table.compare-list tr.price td,
	h3 > label,
	body.wpb-js-composer .vc_tta.vc_general,
	header.ts-header .header-v3 .menu-wrapper .ts-menu,
	.dokan-category-menu .sub-block h3,
	.woocommerce table.shop_table.my_account_orders,
	.feature-content .feature-excerpt,
	.testimonial-content .byline,
	.testimonial-content .content,
	/* Forum */
	#bbpress-forums div.bbp-forum-title h3, 
	#bbpress-forums div.bbp-topic-title h3, 
	#bbpress-forums div.bbp-reply-title h3,
	/* COMPARE TABLE */
	body #yith-woocompare table.compare-list,
	body #yith-woocompare table.compare-list tr.title td
	{
		font-size:<?php echo esc_html($ts_font_size_body) ?>px;
		line-height:<?php echo esc_html($ts_line_height_body) ?>px;
	}
	.post_list_widget blockquote{
		font-size:<?php echo esc_html($ts_font_size_body) ?>px;
	}
	.ts-shortcode,
	.shop_table th,
	.checkout-login-coupon-wrapper, 
	.woocommerce .checkout .col2-set,
	.woocommerce-MyAccount-content{
		line-height:<?php echo esc_html($ts_line_height_body) ?>px;
	}
	blockquote{
		font-size:<?php echo esc_html($ts_font_size_body) + 1 ?>px;
		line-height:<?php echo esc_html($ts_line_height_body) + 4 ?>px;
	}
	.dokan-form-control,
	.vc_col-sm-12 .widget_categories ul li a, 
	.vc_col-sm-12 .widget_product_categories ul li a, 
	.vc_col-sm-12 .ts-product-categories-widget ul li a,
	.feature-content .feature-header,
	.font-normal .description,
	.single-navigation > div .product-info > div > span:first-child,
	.ts-header .ts-search-by-category div.select-category *,
	input, textarea, keygen, select,
	.woocommerce form .form-row .select2-container,
	h3.product-name > a, 
	h3.product-name{
		font-size:<?php echo esc_html($ts_font_size_body) ?>px;
	}
	footer .widget_product_tag_cloud .tagcloud a,
	footer .widget_tag_cloud .tagcloud a{
		font-size:<?php echo esc_html($ts_font_size_body) ?>px !important;
	}
	.ts-portfolio-wrapper .filter-bar li,
	.ts-product .shop-more-button,
	.ts-product .shop-more-button:after,
	.ts-product .shop-more-button:before{
		font-size:<?php echo esc_html($ts_font_size_body) + 1 ?>px;
	}
	h4 > a,
	.column-tabs .tabs li,
	.font-big .description,
	.list .product h3.product-name > a,
	.vc_progress_bar .vc_single_bar .vc_label,
	.ts-team-member header > h3,
	.ts-team-member header > h3 a,
	.woocommerce-account div.woocommerce h3,
	.woocommerce-account .addresses h2,
	.woocommerce-customer-details .addresses h2,
	.style-fullwidth .feedburner-subscription input[type="text"],
	.mc4wp-form-fields .mailchimp-input input[type="email"]{
		font-size:<?php echo esc_html($ts_font_size_body) + 1 ?>px;
	}
	p > label,
	fieldset div > label,
	.bbp-login-links a{
		font-size:<?php echo esc_html($ts_font_size_body) - 1 ?>px;
	}
	.list-posts article .entry-meta > span,
	article.single .entry-meta > span,
	.post_list_widget .entry-meta > span,
	.entry-meta span,
	.comment_list_widget .comment-meta .meta,
	.post_list_widget .date-time,
	.comments-area .comment-meta > span,
	.pp_woocommerce div.product form.cart .variations td .reset_variations, 
	.woocommerce div.product form.cart .variations td .reset_variations,
	.entry-summary > div.author{
		font-size:<?php echo esc_html($ts_font_size_body) - 2 ?>px;
	}
	h1,
	.h1,
	.fix-size-heading h2,
	.banner-content h1
	{
		font-size:<?php echo esc_html($ts_font_size_heading_1); ?>px;
		line-height:<?php echo esc_html($ts_line_height_heading_1); ?>px;
	}
	.ts-heading h1,
	h2,
	.h2,
	h1.wpb_heading,
	.banner-content h2,
	.breadcrumb-title-wrapper .breadcrumb-title h1
	{
		font-size:<?php echo esc_html($ts_font_size_heading_2); ?>px;
		line-height:<?php echo esc_html($ts_line_height_heading_2); ?>px;
	}
	.mc4wp-form-fields .mailchimp-wrapper h2.title,
	.woocommerce-MyAccount-content h2,
	.woocommerce-order-details h2,
	.ts-heading h2,
	h3,
	.h3,
	h2.wpb_heading,
	.banner-content h3,
	body .ts-footer-block .style-fullwidth .widget h2.widgettitle,
	.ts-shortcode .shortcode-heading-wrapper .heading-title,
	.pp_woocommerce div.product .product_title, 
	.woocommerce div.product .product_title,
	.heading-wrapper > h2,
	.heading-shortcode > h3,
	.theme-title > h3,
	.related > h2,
	.entry-content h1.blog-title,
	.single-portfolio .info-content .entry-title,
	.woocommerce .cross-sells > h2,
	.woocommerce .upsells > h2,
	.woocommerce .related > h2,
	.woocommerce-account div.woocommerce > h2,
	#customer_login .col-1 > h2,
	#customer_login .col-2 > h2,
	#order_review_heading,
	.woocommerce-billing-fields > h3,
	#bbpress-forums #bbp-user-wrapper h2.entry-title
	{
		font-size:<?php echo esc_html($ts_font_size_heading_3); ?>px;
		line-height:<?php echo esc_html($ts_line_height_heading_3); ?>px;
	}
	.font-big h3{
		font-size:<?php echo esc_html($ts_font_size_heading_3) + 6 ?>px;/* 24px + 4 */
		line-height:<?php echo esc_html($ts_line_height_heading_3) + 4 ?>px;
	}
	.cart-collaterals .cart_totals > h2,
	.ts-banner header .discount,
	.ts-shortcode.title-small .shortcode-heading-wrapper .heading-title,
	.ts-list-of-product-categories-wrapper .heading-title,
	.wp-caption p.wp-caption-text,
	.product-subtotal .amount,
	.dropdown-footer .amount,
	.widget_shopping_cart .total .amount,
	body.woocommerce > h1,
	.ts-feature-wrapper .feature-header h3,
	body div.ppt,
	.widget.ts-products-widget > .widgettitle,
	.woocommerce-account .woocommerce-MyAccount-navigation li a,
	.woocommerce #reviews #reply-title, 
	.woocommerce #reviews #comments > h2, 
	.widget_shopping_cart_content p.total strong,
	.widget-title,
	body .ts-footer-block .widget .widgettitle,
	.column-tabs .heading-tab h3,
	.row-heading-tabs .heading-tab .heading-title,
	.ts-heading h3,
	.breadcrumb-title-wrapper.breadcrumb-v1 .breadcrumb-title h1,
	h3.wpb_heading,
	.woocommerce div.wishlist-title h2,
	.ts-price-table .during,
	.portfolio-inner h3,
	.style-normal .feedburner-subscription h2,
	.mc4wp-form-fields > h2.title,
	h3.entry-title > a{
		font-size:<?php echo esc_html($ts_font_size_heading_4) - 2  ?>px;
		line-height:<?php echo esc_html($ts_line_height_heading_4) - 2; ?>px;
	}
	.woocommerce div.product .woocommerce-tabs ul.tabs li a,
	body.wpb-js-composer .vc_tta.vc_general.vc_tta-tabs-position-left .vc_tta-tab a, 
	body.wpb-js-composer .vc_tta.vc_general.vc_tta-tabs-position-right .vc_tta-tab a,
	.vc_tta-accordion .vc_tta-panel .vc_tta-panel-title a,
	.vc_toggle_default .vc_toggle_title h4,
	body.wpb-js-composer .vc_tta.vc_general .vc_tta-tab > a{
		font-size:<?php echo esc_html($ts_font_size_heading_4) - 2  ?>px;
	}
	h4,.h4,
	.entry-info h3.entry-title > a,
	.banner-content h4{
		font-size:<?php echo esc_html($ts_font_size_heading_4); ?>px;
		line-height:<?php echo esc_html($ts_line_height_heading_4); ?>px;
	}
	h5,.h5,
	.ts-heading h4,
	h4.wpb_heading,
	h5.wpb_heading{
		font-size:<?php echo esc_html($ts_font_size_heading_5); ?>px;
		line-height:<?php echo esc_html($ts_line_height_heading_5); ?>px;
	}
	h6,.h6,
	.vc_message_box .h4,
	h6.wpb_heading,
	.member-name h3,
	.ts-milestone h3.subject,
	.ts-testimonial-wrapper.text-light .testimonial-content h4 > a,
	.ts-twitter-slider.text-light .twitter-content h4 > a{
		font-size:<?php echo esc_html($ts_font_size_heading_6); ?>px;
		line-height:<?php echo esc_html($ts_line_height_heading_6); ?>px;
	}
	/*----------------------------------------------------------------*/
	/*- HEADER -------------------------------------------------------*/
	.info-desc,
	.my-account-wrapper .account-control > a,
	.my-wishlist-wrapper a,
	#lang_sel_click > ul > li > a,
	.wpml-ls > ul > li.wpml-ls-item > a,
	.header-currency .wcml_currency_switcher > a{
		font-size:<?php echo esc_html($ts_font_size_body) - 1 ?>px;/* - 1 font-body */
		line-height:<?php echo esc_html($ts_line_height_body) - 2 ?>px;/* -2 line-height body */
	}
	.group-meta-header .shopping-cart-wrapper a.cart-control span.amount{
		font-size:<?php echo esc_html($ts_font_size_body) ?>px;
		line-height:<?php echo esc_html($ts_line_height_body) - 2 ?>px;/* -2 line-height body */
	}
	.my-account-wrapper .dropdown-container{
		line-height:<?php echo esc_html($ts_line_height_body) - 2 ?>px;/* -2 line-height body */
	}

	/*----------------------------------------------------------------*/
	/*- MENU ---------------------------------------------------------*/
	.mobile-menu-wrapper li a{
		font-size:<?php echo esc_html($ts_font_size_menu) - 1 ?>px;
		line-height:<?php echo esc_html($ts_line_height_menu) ?>px;
	}
	.vertical-menu-big .header-template .vertical-menu-wrapper nav > ul.menu > li > a,
	.header-v2 .shopping-cart-wrapper a.cart-control span.amount,
	.menu-wrapper nav > ul.menu > li > a,
	.menu-wrapper nav > ul.menu li:before,
	.vertical-menu-wrapper .vertical-menu-heading,
	.widget-container.ts-menus-widget .widget-title,
	header.ts-header .vertical-menu-wrapper .vertical-menu-heading:before,
	.widget-container.ts-menus-widget .widget-title:before{
		font-size:<?php echo esc_html($ts_font_size_menu) ?>px;
		line-height:<?php echo esc_html($ts_line_height_menu) ?>px;
	}
	.header-template .menu-wrapper .vertical-menu > ul.menu > li > a,
	.widget-container .vertical-menu > ul.menu > li > a{
		font-size:<?php echo esc_html($ts_font_size_menu) ?>px;
	}
	.group-button-icon-header .my-account-wrapper a:before,
	.group-button-icon-header .my-wishlist-wrapper a:before,
	.group-button-icon-header .ts-tiny-cart-wrapper .ic-cart .ic{
		font-size:<?php echo esc_html($ts_font_size_menu) + 1 ?>px;/* + 1 font-menu */
		line-height:<?php echo esc_html($ts_line_height_menu) ?>px;
	}
	.menu-wrapper nav > ul.menu li .menu-desc,
	.widget-container .vertical-menu > ul.menu li .menu-desc{
		font-size:<?php echo esc_html($ts_font_size_menu) - 2 ?>px; /* - 2 font-menu */
		line-height:<?php echo esc_html($ts_line_height_menu) - 2 ?>px; /* - 2 line-height menu */
	}
	/* WIDGET CUSTOM MENU FOR MEGAMENU */
	.menu-wrapper nav li.widget > .widgettitle,
	.menu-wrapper nav div.list-link > .widgettitle,
	.heading-title-menu,
	.widget-container .vertical-menu li.widget > .widgettitle,
	.widget-container .vertical-menu div.list-link > .widgettitle{
		font-size:<?php echo esc_html($ts_font_size_menu) ?>px;
		line-height:<?php echo esc_html($ts_line_height_menu) ?>px;
	}

	/*----------------------------------------------------------------*/
	/*- PRODUCT ------------------------------------------------------*/
	.woocommerce div.product .product .price,
	.amount,
	.quantity input{
		font-size:<?php echo esc_html($ts_font_size_body) + 1 ?>px;
	}
	.woocommerce .products .product.product-category h3,
	body #yith-woocompare table.compare-list .amount,
	.ts-product-deals-slider-wrapper span.amount,
	.shopping-cart-wrapper a.cart-control span.amount{
		font-size:<?php echo esc_html($ts_font_size_body) + 3 ?>px;
	}
	.header-product-categories .category-name h3{
		font-size:<?php echo esc_html($ts_font_size_body) - 1 ?>px;
	}
	/* BUTTON */
	.woocommerce-error .button,
	.woocommerce-info .button, 
	.woocommerce-message .button, 
	.woocommerce .woocommerce-error .button,
	.woocommerce .woocommerce-info .button, 
	.woocommerce .woocommerce-message .button{
		font-size:<?php echo esc_html($ts_font_size_button) ?>px;
	}
	.woocommerce a.button.added:before, 
	.woocommerce button.button.added:before, 
	.woocommerce input.button.added:before, 
	.woocommerce #respond input#submit.added:before, 
	.woocommerce #respond input#submit.added:before, 
	.woocommerce .meta-wrapper .loop-add-to-cart a:first-child:before,
	a.view-more,
	a.ts-button,
	a.button,
	button,
	.meta-wrapper div.wishlist a,
	.meta-wrapper div.compare a i,
	.meta-wrapper div.compare a:before,	
	.woocommerce .summary a.compare i,
	.woocommerce .summary div.yith-wcwl-add-to-wishlist a:before, 
	.woocommerce .summary a.compare:before,
	html body.woocommerce table.compare-list tr.add-to-cart td a:before,
	html body #yith-woocompare table.compare-list tr.add-to-cart td a:before,
	input[type="submit"], 
	.shopping-cart p.buttons a, 
	.woocommerce #respond input#submit, 
	.woocommerce a.button, 
	.woocommerce button.button, 
	.woocommerce input.button, 
	.woocommerce #respond input#submit.alt, 
	.woocommerce a.button.alt, 
	.woocommerce button.button.alt, 
	.woocommerce input.button.alt, 
	.woocommerce .widget_price_filter .price_slider_amount .button,
	div.product .summary .yith-wcwl-add-to-wishlist a:before,
	.woocommerce table.shop_table input, 
	body .product-edit-new-container .dokan-btn-lg,
	.button-banner,
	.woocommerce .product .meta-wrapper .has-wishlist.has-compare.has-add-to-cart a.added_to_cart:before,
	.woocommerce .product .meta-wrapper .has-wishlist.has-compare.has-add-to-cart a.button:before,
	/* Forum */
	#bbpress-forums #bbp-single-user-details #bbp-user-navigation a,
	/* Compare */
	body #yith-woocompare table.compare-list .add-to-cart td a,
	/* Dokan */
	input[type="submit"].dokan-btn, 
	a.dokan-btn, 
	.dokan-btn{
		font-size:<?php echo esc_html($ts_font_size_button) ?>px;
		line-height:<?php echo esc_html($ts_line_height_button) ?>px;
	}
	.pp_woocommerce .quantity input.qty, 
	.woocommerce .quantity input.qty{
		line-height:<?php echo esc_html($ts_line_height_button) ?>px;
	}
	.style-fullwidth .feedburner-subscription button.button,
	.mc4wp-form-fields .mailchimp-input input[type="submit"]{
		font-size:<?php echo esc_html($ts_font_size_button) + 1 ?>px;
		line-height:<?php echo esc_html($ts_line_height_button) + 2 ?>px;
	}
	
	/* ============= 9. RESPONSIVE ============== */
	
	<?php if( isset($data['ts_responsive']) && $data['ts_responsive'] == 0 ): ?>
		/* NO RESPONSIVE */
		.ts-col-1, .ts-col-2, .ts-col-3, .ts-col-4, .ts-col-5, .ts-col-6, .ts-col-7, .ts-col-8, .ts-col-9, .ts-col-10, .ts-col-11, .ts-col-12, .ts-col-1, .ts-col-2, .ts-col-3, .ts-col-4, .ts-col-5, .ts-col-6, .ts-col-7, .ts-col-8, .ts-col-9, .ts-col-10, .ts-col-11, .ts-col-12, .ts-col-13, .ts-col-14, .ts-col-15, .ts-col-16, .ts-col-17, .ts-col-18, .ts-col-19, .ts-col-20, .ts-col-21, .ts-col-22, .ts-col-23, .ts-col-24 {
			float: left;
		}
		.ts-col-24 {
			width: 100%;
		}
		.ts-col-23 {
			width: 95.83333333%;
		}
		.ts-col-22 {
			width: 91.66666667%;
		}
		.ts-col-21 {
			width: 87.5%;
		}
		.ts-col-20 {
			width: 83.33333333%;
		}
		.ts-col-19 {
			width: 79.16666667%;
		}
		.ts-col-18 {
			width: 75%;
		}
		.ts-col-17 {
			width: 70.83333333%;
		}
		.ts-col-16 {
			width: 66.66666667%;
		}
		.ts-col-15 {
			width: 62.5%;
		}
		.ts-col-14 {
			width: 58.33333333%;
		}
		.ts-col-13 {
			width: 54.16666667%;
		}
		.ts-col-12 {
			width: 50%;
		}
		.ts-col-11 {
			width: 45.83333333%;
		}
		.ts-col-10 {
			width: 41.66666667%;
		}
		.ts-col-9 {
			width: 37.5%;
		}
		.ts-col-8 {
			width: 33.33333333%;
		}
		.ts-col-7 {
			width: 29.16666667%;
		}
		.ts-col-6 {
			width: 25%;
		}
		.ts-col-5 {
			width: 20.83333333%;
		}
		.ts-col-4 {
			width: 16.66666667%;
		}
		.ts-col-3 {
			width: 12.5%;
		}
		.ts-col-2 {
			width: 8.33333333%;
		}
		.ts-col-1 {
			width: 4.16666667%;
		}
		/* Overwrite visual */
		.vc_col-sm-1, .vc_col-sm-2, .vc_col-sm-3, .vc_col-sm-4, .vc_col-sm-5, .vc_col-sm-6, .vc_col-sm-7, .vc_col-sm-8, .vc_col-sm-9, .vc_col-sm-10, .vc_col-sm-11, .vc_col-sm-12 {
			float: left;
		}
		.vc_col-sm-12 {
			width: 100%;
		}
		.vc_col-sm-11 {
			width: 91.66666667%;
		}
		.vc_col-sm-10 {
			width: 83.33333333%;
		}
		.vc_col-sm-9 {
			width: 75%;
		}
		.vc_col-sm-8 {
			width: 66.66666667%;
		}
		.vc_col-sm-7 {
			width: 58.33333333%;
		}
		.vc_col-sm-6 {
			width: 50%;
		}
		.vc_col-sm-5 {
			width: 41.66666667%;
		}
		.vc_col-sm-4 {
			width: 33.33333333%;
		}
		.vc_col-sm-3 {
			width: 25%;
		}
		.vc_col-sm-2 {
			width: 16.66666667%;
		}
		.vc_col-sm-1 {
			width: 8.33333333%;
		}
		.vc_col-sm-pull-12 {
			right: 100%;
		}
		.vc_col-sm-pull-11 {
			right: 91.66666667%;
		}
		.vc_col-sm-pull-10 {
			right: 83.33333333%;
		}
		.vc_col-sm-pull-9 {
			right: 75%;
		}
		.vc_col-sm-pull-8 {
			right: 66.66666667%;
		}
		.vc_col-sm-pull-7 {
			right: 58.33333333%;
		}
		.vc_col-sm-pull-6 {
			right: 50%;
		}
		.vc_col-sm-pull-5 {
			right: 41.66666667%;
		}
		.vc_col-sm-pull-4 {
			right: 33.33333333%;
		}
		.vc_col-sm-pull-3 {
			right: 25%;
		}
		.vc_col-sm-pull-2 {
			right: 16.66666667%;
		}
		.vc_col-sm-pull-1 {
			right: 8.33333333%;
		}
		.vc_col-sm-pull-0 {
			right: auto;
		}
		.vc_col-sm-push-12 {
			left: 100%;
		}
		.vc_col-sm-push-11 {
			left: 91.66666667%;
		}
		.vc_col-sm-push-10 {
			left: 83.33333333%;
		}
		.vc_col-sm-push-9 {
			left: 75%;
		}
		.vc_col-sm-push-8 {
			left: 66.66666667%;
		}
		.vc_col-sm-push-7 {
			left: 58.33333333%;
		}
		.vc_col-sm-push-6 {
			left: 50%;
		}
		.vc_col-sm-push-5 {
			left: 41.66666667%;
		}
		.vc_col-sm-push-4 {
			left: 33.33333333%;
		}
		.vc_col-sm-push-3 {
			left: 25%;
		}
		.vc_col-sm-push-2 {
			left: 16.66666667%;
		}
		.vc_col-sm-push-1 {
			left: 8.33333333%;
		}
		.vc_col-sm-push-0 {
			left: auto;
		}
		.vc_col-sm-offset-12 {
			margin-left: 100%;
		}
		.vc_col-sm-offset-11 {
			margin-left: 91.66666667%;
		}
		.vc_col-sm-offset-10 {
			margin-left: 83.33333333%;
		}
		.vc_col-sm-offset-9 {
			margin-left: 75%;
		}
		.vc_col-sm-offset-8 {
			margin-left: 66.66666667%;
		}
		.vc_col-sm-offset-7 {
			margin-left: 58.33333333%;
		}
		.vc_col-sm-offset-6 {
			margin-left: 50%;
		}
		.vc_col-sm-offset-5 {
			margin-left: 41.66666667%;
		}
		.vc_col-sm-offset-4 {
			margin-left: 33.33333333%;
		}
		.vc_col-sm-offset-3 {
			margin-left: 25%;
		}
		.vc_col-sm-offset-2 {
			margin-left: 16.66666667%;
		}
		.vc_col-sm-offset-1 {
			margin-left: 8.33333333%;
		}
		.vc_col-sm-offset-0 {
			margin-left: 0%;
		}
		.ts-columns .one_half{
			width:50%;
		}
		.ts-columns .one_third{
			width:33.33333%;
			float:left;/* rtl */
		}
		.ts-columns .one_fourth{
			width:20%;
		}
		/* HEADER */
		html #page{
			overflow:visible;
		}
		@media only screen and (max-device-width: 1229px){
			.header-v1 .shopping-cart-wrapper,
			.header-v2 .banner-middle-content, 
			.header-v4 .banner-middle-content{
				right:-2px; /* rtl */
				position:relative;
			}
		}
		@media only screen and (max-width: 1229px){
			/* HEADER */
			.header-v1 .shopping-cart-wrapper a.cart-control .cart-total{
				display:none !important;
			}
			.header-v1 .shopping-cart-wrapper a.cart-control{
				padding:20px 23px;/* rtl */
			}
			.header-v1 .shopping-cart-wrapper .cart-number{
				top:5px;
			}
			#lang_sel_click, 
			.wpml-ls,
			.header-currency{
				z-index:100000;
			}
			/* HOME SUPERMARKET 2 */
			.vc_col-sm-6 .google-map-container{
				margin-top:0;
			}
			/* SUPERMARKET 5 */
			.custom-layout-super1 .vc_col-sm-3 .woocommerce .ts-product-deals-slider-wrapper .products .product .product-categories{
				display:none;
			}
			/* IMAGE BACKGROUND PRODUCT */
			.woocommerce .product .product-wrapper figure.has-back-image img:last-child{
				display:none !important;
			}
			/* MAIN CONTENT */
			div#main{
				min-height:300px;
			}
			/* BREADCRUMB */
			.heading-title.page-title{
				margin-bottom:0;
			}
			.breadcrumb-title-wrapper.breadcrumb-v2 .breadcrumb-content,
			body.boxed .breadcrumb-title-wrapper.breadcrumb-v3 .breadcrumb-content,
			body.main-content-boxed .breadcrumb-title-wrapper.breadcrumb-v3 .breadcrumb-content{
				height:150px;
			}
			.breadcrumb-title-wrapper.breadcrumb-v3{
				padding:50px 0 50px 0;
			}
			.breadcrumb-title-wrapper.breadcrumb-v3 .breadcrumb-title h1{
				font-size:22px;
				line-height:28px;
			}
			.breadcrumb-title-wrapper.breadcrumb-v3{
				padding:42px 0 260px 0;
				position:relative;
			}
			#main > .page-container.show_breadcrumb_v3,
			#main > .fullwidth-template.show_breadcrumb_v3{
				margin-top:-220px;
			}
			/* 404 PAGE */
			body.error404 #main > .fullwidth-template{
				padding:120px 25px
			}
			body.error404 article h1{
				font-size:120px;
				line-height:120px;
			}
			/* BLACK PAGE */
			h1.title-coming{
				font-size:60px;
				line-height:60px;
			}
			.ts-group-button-coming{
				padding-bottom:90px;
			}
			/* Portfolio */
			body .single-post.layout-1 .single-navigation{
				padding-top:16px;
			}
			.ts-portfolio-wrapper.columns-3 .item,
			.ts-portfolio-wrapper.columns-4 .item{
				width:50%;
				float:left;/* rtl */
			}
			.ts-portfolio-wrapper.columns-3 .item:nth-child(2n+1),
			.ts-portfolio-wrapper.columns-4 .item:nth-child(2n+1){
				clear:both;
			}
			/* PARALLAX */
			.ts-parallax-bg{
				background-position:50% 50% !important;
				background-attachment:scroll !important;
			}
			/* PRODUCT DETAIL */
			.woocommerce .ts-col-24 div.product .woocommerce-tabs.accordion-tabs{
				margin-bottom:0;
			}
			.ads-banner .vc_row{
				margin-bottom:0;
			}
			/* Show button next prev thumbnail */
			div.product .thumbnails .owl-controls div.owl-prev,
			div.product .thumbnails .owl-controls div.owl-next{
				visibility:visible;
				opacity:1;
				transform:translate(0,0);
				-webkit-transform:translate(0,0);
				-moz-transform:translate(0,0);
			}
			/* Vertical thumbnail */
			div.product.vertical-thumbnail .thumbnails .owl-controls div.owl-prev,
			div.product.vertical-thumbnail .thumbnails .owl-controls div.owl-next{
				visibility:visible;
				opacity:1;
				transform:translate(0,0);
				-webkit-transform:translate(0,0);
				-moz-transform:translate(0,0);
			}
			/* End Show button next prev thumbnail */
			.woocommerce #reviews #comments ol.commentlist li{
				margin-bottom:20px;
				padding-bottom:20px;
			}
			.single-navigation .product-info {
				display:none !important;
			}
			.woocommerce .woocommerce-product-rating, 
			.woocommerce div.product .woocommerce-product-rating{
				margin-bottom:0;
			}
			/* MY ACCOUNT */
			.woocommerce form.login .button, 
			.woocommerce form.register .button{
				margin:0 10px 0 0;/* rtl */
			}
			.woocommerce-account .woocommerce-MyAccount-content{
				padding-left:20px /* rtl */
			}
			.woocommerce table.my_account_orders .order-actions .button{
				padding-left:10px;
				padding-right:10px;
				min-width:0;
			}
			.woocommerce table.my_account_orders .order-actions{
				min-width:0;
			}
			/* TAB COMMENT */
			.woocommerce-tabs #comments,
			.ts-col-18 .woocommerce-tabs #comments,
			.ts-col-12 .woocommerce-tabs #comments{
				width:100%;
				padding-right:0;/* rtl */
				margin-bottom:40px; 
			}
			.comment-respond textarea,
			#commentform textarea,
			.comment-respond input[type="text"],
			.comment-respond select,
			#commentform input[type="text"],
			.woocommerce #reviews #comments > h2{
				max-width:100%;
			}
			.woocommerce-tabs #review_form_wrapper,
			.ts-col-18 .woocommerce-tabs #review_form_wrapper,
			.ts-col-12 .woocommerce-tabs #review_form_wrapper{
				width:100%;
				border:0;/* rtl */
				padding:0 /* rtl */
			}
			/* PRODUCT DETAIL */
			.summary .meta-wrapper,
			body div.product .social-sharing{
				padding-top:10px;
			}
			body div.product .social-sharing{
				margin-top:10px;
			}
			.woocommerce div.product.type-product form.cart, 
			.woocommerce div.product p.cart{
				margin-bottom:25px;
			}
			div.product .summary .counter-wrapper{
				margin-bottom:15px;
			}
			.woocommerce div.product .woocommerce-tabs ul.tabs li{
				min-width:140px;
			}
			/* BLOG */
			.entry-format .ts-social-sharing{
				position:static;
				width:100%;
				margin:20px 0 0 0;
				text-align:left; /* rtl */
				transform:none;
				-webkit-transform:none;
				-moz-transform:none;
				visibility:visible;
				z-index:10;
			}
			.entry-format:hover .ts-social-sharing ul li{
				animation:none;
				-webkit-animation:none;
				-moz-animation:none;
			}
			.list-posts .ts-social-sharing .sharing-title{
				margin:7px 10px 0 0; /* rtl */
				float:left;/* rtl */
			}
			.list-posts .entry-bottom .ts-social-sharing .sharing-title{
				padding-right:0 !important;
				padding-left:0 !important;
				margin-top:6px;
			}
			.ts-social-sharing ul{
				display:inline-block;
				margin:0;
			}
			.gallery .owl-dots{
				bottom:10px;
			}
			/* BLOG DETAIL */
			.commentlist .children{
				padding:10px 0 0 20px; /* rtl */
			}
			/* SHOPPING CART */
			.woocommerce table.shop_table td.actions{
				border:0;
				padding:20px;
			}
			.woocommerce table.shop_table td.product-thumbnail{
				padding-left:20px; /* rtl */
			}
			.woocommerce-cart .cart-collaterals .cart_totals table th{
				width:30%;
			}
			/* CHECKOUT */
			.woocommerce form.checkout_coupon{
				max-width:100%;
			}
			/* SHOP CATEGORIES */
			.woocommerce .products.list .star-rating{
				margin-bottom:10px;
			}
			.woocommerce .products .product.product-category h3{
				font-size:16px;
				line-height:18px;
			}
			.products .product.product-category .meta-wrapper{
				opacity:1;
			}
			.products .product.product-category:before{
				opacity:0.6;
			}
			.products .product.product-category:hover .meta-wrapper > div{
				-webkit-animation: none;
				-moz-animation: none;
				animation: none;
			}
			.products .product.product-category h3{
				font-size:20px;
				line-height:24px;
			}
			/* SHORTCODE */
			/* Shortcode List Product */
			.woocommerce .ts-single-products-slider-wrapper .products .product .product-wrapper{
				padding:20px;
			}
			.woocommerce .ts-single-products-slider-wrapper.thumbnail-left .product .meta-wrapper{
				padding-right:20px;
			}
			.woocommerce .ts-single-products-slider-wrapper.thumbnail-right .product .meta-wrapper{
				padding-left:20px;
			}
			/* Shortcode Hot Deal */
			.woocommerce .ts-product-deals-slider-wrapper .meta-wrapper .loop-add-to-cart, 
			.ts-product-deals-slider-wrapper .meta-wrapper div.compare, 
			.ts-product-deals-slider-wrapper .meta-wrapper div.wishlist{
				margin-top:2px;
			}
			/* Shortcode Product Tab */
			.ts-product-in-category-tab-wrapper .woocommerce.column-products .product{
				padding:10px;
			}
			/* Shortcode Categories Slider */
			.ts-product-category-slider-wrapper.show-dots .content-wrapper{
				padding-bottom:60px;
			}
			/* Shortcode Testimonial */
			.ts-testimonial-wrapper .testimonial-content{
				margin:0 0 0 165px;/* rtl */
			}
			/* Shortcode Countdown */
			.ts-countdown .counter-wrapper > div{
				width:70px
			}
			.ts-countdown .counter-wrapper > div .number-wrapper{
				padding:12px 0
			}
			.ts-countdown .counter-wrapper .number{
				font-size:24px;
				line-height:28px;
			}
			.ts-countdown .counter-wrapper > div .ref-wrapper{
				font-size:12px;
				line-height:16px;
				padding:2px 0;
			}
			/* Shortcode Tab */
			body.wpb-js-composer .vc_general.vc_tta-tabs .vc_tta-tab{
				min-width:120px;
			}
			/* Shortcode Banner */
			.font-big header .description{
				letter-spacing:0;
			}
			
			/* 1229px - 768px */
			
			.visible-ipad{
				display:block !important
			}
			.hidden-ipad{
				display:none !important;
			}
			/* HEADER */
			/* Header version 9 */
			.header-v9 .menu-wrapper nav > ul.menu > li > a{
				padding-top:25px;
				padding-bottom:25px;
			}
			.header-v9 .header-top-right .group-meta-header > div{
				display:inline-block !important;
			}
			header.ts-header .header-v9 .header-middle > .container{
				display:block;
			}
			.header-v9 .header-middle > .container > .search-wrapper{
				text-align:center;
			}
			.header-v9 .ts-search-by-category{
				margin-left:auto;
				margin-right:auto;
				max-width:550px;
			}
			.header-v9 .header-middle > .container > .search-wrapper,
			header.ts-header .header-v9 .menu-wrapper{
				display:inline-block;
				width:100%;
			}
			.header-v9 .group-meta{
				display:none !important;
			}
			/* Header version 2 */
			.header-v2.show-cart .ts-menu > .pc-menu{
				margin-right:50px;/* rtl */
			}
			.header-v2 .shopping-cart-wrapper .cart-control .cart-total{
				display:none;
			}
			.header-v2 .shopping-cart-wrapper .cart-control{
				padding-right:20px; /* rtl */
				line-height:20px;
			}
			.header-v2 .menu-wrapper nav > ul.menu > li{
				margin-right:10px /* rtl */
			}
			.header-v2.has-vertical-menu .ts-menu > .pc-menu{
				margin-left:227px/* rtl */
			}
			.vertical-menu-big .header-template .menu-wrapper .vertical-menu > ul.menu > li > a{
				height:74px;
			}
			.vertical-menu-big .header-template .menu-wrapper .vertical-menu > ul.menu > li > a,
			.vertical-menu-big .header-template .menu-wrapper .vertical-menu > ul.menu > li > a:first-child{
				padding:10px 0 10px 10px;/* rtl */
			}
			.vertical-menu-big .header-template .menu-wrapper .vertical-menu > ul.menu > li > a.has-icon,
			.vertical-menu-big .header-template .menu-wrapper .vertical-menu > ul.menu > li > a.has-icon:first-child{
				padding-left:10px;/* rtl */
			}
			.vertical-menu-big .header-template .menu-wrapper .vertical-menu > ul.menu > li > a,
			.vertical-menu-big .header-template .menu-wrapper .vertical-menu > ul.menu > li > a:first-child{
				padding-left:10px;/* rtl */
			}
			.vertical-menu-big .header-template .menu-wrapper .vertical-menu > ul.menu li .menu-icon{
				display:none;
			}
			/* Header version 4 */
			.header-v4.has-vertical-menu .search-wrapper{
				margin-left:208px /* rtl */
			}
			.header-v4 .search-content{
				margin-right:208px;/* rtl */
			}
			.header-v4 .ts-search-by-category form > .select2,
			.header-v4 .ts-search-by-category select{
				width:208px !important;
			}
			.header-template .menu-wrapper .vertical-menu > ul.menu > li > a,
			.header-template .menu-wrapper .vertical-menu > ul.menu > li > a:first-child{
				padding:9px 0 10px 10px;/* rtl */
			}
			.header-template .menu-wrapper .vertical-menu > ul.menu > li > a,
			.widget-container .vertical-menu > ul.menu > li > a{
				height:auto;
			}
			.header-template .menu-wrapper .vertical-menu > ul.menu > li > a:not(.has-icon):before,
			.header-template .menu-wrapper .vertical-menu > ul.menu li .menu-icon{
				display:none;
			}
			/* Header version 6 */
			/* Menu version 6 */
			.header-v6 .menu-wrapper .ts-menu > nav > ul.menu > li > a{
				padding:13px 15px 13px 15px;
			}
			.header-v6 .menu-wrapper .ts-menu > nav > ul.menu > li.parent > a,
			.header-v6 .menu-wrapper .ts-menu > nav > ul.menu > li.menu-item-has-children:not(.parent) > a{
				padding-right:23px ;/* rtl */
			}
			.header-v6 .menu-wrapper .ts-menu > nav > ul.menu > li.fa > a{
				padding-left:23px; /* rtl */
			}
			.header-v6 .ts-menu > nav.pc-menu > ul.menu > li > .ts-menu-drop-icon{
				right:5px; /* rtl */
			}
			.header-v6 .ts-menu > nav > ul.menu li:before{
				left:8px;/* rtl */
			}
			/* HOME SUPERMARKET 1 */
			.vc_col-sm-3 .woocommerce .ts-slider  .products .product{
				margin:0;
				padding:0;
			}
			.custom-layout-super1 .ts-product-deals-slider-wrapper{
				margin-top:10px;
			}
			.custom-layout-super1 .vc_col-sm-3{
				padding-left:10px;
				padding-right:10px;
			}
			.custom-layout-super1 .ts-product-deals-slider-wrapper .star-rating{
				display:none !important;
			}
			.custom-layout-super1 .ts-product.nav-bottom .owl-nav{
				line-height:20px;
			}
			/* PRODUCT DETAIL */
			div.product .ref-wrapper{
				font-size:10px;
				line-height:12px;
			}
			.woocommerce .ts-col-12 div.product .woocommerce-tabs ul.tabs li{
				margin-bottom:10px;
				min-width:120px;
			}
			.woocommerce .ts-col-12 div.product .woocommerce-tabs ul.tabs:before{
				display:none;
			}
			.woocommerce .ts-col-18 div.product .woocommerce-tabs ul.tabs li{
				min-width:120px;
			}
			/* CONTENT RESET */
			.list-posts article.post_format-post-format-quote{
				padding:20px;
			}
			/* Filter Widget Shop Page */
			.ts-product-filter-wrapper .widgets .widget-title{
				margin-bottom:10px;
			}
			.ts-product-filter-wrapper .widgets .widget_price_filter .widget-title{
				margin-bottom:0;
			}
			/* HOT DEAL */
			/* Shortcode Hot Deal */
			.ts-product-deals-slider-wrapper.disable-responsive[data-columns='1'] .counter-wrapper{
				min-width:256px;
			}
			.disable-responsive[data-columns='1'] .counter-wrapper > div{
				width:64px;
				margin:0;
			}
			.disable-responsive[data-columns='1'] .counter-wrapper .number-wrapper{
				padding:8px 0;
			}
			.disable-responsive[data-columns='1'] .counter-wrapper .number{
				font-size:22px;
				line-height:24px;
			}
			.disable-responsive[data-columns='1'] .counter-wrapper .ref-wrapper{
				font-size:11px;
				line-height:18px;
			}
			.disable-responsive[data-columns='1'] .thumbnail-wrapper .counter-wrapper{
				bottom:-17px;
			}
			.woocommerce .disable-responsive[data-columns='1'] .product .meta-wrapper{
				padding-top:16px;
			}
			.counter-wrapper > div{
				width:36px;
			}
			.counter-wrapper > div .number-wrapper{
				padding-bottom:2px;
			}
			.counter-wrapper .number{
				font-size:14px;
				line-height:18px;
			}
			.counter-wrapper .ref-wrapper{
				font-size:8px;
				line-height:14px;
			}
			.ts-product-deals-slider-wrapper .thumbnail-wrapper .counter-wrapper{
				min-width:142px;
			}
			/* SHOP PAGE */
			/* WIDGET */
			.ts-wg-meta .amount{
				font-size:13px;
				line-height:16px;
			}
			.widget-container .ts-products-widget-wrapper ul.product_list_widget, 
			.widget-container ul.product_list_widget, 
			.woocommerce ul.product_list_widget, 
			.widget-container .widget_shopping_cart_content{
				padding-bottom:0;
			}
			/* Widget TS Menu */
			.widget-container .vertical-menu > ul.menu > li > a,
			.widget-container .vertical-menu > ul.menu > li > a:first-child{
				padding:10px 0 10px 10px;/* rtl */
			}
			.widget-container .vertical-menu > ul.menu > li > a:not(.has-icon):before,
			.widget-container .vertical-menu > ul.menu > li .menu-icon{
				display:none;
			}
			/* Right Sidebar */
			.widget-container.ts-menus-widget .widget-title{
				padding:12px 14px !important;
			}
			.widget-container.ts-menus-widget .widget-title:before{
				display:none !important;
			}
			#right-sidebar .widget-container.ts-menus-widget .widget-title,
			.right-sidebar .widget-container.ts-menus-widget .widget-title{
				padding:12px 14px;
			}
			#right-sidebar .widget-container .vertical-menu > ul.menu > li > a,
			#right-sidebar .widget-container .vertical-menu > ul.menu > li > a:first-child,
			.right-sidebar .widget-container .vertical-menu > ul.menu > li > a,
			.right-sidebar .widget-container .vertical-menu > ul.menu > li > a:first-child{
				padding:10px 10px 10px 0;
			}
			#right-sidebar .widget-container .vertical-menu > ul.menu > li.parent > a >.menu-label:after,
			#right-sidebar .widget-container .vertical-menu > ul.menu > li.parent.menu-item-has-children > a >.menu-label:after,
			#right-sidebar .widget-container .vertical-menu > ul.menu li.parent.menu-item-has-children > a >.menu-label:after,
			#right-sidebar .widget-container .vertical-menu > ul.menu > li.parent > a >.menu-label:after,
			#right-sidebar .widget-container .vertical-menu > ul.menu ul li.menu-item-has-children > a:after,
			.right-sidebar .widget-container .vertical-menu > ul.menu > li.parent > a >.menu-label:after,
			.right-sidebar .widget-container .vertical-menu > ul.menu > li.parent.menu-item-has-children > a >.menu-label:after,
			.right-sidebar .widget-container .vertical-menu > ul.menu li.parent.menu-item-has-children > a >.menu-label:after,
			.right-sidebar .widget-container .vertical-menu > ul.menu > li.parent > a >.menu-label:after,
			.right-sidebar .widget-container .vertical-menu > ul.menu ul li.menu-item-has-children > a:after{
				left:5px;
			}
			/* Widget Cart */
			.widget_shopping_cart .buttons{
				clear:both;
				padding-top:10px;
			}
			.widget_shopping_cart .total-title{
				top:-4px;
			}
			.widget_shopping_cart .total .amount{
				margin:0;
				float:right;/* rtl */
			}
			/* Widget padding */
			.widget-container .owl-nav, 
			.widget .owl-nav{
				right:0; /* rtl */
				min-width:0;
			}
			.widget.ts-products-widget .owl-nav{
				right:0;/* rtl */
			}
			.widget.ts-products-widget h2{
				padding-left:10px;
				padding-right:10px;
			}
			.woocommerce .widget_shopping_cart .total, 
			.woocommerce.widget_shopping_cart .total{
				margin:26px 0 10px 0;
			}
			.widget-container{
				padding-left:10px;
				padding-right:10px;
			}
			.widget-title:after{
				left:-10px;
				right:-10px;
			}
			.widget_product_search, 
			.widget_search, 
			.widget_display_search{
				padding:0;
			}
			.widget-container .comment_list_widget > li{
				margin:10px 0 11px 0;
			}
			.widget-container .comment_list_widget > li:before{
				bottom:-10px;
			}
			.widget-container .comment_list_widget > li:last-child:before,
			.widget-container .post_list_widget > li:last-child:before{
				display:none
			}
			.widget-container .post_list_widget > li{
				margin:10px 0 11px 0;
			}
			.widget-container .post_list_widget > li:before{
				bottom:-7px;
			}
			.post_list_widget .entry-meta > span{
				padding-right:5px;/* rtl */
				margin-right:5px;/* rtl */
			}
			.post_list_widget .blockquote-meta .author{
				float:none;
				clear:both;
			}
			.widget-container > ul, 
			section.widget_nav_menu > div > ul, 
			section.widget_display_stats > dl{
				padding-top:5px;
			}
			section.widget_display_stats > dl{
				padding-bottom:0;
			}
			body .widget_product_categories select,
			body .widget_categories select,
			body .widget_archive select{
				margin-bottom:10px;
			}
			section.product-filter-by-color > ul,
			.bbp_widget_login form,
			.widget-container .tagcloud,
			section.ts-social-icons .social-icons,
			.widget-container .widget_shopping_cart_content,
			.widget-container .ts-product-deals-widget-wrapper.ts-slider,
			.widget-container .ts-recent-comments-widget-wrapper{
				padding:10px 0 0 0;
			}
			section.ts-flickr-widget .ts-flickr-wrapper,
			section.ts-instagram-widget .ts-instagram-wrapper{
				padding:8px 0 8px 0;
			}
			.widget-container.widget_text .textwidget{
				padding-top:5px;
				padding-bottom:8px;
			}
			section.woocommerce.widget-container > ul,
			section.feedburner-subscription .subscribe-widget,
			.widget-container .ts-facebook-page-wrapper,
			section.bbp_widget_login .bbp-logged-in{
				padding:10px 0;
			}
			/* CUSTOM WIDGET PRODUCTS */
			.widget-container .ts-products-widget-wrapper ul.product_list_widget ,
			.widget-container ul.product_list_widget,
			.woocommerce ul.product_list_widget, 
			.widget-container .widget_shopping_cart_content{
				padding:10px 0;
			}
			.woocommerce ul.cart_list li, 
			.woocommerce ul.product_list_widget li, 
			.woocommerce .widget_shopping_cart .cart_list li,
			.woocommerce.widget_shopping_cart .cart_list li,
			.widget-container .post_list_widget > li,
			.widget-container .comment_list_widget > li,
			.woocommerce .widget_shopping_cart .total,
			.woocommerce.widget_shopping_cart .total,
			.woocommerce .widget_shopping_cart p.buttons,
			.woocommerce.widget_shopping_cart p.buttons,
			.widget_recently_viewed_products .widget-title,
			.widget_shopping_cart .widget-title,
			.widget_products .widget-title,
			.widget_top_rated_products .widget-title{
				padding-left:10px;
				padding-right:10px;
			}
			.ts-recent-comments-widget .widget-title,
			.ts-blogs-widget .widget-title,
			.ts-products-widget .widget-title{
				padding-left:10px;
				padding-right:30px;/* rtl */
			}
			.widget_shopping_cart .total-title{
				left:10px;/* rtl */
			}
			/* FIX HOT DEAL FOR WIDGET */
			.ts-product-deals-widget .counter-wrapper > div{
				width:40px;
				height:40px;
			}
			.ts-product-deals-widget .counter-wrapper > div .number-wrapper .number{
				font-size:16px;
				line-height:18px;
			}
			/* END HOT DEAL FIX FOR WIDGET */
			/* Filter size */
			.ts-col-24 .woocommerce .widget_layered_nav .woocommerce-widget-layered-nav-list li{
				width:50%;
			}
			.woocommerce .ts-col-24 .widget_layered_nav .woocommerce-widget-layered-nav-list li:nth-child(3n+1){
				clear:none;
			}
			.woocommerce .ts-col-24 .widget_layered_nav .woocommerce-widget-layered-nav-list li:nth-child(2n+1){
				clear:both;
			}
			/* Tab blog */
			section.ts-blogs-tabs-widget .post_list_widget .blog-info{
				margin-left:0;/* rtl */
				margin-top:0;
			}
			.widget-container .post_list_widget .thumbnail{
				float:none; /* rtl */
				margin:0 0 10px 0;
				width:auto;
				display:inline-block;
			}
			/* PORTFOLIO DETAIL */
			article.single.single-portfolio .ts-social-sharing{
				float:none;/* rtl */
				width:100%;
				margin-bottom:10px;
			}
			.single-portfolio .portfolio-like{
				float:none;/* rtl */
				clear:both;
			}
			/* BLOG DETAIL */
			#comment-wrapper .info-wrapper{
				width:100%;
				float:none;/* rtl */
				margin-right:0;/* rtl */
				margin-bottom:30px;
			}
			#comment-wrapper .message-wrapper{
				width:100%;
				float:none; /* rtl */
			}
			.comment-respond textarea,
			#commentform textarea{
				height:150px;
			}
			/* SHOPPING CART */
			.ts-col-12 .woocommerce table.shop_table tr:nth-child(2n) td, 
			.woocommerce-page .ts-col-12 table.shop_table tr:nth-child(2n) td{
				background:rgba(0,0,0,.025);
			}
			.ts-col-12 .woocommerce table.shop_table.cart{
				border:0;
				display:block;
			}
			.ts-col-12 .woocommerce table.shop_table tr{
				margin-bottom:20px;
				display:inline-block;
				width:100%;
			}
			.ts-col-12 .woocommerce table.shop_table tr td:before{
				content: attr(data-title) ": ";
				font-weight: 700;
				float: left;/* rtl */
			}
			.ts-col-12 .woocommerce table.shop_table tr td.product-thumbnail:before,
			.ts-col-12 .woocommerce table.shop_table .product-remove:before,
			.ts-col-12 .woocommerce table.shop_table.cart td.actions:before{
				display:none;
			}
			.ts-col-12 .woocommerce table.shop_table td.product-thumbnail{
				width:100%;
				margin:0 auto;
				display:block;
				max-width:100%;
				text-align:center;/* rtl default woocommerce */
			}
			.ts-col-12 .woocommerce table.shop_table tbody th, 
			.ts-col-12 .woocommerce table.shop_table thead{
				display:none !important;
			}
			.ts-col-12 .woocommerce table.shop_table tr td{
				display:block;
				text-align:right;/* rtl */
				padding:10px;
				border-width:1px 1px 0 1px;
				border-style:solid;
			}
			.ts-col-12 .woocommerce table.shop_table td.product-name{
				text-align:right;/* rtl */
			}
			.ts-col-12 .woocommerce table.shop_table td.product-name,
			.ts-col-12 .woocommerce table.shop_table td.product-thumbnail{
				border-width:1px 1px 0 1px;
				border-style:solid;
			}
			.ts-col-12 .woocommerce table.shop_table .product-remove{
				border-width:1px;
				border-style:solid;
				width:100%;
				max-width:100%;
				text-align:center !important;/* rtl default woocommerce */
			}
			.ts-col-12 .woocommerce table.shop_table.cart td.actions{
				padding:0;
			}
			.ts-col-12 .woocommerce table.cart td.actions .coupon{
				float:none;/* rtl */
				margin-bottom:10px;
				width:100%;
			}
			.ts-col-12  .woocommerce table.cart td.actions .coupon .input-text{
				width:58%;
				margin-right:2%;/* rtl */
			}
			.ts-col-12  .woocommerce table.cart td.actions .coupon input[type="submit"]{
				width:40%;
				margin:0;
			}
			.ts-col-12  .woocommerce table.cart td.actions > [type="submit"]{
				width:100%;
				margin-top:10px;
			}
			.woocommerce-cart .ts-col-12 .cart-collaterals .cart_totals table td{
				padding:13px 0 !important;
			}
			.woocommerce-cart .ts-col-12 .cart-collaterals .cart_totals table tr.shipping td{
				text-align:right;/* rtl */
			}
			.woocommerce-cart .ts-col-12 ul#shipping_method{
				float:right;/* rtl */
				text-align:right/* rtl */
			}
			.woocommerce-cart .ts-col-12 .woocommerce-shipping-calculator{
				float:right;/* rtl */
			}
			/* CHECK OUT */
			.woocommerce table.shop_table.woocommerce-checkout-review-order-table tr:nth-child(2n) td, 
			.woocommerce-page table.shop_table.woocommerce-checkout-review-order-table tr:nth-child(2n) td{
				background:transparent;
			}
			.woocommerce table.shop_table.woocommerce-checkout-review-order-table tr{
				display:table-row;
			}
			.woocommerce table.shop_table.woocommerce-checkout-review-order-table tr td{
				display:table-cell;
			}
			.woocommerce table.shop_table.woocommerce-checkout-review-order-table tr td:before{
				display:none;
			}
			
			/* 1229px - 991px */
			
			/* HEADER */
			.group-meta-header{
				display:inline-block !important;
			}
			/* Header Vertical */
			.vertical-menu-wrapper{
				width:208px;
			}
			.vertical-menu-wrapper .vertical-menu-heading,
			.vertical-menu-big .vertical-menu-wrapper .vertical-menu-heading{
				padding:13px 14px; /* rtl */
			}
			.vertical-menu-wrapper .vertical-menu-heading:before{
				display:none;
			}
			/* Header version 3 */
			header.ts-header .header-v3.show-search  .menu-wrapper{
				width:78%;
			}
			.header-v3 .search-wrapper{
				width:22%;
			}
			.header-v3 .menu-wrapper nav > ul.menu > li{
				padding:0 12px 0 0;/* rtl */
				margin:0 12px 0 0;/* rtl */
			}
			/* Header version 4 */
			header.ts-header .header-v4 .logo-wrapper{
				width:22%;
			}
			.header-v4 .banner-middle-content{
				width:20%;
			}
			.header-v4 .menu-wrapper nav > ul.menu > li{
				margin:0 10px 0 0;/* rtl */
			}
			.fix-vertical-menu-3columns .vc_col-sm-6{
				padding-left:2px;
				padding-right:1px;/* rtl */
			}
			/* Header version 5 */
			.header-v5 .header-middle .header-left > div{
				margin-left:40px;/* rtl */
			}
			.header-v5 .header-middle .header-left > div:before{
				left:-20px;/* rtl */
			}
			/* Header version 7 */
			.header-v7 .header-top .header-top-left{
				width:37%;
			}
			.header-v7 .header-top .header-top-right{
				width:63%;
			}
			/* Header Right */
			.header-v5 .header-middle .header-right > div{
				margin-right:40px;/* rtl */
			}
			.header-v5 .header-middle .header-right > div:before{
				right:-20px;/* rtl */
			}
			/* Header version 9 */
			.header-v9 .ts-search-by-category{
				max-width:650px;
				margin-top:20px;
			}
			.header-v9 .ts-menu > nav.pc-menu > ul.menu > li > .ts-menu-drop-icon{
				right:7px;/* rtl */
			}
			/* Service page */
			.fix-size-heading h2{
				font-size:30px;
				line-height:34px;
				margin-bottom:15px;
			}
			/* WIDGET */
			/* Shortcode Widget Products */
			.widget.ts-products-widget .nav-bottom .owl-nav{
				line-height:32px;
			}
			.widget .ts-products-widget-wrapper ul li, 
			.woocommerce .widget .ts-products-widget-wrapper ul li{
				padding:0 0 15px 10px;/* rtl */
				margin-bottom:14px;
			}
			.widget .ts-products-widget-wrapper ul, 
			.woocommerce .widget .ts-products-widget-wrapper ul{
				padding-top:16px !important;
				padding-bottom:16px;
			}
			/* Widget products */
			.ts-products-widget .ts-products-widget-wrapper.loading{
				height:320px;
			}
			.woocommerce ul.cart_list li img, 
			.woocommerce ul.product_list_widget li img,
			.widget .ts-products-widget-wrapper ul li img, 
			.woocommerce .widget .ts-products-widget-wrapper ul li img{
				width:54px;
			}
			ul.product_list_widget li .ts-wg-meta{
				margin-left:64px; /* rtl */
			}
			.widget_shopping_cart ul.product_list_widget li .ts-wg-meta{
				margin-left:64px; /* rtl */
			}
			.fix-vertical-menu-3columns .woocommerce ul.product_list_widget li .product-categories{
				display:none;
			}
			/* BLOG */
			.list-posts article .entry-meta, 
			article.single .entry-meta{
				margin-bottom:10px;
			}
			.list-posts .button.button-readmore{
				margin-top:15px;
			}
			.entry-bottom .ts-social-sharing{
				margin-top:0;
			}
			.list-posts article:last-child:before{
				display:none;
			}
			.list-posts article:before{
				content:"";
				position:absolute;
				bottom:0;
				border-width:0 0 1px 0;
				border-style:solid;
				left:0;
				right:0;
				opacity:0.4;
			}
			.list-posts article.post_format-post-format-quote:before{
				bottom:-40px;
			}
			/* SHORTCODE */
			/* Hot Deal */
			.ts-product.ts-product-deals-slider-wrapper.has-banner[data-columns='2'] .products{
				width:60%;
			}
			.ts-product.ts-product-deals-slider-wrapper.has-banner[data-columns='2'] .banners{
				width:40%;
			}
			/* Shortcode Video */
			.vc_row.ts-video-bg > .wpb_column{
				padding-top:150px;
				padding-bottom:150px;
			}
			.ts-youtube-video-bg .mb_YTPBar, 
			.ts-hosted-video-bg .video-control{
				top:40px;
			}
			.ts-youtube-video-bg .loading{
				top:60px;
			}
			/* Shortcode Tab Categories */
			.ts-product-in-category-tab-wrapper .column-tabs .shop-more-button{
				font-size:0;
			}
			/* Shortcode Blog */
			.ts-blogs-split-wrapper .item-large{
				width:45%;
			} 
			.ts-blogs-split-wrapper .item-small{
				width:55%;
			}
			.ts-blogs-split-wrapper .item-small .thumbnail{
				width:43%;
			}
			.ts-blogs-split-wrapper .item-small .entry-content{
				width:57%;
				padding-left:10px /* rtl */
			}
			.ts-blogs-split-wrapper .item-small{
				padding-left:10px /* rtl */
			}
			.ts-blogs-split-wrapper .item-small article{
				margin-bottom:10px;
			}
			.ts-blogs-split-wrapper h3.entry-title > a{
				font-size:14px;
				line-height:18px;
			}
			.ts-blogs-split-wrapper.ts-blogs .entry-meta{
				margin-bottom:5px !important;
			}
			/* Shortcode List Categories */
			.vc_col-sm-3 .ts-list-of-product-categories-wrapper{
				background-size:55%;
			}
			/* Shortcode Feature */
			.feature-horizontal.img-people-horizontal .image-wrapper{
				width:105px;
				padding-right:15px;/* rtl */
			}
			.feature-horizontal.img-people-horizontal .image-wrapper img{
				max-width:90px;
			}
			.feature-horizontal.img-people-horizontal .feature-header{
				padding:12px 12px 12px 0;/* rtl */
			}
			.feature-horizontal .feature-header,
			.feature-horizontal.has-border.icon-bg-transparent .feature-header{
				padding-left:10px;/* rtl */
			}
			.feature-horizontal.thumbnail-circle .image-wrapper{
				width:60px;
			}
			.feature-horizontal.thumbnail-circle a.feature-thumbnail{
				height:60px;
				width:60px;
			}
			.feature-horizontal .image-wrapper{
				width:85px;
			}
			.ts-feature-wrapper.feature-horizontal img{
				max-width:54px;
			}
			.feature-horizontal.has-border .feature-header{
				padding:11px;/* rtl */
			}
			.feature-horizontal.has-border.icon-bg-transparent .feature-content,
			.feature-horizontal .feature-content {
				padding:15px 10px;
			}
			.feature-horizontal.img-people-horizontal .image-wrapper{
				width:70px;
				padding-right:15px /* rtl */
			}
			.feature-horizontal.img-people-horizontal .feature-header{
				padding:10px 5px 10px 0;/* rtl */
			}
			/* Team member */
			.ts-team-member .image-thumbnail{
				width:45%;
			}
			.ts-team-member .member-social{
				padding:5px 15px 5px 15px;
			}
			.ts-team-member header .member-excerpt{
				line-height:22px !important;
			}
			.ts-team-member header .member-excerpt{
				margin:5px 0;
			}
			.ts-team-member header{
				padding:15px 15px 40px 15px;/* rtl */
				width:55%;
			}
			/* PRODUCT DETAIL */
			.ts-col-18 .summary .detail-meta-wrapper{
				padding-top:10px;
			}
			body .ts-col-18 div.product .summary .ts-social-sharing{
				padding: 10px 0 0 0;
				margin: 10px 0 0 0;
			}
			.woocommerce .ts-col-18 div.product.vertical-thumbnail div.images-thumbnails,
			.woocommerce .ts-col-18 div.product.vertical-thumbnail div.summary{
				width:100%;
			}
			.woocommerce .ts-col-18 div.product.vertical-thumbnail div.summary{
				margin-top:20px;
				clear:both;
				padding:0;
			}
			.woocommerce .ts-col-18 div.product.vertical-thumbnail .images .product-label{
				right:auto;
				left:15px;/* rtl */
			}
			.woocommerce .ts-col-18 div.product .woocommerce-tabs.accordion-tabs{
				padding-top:20px;
			}
			.woocommerce #main-content:not(.ts-col-24) div.product.vertical-thumbnail .thumbnails{
				width:140px;
			}
			.woocommerce #main-content:not(.ts-col-24) div.product.vertical-thumbnail div.images-thumbnails div.images{
				margin-left:150px;/* rtl */
			}
			.woocommerce #main-content.ts-col-12 div.product.vertical-thumbnail .thumbnails{
				width:80px;
			}
			.woocommerce #main-content.ts-col-12 div.product.vertical-thumbnail div.images-thumbnails div.images{
				margin-left:90px;/* rtl */
			}
			.woocommerce div.product form.cart .variations{
				margin-top:0;
			}
			/* Group table */
			.woocommerce #main-content:not(.ts-col-24) div.product form.cart .group_table{
				margin-bottom:5px;
			}
			.woocommerce #main-content:not(.ts-col-24) div.product form.cart .group_table tr{
				margin-bottom:5px;
				display:inline-block;
				width:100%;
			}
			.woocommerce #main-content:not(.ts-col-24) div.product form.cart .group_table td{
				display:inline-block;
				width:50%;float:left; /* rtl */
				padding:5px 0 0 0;
			}
			.woocommerce #main-content:not(.ts-col-24) div.product form.cart .group_table td.label{
				clear:both;
				padding:8px 0 0 0;
			}
			/* End group table */
			.woocommerce div.product div.images-thumbnails,
			.woocommerce div.product div.summary{
				width:50%;
			}
			.woocommerce div.product.vertical-thumbnail div.images-thumbnails div.images{
				margin-left:80px /* rtl */
			}
			.woocommerce div.product.vertical-thumbnail .thumbnails{
				width:70px;
			}
			div.product.vertical-thumbnail .thumbnails li{
				padding-top:10px;
			}
			.woocommerce div.product.vertical-thumbnail .thumbnails{
				margin-top:-10px;
			}
			.vertical-thumbnail .images-thumbnails > .thumbnails .owl-nav > div.owl-next{
				top:12px;
			}
			/* 1 Sidebar */
			.woocommerce .ts-col-18 div.product div.summary{
				padding-left:15px; /* rtl */
			}
			.woocommerce .ts-col-18 div.product form.cart .button:before{
				display:none;
			}
			.woocommerce .ts-col-18 div.product form.cart .button{
				min-width:0;
			}
			/* CHECKOUT */
			.woocommerce ul#shipping_method li label{
				font-size:88%;
			}
			.ts-col-18 .woocommerce > form.checkout{
				padding-top:20px;
			}
			.ts-col-18 .checkout-login-coupon-wrapper{
				width:100%;
			}
			.ts-col-18 .woocommerce .checkout .col2-set{
				width:100%;
				padding-right:0 /* rtl */
			}
			.ts-col-18 .woocommerce .checkout #order_review{
				width:100%;
				margin-top:30px;
			}
			/* SHOPPING CART */
			.woocommerce table.shop_table td.actions{
				padding:10px;
			}
			.woocommerce table.cart td.product-thumbnail{
				padding:10px 0 10px 10px;/* rtl */
			}
			.woocommerce table.cart td{
				padding:10px 10px 10px 0;/* rtl */
			}
			.woocommerce table.shop_table .product-thumbnail{
				width:70px;
				max-width:70px;
			}
			.woocommerce table.shop_table td.actions{
				padding:10px;
			}
			/* BLOG */
			.list-posts .entry-content{
				padding-left:18px /* rtl */
			}
			.list-posts article .entry-meta > span, 
			article.single .entry-meta > span{
				padding-right:10px;/* rtl */
				margin-right:10px;/* rtl */
			}
			.list-posts article .entry-meta > span:last-child,
			article.single .entry-meta > span:last-child{
				margin:0;
				padding:0;
			}
			.list-posts .heading-title{
				margin-bottom:6px;
			}
			.single-post .entry-format .thumbnail{
				padding-right:18px;/* rtl */
				width:52%;
			}
			/* FOOTER */
			/* Subscription */
			body .ts-footer-block .style-fullwidth .widget h2.widgettitle,
			.mc4wp-form-fields .mailchimp-wrapper h2.title{
				width:33%;
			}
			footer .style-fullwidth .feedburner-subscription > div, 
			.mc4wp-form-fields .mailchimp-wrapper .mailchimp-input{
				width:67%;
				max-width:67%;
			}
		}
		@media 
		only screen and (max-width: 1000px){
			.custom-six-col-footer > div:nth-child(4){
				clear:both;
			}
			.custom-six-col-footer .vc_col-sm-2,
			.custom-six-col-footer .vc_col-sm-2:first-child{
				width:33.3334%;
			}
		}
		<?php if(isset($data['ts_enable_rtl']) && $data['ts_enable_rtl'] == 1 ): ?>
		@media only screen and (max-width: 1229px){
			/* HEADER */
			.header-v1 .shopping-cart-wrapper a.cart-control{
				padding:16px 23px;/* rtl */
			}
			/* Portfolio */
			.ts-portfolio-wrapper.columns-3 .item,
			.ts-portfolio-wrapper.columns-4 .item{
				float:right;/* rtl */
			}
			/* MY ACCOUNT */
			.woocommerce form.login .button, 
			.woocommerce form.register .button{
				margin:0 0 0 10px;/* rtl */
			}
			.woocommerce-account .woocommerce-MyAccount-content{
				padding-left:0;
				padding-right:20px;/* rtl */
			}
			/* TAB COMMENT */
			.woocommerce-tabs #comments,
			.ts-col-18 .woocommerce-tabs #comments,
			.ts-col-12 .woocommerce-tabs #comments{
				padding-left:0;
				padding-right:0;/* rtl */
			}
			.woocommerce-tabs #review_form_wrapper,
			.ts-col-18 .woocommerce-tabs #review_form_wrapper,
			.ts-col-12 .woocommerce-tabs #review_form_wrapper{
				border:0;/* rtl */
				padding:0 /* rtl */
			}
			/* BLOG */
			.entry-format .ts-social-sharing{
				text-align:right; /* rtl */
			}
			.list-posts .ts-social-sharing .sharing-title{
				margin:4px 0 0 10px; /* rtl */
				float:right
			}
			/* BLOG DETAIL */
			.commentlist .children{
				padding:10px 20px 0 0; /* rtl */
			}
			/* SHOPPING CART */
			.woocommerce table.shop_table td.product-thumbnail{
				padding-right:20px; /* rtl */
				padding-left:0;
			}
			
			/* 1229px - 768px */
			
			/* HEADER */
			/* Header version 2 */
			.header-v2 .shopping-cart-wrapper .cart-control{
				padding-left:20px; /* rtl */
				padding-right:0;
			}
			.header-v2 .menu-wrapper nav > ul.menu > li{
				margin-left:10px; /* rtl */
				margin-right:0;
			}
			.header-v2.show-cart .ts-menu > .pc-menu{
				margin-left:50px;/* rtl */
				margin-right:0;
			}
			.header-v2.has-vertical-menu .ts-menu > .pc-menu{
				margin-right:227px;/* rtl */
				margin-left:0;
			}
			.header-v2.has-vertical-menu.show-cart .ts-menu > .pc-menu{
				margin-right:227px;/* rtl */
				margin-left:50px
			}
			.vertical-menu-big .header-template .menu-wrapper .vertical-menu > ul.menu > li > a,
			.vertical-menu-big .header-template .menu-wrapper .vertical-menu > ul.menu > li > a:first-child{
				padding:10px 10px 10px 0;/* rtl */
			}
			.vertical-menu-big .header-template .menu-wrapper .vertical-menu > ul.menu > li > a.has-icon,
			.vertical-menu-big .header-template .menu-wrapper .vertical-menu > ul.menu > li > a.has-icon:first-child{
				padding-right:10px;/* rtl */
				padding-left:0;
			}
			.vertical-menu-big .header-template .menu-wrapper .vertical-menu > ul.menu > li > a,
			.vertical-menu-big .header-template .menu-wrapper .vertical-menu > ul.menu > li > a:first-child{
				padding-left:10px;/* rtl */
				padding-right:0;
			}
			.vertical-menu-big .header-template .menu-wrapper .vertical-menu > ul.menu li .menu-icon{
				display:none;
			}
			/* Header version 4 */
			.header-v4.has-vertical-menu .search-wrapper{
				margin-right:208px; /* rtl */
				margin-left:0;
			}
			.header-v4.has-vertical-menu .search-content{
				margin-right:0;/* rtl */
				margin-left:208px;
			}
			.header-v4 .search-content{
				margin-left:208px;/* rtl */
				margin-right:2px;
			}
			body .header-template .menu-wrapper nav.vertical-menu > ul.menu > li > a,
			body .header-template .menu-wrapper nav.vertical-menu > ul.menu > li > a:first-child{
				padding:9px 10px 10px 0;/* rtl */
			}
			/* Header version 6 */
			.header-v6 .menu-wrapper .ts-menu > nav > ul.menu > li > a{
				padding:13px 15px 13px 15px;
			}
			.header-v6 .ts-menu > nav.pc-menu > ul.menu > li > .ts-menu-drop-icon{
				left:5px; /* rtl */
				right:auto;
			}
			.header-v6 .ts-menu > nav > ul.menu li:before{
				right:8px;/* rtl */
				left:auto;
			}
			.header-v6 .menu-wrapper .ts-menu > nav > ul.menu > li.fa > a{
				padding-right:23px; /* rtl */
				padding-left:15px;
			}
			.header-v6 .menu-wrapper .ts-menu > nav > ul.menu > li.parent > a,
			.header-v6 .menu-wrapper .ts-menu > nav > ul.menu > li.menu-item-has-children:not(.parent) > a{
				padding-left:23px ;/* rtl */
				padding-right:15px;
			}
			.header-v6 .menu-wrapper .ts-menu > nav > ul.menu > li.fa.parent > a,
			.header-v6 .menu-wrapper .ts-menu > nav > ul.menu > li.fa.menu-item-has-children:not(.parent) > a{
				padding-right:23px; /* rtl */
				padding-left:23px;
			}
			/* SHOP PAGE */
			/* WIDGET */
			/* Widget TS Menu */
			.widget-container .vertical-menu > ul.menu > li > a,
			.widget-container .vertical-menu > ul.menu > li > a:first-child{
				padding:10px 10px 10px 0;/* rtl */
			}
			/* Widget Cart */
			.widget_shopping_cart .total .amount{
				float:left;/* rtl */
			}
			/* Widget padding */
			.widget-container .owl-nav, 
			.widget .owl-nav{
				left:0; /* rtl */
				right:auto;
			}
			.widget.ts-products-widget .owl-nav{
				left:0;/* rtl */
				right:auto;
			}
			.post_list_widget .entry-meta > span{
				padding-left:5px;/* rtl */
				padding-right:0;/* rtl */
				margin-left:5px;/* rtl */
				margin-right:0;/* rtl */
			}
			.ts-recent-comments-widget .widget-title,
			.ts-blogs-widget .widget-title,
			.ts-products-widget .widget-title{
				padding-left:30px;
				padding-right:10px;/* rtl */
			}
			.widget_shopping_cart .total-title{
				left:auto;/* rtl */
				right:10px;
			}
			.widget.ts-products-widget .owl-nav{
				left:0;/* rtl */
				right:0;
			}
			/* Tab blog */
			section.ts-blogs-tabs-widget .post_list_widget .blog-info{
				margin-left:0;/* rtl */
				margin-right:0;
			}
			.widget-container .post_list_widget .thumbnail{
				float:none; /* rtl */
			}
			/* BLOG DETAIL */
			#comment-wrapper .info-wrapper{
				float:none;/* rtl */
				margin-right:0;/* rtl */
				margin-left:0;
			}
			#comment-wrapper .message-wrapper{
				float:none; /* rtl */
			}
			/* SHOPPING CART */
			.ts-col-12 .woocommerce table.shop_table tr td:before{
				float: right;/* rtl */
			}
			.ts-col-12 .woocommerce table.shop_table tr td{
				text-align:left;/* rtl */
			}
			.ts-col-12 .woocommerce table.shop_table td.product-name{
				text-align:left;/* rtl */
			}
			.ts-col-12 .woocommerce table.cart td.actions .coupon{
				float:none;/* rtl */
			}
			.ts-col-12  .woocommerce table.cart td.actions .coupon .input-text{
				margin-right:0;
				margin-left:2%;/* rtl */
			}
			.woocommerce-cart .ts-col-12 .cart-collaterals .cart_totals table tr.shipping td{
				text-align:left;/* rtl */
			}
			.woocommerce-cart .ts-col-12 ul#shipping_method{
				float:left;/* rtl */
				text-align:left/* rtl */
			}
			.woocommerce-cart .ts-col-12 .woocommerce-shipping-calculator{
				float:left;/* rtl */
			}

			/* 1229px - 991px */
			/* HEADER */
			/* Header version 9 */
			.header-v9 .ts-menu > nav.pc-menu > ul.menu > li > .ts-menu-drop-icon{
				right:auto;
				left:7px;/* rtl */
			}
			/* Header Vertical */
			.vertical-menu-wrapper .vertical-menu-heading,
			.vertical-menu-big .vertical-menu-wrapper .vertical-menu-heading{
				padding:13px 14px; /* rtl */
			}
			/* Header version 3 */
			.header-v3 .menu-wrapper nav > ul.menu > li{
				padding:0 0 0 12px;/* rtl */
				margin:0 0 0 12px;/* rtl */
			}
			/* Header version 4 */
			.header-v4 .menu-wrapper nav > ul.menu > li{
				margin:0 0 0 10px;/* rtl */
			}
			.fix-vertical-menu-3columns .vc_col-sm-6{
				padding-right:2px;
				padding-left:1px;/* rtl */
			}
			/* Header version 5 */
			.header-v5 .header-middle .header-left > div{
				margin-right:40px;/* rtl */
				margin-left:0;
			}
			.header-v5 .header-middle .header-left > div:before{
				right:-20px;/* rtl */
				left:auto;
			}
			/* Header Right */
			.header-v5 .header-middle .header-right > div{
				margin-left:40px;/* rtl */
				margin-right:0;
			}
			.header-v5 .header-middle .header-right > div:before{
				left:-20px;/* rtl */
				right:auto;
			}
			/* WIDGET */
			/* Widget products */
			.widget .ts-products-widget-wrapper ul li, 
			.woocommerce .widget .ts-products-widget-wrapper ul li{
				padding:0 10px 15px 0;/* rtl */
			}
			ul.product_list_widget li .ts-wg-meta{
				margin-right:64px; /* rtl */
				margin-left:0;
			}
			.widget_shopping_cart ul.product_list_widget li .ts-wg-meta{
				margin-right:64px; /* rtl */
				margin-left:10px;
			}
			.widget.ts-products-widget ul.product_list_widget li .ts-wg-meta{
				margin-right:64px; /* rtl */
				margin-left:0;
			}
			.fix-vertical-menu-3columns .widget.ts-products-widget li .ts-wg-meta{
				margin-left:0; /* rtl */
				margin-right:0;
			}
			/* SHORTCODE */
			/* Shortcode Blog */
			.ts-blogs-split-wrapper .item-small .entry-content{
				padding-right:10px; /* rtl */
				padding-left:0;
			}
			.ts-blogs-split-wrapper .item-small{
				padding-right:10px; /* rtl */
				padding-left:0;
			}
			/* Shortcode Feature */
			.feature-horizontal.img-people-horizontal .image-wrapper{
				padding-right:0;
				padding-left:15px;/* rtl */
			}
			.feature-horizontal.img-people-horizontal .feature-header{
				padding:12px 0 12px 12px;/* rtl */
			}
			.feature-horizontal .feature-header,
			.feature-horizontal.has-border.icon-bg-transparent .feature-header{
				padding-right:10px;/* rtl */
				padding-left:0;
			}
			.feature-horizontal.has-border .feature-header{
				padding:11px;/* rtl */
			}
			.feature-horizontal.img-people-horizontal .image-wrapper{
				padding-right:0;
				padding-left:15px /* rtl */
			}
			.feature-horizontal.img-people-horizontal .feature-header{
				padding:10px 0 10px 5px;/* rtl */
			}
			/* Team member */
			.ts-team-member header{
				padding:15px 15px 40px 15px;/* rtl */
			}
			/* PRODUCT DETAIL */
			.woocommerce .ts-col-18 div.product.vertical-thumbnail .images .product-label{
				left:auto;
				right:15px;/* rtl */
			}
			.woocommerce #main-content:not(.ts-col-24) div.product.vertical-thumbnail div.images-thumbnails div.images{
				margin-right:150px;/* rtl */
				margin-left:0;
			}
			.woocommerce #main-content.ts-col-12 div.product.vertical-thumbnail div.images-thumbnails div.images{
				margin-right:90px;/* rtl */
				margin-left:0;
			}
			/* Group table */
			.woocommerce #main-content:not(.ts-col-24) div.product form.cart .group_table td{
				float:right; /* rtl */
			}
			/* End group table */
			.woocommerce div.product.vertical-thumbnail div.images-thumbnails div.images{
				margin-right:80px; /* rtl */
				margin-left:0;
			}
			/* 1 Sidebar */
			.woocommerce .ts-col-18 div.product div.summary{
				padding-right:15px; /* rtl */
				padding-left:0;
			}
			/* CHECKOUT */
			.ts-col-18 .woocommerce .checkout .col2-set{
				padding-left:0;
				padding-right:0 /* rtl */
			}
			/* SHOPPING CART */
			.woocommerce table.cart td{
				padding:10px 10px 10px 0;/* rtl */
			}
			.woocommerce table.cart td.product-thumbnail{
				padding:10px 0 10px 10px;/* rtl */
			}
			/* BLOG */
			.list-posts .entry-content{
				padding-right:18px; /* rtl */
				padding-left:0;
			}
			.list-posts article .entry-meta > span, 
			article.single .entry-meta > span{
				padding-left:10px;/* rtl */
				padding-right:0;/* rtl */
				margin-left:10px;/* rtl */
				margin-right:0;/* rtl */
			}
			.single-post .entry-format .thumbnail{
				padding-left:18px;/* rtl */
				padding-right:0;
			}
		}
		<?php endif;?>

	<?php else: ?>
		@media 
		only screen and (max-width: 991px){
			.woocommerce .products .product.product-category h3,
			.woocommerce .list .products .product .price .amount,
			.ts-product-deals-slider-wrapper span.amount{
				font-size:14px;
				line-height:18px;
			}
			.list .product h3.product-name > a{
				font-size:13px;
				line-height:18px;
			}
		}
		@media only screen and (max-width: 767px){
			.group-meta-header:before{
				background-color:<?php echo esc_html($ts_top_header_background_color) ?>;
			}
			.ts-header .header-v3 .search-wrapper input[type="text"]{
				border-color:<?php echo esc_html($ts_border_color) ?>;
			}
			.header-v5 .header-middle{
				background-color:<?php echo esc_html($ts_middle_header_background_color) ?>;/* Header middle background */
			}
			.header-top .my-account-wrapper .account-control > a:hover,
			header.ts-header .header-template .my-wishlist-wrapper a:hover,
			header.ts-header .header-template #lang_sel_click > ul > li > a:hover,
			header.ts-header .header-template .wpml-ls > ul > li.wpml-ls-item > a,
			header.ts-header .header-template .header-currency > div > a:hover,
			.header-template .shopping-cart-wrapper .ic-cart:before{
				color:<?php echo esc_html($ts_primary_color) ?>;/* primary color */
			}
			.shopping-cart-wrapper a.cart-control span.amount{
				font-size:16px !important;
				line-height:22px !important;
				font-style:normal;
			}
		}
		@media only screen and (max-device-width: 767px){
			/* COMPARE */
			body #yith-woocompare table.compare-list{
				overflow:auto;
			}
			body #yith-woocompare table.compare-list tbody td img{
				width:100px;
			}
			body #yith-woocompare table.compare-list th{
				display:none !important;
			}
			body #yith-woocompare table.compare-list th, 
			body #yith-woocompare table.compare-list tbody td{
				width:auto;
			}
			body.woocommerce > h1{
				padding-left:10px;
				padding-right:10px;
			}
			body #yith-woocompare table.compare-list .add-to-cart td a{
				min-width:0;
			}
			body #yith-woocompare table.compare-list tr.remove td,
			body .dataTables_wrapper table.compare-list tr.remove th{
				padding-top:10px;
				padding-bottom:0;
			}
			body #yith-woocompare table.compare-list tr tbody th, 
			body #yith-woocompare table.compare-list tr tbody td{
				padding:10px;
			}
		}
	<?php endif; ?>
	
	/* ============= 10. PRODUCT HOVER ============== */
	
	<?php if( $data['ts_effect_hover_product_style'] == 'style-1' ){?>
		.product-group-button{
			visibility:hidden;
		}
		.product-group-button.one-button{
			width:32px;
			position:absolute;
			top:50%;
			width:32px;
			margin-top:-16px;
			left:50%;
			margin-left:-16px;
			z-index:4;
			transform:scale(0,0);
			-webkit-transform:scale(0,0);
			-moz-transform:scale(0,0);
			-ms-transform:scale(0,0);
			transition:transform 250ms ease-in-out 0s;
			-webkit-transition:transform 250ms ease-in-out 0s;
			-moz-transition:transform 250ms ease-in-out 0s;
		}
		.thumbnail-wrapper:hover .one-button{
			transform:scale(1,1);
			-webkit-transform:scale(1,1);
			-moz-transform:scale(1,1);
			-ms-transform:scale(1,1);
			visibility:visible;
		}
		.product-group-button-meta:before{
			display:table;
			clear:both;
			content:"";
		}
		.product-wrapper:hover .meta-wrapper div.wishlist,
		.product-wrapper:hover .meta-wrapper div.compare{
			visibility:visible;
			-webkit-animation-duration: 400ms;
			-moz-animation-duration: 400ms;
			animation-duration: 400ms;
			-webkit-animation-fill-mode: both;
			-moz-animation-fill-mode: both;
			animation-fill-mode: both;
			
			-webkit-animation-name: run_meta_button;
			-moz-animation-name: run_meta_button;
			animation-name: run_meta_button;
			
			backface-visibility:hidden;
			-moz-backface-visibility:hidden;
			-webkit-backface-visibility:hidden;
		}
		.meta-center .product-wrapper .product-group-button-meta > div{
			float:none;
		}
		.product-wrapper .meta-wrapper .product-group-button-meta:not(.has-add-to-cart) > div{
			-webkit-animation-name: none !important;
			-moz-animation-name: none !important;
			animation-name: none !important;
			visibility:visible !important;
		}
		.meta-center .product-wrapper .product-group-button-meta.has-wishlist.has-add-to-cart:not(.has-compare) > div{
			margin-right:4px;
			margin-left:0;
			-webkit-animation-name: none;
			-moz-animation-name: none;
			animation-name: none;
			visibility:visible;
		}
		.meta-center .product-wrapper .product-group-button-meta.has-compare.has-add-to-cart:not(.has-wishlist) > div{
			margin-left:4px;
			margin-right:0;
			-webkit-animation-name: none;
			-moz-animation-name: none;
			animation-name: none;
			visibility:visible;
		}
		.meta-center .product-wrapper:hover .has-wishlist.has-compare div.wishlist,
		.product-meta-center .product-wrapper:hover .has-wishlist.has-compare div.wishlist{
			visibility:visible;
			-webkit-animation-duration: 400ms;
			-moz-animation-duration: 400ms;
			animation-duration: 400ms;
			-webkit-animation-fill-mode: both;
			-moz-animation-fill-mode: both;
			animation-fill-mode: both;
			
			-webkit-animation-name: run_meta_center_button;
			-moz-animation-name: run_meta_center_button;
			animation-name: run_meta_center_button;
			
			backface-visibility:hidden;
			-moz-backface-visibility:hidden;
			-webkit-backface-visibility:hidden;
		}
		.product-meta-center .products.list .product-wrapper:hover .has-wishlist.has-compare div.wishlist{
			-webkit-animation-name: run_meta_button !important;
			-moz-animation-name: run_meta_button !important;
			animation-name: run_meta_button !important;
		}
		.woocommerce .meta-wrapper .loop-add-to-cart,
		.meta-wrapper div.wishlist,
		.meta-wrapper div.compare{
			display:inline-block;
		}
		<?php if(isset($data['ts_enable_rtl']) && $data['ts_enable_rtl'] == 0 ): ?>
		@-webkit-keyframes run_meta_button {
			from {
				opacity:0;
				transform:translate(20px,0);
				-moz-transform:translate(20px,0);
				-webkit-transform:translate(20px,0);
				-ms-transform:translate(20px,0);
			}
			to {
				opacity:1;
				transform:translate(0,0);
				-moz-transform:translate(0,0);
				-webkit-transform:translate(0,0);
				-ms-transform:translate(0,0);
			}
		}

		@-moz-keyframes run_meta_button {
			from {
				opacity:0;
				transform:translate(20px,0);
				-moz-transform:translate(20px,0);
				-webkit-transform:translate(20px,0);
				-ms-transform:translate(20px,0);
			}
			to {
				opacity:1;
				transform:translate(0,0);
				-moz-transform:translate(0,0);
				-webkit-transform:translate(0,0);
				-ms-transform:translate(0,0);
			}
		}
		@keyframes run_meta_button {
			from {
				opacity:0;
				transform:translate(20px,0);
				-moz-transform:translate(20px,0);
				-webkit-transform:translate(20px,0);
				-ms-transform:translate(20px,0);
			}
			to {
				opacity:1;
				transform:translate(0,0);
				-moz-transform:translate(0,0);
				-webkit-transform:translate(0,0);
				-ms-transform:translate(0,0);
			}
		}
		@-webkit-keyframes run_meta_center_button {
			from {
				opacity:0;
				transform:translate(-20px,0);
				-moz-transform:translate(-20px,0);
				-webkit-transform:translate(-20px,0);
				-ms-transform:translate(-20px,0);
			}
			to {
				opacity:1;
				transform:translate(0,0);
				-moz-transform:translate(0,0);
				-webkit-transform:translate(0,0);
				-ms-transform:translate(0,0);
			}
		}

		@-moz-keyframes run_meta_center_button {
			from {
				opacity:0;
				transform:translate(-20px,0);
				-moz-transform:translate(-20px,0);
				-webkit-transform:translate(-20px,0);
				-ms-transform:translate(-20px,0);
			}
			to {
				opacity:1;
				transform:translate(0,0);
				-moz-transform:translate(0,0);
				-webkit-transform:translate(0,0);
				-ms-transform:translate(0,0);
			}
		}
		@keyframes run_meta_center_button {
			from {
				opacity:0;
				transform:translate(-20px,0);
				-moz-transform:translate(-20px,0);
				-webkit-transform:translate(-20px,0);
				-ms-transform:translate(-20px,0);
			}
			to {
				opacity:1;
				transform:translate(0,0);
				-moz-transform:translate(0,0);
				-webkit-transform:translate(0,0);
				-ms-transform:translate(0,0);
			}
		}
		<?php endif; ?>
		<?php if(isset($data['ts_enable_rtl']) && $data['ts_enable_rtl'] == 1 ): ?>
		@-webkit-keyframes run_meta_button {
			from {
				opacity:0;
				transform:translate(-20px,0);
				-moz-transform:translate(-20px,0);
				-webkit-transform:translate(-20px,0);
				-ms-transform:translate(-20px,0);
			}
			to {
				opacity:1;
				transform:translate(0,0);
				-moz-transform:translate(0,0);
				-webkit-transform:translate(0,0);
				-ms-transform:translate(0,0);
			}
		}

		@-moz-keyframes run_meta_button {
			from {
				opacity:0;
				transform:translate(-20px,0);
				-moz-transform:translate(-20px,0);
				-webkit-transform:translate(-20px,0);
				-ms-transform:translate(-20px,0);
			}
			to {
				opacity:1;
				transform:translate(0,0);
				-moz-transform:translate(0,0);
				-webkit-transform:translate(0,0);
				-ms-transform:translate(0,0);
			}
		}
		@keyframes run_meta_button {
			from {
				opacity:0;
				transform:translate(-20px,0);
				-moz-transform:translate(-20px,0);
				-webkit-transform:translate(-20px,0);
				-ms-transform:translate(-20px,0);
			}
			to {
				opacity:1;
				transform:translate(0,0);
				-moz-transform:translate(0,0);
				-webkit-transform:translate(0,0);
				-ms-transform:translate(0,0);
			}
		}
		
		@-webkit-keyframes run_meta_center_button {
			from {
				opacity:0;
				transform:translate(20px,0);
				-moz-transform:translate(20px,0);
				-webkit-transform:translate(20px,0);
				-ms-transform:translate(20px,0);
			}
			to {
				opacity:1;
				transform:translate(0,0);
				-moz-transform:translate(0,0);
				-webkit-transform:translate(0,0);
				-ms-transform:translate(0,0);
			}
		}

		@-moz-keyframes run_meta_center_button {
			from {
				opacity:0;
				transform:translate(20px,0);
				-moz-transform:translate(20px,0);
				-webkit-transform:translate(20px,0);
				-ms-transform:translate(20px,0);
			}
			to {
				opacity:1;
				transform:translate(0,0);
				-moz-transform:translate(0,0);
				-webkit-transform:translate(0,0);
				-ms-transform:translate(0,0);
			}
		}
		@keyframes run_meta_center_button {
			from {
				opacity:0;
				transform:translate(20px,0);
				-moz-transform:translate(20px,0);
				-webkit-transform:translate(20px,0);
				-ms-transform:translate(20px,0);
			}
			to {
				opacity:1;
				transform:translate(0,0);
				-moz-transform:translate(0,0);
				-webkit-transform:translate(0,0);
				-ms-transform:translate(0,0);
			}
		}
		<?php endif; ?>
	<?php }elseif($data['ts_effect_hover_product_style'] == 'style-2'){ ?>
		.thumbnail-button{
			text-align:center;
			position:absolute;
			width:auto;
			top:50%;
			left:50%;
			transform:translate(-50%,-50%);
			-webkit-transform:translate(-50%,-50%);
			-moz-transform:translate(-50%,-50%);
			-ms-transform:translate(-50%,-50%);
			z-index:4;
			visibility:hidden;
			display:inline-block;
			width:100%;
		}
		.thumbnail-wrapper:hover .thumbnail-button{
			visibility:visible;
		}
		.thumbnail-wrapper .product-group-button{
			display:inline-block;
		}
		.woocommerce .item-border.grid .meta-wrapper{
			margin-bottom:0;
		}
		.thumbnail-wrapper .product-group-button > div{
			transform:translate(0,-30px);
			-webkit-transform:translate(0,-30px);
			-moz-transform:translate(0,-30px);
			-ms-transform:translate(0,-30px);
			transition: all 0.3s ease-in-out 0s;
			-moz-transition: all 0.3s ease-in-out 0s;
			-webkit-transition: all 0.3s ease-in-out 0s;
			visibility:hidden;
			opacity:0;
			margin:2px;
		}
		.thumbnail-wrapper .product-group-button > div:first-child{
			transform:translate(-30px,0);/* rtl */
			-webkit-transform:translate(-30px,0);/* rtl */
			-moz-transform:translate(-30px,0);/* rtl */
			-ms-transform:translate(-30px,0);/* rtl */
		}
		.thumbnail-wrapper .product-group-button > div:last-child{
			transform:translate(30px,0);/* rtl */
			-webkit-transform:translate(30px,0);/* rtl */
			-moz-transform:translate(30px,0);/* rtl */
			-ms-transform:translate(30px,0);/* rtl */
		}
		.thumbnail-wrapper:hover .product-group-button > div,
		.thumbnail-wrapper:hover .product-group-button > div:first-child,
		.thumbnail-wrapper:hover .product-group-button > div:last-child{
			transform:translate(0,0);
			-webkit-transform:translate(0,0);
			-moz-transform:translate(0,0);
			-ms-transform:translate(0,0);
			visibility:visible;
			opacity:1;
		}
		.product-wrapper .thumbnail-wrapper .product-group-button.one-button > div{
			transform:scale(0,0);
			-webkit-transform:scale(0,0);
			-moz-transform:scale(0,0);
			-ms-transform:scale(0,0);
		}
		.product-wrapper .thumbnail-wrapper:hover .product-group-button.one-button > div{
			transform:scale(1,1);
			-webkit-transform:scale(1,1);
			-moz-transform:scale(1,1);
			-ms-transform:scale(1,1);
		}
		.woocommerce .product .meta-wrapper .loop-add-to-cart{
			display:none
		}
		.woocommerce .product .thumbnail-wrapper .loop-add-to-cart{
			margin-top:10px;
			opacity:0;
			width:100%;
			visibility:hidden;
			display:inline-block;
			transform:translate(0,20px);/* rtl */
			-webkit-transform:translate(0,20px);/* rtl */
			-moz-transform:translate(0,20px);/* rtl */
			-ms-transform:translate(0,20px);/* rtl */
			transition: all 0.3s ease-in-out 0s;
			-moz-transition: all 0.3s ease-in-out 0s;
			-webkit-transition: all 0.3s ease-in-out 0s;
		}
		.woocommerce .product .thumbnail-wrapper:hover .loop-add-to-cart{
			visibility:visible;
			opacity:1;
			transform:translate(0,0);/* rtl */
			-webkit-transform:translate(0,0);/* rtl */
			-moz-transform:translate(0,0);/* rtl */
			-ms-transform:translate(0,0);/* rtl */
		}
		.woocommerce .product .thumbnail-wrapper .loop-add-to-cart a.button{
			background:none !important;
			border:0 !important;
			padding:0 !important;
			color:#fff;
		}
		.woocommerce .product .thumbnail-wrapper .loop-add-to-cart a.button:before{
			content:"+";
			margin-right:5px;
			transition: none;
			-moz-transition: none;
			-webkit-transition: none;
		}
		<?php if(isset($data['ts_enable_rtl']) && $data['ts_enable_rtl'] == 1 ): ?>
		.thumbnail-wrapper .product-group-button > div:first-child{
			transform:translate(30px,0);/* rtl */
			-webkit-transform:translate(30px,0);/* rtl */
			-moz-transform:translate(30px,0);/* /* rtl */rtl */
			-ms-transform:translate(30px,0);
		}
		.thumbnail-wrapper .product-group-button > div:last-child{
			transform:translate(-30px,0);/* rtl */
			-webkit-transform:translate(-30px,0);/* rtl */
			-moz-transform:translate(-30px,0);/* rtl */
			-ms-transform:translate(-30px,0);/* rtl */
		}
		.woocommerce .product .thumbnail-wrapper .loop-add-to-cart{
			transform:translate(0,20px);/* rtl */
			-webkit-transform:translate(0,20px);/* rtl */
			-moz-transform:translate(0,20px);/* rtl */
			-ms-transform:translate(0,20px);/* rtl */
		}
		.woocommerce .product .thumbnail-wrapper:hover .loop-add-to-cart{
			transform:translate(0,0);/* rtl */
			-webkit-transform:translate(0,0);/* rtl */
			-moz-transform:translate(0,0);/* rtl */
			-ms-transform:translate(0,0);/* rtl */
		}
		.woocommerce .product .thumbnail-wrapper .loop-add-to-cart a.button:before{
			margin-left:5px;/* rtl */
			margin-right:0;
		}
		<?php endif ?>
	<?php } ?>
	<?php if( isset($data['ts_bottom_header_padding']) && $data['ts_bottom_header_padding'] == 0 ): ?>
	body.boxed .header-v1 .header-bottom .container,
	body.header-boxed header.ts-header .header-v1 .header-bottom .container{
		padding:0;
	}
	.header-product-categories{
		padding:9px 14px;
	}
	.ts-slider.header-product-categories .owl-nav > div.owl-prev{
		left:-1px; /* rtl */
		right:auto;
	}
	.ts-slider.header-product-categories .owl-nav > div.owl-next{
		right:-1px; /* rtl */
		left:auto;
	}
	<?php if( isset($data['ts_enable_rtl']) && $data['ts_enable_rtl'] == 1 ): ?>
	.ts-slider.header-product-categories .owl-nav > div.owl-prev{
		right:-1px; /* rtl */
		left:auto;
	}
	.ts-slider.header-product-categories .owl-nav > div.owl-next{
		left:-1px; /* rtl */
		right:auto;
	}
	<?php endif; ?>
	<?php endif ?>
	
	/* Custom CSS */
	<?php 
	if( !empty($ts_custom_css_code) ){
		echo html_entity_decode( trim( $ts_custom_css_code ) );
	}
	?>