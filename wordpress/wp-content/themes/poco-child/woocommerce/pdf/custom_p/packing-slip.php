<?php if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly ?>
<?php do_action( 'wpo_wcpdf_before_document', $this->type, $this->order ); ?>

<table class="head container">
	<tr>
		<td class="header" style="text-align: center;">
		<?php
		if( $this->has_header_logo() ) {
			$this->header_logo();
		} else {
			echo $this->get_title();
		}
		?>
		</td>
		<!--<td class="shop-info">
			<div class="shop-name"><h3><?php $this->shop_name(); ?></h3></div>
			<div class="shop-address"><?php $this->shop_address(); ?></div>
		</td>-->
	</tr>
</table>

<h2 class="document-type-label">
<?php if( $this->has_header_logo() ) echo $this->get_title(); ?>
</h2>

<?php do_action( 'wpo_wcpdf_after_document_label', $this->type, $this->order ); ?>

<table class="order-data-addresses">
	<tr>
		<td class="address shipping-address">
			
			<?php if ( isset($this->settings['display_billing_address']) && $this->ships_to_different_address()) { ?>
			<h3><?php _e( 'DATOS DE FACTURACIÓN:', 'woocommerce-pdf-invoices-packing-slips' ); ?></h3>
			
			<?php do_action( 'wpo_wcpdf_before_billing_address', $this->type, $this->order ); ?>

			<table>
				<tbody>
					<tr>
						<th>Doc.:</th><td><?php echo $this->order->get_meta('custom_question_field') == 'rbuton_boleta' ? 'Boleta' : 'Factura'; ?></td>
					</tr>
					<tr>
						<th><?php echo $this->order->get_meta('custom_question_field') == 'rbuton_boleta' ? 'DNI:' : 'RUC:'; ?></th><td><?php echo $this->order->get_meta('custom_question_field') == 'rbuton_boleta' ? $this->order->get_meta('custom_question_text_dni_client') : $this->order->get_meta('custom_question_text_ruc'); ?></td>
					</tr>
					<tr>
						<th>Cliente:</th><td><?php echo $this->order->get_meta('custom_question_field') == 'rbuton_boleta' ? $this->order->get_meta('custom_question_text_name_client') : $this->order->get_meta('custom_question_text_razonsocial'); ?></td>
					</tr>
					<tr>
						<th>Dirección:</th><td><?php echo strtoupper($this->order->billing_address_1); echo '<br>'; echo strtoupper($this->order->billing_city); echo ' - '; echo strtoupper(WC()->countries->get_states()['PE'][$this->order->billing_state]);  ?></td>
					</tr>
				</tbody>
			</table>

			<?php do_action( 'wpo_wcpdf_after_billing_address', $this->type, $this->order ); ?>
			<?php } ?>
			<br>
		    <h3><?php _e( 'DATOS DE ENVÍO:', 'woocommerce-pdf-invoices-packing-slips' ); ?></h3>
			<?php do_action( 'wpo_wcpdf_before_shipping_address', $this->type, $this->order ); ?>
			<div  style="text-transform: uppercase;"><?php $this->shipping_address(); ?></div>
			<?php do_action( 'wpo_wcpdf_after_shipping_address', $this->type, $this->order ); ?>
			<?php if ( isset($this->settings['display_phone']) ) { ?>
			<div class="billing-phone"><?php $this->billing_phone(); ?></div>
			<?php } ?>
			<br>
			<h3><?php _e( 'DETALLE:', 'woocommerce-pdf-invoices-packing-slips' ); ?></h3>
			<table>
				<?php do_action( 'wpo_wcpdf_before_order_data', $this->type, $this->order ); ?>
				<tr class="order-number">
					<th><?php _e( 'Pedido N°:', 'woocommerce-pdf-invoices-packing-slips' ); ?></th>
					<td><?php $this->order_number(); ?></td>
				</tr>
				<tr class="order-date">
					<th><?php _e( 'Fecha de Pedido:', 'woocommerce-pdf-invoices-packing-slips' ); ?></th>
					<td><?php $this->order_date(); ?></td>
				</tr>
				<tr class="shipping-method">
					<th><?php _e( 'Entrega:', 'woocommerce-pdf-invoices-packing-slips' ); ?></th>
					<td><?php $this->shipping_method(); ?></td>
				</tr>
				<tr class="payment-method">
					<th><?php _e( 'Pago:', 'woocommerce-pdf-invoices-packing-slips' ); ?></th>
					<td><?php $this->payment_method(); ?></td>
				</tr>
				<?php do_action( 'wpo_wcpdf_after_order_data', $this->type, $this->order ); ?>
			</table>			
		</td>
	</tr>
</table>

<?php do_action( 'wpo_wcpdf_before_order_details', $this->type, $this->order ); ?>

<table class="order-details">
	<thead>
		<tr>
			<th class="product"><?php _e('Productos', 'woocommerce-pdf-invoices-packing-slips' ); ?></th>
			<th class="quantity"><?php _e('Cantidad', 'woocommerce-pdf-invoices-packing-slips' ); ?></th>
		</tr>
	</thead>
	<tbody>
		<?php $items = $this->get_order_items(); if( sizeof( $items ) > 0 ) : foreach( $items as $item_id => $item ) : ?>
		<tr class="<?php echo apply_filters( 'wpo_wcpdf_item_row_class', $item_id, $this->type, $this->order, $item_id ); ?>">
			<td class="product">
				<?php $description_label = __( 'Description', 'woocommerce-pdf-invoices-packing-slips' ); // registering alternate label translation ?>
				<span class="item-name"><?php echo $item['name']; ?></span>
				<?php do_action( 'wpo_wcpdf_before_item_meta', $this->type, $item, $this->order  ); ?>
				<span class="item-meta"><?php echo $item['meta']; ?></span>
				<dl class="meta">
					<?php $description_label = __( 'SKU', 'woocommerce-pdf-invoices-packing-slips' ); // registering alternate label translation ?>
					<?php if( !empty( $item['sku'] ) ) : ?><dt class="sku"><?php _e( 'SKU:', 'woocommerce-pdf-invoices-packing-slips' ); ?></dt><dd class="sku"><?php echo $item['sku']; ?></dd><?php endif; ?>
				</dl>
				<?php do_action( 'wpo_wcpdf_after_item_meta', $this->type, $item, $this->order  ); ?>
			</td>
			<td class="quantity">
			<?php echo $item['quantity'] ;?> &nbsp; <?php if($item['sku'] == "101578"){
				echo "und";
				}
				else{
					echo get_option('woocommerce_weight_unit');
				}
			?>
			</td>
		</tr>
		<?php endforeach; endif; ?>
	</tbody>
</table>

<?php do_action( 'wpo_wcpdf_after_order_details', $this->type, $this->order ); ?>

<?php do_action( 'wpo_wcpdf_before_customer_notes', $this->type, $this->order ); ?>
<div class="customer-notes">
	<?php if ( $this->get_shipping_notes() ) : ?>
		<h3><?php _e( 'Customer Notes', 'woocommerce-pdf-invoices-packing-slips' ); ?></h3>
		<?php $this->shipping_notes(); ?>
	<?php endif; ?>
</div>
<?php do_action( 'wpo_wcpdf_after_customer_notes', $this->type, $this->order ); ?>

<?php if ( $this->get_footer() ): ?>
<div id="footer">
	<?php $this->footer(); ?>
</div><!-- #letter-footer -->
<?php endif; ?>

<?php do_action( 'wpo_wcpdf_after_document', $this->type, $this->order ); ?>