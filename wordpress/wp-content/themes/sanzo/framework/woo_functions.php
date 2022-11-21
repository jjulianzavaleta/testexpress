<?php 
/*** Tiny account ***/
if( !function_exists('sanzo_tiny_account') ){
	function sanzo_tiny_account(){
		$login_url = '#';
		$register_url = '#';
		$profile_url = '#';
		$logout_url = wp_logout_url(get_permalink());
		
		if( class_exists('WooCommerce') ){ /* Active woocommerce */
			$myaccount_page_id = get_option( 'woocommerce_myaccount_page_id' );
			if ( $myaccount_page_id ) {
				$login_url = get_permalink( $myaccount_page_id );
				$register_url = $login_url;
				$profile_url = $login_url;
			}		
		}
		else{
			$login_url = wp_login_url();
			$register_url = wp_registration_url();
			$profile_url = admin_url( 'profile.php' );
		}
		global $wp;
		$redirect_to = home_url( add_query_arg( array(), $wp->request ) );
		
		$_user_logged = is_user_logged_in();
		ob_start();
		
		?>
		<div class="ts-tiny-account-wrapper">
			<div class="account-control">
				<?php if( !$_user_logged ): ?>
					<a class="login" href="<?php echo esc_url($login_url); ?>" title="<?php esc_html_e('Login or Register','sanzo'); ?>"><span><?php esc_html_e('Login or Register','sanzo');?></span></a>
				<?php else: ?>
					<a class="my-account" href="<?php echo esc_url($profile_url); ?>" title="<?php esc_html_e('My Account','sanzo'); ?>"><span><?php esc_html_e('My Account','sanzo');?></span></a> / 
					<a class="log-out" href="<?php echo esc_url($logout_url); ?>" title="<?php esc_html_e('Logout','sanzo'); ?>"><span><?php esc_html_e('Logout','sanzo');?></span></a>
				<?php endif; ?>
			</div>
			<?php if( !$_user_logged ): ?>
			<div class="account-dropdown-form dropdown-container">
				<div class="form-content">	
					<form name="ts-login-form" class="ts-login-form" action="<?php echo esc_url(wp_login_url()); ?>" method="post">
			
						<p class="login-username">
							<label><?php esc_html_e('Username or email address', 'sanzo'); ?></label>
							<input type="text" name="log" class="input" value="" size="20" autocomplete="off">
						</p>
						<p class="login-password">
							<label><?php esc_html_e('Password', 'sanzo'); ?></label>
							<input type="password" name="pwd" class="input" value="" size="20">
						</p>
						
						<p class="login-submit">
							<input type="submit" name="wp-submit" class="button-primary button" value="<?php esc_html_e('Login', 'sanzo'); ?>">
							<input type="hidden" name="redirect_to" value="<?php echo esc_url($redirect_to); ?>">
						</p>
						
					</form>
		
					<p class="forgot-pass"><a href="<?php echo esc_url(wp_lostpassword_url()); ?>" title="<?php esc_html_e('Forgot Your Password?','sanzo');?>"><?php esc_html_e('Forgot Your Password?','sanzo');?></a></p>
				</div>
			</div>
			<?php endif; ?>
		</div>
		
		<?php
		return ob_get_clean();
	}
}

