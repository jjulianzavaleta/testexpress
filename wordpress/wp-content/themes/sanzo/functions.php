<?php

require_once get_template_directory().'/admin/index.php';

/*** Include Framework File ***/
require_once get_template_directory().'/framework/init.php';

/**
  * Añadir scripts en footer
  */

if(!function_exists('custom_question_conditional_javascript')) {
  function custom_question_conditional_javascript() {
    ?>
    <script type="text/javascript">
    (function() {

      // Check if jquery exists
      if(!window.jQuery) {
        return;
      };

      var $ = window.jQuery;

      $(document).ready(function() {
        var questionField = $('.custom-question-field'),
        rucField = $('.custom-question-ruc-field'),
        razonsocialField = $('.custom-question-razonsocial-field');

        // Check that all fields exist
        if(!questionField.length || !rucField.length || !razonsocialField.length) {
          return;
        }

        function limpiarrucyrazon() {
          document.getElementById('custom_question_text_ruc').value = ""
          document.getElementById('custom_question_text_razonsocial').value = ""
          document.getElementById('custom_question_text_direccion').value = ""
        }

        $('#custom_question_text_dni_client').focusout(function(){
          var nomcomp =  "";
          $('#custom_question_text_name_client').val();
          var dni = $('#custom_question_text_dni_client').val();
          $.ajax({
            url:" ../wp-content/themes/sanzo/consulta_reniec.php",
            type: "POST",
            dataType: "json",
            timeout: 5000,
            data : {dni:dni},
            beforeSend: function(){
              $('#person-client-overlay').css('display', 'block');
            },
            complete: function(){
              $('#person-client-overlay').css('display', 'none');
            },
            success: function(data){
              if(data.dni == 0){
                $("#errordni").remove();
                $("#custom_question_text_dni_client").after('<span id="errordni" style="color:red">El DNI ingresado es inválido</span>');
                $("#custom_question_text_name_client").val("");
              } else {
                $("#errordni").remove();
                nomcomp = data.nombres + " " + data.apellidoPaterno + " " + data.apellidoMaterno;
                $('#custom_question_text_name_client').val(nomcomp);
                $('#billing_first_name').val(data.nombres);
                $('#billing_last_name').val(data.apellidoPaterno + " " + data.apellidoMaterno);
                $('#custom_question_text_dnirecojo').val($('#custom_question_text_dni_client').val());
                $('#custom_question_text_precojo').val($('#custom_question_text_name_client').val());
              }
            },
            error: function(xmlhttprequest, textstatus, message) {
              if(textstatus==="timeout") {
                $("#custom_question_text_name_client_field").css("display", "none");
                $("#billing_first_name_field").css("display", "block");
                $("#billing_last_name_field").css("display", "block");
              } else {
                alert(textstatus);
              }
            }
          });
        });

        var currenttxtrucfield = document.getElementById('custom_question_text_ruc').innerHTML;
        $('#custom_question_text_ruc').focusout(function(){
          var url = "../wp-content/themes/sanzo/consulta_ruc_dni.php";
          $.ajax({
            type: "POST",
            url: url,
            data: $("#custom_question_text_ruc").serialize(),
            beforeSend: function(){
              $('#ruc-overlay').css('display', 'block');
            },
            complete: function(){
              $('#ruc-overlay').css('display', 'none');
            },
            success: function(data) {
              if(data.ruc == "0"){
                $("#errorruc").remove();
                $('#custom_question_text_ruc_field').append('<span id="errorruc" style="color:red">El RUC ingresado es inválido</span>');
                $("#custom_question_text_razonsocial").val("");
                $("#custom_question_text_direccion").val("");
              } else {
                $("#errorruc").remove();
                $("#custom_question_text_ruc").val(data.ruc);
                $("#custom_question_text_razonsocial").val(data.razonSocial);
                $("#custom_question_text_direccion").val(data.direccion);
              }         
            }
          });
        });

        function limpiardnipersona(){
          document.getElementById('custom_question_text_precojo').value = ""
          document.getElementById('custom_question_text_dnirecojo').value = ""
        }
        
        var currenttxtdnifield = document.getElementById('custom_question_text_dnirecojo').innerHTML;
        var nombrecompleto = "";

        $('#custom_question_text_dnirecojo').focusout(function(){
          var nomcomp =  "";
          $('#custom_question_text_precojo').val();
          var dni = $('#custom_question_text_dnirecojo').val();
          $.ajax({
            url:" ../wp-content/themes/sanzo/consulta_reniec.php",
            type: "POST",
            dataType: "json",
            timeout: 5000,
            data : {dni:dni},
            beforeSend: function(){
              $('#dni-overlay').css('display', 'block');
            },
            complete: function(){
              $('#dni-overlay').css('display', 'none');
            },
            success: function(data) {
              if(data.dni == 0){
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
                $('#dni-overlay').css('display', 'none');
                $("#custom_question_text_precojo").attr("readonly", false); 
                $("#custom_question_text_precojo").css("background-color", "#FFF"); 
              } else {
                alert(textstatus);
              }
            }
          });
        });

        function toggleVisibleFields() {
          var selectedAnswer = questionField.find('input:checked').val();
          if(selectedAnswer === 'rbuton_boleta' || selectedAnswer === 'rbuton_boleta_propia') {
            $('.ruc-container').css('display','none');
            $("label[for*='custom_question_text_dni_client']").html("DNI <abbr class='required' title='obligatorio'>*</abbr>");
            $("label[for*='custom_question_text_name_client']").html("Nombres y Apellidos");
            limpiarrucyrazon();
          } else if(selectedAnswer === 'rbuton_factura') {
            $('.ruc-container').css('display','block');
            $("label[for*='custom_question_text_dni_client']").html("DNI del Representante <abbr class='required' title='obligatorio'>*</abbr>");
            $("label[for*='custom_question_text_name_client']").html("Nombres y Apellidos del Representante");
          }
        }

        $(document).on('change', 'input[name=custom_question_field]', toggleVisibleFields);
        $(document).on('change', '#cod_payment', function() {
          // Para asignar un nuevo valor a la variable global "a" no se usa var, 
          // solo el nombre de la variable
          if($("#cod_payment option:selected" ).text() == 'Efectivo'){
            alert('Por favor, pagar con monto exacto.')
          }
        });
        // $(document).on('updated_checkout', toggleVisibleFields);

        toggleVisibleFields();

        $('#custom_question_text_dnirecojo').val($('#custom_question_text_dni_client').val());
        $('#custom_question_text_precojo').val($('#custom_question_text_name_client').val());
      });
    })();
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
      'shipping_formated_address_gmaps'             => '',
      'shipping_street_number_gmaps'                => '',
      'shipping_route_gmaps'                        => '',
      'shipping_sublocality_level_1_gmaps'          => '',
      'shipping_locality_gmaps'                     => '',
      'shipping_administrative_area_level_2_gmaps'  => '',
      'shipping_administrative_area_level_1_gmaps'  => '',
      'shipping_country_gmaps'                      => '',
      'shipping_postal_code_gmaps'                  => '',
      'shipping_lat_gmaps'                          => '',
      'shipping_lng_gmaps'                          => '',
      'shipping_reference'                          => '',
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
      wc_add_notice('Por favor, ingrese una <b>calle, avenida o jirón</b>.', 'error');
    }

    if (!empty($_POST['shipping_address_1']) && !preg_match("/^[a-zA-ZáéíóúÁÉÍÓÚ. -]+$/",$_POST['shipping_address_1'])) {
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

    // if ($_POST['shipping_method'][0] != 'local_pickup:3' && (in_array($_POST['shipping_locality_gmaps'], array('Florencia de Mora', 'El Porvenir', 'Huanchaco')) ||
    // !in_array($_POST['shipping_administrative_area_level_2_gmaps'], array('Trujillo', 'Piura')))) {
    //   wc_add_notice('Por favor, <b>revise que su dirección de entrega esté en nuestra cobertura</b>.', 'error');
    // }

    if ($_POST['valid_map_location'] == '0') {
      wc_add_notice('Por favor, <b>revise que su ubicación de entrega esté en nuestra cobertura en el mapa</b>.', 'error');
    }

    // if(!empty($field_values['add_delivery_date'])){
    //   date_default_timezone_set('America/Lima');
    //   $vars = $field_values['add_delivery_date'];
    //   $datess = str_replace('/', '-', $vars);
    //   $delivery_date =  date('Y-m-d', strtotime($datess));
    //   $tomorrow_date = new DateTime();
    //   $tomorrow_date->modify('+1 day');
    //   $tomorrow = $tomorrow_date->format('Y-m-d');
    //   $now = date("H:i:s");

    //   if($_POST['billing_state'] == 'LAL'){
    //     if($now < '13:00:00'){
    //       $next_day = date("Y-m-d", strtotime("+ 1 day"));
    //     } else {
    //       $next_day = date("Y-m-d", strtotime("+ 2 day"));
    //     }
    //     $limit = 50;
    //     $limit_kg = 700;
    //   } else if ($_POST['billing_state'] == 'PIU'){
    //     if($now < '13:00:00'){
    //       $next_day = date("Y-m-d", strtotime("+ 2 day"));
    //     } else {
    //       $next_day = date("Y-m-d", strtotime("+ 3 day"));
    //     }
    //     $limit = 20;
    //     $limit_kg = 300;
    //   } else if ($_POST['billing_state'] == 'LAM'){
    //     if($now < '13:00:00'){
    //       $next_day = date("Y-m-d", strtotime("+ 2 day"));
    //     } else {
    //       $next_day = date("Y-m-d", strtotime("+ 3 day"));
    //     }
    //     $limit = 20;
    //     $limit_kg = 300;
    //   }

    //   if($delivery_date < $next_day){
    //     wc_add_notice('La fecha de entrega ya no se encuentra disponible, por favor actualice la página (F5) y seleccionar otra fecha', 'error');
    //   }

    //   $myrows = $wpdb->get_results("select count(pm.post_id) as orders
    //   from wp_posts p 
    //   join wp_postmeta pm on pm.post_id = p.id and pm.meta_key = 'add_delivery_date'
    //   join wp_postmeta pms on pms.post_id = p.id and pms.meta_key = '_billing_state'
    //   where p.post_type = 'shop_order' and p.post_status != 'wc-cancelled'
    //   and pm.meta_value = '" . $vars . "'
    //   and pms.meta_value = '" . $_POST['billing_state'] . "'");
      
    //   $total_kg = $wpdb->get_results("select sum(oim.meta_value) as kg
    //   from wp_posts p
    //   join wp_postmeta pmq on pmq.post_id = p.id and pmq.meta_key = 'add_delivery_date'
    //   join wp_postmeta pms on pms.post_id = p.id and pms.meta_key = '_billing_state'
    //   join wp_woocommerce_order_items oi on oi.order_id = p.id
    //   left join wp_woocommerce_order_itemmeta oim on oim.order_item_id = oi.order_item_id and oim.meta_key = '_qty'
    //   where p.post_type = 'shop_order'
    //   and p.post_status <> 'wc-cancelled'
    //   and oi.order_item_name not like '%bolsa%' and oi.order_item_type = 'line_item'
    //   and pmq.meta_value = '" . $vars . "'
    //   and pms.meta_value = '" . $_POST['billing_state'] . "'");

    //   if(intval($myrows[0]->orders) >= $limit || intval($total_kg[0]->kg) >= $limit_kg){
    //     wc_add_notice('La fecha de entrega ya no se encuentra disponible, por favor actualice la página (F5) y seleccionar otra fecha', 'error');
    //   }

    //   // $current_time = date("H:i");
    //   // if(strtotime($current_time) >= strtotime('19:00')){
    //   //   if(strtotime($delivery_date) < strtotime($tomorrow)){
    //   //     wc_add_notice('La fecha de entrega ya no se encuentra disponible, seleccionar otra fecha', 'error');
    //   //   }
    //   // }
    // }
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
        'label' => __('Referencia: ', 'add_extra_fields'),
        'value' => $shipping_reference,
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
}

add_action('woocommerce_admin_order_data_after_billing_address', 'mi_custom_checkout_field_display_admin_order_meta', 10, 1);

/**
  * Añadir función de días deshabilitados para calendario
  */

function next_available_day() {
  global $wpdb;
  date_default_timezone_set('America/Lima');
  $end_do = true;
  $i = 0;
  $now = date("H:i:s");
  $excluded = array();
  $dow = date('w');

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

  // Bloquear fecha
  // if($next_day == '29/07/2020'){
  //   $fecha = DateTime::createFromFormat('d/m/Y', $next_day);
  //   $next_day = $fecha->modify('+1 day')->format('d/m/Y');
  // }

  // do {
  //   $eval_date = date("Y-m-d", strtotime ($next_day ."+$i days"));
  //   //echo $eval_date . " " . date('w', strtotime($eval_date)) . "<br>";

  //   if(date('w', strtotime($eval_date)) == 0){
  //     $i++;
  //   } elseif (in_array($eval_date, $excluded)){
  //     $i++;
  //   } else {
  //     $myrows = $wpdb->get_results("select coalesce(count(pm.post_id), 0) as orders
  //     from wp_posts p 
  //     join wp_postmeta pm on pm.post_id = p.id and pm.meta_key = 'add_delivery_date'
  //     join wp_postmeta pms on pms.post_id = p.id and pms.meta_key = '_shipping_state'
  //     where p.post_type = 'shop_order' and p.post_status != 'wc-cancelled'
  //     and pm.meta_value = '" . date('d/m/Y', strtotime($eval_date)) . "'
  //     and pms.meta_value = '" . $_POST['department'] . "'");

  //     $total_kg = $wpdb->get_results("select coalesce(sum(oim.meta_value), 0) as kg
  //     from wp_posts p
  //     join wp_postmeta pmq on pmq.post_id = p.id and pmq.meta_key = 'add_delivery_date'
  //     join wp_postmeta pms on pms.post_id = p.id and pms.meta_key = '_shipping_state'
  //     join wp_woocommerce_order_items oi on oi.order_id = p.id
  //     left join wp_woocommerce_order_itemmeta oim on oim.order_item_id = oi.order_item_id and oim.meta_key = '_qty'
  //     where p.post_type = 'shop_order'
  //     and p.post_status <> 'wc-cancelled'
  //     and oi.order_item_name not like '%bolsa%' and oi.order_item_type = 'line_item'
  //     and pmq.meta_value = '" . date('d/m/Y', strtotime($eval_date)) . "'
  //     and pms.meta_value = '" . $_POST['department'] . "'");

  //     if(intval($myrows[0]->orders) < $limit && intval($total_kg[0]->kg) < $limit_kg){
  //       $end_do = false;
  //     } else {
  //       $i++;
  //     }
  //   }
  // } while ($end_do);

  echo $next_day; //date('d/m/Y', strtotime($eval_date));
  die;
}

add_action('wp_ajax_next_available_day', 'next_available_day' ); // executed when logged in
add_action('wp_ajax_nopriv_next_available_day', 'next_available_day' ); // executed when logged out

/**
  * Añadir datos extras en creación de orden
  */

function display_extra_fields_after_billing_address($checkout) {
  ?>
  <!-- <div class="alert warning">
    <span class="closebtn" onclick="this.parentElement.style.display='none';">&times;</span>
    Tener en cuenta la fecha de entrega del pedido; el precio de los productos puede variar, esto se le hará saber al momento de la entrega
  </div> -->
  <div style="overflow: hidden; display: inline-block; width: 100%;">
    <p class="form-row form-row-wide form-row-first">
    <?php _e("Fecha de Entrega", "add_extra_fields"); ?>
    <input type="text" name="add_delivery_date" class="add_delivery_date" placeholder="Fecha de Entrega" readonly="readonly"></p>
    <script>
      var ajax_url = <?php if ($_SERVER['SERVER_NAME'] == "localhost"){
        echo "'http://localhost/wordpress/wp-admin/admin-ajax.php'";       
      } else if ($_SERVER['SERVER_NAME'] == "testxpress.chimuagropecuaria.com.pe") {
        echo "'http://testxpress.chimuagropecuaria.com.pe/wp-admin/admin-ajax.php'";
      } else {
        echo "'https://xpress.chimuagropecuaria.com.pe/wp-admin/admin-ajax.php'";
      } ?>;

      jQuery(document).ready(function($) {

        $('.add_delivery_hour').val("");
        $("#billing_city").val(document.getElementById('shipping_city').value);

        loadPaymentTypesByDepartment($('#shipping_state').val());
        
        jQuery.ajax({
          type: "POST",
          url: ajax_url,
          data: {
              action: 'next_available_day',
              department: $("#shipping_state").val()
          },
          success: function (output) {
            dates =  [output];
            loadDatePicker(dates);
          }
        });

        loadTimepicker();


        function verificarsiespavo(){
          var contadorpavocart= 0;
          $('.shop_table tr').find('td.product-name').each(function() {
            var elem = $(this);
            if (!$(this).text().includes("PAVO")) {
            } else {
              contadorpavocart = contadorpavocart + 1;
            }
          });
          return contadorpavocart;
        }

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

        function isInRange(value, range) {
          return value >= range[0] && value <= range[1];
        }

        function loadDatePicker(dates) {
          $(".add_delivery_date").val("");
          $(".hasDatepicker").removeClass("hasDatepicker");
          $(".datepicker").datepicker("destroy");

          var d = new Date();
          var current_time = "";
          var h = addZero(d.getHours());
          var m = addZero(d.getMinutes());
          current_time = h + ":" + m ;

          if((current_time >= '00:00' && current_time < '13:00') && verifychecked() == 1) {
            var today = new Date();
            var tomorrow = new Date(today.getTime() + 24 * 60 * 60 * 1000);
            var week = new Date(today.getTime() + 4 * 24 * 60 * 60 * 1000);
            $(".add_delivery_date").datepicker({
              dayNamesMin: ["D","L","M","X","J","V","S"],
              dateFormat: 'dd/mm/yy',
              minDate: tomorrow,
              maxDate: week,
              beforeShowDay: function(date) {
                var sdate = $.datepicker.formatDate( 'dd/mm/yy', date)
                if($.inArray(sdate, dates) != -1) {
                    return [true];
                }
                return [false];
              },
              onClose:function(ct,$i){
                my_callback();
              },
              onSelect: function(){
                $(".add_delivery_hour").val("");
                $('.add_delivery_hour').timepicker('remove');
              }
            }).attr('readonly','readonly');
            //$('.add_delivery_date').datepicker('setDate', today);
            $('.add_delivery_date').click();
          // } else if(current_time < '17:30' && verifychecked() != 1) {
          //   var today = new Date();
          //   var tomorrow = new Date(today.getTime() + 24 * 60 * 60 * 1000);
          //   var week = new Date(today.getTime() + 4 * 24 * 60 * 60 * 1000);
          //   $(".add_delivery_date").datepicker({
          //     dayNamesMin: ["D","L","M","X","J","V","S"],
          //     dateFormat: 'dd/mm/yy',
          //     minDate: tomorrow,
          //     maxDate: week,
          //     beforeShowDay: function(date) {
          //       var string = jQuery.datepicker.formatDate('dd/mm/yy', date);
          //       return [ dates.indexOf(string) == -1 ]
          //     },
          //     onClose:function(ct,$i){
          //       my_callback();
          //     },
          //     onSelect: function(){
          //       $(".add_delivery_hour").val("");
          //       $('.add_delivery_hour').timepicker('remove');
          //     }
          //   }).attr('readonly','readonly');
          //   //$('.add_delivery_date').datepicker('setDate', tomorrow);
          //   $('.add_delivery_date').click();
          } else {
            var today = new Date();
            var past_tomorrow = new Date(today.getTime() + 2 * 24 * 60 * 60 * 1000);
            var week = new Date(today.getTime() + 4 * 24 * 60 * 60 * 1000);
            $(".add_delivery_date").datepicker({
              dayNamesMin: ["D","L","M","X","J","V","S"],
              dateFormat : 'dd/mm/yy',
              minDate : past_tomorrow,
              maxDate: week,
              beforeShowDay: function(date) {
                // var string = jQuery.datepicker.formatDate('dd/mm/yy', date);
                // return [ dates.indexOf(string) == -1 ]
                var sdate = $.datepicker.formatDate( 'dd/mm/yy', date)
                if($.inArray(sdate, dates) != -1) {
                    return [true];
                }
                return [false];
              },
              onClose:function(ct,$i){
                my_callback();
              },
              onSelect: function(){
                $(".add_delivery_hour").val("");
                $('.add_delivery_hour').timepicker('remove');
              },
            }).attr('readonly','readonly');
            //$('.add_delivery_date').datepicker('setDate', tomorrow);
            $('.add_delivery_date').click();
          }
        }

        function loadTimepicker() {
          if (verifychecked() == 1) {
            // Entrega a domicilio
            $(".add_delivery_hour").replaceWith('<select name="add_delivery_hour" class="add_delivery_hour">' +
                  '<option value="Entre 7 a.m. y 2 p.m.">Entre 7 a.m. y 2 p.m.</option>' +
                '</select>');
            var date = new Date();
            var today = date.toLocaleDateString('en-GB');
            var date_selected = $(".add_delivery_date").val();
            // if (date_selected == today || date_selected == '') {
            //   $('.warning').css('display', 'none');
            // } else {
            //   $('.warning').css('display', 'inline-block');
            // }
          } else {
            // Recojo en tienda
            $(".add_delivery_hour").replaceWith('<input type="text" name="add_delivery_hour" class="add_delivery_hour" placeholder="Hora de Entrega" autocomplete="off">');
            $(".add_delivery_hour").timepicker();
            var pairlunsab = [['00:00 am', '7:59 am'], ['1:01 pm', '4:59 pm'], ['6:01 pm','11:59 pm']];
            var pairdomfer = [['00:00 am', '7:59 am'], ['1:01 pm', '11:59 pm']];
            var date = $('.add_delivery_date').val();
            var d = new Date(date.split("/").reverse().join("-"));
            var dd = d.getDate();
            var mm = d.getMonth()+1;
            var yy = d.getFullYear();
            var newdate = yy+"/"+mm+"/"+dd;
            var newdate2 =  dd+"/"+mm+"/"+yy;
            var dia = getDayOfWeek(newdate) 
            var currentfec = new Date();
            var hoy = currentfec.toLocaleDateString('en-GB');
            var fechaseleccionada = $(".add_delivery_date").val();
            var newhora;
            var newminut;
            var bandera ;
            var rangedom = ['08:00','13:00'];
            var rangelunsab = ['17:00','18:00'];
            if (fechaseleccionada == hoy || fechaseleccionada == '') {
              // $('.warning').css('display', 'none');
              if(dia == "Domingo"){
                currentfec.setMinutes(currentfec.getMinutes()+30);
                hora = currentfec.getHours();
                time = hora + ":" + currentfec.getMinutes();
                bandera = isInRange(time, rangedom) ? true : false ;
                if (bandera) {
                  if(hora == 12){
                    timesufix = "pm";
                    mintime = time + "" + timesufix;
                  } else {
                    timesufix = "am";
                    mintime = time + "" + timesufix;
                  }

                  $(".add_delivery_hour").timepicker('option',{ 
                    'minTime': mintime,
                    'maxTime': '1:00 pm',
                    'forceRoundTime':true,
                    'disableTextInput': true,
                    'disableTimeRanges': pairdomfer
                  })
                } else {
                  if (time < '08:00') {
                    mintime = '8:00am';
                    maxtime = '1:00pm';
                    $(".add_delivery_hour").timepicker('option',{ 
                      'minTime': mintime,
                      'maxTime': maxtime,
                      'disableTextInput': true,
                      'disableTimeRanges': pairdomfer
                    })
                  } else {
                    $('.add_delivery_hour').timepicker('remove');
                  }
                }
              } else {
                currentfec.setMinutes(currentfec.getMinutes() + 30);
                hora = currentfec.getHours();
                minutos = currentfec.getMinutes();
                if(hora < 10){
                  hora = '0' + hora;
                }
                if(minutos < 10){
                  minutos = '0' + minutos;
                }
                time = hora + ':' + minutos;
                bandera1 = isInRange(time, rangedom) ? 1 : 0 ;
                bandera2 = isInRange(time, rangelunsab) ? 2 : 0 ;
                bandera = bandera1 + bandera2;

                if (bandera == 1) {
                  if(hora == 12){
                    timesufix = "pm";
                    mintime = time + "" + timesufix;
                  } else{
                    timesufix = "am";
                    mintime = time + "" + timesufix;
                  }

                  $(".add_delivery_hour").timepicker('option',{ 
                    'minTime': mintime,
                    'maxTime': '6:00 pm',
                    'disableTextInput': true,
                    'disableTimeRanges': pairlunsab
                  })
                } else if(bandera == 2) {
                  if (hora < '17:00') {
                    mintime = "5:30pm";
                  } else {
                    mintime = "6:00pm";
                  }
                  $(".add_delivery_hour").timepicker('option',{ 
                    'minTime': mintime,
                    'maxTime': '6:00 pm',
                    'disableTextInput': true,
                    'disableTimeRanges': pairlunsab
                  })
                } else {
                  if (time < '08:00') {
                    mintime = '8:00am';
                    maxtime = '6:00pm';
                    $(".add_delivery_hour").timepicker('option',{ 
                      'minTime': mintime,
                      'maxTime': maxtime,
                      'disableTextInput': true,
                      'disableTimeRanges': pairlunsab
                    })
                  } else if(time < '17:00' && time > "13:00") {
                    mintime = '5:00pm';
                    maxtime = '6:00pm';
                    $(".add_delivery_hour").timepicker('option',{ 
                      'minTime': mintime,
                      'maxTime': maxtime,
                      'disableTextInput': true,
                      'disableTimeRanges': pairlunsab
                    })
                  } else if(time < '17:31' && time > "17:00") {
                    mintime = '5:30pm';
                    maxtime = '6:00pm';
                    $(".add_delivery_hour").timepicker('option',{
                      'minTime': mintime,
                      'maxTime': maxtime,
                      'disableTextInput': true,
                      'disableTimeRanges': pairlunsab
                    })
                  } else {
                    $('.add_delivery_hour').timepicker('remove');
                  }
                }
              }
            } else {
              // $('.warning').css('display', 'inline-block');
              if (dia=="Domingo") {
                $(".add_delivery_hour").timepicker('option',{
                  'minTime': '8:00 am',
                  'maxTime': '1:00 pm',
                  'disableTextInput': true,
                  'disableTimeRanges': pairdomfer
                })
              } else {
                $(".add_delivery_hour").timepicker('option',{
                  'minTime': '8:00 am',
                  'maxTime': '6:00 pm',
                  'disableTextInput': true,
                  'disableTimeRanges': pairlunsab
                })
              }
            }
          }
        }

        function getDayOfWeek(date) {
          var dayOfWeek = new Date(date).getDay();    
          return isNaN(dayOfWeek) ? null : ['Lunes', 'Martes', 'Miercoles', 'Jueves', 'Viernes', 'Sabado','Domingo'][dayOfWeek];
        }

        $('.add_delivery_hour').prop('disabled',true);

        function my_callback() {
          if($.trim($('.add_delivery_date').val()) == ''){
            $('.add_delivery_hour').prop('disabled', true);
            loadTimepicker();
          } else {
            $('.add_delivery_hour').prop('disabled', false);
            loadTimepicker();
          }
        }

        $('.add_delivery_date').on("cut copy paste",function(e) {
          e.preventDefault();
        });

        $('.add_delivery_hour').on("cut copy paste",function(e) {
          e.preventDefault();
        });

        function addZero(i) {
          if (i < 10) {
            i = "0" + i;
          }
          return i;
        }
            
        //inicio precarga de datepicker 1 vez
        // var dat = new Date();
        // var current_time = "";
        // var hhh = addZero(dat.getHours());
        // var mmm = addZero(dat.getMinutes());
        // current_time= hhh + ":" + mmm ;
        // if(current_time < '08:00' && verifychecked() == 1) {
        //   var today = new Date();
        //   var tomorrow = new Date(today.getTime() + 24 * 60 * 60 * 1000);
        //   var week = new Date(today.getTime() + 4 * 24 * 60 * 60 * 1000);
        //   $(".add_delivery_date").datepicker({
        //     dayNamesMin: ["D","L","M","X","J","V","S"],
        //     dateFormat : 'dd/mm/yy',
        //     minDate : tomorrow,
        //     maxDate: week,
        //     beforeShowDay: function(date) {
        //       var string = jQuery.datepicker.formatDate('dd/mm/yy', date);
        //       return [ dates.indexOf(string) == -1 ]
        //       // var day = date.getDay();
        //       // return [(day != 0), ''];
        //     },
        //     onClose:function(ct, $i){
        //       my_callback();
        //     },
        //     onSelect: function() {
        //       $(".add_delivery_hour").val("");
        //       $('.add_delivery_hour').timepicker('remove');
        //     },
        //   }).attr('readonly','readonly'); 
        // } else if(current_time < '17:30' && verifychecked() != 1) {
        //   var today = new Date();
        //   var tomorrow = new Date(today.getTime() + 24 * 60 * 60 * 1000);
        //   var week = new Date(today.getTime() + 4 * 24 * 60 * 60 * 1000);
        //   $(".add_delivery_date").datepicker({
        //     dayNamesMin: ["D","L","M","X","J","V","S"],
        //     dateFormat : 'dd/mm/yy',
        //     minDate : tomorrow,
        //     maxDate: week,
        //     beforeShowDay: function(date) {
        //       var string = jQuery.datepicker.formatDate('dd/mm/yy', date);
        //       return [ dates.indexOf(string) == -1 ]
        //       // var day = date.getDay();
        //       // return [(day != 0), ''];
        //     },
        //     onClose:function(ct, $i){
        //       my_callback();
        //     },
        //     onSelect: function() {
        //       $(".add_delivery_hour").val("");
        //       $('.add_delivery_hour').timepicker('remove');
        //     },
        //   }).attr('readonly','readonly'); 
        // } else {
        //   var today = new Date();
        //   var tomorrow = new Date(today.getTime() + 24 * 60 * 60 * 1000);
        //   var week = new Date(today.getTime() + 4 * 24 * 60 * 60 * 1000);
        //   $(".add_delivery_date").datepicker({
        //     dayNamesMin: ["D","L","M","X","J","V","S"],
        //     dateFormat: 'dd/mm/yy',
        //     minDate: tomorrow,
        //     maxDate: week,
        //     beforeShowDay: function(date) {
        //       var string = jQuery.datepicker.formatDate('dd/mm/yy', date);
        //       return [ dates.indexOf(string) == -1 ]
        //       // var day = date.getDay();
        //       // return [(day != 0), ''];
        //     },
        //     onClose:function(ct, $i){
        //       my_callback();
        //     },
        //     onSelect: function() {
        //       $(".add_delivery_hour").val("");
        //       $('.add_delivery_hour').timepicker('remove');
        //     },
        //   }).attr('readonly','readonly');
        // }
        //fin de precarga de datepicker 1 vez

        $( "#autocomplete" ).focus(function() {
          if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition(function(position) {
              var geolocation = {
                lat: position.coords.latitude,
                lng: position.coords.longitude
              };
              var circle = new google.maps.Circle(
                  {center: geolocation, radius: position.coords.accuracy});
              autocomplete.setBounds(circle.getBounds());
            });
          }
        });

        $( "#shipping_state" ).change(function() {
          jQuery.ajax({
            type: "POST",
            url: ajax_url,
            data: {
                action: 'next_available_day',
                department: this.value
            },
            success: function (output) {
              dates =  [output];
              loadDatePicker(dates);
            }
          });

          loadTimepicker();
          loadPaymentTypesByDepartment(this.value);
        });

        // $('input[name="billing_to_another_address"]').click(function(){
        //     var inputValue = $(this).attr("value");
        //     $("." + inputValue).toggle();
        // });

        $("#shipping_address_1").blur(function(){
          var shipping_address_1 = $(this).val();
          var shipping_address_2 = $("#shipping_address_2").val();
          var shipping_urbanization = $("#shipping_urbanization").val();
          if(shipping_address_1.length > 0 && shipping_address_2.length > 0 && shipping_urbanization.length > 0){
            $("#billing_address_1").val(shipping_address_1 + " " + shipping_address_2);
            codeAddress(shipping_address_1 + " " + shipping_address_2 + " " + shipping_urbanization, $('#shipping_city').val().split('-')[0], $( "#shipping_state option:selected" ).text());
          }
        });

        $("#shipping_address_2").blur(function(){
          var shipping_address_1 = $("#shipping_address_1").val();
          var shipping_address_2 = $(this).val();
          var shipping_urbanization = $("#shipping_urbanization").val();
          if(shipping_address_1.length > 0 && shipping_address_2.length > 0 && shipping_urbanization.length > 0){
            $("#billing_address_1").val(shipping_address_1 + " " + shipping_address_2);
            codeAddress(shipping_address_1 + " " + shipping_address_2 + " " + shipping_urbanization, $('#shipping_city').val().split('-')[0], $( "#shipping_state option:selected" ).text());
          }
        });

        $("#shipping_urbanization").blur(function(){
          var shipping_address_1 = $("#shipping_address_1").val();
          var shipping_address_2 = $("#shipping_address_2").val();
          var shipping_urbanization = $(this).val();
          if(shipping_address_1.length > 0 && shipping_address_2.length > 0 && shipping_urbanization.length > 0){
            $("#billing_address_1").val(shipping_address_1 + " " + shipping_address_2);
            codeAddress(shipping_address_1 + " " + shipping_address_2 + " " + shipping_urbanization, $('#shipping_city').val().split('-')[0], $( "#shipping_state option:selected" ).text());
          }
        });

        $('#shipping_city').on('select2:select', function (e) {
          var shipping_address_1 = $("#shipping_address_1").val();
          var shipping_address_2 = $("#shipping_address_2").val();
          var shipping_urbanization = $("#shipping_urbanization").val();
          var data = e.params.data;

          $("#billing_city").val(document.getElementById('shipping_city').value);

          switch (true) {
            case data.id.includes("trujillo"):
              $("#shipping_state").val('LAL');
              $('#shipping_state').trigger('change');
              $("#billing_state").val('LAL');
              $('#billing_state').trigger('change');
              // changeMapCenter('LAL');
              break;
            case data.id.includes("piura"):
              $("#shipping_state").val('PIU');
              $('#shipping_state').trigger('change');
              $("#billing_state").val('PIU');
              $('#billing_state').trigger('change');
              // changeMapCenter('PIU');
              break;
            // case data.id.includes("chiclayo"):
            //   $("#shipping_state").val('LAM');
            //   $('#shipping_state').trigger('change');
            //   $("#billing_state").val('LAM');
            //   $('#billing_state').trigger('change');
            //   // changeMapCenter('LAM');
            //   break;
            default:
              break;
          }

          if(shipping_address_1.length > 0 && shipping_address_2.length > 0){
            $("#billing_address_1").val(shipping_address_1 + " " + shipping_address_2);
            codeAddress(shipping_address_1 + " " + shipping_address_2 + " " + shipping_urbanization, data.id.split('-')[0], $( "#shipping_state option:selected" ).text());
          }
        });

        function loadPaymentTypesByDepartment(department){
          if(department == 'LAM'){
            var newOptions = {"Seleccione una opción": "", "Efectivo": "efectivo"};
          } else {
            var newOptions = {"Seleccione una opción": "", "Efectivo": "efectivo", "Tarjeta": "tarjeta"};
          }

          var $el = $("#cod_payment");
          $el.empty(); // remove old options
          $.each(newOptions, function(key,value) {
            $el.append($("<option></option>")
              .attr("value", value).text(key));
          });
        }
        
        // fin de jquery

      });

      
      var placeSearch, autocomplete, map, infoWindow, myLatLng, geocoder;

      switch (document.getElementById('shipping_state').value) {
        case 'PIU':
          myLatLng = {lat: -5.201246, lng: -80.631406};
          break;
        case 'LAM':
          myLatLng = {lat: -6.766132, lng: -79.835484};
          break;
        case 'ANC':
          myLatLng = {lat: -9.122618, lng: -78.530505};
          break;
        default:
          myLatLng = {lat: -8.106090, lng: -79.023707};
          break;
      }

      var componentForm = {
        street_number: 'short_name',
        route: 'long_name',
        sublocality_level_1: 'long_name',
        locality: 'long_name',
        administrative_area_level_2: 'short_name',
        administrative_area_level_1: 'short_name',
        country: 'short_name',
        postal_code: 'short_name'
      };

      // Define the LatLng coordinates for the geofences
      const geofenceTrujilloCords = [
        {lat: -8.137832900, lng: -79.057415200},
        {lat: -8.140828000, lng: -79.052780500},
        {lat: -8.153339000, lng: -79.038232000},
        {lat: -8.152882300, lng: -79.035270800},
        {lat: -8.143589100, lng: -79.027116900},
        {lat: -8.136949200, lng: -79.026947000},
        {lat: -8.131413800, lng: -79.020854900},
        {lat: -8.130369000, lng: -79.012511500},
        {lat: -8.108523500, lng: -78.995911600},
        {lat: -8.105467200, lng: -78.999718000},
        {lat: -8.100031600, lng: -79.003867700},
        {lat: -8.094018600, lng: -78.998566500},
        {lat: -8.094229900, lng: -78.997900300},
        {lat: -8.093824100, lng: -78.996009800},
        {lat: -8.088636300, lng: -78.994246000},
        {lat: -8.085908300, lng: -79.002992000},
        {lat: -8.085000200, lng: -79.014150200},
        {lat: -8.088384200, lng: -79.024707800},
        {lat: -8.077629800, lng: -79.030845300},
        {lat: -8.081767800, lng: -79.038077300},
        {lat: -8.066952300, lng: -79.046175300},
        {lat: -8.069217700, lng: -79.051612700},
        {lat: -8.090022200, lng: -79.042059400},
        {lat: -8.090288800, lng: -79.047114300},
        {lat: -8.088017700, lng: -79.055529100},
        {lat: -8.091909400, lng: -79.056780400},
        {lat: -8.093765700, lng: -79.051300800},
        {lat: -8.095970000, lng: -79.051885800},
        {lat: -8.096767100, lng: -79.048614000},
        {lat: -8.100634400, lng: -79.049537600},
        {lat: -8.101460500, lng: -79.045435400},
        {lat: -8.105898000, lng: -79.048135300},
        {lat: -8.114305400, lng: -79.050724200},
        {lat: -8.115188000, lng: -79.048262900},
        {lat: -8.117484200, lng: -79.048833500},
        {lat: -8.119208900, lng: -79.046799000},
        {lat: -8.121094200, lng: -79.048445900},
        {lat: -8.124046900, lng: -79.045119800},
        {lat: -8.137832900, lng: -79.057415200}
      ];

      const geofencePiuraCords = [
        {lat: -5.176223100, lng: -80.692457100},
        {lat: -5.178104400, lng: -80.687994400},
        {lat: -5.183062500, lng: -80.690140300},
        {lat: -5.185199700, lng: -80.686149200},
        {lat: -5.192508200, lng: -80.686986000},
        {lat: -5.197530100, lng: -80.679507800},
        {lat: -5.202978000, lng: -80.670141100},
        {lat: -5.196610100, lng: -80.666278800},
        {lat: -5.202572100, lng: -80.660227800},
        {lat: -5.218844600, lng: -80.667931100},
        {lat: -5.226765000, lng: -80.656865500},
        {lat: -5.237127900, lng: -80.641779400},
        {lat: -5.230973300, lng: -80.633538300},
        {lat: -5.233964200, lng: -80.629932100},
        {lat: -5.228642700, lng: -80.625789400},
        {lat: -5.227338400, lng: -80.623835400},
        {lat: -5.229689000, lng: -80.621239000},
        {lat: -5.230736000, lng: -80.617537500},
        {lat: -5.226259300, lng: -80.611051900},
        {lat: -5.225003900, lng: -80.611800200},
        {lat: -5.222765600, lng: -80.616539700},
        {lat: -5.220372000, lng: -80.615466300},
        {lat: -5.216952800, lng: -80.620294000},
        {lat: -5.198404500, lng: -80.615712700},
        {lat: -5.198019900, lng: -80.618228800},
        {lat: -5.194611600, lng: -80.617463000},
        {lat: -5.194745200, lng: -80.615063100},
        {lat: -5.193444300, lng: -80.610902000},
        {lat: -5.196075400, lng: -80.609487500},
        {lat: -5.196513400, lng: -80.606104000},
        {lat: -5.200365200, lng: -80.605270600},
        {lat: -5.202462100, lng: -80.598759900},
        {lat: -5.198039900, lng: -80.588380600},
        {lat: -5.175795700, lng: -80.593494200},
        {lat: -5.178360000, lng: -80.602806900},
        {lat: -5.174171500, lng: -80.606197200},
        {lat: -5.172675700, lng: -80.610124100},
        {lat: -5.169812100, lng: -80.620917300},
        {lat: -5.162802600, lng: -80.617548200},
        {lat: -5.154767000, lng: -80.615638500},
        {lat: -5.150490400, lng: -80.618435400},
        {lat: -5.149462100, lng: -80.627841300},
        {lat: -5.153414700, lng: -80.634411100},
        {lat: -5.146595900, lng: -80.660721800},
        {lat: -5.149200700, lng: -80.662016700},
        {lat: -5.152615100, lng: -80.661344800},
        {lat: -5.152952100, lng: -80.671916700},
        {lat: -5.159428800, lng: -80.672490600},
        {lat: -5.158533900, lng: -80.675355100},
        {lat: -5.165976200, lng: -80.677822700},
        {lat: -5.167867600, lng: -80.673574000},
        {lat: -5.174385700, lng: -80.675462300},
        {lat: -5.169812300, lng: -80.689195200},
        {lat: -5.176223100, lng: -80.692457100}
      ];

      function initMaps() {
        // Create the autocomplete object, restricting the search predictions to
        // geographical location types.
        // autocomplete = new google.maps.places.Autocomplete(
        //     document.getElementById('shipping_search_address_gmaps'), {types: ['geocode'], componentRestrictions: {country: 'pe'}});

        // Avoid paying for data that you don't need by restricting the set of
        // place fields that are returned to just the address components.
        // autocomplete.setFields(['address_component']);
        // autocomplete.setFields();

        // When the user selects an address from the drop-down, populate the
        // address fields in the form.
        // autocomplete.addListener('place_changed', fillInAddress);
        
        map = new google.maps.Map(document.getElementById('map'), {center: myLatLng, zoom: 16, mapTypeControl: false, streetViewControl: false, fullscreenControl: false, zoomControl: false});
        marker = new google.maps.Marker({map: map, position: myLatLng, draggable: true});
        marker.addListener('dragend', get_address_by_dragend);
        infoWindow = new google.maps.InfoWindow;
        geocoder = new google.maps.Geocoder;
        
        if(document.getElementById('shipping_lat_gmaps').value.length > 0 &&
          document.getElementById('shipping_lng_gmaps').value.length > 0 &&
          document.getElementById('shipping_formated_address_gmaps').value.length > 0){
            // document.getElementById('shipping_search_address_gmaps').value = document.getElementById('shipping_formated_address_gmaps').value;
            var pos = {lat: Number(document.getElementById('shipping_lat_gmaps').value), lng: Number(document.getElementById('shipping_lng_gmaps').value)};
            marker.setPosition(pos);
            map.setCenter(pos);
        } else {
          // Try HTML5 geolocation.
          if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition(function(position) {
              var pos = {
                lat: position.coords.latitude,
                lng: position.coords.longitude
              };
              marker.setPosition(pos);
              map.setCenter(pos);

              fill_address_by_location(pos, 'init');

            }, function() {
              handleLocationError(true, infoWindow, map.getCenter());
            });
          } else {
            // Browser doesn't support Geolocation
            handleLocationError(false, infoWindow, map.getCenter());
          }
        }

        var legend = document.getElementById('legend');
        map.controls[google.maps.ControlPosition.RIGHT_BOTTOM].push(legend);
        
        // Construct the geofences
        const geofenceTrujillo = new google.maps.Polygon({
          paths: geofenceTrujilloCords,
          strokeColor: "#00ff00",
          strokeOpacity: 1,
          strokeWeight: 1,
          fillColor: "#00ff00",
          fillOpacity: 0.05
        });

        const geofencePiura = new google.maps.Polygon({
          paths: geofencePiuraCords,
          strokeColor: "#00ff00",
          strokeOpacity: 1,
          strokeWeight: 1,
          fillColor: "#00ff00",
          fillOpacity: 0.05
        });

        geofenceTrujillo.setMap(map);
        geofencePiura.setMap(map);
        validate_coordinates_geofence(new google.maps.LatLng(pos.lat, pos.lng));

      }

      function fillInAddress() {
        // Get the place details from the autocomplete object.
        var place = autocomplete.getPlace();

        assign_addres_details(place);
        
        var pos = {lat: place.geometry.location.lat(), lng: place.geometry.location.lng()};
        marker.setPosition(pos);
        map.setCenter(pos);
      }

      function get_address_by_dragend(event) {
        validate_coordinates_geofence(event.latLng);
        var pos = {lat: event.latLng.lat(), lng: event.latLng.lng()};
        //reset_addres_details();
        fill_address_by_location(pos, 'dragend');
      }

      function fill_address_by_location(pos, action){
        geocoder.geocode({'location': pos}, function(results, status) {
          if (status === 'OK') {
            if (results[0]) {
              assign_addres_details(results[0], action);
            } else {
              window.alert('No se encontraron resutados');
            }
          } else {
            window.alert('Geocoder falló debido a: ' + status);
          }
        });
      }

      function assign_addres_details(place, action){
        // Get each component of the address from the place details,
        // and then fill-in the corresponding field on the form.
        for (var i = 0; i < place.address_components.length; i++) {
          var addressType = place.address_components[i].types[0];
          if (componentForm[addressType]) {
            var val = place.address_components[i][componentForm[addressType]];
            document.getElementById('shipping_' + addressType + '_gmaps').value = val;
            document.getElementById('shipping_' + addressType + '_gmaps').dispatchEvent(new Event('change'));
          }
        }
        document.getElementById('shipping_lat_gmaps').value = place.geometry.location.lat();
        document.getElementById('shipping_lng_gmaps').value = place.geometry.location.lng();
        document.getElementById('shipping_formated_address_gmaps').value = place.formatted_address;
        // document.getElementById('billing_address_1').value = place.formatted_address;
        // document.getElementById('billing_city').value = document.getElementById('shipping_administrative_area_level_2_gmaps').value;
        // if(action == 'dragend'){
        //   document.getElementById('shipping_search_address_gmaps').value = place.formatted_address;
        // }
      }

      function reset_addres_details(){
        document.getElementById('shipping_formated_address_gmaps').value = '';
        document.getElementById('shipping_street_number_gmaps').value = '';
        document.getElementById('shipping_route_gmaps').value = '';
        document.getElementById('shipping_sublocality_level_1_gmaps').value = '';
        document.getElementById('shipping_locality_gmaps').value = '';
        document.getElementById('shipping_administrative_area_level_2_gmaps').value = '';
        document.getElementById('shipping_administrative_area_level_1_gmaps').value = '';
        document.getElementById('shipping_country_gmaps').value = '';
        document.getElementById('shipping_postal_code_gmaps').value = '';
        document.getElementById('shipping_lat_gmaps').value = '';
        document.getElementById('shipping_lng_gmaps').value = '';
      }

      function handleLocationError(browserHasGeolocation, infoWindow, pos) {
        infoWindow.setPosition(pos);
        infoWindow.setContent(browserHasGeolocation ?
                              'Error: Por favor permitir el acceso a la ubicación.' :
                              'Error: El navegador no soporta la geolocalización.');
        infoWindow.open(map);
      }

      function changeMapCenter(department){
        switch (department) {
          case 'PIU':
            myLatLng = {lat: -5.201246, lng: -80.631406};
            break;
          case 'LAM':
            myLatLng = {lat: -6.766132, lng: -79.835484};
            break;
          case 'ANC':
            myLatLng = {lat: -9.122618, lng: -78.530505};
            break;
          default:
            myLatLng = {lat: -8.106090, lng: -79.023707};
            break;
        }
        marker.setPosition(myLatLng);
        map.setCenter(myLatLng);
      }

      function codeAddress(address, city, department) {
        var has_street_number = false;
        geocoder.geocode( { address: address + ',' + city + ',' + department, componentRestrictions: {
          // administrativeArea: department,
          // country: 'PE'
        }}, function(results, status) {
          
          for (var i = 0; i < results[0].address_components.length; i++) {
            var addressType = results[0].address_components[i].types[0];
            if (addressType == 'street_number') {
              has_street_number = true;
            }
          }
          if (status == 'OK' && has_street_number) {
            marker.setPosition(results[0].geometry.location);
            map.setCenter(results[0].geometry.location);
            assign_addres_details(results[0], 'search');
          } else if(status == 'ZERO_RESULTS' || !has_street_number) {
            switch (department) {
              case 'Piura':
                myLatLng = {lat: -5.201246, lng: -80.631406};
                break;
              case 'Lambayeque':
                myLatLng = {lat: -6.766132, lng: -79.835484};
                break;
              case 'Ancash':
                myLatLng = {lat: -9.122618, lng: -78.530505};
                break;
              default:
                myLatLng = {lat: -8.106090, lng: -79.023707};
                break;
            }
            marker.setPosition(myLatLng);
            map.setCenter(myLatLng);
            reset_addres_details();
          } else {
            alert('Geocode no se pudo ejecutar: ' + status);
          }
        });
      }

      function validate_coordinates_geofence(lat_lng) {
        // Construct the polygon.
        const geofenceT = new google.maps.Polygon({paths: geofenceTrujilloCords});
        const geofenceP = new google.maps.Polygon({paths: geofencePiuraCords});

        if(google.maps.geometry.poly.containsLocation(lat_lng, geofenceT) || google.maps.geometry.poly.containsLocation(lat_lng, geofenceP)){
          document.getElementById('valid_map_location').value = 1;
        } else {
          document.getElementById('valid_map_location').value = 0;
          alert("El lugar de entrega se encuentra fuera de nuestra zona de cobertura, por favor corregir");
        }
      }

    </script>
    
    <p class="form-row form-row-wide form-row-last" style="float: none; display: inline-block;">
    <?php _e("Hora de Entrega", "add_extra_fields"); ?>

    <input type="text" name="add_delivery_hour" class="add_delivery_hour" placeholder="Hora de Entrega"></p></div>
    <script>
      jQuery(document).ready(function($) {
        var today = new Date();
        var time = today.getHours() + ":" + today.getMinutes() ;
        $('.add_delivery_date').keypress(function(e) {
          e.preventDefault();
        });
        $('.add_delivery_hour').on('keypress',function(e){
          e.preventDefault();
        });
        /* $(".add_delivery_hour").timeselector({
        min:'',//+time+'',
        max:'18:30'
        })
        });*/

        $(".add_delivery_date").on('keydown',function(e){
          var code = (e.keyCode ? e.keyCode : e.which);
          switch (code) {
            case 13: // return
            case 9:
              return;
            default:
              e.preventDefault();
          }
        });
      });
    </script>

    <h3 id="pickup-another-person">
      <label class="woocommerce-form__label" style="display: inline !important; cursor: text !important">
        <span><?php esc_html_e( 'Persona que recoje o recibe el producto', 'woocommerce' ); ?></span>
      </label>
    </h3>

    <?php
    echo "<div class='dni-container'>";

    woocommerce_form_field('custom_question_text_dnirecojo', array(
      'type'            => 'text',
      'label'           => 'DNI',
      'required'        => false,
      'class'           => array('custom-question-dnirecojo-field', 'form-row-wide'),
    ), $checkout->get_value('custom_question_text_dnirecojo'));

    woocommerce_form_field('custom_question_text_precojo', array(
      'type'              => 'text',
      'label'             => 'Nombres y Apellidos',
      'required'          => false,
      'custom_attributes' => array('readonly' => 'readonly'),
      'class'             => array('custom-question-precojo-field', 'form-row-wide'),
    ), $checkout->get_value('custom_question_text_precojo'));
    echo "<div id='dni-overlay' style='display: none;'>
            <div class='lds-ellipsis'><div></div><div></div><div></div><div></div></div>
          </div>
    </div>";

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
    wp_register_style('jquery-ui', '//code.jquery.com/ui/1.11.2/themes/smoothness/jquery-ui.css');
    wp_enqueue_style('jquery-ui');

    
    wp_enqueue_script('jquery');
    // wp_register_script('jquery-ui-timeselector', get_template_directory_uri() . '/js/jquery.timeselector.js');
    wp_register_script('jquery-ui-timeselector', get_template_directory_uri() . '/js/jquery.timepicker.js');
    wp_enqueue_script('jquery-ui-timeselector');
    wp_enqueue_script('jquery-ui-timeselector');

    wp_register_style('jquery-ui-timeselector', get_template_directory_uri() . '/css/jquery.timepicker.css');
    wp_enqueue_style('jquery-ui-timeselector'); 
  }
}

