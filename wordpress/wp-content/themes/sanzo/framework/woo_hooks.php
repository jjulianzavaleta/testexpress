<?php
/*************************************************
* WooCommerce Custom Hook                        *
**************************************************/

/*** Shop - Category ***/

/* Remove hook */
remove_action('woocommerce_before_main_content', 'woocommerce_output_content_wrapper', 10);
remove_action('woocommerce_before_main_content', 'woocommerce_breadcrumb', 20, 0);
remove_action('woocommerce_after_main_content', 'woocommerce_output_content_wrapper_end', 10);

remove_action('woocommerce_before_shop_loop', 'woocommerce_result_count', 20);

remove_action('woocommerce_before_shop_loop_item_title', 'woocommerce_show_product_loop_sale_flash', 10);
remove_action('woocommerce_before_shop_loop_item_title', 'woocommerce_template_loop_product_thumbnail', 10);

remove_action('woocommerce_shop_loop_item_title', 'woocommerce_template_loop_product_title', 10);

remove_action('woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_price', 10);
remove_action('woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_rating', 5);

remove_action('woocommerce_before_shop_loop_item', 'woocommerce_template_loop_product_link_open', 10);
remove_action('woocommerce_after_shop_loop_item', 'woocommerce_template_loop_add_to_cart', 10);
remove_action('woocommerce_after_shop_loop_item', 'woocommerce_template_loop_product_link_close', 5);

remove_action('woocommerce_before_subcategory', 'woocommerce_template_loop_category_link_open', 10);
remove_action('woocommerce_after_subcategory', 'woocommerce_template_loop_category_link_close', 10);

/* Add new hook */

add_action('woocommerce_before_shop_loop_item_title', 'sanzo_template_loop_product_thumbnail', 10);
add_action('woocommerce_after_shop_loop_item_title', 'sanzo_template_loop_product_label', 1);

add_action('woocommerce_before_shop_loop', 'woocommerce_result_count', 40);

add_action('woocommerce_after_shop_loop_item', 'sanzo_template_loop_categories', 10);
add_action('woocommerce_after_shop_loop_item', 'sanzo_template_loop_product_title', 20);
add_action('woocommerce_after_shop_loop_item', 'sanzo_template_loop_product_sku', 30);
add_action('woocommerce_after_shop_loop_item', 'woocommerce_template_loop_rating', 40);
add_action('woocommerce_after_shop_loop_item', 'woocommerce_template_loop_price', 50);
add_action('woocommerce_after_shop_loop_item', 'sanzo_template_loop_short_description', 60); 
add_action('woocommerce_after_shop_loop_item', 'sanzo_template_loop_short_description_listview', 65); 
add_action('woocommerce_after_shop_loop_item', 'sanzo_template_loop_add_to_cart', 70);

/******************
* 70: add to cart
* 71: wishlist
* 72: compare
*******************/
add_action('woocommerce_after_shop_loop_item', 'sanzo_template_loop_meta_group_button_before', 69);
add_action('woocommerce_after_shop_loop_item', 'sanzo_template_loop_meta_group_button_after', 73);

add_filter('loop_shop_per_page', 'sanzo_change_products_per_page_shop' ); 
add_filter('woocommerce_product_get_rating_html', 'sanzo_get_empty_rating_html', 10, 2);

add_filter('woocommerce_before_output_product_categories', 'sanzo_before_output_product_categories');
add_filter('woocommerce_after_output_product_categories', 'sanzo_after_output_product_categories');

function sanzo_product_get_availability(){
	global $product;
	$availability = $class = '';
	if ( ! $product->is_in_stock() ) {
		$availability = esc_html__( 'Out of stock', 'sanzo' );
	} elseif ( $product->managing_stock() && $product->is_on_backorder( 1 ) ) {
		$availability = esc_html__( 'Available on backorder', 'sanzo' );
	} elseif ( $product->managing_stock() ) {
		$availability = wc_format_stock_for_display( $product );
	} else {
		$availability = '';
	}
	
	if ( ! $product->is_in_stock() ) {
		$class = 'out-of-stock';
	} elseif ( $product->managing_stock() && $product->is_on_backorder( 1 ) ) {
		$class = 'available-on-backorder';
	} else {
		$class = 'in-stock';
	}

	return array( 'availability' => $availability, 'class' => $class );
}

