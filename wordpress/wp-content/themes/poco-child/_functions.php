<?php
/**
	* Theme functions and definitions.
	*/

remove_action('poco_breadcrumb', 'poco_before_content', 10);

/**
  * SSL
	*/
	
function http_request_force_ssl_verify($args) {
	$args['sslverify'] = true;
	return $args;
}

add_filter('https_ssl_verify', '__return_true', PHP_INT_MAX);

add_filter('http_request_args', 'http_request_force_ssl_verify', PHP_INT_MAX);

/**
	* Añadir nuevos estados
	*/

function register_new_order_status() {
  register_post_status( 'wc-invoiced', array(
		'label'                     => 'Facturado',
		'public'                    => true,
		'show_in_admin_status_list' => true,
		'show_in_admin_all_list'    => true,
		'exclude_from_search'       => false,
		'label_count'               => _n_noop( 'Facturado', 'Facturado' )
  ) );

  register_post_status( 'wc-returned', array(
		'label'                     => 'Devuelto',
		'public'                    => true,
		'show_in_admin_status_list' => true,
		'show_in_admin_all_list'    => true,
		'exclude_from_search'       => false,
		'label_count'               => _n_noop( 'Devuelto', 'Devuelto' )
  ) );
}

add_action( 'init', 'register_new_order_status' );

function add_new_order_statuses( $order_statuses ) {
  $new_order_statuses = array();
  foreach ( $order_statuses as $key => $status ) {
		$new_order_statuses[ $key ] = $status;
		if ( 'wc-processing' === $key ) {
			$new_order_statuses['wc-invoiced'] = 'Facturado';
			$new_order_statuses['wc-returned'] = 'Devuelto';
		}
  }
  return $new_order_statuses;
}

add_filter( 'wc_order_statuses', 'add_new_order_statuses' );

/**
	* Reducir complejidad de contraseña de usuario 
	*/

function reduce_woocommerce_min_strength_requirement( $strength ) {
	return 1;
}

add_filter( 'woocommerce_min_password_strength', 'reduce_woocommerce_min_strength_requirement' );

/**
	* Redondear montos a 2 decimales
	*/

function two_decimal_price( $formatted_price, $price, $decimal_places, $decimal_separator, $thousand_separator ) {
	return number_format($price, 2, $decimal_separator, $thousand_separator );
}

add_filter( 'formatted_woocommerce_price', 'two_decimal_price', 10, 5 );

/**
	* Añadir selector de cantidad y botones + y -
	*/

function add_quantity_field() {

	/** @var WC_Product $product */
	$product = wc_get_product( get_the_ID() );

	if ( ! $product->is_sold_individually() && 'variable' != $product->get_type() && $product->is_purchasable() && $product->is_in_stock() ) {
		woocommerce_quantity_input( array( 'min_value' => 1, 'max_value' => $product->backorders_allowed() ? '' : $product->get_stock_quantity(), 'clasess' => '' ) );
	}

}

add_action( 'woocommerce_after_shop_loop_item', 'add_quantity_field', 12 );