add_action('wp_enqueue_scripts', 'enqueue_datepicker');
 
function bbloomer_disable_woocommerce_cart_fragments() { 
  wp_enqueue_script('wc-cart-fragments'); 
}

add_action('wp_enqueue_scripts', 'bbloomer_disable_woocommerce_cart_fragments', 100);

/**
  * Eliminar acciones
  */

remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_price', 10);

remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_excerpt', 20);

/**
  * Añadir acciones
  */

add_action('woocommerce_single_product_summary', 'woocommerce_template_single_excerpt', 6);

add_action('woocommerce_single_product_summary', 'woocommerce_template_single_price', 20);

/**
  * Aministrar loop price
  */

function tu_move_wc_price() {
  remove_action('woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_price', 10);
  add_action('woocommerce_after_shop_loop_item', 'woocommerce_template_loop_price', 60);
}

add_action('after_setup_theme', 'tu_move_wc_price');

// To change add to cart text on single product page
add_filter( 'woocommerce_product_single_add_to_cart_text', 'woocommerce_custom_single_add_to_cart_text' ); 
function woocommerce_custom_single_add_to_cart_text() {
    return __( 'AGREGAR', 'woocommerce' ); 
}

// To change add to cart text on product archives(Collection) page
add_filter( 'woocommerce_product_add_to_cart_text', 'woocommerce_custom_product_add_to_cart_text' );  
function woocommerce_custom_product_add_to_cart_text() {
    return __( 'AGREGAR', 'woocommerce' );
}


