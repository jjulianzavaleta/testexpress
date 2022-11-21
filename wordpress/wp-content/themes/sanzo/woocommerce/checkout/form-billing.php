<?php
/**
 * Checkout billing information form
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/checkout/form-billing.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce/Templates
 * @version 3.6.0
 * @global WC_Checkout $checkout
 */

defined('ABSPATH') || exit;
?>

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

  <?php
    echo "<br>";
    echo "<div class='custom-question-field-wrapper custom-question-1'>";

    echo "<div class='inline-group'>";
    woocommerce_form_field('custom_question_field', array(
      'type'            => 'radio',
      'required'        => false,
      'class'           => array('custom-question-field', 'form-row-wide'),
      'options'         => array(
        'rbuton_boleta'         => '  Boleta  ',
        'rbuton_factura'    => '  Factura  ',
        'rbuton_boleta_propia'    => '  Boleta Propia  '
      ),
    ), $checkout->get_value('custom_question_field'));
    echo "</div>";

    echo "<div class='ruc-container' style='display:none;'>";
    woocommerce_form_field('custom_question_text_ruc', array(
      'type'            => 'text',
      'label'           => 'RUC :',
      'required'        => false,
      'class'           => array('custom-question-ruc-field', 'form-row-wide'),
    ), $checkout->get_value('custom_question_text_ruc'));

     woocommerce_form_field('custom_question_text_razonsocial', array(
      'type'              => 'text',
      'label'             => 'Razon Social :',
      'required'          => false,
      'custom_attributes' => array('readonly' => 'readonly'),
      'class'             => array('custom-question-razonsocial-field', 'form-row-wide'),
    ), $checkout->get_value('custom_question_text_razonsocial'));

    echo "<div id='ruc-overlay' style='display: none;'>
            <div class='lds-ellipsis'><div></div><div></div><div></div><div></div></div>
        </div>
      </div>
    </div>";

    echo "<div class='person-client-container'>";

    woocommerce_form_field('custom_question_text_dni_client', array(
      'type'            => 'text',
      'label'           => 'DNI del Cliente :',
      'required'        => false,
      'class'           => array('custom-question-dni_client-field', 'form-row-wide'),
    ), $checkout->get_value('custom_question_text_dni_client'));

    woocommerce_form_field('custom_question_text_name_client', array(
      'type'              => 'text',
      'label'             => 'Nombres y Apellidos del Cliente :',
      'required'          => false,
      'custom_attributes' => array('readonly' => 'readonly'),
      'class'             => array('custom-question-precojo-field', 'form-row-wide'),
    ), $checkout->get_value('custom_question_text_name_client'));

    echo "<div id='person-client-overlay' style='display: none;'>
            <div class='lds-ellipsis'><div></div><div></div><div></div><div></div></div>
          </div>
        </div>";
  ?>

  <div class="woocommerce-billing-fields__field-wrapper">
    <?php
    $fields = $checkout->get_checkout_fields('billing');

    foreach ($fields as $key => $field) {
      woocommerce_form_field($key, $field, $checkout->get_value($key));
    }
    ?>
  </div>

  <?php do_action('woocommerce_after_checkout_billing_form', $checkout); ?>
</div>