function sanzo_template_loop_product_label(){
	global $product, $post, $sanzo_theme_options;
	$out_of_stock = false;
	$product_stock = sanzo_product_get_availability();
	if( isset($product_stock['class']) && $product_stock['class'] == 'out-of-stock' ){
		$out_of_stock = true;
	}
	?>
	<div class="product-label">
	<?php 
	/* New label */
	if( !empty($sanzo_theme_options['ts_product_show_new_label']) && !$out_of_stock ){
		$now = current_time( 'timestamp', true );
		$post_date = get_post_time('U', true);
		$num_day = (int)( ( $now - $post_date ) / ( 3600*24 ) );
		$num_day_setting = absint( $sanzo_theme_options['ts_product_show_new_label_time'] );
		if( $num_day <= $num_day_setting ){
			echo '<span class="new">'.esc_html(stripslashes($sanzo_theme_options['ts_product_new_label_text'])).'</span>';
		}
	}
	
	/* Sale label */
	if( $product->is_on_sale() && !$out_of_stock ){ 
		if( $product->get_regular_price() > 0 && $sanzo_theme_options['ts_show_sale_label_as'] != 'text' ){
			$_off_percent = (1 - round($product->get_price() / $product->get_regular_price(), 2))*100;
			$_off_price = round($product->get_regular_price() - $product->get_price(), 0);
			$_price_symbol = get_woocommerce_currency_symbol();
			if( $sanzo_theme_options['ts_show_sale_label_as'] == 'number' ){
			
				$symbol_pos = get_option('woocommerce_currency_pos', 'left');
				$price_display = '';
				switch( $symbol_pos ){
					case 'left':
						$price_display = '-'.$_price_symbol.$_off_price;
					break;
					case 'right':
						$price_display = '-'.$_off_price.$_price_symbol;
					break;
					case 'left_space':
						$price_display = '-'.$_price_symbol.' '.$_off_price;
					break;
					default: /* right_space */
						$price_display = '-'.$_off_price.' '.$_price_symbol;
					break;
				}
				 
				echo '<span class="onsale amount" data-original="'.$price_display.'">'.$price_display.'</span>';
			}
			if( $sanzo_theme_options['ts_show_sale_label_as'] == 'percent' ){
				echo '<span class="onsale percent">-'.$_off_percent.'%</span>';
			}
		}
		else{
			echo '<span class="onsale">'.esc_html(stripslashes($sanzo_theme_options['ts_product_sale_label_text'])).'</span>';
		}
		
	}
	
	/* Hot label */
	if( $product->is_featured() && !$out_of_stock ){
		echo '<span class="featured">'.esc_html(stripslashes($sanzo_theme_options['ts_product_feature_label_text'])).'</span>';
	}
	
	/* Out of stock */
	if( $out_of_stock ){
		echo '<span class="out-of-stock">'.esc_html(stripslashes($sanzo_theme_options['ts_product_out_of_stock_label_text'])).'</span>';
	}
	?>
	</div>
	<?php
}