/**
  * Escribir HTML de botón para añadir al carrito en producto
  */

function quantity_inputs_for_woocommerce_loop_add_to_cart_link($html, $product) {
  if ($product && $product->is_type('simple') && $product->is_purchasable() && $product->is_in_stock() && ! $product->is_sold_individually()) {
    $html = '<form class="cart" method="post" enctype="multipart/form-data">';
    $html .= woocommerce_quantity_input(array(), $product, false);
    $html .= '<button type="submit" class="button alt" name="add-to-cart" value="' . $product->get_id() . '">' . esc_html($product->add_to_cart_text()) . '</button>';
    $html .= '</form>';
  }
  return $html;
}

add_filter('woocommerce_loop_add_to_cart_link', 'quantity_inputs_for_woocommerce_loop_add_to_cart_link', 10, 2);

/**
  * Consultar la API Distance Matix de Google
  * Return json
  */

function sendDataToDistanceMatrixAPI($origin, $destination, $apiKey) {
  $header = array();
  $header[] = 'Content-length: 0';
  $header[] = 'Content-type: application/json';

  $service_url = 'https://maps.googleapis.com/maps/api/distancematrix/json?mode=walking&units=metric&origins=' . $origin . '&destinations=' . $destination . '&key=' . $apiKey;

  $response = wp_remote_get($service_url);
  $body = wp_remote_retrieve_body( $response );
  $bodyDecoded = json_decode($body, true);

  return $bodyDecoded;
}

