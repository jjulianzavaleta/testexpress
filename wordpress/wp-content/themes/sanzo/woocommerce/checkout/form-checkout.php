<?php
/**
 * Checkout Form
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/checkout/form-checkout.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce/Templates
 * @version 3.5.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

?>
<div class="checkout-login-coupon-wrapper">
<?php
	do_action( 'woocommerce_before_checkout_form', $checkout );
?>
</div>
<?php

// If checkout registration is disabled and not logged in, the user cannot checkout
if ( ! $checkout->is_registration_enabled() && $checkout->is_registration_required() && ! is_user_logged_in() ) {
	echo esc_html( apply_filters( 'woocommerce_checkout_must_be_logged_in_message', __( 'You must be logged in to checkout.', 'sanzo' ) ) );
	return;
}

$user = wp_get_current_user();
$roles = ( array ) $user->roles;
$is_picador = in_array($roles[0], array('picador-noria', 'picador-porvenir'));

?>

<form name="checkout" method="post" class="checkout woocommerce-checkout" action="<?php echo esc_url( wc_get_checkout_url() ); ?>" enctype="multipart/form-data" onkeydown="return event.key != 'Enter';">

	<?php if ( $checkout->get_checkout_fields() ) : ?>

		<?php do_action( 'woocommerce_checkout_before_customer_details' ); ?>

		<div class="col2-set" id="customer_details">
			<div class="col-1">
				<?php if (!is_user_logged_in() && $checkout->is_registration_enabled()) : ?>
					<div class="woocommerce-account-fields">
						<h3 style="color: #253667 !important;"><?php esc_html_e('Nuevo Usuario (Registro)', 'woocommerce'); ?></h3>
						<?php if (!$checkout->is_registration_required()) : ?>

						<p class="form-row form-row-wide create-account">
							<label class="woocommerce-form__label woocommerce-form__label-for-checkbox checkbox">
							<input class="woocommerce-form__input woocommerce-form__input-checkbox input-checkbox" id="createaccount" <?php checked((true === $checkout->get_value('createaccount') || (true === apply_filters('woocommerce_create_account_default_checked', false))), true); ?> type="checkbox" name="createaccount" value="1" /> <span><?php esc_html_e('Create an account?', 'woocommerce'); ?></span>
							</label>
						</p>

						<?php endif; ?>

						<?php do_action('woocommerce_before_checkout_registration_form', $checkout); ?>

						<?php if ($checkout->get_checkout_fields('account')) : ?>

						<div class="create-account">
							<?php foreach ($checkout->get_checkout_fields('account') as $key => $field) : ?>
							<?php woocommerce_form_field($key, $field, $checkout->get_value($key)); ?>
							<?php endforeach; ?>
							<div class="clear"></div>
						</div>

						<?php endif; ?>

						<?php do_action('woocommerce_after_checkout_registration_form', $checkout); ?>
					</div>
				<?php endif; ?>
				<div class="woocommerce-billing-fields">
					<?php if (wc_ship_to_billing_address_only() && WC()->cart->needs_shipping()) : ?>

						<h3><?php esc_html_e('Billing &amp; Shipping', 'woocommerce'); ?></h3>

					<?php else : ?>

						<h3><?php esc_html_e('Billing details', 'woocommerce'); ?></h3>

					<?php endif; ?>

					<?php do_action('woocommerce_before_checkout_billing_form', $checkout); ?>
					<br>
					<br>
					<p style="font-style: italic; font-size: 12px;">Los campos con un <span style="color: red">*</span> son requeridos</p>
					<?php
						echo "<div class='custom-question-field-wrapper custom-question-1'>";

						echo "<div class='inline-group'>";
						if(WC()->cart->total < 700){
							woocommerce_form_field('custom_question_field', array(
							'type'            => 'radio',
							'class'           => array('custom-question-field', 'form-row-wide'),
							'options'         => array(
								'rbuton_boleta'         => '  Boleta  ',
								'rbuton_boleta_propia'    => '  Boleta a Nombre Propio  ',
								'rbuton_factura'    => '  Factura  '
							),
							), $checkout->get_value('custom_question_field'));

						} else {
							woocommerce_form_field('custom_question_field', array(
							'type'            => 'radio',
							'class'           => array('custom-question-field', 'form-row-wide'),
							'options'         => array(
								'rbuton_boleta_propia'    => '  Boleta a Nombre Propio  ',
								'rbuton_factura'    => '  Factura  '
							),
							), $checkout->get_value('custom_question_field'));
						}
						echo "</div>";

						echo "<div class='ruc-container' style='display:none;'>";
						woocommerce_form_field('custom_question_text_ruc', array(
						'type'            => 'text',
						'label'           => 'RUC',
						'required'        => true,
						'class'           => array('custom-question-ruc-field', 'form-row-wide'),
						), $checkout->get_value('custom_question_text_ruc'));

						woocommerce_form_field('custom_question_text_razonsocial', array(
						'type'              => 'text',
						'label'             => 'Razon Social',
						'custom_attributes' => array('readonly' => 'readonly'),
						'class'             => array('custom-question-razonsocial-field', 'form-row-wide'),
						), $checkout->get_value('custom_question_text_razonsocial'));

						woocommerce_form_field('custom_question_text_direccion', array(
						'type'              => 'text',
						'custom_attributes' => array('readonly' => 'readonly')
						), $checkout->get_value('custom_question_text_direccion'));

						echo "<div id='ruc-overlay' style='display: none;'>
								<div class='lds-ellipsis'><div></div><div></div><div></div><div></div></div>
							</div>
						</div>
						</div>";

						echo "<div class='person-client-container'>";

						woocommerce_form_field('custom_question_text_dni_client', array(
						'type'            => 'text',
						'label'           => 'DNI',
						'required'        => true,
						'class'           => array('custom-question-dni_client-field', 'form-row-wide'),
						), $checkout->get_value('custom_question_text_dni_client'));

						woocommerce_form_field('custom_question_text_name_client', array(
						'type'              => 'text',
						'label'             => 'Nombres y Apellidos',
						'custom_attributes' => array('readonly' => 'readonly'),
						'class'             => array('custom-question-precojo-field', 'form-row-wide'),
						), $checkout->get_value('custom_question_text_name_client'));

						echo "<div id='person-client-overlay' style='display: none;'>
								<div class='lds-ellipsis'><div></div><div></div><div></div><div></div></div>
							</div>
							</div>";
					
					$billing_fields = $checkout->get_checkout_fields('billing');
					$shipping_fields = $checkout->get_checkout_fields('shipping');
					?>

					<div class="woocommerce-billing-fields__field-wrapper">
						<?php
						woocommerce_form_field('billing_first_name', $billing_fields['billing_first_name'], $checkout->get_value('billing_first_name'));
						woocommerce_form_field('billing_last_name', $billing_fields['billing_last_name'], $checkout->get_value('billing_last_name'));
						woocommerce_form_field('billing_phone', $billing_fields['billing_phone'], $checkout->get_value('billing_phone'));
						woocommerce_form_field('billing_email', $billing_fields['billing_email'], $checkout->get_value('billing_email'));
						woocommerce_form_field('billing_country', $billing_fields['billing_country'], $checkout->get_value('billing_country'));
						?>
					</div>
					
				</div>
				
				<div class="checkout_shipping_fields">
					<div>
						<h3>Detalles <?php echo (!$is_picador) ? 'de entrega' : '';  ?></h3>
					</div>
					
					<div class="alert info">
						Si su dirección no tiene calle, avenida o jirón escriba "Sin calle"
					</div>

					<div>
						<?php
						woocommerce_form_field('shipping_address_1', $shipping_fields['shipping_address_1'], $checkout->get_value('shipping_address_1'));
						woocommerce_form_field('shipping_address_2', $shipping_fields['shipping_address_2'], $checkout->get_value('shipping_address_2'));
						woocommerce_form_field('shipping_urbanization', $shipping_fields['shipping_urbanization'], $checkout->get_value('shipping_urbanization'));
						woocommerce_form_field('shipping_city', $shipping_fields['shipping_city'], $checkout->get_value('shipping_city'));
						woocommerce_form_field('shipping_state', $shipping_fields['shipping_state'], $checkout->get_value('shipping_state'));
						woocommerce_form_field('shipping_formated_address_gmaps', array('label' => 'Dirección completa',  'custom_attributes' => array('readonly'=>'readonly')), $checkout->get_value('shipping_formated_address_gmaps'));
						woocommerce_form_field('shipping_street_number_gmaps', array('label' => 'N°'), $checkout->get_value('shipping_street_number_gmaps'));
						woocommerce_form_field('shipping_route_gmaps', array('label' => 'Calle'), $checkout->get_value('shipping_route_gmaps'));
						woocommerce_form_field('shipping_sublocality_level_1_gmaps', array('label' => 'Sublocalidad'), $checkout->get_value('shipping_sublocality_level_1_gmaps'));
						woocommerce_form_field('shipping_locality_gmaps', array('label' => 'Distrito'), $checkout->get_value('shipping_locality_gmaps'));
						woocommerce_form_field('shipping_administrative_area_level_2_gmaps', array('label' => 'Ciudad', 'custom_attributes' => array('readonly'=>'readonly')), $checkout->get_value('shipping_administrative_area_level_2_gmaps'));
						woocommerce_form_field('shipping_administrative_area_level_1_gmaps', array('label' => 'Departamento',  'custom_attributes' => array('readonly'=>'readonly')), $checkout->get_value('shipping_administrative_area_level_1_gmaps'));
						woocommerce_form_field('shipping_country_gmaps', array('label' => 'País'), $checkout->get_value('shipping_country_gmaps'));
						woocommerce_form_field('shipping_postal_code_gmaps', array('label' => 'Codígo postal'), $checkout->get_value('shipping_postal_code_gmaps'));
						woocommerce_form_field('shipping_lat_gmaps', array('label' => 'Lat'), $checkout->get_value('shipping_lat_gmaps'));
						woocommerce_form_field('shipping_lng_gmaps', array('label' => 'Long'), $checkout->get_value('shipping_lng_gmaps'));
						woocommerce_form_field('shipping_reference', $shipping_fields['shipping_reference'], $checkout->get_value('shipping_reference'));
						?>
					</div>

					<div id="legend">
						<p>Arrastre el marcador rojo hacia el lugar exacto donde recibirá su pedido</p>
					</div>
					<div id="map"  style="<?php echo ($is_picador) ? 'display: none;' : ''?> margin: 0 0 12px;"></div>
					<input type="text" id="valid_map_location" name="valid_map_location" readonly>
				</div>

				<?php do_action('woocommerce_after_checkout_billing_form', $checkout); ?>
			</div>

			<div class="col-2">
				<div class="different_billing_address">

					<?php do_action( 'woocommerce_before_checkout_shipping_form', $checkout ); ?>

					<div class="woocommerce-billing-fields__field-wrapper">
						<?php
						woocommerce_form_field('billing_state', $billing_fields['billing_state'], $checkout->get_value('billing_state'));
						woocommerce_form_field('billing_city', $billing_fields['billing_city'], $checkout->get_value('billing_city'));
						woocommerce_form_field('billing_address_1', $billing_fields['billing_address_1'], $checkout->get_value('billing_address_1'));
						?>
					</div>

					<?php do_action( 'woocommerce_after_checkout_shipping_form', $checkout ); ?>

				</div>
				
				<div class="woocommerce-additional-fields">
					<?php do_action( 'woocommerce_before_order_notes', $checkout ); ?>

					<?php if ( apply_filters( 'woocommerce_enable_order_notes_field', 'yes' === get_option( 'woocommerce_enable_order_comments', 'yes' ) ) ) : ?>

						<?php if ( ! WC()->cart->needs_shipping() || wc_ship_to_billing_address_only() ) : ?>

							<h3><?php esc_html_e( 'Additional information', 'woocommerce' ); ?></h3>

						<?php endif; ?>

						<div class="woocommerce-additional-fields__field-wrapper">
							<?php foreach ( $checkout->get_checkout_fields( 'order' ) as $key => $field ) : ?>
								<?php woocommerce_form_field( $key, $field, $checkout->get_value( $key ) ); ?>
							<?php endforeach; ?>
						</div>

					<?php endif; ?>

					<?php do_action( 'woocommerce_after_order_notes', $checkout ); ?>
				</div>
			</div>
		</div>

		<?php do_action( 'woocommerce_checkout_after_customer_details' ); ?>

	<?php endif; ?>

	<?php do_action( 'woocommerce_checkout_before_order_review' ); ?>

	<div id="order_review" class="woocommerce-checkout-review-order">
		<h3 id="order_review_heading"><?php esc_html_e( 'Your order', 'sanzo' ); ?></h3>
		<?php do_action( 'woocommerce_checkout_order_review' ); ?>
	</div>

	<?php do_action( 'woocommerce_checkout_after_order_review' ); ?>

</form>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCEkHQY_gLzvbIDkI-nrKjkuMn7dLXTgRE&libraries=places,geometry&callback=initMaps" async defer></script>

<?php do_action( 'woocommerce_after_checkout_form', $checkout ); ?>