function sanzo_template_loop_product_thumbnail(){
	global $product, $sanzo_theme_options;
	$lazy_load = isset($sanzo_theme_options['ts_prod_lazy_load']) && $sanzo_theme_options['ts_prod_lazy_load'] && !( defined( 'DOING_AJAX' ) && DOING_AJAX );
	$placeholder_img_src = isset($sanzo_theme_options['ts_prod_placeholder_img'])?$sanzo_theme_options['ts_prod_placeholder_img']:wc_placeholder_img_src();
	
	if( defined( 'YITH_INFS' ) && (is_shop() || is_product_taxonomy()) ){ /* Compatible with YITH Infinite Scrolling */
		$lazy_load = false;
	}
	
	$prod_galleries = $product->get_gallery_image_ids();
	
	$has_back_image = (isset($sanzo_theme_options['ts_effect_product']) && (int)$sanzo_theme_options['ts_effect_product'] == 0)?false:true;
	
	if( !is_array($prod_galleries) || ( is_array($prod_galleries) && count($prod_galleries) == 0 ) ){
		$has_back_image = false;
	}
	 
	if( wp_is_mobile() ){
		$has_back_image = false;
	}
	
	$image_size = apply_filters('sanzo_loop_product_thumbnail', 'woocommerce_thumbnail');
	
	$dimensions = wc_get_image_size( $image_size );
	
	echo '<figure class="'.(($has_back_image)?'has-back-image':'no-back-image').'">';
		if( !$lazy_load ){
			echo woocommerce_get_product_thumbnail( $image_size );
			if( $has_back_image ){
				echo wp_get_attachment_image( $prod_galleries[0], $image_size, 0, array('class' => 'product-image-back') );
			}
		}
		else{
			$front_img_src = '';
			$alt = '';
			if( has_post_thumbnail( $product->get_id() ) ){
				$post_thumbnail_id = get_post_thumbnail_id($product->get_id());
				$image_obj = wp_get_attachment_image_src($post_thumbnail_id, $image_size, 0);
				if( isset($image_obj[0]) ){
					$front_img_src = $image_obj[0];
				}
				$alt = trim(strip_tags( get_post_meta($post_thumbnail_id, '_wp_attachment_image_alt', true) ));
			}
			else if( wc_placeholder_img_src() ){
				$front_img_src = wc_placeholder_img_src();
			}
			
			echo '<img src="'.esc_url($placeholder_img_src).'" data-src="'.esc_url($front_img_src).'" class="attachment-shop_catalog wp-post-image ts-lazy-load" alt="'.esc_attr($alt).'" width="'.$dimensions['width'].'" height="'.$dimensions['height'].'" />';
			
			if( $has_back_image ){
				$back_img_src = '';
				$alt = '';
				$image_obj = wp_get_attachment_image_src($prod_galleries[0], $image_size, 0);
				if( isset($image_obj[0]) ){
					$back_img_src = $image_obj[0];
					$alt = trim(strip_tags( get_post_meta($prod_galleries[0], '_wp_attachment_image_alt', true) ));
				}
				else if( wc_placeholder_img_src() ){
					$back_img_src = wc_placeholder_img_src();
				}
				
				echo '<img src="'.esc_url($placeholder_img_src).'" data-src="'.esc_url($back_img_src).'" class="product-image-back ts-lazy-load" alt="'.esc_attr($alt).'" width="'.$dimensions['width'].'" height="'.$dimensions['height'].'" />';
			}
		}
	echo '</figure>';
}

function sanzo_template_loop_product_title(){
	global $post;
	$url = esc_url(get_permalink($post->ID));
	echo "<h3 class=\"heading-title product-name\">";
	echo "<a href='{$url}'>". esc_attr(get_the_title()) ."</a>";
	echo "</h3>";
}

function sanzo_template_loop_add_to_cart(){
	global $sanzo_theme_options;
	
	if( $sanzo_theme_options['ts_enable_catalog_mode'] ){
		return;
	}
	
	echo "<div class='loop-add-to-cart'>";
	woocommerce_template_loop_add_to_cart();
	echo "</div>";
}

function sanzo_template_loop_meta_group_button_before(){
	global $sanzo_theme_options;
	$is_catalog_mod = $sanzo_theme_options['ts_enable_catalog_mode'];
	
	$has_wishlist = has_action('woocommerce_after_shop_loop_item', 'sanzo_add_wishlist_button_to_product_list');
	$has_compare = has_action('woocommerce_after_shop_loop_item', 'sanzo_add_compare_button_to_product_list');
	$has_add_to_cart = has_action('woocommerce_after_shop_loop_item', 'sanzo_template_loop_add_to_cart') && !$is_catalog_mod;
	$classes = array();
	$classes[] = $has_wishlist?'has-wishlist':'';
	$classes[] = $has_compare?'has-compare':'';
	$classes[] = $has_add_to_cart?'has-add-to-cart':'';
	echo '<div class="product-group-button-meta '.implode(' ', $classes).'">';
}

function sanzo_template_loop_meta_group_button_after(){
	echo '</div>';
}

function sanzo_template_loop_product_sku(){
	global $product;
	echo '<span class="product-sku">' . esc_html__('SKU: ', 'sanzo') . esc_attr($product->get_sku()) . '</span>';
}