/**
  * Consultar la API Geocode de Google
  * Return json
  */

function sendDataToGeocodeAPI($address, $department, $apiKey) {
  $header = array();
  $header[] = 'Content-length: 0';
  $header[] = 'Content-type: application/json';

  $service_url = 'https://maps.googleapis.com/maps/api/geocode/json?address=' . $address . '&components=country:PE|administrative_area_level_1:' . $department . '&key=' . $apiKey;

  $response = wp_remote_get($service_url);
  $body = wp_remote_retrieve_body( $response );
  $bodyDecoded = json_decode($body, true);
  $tempResponse = $bodyDecoded['results'][0]['address_components'];
  $response = $tempResponse[count($tempResponse) - 1]['long_name'];

  return $response;
}

/**
  * Cambiar precio de envío según monto, distancia y peso
  */

function custom_package_rates($rates) {
  global $woocommerce;
  $total = WC()->cart->cart_contents_total;
  $total_weight = floatval(WC()->cart->cart_contents_weight);

  $apiKeyDistanceMatrix = esc_attr( get_option('google_distance_matrix_api_key') );
  $apiKeyGeocode = esc_attr( get_option('google_geocode_api_key') );
  $originCity = esc_attr(get_option('woocommerce_store_city'));
  $originAddress = esc_attr(get_option('woocommerce_store_address'));
  $originPostcode = esc_attr(get_option('woocommerce_store_postcode'));  
  $destinationCity = WC()->customer->get_shipping_city();
  $destinationAddress = WC()->customer->get_shipping_address();
  $destinationState = WC()->customer->get_shipping_state();

  // $address = urlencode((isset($_POST['s_address']) ? $_POST['s_address'] : $destinationAddress) . ' ' . $destinationCity);

  // $postCode = sendDataToGeocodeAPI($address, $destinationState, $apiKeyGeocode);
  // WC()->customer->set_shipping_postcode($postCode);

  // $origin = urlencode($originAddress . ',' . $originPostcode . ' ' .$originCity);
  // $destination = urlencode($destinationAddress . ',' . $postCode . ' ' . $destinationCity);

  // $response = sendDataToDistanceMatrixAPI($origin, $destination, $apiKeyDistanceMatrix); 

  // if(isset($response['rows'][0]) && $response['rows'][0]['elements'][0]['status'] !== 'NOT_FOUND') {
  //   $distance = $response['rows'][0]['elements'][0]['distance']['value'];
  // }

  // if($total_weight < 8){
  //   unset($rates['flat_rate:2']);
  // }

  // if (isset($rates['flat_rate:2'])) {
  //   if($total >= 50){
  //     $rates['flat_rate:2']->cost = 0;
  //   } else {
  //     if($total_weight <= 10){
  //       if($distance <= 500)
  //         $rates['flat_rate:2']->cost = 0;
  //       else if ($distance <= 1000)
  //         $rates['flat_rate:2']->cost = 5;
  //       else
  //         $rates['flat_rate:2']->cost = 10;
  //     } else {
  //       if($distance <= 500)
  //         $rates['flat_rate:2']->cost = 5;
  //       else if ($distance <= 1000)
  //         $rates['flat_rate:2']->cost = 10;
  //       else
  //         $rates['flat_rate:2']->cost = 15;
  //     }
  //     switch ($destinationCity) {
  //       case 'trujillo-trujillo':
  //       case 'piura-piura':
  //         $rates['flat_rate:2']->cost = 0;
  //         break;
    
  //       case 'piura-26-octubre':
  //       case 'piura-castilla':
  //         $rates['flat_rate:2']->cost = 0;
  //         break;
    
  //       case 'trujillo-larco':
  //       case 'trujillo-esperanza':
  //         $rates['flat_rate:2']->cost = 0;
  //         break;
    
  //       case 'trujillo-buenos-aires':
  //       case 'trujillo-moche':
  //         $rates['flat_rate:2']->cost = 0;
  //         break;
    
  //       case 'trujillo-porvenir':
  //         $rates['flat_rate:2']->cost = 0;
  //         break;
  
  //       case 'trujillo-huanchaco':
  //         $rates['flat_rate:2']->cost = 0;
  //         break;

  //       default:
  //         $rates['flat_rate:2']->cost = 0;
  //         break;
  //     }
  //   }
  // }
  
  $user = wp_get_current_user();
  $roles = ( array ) $user->roles;

  if(in_array($roles[0], array('picador-noria', 'picador-porvenir'))){
    unset($rates['flat_rate:2']);
  } else {
    unset($rates['local_pickup:3']);
  }

  return $rates;
}