function quantity_add_to_cart_handler() {

	wc_enqueue_js( '
		// click on quantity input
		$(".woocommerce .products").on("click", ".quantity input", function() {
			return false;
		});

		// change quantity
		$(".woocommerce .products").on("change input", ".quantity .qty", function() {
			var add_to_cart_button = $(this).parents( ".product" ).find(".add_to_cart_button");
			// console.log($(this).val());
			// For AJAX add-to-cart actions
			add_to_cart_button.attr("data-quantity", $(this).val());

			// For non-AJAX add-to-cart actions
			add_to_cart_button.attr("href", "?add-to-cart=" + add_to_cart_button.attr("data-product_id") + "&quantity=" + $(this).val());
		});

		// Trigger on Enter press
		$(".woocommerce .products").on("keypress", ".quantity .qty", function(e) {
			if ((e.which||e.keyCode) === 13) {
				$( this ).parents(".product").find(".add_to_cart_button").trigger("click");
			}
		});
	' );

}

add_action( 'init', 'quantity_add_to_cart_handler' );

/**
 * Mostrar "Agotado" en productos sin stock
 */
 
function display_sold_out_loop_woocommerce() {
	global $product;
	if ( ! $product->is_in_stock() ) {
		echo '<span class="soldout">Agotado</span>';
	}
}
 
add_action( 'woocommerce_before_shop_loop_item_title', 'display_sold_out_loop_woocommerce' );

/**
	* Ocultar categoría por defecto (bolsas) de los listados del widget y del listado de productos
	*/

function woo_hide_product_categories_widget( $list_args ){
 
	$list_args['exclude'] = get_option('default_product_cat');
	return $list_args;

}

add_filter('woocommerce_product_subcategories_args', 'woo_hide_product_categories_widget');
add_filter( 'woocommerce_product_categories_widget_args', 'woo_hide_product_categories_widget' );

/**
 * Añadir bolsa al carrito de compras al cargar otra url
 */

function recalculate_bags_on_cart() {
  if(!is_admin() && is_user_logged_in()) {
    global $woocommerce;
    $product_id = 166; //replace with your product id
    $found = false;
    $bag_capacity = 4.5; //replace with your cart total needed to add above item
    $cart_has_pavos = false;
    $user = wp_get_current_user();
    $roles = ( array ) $user->roles;

		$url_api_product_stock = ($_SERVER['SERVER_NAME'] == "localhost") ? "http://localhost/api/GET/product_stock.php?" : "../wp-content/themes/poco-child/product_stock.php?";

    // Set $cat_check true if a cart item is in pavos or panetones cat
    // foreach (WC()->cart->get_cart() as $cart_item_key => $cart_item) {
    //     $product = $cart_item['data'];

    //     if (has_term('pavos', 'product_cat', $product->id) || has_term('panetones', 'product_cat', $product->id)) {
    //         $cart_has_pavos = true;
    //         // break because we only need one "true" to matter here
    //         break;
    //     }
    // }

    if(WC()->cart->cart_contents_weight > 0 && !in_array($roles[0], array("xpress-market", "xpress-comercio", "xpress-polleria", "cliente-polleria"))) {
			$conte2 = floatval(WC()->cart->cart_contents_weight / $bag_capacity);
			$conte = ceil($conte2);

			// check if bag is already in cart
			if(sizeof($woocommerce->cart->get_cart()) > 0) {
				foreach($woocommerce->cart->get_cart() as $cart_item_key => $values) {
					$_product = $values['data'];
					if($_product->get_id() == $product_id){
						$found = true;
						$woocommerce->cart->set_quantity($cart_item_key, $conte);
					}
				}

				// if product not found, add it
				if (!$found)
					$woocommerce->cart->add_to_cart($product_id, $conte);
			}
    } else {
      // when weight is 0kg
      foreach($woocommerce->cart->get_cart() as $cart_item_key => $values) {
        $_product = $values['data'];
        if($_product->get_id() == $product_id){
          WC()->cart->remove_cart_item($cart_item_key);
        }
      }
    }

		if(is_checkout()){
			if ( ! WC()->cart->is_empty() ) {
				$message = '';
				$valid = true;
				foreach ( WC()->cart->get_cart() as $cart_item ) {
					$item_sku = $cart_item['data']->get_sku();
					$item_name = $cart_item['data']->get_title();
					$always_check_stock = $cart_item['data']->get_meta('always_check_stock');
					$shipping_delivery_type = get_user_meta( get_current_user_id(), 'shipping_delivery_type' , true );
					$shipping_state = get_user_meta( get_current_user_id(), 'shipping_state' , true );

					if( $item_sku != '101578'){
						$current_user = wp_get_current_user();
						$cookie_name = $current_user->user_login . "_shipping_obj";
						
						if(!empty($shipping_delivery_type) && !empty($shipping_state)) {

							if($shipping_delivery_type == 'xpress' || $always_check_stock == "yes"){
								$params = array("state" => $shipping_state, "sku" => $item_sku, "delivery_type" => $shipping_delivery_type);
								$url = $url_api_product_stock . http_build_query($params);

								$ch = curl_init();
								curl_setopt($ch, CURLOPT_URL, $url); 
								curl_setopt($ch, CURLOPT_RETURNTRANSFER, true); 
								curl_setopt($ch, CURLOPT_HEADER, 0); 
								$data = json_decode(curl_exec($ch), TRUE);
								curl_close($ch); 

								if (isset($data[0]['stock'])) {
									$max_allowed = $data[0]['stock'];
									if($cart_item['quantity'] > $max_allowed){
										$valid = false;
										$pre = (strlen($message) > 0) ? "\n" : "";
										$message .= $pre . 'Solo disponemos de ' . $max_allowed . ' unidades de ' . $item_name . ' en nuestro almacén';
									}
								}
							}
						} else {
							$message = 'Por favor seleccione el lugar de entrega en la parte superior';
						}
					}
				}
				if(!$valid){
					wc_add_notice( __( $message, 'woocommerce' ), 'error' );
					wp_safe_redirect( get_permalink( get_option('woocommerce_cart_page_id') ) );
					exit();
				}
			}
		}
  }
}

add_action('template_redirect', 'recalculate_bags_on_cart');

/**
 * Añadir bolsas depués de añadir producto al carrito
 */

function add_bags_to_cart() {
  $bag_id = 166;
  $found = false;
  $bag_capacity = 4.5;
  $cart_contents_weight = WC()->cart->cart_contents_weight;
  $bag_item_key = '';
  $user = wp_get_current_user();
  $roles = ( array ) $user->roles;

  $bags = ceil(floatval($cart_contents_weight / $bag_capacity));

  //check if product already in cart
  foreach(WC()->cart->get_cart() as $cart_item_key => $values) {
    if($values['data']->get_id() == $bag_id){
      $found = true;
      $bag_item_key = $cart_item_key;
      WC()->cart->set_quantity($cart_item_key, $bags);
    }
  }

  if(!in_array($roles[0], array("xpress-market", "xpress-comercio", "xpress-polleria", "cliente-polleria"))){
    // if product not found, add it
    if (!$found){
      WC()->cart->add_to_cart($bag_id, $bags);
    }
  } else {
    WC()->cart->remove_cart_item($bag_item_key);
  }
}

add_action('woocommerce_add_to_cart', 'add_bags_to_cart');

/**
  * Eliminar bolsa cuando en el carrito no quedan productos
  */

function remove_from_cart() {
  global $woocommerce;
  $in_cart = false;

  foreach($woocommerce->cart->get_cart() as $cart_item_key => $cart_item) {
    if($cart_item['product_id'] === 166 || $cart_item['product_id'] === 534) {
      $in_cart = true;
      $key = $cart_item_key;
      break;
    }
  }

  if(WC()->cart->cart_contents_weight <= 0){
    if($in_cart)
      WC()->cart->remove_cart_item($key);
  }
}

add_action( 'woocommerce_cart_updated', 'remove_from_cart');

/**
  * Validar stock de producto en el carrito antes de agregarlo
  */

function woocommerce_add_to_cart_stock_validation( $passed, $product_id, $quantity, $variation_id = null, $variations = null ) {
	$current_user = wp_get_current_user();
	$url_api_product_stock = ($_SERVER['SERVER_NAME'] == "localhost") ? "../wp-content/themes/poco-child/product_stock.php?" : "../wp-content/themes/poco-child/product_stock.php?";

	$shipping_delivery_type = get_user_meta( get_current_user_id(), 'shipping_delivery_type' , true );
	$shipping_state = get_user_meta( get_current_user_id(), 'shipping_state' , true );

	if($current_user != "0"){
		if(!empty($shipping_delivery_type) && !empty($shipping_state)) {
			$product = wc_get_product( $product_id );
			$always_check_stock = $product->get_meta('always_check_stock');

			if($shipping_delivery_type == 'xpress' || $always_check_stock == "yes"){
				$params = array("state" => $shipping_state, "sku" => $product->get_sku(), "delivery_type" => $shipping_delivery_type);
				$url = $url_api_product_stock . http_build_query($params);
				
				$ch = curl_init();
				curl_setopt($ch, CURLOPT_URL, $url); 
				curl_setopt($ch, CURLOPT_RETURNTRANSFER, true); 
				curl_setopt($ch, CURLOPT_HEADER, 0); 
				$data = json_decode(curl_exec($ch), TRUE);
				curl_close($ch); 

				if (isset($data[0]['stock'])) {
					$max_allowed = $data[0]['stock'];

					$message = 'Solo disponemos de ' . $max_allowed . ' unidades de este producto en nuestro almacén';
					
					if ( $quantity > $max_allowed ) {
						wc_add_notice( __( $message, 'woocommerce' ), 'error' );
						$passed = false;   
					} elseif ( ! WC()->cart->is_empty() ) {
						$product_id = $variation_id > 0 ? $variation_id : $product_id;
						$product_cart_id = WC()->cart->generate_cart_id( $product_id );
						$in_cart = WC()->cart->find_product_in_cart( $product_cart_id );

						if ( $in_cart ) {
							$cart = WC()->cart->get_cart();
							$quantity_in_cart = $cart[$product_cart_id]['quantity'];
							if ( $quantity_in_cart + $quantity > $max_allowed ) {
								wc_add_notice( __( $message, 'woocommerce' ), 'error' );
								$passed = false;
							}
						}
					}
				}
			}
		} else {
			wc_add_notice( __( 'Por favor seleccione el lugar de entrega en la parte superior', 'woocommerce' ), 'error' );
			$passed = false;
		}
	} else {
		wc_add_notice( __( 'Por favor inicie sesión o regístrese', 'woocommerce' ), 'error' );
		$passed = false;
	}

	return $passed;
}

add_filter( 'woocommerce_add_to_cart_validation', 'woocommerce_add_to_cart_stock_validation', 10, 5 );

/**
  * Quitar campos al formulario de checkout
  */

function customize_checkout_fields($fields) {

	// remove billing fields
	unset($fields['billing']['billing_address_2']);
	unset($fields['billing']['billing_postcode']);
	unset($fields['billing']['billing_company']);

	// remove shipping fields 
	unset($fields['shipping']['shipping_first_name']);    
	unset($fields['shipping']['shipping_last_name']);  
	unset($fields['shipping']['shipping_company']);
	unset($fields['shipping']['shipping_postcode']);
	unset($fields['shipping']['shipping_country']);
	
	// remove order comment fields
	unset($fields['order']['order_comments']);
	
	$fields['billing']['billing_city']['label'] = 'Ciudad';
	$fields['billing']['billing_city']['placeholder'] = 'Escriba la ciudad de facturación';
	$fields['billing']['billing_state']['label'] = 'Departamento';
	$fields['billing']['billing_address_1']['label'] = 'Dirección de facturación';
	$fields['billing']['billing_address_1']['label'] = 'Escriba la dirección de facturación';

	$fields['billing']['billing_phone']['class'][0] = 'form-row-first';
	$fields['billing']['billing_email']['class'][0] = 'form-row-last';

	$fields['shipping']['shipping_city']['label'] = 'Ciudad - Distrito';
	$fields['shipping']['shipping_city']['class'][0] = 'form-row-last';
	$fields['shipping']['shipping_city']['required'] = true;
	$fields['shipping']['shipping_address_1']['label'] = 'Calle / Av. / Jr.';
	$fields['shipping']['shipping_address_1']['placeholder'] = 'Escriba la calle, avenida o jirón';
	$fields['shipping']['shipping_address_1']['class'][0] = 'form-row-first';
	$fields['shipping']['shipping_address_1']['required'] = true;
	$fields['shipping']['shipping_address_2']['label'] = 'N° / Mz. y Lt.';
	$fields['shipping']['shipping_address_2']['placeholder'] = 'Escriba el número de dirección o la manzana y lote';
	$fields['shipping']['shipping_address_2']['class'][0] = 'form-row-last';
	$fields['shipping']['shipping_address_2']['required'] = true;
	$fields['shipping']['shipping_state']['label'] = 'Departamento';
	$fields['shipping']['shipping_state']['required'] = true;

	$fields['shipping']['shipping_urbanization'] = array(
		'label'     => __('Urbanización', 'woocommerce'),
		'placeholder'   => 'Escriba la urbanización',
		'required'  => true,
		'clear'     => true
	);
	$fields['shipping']['shipping_urbanization']['class'][0] = 'form-row-first';

	$fields['shipping']['shipping_reference'] = array(
		'label'     => __('Referencia', 'woocommerce'),
		'placeholder'   => 'Escriba una referencia o lugar conocido',
		'required'  => true,
		'clear'     => true
	);
	$fields['shipping']['shipping_reference']['class'][0] = 'form-row-wide';

	return $fields;
}

add_filter('woocommerce_checkout_fields' , 'customize_checkout_fields');

/**
  * Quitar requerido a campos de formulario de facturación
  */

function filter_default_address_fields( $address_fields ) {
	if( !is_checkout() ) return $address_fields;

	$key_fields = array('country','first_name','last_name','company','address_1','city','state','postcode');

	foreach( $key_fields as $key_field )
		$address_fields[$key_field]['required'] = false;

	return $address_fields;
}

add_filter( 'woocommerce_default_address_fields' , 'filter_default_address_fields', 20, 1 );

/**
 * Quitar hook de terminos y condiciones
 */

function my_project_wc_change_hooks() {
  remove_action('woocommerce_checkout_terms_and_conditions', 'wc_terms_and_conditions_page_content', 30);
}

add_action('wp', 'my_project_wc_change_hooks');


/**
  * Añadir scripts en footer
  */

if(!function_exists('custom_question_conditional_javascript')) {
	function custom_question_conditional_javascript() {
		global $current_user; wp_get_current_user();
		?>
		<script type="text/javascript">
		
		const user_id = "<?php echo get_current_user_id(); ?>";
		const is_checkout = "<?php echo is_checkout(); ?>";
		const is_order_recived = "<?php echo (empty(is_wc_endpoint_url('order-received'))) ? "0" : "1"; ?>";
		const is_cart = "<?php echo is_cart(); ?>";
		const is_product = "<?php echo is_product(); ?>";
		const user_name = "<?php echo $current_user->user_login; ?>";
		const state_val = {"LAL": "La Libertad", "PIU": "Piura"};
		var shipping_obj = {};
		var shipping_obj_empty = false
		var d = new Date(), now_init = new Date();
		d.setTime(d.getTime() + 12*60*60*1000);
		var expires = "expires=" + d.toGMTString();

		if (user_id > 0) {
			var result = document.cookie.match(new RegExp(user_name + '_shipping_obj=([^;]+)'));
			var result_ls = sessionStorage.getItem(user_name + '_shipping_obj');
			
			result && (result = JSON.parse(result[1]));
			result_ls && (result_ls = JSON.parse(result_ls));
			
			if(window.jQuery.isEmptyObject(result) || window.jQuery.isEmptyObject(result_ls)){
			// if(window.jQuery.isEmptyObject(result_ls)){
				var_shipping_delivery_type = "<?php echo (get_user_meta( get_current_user_id(), 'shipping_delivery_type' , true )) ? get_user_meta( get_current_user_id(), 'shipping_delivery_type' , true ) : ''; ?>";
				var_shipping_address_1 = "<?php echo (get_user_meta( get_current_user_id(), 'shipping_address_1' , true )) ? ucwords(get_user_meta( get_current_user_id(), 'shipping_address_1' , true )) : ''; ?>";
				var_shipping_address_2 = "<?php echo (get_user_meta( get_current_user_id(), 'shipping_address_2' , true )) ? ucwords(get_user_meta( get_current_user_id(), 'shipping_address_2' , true )) : ''; ?>";
				var_shipping_urbanization = "<?php echo (get_user_meta( get_current_user_id(), 'shipping_urbanization' , true )) ? ucwords(get_user_meta( get_current_user_id(), 'shipping_urbanization' , true )) : ''; ?>";
				var_shipping_city = "<?php echo (get_user_meta( get_current_user_id(), 'shipping_city' , true )) ? get_user_meta( get_current_user_id(), 'shipping_city' , true ) : ''; ?>";
				var_shipping_state = "<?php echo (get_user_meta( get_current_user_id(), 'shipping_state' , true )) ? get_user_meta( get_current_user_id(), 'shipping_state' , true ) : ''; ?>";
				var_shipping_reference = "<?php echo (get_user_meta( get_current_user_id(), 'shipping_reference' , true )) ? ucfirst(get_user_meta( get_current_user_id(), 'shipping_reference' , true )) : ''; ?>";
				var_shipping_lat_gmaps = "<?php echo (get_user_meta( get_current_user_id(), 'shipping_lat_gmaps' , true )) ? get_user_meta( get_current_user_id(), 'shipping_lat_gmaps' , true ) : ''; ?>";
				var_shipping_lng_gmaps = "<?php echo (get_user_meta( get_current_user_id(), 'shipping_lng_gmaps' , true )) ? get_user_meta( get_current_user_id(), 'shipping_lng_gmaps' , true ) : ''; ?>";

				if(var_shipping_delivery_type.length > 0 && var_shipping_address_1.length > 0 && var_shipping_address_2.length > 0 && var_shipping_urbanization.length > 0 && var_shipping_city.length > 0 &&
						var_shipping_state.length > 0 && var_shipping_reference.length > 0 && var_shipping_lat_gmaps.length > 0 && var_shipping_lng_gmaps.length > 0){
					shipping_obj.p_shipping_delivery_type = "<?php echo (get_user_meta( get_current_user_id(), 'shipping_delivery_type' , true )) ? get_user_meta( get_current_user_id(), 'shipping_delivery_type' , true ) : ''; ?>";
					shipping_obj.p_shipping_address_1 = "<?php echo (get_user_meta( get_current_user_id(), 'shipping_address_1' , true )) ? ucwords(get_user_meta( get_current_user_id(), 'shipping_address_1' , true )) : ''; ?>";
					shipping_obj.p_shipping_address_2 = "<?php echo (get_user_meta( get_current_user_id(), 'shipping_address_2' , true )) ? ucwords(get_user_meta( get_current_user_id(), 'shipping_address_2' , true )) : ''; ?>";
					shipping_obj.p_shipping_urbanization = "<?php echo (get_user_meta( get_current_user_id(), 'shipping_urbanization' , true )) ? ucwords(get_user_meta( get_current_user_id(), 'shipping_urbanization' , true )) : ''; ?>";
					shipping_obj.p_shipping_city = "<?php echo (get_user_meta( get_current_user_id(), 'shipping_city' , true )) ? get_user_meta( get_current_user_id(), 'shipping_city' , true ) : ''; ?>";
					shipping_obj.p_shipping_state = "<?php echo (get_user_meta( get_current_user_id(), 'shipping_state' , true )) ? get_user_meta( get_current_user_id(), 'shipping_state' , true ) : ''; ?>";
					shipping_obj.p_shipping_reference = "<?php echo (get_user_meta( get_current_user_id(), 'shipping_reference' , true )) ? ucfirst(get_user_meta( get_current_user_id(), 'shipping_reference' , true )) : ''; ?>";
					shipping_obj.p_shipping_lat_gmaps = "<?php echo (get_user_meta( get_current_user_id(), 'shipping_lat_gmaps' , true )) ? get_user_meta( get_current_user_id(), 'shipping_lat_gmaps' , true ) : ''; ?>";
					shipping_obj.p_shipping_lng_gmaps = "<?php echo (get_user_meta( get_current_user_id(), 'shipping_lng_gmaps' , true )) ? get_user_meta( get_current_user_id(), 'shipping_lng_gmaps' , true ) : ''; ?>";

					document.cookie = [user_name + '_shipping_obj=', JSON.stringify(shipping_obj), '; domain=.', window.location.host.toString(), '; ', expires, '; path=/;'].join('');
					sessionStorage.setItem(user_name + '_shipping_obj', JSON.stringify(shipping_obj));
				}
			} else {
				shipping_obj = result;
			}

			if(now_init.getHours() < 7 || now_init.getHours() >= 13){
				shipping_obj.p_shipping_delivery_type = 'programmed'
			}
		}

		shipping_obj_empty = window.jQuery.isEmptyObject(shipping_obj);

		if(!shipping_obj_empty){
			address_text = shipping_obj.p_shipping_address_1 + " " + shipping_obj.p_shipping_address_2 + ", " + shipping_obj.p_shipping_urbanization;
			delivery_type_text = (shipping_obj.p_shipping_delivery_type == 'programmed') ? "Delivery Programado" : "Delivery Xpress";
			target = document.getElementById("header-shipping-button").getElementsByClassName("elementor-button-text")[0];
			target2 = document.getElementById("header-shipping-button-mobile").getElementsByClassName("elementor-button-text")[0];
			target3 = document.getElementById("header-shipping-type").getElementsByClassName("elementor-text-editor")[0];
			target.textContent = address_text;
			target2.textContent = delivery_type_text + " en: " + address_text;
			target3.textContent = delivery_type_text;

			if (!is_checkout && !is_cart){
				window.jQuery.ajax({
					type: "GET",
					datatype: 'json',
					url: url_api_product_stock,
					data: {
						state: shipping_obj.p_shipping_state,
						delivery_type: shipping_obj.p_shipping_delivery_type
					},
					success: function (output) {
						if(is_product){
							for (let index = 0; index < output.length; index++) {
								var elements = document.getElementsByClassName("sku");
								var page_sku = elements[0].innerText
								if(output[index]['sku'] == page_sku){
									var node_parent = elements[0].parentElement.parentElement.parentElement;

									inputs = node_parent.getElementsByTagName('input');
									for (var x = 0; x < inputs.length; x++) {
										input = inputs[x];
										input.setAttribute("max",output[index]['stock']);
									}
								}
							}
						} else {
							for (let index = 0; index < output.length; index++) {
								var elements = document.querySelectorAll('[data-product_sku="' + output[index]['sku'] + '"]');
								for (let i = 0; i < elements.length; i++) {
									var node_parent = elements[i].parentElement;
									if(output[index]['stock'] == 0) {
										if (node_parent.parentElement.className == "product-block") {
											node_parent.parentElement.style.pointerEvents = "none";
											node_parent.parentElement.style.opacity = "0.5";
										}
										inputs = node_parent.getElementsByTagName('input');
										for (var x = 0; x < inputs.length; x++) {
											input = inputs[x];
											input.value = 1;
										}
									} else {
										if (node_parent.parentElement.className == "product-block") {
											node_parent.parentElement.style.pointerEvents = "all";
											node_parent.parentElement.style.opacity = "1";
										}
										inputs = node_parent.getElementsByTagName('input');
										for (var x = 0; x < inputs.length; x++) {
											input = inputs[x];
											input.setAttribute("max",output[index]['stock']);
											input.value = 1;
										}
									}
								}
							}
						}
					}
				});
			} else if(is_cart){
				window.jQuery.ajax({
					type: "GET",
					datatype: 'json',
					url: url_api_product_stock,
					data: {
						state: shipping_obj.p_shipping_state,
						delivery_type: shipping_obj.p_shipping_delivery_type
					},
					success: function (output) {
						for (let index = 0; index < output.length; index++) {
							var elements = document.querySelectorAll('[data-product_sku="' + output[index]['sku'] + '"]');
							for (let i = 0; i < elements.length; i++) {
								var node_parent = elements[i].parentElement.parentElement;

								inputs = node_parent.getElementsByTagName('input');
								for (var x = 0; x < inputs.length; x++) {
									input = inputs[x];
									input.setAttribute("max",output[index]['stock']);
								}
							}
						}
					}
				});
			}
		} else {
			var elements = document.getElementsByClassName("product-block");
			for (let i = 0; i < elements.length; i++) {
				elements[i].style.pointerEvents = "none";
				elements[i].style.opacity = "0.5";
			}
		}

		if(!is_checkout){
			window.jQuery('input[type="number"]').prop("readonly",true);
		}
		if(typeof document.getElementsByClassName('the_champ_social_login_title')[1] != 'undefined'){
			document.getElementsByClassName('the_champ_social_login_title')[1].innerHTML = 'O, regístrate con tu red social favorita';
		}
		
		(function() {

			// Check if jquery exists
			if(!window.jQuery) {
				return;
			};

			var $ = window.jQuery;

			$(document).ready(function() {
				var questionField = $('.custom-question-field'), rucField = $('.custom-question-ruc-field'), razonsocialField = $('.custom-question-razonsocial-field');

				// Check that all fields exist
				if(!questionField.length || !rucField.length || !razonsocialField.length) {
					return;
				}

				function limpiarrucyrazon() {
					document.getElementById('custom_question_text_ruc').value = ""
					document.getElementById('custom_question_text_razonsocial').value = ""
					document.getElementById('custom_question_text_direccion').value = ""
				}

				$('#custom_question_text_dni_client').change(function(){
					var nomcomp =  "";
					$('#custom_question_text_name_client').val();
					var dni = $('#custom_question_text_dni_client').val();

					if(dni.length == 8){
						$.ajax({
							url: "../wp-content/themes/poco-child/person_company.php",
							type: "POST",
							dataType: "json",
							timeout: 10000,
							data : {type: "dni", document: dni},
							beforeSend: function(){
								$('.person-client-container').block({
									message: null,
									overlayCSS: {
										cursor: 'wait',
										backgroundColor: 'white'
									}
								});
							},
							complete: function(){
								$('.person-client-container').unblock();
							},
							success: function(data) {
								if(data.status == "error") {
									$("#errordni").remove();
									$("#custom_question_text_dni_client").after('<span id="errordni" style="color:red">El DNI ingresado es inválido</span>');
									$("#custom_question_text_name_client").val("");
								} else if (data.status == "no-results") {
									$("#errordni").remove();
									$('.person-client-container').unblock();
									$("#billing_first_name_field").css("display", "block");
									$("#billing_last_name_field").css("display", "block");
								} else {
									$("#errordni").remove();
									nomcomp = data.nombres + " " + data.apellidoPaterno + " " + data.apellidoMaterno;
									$('#custom_question_text_name_client').val(nomcomp);
									$('#billing_first_name').val(data.nombres);
									$('#billing_last_name').val(data.apellidoPaterno + " " + data.apellidoMaterno);
									$('#custom_question_text_dnirecojo').val(data.dni);
									$('#custom_question_text_precojo').val(nomcomp);
								}
							},
							error: function(xmlhttprequest, textstatus, message) {
								if(textstatus==="timeout") {
									$('.person-client-container').unblock();
									$("#billing_first_name_field").css("display", "block");
									$("#billing_last_name_field").css("display", "block");
								} else {
									alert(textstatus);
								}
							}
						});
					} else {
						$("#errordni").remove();
						$("#custom_question_text_dni_client").after('<span id="errordni" style="color:red">El DNI ingresado es inválido</span>');
						$("#custom_question_text_name_client").val("");
					}
				});
					
				$('#custom_question_text_ruc').change(function(){
					ruc = $('#custom_question_text_ruc').val();
					if(ruc.length == 11){
						$.ajax({
							type: "POST",
							url: "../wp-content/themes/poco-child/person_company.php",
							data : {type: "ruc", document: ruc},
							beforeSend: function(){
								$('.ruc-container').css("display", "flex");
								$('.ruc-container').block({
									message: null,
									overlayCSS: {
										cursor: 'wait',
										backgroundColor: 'white'
									}
								});
							},
							complete: function(){
								$('.ruc-container').unblock();
							},
							success: function(data) {
								if(data.status == "error"){
									$("#errorruc").remove();
									$('#custom_question_text_ruc_field').append('<span id="errorruc" style="color:red">El RUC ingresado es inválido</span>');
									$("#custom_question_text_razonsocial").val("");
									$("#custom_question_text_direccion").val("");
								} else if (data.status == "no-results") {
									$("#errorruc").remove();
									$("#custom_question_text_razonsocial").attr("readonly", false);
								} else {
									$("#errorruc").remove();
									$("#custom_question_text_ruc").val(data.ruc);
									$("#custom_question_text_razonsocial").val(data.razonSocial);
									$("#custom_question_text_direccion").val(data.direccion);
								}         
							}         
						});
					} else {
						$("#errorruc").remove();
						$('#custom_question_text_ruc_field').append('<span id="errorruc" style="color:red">El RUC ingresado es inválido</span>');
						$("#custom_question_text_razonsocial").val("");
						$("#custom_question_text_direccion").val("");
					}
				});
					
				$('#custom_question_text_dnirecojo').change(function(){
					var nomcomp =  "";
					$('#custom_question_text_precojo').val();
					dni = $('#custom_question_text_dnirecojo').val();
					if(dni.length == 8){
						$.ajax({
							url: "../wp-content/themes/poco-child/person_company.php",
							type: "POST",
							dataType: "json",
							timeout: 10000,
							data : {type: "dni", document: dni},
							beforeSend: function(){
								$('.dni-person-pickup').block({
									message: null,
									overlayCSS: {
										cursor: 'wait',
										backgroundColor: 'white'
									}
								});
							},
							complete: function(){
								$('.dni-person-pickup').unblock();
							},
							success: function(data) {
								if(data.status == "error"){
									$("#errordni").remove();
									$("#custom_question_text_dnirecojo").after('<span id="errordni" style="color:red">El DNI ingresado es inválido</span>');
									$("#custom_question_text_precojo").val("");
								} else {
									$("#errordni").remove();
									nomcomp = data.nombres+" "+data.apellidoPaterno+" "+data.apellidoMaterno;
									$('#custom_question_text_precojo').val(nomcomp);
								}
							},
							error: function(xmlhttprequest, textstatus, message) {
								if(textstatus==="timeout") {
									$('.dni-person-pickup').unblock();
									$("#custom_question_text_precojo").attr("readonly", false); 
									$("#custom_question_text_precojo").css("background-color", "#FFF"); 
								} else {
									alert(textstatus);
								}
							}
						});
					} else {
						$("#errordni").remove();
						$("#custom_question_text_dnirecojo").after('<span id="errordni" style="color:red">El DNI ingresado es inválido</span>');
						$("#custom_question_text_precojo").val("");
					}
				});

				function toggleVisibleFields() {
					var selectedAnswer = questionField.find('input:checked').val();
					if(selectedAnswer === 'rbuton_boleta' || selectedAnswer === 'rbuton_boleta_propia') {
						$('.ruc-container').css('display','none');
						$("label[for*='custom_question_text_dni_client']").html("DNI <abbr class='required' title='obligatorio'>*</abbr>");
						$("label[for*='custom_question_text_name_client']").html("Nombres y Apellidos <abbr class='required' title='obligatorio'>*</abbr>");
						limpiarrucyrazon();
					} else if(selectedAnswer === 'rbuton_factura') {
						$('.ruc-container').css('display','flex');
						$("label[for*='custom_question_text_dni_client']").html("DNI del Representante <abbr class='required' title='obligatorio'>*</abbr>");
						$("label[for*='custom_question_text_name_client']").html("Nombre del Representante <abbr class='required' title='obligatorio'>*</abbr>");
					}
				}

				$(document).on('change', 'input[name=custom_question_field]', toggleVisibleFields);

				toggleVisibleFields();

				$('#custom_question_text_dnirecojo').val($('#custom_question_text_dni_client').val());
				$('#custom_question_text_precojo').val($('#custom_question_text_name_client').val());
				$("#custom_question_field_rbuton_boleta").prop("checked",true);
			});
		})();
		</script>

		<?php
		switch ($_SERVER['SERVER_NAME']) {
			case 'localhost':
				$gmaps_api_key = "AIzaSyDeD9pjkbamcRZTvWz0krJ1Sg92WxMJ_LM";
				break;
			case 'testxpress.chimuagropecuaria.com.pe':
				$gmaps_api_key = "AIzaSyD0MEirIzaT4PtktGGOiLP0qkA_fbVjWoI";
				break;
			case 'xpress.chimuagropecuaria.com.pe':
				$gmaps_api_key = "AIzaSyAy2iK2VsrfBd9NTSaRDrOU-MYlMM8er8s";
				break;
			default:
				break;
		}
		?>

		<script src="https://maps.googleapis.com/maps/api/js?key=<?php echo $gmaps_api_key; ?>&libraries=geometry" async></script>

    <script type="text/javascript">
    jQuery( function($){
			$(document).ready(function() {
				// var total = $('span.woocommerce-Price-amount').html().match(/\d+/)[0];
				var total = parseFloat($('span.woocommerce-Price-amount')[0].innerText.substring(2).replace(/,/g, ''));
				validate_cart_amount(total);
			});

			$(document.body).on('added_to_cart', function() {
				setTimeout(function(){ validate_cart_amount(parseFloat($('span.woocommerce-Price-amount')[0].innerText.substring(2).replace(/,/g, ''))); }, 500);
			});

			$( document.body ).on( 'removed_from_cart', function(){
				setTimeout(function(){ validate_cart_amount(parseFloat($('span.woocommerce-Price-amount')[0].innerText.substring(2).replace(/,/g, ''))); }, 500);
			});

			$( document.body ).on( 'updated_cart_totals', function(){
				// var total = $('div.cart_totals tr.cart-subtotal span.woocommerce-Price-amount').html().match(/\d+/)[0];
				var total = parseFloat($('div.cart_totals tr.cart-subtotal span.woocommerce-Price-amount')[0].innerText.substring(2).replace(/,/g, ''));
				validate_cart_amount(total);
			});

			function validate_cart_amount(total){
				var state = shipping_obj.p_shipping_state
				var delivery_type = shipping_obj.p_shipping_delivery_type
				var min_amount = 40;
				// console.log(total);
				// if(delivery_type == 'programmed'){
				// 	if(state == "LAL"){
				// 		min_amount = 80;
				// 	} else if (state == "PIU"){
				// 		min_amount = 60;
				// 	}
				// }

				if(total < min_amount){
					$(".button.checkout").css('pointer-events','none');
					$(".checkout-button.button").css('pointer-events','none');
					$(".button.checkout").css('opacity','0.5');
					$(".checkout-button.button").css('opacity','0.5');
					$(".woocommerce-mini-cart__alert").css("display","block");
				} else {
					$(".button.checkout").css('pointer-events','all');
					$(".checkout-button.button").css('pointer-events','all');
					$(".button.checkout").css('opacity','1');
					$(".checkout-button.button").css('opacity','1');
					$(".woocommerce-mini-cart__alert").css("display","none");
				}
			}
    });

    </script>
		
		<?php
	}

	add_action('wp_footer', 'custom_question_conditional_javascript', 1000);
}

/**
	* Obtener todos los metadatos
	*/

if(!function_exists('custom_checkout_question_get_field_values')) {
  function custom_checkout_question_get_field_values() {
    $fields = [
      'custom_question_field'                       => '',
      'custom_question_text_dni_client'             => '',
      'custom_question_text_name_client'            => '',
      'custom_question_text_ruc'                    => '',
      'custom_question_text_razonsocial'            => '',
      'custom_question_text_direccion'              => '',
      'custom_question_text_dnirecojo'              => '',
      'custom_question_text_precojo'                => '',
      'add_delivery_date'                           => '',
      'add_delivery_hour'                           => '',
      'cod_payment'                                 => '',
      'shipping_lat_gmaps'                          => '',
      'shipping_lng_gmaps'                          => '',
      'shipping_reference'                          => '',
      'shipping_delivery_type'                      => '',
      'shipping_urbanization'                       => '',
   ];

    foreach($fields as $field_name => $value) {
      if(!empty($_POST[$field_name])) {
        $fields[$field_name] = sanitize_text_field($_POST[$field_name]);
      } else {
        unset($fields[$field_name]);
      }
    }

    return $fields;
  }
}

/**
  * Validar los campos personalizados en el checkout
  */

if(!function_exists('custom_checkout_question_field_validate')) {
	function custom_checkout_question_field_validate() {
		global $wpdb;
		global $woocommerce;
		// Will get you cart object
		$cart = $woocommerce->cart;
		$invalidDNI = 0;
		$invalidRUC = 0;
		$field_values = custom_checkout_question_get_field_values();
		$dni_client = preg_replace('/\s/', '', isset($field_values['custom_question_text_dni_client']) ? $field_values['custom_question_text_dni_client'] : "");
		$name_client = isset($field_values['custom_question_text_name_client']) ? $field_values['custom_question_text_name_client'] : "";
		$ruc_client = preg_replace('/\s/', '', isset($field_values['custom_question_text_ruc']) ? $field_values['custom_question_text_ruc'] : "");
		$company_client = isset($field_values['custom_question_text_name_razonsocial']) ? $field_values['custom_question_text_name_razonsocial'] : "";
		$precojotxt = isset($field_values['custom_question_text_precojo']) ? $field_values['custom_question_text_precojo'] : "";
		$dnirecojotxt = isset($field_values['custom_question_text_dnirecojo']) ? $field_values['custom_question_text_dnirecojo'] : "";
		$dnigex = "/^[0-9]{8}$/" ;
		$rucregex = "/^[0-9]{11}$/" ;
		if(isset($dni_client) && preg_match($dnigex, $dni_client) !== 1 && $dni_client != ''){
			$invalidDNI = 1;
		}
		if(isset($ruc_client) && preg_match($rucregex, $ruc_client) !== 1 && $ruc_client != ''){
			$invalidRuc = 1;
		}

		if (empty($field_values['custom_question_field'])) {
			wc_add_notice('Por favor, selecciona <b>Boleta o Factura</b>.', 'error');
		}

		if (empty($field_values['custom_question_text_dni_client'])) {
			wc_add_notice('Por favor, ingresa <b>su DNI</b>.', 'error');
		}

		if (($field_values['custom_question_field'] === 'rbuton_boleta' || $field_values['custom_question_field'] === 'rbuton_boleta_propia') && $invalidDNI == 1) {
			wc_add_notice('Por favor, ingresa un <b>DNI válido</b>.', 'error');
		}

		if ($field_values['custom_question_field'] === 'rbuton_factura' &&
			(empty($field_values['custom_question_text_ruc']) ||
			empty($field_values['custom_question_text_razonsocial']))
		) {
			wc_add_notice('Por favor, ingresa el <b>RUC y la razón social</b>.', 'error');
		}

		if ($field_values['custom_question_field'] === 'rbuton_factura' && $invalidRuc == 1) {
			wc_add_notice('Por favor, ingresa un <b>RUC válido</b>.', 'error');
		}

		if (empty($field_values['custom_question_text_precojo']) && strlen($dnirecojotxt) > 0) {
			wc_add_notice('Por favor, ingresa el <b>DNI o de la Persona de recojo/recepción</b>.', 'error');
		}

		if (empty($field_values['custom_question_text_dnirecojo']) && strlen($precojotxt) > 0) {
			wc_add_notice('Por favor, ingresa el <b>Nombre y Apellidos de la Persona de recojo/recepción</b>.', 'error');
		}

		if ($_POST['payment_method'] == 'cod' && empty($field_values['cod_payment'])) {
			wc_add_notice('Por favor, ingresa el <b>pago contra entrega</b>.', 'error');
		}

		if ($_POST['payment_method'] == 'cod' && !empty($field_values['cod_payment'])
				&& $field_values['cod_payment'] == 'efectivo' && intval($woocommerce->cart->total) > 300) {
			wc_add_notice('El pago en efectivo no puede superar los 300 soles; por favor elige <b>pago con tarjeta o pago en linea</b>.', 'error');
		}

		if ($_POST['payment_method'] == 'cod' && !empty($field_values['cod_payment'])
				&& $field_values['cod_payment'] == 'tarjeta' && $_POST['shipping_state'] == 'LAM') {
			wc_add_notice('El <b>pago contraentrega con tarjeta</b> no está disponible en su localidad.', 'error');
		}

		if (intval($woocommerce->cart->total) < 30) {
			wc_add_notice('Su pedido debe ser <b>mayor o igual a 30.00 soles</b>.', 'error');
		}

		if (empty($field_values['add_delivery_date'])) {
			wc_add_notice('Por favor, selecciona una <b>fecha de entrega</b>.', 'error');
		}

		if (empty($field_values['add_delivery_hour'])) {
			wc_add_notice('Por favor, selecciona una <b>hora de entrega</b>.', 'error');
		}

		if(isset($_POST['billing_to_another_address']) && $_POST['billing_to_another_address'] == 'different_billing_address' && empty($_POST['billing_address_1'])){
			wc_add_notice('Por favor, selecciona una <b>dirección diferente de entrega</b>.', 'error');
		}

		if (empty($_POST['shipping_address_1'])) {
			wc_add_notice('Por favor, ingrese una <b>calle, avenida o jirón</b> en la part superior.', 'error');
		}

		if (!empty($_POST['shipping_address_1']) && !preg_match("/^[a-zA-ZáéíóúÁÉÍÓÚñÑ. -]+$/",$_POST['shipping_address_1'])) {
			wc_add_notice('Por favor, ingrese <b>solamente la calle, avenida o jirón sin el número</b>.', 'error');
		}

		if (empty($_POST['shipping_address_2'])) {
			wc_add_notice('Por favor, ingrese un <b>número de calle o manzana y lote</b>.', 'error');
		}

		if (empty($_POST['shipping_urbanization'])) {
			wc_add_notice('Por favor, ingrese una <b>urbanización</b>.', 'error');
		}

		if ($_POST['shipping_method'][0] != 'local_pickup:3' && empty($_POST['shipping_reference'])) {
			wc_add_notice('Por favor, ingrese una <b>referencia de su ubicación</b>.', 'error');
		}

		if ($_POST['shipping_method'][0] != 'local_pickup:3' && (empty($_POST['shipping_lat_gmaps']) || empty($_POST['shipping_lng_gmaps']))) {
			wc_add_notice('Por favor, <b>arrastre el marcador a su ubicación exacta</b>.', 'error');
		}
	
		// if ($_POST['valid_map_location'] == '0') {
		// 	wc_add_notice('Por favor, <b>revise que su ubicación de entrega esté en nuestra cobertura en el mapa</b>.', 'error');
		// }

		$valid = true;
		$message = '';
		$url_api_product_stock = ($_SERVER['SERVER_NAME'] == "localhost") ? "http://localhost/api/GET/product_stock.php?" : "../wp-content/themes/poco-child/product_stock.php?";
		
		foreach ( WC()->cart->get_cart() as $cart_item ) {
			$item_sku = $cart_item['data']->get_sku();
			$item_name = $cart_item['data']->get_title();
			$always_check_stock = $cart_item['data']->get_meta('always_check_stock');

			if( $item_sku != '101578'){
				if($_POST['shipping_delivery_type'] == 'xpress' || $always_check_stock == "yes"){
					$params = array("state" => $_POST['shipping_state'], "sku" => $item_sku, "delivery_stype" => $_POST['shipping_delivery_type']);
					$url = $url_api_product_stock . http_build_query($params);
					
					$ch = curl_init();
					curl_setopt($ch, CURLOPT_URL, $url); 
					curl_setopt($ch, CURLOPT_RETURNTRANSFER, true); 
					curl_setopt($ch, CURLOPT_HEADER, 0); 
					$data = json_decode(curl_exec($ch), TRUE);
					curl_close($ch); 

					if (isset($data[0]['stock'])) {
						$max_allowed = $data[0]['stock'];
						if($cart_item['quantity'] > $max_allowed){
							$valid = false;
							$pre = (strlen($message) > 0) ? "\n" : "";
							$message .= $pre . 'Solo disponemos de ' . $max_allowed . ' unidades de ' . $item_name . ' en nuestro almacén';
						}
					}
				}
			}
		}
		if(!$valid){
			wc_add_notice( __( $message, 'woocommerce' ), 'error' );
			wp_safe_redirect( get_permalink( get_option('woocommerce_cart_page_id') ) );
			exit();
		}
	}

	add_action('woocommerce_checkout_process', 'custom_checkout_question_field_validate');
}

/**
	* Registrar campos personalizados
	*/

if(!function_exists('custom_checkout_question_field_save')) {
  function custom_checkout_question_field_save($order_id) {
    $field_values = custom_checkout_question_get_field_values();
    foreach($field_values as $field_name => $value) {
      if(!empty($field_values[$field_name])) {
        update_post_meta($order_id, $field_name, $value);
      }
    }
  }

  add_action('woocommerce_checkout_update_order_meta', 'custom_checkout_question_field_save');
}

/**
  * Añadir datos extras de pedido al envío de correo
  */

function add_custom_fields_to_emails ($fields, $sent_to_admin, $order) {
	if(version_compare(get_option('woocommerce_version'), '3.0.0', ">=")) {            
		$order_id = $order->get_id();
	} else {
		$order_id = $order->id;
	}

	$boletaofactura = get_post_meta($order_id, 'custom_question_field', true);
	$ruc = get_post_meta($order_id, 'custom_question_text_ruc', true);
	$razonsocial = get_post_meta($order_id, 'custom_question_text_razonsocial', true);
	$payment_method = get_post_meta( $order->id, '_payment_method', true );
	$cod_payment = get_post_meta($order_id, 'cod_payment', true);
	$delivery_date = get_post_meta($order_id, 'add_delivery_date', true);
	$delivery_hour = get_post_meta($order_id, 'add_delivery_hour', true);      
	$dnirecojo = get_post_meta($order_id, 'custom_question_text_dnirecojo', true);
	$dnirecojovalue = preg_replace('/\s/', '', $dnirecojo);
	$precojo = get_post_meta($order_id, 'custom_question_text_precojo', true);
	$precojovalue = preg_replace('/\s/', '', $precojo);
	$shipping_reference = get_post_meta($order_id, 'shipping_reference', true);
	$shipping_delivery_type = get_post_meta($order_id, 'shipping_delivery_type', true);

	if($boletaofactura == "rbuton_boleta" || $boletaofactura == "rbuton_boleta_propia"){
		$fields['Comprobante'] = array(
			'label' => __('Se emitirá una Boleta ', 'add_extra_fields'),
			'value' => '',
		);
	} else if($boletaofactura == "rbuton_factura"){
		$fields['Comprobante'] = array(
			'label' => __('Se emitirá una Factura a la Razon Social ', 'add_extra_fields'),
			'value' => $razonsocial.' con RUC '.preg_replace('/\s/', '', $ruc).'',
		);
	}

	if($payment_method == 'cod' && $cod_payment != ''){
		$fields['COD Payment'] = array(
			'label' => __('Pago Contra Entrega ', 'add_extra_fields'),
			'value' => ucfirst($cod_payment),
		);
	}

	if($delivery_date != ''){
		$fields['Delivery Date'] = array(
			'label' => __('Fecha de Entrega ', 'add_extra_fields'),
			'value' => $delivery_date,
		);
	}

	if ($delivery_hour != ''){
		$fields['Delivery Hour'] = array(
			'label' => __('Hora de Entrega ', 'add_extra_fields'),
			'value' => $delivery_hour,
		);
	}

	if (strlen($dnirecojovalue) > 0){
		$fields['DNIPersona'] = array(
			'label' => __('El DNI/N° DOC de la persona de recojo/recepción es ', 'add_extra_fields'),
			'value' => $dnirecojo,
		);
	}
	
	if (strlen($precojovalue) > 0){
		$fields['Persona'] = array(
			'label' => __('La persona de recojo/recepción es ', 'add_extra_fields'),
			'value' => $precojo,
		);
	}
	
	if (strlen($shipping_reference) > 0){
		$fields['Referencia de Dirección'] = array(
			'label' => __('Referencia ', 'add_extra_fields'),
			'value' => $shipping_reference,
		);
	}
	
	if (strlen($shipping_delivery_type) > 0){
		$fields['Tipo de entrega'] = array(
			'label' => __('Tipo de entrega ', 'add_extra_fields'),
			'value' => ($shipping_delivery_type == 'programmed') ? 'Delivery Programado' : 'Delivery Xpress',
		);
	}

	return $fields;
}

add_filter('woocommerce_email_order_meta_fields', 'add_custom_fields_to_emails' , 10, 3);

/**
  * Añadir detalle de tipo de documento elegido a visualización de orden luego del checkout
  */

function add_custom_fields_to_order_received_page ($order) {
  if(version_compare(get_option('woocommerce_version'), '3.0.0', ">=")) {            
    $order_id = $order->get_id();
  } else {
    $order_id = $order->id;
  }
  $boletaofactura = get_post_meta($order_id, 'custom_question_field', true);
  $ruc = get_post_meta($order_id, 'custom_question_text_ruc', true);
  $razonsocial = get_post_meta($order_id, 'custom_question_text_razonsocial', true);
  $payment_method = get_post_meta( $order->id, '_payment_method', true );
  $cod_payment = get_post_meta($order_id, 'cod_payment', true);
  $delivery_date = get_post_meta($order_id, 'add_delivery_date', true);
  $delivery_hour = get_post_meta($order_id, 'add_delivery_hour', true);
  $dnirecojo = get_post_meta($order_id, 'custom_question_text_dnirecojo', true);
  $dnirecojovalue = preg_replace('/\s/', '', $dnirecojo);
  $precojo = get_post_meta($order_id, 'custom_question_text_precojo', true);
  $precojovalue = preg_replace('/\s/', '', $precojo);
  $shipping_reference = get_post_meta($order_id, 'shipping_reference', true);
  $shipping_delivery_type = get_post_meta($order_id, 'shipping_delivery_type', true);

  if($boletaofactura == "rbuton_boleta"){
    echo '<p><strong>' . __('Comprobante', 'add_extra_fields') . ':</strong>  Boleta </p>';
  }
  if($boletaofactura == "rbuton_boleta_propia"){
    echo '<p><strong>' . __('Comprobante', 'add_extra_fields') . ':</strong>  Boleta Propia </p>';
  }
  if($boletaofactura == "rbuton_factura"){
    echo '<p><strong>' . __('Comprobante', 'add_extra_fields') . ':</strong> Factura</p>';
    echo '<p><strong>N° RUC : </strong>'.preg_replace('/\s/', '', $ruc);
    echo '<p><strong>Razon Social : </strong>'.$razonsocial;
  }

  if ($payment_method == 'cod' && '' != $cod_payment) {
    echo '<p><strong>' . __('Pago Contra Entrega', 'add_extra_fields') . ':</strong> ' . ucfirst($cod_payment);
  }

  if ('' != $delivery_date) {
    echo '<p><strong>' . __('Fecha de Entrega', 'add_extra_fields') . ':</strong> ' . $delivery_date;
  }
  
  if ('' != $delivery_hour) {
    echo '<p><strong>' . __('Hora de Entrega', 'add_extra_fields') . ':</strong> ' . $delivery_hour;
  }

  if (strlen($dnirecojovalue) < 1) {
    # code...
  } else {
    echo '<p><strong>' . __('El DNI de la persona de recojo/recepción es', 'add_extra_fields') . ':</strong> '.$dnirecojo.'</p>';
  }

  if(strlen($precojovalue) >= 1) {
    echo '<p><strong>' . __('La persona de recojo/recepción es', 'add_extra_fields') . ':</strong> '.$precojo.'</p>';
  }

  if(strlen($shipping_reference) >= 1) {
    echo '<p><strong>' . __('Referencia ', 'add_extra_fields') . ':</strong> '.$shipping_reference.'</p>';
  }

  if(strlen($shipping_delivery_type) >= 1) {
    echo '<p><strong>' . __('Tipo de entrega ', 'add_extra_fields') . ':</strong> '.(($shipping_delivery_type == 'programmed') ? 'Delivery Programado' : 'Delivery Xpress').'</p>';
  }
}

add_filter('woocommerce_order_details_after_order_table', 'add_custom_fields_to_order_received_page', 10 , 1);

/**
  * Mostrar detalle de documento seleccionado en la edición de órdenes (administrativo)
  */

function mi_custom_checkout_field_display_admin_order_meta($order){
  if(version_compare(get_option('woocommerce_version'), '3.0.0', ">=")) {            
    $order_id = $order->get_id();
  } else {
    $order_id = $order->id;
  }

  $boletaofactura = get_post_meta($order_id, 'custom_question_field', true);
  $payment_method = get_post_meta( $order_id, '_payment_method', true );
  $cod_payment = get_post_meta($order_id, '_cod_payment', true);
  $ruc = get_post_meta($order_id, 'custom_question_text_ruc', true);
  $razonsocial = get_post_meta($order_id, 'custom_question_text_razonsocial', true);
  $dnirecojo = get_post_meta($order_id, 'custom_question_text_dnirecojo', true);
  $dnirecojovalue = preg_replace('/\s/', '', $dnirecojo);
  $precojo = get_post_meta($order_id, 'custom_question_text_precojo', true);
  $precojovalue = preg_replace('/\s/', '', $precojo);
  $shipping_reference = get_post_meta($order_id, 'shipping_reference', true);
  $shipping_delivery_type = get_post_meta($order_id, 'shipping_delivery_type', true);

  if($boletaofactura == "rbuton_boleta"){
    echo '<p><strong>' . __('Comprobante') . ':</strong>  Boleta </p>';
  } else if($boletaofactura == "rbuton_boleta_propia"){
    echo '<p><strong>' . __('Comprobante') . ':</strong>  Boleta Propia </p>';
  } else if($boletaofactura == "rbuton_factura"){
    echo '<p><strong>' . __('Comprobante') . ':</strong> Factura</p>';
    echo '<p><strong>N° RUC : </strong>'.preg_replace('/\s/', '', $ruc);
    echo '<p><strong>Razon Social : </strong>' . $razonsocial;
  }

  if($payment_method == 'cod'){
    echo '<p><strong>'.__('Pago Contra Entrega').':</strong> <br/>' . ucfirst(get_post_meta($order->get_id(), 'cod_payment', true)) . '</p>';
  }
  echo '<p><strong>'.__('Fecha de Entrega').':</strong> <br/>' . get_post_meta($order->get_id(), 'add_delivery_date', true) . '</p>';

  echo '<p><strong>'.__('Hora de Entrega').':</strong> <br/>' . get_post_meta($order->get_id(), 'add_delivery_hour', true) . '</p>';
  
  if (strlen($dnirecojovalue) > 0) {
    echo '<p><strong>' . __('El DNI/N° DOC de la persona de recojo/recepción es', 'add_extra_fields') . ':</strong> '.$dnirecojo.'</p>';
  }

  if (strlen($precojovalue) > 0) {
    echo '<p><strong>' . __('La persona de recojo/recepción es', 'add_extra_fields') . ':</strong> '.$precojo.'</p>';
  }

  if (strlen($shipping_reference) > 0) {
    echo '<p><strong>' . __('Referencia de Dirección', 'add_extra_fields') . ':</strong> '.$shipping_reference.'</p>';
  }

  if (strlen($shipping_delivery_type) > 0) {
    echo '<p><strong>' . __('Tipo de entrega', 'add_extra_fields') . ':</strong> '.(($shipping_delivery_type == 'programmed') ? 'Delivery Programado' : 'Delivery Xpress').'</p>';
  }
}

add_action('woocommerce_admin_order_data_after_billing_address', 'mi_custom_checkout_field_display_admin_order_meta', 10, 1);
/**
  * Añadir función de días habilitados para calendario
  */

function next_available_day() {
	global $wpdb;
	date_default_timezone_set('America/Lima');
	$end_do = true;
	$i = 0;
	$now = date("H:i:s");
	$excluded = array();
	$dow = date('w');

	if($_POST['delivery_type'] == 'programmed'){
		if($_POST['department'] == 'LAL'){
			if(in_array($dow, array(5, 6))){
				$next_day = date("d/m/Y", strtotime("+ 3 day"));
			} else  {
				$next_day = date("d/m/Y", strtotime("+ 2 day"));
			}
			$limit = 50;
			$limit_kg = 700;
		} else if ($_POST['department'] == 'PIU'){
			if(in_array($dow, array(5, 6))){
				$next_day = date("d/m/Y", strtotime("+ 3 day"));
			} else  {
				$next_day = date("d/m/Y", strtotime("+ 2 day"));
			}
			$limit = 30;
			$limit_kg = 420;
		} else if ($_POST['department'] == 'LAM'){
			if(in_array($dow, array(5, 6))){
				$next_day = date("d/m/Y", strtotime("+ 3 day"));
			} else  {
				$next_day = date("d/m/Y", strtotime("+ 2 day"));
			}
			$limit = 20;
			$limit_kg = 300;
		} else if ($_POST['department' == 'ANC']){
			if($now < '13:00:00'){
				if(in_array($dow, array(1, 3, 5))){
					$next_day = date("d/m/Y", strtotime("+ 1 day"));
				} else if (in_array($dow, array(2, 4, 0))) {
					$next_day = date("d/m/Y", strtotime("+ 2 day"));
				} else {
					$next_day = date("d/m/Y", strtotime("+ 3 day"));
				}
			} else {
				if(in_array($dow, array(2, 3, 4, 0))){
					$next_day = date("d/m/Y", strtotime("+ 2 day"));
				} else if (in_array($dow, array(1, 6))) {
					$next_day = date("d/m/Y", strtotime("+ 3 day"));
				} else {
					$next_day = date("d/m/Y", strtotime("+ 4 day"));
				}
			}
			$limit = 20;
			$limit_kg = 300;
		} else {
			die;
		}
	} else if($_POST['delivery_type'] == 'xpress'){
		$next_day = date("d/m/Y");
	}

	// Bloquear fecha
	if($next_day == '03/04/2021'){
		$fecha = DateTime::createFromFormat('d/m/Y', $next_day);
		$next_day = $fecha->modify('+1 day')->format('d/m/Y');
	}
	
	echo $next_day; //date('d/m/Y', strtotime($eval_date));
	die;
}

add_action('wp_ajax_next_available_day', 'next_available_day' ); // executed when logged in
add_action('wp_ajax_nopriv_next_available_day', 'next_available_day' ); // executed when logged out
	
/**
	* Añadir datos extras en pantalla de checkout
	*/

function display_extra_fields_after_billing_address($checkout) {
	?>
	<div class="delivery_details">
		<?php
			woocommerce_form_field( 'add_delivery_date', array(
						'type'        => 'text',
						'required'    => true,
						'label'       => 'Fecha de Entrega',
						'custom_attributes' => array('readonly' => 'readonly'),
						'class' => array('form-row', 'form-row-first'),
						'input_class' => array('add_delivery_date'),
					));
					
			woocommerce_form_field( 'add_delivery_hour', array(
						'type'        => 'text',
						'required'    => true,
						'label'       => 'Hora de Entrega',
						'custom_attributes' => array('readonly' => 'readonly'),
						'class' => array('form-row', 'form-row-last'),
						// 'options' => array('Entre 7 a.m. y 2 p.m.' => 'Entre 7 a.m. y 2 p.m.')
					));
		?>
	</div>
		<script>
			var ajax_url = <?php if ($_SERVER['SERVER_NAME'] == "10.152.1.15"){
				echo "'http://10.152.1.15:8080/wordpress/wp-admin/admin-ajax.php'";       
			} else if ($_SERVER['SERVER_NAME'] == "testxpress.chimuagropecuaria.com.pe") {
				echo "'http://testxpress.chimuagropecuaria.com.pe/wp-admin/admin-ajax.php'";
			} else {
				echo "'https://xpress.chimuagropecuaria.com.pe/wp-admin/admin-ajax.php'";
			} ?>;

			jQuery(document).ready(function($) {

				if(is_checkout){
					if(!shipping_obj_empty){
						for (const property in shipping_obj) {
							field_id = property.substring(2);
							if (field_id == 'shipping_city'){
								document.getElementById(field_id).value = shipping_obj[property];
								document.getElementById('billing_city').value = shipping_obj[property];
							} else if (field_id == 'shipping_state'){
								document.getElementById(field_id).value = shipping_obj[property];
								document.getElementById('billing_state').value = shipping_obj[property];
							} else {
								document.getElementById(field_id).value = shipping_obj[property];
							}
						}
						billing_address_text = shipping_obj.p_shipping_address_1 + ' ' + shipping_obj.p_shipping_address_2 + ', ' + shipping_obj.p_shipping_urbanization;
						document.getElementById('billing_address_1').value = billing_address_text;

						if(shipping_obj.p_shipping_delivery_type == 'programmed'){
							document.getElementById('add_delivery_hour').value = 'Entre 7 a.m. y 2 p.m.';
						} else if (shipping_obj.p_shipping_delivery_type == 'xpress'){
							document.getElementById('add_delivery_hour').value = 'Entre 11 a.m. y 6 p.m.';
						}
					}
				}

				name_array = $('#custom_question_text_name_client').val().split(' ');

				if(name_array.length > 3){
					var name = "", last_name = "";

					for (var i = 0; i < name_array.length; i++) {
						if(i < (name_array.length - 2)){
							name = name + " " + name_array[i];
						} else {
							last_name = last_name + " " + name_array[i];
						}
					}

					$('#billing_first_name').val($.trim(name));
					$('#billing_last_name').val($.trim(last_name));
				}
				
				jQuery.ajax({
					type: "POST",
					url: ajax_url,
					data: {
						action: 'next_available_day',
						department: shipping_obj.p_shipping_state,
						delivery_type: shipping_obj.p_shipping_delivery_type
					},
					success: function (output) {
						dates =  [output];
						loadDatePicker(dates);
					}
				});

				function verifychecked(){
					if(document.getElementById('shipping_method_0_local_pickup3') != null){
						if(document.getElementById('shipping_method_0_local_pickup3').checked){
							return 2
						} else {
							return 1;
						}
					} else {
						return 1;
					}
				}

				function loadDatePicker(dates) {
					$(".add_delivery_date").val("");
					$(".hasDatepicker").removeClass("hasDatepicker");
					$(".datepicker").datepicker("destroy");

					var today = new Date();
					var past_tomorrow = new Date(today.getTime());
					var week = new Date(today.getTime() + 4 * 24 * 60 * 60 * 1000);
					$(".add_delivery_date").datepicker({
						dayNamesMin: ["D","L","M","X","J","V","S"],
						dateFormat : 'dd/mm/yy',
						minDate : past_tomorrow,
						maxDate: week,
						beforeShowDay: function(date) {
							var sdate = $.datepicker.formatDate( 'dd/mm/yy', date)
							if($.inArray(sdate, dates) != -1) {
								return [true];
							}
							return [false];
						}
					}).attr('readonly','readonly');
					$('.add_delivery_date').click();
				}

				$('.add_delivery_date').on("cut copy paste",function(e) {
					e.preventDefault();
				});
		
				// fin de jquery

			});	
		</script>
		
		<div class="person-pickup">
			<h3>Persona que recibe el producto</h3>
			<div class='dni-person-pickup' style="display:flex;">
			<?php
		
				woocommerce_form_field('custom_question_text_dnirecojo', array(
					'type'            => 'text',
					'label'           => 'DNI',
					'required'        => true,
					'class'           => array('custom-question-dnirecojo-field', 'form-row-first'),
				), $checkout->get_value('custom_question_text_dnirecojo'));
		
				woocommerce_form_field('custom_question_text_precojo', array(
					'type'              => 'text',
					'label'             => 'Nombres y Apellidos',
					'required'          => true,
					'custom_attributes' => array('readonly' => 'readonly'),
					'class'             => array('custom-question-precojo-field', 'form-row-last'),
				), $checkout->get_value('custom_question_text_precojo'));
			?>
			</div>
		</div>
<?php
}

add_action('woocommerce_after_checkout_billing_form', 'display_extra_fields_after_billing_address' , 10, 1);
	
/**
* Añadir scripts
*/

function enqueue_datepicker() {
  if (is_checkout()) {
    // Load the datepicker script (pre-registered in WordPress).
    wp_enqueue_script('jquery-ui-datepicker');

    // You need styling for the datepicker. For simplicity I've linked to Google's hosted jQuery UI CSS.
    // wp_register_style('jquery-ui', '//code.jquery.com/ui/1.11.2/themes/smoothness/jquery-ui.css');
    // wp_enqueue_style('jquery-ui');

    
    wp_enqueue_script('jquery');
    // wp_register_script('jquery-ui-timeselector', get_template_directory_uri() . '/js/jquery.timeselector.js');
    // wp_register_script('jquery-ui-timeselector', get_template_directory_uri() . '/js/jquery.timepicker.js');
    // wp_enqueue_script('jquery-ui-timeselector');
    // wp_enqueue_script('jquery-ui-timeselector');

    // wp_register_style('jquery-ui-timeselector', get_template_directory_uri() . '/css/jquery.timepicker.css');
    // wp_enqueue_style('jquery-ui-timeselector');
  }
	wp_enqueue_script('jquery-ui', 'https://ajax.googleapis.com/ajax/libs/jqueryui/1.9.1/jquery-ui.min.js');
	wp_register_style('jquery-ui', '//code.jquery.com/ui/1.11.2/themes/smoothness/jquery-ui.css');
	wp_enqueue_style('jquery-ui');
}

add_action('wp_enqueue_scripts', 'enqueue_datepicker');
 
function disable_woocommerce_cart_fragments() { 
  wp_enqueue_script('wc-cart-fragments'); 
}

add_action('wp_enqueue_scripts', 'disable_woocommerce_cart_fragments', 100);

function map_scripts_function() {
  wp_enqueue_script( 'js-file', '/wp-content/themes/poco-child/map_script.js', array( 'jquery' ));
}
add_action('wp_enqueue_scripts','map_scripts_function');

/**
	* Añadir datos extras del cliente en el registro del usuario 
	*/

function client_info_fields_update_user_meta($user_id) {
	if ($user_id && $_POST['custom_question_text_dni_client']){
		update_user_meta($user_id, 'custom_question_text_dni_client', esc_attr($_POST['custom_question_text_dni_client']));
	}

	if ($user_id && $_POST['custom_question_text_name_client']){
		update_user_meta($user_id, 'custom_question_text_name_client', esc_attr($_POST['custom_question_text_name_client']));
	}

	if ($user_id && $_POST['custom_question_text_ruc']){
		update_user_meta($user_id, 'custom_question_text_ruc', esc_attr($_POST['custom_question_text_ruc']));
	}

	if ($user_id && $_POST['custom_question_text_razonsocial']){
		update_user_meta($user_id, 'custom_question_text_razonsocial', esc_attr($_POST['custom_question_text_razonsocial']));
	}

	if ($user_id && $_POST['custom_question_text_direccion']){
		update_user_meta($user_id, 'custom_question_text_direccion', esc_attr($_POST['custom_question_text_direccion']));
	}

	update_user_meta($user_id, 'shipping_address_1', esc_attr($_POST['shipping_address_1']));
	update_user_meta($user_id, 'shipping_address_2', esc_attr($_POST['shipping_address_2']));
	update_user_meta($user_id, 'shipping_city', esc_attr($_POST['shipping_city']));
	update_user_meta($user_id, 'shipping_state', esc_attr($_POST['shipping_state']));
	update_user_meta($user_id, 'shipping_lat_gmaps', esc_attr($_POST['shipping_lat_gmaps']));
	update_user_meta($user_id, 'shipping_lng_gmaps', esc_attr($_POST['shipping_lng_gmaps']));
	update_user_meta($user_id, 'shipping_reference', esc_attr($_POST['shipping_reference']));
	update_user_meta($user_id, 'shipping_urbanization', esc_attr($_POST['shipping_urbanization']));
	update_user_meta($user_id, 'shipping_delivery_type', esc_attr($_POST['shipping_delivery_type']));
}

add_action('woocommerce_checkout_update_user_meta', 'client_info_fields_update_user_meta');

add_filter('woocommerce_terms_is_checked_default', '__return_true');

/**
  * Quitar productos de la categoría bolsas en el conteo de productos
  */

function ignore_bolsas_on_cart_contents_count( $count ) {
	$cart_items = WC()->cart->get_cart();

	foreach($cart_items as $key => $value) {
		if(has_term('bolsas', 'product_cat', $value['product_id'])){
			$count -= $value[ 'quantity' ];
		}
	}

	return $count;
}

add_filter( 'woocommerce_cart_contents_count',  'ignore_bolsas_on_cart_contents_count' );

/**
  * Cambiar texto en footer mobile
	*/
	
function poco_handheld_footer_bar_wishlist() {
	if (function_exists('yith_wcwl_count_all_products')) {
			?>
			<a class="footer-wishlist" href="<?php echo esc_url(get_permalink(get_option('yith_wcwl_wishlist_page_id'))); ?>">
					<span class="title"><?php echo esc_html__('Favoritos', 'poco'); ?></span>
					<span class="count"><?php echo esc_html(yith_wcwl_count_all_products()); ?></span>
			</a>
			<?php
	}
}

/**
 * Añadir flag Catch Weight en administrador de productos
 */

function add_product_options_cw(){
 
	echo '<div class="options_group">';
 
	woocommerce_wp_checkbox( array(
		'id'      => 'catch_weight',
		'value'   => get_post_meta( get_the_ID(), 'catch_weight', true ),
		'label'   => 'Catch Weight',
		'desc_tip' => true,
		'description' => 'Seleccionar si el producto es Catch Weight en POS/SAP',
	) );

	woocommerce_wp_checkbox( array(
		'id'      => 'always_check_stock',
		'value'   => get_post_meta( get_the_ID(), 'always_check_stock', true ),
		'label'   => 'Validación de stock permanente',
		'desc_tip' => true,
		'description' => 'Seleccionar si se debe validar el stock tanto en delivery programado como en delivery xpress para este producto',
	) );
 
	echo '</div>';
 
}

add_action( 'woocommerce_product_options_inventory_product_data', 'add_product_options_cw');
 
/**
 * Añadir flag Catch Weight al guardar producto
 */

function save_fields_cw( $id, $post ){
	update_post_meta( $id, 'catch_weight', $_POST['catch_weight'] );
	update_post_meta( $id, 'always_check_stock', $_POST['always_check_stock'] );
}
 
add_action( 'woocommerce_process_product_meta', 'save_fields_cw', 10, 2 );

/**
 * Redireccionar a my account si el usuario no está logueado al entrar al checkout
 */

function check_if_logged_in(){
  $checkout_page_id = get_option( 'woocommerce_checkout_page_id' );
  $myaccount_page_id = get_option( 'woocommerce_myaccount_page_id' );

  if(!is_user_logged_in() && is_page($checkout_page_id)){
      $url = add_query_arg(
          'redirect_to',
          get_permalink($myaccount_page_id),
          site_url('/my-account/')
      );
      wp_redirect($url);
      exit;
  }
  if(is_user_logged_in()){
    if(is_page($myaccount_page_id)){

        $redirect = (!empty($_GET['redirect_to'])) ? $_GET['redirect_to'] : NULL;
        if (isset($redirect)) {
        echo '<script>window.location.href = "'.$redirect.'";</script>';
        }

    }
  }
}

add_action('template_redirect','check_if_logged_in');

/**
 * Mostrar mensaje en página login - register
 */

function login_register_message() {
  if ( get_option( 'woocommerce_enable_myaccount_registration' ) == 'yes' ) {
	?>
		<div class="woocommerce-info">
			<p><?php _e( 'Si ya tienes una cuenta por favor inicia sesión, caso contrario por favor regístrate' ); ?></p>
		</div>
	<?php
	}
}

add_action( 'woocommerce_before_customer_login_form', 'login_register_message' );

/**
 * Crear check para política de privacidad en registro
 */

function registration_privacy_policy_check() {

  woocommerce_form_field( 'privacy_policy_registration_check', array(
    'type'          => 'checkbox',
    'class'         => array('form-row privacy'),
    'label_class'   => array('woocommerce-form__label woocommerce-form__label-for-checkbox checkbox'),
    'input_class'   => array('woocommerce-form__input woocommerce-form__input-checkbox input-checkbox'),
    'required'      => true,
    'label'         => 'He leido y acepto la <a href="/privacy-policy">Política de Privacidad</a> y los <a href="/terminos-y-condiciones">Términos y Condiciones</a>',
  ));

  woocommerce_form_field( 'personal_data_use_check', array(
    'type'          => 'checkbox',
    'class'         => array('form-row privacy'),
    'label_class'   => array('woocommerce-form__label woocommerce-form__label-for-checkbox checkbox'),
    'input_class'   => array('woocommerce-form__input woocommerce-form__input-checkbox input-checkbox'),
    'required'      => true,
    'label'         => 'Acepto el <a href="/uso-datos-personales">uso de datos personales</a> y deseo recibir ofertas',
  ));
    
}

add_action( 'woocommerce_register_form', 'registration_privacy_policy_check', 11 );
  
/**
 * Validar check para política de privacidad en registro
 */

function validate_privacy_policy_and_personal_data_use_registration_check( $errors, $username, $email ) {
  if ( ! is_checkout() ) {
    if ( ! (int) isset( $_POST['privacy_policy_registration_check'] ) ) {
      $errors->add( 'privacy_policy_registration_check_error', __( 'Debe aceptar la política de privacidad', 'woocommerce' ) );
    }
    if ( ! (int) isset( $_POST['personal_data_use_check'] ) ) {
      $errors->add( 'personal_data_use_check_error', __( 'Debe aceptar el uso de datos personales', 'woocommerce' ) );
    }
  }
  return $errors;
}
      
add_filter( 'woocommerce_registration_errors', 'validate_privacy_policy_and_personal_data_use_registration_check', 10, 3 );

/**
 * Registrar pedido en tablas intermedias de POS
 */

function custom_processing($order_id) {
  global $wpdb;

  $header = $wpdb->get_results("SELECT PED.Fecha_recojo
                              , PED.Ciudad
                              FROM (
                                  SELECT p.ID
                                      , (select meta_value from wp_postmeta where post_id = p.id and meta_key = 'add_delivery_date' )  as Fecha_recojo
                                      , (select meta_value from wp_postmeta where post_id = p.id and meta_key = '_billing_city' ) as Ciudad 
                                  from (select ID, post_date, post_status from wp_posts where post_type = 'shop_order' AND ID = $order_id) p
                              ) PED");

  $shipping_city = $header[0]->Ciudad;
  $add_delivery_date = $header[0]->Fecha_recojo;

  /* Envío de pedido a tablas intermedias a través de la API */
  if ($_SERVER['SERVER_NAME'] == "localhost"){
    $urlAddToTempTablesPOS = "http://localhost/api/POST/addOrderToTempTablesPOS.php";
  } else {
    $urlAddToTempTablesPOS = "https://api.chimuagropecuaria.com.pe/POST/addOrderToTempTablesPOS.php";
  }

  $postTmpTables = array(
    'environment'   => $_SERVER['SERVER_NAME'],
    'order_id'      => $order_id
  );

  $curl = curl_init($urlAddToTempTablesPOS);
  curl_setopt($curl, CURLOPT_POST, 1);
  curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
  curl_setopt($curl, CURLOPT_POSTFIELDS, http_build_query($postTmpTables));
  $response = curl_exec($curl);
  curl_close($curl);

  /* Envío de pedido a BeeTrack */
  // if(strpos($shipping_city, 'trujillo') !== false || strpos($shipping_city, 'piura') !== false){
  //   if ($_SERVER['SERVER_NAME'] == "localhost"){
  //     $urlAddGuide = "http://localhost/api/POST/addGuideBTAPI.php";
  //   } else {
  //     $urlAddGuide = "http://api.chimuagropecuaria.com.pe/POST/addGuideBTAPI.php";
  //   }

  //   $post = array(
  //     'environment'   => $_SERVER['SERVER_NAME'],
  //     'city'          => $shipping_city,
  //     'delivery_date' => $add_delivery_date,
  //     'order_id'      => $order_id
  //   );

  //   $curl = curl_init($urlAddGuide);
  //   curl_setopt($curl, CURLOPT_POST, 1);
  //   curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
  //   curl_setopt($curl, CURLOPT_POSTFIELDS, http_build_query($post));
  //   $response = curl_exec($curl);
  //   curl_close($curl);
  // }  
}

add_action('woocommerce_order_status_processing', 'custom_processing');

/**
 * Actualizar pedidos en tablas intermedias de POS
 */

function after_order_update($order_id){
  global $wpdb;

  $header = $wpdb->get_results("SELECT PED.Fecha_recojo
                              , PED.Ciudad
                              FROM (
                                  SELECT p.ID
                                      , (select meta_value from wp_postmeta where post_id = p.id and meta_key = 'add_delivery_date' )  as Fecha_recojo
                                      , (select meta_value from wp_postmeta where post_id = p.id and meta_key = '_billing_city' ) as Ciudad 
                                  from (select ID, post_date, post_status from wp_posts where post_type = 'shop_order' AND ID = $order_id) p
                              ) PED");

  $shipping_city = $header[0]->Ciudad;
  $add_delivery_date = $header[0]->Fecha_recojo;

  /* Envío de pedido a tablas intermedias */
  if ($_SERVER['SERVER_NAME'] == "localhost"){
    $urlAddToTempTablesPOS = "http://localhost/api/PUT/updateOrderToTempTablesPOS.php";
  } else {
    $urlAddToTempTablesPOS = "https://api.chimuagropecuaria.com.pe/PUT/updateOrderToTempTablesPOS.php";
  }

  $postTmpTables = array(
    'environment'   => $_SERVER['SERVER_NAME'],
    'order_id'      => $order_id
  );

  $curl = curl_init($urlAddToTempTablesPOS);
  curl_setopt($curl, CURLOPT_POST, 1);
  curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
  curl_setopt($curl, CURLOPT_POSTFIELDS, http_build_query($postTmpTables));
  $response = curl_exec($curl);
  curl_close($curl);

  /* Envío de pedido a BeeTrack */
  // if(strpos($shipping_city, 'trujillo') !== false || strpos($shipping_city, 'piura') !== false){
  //   if ($_SERVER['SERVER_NAME'] == "localhost"){
  //     $urlAddGuide = "http://localhost/api/POST/addGuideBTAPI.php";
  //   } else {
  //     $urlAddGuide = "http://api.chimuagropecuaria.com.pe/POST/addGuideBTAPI.php";
  //   }

  //   $post = array(
  //     'environment'   => $_SERVER['SERVER_NAME'],
  //     'city'          => $shipping_city,
  //     'delivery_date' => $add_delivery_date,
  //     'order_id'      => $order_id
  //   );

  //   $curl = curl_init($urlAddGuide);
  //   curl_setopt($curl, CURLOPT_POST, 1);
  //   curl_setopt($curl, CURLOPT_POSTFIELDS, http_build_query($post));
  //   curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
  //   $response = curl_exec($curl);  
  //   curl_close($curl);
  // }
}

add_filter('woocommerce_update_order', 'after_order_update');

/**
 * Estilos en administración de pedidos
 */


add_action('admin_head', 'my_custom_fonts');

function my_custom_fonts() {
  echo '<style>
		.status-invoiced {
			background: #BDBDD6;
			color: #5B5B99;
		}
  </style>';
}

/**
  * Añadir campos después de dirección de facturación en pdf de orden
  */

function wpo_wcpdf_delivery_date ($template_type, $order) {
	if (in_array($template_type, array('packing-slip', 'invoice'))) {
		?>
		<tr class="add_delivery_date">
				<th>Fecha de Entrega:</th>
				<td><?php echo $order->get_meta('add_delivery_date'); ?></td>
		</tr>
		<tr class="add_delivery_hour">
				<th>Hora de Entrega aprox.:</th>
				<td><?php echo $order->get_meta('add_delivery_hour'); ?></td>
		</tr>
		<tr class="custom_question_text_dnirecojo">
				<th>DNI de Persona de Entrega:</th>
				<td><?php echo $order->get_meta('custom_question_text_dnirecojo'); ?></td>
		</tr>
		<tr class="custom_question_text_precojo">
				<th>Persona de Entrega:</th>
				<td><?php echo $order->get_meta('custom_question_text_precojo'); ?></td>
		</tr>
		<?php
	}
}

add_action('wpo_wcpdf_after_order_data', 'wpo_wcpdf_delivery_date', 10, 2);

/**
	* Asignar tamaño de pdf imprimible
	*/

function wcpdf_custom_mm_page_size($paper_format, $template_type) {
	$width = 80; //mm!
	$height = 297; //mm!

	//convert mm to points
	$paper_format = array(0, 0, ($width/25.4) * 72, ($height/25.4) * 72);

	return $paper_format;
}

add_filter('wpo_wcpdf_paper_format', 'wcpdf_custom_mm_page_size', 10, 2);

/**
	* Cambiar título de PDF imprimible
	*/

function wpo_wcpdf_packing_slip_title() {
	$packing_slip_title = 'Ticket de Empaque';
	return $packing_slip_title;
}

add_filter('wpo_wcpdf_packing_slip_title', 'wpo_wcpdf_packing_slip_title');

/**
	* Añadir script en header
	*/

function head_js(){
?>
	
<!-- Global site tag (gtag.js) - Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id=G-139PWT5D6R"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'G-139PWT5D6R');

	const url_api_person_company = <?php echo ($_SERVER['SERVER_NAME'] == "localhost") ? "'http://localhost/wordpress/wp-content/themes/poco-child/person_company.php'" : "'https://xpress.chimuagropecuaria.com.pe/wp-content/themes/poco-child/person_company.php'"; ?>;
	const url_api_product_stock = <?php echo ($_SERVER['SERVER_NAME'] == "localhost") ? "'http://localhost/wordpress/wp-content/themes/poco-child/product_stock.php'" : "'https://xpress.chimuagropecuaria.com.pe/wp-content/themes/poco-child/product_stock.php'"; ?>;
	const url_update_usermeta = <?php echo ($_SERVER['SERVER_NAME'] == "localhost") ? "'http://localhost/wordpress/wp-content/themes/poco-child/update_usermeta.php'" : "'https://xpress.chimuagropecuaria.com.pe/wp-content/themes/poco-child/update_usermeta.php'"; ?>;

	const id_login_popup = <?php echo ($_SERVER['SERVER_NAME'] == "localhost") ? "13549" : "14859"; ?>;
	const id_shipping_popup = <?php echo ($_SERVER['SERVER_NAME'] == "localhost") ? "13489" : "14899"; ?>;
</script>

<?php 
}
add_action( 'wp_head', 'head_js', 10 );

function poco_form_login() {

	if (poco_is_woocommerce_activated()) {
		$account_link = get_permalink(get_option('woocommerce_myaccount_page_id'));
	} else {
		$account_link = wp_registration_url();
	}
?>

	<div class="login-form-head">
		<span class="login-form-title"><?php esc_attr_e('Sign in', 'poco') ?></span>
		<span class="pull-right">
			<a class="register-link" href="<?php echo esc_url($account_link); ?>"
			   title="<?php esc_attr_e('Register', 'poco'); ?>"><?php esc_attr_e('Create an Account', 'poco'); ?></a>
		</span>
	</div>
	<form class="poco-login-form-ajax" data-toggle="validator">
		<p>
			<label><?php esc_attr_e('Username or email', 'poco'); ?> <span class="required">*</span></label>
			<input name="username" type="text" required placeholder="<?php esc_attr_e('Username', 'poco') ?>">
		</p>
		<p>
			<label><?php esc_attr_e('Password', 'poco'); ?> <span class="required">*</span></label>
			<input name="password" type="password" required placeholder="<?php esc_attr_e('Password', 'poco') ?>">
		</p>
		<button type="submit" data-button-action class="btn btn-primary btn-block w-100 mt-1"><?php esc_html_e('Login', 'poco') ?></button>
		<input type="hidden" name="action" value="poco_login">
		<?php wp_nonce_field('ajax-poco-login-nonce', 'security-login'); ?>
	</form>
	<?php do_action( 'woocommerce_login_form_end' ); ?>
	<div class="login-form-bottom">
		<a href="<?php echo wp_lostpassword_url(get_permalink()); ?>" class="lostpass-link" title="<?php esc_attr_e('Lost your password?', 'poco'); ?>"><?php esc_attr_e('Lost your password?', 'poco'); ?></a>
	</div>
	<?php
}

/**
	* Cambiar costo de delivery según tipo y distrito
	*/

function custom_shipping_costs( $rates, $package ) {
	$current_user = wp_get_current_user();
	
	$shipping_delivery_type = get_user_meta( get_current_user_id(), 'shipping_delivery_type' , true );
	$shipping_city = get_user_meta( get_current_user_id(), 'shipping_city' , true );
	$shipping_state = get_user_meta( get_current_user_id(), 'shipping_state' , true );

	if(!empty($rates)){
		if($shipping_delivery_type == 'xpress'){
			switch ($shipping_city) {
				case 'Trujillo - Trujillo':
				case 'Piura - Piura':
					$rates['flat_rate:2']->cost = 5;
					break;
				case 'Trujillo - Victor Larco':
				case 'Trujillo - La Esperanza':
				case 'Piura - 26 de Octubre':
				case 'Piura - Castilla':
					$rates['flat_rate:2']->cost = 7;
					break;
			}
		} else if($shipping_delivery_type == 'programmed') {
			$cart_subtotal = WC()->cart->subtotal;

			switch ($shipping_state) {
				case 'LAL':
					if($cart_subtotal >= 40 && $cart_subtotal < 80){
						switch ($shipping_city) {
							case 'Trujillo - Trujillo':
								$rates['flat_rate:2']->cost = 5;
								break;
							case 'Trujillo - Victor Larco':
							case 'Trujillo - La Esperanza':
								$rates['flat_rate:2']->cost = 7;
								break;
						}
					} else if($cart_subtotal >= 80) {
						$rates['flat_rate:2']->cost = 0;
					}
					break;
				case 'PIU':
					if($cart_subtotal >= 40 && $cart_subtotal < 60){
						switch ($shipping_city) {
							case 'Piura - Piura':
								$rates['flat_rate:2']->cost = 5;
								break;
							case 'Piura - 26 de Octubre':
							case 'Piura - Castilla':
								$rates['flat_rate:2']->cost = 7;
								break;
						}
					} else if($cart_subtotal >= 60) {
						$rates['flat_rate:2']->cost = 0;
					}
					break;
			}
		}
	}

	return $rates;
}

add_filter( 'woocommerce_package_rates', 'custom_shipping_costs', 20, 2 );

/**
	* Vaildar monto mínimo de carrito al dirigirse a checkout
	*/

function minimum_order_validation_redirect(){
	if(is_checkout() && empty( is_wc_endpoint_url('order-received') )){
		$current_user = wp_get_current_user();
		$cookie_name = $current_user->user_login . "_shipping_obj";
		$min_amount = 40;
	
		$shipping_delivery_type = get_user_meta( get_current_user_id(), 'shipping_delivery_type' , true );
		$shipping_state = get_user_meta( get_current_user_id(), 'shipping_state' , true );

		// if(!empty($shipping_delivery_type) && !empty($shipping_state)) {

		// 	if($shipping_delivery_type == 'programmed'){
		// 		if($shipping_state == 'LAL'){
		// 			$min_amount = 80;
		// 		} else if($shipping_state == 'PIU'){
		// 			$min_amount = 60;
		// 		}
		// 	}
		// }

		if(WC()->cart->subtotal < $min_amount){
			$is_valid = false;
		} else {
			$is_valid = true;
		}

		if(!$is_valid){
			wc_add_notice( __( "Su pedido debe ser <b>mayor o igual a $min_amount soles</b> sin incluir el delivery.", 'woocommerce' ), 'error' );
			wp_safe_redirect( get_permalink( get_option('woocommerce_cart_page_id') ) );
			exit;
		}
	}
}

add_action( 'template_redirect' , 'minimum_order_validation_redirect' );

/**
	* Añadir mensaje de monto mínimo en carrito lateral
	*/
	
function action_woocommerce_widget_shopping_cart_before_buttons(  ) { 
	$current_user = wp_get_current_user();
	$cookie_name = $current_user->user_login . "_shipping_obj";
	$min_amount = 40;
	
	$shipping_delivery_type = get_user_meta( get_current_user_id(), 'shipping_delivery_type' , true );
	$shipping_state = get_user_meta( get_current_user_id(), 'shipping_state' , true );

	// if(!empty($shipping_delivery_type) && !empty($shipping_state)) {
	// 	if($shipping_delivery_type == 'programmed'){
	// 		if($shipping_state == 'LAL'){
	// 			$min_amount = 80;
	// 		} else if($shipping_state == 'PIU'){
	// 			$min_amount = 60;
	// 		}
	// 	}
	// }
	?>
	<p class="woocommerce-mini-cart__alert">Compra mínima de S/<strong><?php echo $min_amount; ?></strong></p>
	<?php
}; 
			 
add_action( 'woocommerce_widget_shopping_cart_before_buttons', 'action_woocommerce_widget_shopping_cart_before_buttons', 10, 0 ); 
add_action( 'woocommerce_proceed_to_checkout', 'action_woocommerce_widget_shopping_cart_before_buttons', 10, 0 ); 

/**
	* Acción ajax de envío de formulario personalizada - Elementor
	*/

add_action( 'elementor_pro/forms/new_record', function( $record, $ajax_handler ) {
	//make sure its our form
	$form_name = $record->get_form_settings( 'form_name' );
	if ( 'shipping_popup' !== $form_name ) {
		return;
	}
	//normalize the fields
	$raw_fields = $record->get( 'fields' );
	$fields = [];
	foreach ( $raw_fields as $id => $field ) {
		$fields[ $id ] = $field['value'];
	}

	$ajax_handler->data['output'] = $fields;
}, 10, 2 );