function sanzo_template_loop_short_description(){
	global $post, $sanzo_theme_options;
	$has_grid_list = get_option('ts_enable_glt', 'yes') == 'yes';
	$grid_limit_words = absint($sanzo_theme_options['ts_prod_cat_grid_desc_words']);
	$grid_limit_words = apply_filters('sanzo_grid_short_desc_limit_words', $grid_limit_words);
	$show_grid_desc = $sanzo_theme_options['ts_prod_cat_grid_desc'];
	
	if( empty($post->post_excerpt) ){
		return;
	}
	
	if( !(is_tax( get_object_taxonomies( 'product' ) ) || is_post_type_archive('product')) ):
	?>
	<div class="short-description">
		<?php sanzo_the_excerpt_max_words($grid_limit_words, '', true, '', true); ?>
	</div>
	<?php
	else:
		if( $show_grid_desc ):
		?>
			<div class="short-description grid" style="<?php echo ($has_grid_list)?'display: none':''; ?>" >
				<?php sanzo_the_excerpt_max_words($grid_limit_words, '', true, '', true); ?>
			</div>
		<?php
		endif;
	endif;
}

function sanzo_template_loop_short_description_listview(){
	global $sanzo_theme_options;
	$list_limit_words = absint($sanzo_theme_options['ts_prod_cat_list_desc_words']);
	$show_list_desc = $sanzo_theme_options['ts_prod_cat_list_desc'];
	$is_archive = is_tax( get_object_taxonomies( 'product' ) ) || is_post_type_archive('product');
	if( $show_list_desc && $is_archive ):
	?>
		<div class="short-description list" style="display: none" >
			<?php sanzo_the_excerpt_max_words($list_limit_words, '', true, '', true); ?>
		</div>
	<?php
	endif;
}

function sanzo_template_loop_categories(){
	global $product;
	$categories_label = esc_html__('Categories: ', 'sanzo');
	echo wc_get_product_category_list($product->get_id(), ', ', '<div class="product-categories"><span>'.$categories_label.'</span>', '</div>');
}

function sanzo_change_products_per_page_shop( $posts_per_page ){
	global $sanzo_theme_options;
    if( is_tax( get_object_taxonomies( 'product' ) ) || is_post_type_archive('product') ){
        if( absint($sanzo_theme_options['ts_prod_cat_per_page']) > 0 ){
            return absint($sanzo_theme_options['ts_prod_cat_per_page']);
        }
    }
	return $posts_per_page;
}

function sanzo_get_empty_rating_html( $rating_html, $rating ){
	if( $rating == 0 ){
		$rating_html  = '<div class="star-rating no-rating" title="">';
		$rating_html .= '<span style="width:0%"></span>';
		$rating_html .= '</div>';
	}
	return $rating_html;
}

function sanzo_before_output_product_categories(){
	return '<div class="list-categories">';
}

function sanzo_after_output_product_categories(){
	return '</div>';
}
/*** End Shop - Category ***/



/*** Single Product ***/

/* Remove hook */
remove_action('woocommerce_before_single_product_summary', 'woocommerce_show_product_sale_flash', 10);
remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_title', 5);
remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_price', 10);
remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_meta', 40);
remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_sharing', 50);
remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_rating', 10);


/* Add hook */
add_action('sanzo_before_product_image', 'sanzo_template_loop_product_label', 10);
add_action('sanzo_before_product_image', 'sanzo_template_single_product_video_button', 20);

add_action('woocommerce_single_product_summary', 'sanzo_template_single_navigation', 1);
add_action('woocommerce_single_product_summary', 'woocommerce_template_single_title', 1);
add_action('woocommerce_single_product_summary', 'sanzo_template_single_availability', 2);
add_action('woocommerce_single_product_summary', 'sanzo_template_single_rating_sku_before', 3);
add_action('woocommerce_single_product_summary', 'woocommerce_template_single_rating', 3);
add_action('woocommerce_single_product_summary', 'sanzo_template_single_sku', 4);
add_action('woocommerce_single_product_summary', 'sanzo_template_single_rating_sku_after', 4);
add_action('woocommerce_single_product_summary', 'woocommerce_template_single_price', 5);
add_action('woocommerce_single_product_summary', 'sanzo_template_single_compare_wishlist_before', 7);
add_action('woocommerce_single_product_summary', 'sanzo_template_single_compare_wishlist_after', 9);
add_action('woocommerce_single_product_summary', 'sanzo_template_single_meta', 60);
add_action('woocommerce_single_product_summary', 'woocommerce_template_single_sharing', 70);

add_action('woocommerce_after_single_product_summary', 'sanzo_product_ads_banner', 1);