add_filter('woocommerce_package_rates', 'custom_package_rates', 10, 2);

/**
  * Deshabilitar pago contra entrega si hay pavos en el carrito
  */
  
// function wpp_payment_gateway_disable_contraentrega($available_gateways) {
//     if (is_admin()) return $available_gateways;
//     // Set $cat_check true if a cart item is in pavos cat
//     $cart_has_pavos = false;
//     foreach (WC()->cart->get_cart() as $cart_item_key => $cart_item) {
//       $product = $cart_item['data'];
//       if (has_term('pavos', 'product_cat', $product->id)) {
//           $cart_has_pavos = true;
//           // break because we only need one "true" to matter here
//           break;
//       }
//     }
//     if($cart_has_pavos) {
//       unset($available_gateways['cod']);
//     } 
    
//     return $available_gateways;
// }

// add_filter('woocommerce_available_payment_gateways', 'wpp_payment_gateway_disable_contraentrega');

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

  $city_args = wp_parse_args( array(
		'type' => 'select',
		'options' => array(
			'trujillo-trujillo' => 'Trujillo - Trujillo',
			'trujillo-larco' => 'Trujillo - Victor Larco',
			//'trujillo-buenos-aires' => 'Trujillo - Buenos Aires',
			'trujillo-esperanza' => 'Trujillo - La Esperanza',
			//'trujillo-moche' => 'Trujillo - Moche',
			//'trujillo-huanchaco' => 'Trujillo - Huanchaco',
			//'trujillo-porvenir' => 'Trujillo - El Porvenir',
			'piura-26-octubre' => 'Piura - 26 de Octubre',
			'piura-piura' => 'Piura - Piura',
      'piura-castilla'  => 'Piura - Castilla',
      // 'chiclayo-chiclayo'  => 'Chiclayo - Chiclayo',
      // 'chiclayo-leonardo-ortiz'  => 'Chiclayo - José Leonardo Ortiz',
      // 'chiclayo-la-victoria'  => 'Chiclayo - La Victoria'
		),
		'input_class' => array(
			'wc-enhanced-select',
		)
	), array() );

	$fields['shipping']['shipping_city'] = $city_args;
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

	wc_enqueue_js( "
	jQuery( ':input.wc-enhanced-select' ).filter( ':not(.enhanced)' ).each( function() {
		var select2_args = { minimumResultsForSearch: 5 };
		jQuery( this ).select2( select2_args ).addClass( 'enhanced' );
	});" );

  return $fields;
}