/*** Tiny Cart ***/
if( !function_exists('sanzo_tiny_cart') ){
	function sanzo_tiny_cart(){
		if( !class_exists('WooCommerce') ){
			return '';
		}
		$cart_empty = WC()->cart->is_empty();
		$cart_url = wc_get_cart_url();
		$checkout_url = wc_get_checkout_url();
		$cart_number = WC()->cart->get_cart_contents_count();
		if( $cart_number != 0 ){
			$cart_number = zeroise($cart_number, 2);
		}
		ob_start();
		?>
			<div class="ts-tiny-cart-wrapper">
				<a class="cart-control" href="<?php echo esc_url($cart_url); ?>" title="<?php esc_html_e('View your shopping bag','sanzo');?>">
					<span class="ic-cart"><span class="cart-number"><?php echo esc_html($cart_number) ?></span></span>
					<span class="cart-total"><?php echo WC()->cart->get_cart_subtotal(); ?></span>
				</a>
				<span class="cart-drop-icon drop-icon"></span>
				<div class="cart-dropdown-form dropdown-container">
					<div class="form-content">
						<?php if( $cart_empty ): ?>
							<label><?php esc_html_e('Your shopping cart is empty', 'sanzo'); ?></label>
						<?php else: ?>
							<ul class="cart-list">
								<?php 
								$cart = WC()->cart->get_cart();
								foreach( $cart as $cart_item_key => $cart_item ):
									$_product = apply_filters( 'woocommerce_cart_item_product', $cart_item['data'], $cart_item, $cart_item_key );
									if ( !( $_product && $_product->exists() && $cart_item['quantity'] > 0 && apply_filters( 'woocommerce_widget_cart_item_visible', true, $cart_item, $cart_item_key ) ) ){
										continue;
									}
										
									$product_price = apply_filters( 'woocommerce_cart_item_price', WC()->cart->get_product_price( $_product ), $cart_item, $cart_item_key );
									$product_permalink = apply_filters( 'woocommerce_cart_item_permalink', $_product->is_visible() ? $_product->get_permalink( $cart_item ) : '', $cart_item, $cart_item_key );
								?>
									<li>
										<a href="<?php echo esc_url($product_permalink); ?>">
											<?php echo apply_filters( 'woocommerce_cart_item_thumbnail', $_product->get_image(), $cart_item, $cart_item_key ); ?>
										</a>
										<div class="cart-item-wrapper">	
											<h3 class="product-name">
												<a href="<?php echo esc_url($product_permalink); ?>">
													<?php echo apply_filters('woocommerce_cart_item_name', $_product->get_title(), $cart_item, $cart_item_key); ?>
												</a>
											</h3>
											<?php 
											echo apply_filters( 'woocommerce_widget_cart_item_quantity', '<span class="price">' . $product_price . '</span>', $cart_item, $cart_item_key );
											echo apply_filters( 'woocommerce_widget_cart_item_quantity', '<span class="quantity">x ' . $cart_item['quantity'] . '</span> ', $cart_item, $cart_item_key );
											echo apply_filters( 'woocommerce_cart_item_remove_link', sprintf('<a href="%s" class="remove remove_from_cart_button" title="%s" data-cart_item_key="%s">&times;</a>', esc_url( wc_get_cart_remove_url( $cart_item_key ) ), esc_html__( 'Remove this item', 'sanzo' ), $cart_item_key ), $cart_item_key ); 
											?>
										</div>
									</li>
								
								<?php endforeach; ?>
							</ul>
							<div class="dropdown-footer">
								<div class="total"><span class="total-title"><?php esc_html_e('Total:', 'sanzo');?></span><?php echo WC()->cart->get_cart_subtotal(); ?> </div>
								
								<a href="<?php echo esc_url($checkout_url); ?>" class="button checkout button-secondary transparent"><?php esc_html_e('Checkout', 'sanzo'); ?></a>
								<a href="<?php echo esc_url($cart_url); ?>" class="button view-cart button-primary transparent"><?php esc_html_e('View cart', 'sanzo'); ?></a>
							</div>
						<?php endif; ?>
					</div>
				</div>
			</div>
		<?php
		return ob_get_clean();
	}
}
add_filter('woocommerce_add_to_cart_fragments', 'sanzo_tiny_cart_filter');
function sanzo_tiny_cart_filter($fragments){
	$fragments['.ts-tiny-cart-wrapper'] = sanzo_tiny_cart();
	return $fragments;
}