add_action('woocommerce_share', 'sanzo_template_social_sharing', 10);
if( function_exists('ts_template_loop_time_deals') ){
	add_action('woocommerce_single_product_summary', 'ts_template_loop_time_deals', 20);
}

add_filter('woocommerce_product_description_heading', '__return_empty_string');
add_filter('woocommerce_product_additional_information_heading', '__return_empty_string');

add_filter('woocommerce_output_related_products_args', 'sanzo_output_related_products_args_filter');

add_filter('yith_wcwl_positions', 'sanzo_yith_wcwl_positions_filter');

if( !is_admin() ){ /* Fix for WooCommerce Tab Manager plugin */
	add_filter( 'woocommerce_product_tabs', 'sanzo_product_remove_tabs', 999 );
	add_filter( 'woocommerce_product_tabs', 'sanzo_add_product_custom_tab', 90 );
}

add_action('wp_ajax_sanzo_load_product_video', 'sanzo_load_product_video' );
add_action('wp_ajax_nopriv_sanzo_load_product_video', 'sanzo_load_product_video' );
/*** End Product ***/

function sanzo_template_single_product_video_button(){
	if( wp_is_mobile() ){
		return;
	}
	global $product;
	$video_url = get_post_meta($product->get_id(), 'ts_prod_video_url', true);
	if( !empty($video_url) ){
		$ajax_url = admin_url('admin-ajax.php', is_ssl()?'https':'http').'?ajax=true&action=sanzo_load_product_video&product_id='.$product->get_id();
		echo '<a class="ts-product-video-button" href="'.esc_url($ajax_url).'"></a>';
	}
}

/* Single Product Video - Register ajax */
function sanzo_load_product_video(){
	if( empty($_GET['product_id']) ){
		die( esc_html__('Invalid Product', 'sanzo') );
	}
	
	$prod_id = absint($_GET['product_id']);

	if( $prod_id == 0 ){
		die( esc_html__('Invalid Product', 'sanzo') );
	}
	
	$video_url = get_post_meta($prod_id, 'ts_prod_video_url', true);
	ob_start();
	if( !empty($video_url) ){
		echo do_shortcode('[ts_video src='.esc_url($video_url).']');
	}
	die( ob_get_clean() );
}

function sanzo_template_single_navigation(){
	global $sanzo_theme_options;
	if( isset($sanzo_theme_options['ts_prod_next_prev_navigation']) && !$sanzo_theme_options['ts_prod_next_prev_navigation'] ){
		return;
	}
	$prev_post = get_adjacent_post(false, '', true, 'product_cat');
	$next_post = get_adjacent_post(false, '', false, 'product_cat');
	?>
	<div class="single-navigation <?php echo !($prev_post && $next_post)?'one-button':'' ?>">
	<?php 
		if( $prev_post ){
			$post_id = $prev_post->ID;
			$product = wc_get_product($post_id);
			?>
			<div class="prev">
				<a href="<?php echo esc_url( get_permalink($post_id) ); ?>" rel="prev"></a>
				<div class="product-info prev-product-info">
					<?php echo $product->get_image(); ?>
					<div>
						<span><?php echo esc_html($product->get_title()); ?></span>
						<span class="price"><?php echo $product->get_price_html(); ?></span>
					</div>
				</div>
			</div>
			<?php
		}
		
		if( $next_post ){
			$post_id = $next_post->ID;
			$product = wc_get_product($post_id);
			?>
			<div class="next">
				<a href="<?php echo esc_url( get_permalink($post_id) ); ?>" rel="next"></a>
				<div class="product-info next-product-info">
					<?php echo $product->get_image(); ?>
					<div>
						<span><?php echo esc_html($product->get_title()); ?></span>
						<span class="price"><?php echo $product->get_price_html(); ?></span>
					</div>
				</div>
			</div>
			<?php
		}
	?>
	</div>
	<?php
}