add_filter('woocommerce_checkout_fields' , 'customize_checkout_fields');

/**
 * Quitar hook de terminos y condiciones
 */

function my_project_wc_change_hooks() {
  remove_action('woocommerce_checkout_terms_and_conditions', 'wc_terms_and_conditions_page_content', 30);
}

add_action('wp', 'my_project_wc_change_hooks');

/**
 * Añadir producto al carrito de compras
 */

function recalculate_bags_on_cart() {
  if(!is_admin()) {
    global $woocommerce;
    $product_id = 166; //replace with your product id
    $found = false;
    $cart_total = 4.5; //replace with your cart total needed to add above item
    $cart_has_pavos = false;
    $in_cart = false;
    $user = wp_get_current_user();
    $roles = ( array ) $user->roles;

    // Set $cat_check true if a cart item is in pavos or panetones cat
    /*foreach (WC()->cart->get_cart() as $cart_item_key => $cart_item) {
        $product = $cart_item['data'];

        if (has_term('pavos', 'product_cat', $product->id) || has_term('panetones', 'product_cat', $product->id)) {
            $cart_has_pavos = true;
            // break because we only need one "true" to matter here
            break;
        }
    }*/

    if(WC()->cart->cart_contents_weight > 0 && !in_array($roles[0], array("xpress-market", "xpress-comercio", "xpress-polleria", "cliente-polleria"))) {
      if(WC()->cart->cart_contents_weight >= $cart_total) {
        $conte2 = floatval(WC()->cart->cart_contents_weight / $cart_total);
        $conte = ceil($conte2);

        //check if product already in cart
        if(sizeof($woocommerce->cart->get_cart()) > 0) {
          foreach($woocommerce->cart->get_cart() as $cart_item_key => $values) {
            $_product = $values['data'];
            if($_product->get_id() == $product_id){
              $found = true;
             // $woocommerce->cart->add_to_cart($product_id);
              $woocommerce->cart->set_quantity($cart_item_key, $conte);
            }
          }

          // if product not found, add it
          if (!$found)
            $woocommerce->cart->add_to_cart($product_id, $conte);
        }
      }

      if(WC()->cart->cart_contents_weight < $cart_total && sizeof($woocommerce->cart->get_cart()) > 0){
        $contab = 0;
        foreach($woocommerce->cart->get_cart() as $cart_item_key => $values) {
          $_product = $values['data'];
          if ($_product->get_id() == $product_id){
            $found = true;
            $contab = 1;
            $woocommerce->cart->set_quantity($cart_item_key, 1);
          }
        }

        if($contab != 1) {
          $woocommerce->cart->add_to_cart($product_id);
        }
      }

      foreach($woocommerce->cart->get_cart() as $cart_item_key => $cart_item) {
        if($cart_item['product_id'] === $product_id) {
          $in_cart = true;
          $key = $cart_item_key;
          break;
        }
      }

      if(WC()->cart->get_cart_contents_count() < 2) {
        if($in_cart)
          WC()->cart->remove_cart_item($key);
      }
    } else {
      //agregar aqui cuando es peso 0 kg - quitar bolsa
      foreach($woocommerce->cart->get_cart() as $cart_item_key => $values) {
        $_product = $values['data'];
        if($_product->get_id() == $product_id){
          WC()->cart->remove_cart_item($cart_item_key);
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
  $in_cart = false;
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
    } else {
      if(WC()->cart->get_cart_contents_count() < 2) {
        WC()->cart->remove_cart_item($bag_item_key);
      }
    }
  } else {
    WC()->cart->remove_cart_item($bag_item_key);
  }
}

add_action('woocommerce_add_to_cart', 'add_bags_to_cart');

/**
  * Eliminar bolsa cuando en el carrito quedan productos de menos de un kg
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

  if(WC()->cart->cart_contents_weight < 1){
    if($in_cart)
      WC()->cart->remove_cart_item($key);
  }
}

add_action( 'woocommerce_cart_updated', 'remove_from_cart');

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
  * Validar formulario de gravityforms
  */

function change_message($message, $form) {
  return "<div class='validation_error'>" . esc_html__('Hubo un problema con el registro.', 'gravityforms') . ' ' . esc_html__('Los errores estan marcados abajo.', 'gravityforms') . '</div>';
}

add_filter('gform_validation_message', 'change_message', 10, 2);

/**
  * Prevenir la mezcla de productos de categoria pavos con otras
  */

// function dont_add_pavos_to_cart_containing_other($validation, $product_id) {
//   // Set flag false until we find a product in cat pavos
//   $cart_has_pavos = false;

//   // Set $cat_check true if a cart item is in pavos cat
//   foreach (WC()->cart->get_cart() as $cart_item_key => $cart_item) {
//     $product = $cart_item['data'];

//     if (has_term('pavos', 'product_cat', $product->id)) {
//       $cart_has_pavos = true;
//       // break because we only need one "true" to matter here
//       break;
//     }
//   }

//   $product_is_pavos = false;

//   if (has_term('pavos', 'product_cat', $product_id)) {
//     $product_is_pavos = true;
//   }

//   if (has_term('bolsas', 'product_cat', $product_id)) {
//     $bolsas = true;
//     $product_is_pavos = true;
//   }

//   // Return true if cart empty
//   if(!WC()->cart->get_cart_contents_count() == 0) {
//     // If cart contains pavos and product to be added is not pavos, display error message and return false.
//     if($cart_has_pavos && !$product_is_pavos) {
//       wc_add_notice('Lo sentimos , no se pueden mezclar productos de la categoría pavos con otras categorías .Primero finaliza la compra actual de tu carrito o vacia tu carrito e intenta de nuevo', 'error');
//       $validation = false;
//     }
//     // If cart contains a product that is not pavos and product to be added is pavos, display error message and return false.
//     elseif (!$cart_has_pavos && $product_is_pavos) {
//       wc_add_notice('Lo sentimos , no se pueden mezclar productos de la categoría pavos con otras categorías .Primero finaliza la compra actual de tu carrito o vacia tu carrito e intenta de nuevo', 'error', 'error');
//       $validation = false;
//     } elseif($cart_has_pavos && $bolsas) {
//       $validation = true;
//     } elseif($product_is_pavos && $bolsas) {
//       $validation = true;
//     }
//   }
//   // Otherwise, return true.
//   return $validation;
// }

//add_filter('woocommerce_add_to_cart_validation', 'dont_add_pavos_to_cart_containing_other', 10, 2);

/**
 * Ocultar categoría por defecto (bolsas) de los listados del widget y del listado de productos
 */

function custom_woocommerce_product_subcategories_args($args) {
  $args['exclude'] = get_option('default_product_cat');
  return $args;
}

add_filter('woocommerce_product_subcategories_args', 'custom_woocommerce_product_subcategories_args');

add_filter('woocommerce_product_categories_widget_args', 'custom_woocommerce_product_subcategories_args');

/**
 * Validar campo unidades al agregar al carrito
 */

// function quantity_units_add_to_cart_validation($passed, $product_id, $quantity, $variation_id=null) {
//   if(isset($_POST['quantity-unit']) && (empty($_POST['quantity-unit']) || !is_numeric($_POST['quantity-unit']))) {
//     $passed = false;
//     wc_add_notice('Por favor, ingrese una cantidad correcta.', 'error');
//   }
//   return $passed;
// }

// add_filter('woocommerce_add_to_cart_validation', 'quantity_units_add_to_cart_validation', 10, 4);

/**
 * Añadir campo de unidades al carrito
 */

// function quantity_units_add_cart_item_data($cart_item_data, $product_id, $variation_id) {
//   $product = wc_get_product( $product_id );
//   $args = apply_filters('woocommerce_quantity_input_args', array(), $product);

//   if(isset($_POST['quantity-unit']) && $args['step'] != 1) {
//     $cart_item_data['quantity-unit'] = sanitize_text_field($_POST['quantity-unit']);
//   }
//   return $cart_item_data;
// }

// add_filter('woocommerce_add_cart_item_data', 'quantity_units_add_cart_item_data', 10, 3);

/**
 * Mostrar el campo de unidades en el carrito
 */

// function quantity_units_get_item_data($item_data, $cart_item) {
//   if(isset($cart_item['quantity-unit'])) {
//     $item_data[] = array(
//       'key' => __('Unidades', 'sanzo'),
//       'value' => wc_clean($cart_item['quantity-unit']),
//       'display' => ''
//     );
//   }
//   return $item_data;
// }

// add_filter('woocommerce_get_item_data', 'quantity_units_get_item_data', 10, 2);

/**
 * Añadir campo de unidades al terminar la compra
 */

// function quantity_units_checkout_create_order_line_item($item, $cart_item_key, $values, $order) {
//   if(isset($values['quantity-unit'])) {
//     $item->add_meta_data(__('Unidades', 'sanzo'), $values['quantity-unit']);
//   }
// }

// add_action('woocommerce_checkout_create_order_line_item', 'quantity_units_checkout_create_order_line_item', 10, 4);

/**
 * Añadir campos de shipping al terminar la compra
 */

// function change_billing_info($order, $data){
//   if($_POST['custom_question_field'] != 'rbuton_factura'){
//     $order->set_billing_ccustom_question_fieldompany('');
//   }
// }

// add_action( 'woocommerce_checkout_create_order', 'change_billing_info', 10, 2 );

/**
 * Añadir campo unidades a los correos
 */

// function quantity_units_order_item_name($product_name, $item) {
//   if(isset($item['quantity-unit'])) {
//     $product_name .= sprintf('%s: %s', __('Unidades', 'sanzo'), esc_html($item['quantity-unit']));
//   }

//   return $product_name;
// }

// add_filter('woocommerce_order_item_name', 'quantity_units_order_item_name', 10, 2);

/**
 * Actualizar campo unidades al editar el carrito
 */

// function on_action_cart_updated( $cart_updated ){
//   global $woocommerce;
//   $cart = $woocommerce->cart->cart_contents;

//   foreach ($cart as $key => $item) {
//     $product = $item['data'];
//     $args = apply_filters('woocommerce_quantity_input_args', array(), $product);
//     $new_quantity = round($item['quantity'] / floatval($args['step']));
//     if($args['step'] != 1){
//       $woocommerce->cart->cart_contents[$key]['quantity-unit'] = $new_quantity;
//       $woocommerce->cart->set_session();
//     }
//   }
// }

// add_action('woocommerce_update_cart_action_cart_updated', 'on_action_cart_updated', 20, 1 );

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
    update_user_meta($user_id, 'shipping_formated_address_gmaps', esc_attr($_POST['shipping_formated_address_gmaps']));
    update_user_meta($user_id, 'shipping_street_number_gmaps', esc_attr($_POST['shipping_street_number_gmaps']));
    update_user_meta($user_id, 'shipping_route_gmaps', esc_attr($_POST['shipping_route_gmaps']));
    update_user_meta($user_id, 'shipping_sublocality_level_1_gmaps', esc_attr($_POST['shipping_sublocality_level_1_gmaps']));
    update_user_meta($user_id, 'shipping_locality_gmaps', esc_attr($_POST['shipping_locality_gmaps']));
    update_user_meta($user_id, 'shipping_administrative_area_level_2_gmaps', esc_attr($_POST['shipping_administrative_area_level_2_gmaps']));
    update_user_meta($user_id, 'shipping_administrative_area_level_1_gmaps', esc_attr($_POST['shipping_administrative_area_level_1_gmaps']));
    update_user_meta($user_id, 'shipping_country_gmaps', esc_attr($_POST['shipping_country_gmaps']));
    update_user_meta($user_id, 'shipping_postal_code_gmaps', esc_attr($_POST['shipping_postal_code_gmaps']));
    update_user_meta($user_id, 'shipping_lat_gmaps', esc_attr($_POST['shipping_lat_gmaps']));
    update_user_meta($user_id, 'shipping_lng_gmaps', esc_attr($_POST['shipping_lng_gmaps']));
    update_user_meta($user_id, 'shipping_reference', esc_attr($_POST['shipping_reference']));
    update_user_meta($user_id, 'shipping_urbanization', esc_attr($_POST['shipping_urbanization']));
}

add_action('woocommerce_checkout_update_user_meta', 'client_info_fields_update_user_meta');

add_filter('woocommerce_terms_is_checked_default', '__return_true');

/**
  * Reducir complejidad de contraseña de usuario 
  */

function reduce_woocommerce_min_strength_requirement( $strength ) {
  return 1;
}

add_filter( 'woocommerce_min_password_strength', 'reduce_woocommerce_min_strength_requirement' );

/**
  * Copiar metadata de productos en crear pedido basado en otro 
  */

// function transform_metadata_name($cart_item_meta, $product, $order){
//     $customfields = [
//         'Unidades',
//     ];
//     global $woocommerce;
//     remove_all_filters( 'woocommerce_add_to_cart_validation' );
//     if ( ! array_key_exists( 'item_meta', $cart_item_meta ) || ! is_array( $cart_item_meta['item_meta'] ) )
//         foreach ( $customfields as $key ){
//             if(!empty($product[$key])){
//               if($key == "Unidades"){
//                 $cart_item_meta["quantity-unit"] = $product[$key];
//               } else {
//                 $cart_item_meta[$key] = $product[$key];
//               }
//             }
//         }
//     return $cart_item_meta;
// }

// add_filter( 'woocommerce_order_again_cart_item_data', 'transform_metadata_name', 10, 3 );

/**
  * Traducir mensajes de pie de correo
  */
  
function email_footer_custom_translate( $translated ) {
   $translated = str_ireplace( 'Thanks for shopping with us.', 'Gracias por comprar con nosotros.', $translated );
   $translated = str_ireplace( 'We hope to see you again soon.', 'Esperamos verte pronto.', $translated );
   $translated = str_ireplace( 'Thanks for using', 'Gracias por usar', $translated );
   return $translated;
}

add_filter( 'gettext', 'email_footer_custom_translate', 999 );

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
  * Quitar requerido a campos teléfono y correo
  */

// function filter_billing_fields( $billing_fields ) {
//     if( ! is_checkout() ) return $billing_fields;

//     $billing_fields['billing_phone']['required'] = false;
//     $billing_fields['billing_email']['required'] = false;
//     return $billing_fields;
// }

// add_filter( 'woocommerce_billing_fields', 'filter_billing_fields', 20, 1 );

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
  * Añadir nuevas columnas a administración de pedidos
  */

function custom_shop_order_column($columns){
  $reordered_columns = array();

  // Inserting columns to a specific location
  foreach( $columns as $key => $column){
    $reordered_columns[$key] = $column;
    if( $key ==  'order_status' ){
      // Inserting after "Status" column
      $reordered_columns['add_delivery_date'] = '<span>'.__( 'Fecha Entrega','woocommerce').'</span>';
      $reordered_columns['delivery_address'] = '<span>'.__( 'Lugar Entrega','woocommerce').'</span>';
    }
  }
  return $reordered_columns;
}

add_filter( 'manage_edit-shop_order_columns', 'custom_shop_order_column', 12, 1 );

/**
  * Añadir data de columnas nuevas a administración de pedidos
  */

function custom_order_list_column_content( $column, $post_id ){
  $order = wc_get_order($post_id);

  // HERE get the data from your custom field (set the correct meta key below)
  $add_delivery_date = get_post_meta( $post_id, 'add_delivery_date', true );
  $billing_address_1 = get_post_meta( $post_id, '_billing_address_1', true );
  $billing_city = get_post_meta( $post_id, '_billing_city', true );
  $billing_state = (get_post_meta( $post_id, '_billing_state', true ) == "LAL") ? "TRUJILLO" : "PIURA";
  $shipping_address_1 = get_post_meta( $post_id, '_shipping_address_1', true );
  $shipping_city = get_post_meta( $post_id, '_shipping_city', true );
  if(empty($add_delivery_date)) $add_delivery_date = '';
  if(empty($shipping_address_1)) $shipping_address_1 = $billing_address_1;
  if(empty($shipping_city)) $shipping_city = $billing_city;

  switch ( $column ){
    case 'add_delivery_date' :
      echo '<span>'.$add_delivery_date.'</span>'; // display the data
      break;
    case 'delivery_address' :
      if($order->get_shipping_method() == 'Recojo en Tienda'){
        echo '<span>'. $order->get_shipping_method() . ' (<b>' . $billing_state . '</b>)</span>'; // display the data
      } else {
        echo '<span>'. $shipping_address_1 . ' (<b>' . $shipping_city . ')</b></span>'; // display the data
      }
      break;
  }
}

add_action( 'manage_shop_order_posts_custom_column' , 'custom_order_list_column_content', 10, 2 );

/**
  * Añadir columnas a buscador
  */

function platform_search_fields( $meta_keys ){
    $meta_keys[] = 'add_delivery_date';
    $meta_keys[] = 'add_delivery_date';
    return $meta_keys;
}

add_filter( 'woocommerce_shop_order_search_fields', 'platform_search_fields', 10, 1 );

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
    $urlAddToTempTablesPOS = "http://api.chimuagropecuaria.com.pe/POST/addOrderToTempTablesPOS.php";
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
  if(strpos($shipping_city, 'trujillo') !== false || strpos($shipping_city, 'piura') !== false){
    if ($_SERVER['SERVER_NAME'] == "localhost"){
      $urlAddGuide = "http://localhost/api/POST/addGuideBTAPI.php";
    } else {
      $urlAddGuide = "http://api.chimuagropecuaria.com.pe/POST/addGuideBTAPI.php";
    }

    $post = array(
      'environment'   => $_SERVER['SERVER_NAME'],
      'city'          => $shipping_city,
      'delivery_date' => $add_delivery_date,
      'order_id'      => $order_id
    );

    $curl = curl_init($urlAddGuide);
    curl_setopt($curl, CURLOPT_POST, 1);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($curl, CURLOPT_POSTFIELDS, http_build_query($post));
    $response = curl_exec($curl);
    curl_close($curl);
  }  
}