/** Tini wishlist **/
function sanzo_tini_wishlist(){
	if( !(class_exists('WooCommerce') && class_exists('YITH_WCWL')) ){
		return;
	}
	
	ob_start();
	
	$wishlist_page_id = get_option( 'yith_wcwl_wishlist_page_id' );
	if( function_exists( 'wpml_object_id_filter' ) ){
		$wishlist_page_id = wpml_object_id_filter( $wishlist_page_id, 'page', true );
	}
	$wishlist_page = get_permalink( $wishlist_page_id );
	
	$count = yith_wcwl_count_products();
	
	?>

	<a title="<?php  esc_html_e('Wishlist','sanzo'); ?>" href="<?php echo esc_url($wishlist_page); ?>" class="tini-wishlist">
		<?php esc_html_e('Wishlist','sanzo'); ?> <?php echo '('.($count > 0?zeroise($count, 2):'0').')'; ?>
	</a>

	<?php
	$tini_wishlist = ob_get_clean();
	return $tini_wishlist;
}

function sanzo_update_tini_wishlist() {
	die(sanzo_tini_wishlist());
}

add_action('wp_ajax_sanzo_update_tini_wishlist', 'sanzo_update_tini_wishlist');
add_action('wp_ajax_nopriv_sanzo_update_tini_wishlist', 'sanzo_update_tini_wishlist');

if( !function_exists('sanzo_woocommerce_multilingual_currency_switcher') ){
	function sanzo_woocommerce_multilingual_currency_switcher(){
		if( class_exists('woocommerce_wpml') && class_exists('WooCommerce') && class_exists('SitePress') ){
			global $sitepress, $woocommerce_wpml;
			
			if( !isset($woocommerce_wpml->multi_currency) ){
				return;
			}
			
			$settings = $woocommerce_wpml->get_settings();
			
			$format = isset($settings['wcml_curr_template']) && $settings['wcml_curr_template'] != '' ? $settings['wcml_curr_template']:'%code%';
			$wc_currencies = get_woocommerce_currencies();
			if( !isset($settings['currencies_order']) ){
				$currencies = $woocommerce_wpml->multi_currency->get_currency_codes();
			}else{
				$currencies = $settings['currencies_order'];
			}
			
			$selected_html = '';
			foreach( $currencies as $currency ){
				if($woocommerce_wpml->settings['currency_options'][$currency]['languages'][$sitepress->get_current_language()] == 1 ){
					$currency_format = preg_replace(array('#%name%#', '#%symbol%#', '#%code%#'),
													array($wc_currencies[$currency], get_woocommerce_currency_symbol($currency), $currency), $format);
						
					if( $currency == $woocommerce_wpml->multi_currency->get_client_currency() ){
						$selected_html = '<a href="javascript: void(0)" class="wcml_selected_currency">'.$currency_format.'</a>';
						break;
					}
				}
			}
			
			echo '<div class="wcml_currency_switcher">';
				echo  $selected_html;
				echo '<ul>';
			
				foreach( $currencies as $currency ){
					if($woocommerce_wpml->settings['currency_options'][$currency]['languages'][$sitepress->get_current_language()] == 1 ){
						$currency_format = preg_replace(array('#%name%#', '#%symbol%#', '#%code%#'),
														array($wc_currencies[$currency], get_woocommerce_currency_symbol($currency), $currency), $format);
						echo '<li><a rel="' . $currency . '">' . $currency_format . '</a></li>';
					}
				}
				
				echo '</ul>';
			echo '</div>';
		}
		else if( class_exists('WOOCS') && class_exists('WooCommerce') ){ /* Support WooCommerce Currency Switcher */
			global $WOOCS;
			$currencies = $WOOCS->get_currencies();
			if( !is_array($currencies) ){
				return;
			}
			?>
			<div class="wcml_currency_switcher">
				<a href="javascript: void(0)" class="wcml_selected_currency"><?php echo esc_html($WOOCS->current_currency); ?></a>
				<ul>
					<?php 
					foreach( $currencies as $key => $currency ){
						$link = add_query_arg('currency', $currency['name']);
						echo '<li rel="'.$currency['name'].'"><a href="'.esc_url($link).'">'.esc_html($currency['name']).'</a></li>';
					}
					?>
				</ul>
			</div>
			<?php
		}else{/* Demo html */
			?>
			<div class="wcml_currency_switcher">
				<a href="javascript: void(0)" class="wcml_selected_currency">USD</a>
				<ul>
					<li><a rel="USD">USD</a></li>
					<li><a rel="EUR">EUR</a></li>
					<li><a rel="AUD">AUD</a></li>
				</ul>
			</div>
			<?php
		}
	}
}