function sanzo_template_single_meta(){
	global $product, $post, $sanzo_theme_options;
	
	echo '<div class="detail-meta-wrapper">';
		do_action( 'woocommerce_product_meta_start' );
		if( $sanzo_theme_options['ts_prod_cat'] ){
			echo wc_get_product_category_list( $product->get_id(), ', ', '<div class="cats-link"><span>' . esc_html__( 'Categories:', 'sanzo' ) . '</span><span class="cat-links">', '</span></div>' );
		}
		if( $sanzo_theme_options['ts_prod_tag'] ){
			echo wc_get_product_tag_list( $product->get_id(), ', ', '<div class="tags-link"><span>' . esc_html__( 'Tags:', 'sanzo' ) . '</span><span class="tag-links">', '</span></div>' );	
		}
		do_action( 'woocommerce_product_meta_end' );
	echo '</div>';
}

function sanzo_template_single_sku(){
	global $product;
	if ( wc_product_sku_enabled() && ( $product->get_sku() || $product->is_type( 'variable' ) ) ){
		echo '<div class="sku-wrapper product_meta">' . esc_html__( 'SKU: ', 'sanzo' ) . '<span class="sku" itemprop="sku">' . (( $sku = $product->get_sku() ) ? $sku : esc_html__( 'N/A', 'sanzo' )) . '</span></div>';
	}
}

function sanzo_template_single_rating_sku_before(){
	global $product;
	$rating_count = $product->get_rating_count();
	echo '<div class="rating-sku '.($rating_count == 0?'no-rating':'').'">';
}

function sanzo_template_single_rating_sku_after(){
	echo '</div>';
}

function sanzo_template_single_availability(){
	$product_stock = sanzo_product_get_availability();
	$availability_text = empty($product_stock['availability'])?esc_html__('In Stock', 'sanzo'):esc_attr($product_stock['availability']);
	?>	
		<p class="availability stock <?php echo esc_attr($product_stock['class']); ?>" data-original="<?php echo esc_attr($availability_text) ?>" data-class="<?php echo esc_attr($product_stock['class']) ?>"><span><?php echo esc_html($availability_text); ?></span></p>	
	<?php
}

/*** Product tab ***/
function sanzo_product_remove_tabs( $tabs = array() ){
	global $sanzo_theme_options;
	if( !$sanzo_theme_options['ts_prod_tabs'] ){
		return array();
	}
	return $tabs;
}

function sanzo_add_product_custom_tab( $tabs = array() ){
	global $sanzo_theme_options, $post;
	
	$custom_tab_title = $sanzo_theme_options['ts_prod_custom_tab_title'];
	
	$product_custom_tab = get_post_meta( $post->ID, 'ts_prod_custom_tab', true );
	if( $product_custom_tab ){
		$custom_tab_title = get_post_meta( $post->ID, 'ts_prod_custom_tab_title', true );
	}
	
	if( $sanzo_theme_options['ts_prod_custom_tab'] ){
		$tabs['ts_custom'] = array(
			'title'    	=> esc_html( $custom_tab_title )
			,'priority' => 90
			,'callback' => 'sanzo_product_custom_tab_content'
		);
	} 
	return $tabs;
}

function sanzo_product_custom_tab_content(){
	global $sanzo_theme_options, $post;
	
	$custom_tab_content = $sanzo_theme_options['ts_prod_custom_tab_content'];
	
	$product_custom_tab = get_post_meta( $post->ID, 'ts_prod_custom_tab', true );
	if( $product_custom_tab ){
		$custom_tab_content = get_post_meta( $post->ID, 'ts_prod_custom_tab_content', true );
	}
	
	echo do_shortcode( stripslashes( htmlspecialchars_decode( $custom_tab_content ) ) );
}

/* Ads Banner */
function sanzo_product_ads_banner(){
	global $sanzo_theme_options;
	
	if( $sanzo_theme_options['ts_prod_ads_banner'] ){
		$ads_banner_content = $sanzo_theme_options['ts_prod_ads_banner_content'];
		echo '<div class="ads-banner">';
		echo do_shortcode( stripslashes( htmlspecialchars_decode( $ads_banner_content ) ) );
		echo '</div>';
	}
}

/* Related Products */
function sanzo_output_related_products_args_filter( $args ){
	$args['posts_per_page'] = 6;
	$args['columns'] = 5;
	return $args;
}

/* Compare - Wishlist button wrapper */
function sanzo_template_single_compare_wishlist_before(){
	echo '<div class="compare-wishlist">';
}

function sanzo_template_single_compare_wishlist_after(){
	echo '</div>';
}