add_action('woocommerce_order_status_processing', 'custom_processing');

/**
 * Añadir nuevos estados
 */

function register_shipment_arrival_order_status() {
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

add_action( 'init', 'register_shipment_arrival_order_status' );

function add_awaiting_shipment_to_order_statuses( $order_statuses ) {
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

add_filter( 'wc_order_statuses', 'add_awaiting_shipment_to_order_statuses' );

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
    $urlAddToTempTablesPOS = "http://api.chimuagropecuaria.com.pe/PUT/updateOrderToTempTablesPOS.php";
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
  if(strpos($shipping_city, 'trujillo') !== false || strpos($shipping_city, 'piura') !== false){
    if ($_SERVER['SERVER_NAME'] == "localhost"){
      $urlAddGuide = "http://localhost/api/POST/addGuideBTAPI.php";
    } else {
      $urlAddGuide = "http://api.chimuagropecuaria.com.pe/POST/addGuideBTAPI.php";
    }

    $post = array(
      'environment'   => $_SERVER['SERVER_NAME'],
      'city'          => $shipping_city,
      'delivery_date' => $add_delivery_date,
      'order_id'      => $order_id
    );

    $curl = curl_init($urlAddGuide);
    curl_setopt($curl, CURLOPT_POST, 1);
    curl_setopt($curl, CURLOPT_POSTFIELDS, http_build_query($post));
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
    $response = curl_exec($curl);  
    curl_close($curl);
  }
}

add_filter('woocommerce_update_order', 'after_order_update');

/**
 * Añadir nuevo estado facturado a reportes
 */

// function woocommerce_reports_order_statuses_filter( $order_status ){
//   $order_status[] = 'invoiced';
//   return $order_status;
// }

// add_filter( 'woocommerce_reports_order_statuses', 'woocommerce_reports_order_statuses_filter' );

// add_action( 'add_meta_boxes', 'remove_shop_order_meta_boxe', 90 );
// function remove_shop_order_meta_boxe() {
//     remove_meta_box( 'postcustom', 'shop_order', 'normal' );
// }

/**
 * Añadir nuevo campo a pedido
 */

function checkout_order_processed_add_referral_answer( $order_id ) {
    if ( ! isset( $_POST['shipping_reference'] ) ) {
        return;
    }

    $order = wc_get_order( $order_id );

    $order->add_meta_data( 'shipping_reference', wc_clean( $_POST['shipping_reference'] ), true );
    $order->save();
}

add_action( 'woocommerce_checkout_order_processed', 'checkout_order_processed_add_referral_answer', 11, 2 );

/**
 * Eliminar un rol
 */

// function wps_remove_role() {
//   remove_role( 'agent-xpress' );
//   remove_role( 'cliente-polleria' );
// }

// add_action( 'init', 'wps_remove_role' );

/**
 * Añadir un rol
 */

add_role( 'xpress-market', 'Agente Xpress Market', get_role( 'customer' )->capabilities );
add_role( 'xpress-comercio', 'Agente Xpress Comercio', get_role( 'customer' )->capabilities );
add_role( 'xpress-polleria', 'Agente Xpress Pollería', get_role( 'customer' )->capabilities );
add_role( 'cliente-polleria', 'Cliente Pollería', get_role( 'customer' )->capabilities );

/**
 * Ocultar bolsas de la página principal
 */

function ts_get_subcategory_terms( $terms, $taxonomies, $args ) {
  $new_terms = array();
  // if it is a product category and on the shop page
  if ( in_array( 'product_cat', $taxonomies ) && !is_admin() && is_front_page() ) {
    foreach( $terms as $key => $term ) {
      if ( !in_array( $term->slug, array( 'bolsas' ) ) ) { //pass the slug name here
        $new_terms[] = $term;
      }
    }
    $terms = $new_terms;
  }
  return $terms;
}

add_filter( 'get_terms', 'ts_get_subcategory_terms', 10, 3 );

/**
 * Añadir al carrito - AJAX
 */

function product_page_ajax_add_to_cart_js() {
?>
  <script type="text/javascript" charset="UTF-8">
  jQuery(function($) {

    $('form.cart').on('submit', function(e) {
      e.preventDefault();

      var form = $(this);
      form.block({ message: null, overlayCSS: { background: '#fff', opacity: 0.6 } });

      var formData = new FormData(form.context);
      formData.append('add-to-cart', form.find('[name=add-to-cart]').val() );

      $.ajax({
        url: wc_add_to_cart_params.wc_ajax_url.toString().replace( '%%endpoint%%', 'ace_add_to_cart' ),
        data: formData,
        type: 'POST',
        processData: false,
        contentType: false,
        complete: function( response ) {
          response = response.responseJSON;

          if ( ! response ) {
            return;
          }

          if ( response.error && response.product_url ) {
            window.location = response.product_url;
            return;
          }

          // Redirect to cart option
          if ( wc_add_to_cart_params.cart_redirect_after_add === 'yes' ) {
            window.location = wc_add_to_cart_params.cart_url;
            return;
          }

          var $thisbutton = form.find('.single_add_to_cart_button'); //
          // var $thisbutton = null; // uncomment this if you don't want the 'View cart' button

          // Trigger event so themes can refresh other areas.
          $( document.body ).trigger( 'added_to_cart', [ response.fragments, response.cart_hash, $thisbutton ] );

          // Remove existing notices
          //$( '.woocommerce-error, .woocommerce-message, .woocommerce-info' ).remove();

          // Add new notices
          //form.closest('.product').before(response.fragments.notices_html)

          form.unblock();
        }
      });
    });
  });
	</script>
<?php
}

add_action( 'wp_footer', 'product_page_ajax_add_to_cart_js' );

/**
 * Controlar añadir al carrito - AJAX
 */

function ajax_add_to_cart_handler() {
	WC_Form_Handler::add_to_cart_action();
	WC_AJAX::get_refreshed_fragments();
}

add_action( 'wc_ajax_ace_add_to_cart', 'ajax_add_to_cart_handler' );
add_action( 'wc_ajax_nopriv_ace_add_to_cart', 'ajax_add_to_cart_handler' );

// Borrar añadir al carrito del nucleo para evitar duplicados
remove_action( 'wp_loaded', array( 'WC_Form_Handler', 'add_to_cart_action' ), 20 );

/**
 * Añadir notificacion de añadir al carrito
 */

function ace_ajax_add_to_cart_add_fragments( $fragments ) {
	$all_notices  = WC()->session->get( 'wc_notices', array() );
	$notice_types = apply_filters( 'woocommerce_notice_types', array( 'error', 'success', 'notice' ) );

	ob_start();
	foreach ( $notice_types as $notice_type ) {
		if ( wc_notice_count( $notice_type ) > 0 ) {
			wc_get_template( "notices/{$notice_type}.php", array(
				'messages' => array_filter( $all_notices[ $notice_type ] ),
			) );
		}
	}
	$fragments['notices_html'] = ob_get_clean();

	wc_clear_notices();

	return $fragments;
}

add_filter( 'woocommerce_add_to_cart_fragments', 'ace_ajax_add_to_cart_add_fragments' );

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
 
	echo '</div>';
 
}