add_filter( 'wcml_multi_currency_ajax_actions', 'sanzo_wcml_multi_currency_ajax_actions_filter' );
if( !function_exists('sanzo_wcml_multi_currency_ajax_actions_filter') ){
	function sanzo_wcml_multi_currency_ajax_actions_filter( $actions ){
		$actions[] = 'remove_from_wishlist';
		$actions[] = 'ts_get_product_content_in_category_tab';
		$actions[] = 'sanzo_load_quickshop_content';
		$actions[] = 'sanzo_ajax_search';
		return $actions;
	}
}

if( !function_exists('sanzo_wpml_language_selector') ){
	function sanzo_wpml_language_selector(){
		if( class_exists('SitePress') ){
			do_action('wpml_add_language_selector');
		}
		else{ /* Demo html */
			?>
			<div id="lang_sel_click" class="lang_sel_click">
				<ul>
					<li>
						<a href="#" class="lang_sel_sel icl-en"><img class="iclflag" alt="en" src="<?php echo get_template_directory_uri() . '/images/flag_en.png'; ?>" title="English"/>English</a>
						<ul style="visibility: hidden;">
							<li class="icl-fr"><a rel="alternate" href="#"><img class="iclflag" alt="fr" src="<?php echo get_template_directory_uri() . '/images/flag_fr.png'; ?>" title="French"/><span class="icl_lang_sel_native">French</span></a></li>
							<li class="icl-ge"><a rel="alternate" href="#"><img class="iclflag" alt="ge" src="<?php echo get_template_directory_uri() . '/images/flag_ge.png'; ?>" title="German"/><span class="icl_lang_sel_native">German</span></a></li>
							<li class="icl-cn"><a rel="alternate" href="#"><img class="iclflag" alt="cn" src="<?php echo get_template_directory_uri() . '/images/flag_cn.png'; ?>" title="Chinese"/><span class="icl_lang_sel_native">Chinese</span></a></li>
						</ul>
					</li>
				</ul>
			</div>
			<?php
		}
	}
}

if( !function_exists('sanzo_header_product_categories_slider') ){
	function sanzo_header_product_categories_slider(){
		global $sanzo_theme_options;
		if ( !class_exists('WooCommerce') ){
			return;
		}
		
		$number = (int) $sanzo_theme_options['ts_number_product_categories'];
		if( !$number ){
			$number = 10;
		}
		
		$include = trim($sanzo_theme_options['ts_include_product_categories']);
		
		$args = array(
			'orderby'     	=> 'name'
			,'order'      	=> 'ASC'
			,'hide_empty' 	=> true
			,'number'     	=> $number
			,'include'		=> $include
			,'hierarchical' => true
		);
		
		$args = apply_filters('sanzo_header_product_categories_slider_args', $args);
		
		$product_categories = get_terms('product_cat', $args);
		
		if( count($product_categories) > 0 ){
		?>
		<div class="header-product-categories ts-slider loading">
			<?php foreach( $product_categories as $cat ): 
				$thumbnail_id = get_term_meta( $cat->term_id, 'header_thumbnail_id', true );
				$link = get_term_link($cat->term_id, 'product_cat');
			?>
			<div class="item">
				<?php if( $thumbnail_id ): ?>
				<div class="thumbnail">
					<a href="<?php echo esc_url($link) ?>">
						<?php echo wp_get_attachment_image($thumbnail_id, 'thumbnail'); ?>
					</a>
				</div>
				<?php endif; ?>
				<div class="category-name">
					<h3 class="heading-title">
						<a href="<?php echo esc_url($link) ?>">
							<?php echo esc_html($cat->name); ?>
						</a>
					</h3>
				</div>
			</div>
			<?php endforeach; ?>
		</div>
		<?php
		}
	}
}
?>