/* Change position of the wishlist button */
function sanzo_yith_wcwl_positions_filter( $positions ){
	$positions['add-to-cart'] = array('hook' => 'woocommerce_single_product_summary', 'priority' => 7);
	return $positions;
}

/* Change position of the compare button */
if( class_exists('YITH_Woocompare') && get_option('yith_woocompare_compare_button_in_product_page') == 'yes' ){
	global $yith_woocompare;
	if( $yith_woocompare->is_frontend() ) {
		remove_action( 'woocommerce_single_product_summary', array( $yith_woocompare->obj, 'add_compare_link' ), 35 );
		add_action( 'woocommerce_single_product_summary', array( $yith_woocompare->obj, 'add_compare_link' ), 8 );
	}
}

/*** General hook ***/

/*************************************************************
* Custom group button on product (quickshop, wishlist, compare) 
* Begin tag: 	10000
* Quickshop: 	10001
* Wishlist:  	10003
* Compare:   	10002
* End tag:   	10004
* Add To Cart: 	10005
**************************************************************/
function sanzo_product_buttons_on_thumbnail_before(){
	global $sanzo_theme_options;
	if( $sanzo_theme_options['ts_effect_hover_product_style'] == 'style-2' ){
		echo '<div class="thumbnail-button">';
	}
}
function sanzo_product_buttons_on_thumbnail_after(){
	global $sanzo_theme_options;
	if( $sanzo_theme_options['ts_effect_hover_product_style'] == 'style-2' ){
		echo '</div>';
	}
}
add_action('woocommerce_after_shop_loop_item_title', 'sanzo_product_buttons_on_thumbnail_before', 9999 );
add_action('woocommerce_after_shop_loop_item_title', 'sanzo_product_buttons_on_thumbnail_after', 10006 );

add_action('woocommerce_after_shop_loop_item_title', 'sanzo_template_loop_add_to_cart', 10005);
function sanzo_product_group_button_before(){
	global $sanzo_theme_options;
	$hover_style = $sanzo_theme_options['ts_effect_hover_product_style'];
	$num_icon = 0;
	
	if( $hover_style != 'style-2' ){
		remove_action('woocommerce_after_shop_loop_item_title', 'sanzo_template_loop_add_to_cart', 10005);
	}
	
	if( class_exists('Sanzo_Quickshop') ){
		$num_icon++;
	}
	if( class_exists('YITH_WCWL') && $hover_style == 'style-2' ){
		$num_icon++;
	}
	if( class_exists('YITH_Woocompare') && get_option('yith_woocompare_compare_button_in_products_list') == 'yes' && $hover_style == 'style-2' ){
		$num_icon++;
	}
	
	$classes = array(0 => '', 1 => 'one-button', 2 => 'two-button', 3 => 'three-button', 4 => 'four-button');
	
	echo "<div class=\"product-group-button {$classes[$num_icon]}\" >";
}

function sanzo_product_group_button_after(){
	echo "</div>";
}

add_action('woocommerce_after_shop_loop_item_title', 'sanzo_product_group_button_before', 10000 );
add_action('woocommerce_after_shop_loop_item_title', 'sanzo_product_group_button_after', 10004 );