add_action( 'woocommerce_product_options_advanced', 'add_product_options_cw');
 
/**
 * Añadir flag Catch Weight al guardar producto
 */

function save_fields_cw( $id, $post ){
	update_post_meta( $id, 'catch_weight', $_POST['catch_weight'] ); 
}
 
add_action( 'woocommerce_process_product_meta', 'save_fields_cw', 10, 2 );

/**
 * Redireccionar a my account si el usuario no está logueado al entrar al checkout
 */

add_action('template_redirect','check_if_logged_in');

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

        $redirect = $_GET['redirect_to'];
        if (isset($redirect)) {
        echo '<script>window.location.href = "'.$redirect.'";</script>';
        }

    }
  }
}

/**
 * Mostrar mensaje en página login - register
 */

function login_register_message() {
  if ( get_option( 'woocommerce_enable_myaccount_registration' ) == 'yes' ) {
	?>
		<div class="woocommerce-info">
			<p style="color:red; margin:0px;"><?php _e( 'Si ya tienes una cuenta por favor inicia sesión, caso contrario por favor regístrate' ); ?></p>
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
    'label'         => 'He leido y acepto la <a href="/privacy-policy">política de privacidad</a>',
  ));
    
}

add_action( 'woocommerce_register_form', 'registration_privacy_policy_check', 11 );
  
/**
 * Validar check para política de privacidad en registro
 */

function validate_privacy_policy_registration_check( $errors, $username, $email ) {
  if ( ! is_checkout() ) {
    if ( ! (int) isset( $_POST['privacy_policy_registration_check'] ) ) {
      $errors->add( 'privacy_policy_registration_check_error', __( 'Debe aceptar la política de privacidad', 'woocommerce' ) );
    }
  }
  return $errors;
}
      
add_filter( 'woocommerce_registration_errors', 'validate_privacy_policy_registration_check', 10, 3 );

/**
 * Redondear montos a 2 decimales
 */

function two_decimal_price( $formatted_price, $price, $decimal_places, $decimal_separator, $thousand_separator ) {
	return number_format($price, 2, $decimal_separator, $thousand_separator );
}

add_filter( 'formatted_woocommerce_price', 'two_decimal_price', 10, 5 );

/**
 * Añadir peso total a pedido
 */

add_action( 'woocommerce_checkout_update_order_meta', 'save_weight_order' );
 
function save_weight_order( $order_id ) {
    $weight = WC()->cart->get_cart_contents_weight();
    update_post_meta( $order_id, '_cart_weight', $weight );
}
 
add_action( 'woocommerce_admin_order_data_after_billing_address', 'delivery_weight_display_admin_order_meta', 10, 1 );
  
function delivery_weight_display_admin_order_meta( $order ) {    
    echo '<p><strong>Peso Total:</strong> ' . get_post_meta( $order->get_id(), '_cart_weight', true ) . get_option( 'woocommerce_weight_unit' ) . '</p>';
}

?>