/* Wishlist */
if( class_exists('YITH_WCWL') ){
	function sanzo_add_wishlist_button_to_product_list(){
		global $product, $yith_wcwl;
		
		$default_wishlists = is_user_logged_in() ? YITH_WCWL()->get_wishlists( array( 'is_default' => true ) ) : false;
		if( ! empty( $default_wishlists ) ){
			$default_wishlist = $default_wishlists[0]['ID'];
		}
		else{
			$default_wishlist = false;
		}
		
		$exists = YITH_WCWL()->is_product_in_wishlist( $product->get_id(), $default_wishlist );
		
		$wishlist_url = YITH_WCWL()->get_wishlist_url();
		
		$added_class = $exists?'added':'';
		
		echo '<div class="button-in wishlist add-to-wishlist-'.$product->get_id().' '.$added_class.'">';
			echo '<a href="' . esc_url( add_query_arg( 'add_to_wishlist', $product->get_id() ) )
				. '" data-product-id="' . $product->get_id() . '" data-product-type="' . $product->get_type() 
				. '" class="add_to_wishlist wishlist" ><i class="fa fa-heart"></i><span class="ts-tooltip button-tooltip">'.esc_html__('Wishlist', 'sanzo').'</span></a>';
			echo '<img src="'. get_template_directory_uri() . '/images/ajax-loader.gif' .'" class="ajax-loading" alt="loading" width="16" height="16" style="visibility:hidden" />';
			
			echo '<span class="yith-wcwl-wishlistaddedbrowse hide" style="display: none">';
				echo '<a href="'.esc_url($wishlist_url).'"><i class="fa fa-heart-o"></i><span class="ts-tooltip button-tooltip">'.esc_html__('Wishlist', 'sanzo').'</span></a>';
			echo '</span>';
			
			echo '<span class="yith-wcwl-wishlistexistsbrowse '.($exists?'show':'hide').'" style="'.($exists?'':'display: none').'">';
				echo '<a href="'.esc_url($wishlist_url).'"><i class="fa fa-heart-o"></i><span class="ts-tooltip button-tooltip">'.esc_html__('Wishlist', 'sanzo').'</span></a>';
			echo '</span>';
		
		echo '</div>';
	}
	global $sanzo_theme_options;
	$hover_style = isset($sanzo_theme_options['ts_effect_hover_product_style'])?$sanzo_theme_options['ts_effect_hover_product_style']:'style-1';
	if( $hover_style == 'style-2' ){
		add_action( 'woocommerce_after_shop_loop_item_title', 'sanzo_add_wishlist_button_to_product_list', 10003 );
	}
	add_action( 'woocommerce_after_shop_loop_item', 'sanzo_add_wishlist_button_to_product_list', 71 );
}

/* Compare */
if( class_exists('YITH_Woocompare') ){
	global $yith_woocompare, $sanzo_theme_options;
	$hover_style = isset($sanzo_theme_options['ts_effect_hover_product_style'])?$sanzo_theme_options['ts_effect_hover_product_style']:'style-1';
	$is_ajax = ( defined( 'DOING_AJAX' ) && DOING_AJAX );
	if( $yith_woocompare->is_frontend() || $is_ajax ){
		if( get_option('yith_woocompare_compare_button_in_products_list') == 'yes' ){
			if( $is_ajax ){
				if( defined('YITH_WOOCOMPARE_DIR') && !class_exists('YITH_Woocompare_Frontend') ){
					$compare_frontend_class = YITH_WOOCOMPARE_DIR . 'includes/class.yith-woocompare-frontend.php';
					if( file_exists($compare_frontend_class) ){
						require_once $compare_frontend_class;
					}
				}
				$yith_woocompare->obj = new YITH_Woocompare_Frontend();
			}
			remove_action( 'woocommerce_after_shop_loop_item', array( $yith_woocompare->obj, 'add_compare_link' ), 20 );
			function sanzo_add_compare_button_to_product_list(){
				global $yith_woocompare, $product;
				echo '<div class="button-in compare">';
				echo '<a class="compare" href="'.$yith_woocompare->obj->add_product_url( $product->get_id() ).'" data-product_id="'.$product->get_id().'">'.get_option('yith_woocompare_button_text').'</a>';
				echo '</div>';
			}
			if( $hover_style == 'style-2' ){
				add_action( 'woocommerce_after_shop_loop_item_title', 'sanzo_add_compare_button_to_product_list', 10002 );
			}
			add_action( 'woocommerce_after_shop_loop_item', 'sanzo_add_compare_button_to_product_list', 72 );
		}
		
		add_filter( 'option_yith_woocompare_button_text', 'sanzo_compare_button_text_filter', 99 );
		function sanzo_compare_button_text_filter( $button_text ){
			return '<i class="fa fa-exchange"></i><span class="ts-tooltip button-tooltip">'.esc_html($button_text).'</span>';
		}
	}
}

/*** End General hook ***/

/*** Cart - Checkout hooks ***/
remove_action( 'woocommerce_cart_collaterals', 'woocommerce_cross_sell_display', 10 );
add_action( 'woocommerce_after_cart', 'woocommerce_cross_sell_display', 10 );

add_action('woocommerce_proceed_to_checkout', 'sanzo_cart_continue_shopping_button', 20);

/* Continue Shopping button */
function sanzo_cart_continue_shopping_button(){
	echo '<a href="'.esc_url(wc_get_page_permalink('shop')).'" class="button button-secondary transparent">'.esc_html__('Continue Shopping', 'sanzo').'</a>';
}
?>
