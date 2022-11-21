<?php
/*
Plugin Name: WooCommerce pagos con Visa
Plugin URI: #
Description: Módulo para pagos en línea mediante Visa.
Version: 3.0.1
Author: Visa
Author URI: #
*/

include 'qas/librerias/lib.inc';
include 'qas/librerias/funciones.php';
add_action('plugins_loaded', 'woocommerce_visanet_init', 0);
function woocommerce_visanet_init()
{
  if (!class_exists('WC_Payment_Gateway')) return;

  class WC_Visanet extends WC_Payment_Gateway
  {
    public function __construct()
    {
      $this->id = 'visanet';
      //   $this->icon   = plugins_url('/images/'.($this->get_option('iconimage') ? $this->get_option('iconimage') : 'visa.png'), __FILE__);
      $this->method_title = 'Visa';
      $this->has_fields = false;

      $this->init_form_fields();
      $this->init_settings();

      $this->urlLogos = $this->validarMarcas($this->settings['marcas']);
      $uri = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";

      if ($uri == wc_get_checkout_url() || $_SERVER['QUERY_STRING'] == 'wc-ajax=update_order_review') {
        $this->title = $this->settings['title'] . $this->urlLogos;
      } else {
        $this->title = $this->settings['title'];
      }
      $this->description = $this->settings['description'];
      $this->merchant_id = $this->settings['merchant_id'];
      $this->accesskey = $this->settings['accesskey'];
      $this->secretkey = $this->settings['secretkey'];

      $this->merchant_id_en = $this->settings['merchant_id_en'];
      $this->accesskey_en = $this->settings['accesskey_en'];
      $this->secretkey_en = $this->settings['secretkey_en'];

      $this->ambiente = $this->settings['ambiente'];
      $this->url_logo =  $this->settings['url_logo'];
      $this->url_tyc =  $this->settings['url_tyc'];
      $this->url_to =  $this->settings['url_to'];

      $this->msg['message'] = "";
      $this->msg['class'] = "";

      $this->buttonSize = $this->settings['buttonSize'];
      $this->buttonColor = $this->settings['buttonColor'];
      $this->payButtonColor = $this->settings['payButtonColor'];
      $this->showAmount = $this->settings['showAmount'];
      $this->estadoPedido = $this->settings['estado'];

      add_action('woocommerce_update_options_payment_gateways_' . $this->id, array($this, 'process_admin_options'));
      add_action('woocommerce_receipt_' . $this->id, array($this, 'receipt_page'));
      //add_action( 'woocommerce_update_options_payment_gateways_' . $this->id, array( $this, 'save_account_details' ) );
      add_action('woocommerce_thankyou_' . $this->id, array($this, 'thankyou_page'));
      $this->db_niubiz_pagoefectivo();
    }

    function db_niubiz_pagoefectivo() {
      global $wpdb, $charset_collate;
      $nombreTabla = $wpdb->prefix . "niubiz_pagoefectivo";
		  $ms_queries = "
        CREATE TABLE IF NOT EXISTS $nombreTabla (
          ID bigint(20) NOT NULL auto_increment,
          cip varchar(10) NOT NULL default '',
          email varchar(200) NOT NULL default '',
          idPedido bigint(20) NOT NULL,
          nroPedido varchar(50) NULL,
          status varchar(10) NULL,
          PRIMARY KEY  (ID)
        ) $charset_collate;
      ";
		  $wpdb->query( $ms_queries );
    } 

    /* Validar marcas disponibles */
    function validarMarcas($marcas)
    {
      $logos = "";
      $urlVisa = plugin_dir_url(__FILE__) . 'images/visa.png';
      $urlMc = plugin_dir_url(__FILE__) . 'images/mc.png';
      $urlAmex = plugin_dir_url(__FILE__) . 'images/amex.png';
      $urlDiners = plugin_dir_url(__FILE__) . 'images/dc.png';
      $urlPE = plugin_dir_url(__FILE__) . 'images/pe.png';
      foreach ($marcas as $m) {
        if ($m == "visa") {
          $logos .= " <img src='$urlVisa'>";
        }
        if ($m == "mc") {
          $logos .= " <img src='$urlMc'>";
        }
        if ($m == "amex") {
          $logos .= " <img src='$urlAmex'>";
        }
        if ($m == "diners") {
          $logos .= " <img src='$urlDiners'>";
        }
        if ($m == "pe") {
          $logos .= " <img src='$urlPE'>";
        }
      }
      return $logos;
    }

    /** INCIO DE FORMULARIO DE CONFIGURACION */

    function init_form_fields() {
      $this->form_fields = include 'includes/initFormFields.php';
    }

    public function admin_options()
    {
      echo '<h3>' . __('Visa', 'fabro') . '</h3>';
      echo '<p>' . __('Niubiz permite realizar pagos con tarjeta Visa.') . '</p>';
      echo '<table class="form-table">';
      $this->generate_settings_html();
      echo '</table>';
    }


    function payment_fields()
    {
      if ($this->description) echo wpautop(wptexturize($this->description));
    }

    function receipt_page($order)
    {
      echo '<p>' . __('Haga click en el botón para realizar su pago mediante Niubiz.', 'fabro') . '</p>';
      echo $this->generate_visanet_form($order);
    }

    /** GENERAR BOTON DE PAGO **/

    public function generate_visanet_form($order_id)
    {

      global $woocommerce, $product;
      $current_user = wp_get_current_user();
      $order = new WC_Order($order_id);
      $txnid = $order_id . '_' . date("ymds");
      $amount = round($order->order_total, 2);
      //$redirect_url = ($this -> redirect_page_id=="" || $this -> redirect_page_id==0)?get_site_url() . "/":get_permalink($this -> redirect_page_id);

      $productinfo = "Order $order_id";
      $sessionToken = getGUID();
      //$amount = "1.00";
      $moneda = get_post_meta($order_id, '_order_currency', true);
      $vars = get_option("woocommerce_visanet_settings");
      $order_items = $order->get_items();
      if ($vars['recurrence'] == "yes") {
        $data_recurrence = "TRUE";
        $data_recurrenceamount = $vars['recurrencemaxamount'];
        $data_recurrencetype = $vars['recurrencetype'];
        $data_recurrenceamount = $vars['recurrenceamount'];
        $data_recurrencefrequency = $vars['recurrencefrequency'];
      } else {
        $data_recurrence = "FALSE";
        $data_recurrenceamount = $vars['recurrencemaxamount'];
        $data_recurrencetype = $vars['recurrencetype'];
        $data_recurrenceamount = $vars['recurrenceamount'];
        $data_recurrencefrequency = $vars['recurrencefrequency'];
      }
      if ($moneda == "USD") {
        if ($vars['multicomercio'] == "yes") {
          foreach ($order_items as $item) {
            $product_id = $item['product_id'];
          }

          $merid = get_post_meta($product_id, '_codigo_comercio_dolares', true);
          $accessk = get_post_meta($product_id, '_access_key_dolares', true);
          $seckey = get_post_meta($product_id, '_secret_key_dolares', true);
          $logopago = get_post_meta($product_id, '_img_logoprd', true);

          $esRecurrente = get_post_meta($product_id, 'MC_ES_RECURRENTE', true);
          $recurrence = $esRecurrente == "yes" ? "TRUE" : "FALSE";
          $frecuenciaRecurrencia = get_post_meta($product_id, 'MC_FRECUENCIA_RECURRENCIA', true);
          $tipoRecurrencia = get_post_meta($product_id, 'MC_TIPO_RECURRENCIA', true);
          $pagoInicial = get_post_meta($product_id, 'MC_PAGO_INICIAL', true);
          $codigoProducto = get_post_meta($product_id, 'MC_CODIGO_PRODUCTO', true);
        } else {
          $merid = $this->merchant_id_en;
          $accessk = $this->accesskey_en;
          $seckey = $this->secretkey_en;
          $logopago = $this->url_logo;
        }
      } else {
        if ($vars['multicomercio'] == "yes") {
          foreach ($order_items as $item) {
            $product_id = $item['product_id'];
          }
          $merid = get_post_meta($product_id, '_codigo_comercio_soles', true);
          $accessk = get_post_meta($product_id, '_access_key_soles', true);
          $seckey = get_post_meta($product_id, '_secret_key_soles', true);
          $logopago = get_post_meta($product_id, '_img_logoprd', true);

          $esRecurrente = get_post_meta($product_id, 'MC_ES_RECURRENTE', true);
          $recurrence = $esRecurrente == "yes" ? "TRUE" : "FALSE";
          $frecuenciaRecurrencia = get_post_meta($product_id, 'MC_FRECUENCIA_RECURRENCIA', true);
          $tipoRecurrencia = get_post_meta($product_id, 'MC_TIPO_RECURRENCIA', true);
          $pagoInicial = get_post_meta($product_id, 'MC_PAGO_INICIAL', true);
          $codigoProducto = get_post_meta($product_id, 'MC_CODIGO_PRODUCTO', true);
        } else {
          $merid = $this->merchant_id;
          $accessk = $this->accesskey;
          $seckey = $this->secretkey;
          $logopago = $this->url_logo;
        }
      }

      $key = securitykey($this->ambiente, $merid, $accessk, $seckey); // nuevo

      // echo ($order->data);
      // var_dump($order->data['billing']['email']);
      // var_dump($order);

      //setcookie("key",$key);
      if ($recurrence == "TRUE") {
        $sessionKey = create_token_recurrence($this->ambiente, $amount, $key, $merid, $accessk, $seckey, $pagoInicial);
      } else {
        $sessionKey = create_token($this->ambiente, $amount, $key, $merid, $accessk, $seckey);
        $pagoInicial = $amount;
      }

      //$sessionKey = create_token($amount,$this->ambiente,$merid,$accessk,$seckey,$sessionToken);
      //$sessionKey = create_token($this->ambiente,$amount,$key,$merid,$accessk,$seckey,$sessionToken);
      //guarda_sessionKey($sessionKey);
      //var_dump($sessionKey);
      update_post_meta($order_id, '_sessionKey', $sessionKey);
      update_post_meta($order_id, '_order_key', $key);
      $entorno = $this->ambiente;
      $arrayPost = array("sessionToken" => $sessionToken, "merchantId" => $merid, "entorno" => $entorno, "amount" => $amount, "key" => $key);
      //guarda_sessionToken($sessionToken);
      update_post_meta($order_id, '_sessionToken', $sessionToken);
      // update_post_meta($order_id, '_visanetLang', ICL_LANGUAGE_CODE);
      /* ENCRIPTAMOS ID DE ORDEN PARA PASARLO POR URL DE MANERA MAS SEGURA */
      update_post_meta($order_id, '_orderUrl', $_SERVER["REQUEST_URI"]);
      $secret_key = 'fabricio_vela';
      $secret_iv = 'fabricio_vela';

      $output = false;
      $encrypt_method = "AES-256-CBC";
      $key2 = hash('sha256', $secret_key);
      $iv = substr(hash('sha256', $secret_iv), 0, 16);
      $numorden = base64_encode(openssl_encrypt($order_id, $encrypt_method, $key2, 0, $iv));
      /* FIN */

      $retorno = home_url() . "/wp-admin/admin-ajax.php?action=visanet&hash=" . $numorden;
      //data-usertoken=\"".get_user_meta($current_user->ID, '_visanet_usertoken', true)."\" // campo bloqueado
      $urlpost = ($this->ambiente == "dev") ? 'https://static-content-qas.vnforapps.com/v2/js/checkout.js?qa=true' : 'https://static-content.vnforapps.com/v2/js/checkout.js';
      return "<form action=\"$retorno\" method='post'>
                    
                    <script src=\"$urlpost\"
                        data-sessiontoken=\"$sessionKey\"
                        data-merchantid=\"$merid\"
						            data-channel=\"web\"
                        data-buttonsize=\"$this->buttonSize\"
                        data-buttoncolor=\"$this->buttonColor\" 
                        data-merchantlogo =\"$logopago\"
                        data-merchantname=\"\"
                        data-formbuttoncolor=\"$this->payButtonColor\"
                        data-showamount=\"$this->showAmount\"
                        data-purchasenumber=\"$order_id\"
                        data-amount=\"$pagoInicial\"
                        data-cardholdername=\"\"
                        data-cardholderlastname=\"\"
                        data-cardholderemail=\"\"
                        data-usertoken=\"\"
                        data-recurrence=\"" . $recurrence . "\"
                        data-recurrencefrequency=\"" . $frecuenciaRecurrencia . "\"
                        data-recurrencetype=\"" . $tipoRecurrencia . "\"
                        data-recurrenceamount=\"" . $amount . "\"
                        data-recurrencemaxamount=\"" . $amount . "\"
                        data-documenttype=\"0\"
                        data-documentid=\"\"
                        data-beneficiaryid=\"\"
                        data-productid=\"\"
                        data-phone=\"\"
						data-timeouturl=\"" . $this->url_to . "\"
                    /></script>
                    
                </form>";
    }

    /** PROCESAR PAGO **/

    function process_payment($order_id)
    {
      global $woocommerce;
      $order = new WC_Order($order_id);
      //$woocommerce->cart->empty_cart();

      return array(
        'result'   => 'success',
        'redirect' => $order->get_checkout_payment_url(true)
      );
    }

    /** PAGINA DE RETORNO **/

    function thankyou_page($order_id)
    {

      $order = new WC_Order($order_id);

      $datos = get_post_meta($order_id, '_visanetRetorno', true);


      $ambiente = get_post_meta($order_id, '_order_ambiente', true);
      $key = get_post_meta($order_id, '_order_key', true);
      $merid = get_post_meta($order_id, '_order_merchantid', true);
      $accessk = get_post_meta($order_id, '_order_accessk', true);
      $seckey = get_post_meta($order_id, '_order_seckey', true);


      //die('ambiente: '.$ambiente.'<br/>key: '.$key.'<br/>merid: '.$merid.'<br/>accessk: '.$accessk.'<br/>seckey: '.$seckey);
      //$transactionToken = $_POST['transactionToken'];
      //$datos = authorization($ambiente, $key, $merid, $transactionToken,$accessk,$seckey);
      //update_post_meta($order_id, '_visanetRetorno', $datos);

      $moneda = get_post_meta($order_id, '_order_currency', true);
      $cliente = get_post_meta($order_id, '_billing_first_name', true) . " " . get_post_meta($order_id, '_billing_last_name', true);
      $sal = json_decode($datos, true);
      $moneda = get_post_meta($order_id, '_order_currency', true);
      //var_dump($sal);
      if ($moneda == "PEN") {

        if (isset($sal['dataMap']['ACTION_CODE']) && $sal['dataMap']['ACTION_CODE'] == "000") {
          echo "<b>Cliente: </b>" . $cliente . "</br>";
          echo "<b>Fecha y Hora: </b>" . date("Y-m-d H:i:s", ($sal['header']['ecoreTransactionDate'] / 1000)) . "</br>";
          echo "<b>Tarjeta: </b>" . $sal['dataMap']['CARD'] . "</br>";
          echo "<b>Moneda: </b>" . $moneda . "</br>";
        } else {
          $fecha = str_split($sal['data']['TRANSACTION_DATE'], 2);
          echo "<b>Nro. Orden: </b>" . $order_id . "</br>";
          echo "<b>Fecha y Hora: </b>" . $fecha[0] . "-" . $fecha[1] . "-" . $fecha[2] . " " . $fecha[3] . ":" . $fecha[4] . ":" . $fecha[5] . "</br>";
          echo "<b>Motivo: </b>" . $sal['data']['ACTION_DESCRIPTION'] . "</br>";
          echo "<b>Moneda: </b>" . $moneda . "</br>";
        }
        echo '<a href="' . $this->url_tyc . '" target="_blank">Ver Términos y Condiciones</a><br/>';
        echo "<input type ='button' onclick='window.print();' class='button-shop-product' value='Imprimir'>";
      } elseif ($moneda == "USD") {
        if (isset($sal['dataMap']['ACTION_CODE']) && $sal['dataMap']['ACTION_CODE'] == "000") {
          echo "<b>Customer: </b>" . $cliente . "</br>";
          echo "<b>Date: </b>" . date("y-m-d H:i:s", ($sal['header']['ecoreTransactionDate'] / 1000)) . "</br>";
          echo "<b>Credit Card Number: </b>" . $sal['dataMap']['CARD'] . "</br>";
          echo "<b>Currency: </b>" . $moneda . "</br>";
        } else {
          echo "<b>Order ID: </b>" . $order_id . "</br>";
          $fecha = str_split($sal['data']['TRANSACTION_DATE'], 2);
          echo "<b>Date: </b>" . $fecha[0] . "-" . $fecha[1] . "-" . $fecha[2] . " " . $fecha[3] . ":" . $fecha[4] . ":" . $fecha[5] . "</br>";
          echo "<b>Reason: </b>" . getMotivo($sal['data']['ACTION_CODE']) . "</br>";
          echo "<b>Currency: </b>" . $moneda . "</br>";
        }
        echo '<a href="' . $this->url_tycen . '" target="_blank">Our Terms and Conditions</a><br/>';
        echo "<input type ='button' onclick='window.print();' class='button-shop-product' value='Print'>";
      }
    }

    function showMessage($content)
    {
      return '<div class="box ' . $this->msg['class'] . '-box">' . $this->msg['message'] . '</div>' . $content;
    }
  }
  /**
   * AGREGAMOS EL MÉTODO DE PAGO NIUBIZ
   **/
  function woocommerce_add_visanet($methods)
  {
    $methods[] = 'WC_Visanet';
    return $methods;
  }

  /** AGREGAMOS WP-AJAX ACTIONS PARA AUTORIZACION Y RESPUESTA DE PAGO **/

  add_action('wp_ajax_visanet', 'check_visanet_response');
  add_action('wp_ajax_nopriv_visanet', 'check_visanet_response');

  /* Autorizacion */

  add_action('wp_ajax_visanetAcciones', 'visanet_acciones');
  add_action('wp_ajax_nopriv_visanetAcciones', 'visanet_acciones');


  add_filter('woocommerce_payment_gateways', 'woocommerce_add_visanet');

  /** RETORNO NIUBIZ Y VERIFICA SI EL PAGO FUE EXITOSO **/
  function check_visanet_response()
  {
    global $woocommerce;
    $current_user = wp_get_current_user();
    if ($_POST) {

      /* DESENCRIPTAMOS */
      $hash = $_GET['hash'];
      $secret_key = 'fabricio_vela';
      $secret_iv = 'fabricio_vela';

      $output = false;
      $encrypt_method = "AES-256-CBC";
      $key2 = hash('sha256', $secret_key);
      $iv = substr(hash('sha256', $secret_iv), 0, 16);
      $order_id = openssl_decrypt(base64_decode($hash), $encrypt_method, $key2, 0, $iv);

      $order = new WC_Order($order_id);
      $vars = get_option("woocommerce_visanet_settings");
      $transactionToken = $_POST['transactionToken'];
      if (isset($_POST['url'])) {
        $url = $_POST["url"];
        // Actualizar orden (Pendiente pago - PagoEfectivo)
        // $order->update_status($vars['estado']);
        $order->add_order_note('PagoEfectivo (Niubiz) => Pendiente de pago\nCIP: '.$transactionToken);
        // Actualizar tabla BD
        global $wpdb;
        $nombreTabla = $wpdb->prefix . "niubiz_pagoefectivo";
        $ms_queries = "
          INSERT INTO $nombreTabla (`cip`, `email`, `idPedido`) VALUES ('".$transactionToken."', '".$_POST['customerEmail']."', {$order_id})
        ";
        $wpdb->query( $ms_queries );
        header('Location: '.$url);
        exit;
      }
      //$sessionToken = recupera_sessionToken();
      $sessionToken = get_post_meta($order_id, '_sessionToken', true);
      $moneda = get_post_meta($order_id, '_order_currency', true);
      $order_items = $order->get_items();
      if ($moneda == "USD") {
        if ($vars['multicomercio'] == "yes") {
          foreach ($order_items as $item) {
            $product_id = $item['product_id'];
          }

          $merid = get_post_meta($product_id, '_codigo_comercio_dolares', true);
          $accessk = get_post_meta($product_id, '_access_key_dolares', true);
          $seckey = get_post_meta($product_id, '_secret_key_dolares', true);

          $esRecurrente = get_post_meta($product_id, 'MC_ES_RECURRENTE', true);
          $recurrence = $esRecurrente == "yes" ? "TRUE" : "FALSE";
          $frecuenciaRecurrencia = get_post_meta($product_id, 'MC_FRECUENCIA_RECURRENCIA', true);
          $tipoRecurrencia = get_post_meta($product_id, 'MC_TIPO_RECURRENCIA', true);
          $pagoInicial = get_post_meta($product_id, 'MC_PAGO_INICIAL', true);
          $codigoProducto = get_post_meta($product_id, 'MC_CODIGO_PRODUCTO', true);
        } else {
          $merid = $vars['merchant_id_en'];
          $accessk = $vars['accesskey_en'];
          $seckey = $vars['secretkey_en'];
        }
      } else {
        if ($vars['multicomercio'] == "yes") {
          foreach ($order_items as $item) {
            $product_id = $item['product_id'];
          }
          $merid = get_post_meta($product_id, '_codigo_comercio_soles', true);
          $accessk = get_post_meta($product_id, '_access_key_soles', true);
          $seckey = get_post_meta($product_id, '_secret_key_soles', true);

          $esRecurrente = get_post_meta($product_id, 'MC_ES_RECURRENTE', true);
          $recurrence = $esRecurrente == "yes" ? "TRUE" : "FALSE";
          $frecuenciaRecurrencia = get_post_meta($product_id, 'MC_FRECUENCIA_RECURRENCIA', true);
          $tipoRecurrencia = get_post_meta($product_id, 'MC_TIPO_RECURRENCIA', true);
          $pagoInicial = get_post_meta($product_id, 'MC_PAGO_INICIAL', true);
          $codigoProducto = get_post_meta($product_id, 'MC_CODIGO_PRODUCTO', true);
        } else {
          $merid = $vars['merchant_id'];
          $accessk = $vars['accesskey'];
          $seckey = $vars['secretkey'];
        }
      }
      $key = get_post_meta($order_id, '_order_key', true);
      $order = new WC_Order($order_id);
      $amount = round($order->order_total, 2);

      if ($recurrence == "TRUE") {
        $respuesta = authorization_recurrence($vars["ambiente"], $key, $amount, $merid, $transactionToken, $order_id, $moneda, $codigoProducto, $pagoInicial, $frecuenciaRecurrencia, $tipoRecurrencia);
      } else {
        $respuesta = authorization($vars["ambiente"], $key, $amount, $merid, $transactionToken, $order_id, $moneda);
      }

      //die(var_dump($respuesta));
      //die(var_dump($respuesta).'<br/>ambiente: '.$vars["ambiente"].'<br/>key: '.$key.'<br/>amount: '.$amount.'<br/>merid: '.$merid.'<br/>transactionToken: '.$transactionToken.'<br/>accessk: '.$accessk.'<br/>seckey: '.$seckey);
      $sal = json_decode($respuesta, true);
      update_post_meta($order_id, '_visanetRetorno', $respuesta);
      //var_dump($respuesta);
      if ($order) {


        $note = 'Pago via Niubiz : ' . $msg_auth . "\n";
        $note .= 'Codigo Autorización: ' . $sal['order']['authorizationCode'] . "\n";
        $note .= 'Codigo Accion: ' . $sal['dataMap']['ACTION_CODE'] . "\n";
        $note .= 'Num Tarjeta: ' . $sal['dataMap']['CARD'] . "\n";

        $order->add_order_note($note);
        update_post_meta($order_id, '_order_ambiente', $vars["ambiente"]);

        update_post_meta($order_id, '_order_merchantid', $merid);
        update_post_meta($order_id, '_order_accessk', $accessk);
        update_post_meta($order_id, '_order_seckey', $seckey);

        update_user_meta($current_user->ID, '_visanet_usertoken', $sal['order']['tokenId']);


        if ($sal['dataMap']['ACTION_CODE'] == "000") { // autorizada
          $order->update_status($vars['estado']);
          $order->reduce_order_stock();
          $woocommerce->cart->empty_cart();
        } else {
          $order->update_status('failed');
        }
        $moneda = get_post_meta($order_id, '_order_currency', true);

        $url = get_post_meta($order_id, '_orderUrl', true);
        $parsear = explode('/', $url);
        $rever = array_reverse($parsear);
        $prefijo = $rever[3];
        if ($moneda == "PEN") {
          $url = site_url('/' . $prefijo . '/order-received/' . $order_id . '/?key=' . $order->order_key);
        } else {
          $url = site_url('/' . $prefijo . '/order-received/' . $order_id . '/?key=' . $order->order_key);
        }
        //http://{website}/checkout/order-received/{purchaseOperationNumber}/?key={HTTPSessionId}

        wp_redirect($url);
        exit();
        //var_dump($sal);
      } else {
        echo 'Número de pedido no válido';
      }
    } else {
      echo 'No se recibio post.';
    }

    die();
  }

  /** SE EJECUTAN LAS ACCIONES DE DEPOSITO, CANCELACION Y ANULACION **/
  function visanet_acciones()
  {
    global $woocommerce;
    $order_id = $_GET['ordernumber'];
    $order = new WC_Order($order_id);
    $uuid = getGUID();
    $amount = round($order->get_total(), 2);
    $merchant_id = get_post_meta($order_id, '_order_merchantid', true);
    $api_key  = get_post_meta($order_id, '_order_accessk', true);
    $password = get_post_meta($order_id, '_order_seckey', true);
    $purchasenumber = $_GET['purchasenumber'];
    $data = array("comment" => ""); // data u want to post                                                                   
    $data_string = json_encode($data);
    $vars = get_option("woocommerce_visanet_settings");
    $ambiente = ($vars['ambiente'] == "dev") ? 'devapi' : 'api';
    if (isset($_GET['metodo']) && $_GET['metodo'] == "1") {
      $urlAcccion = "https://" . $ambiente . ".vnforapps.com/api.tokenization/api/v2/merchant/" . $merchant_id . "/deposit/" . $purchasenumber;
      $method = "PUT";
    }
    if (isset($_GET['metodo']) && $_GET['metodo'] == "2") {
      $urlAcccion = "https://" . $ambiente . ".vnforapps.com/api.tokenization/api/v2/merchant/" . $merchant_id . "/cancelDeposit/" . $purchasenumber;
      $method = "PUT";
    }
    if (isset($_GET['metodo']) && $_GET['metodo'] == "3") {
      $urlAcccion = "https://" . $ambiente . ".vnforapps.com/api.tokenization/api/v2/merchant/" . $merchant_id . "/void/" . $purchasenumber;
      $method = "PUT";
    }

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $urlAcccion);
    curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 20);
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, $method);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_USERPWD, $api_key . ':' . $password);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
    curl_setopt($ch, CURLOPT_HTTPHEADER, array(
      'Accept: application/json',
      'Content-Type: application/json'
    ));

    $errors = curl_error($ch);
    $result = curl_exec($ch);
    $returnCode = (int)curl_getinfo($ch, CURLINFO_HTTP_CODE);
    $info = curl_getinfo($ch);
    //print_r($info['request_header']);
    curl_close($ch);
    $json_result = json_decode($result, true);
    if (isset($_GET['metodo']) && $_GET['metodo'] == "3" && $json_result["errorCode"] == 0) {
      $order->update_status('refunded');
    }
    echo json_encode(array("errorCode" => $json_result["errorCode"], "errorMessage" => $json_result["errorMessage"]));
    die();
  }

  /** CAJA DE ACCIONES NIUBIZ **/

  add_action('add_meta_boxes', 'MY_order_meta_boxes');
  function MY_order_meta_boxes()
  {

    add_meta_box(
      'woocommerce-order-visanetacciones',
      __('Acciones Visa'),
      'order_meta_box_visaccciones',
      'shop_order',
      'side',
      'default'
    );
  }
  function order_meta_box_visaccciones()
  {
    global $woocommerce, $post;
    $dir = plugin_dir_path(__FILE__);
    $order_id = $post->ID;
    $order = new WC_Order($order_id);
    $retorno = get_post_meta($order_id, '_visanetRetorno', true);
    $vars = get_option("woocommerce_visanet_settings");
    $ambiente = ($vars['ambiente'] == "dev") ? 'devapi' : 'api';
    if ($order->has_status('completed') || $order->has_status('refunded')) {
      /* Comprobamos estado actual */
      $data = array("comment" => "");
      $data_string = json_encode($data);
      $merchant_id = get_post_meta($order_id, '_order_merchantid', true);
      $api_key  = get_post_meta($order_id, '_order_accessk', true);
      $password = get_post_meta($order_id, '_order_seckey', true);
      $ch = curl_init();
      curl_setopt($ch, CURLOPT_URL, "https://" . $ambiente . ".vnforapps.com/api.tokenization/api/v2/merchant/" . $merchant_id . "/query/" . $order_id);
      curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 20);
      curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "PUT");
      curl_setopt($ch, CURLOPT_POST, true);
      curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string);
      curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
      curl_setopt($ch, CURLOPT_USERPWD, $api_key . ':' . $password);
      curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
      curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
      curl_setopt($ch, CURLOPT_HTTPHEADER, array(
        'Accept: application/json',
        'Content-Type: application/json'
      ));


      $errors = curl_error($ch);
      $result = curl_exec($ch);
      $returnCode = (int)curl_getinfo($ch, CURLINFO_HTTP_CODE);
      $info = curl_getinfo($ch);
      curl_close($ch);
      $json_result = json_decode($result, true);
      $purchases = array_shift(array_slice($json_result["purchases"], 0, 1));

      /* Fin Comprobacion Estado actual */
      $url = home_url();
      echo '<p><b>Pedido:</b> #' . $json_result["purchaseNumber"] . '<br/>';
      echo '<b>Codigo de Comercio:</b> ' . $merchant_id . '<br/>';
      /*echo '<b>Access Key ID:</b> '.$api_key.'<br/>';
            echo '<b>Secret Key ID:</b> '.$password.'<br/>';*/
      echo '<b>Estado Actual:</b> ' . $purchases["estado"] . '<br/><br/></p>';
      echo "<script type='text/javascript' src='" . plugin_dir_url(__FILE__) . "/visanet.js'></script>";
      if ($purchases["estado"] == "AUTORIZADO") {
        echo '<button id="vn" type="button" class="button save_order button-primary" onclick="acciones(\'' . $url . '\', \'1\', \'' . $order_id . '\', \'' . $json_result["purchaseNumber"] . '\', \'' . $merchant_id . '\', \'' . $api_key . '\', \'' . $password . '\');">Depositar</button>';
        echo '<br><br><button id="vn" type="button" class="button save_order button-primary" onclick="acciones(\'' . $url . '\', \'3\', \'' . $order_id . '\', \'' . $json_result["purchaseNumber"] . '\', \'' . $merchant_id . '\', \'' . $api_key . '\', \'' . $password . '\');">Anular</button>';
      } elseif ($purchases["estado"] == "DEPOSITADO") {
        echo '<button id="vn" type="button" class="button save_order button-primary" onclick="acciones(\'' . $url . '\', \'2\', \'' . $order_id . '\', \'' . $json_result["purchaseNumber"] . '\', \'' . $merchant_id . '\', \'' . $api_key . '\', \'' . $password . '\');">Cancelar Deposito</button>';
      } elseif ($purchases["estado"] == "ANULADO") {
        echo "<p style='color:#d60000; font-weight:bold;'>Sin acciones disponibles, el pedido se encuentra Anulado.</p>";
      }
    } else {
    }
  }


  /** AGREGAMOS LAS OPCIONES ADICIONALES PARA LOS PRODUCTOS **/

  add_action('woocommerce_product_write_panel_tabs', 'tabVisanet');

  function tabVisanet()
  {
?>
    <li class="custom_tab"><a href="#tabVisanet"> <?php _e('Visa', 'woocommerce'); ?></a></li>
  <?php
  }

  function tabVisanet_product_tab_content()
  {
    global $post;

    // Note the 'id' attribute needs to match the 'target' parameter set above
  ?><div id='tabVisanet' class='panel woocommerce_options_panel'><?php
                                                                    ?>
      <div class='options_group'>
        <h2>Configuración para <b>Soles</b></h2>
        <?php
        woocommerce_wp_text_input(array(
          'id'                => '_codigo_comercio_soles',
          'label'             => __('Codigo Comercio', 'woocommerce'),
          'desc_tip'          => 'true',
          'description'       => __('Ingrese su código de comercio de Niubiz para Soles'),
          'type'              => 'text',
          'custom_attributes' => array(
            'placeholder'   => 'Codigo Comercio Soles'
          ),
        ));

        woocommerce_wp_text_input(array(
          'id'                => '_access_key_soles',
          'label'             => __('Access Key', 'woocommerce'),
          'desc_tip'          => 'true',
          'description'       => __('Ingrese su Access Key ID de Niubiz para Soles'),
          'type'              => 'text',
          'custom_attributes' => array(
            'placeholder'   => 'Access Key'
          ),
        ));

        woocommerce_wp_text_input(array(
          'id'                => '_secret_key_soles',
          'label'             => __('Secret Key', 'woocommerce'),
          'desc_tip'          => 'true',
          'description'       => __('Ingrese su Secret Key ID de Niubiz para Soles'),
          'type'              => 'text',
          'custom_attributes' => array(
            'placeholder'   => 'Secret Key'
          ),
        ));


        ?>
        <hr>
        <h2>Configuración para <b>Dólares</b></h2>
        <?php
        woocommerce_wp_text_input(array(
          'id'                => '_codigo_comercio_dolares',
          'label'             => __('Codigo Comercio', 'woocommerce'),
          'desc_tip'          => 'true',
          'description'       => __('Ingrese su código de comercio de Niubiz para Dólares'),
          'type'              => 'text',
          'custom_attributes' => array(
            'placeholder'   => 'Codigo Comercio Soles'
          ),
        ));

        woocommerce_wp_text_input(array(
          'id'                => '_access_key_dolares',
          'label'             => __('Access Key', 'woocommerce'),
          'desc_tip'          => 'true',
          'description'       => __('Ingrese su Access Key ID de Niubiz para Dólares'),
          'type'              => 'text',
          'custom_attributes' => array(
            'placeholder'   => 'Access Key'
          ),
        ));

        woocommerce_wp_text_input(array(
          'id'                => '_secret_key_dolares',
          'label'             => __('Secret Key', 'woocommerce'),
          'desc_tip'          => 'true',
          'description'       => __('Ingrese su Secret Key ID de Niubiz para Dólares'),
          'type'              => 'text',
          'custom_attributes' => array(
            'placeholder'   => 'Secret Key'
          ),
        ));
        ?>

        <hr>
        <h2><b>Logo</b></h2>
        <?php
        woocommerce_wp_text_input(array(
          'id'                => '_img_logoprd',
          'label'             => __('Logo de Producto', 'woocommerce'),
          'desc_tip'          => 'true',
          'description'       => __('URL del logo que será mostrado en el Popup de Visa al momento de comprar este producto.'),
          'type'              => 'text',
          'custom_attributes' => array(
            'placeholder'   => 'URL Logo Producto'
          ),
        ));
        ?>
        <hr>
        <h2><b>Configuración de cargos recurrentes</b></h2>
        <?php

        woocommerce_wp_checkbox(array(
          'id'            => 'MC_ES_RECURRENTE',
          'label'         => __('Aplica recurrencia', 'woocommerce')
        ));

        woocommerce_wp_select(array(
          'id'      => 'MC_FRECUENCIA_RECURRENCIA',
          'label'   => __('Frecuencia', 'woocommerce'),
          'options' => array(
            "MONTHLY" => "MENSUAL",
            "QUARTERLY" => "TRIMESTRAL",
            "BIANNUAL" => "SEMESTRAL",
            "ANNUAL" => "ANUAL"
          ),
          // 'value'   => 'MONTHLY',
          // 'desc_tip' => 'true',
          // 'description' => __('URL del logo que será mostrado en el Popup de Visa al momento de comprar este producto.'),
        ));

        woocommerce_wp_select(array(
          'id'      => 'MC_TIPO_RECURRENCIA',
          'label'   => __('Tipo', 'woocommerce'),
          'options' => array(
            "FIXED" => "FIJO",
            "VARIABLE" => "VARIABLE",
            "FIXEDINITIAL" => "FIJO CON INICIAL",
            "VARIABLEINITIAL" => "VARIABLE CON INICIAL"
          ),
          // 'value'   => 'FIXED',
        ));

        woocommerce_wp_text_input(array(
          'id' => 'MC_PAGO_INICIAL',
          'label' => __('Importe inicial', 'woocommerce'),
          'type' => 'text',
          'desc_tip' => 'true',
          'description' => __('Aplica cuando el Tipo de recurrencia es FIXED y FIXEDINITIAL'),
        ));

        woocommerce_wp_text_input(array(
          'id' => 'MC_CODIGO_PRODUCTO',
          'label' => __('Código de producto', 'woocommerce'),
          'type' => 'text',
          'desc_tip' => 'true',
          'description' => __('Código registrado en el Niubiz'),
        ));
        ?>
      </div>

    </div><?php
        }

        add_filter('woocommerce_product_data_panels', 'tabVisanet_product_tab_content'); // WC 2.6 and up
        function save_giftcard_option_fields($post_id)
        {

          $woocommerce_codigo_comercio_soles = $_POST['_codigo_comercio_soles'];
          if (!empty($woocommerce_codigo_comercio_soles))
            update_post_meta($post_id, '_codigo_comercio_soles', esc_attr($woocommerce_codigo_comercio_soles));

          $woocommerce_access_key_soles = $_POST['_access_key_soles'];
          if (!empty($woocommerce_access_key_soles))
            update_post_meta($post_id, '_access_key_soles', esc_attr($woocommerce_access_key_soles));

          $woocommerce_secret_key_soles = $_POST['_secret_key_soles'];
          if (!empty($woocommerce_secret_key_soles))
            update_post_meta($post_id, '_secret_key_soles', esc_attr($woocommerce_secret_key_soles));

          $woocommerce_codigo_comercio_dolares = $_POST['_codigo_comercio_dolares'];
          if (!empty($woocommerce_codigo_comercio_dolares))
            update_post_meta($post_id, '_codigo_comercio_dolares', esc_attr($woocommerce_codigo_comercio_dolares));

          $woocommerce_access_key_dolares = $_POST['_access_key_dolares'];
          if (!empty($woocommerce_access_key_dolares))
            update_post_meta($post_id, '_access_key_dolares', esc_attr($woocommerce_access_key_dolares));

          $woocommerce_secret_key_dolares = $_POST['_secret_key_dolares'];
          if (!empty($woocommerce_secret_key_dolares))
            update_post_meta($post_id, '_secret_key_dolares', esc_attr($woocommerce_secret_key_dolares));

          $woocommerce_img_logoprd = $_POST['_img_logoprd'];
          if (!empty($woocommerce_img_logoprd))
            update_post_meta($post_id, '_img_logoprd', esc_attr($woocommerce_img_logoprd));


          $woocommerce_mc_es_recurrente = $_POST['MC_ES_RECURRENTE'];
          if (!empty($woocommerce_mc_es_recurrente))
            update_post_meta($post_id, 'MC_ES_RECURRENTE', esc_attr($woocommerce_mc_es_recurrente));

          $woocommerce_mc_frecuencia_recurrencia = $_POST['MC_FRECUENCIA_RECURRENCIA'];
          if (!empty($woocommerce_mc_frecuencia_recurrencia))
            update_post_meta($post_id, 'MC_FRECUENCIA_RECURRENCIA', esc_attr($woocommerce_mc_frecuencia_recurrencia));

          $woocommerce_mc_tipo_recurrencia = $_POST['MC_TIPO_RECURRENCIA'];
          if (!empty($woocommerce_mc_tipo_recurrencia))
            update_post_meta($post_id, 'MC_TIPO_RECURRENCIA', esc_attr($woocommerce_mc_tipo_recurrencia));

          $woocommerce_mc_pago_inicial = $_POST['MC_PAGO_INICIAL'];
          if (!empty($woocommerce_mc_pago_inicial))
            update_post_meta($post_id, 'MC_PAGO_INICIAL', esc_attr($woocommerce_mc_pago_inicial));

          $woocommerce_mc_codigo_producto = $_POST['MC_CODIGO_PRODUCTO'];
          if (!empty($woocommerce_mc_codigo_producto))
            update_post_meta($post_id, 'MC_CODIGO_PRODUCTO', esc_attr($woocommerce_mc_codigo_producto));
        }
        add_action('woocommerce_process_product_meta_simple', 'save_giftcard_option_fields');
        add_action('woocommerce_process_product_meta_variable', 'save_giftcard_option_fields');

        function visanet_multicomercio_empty_cart($valid, $product_id, $quantity)
        {
          $vars = get_option("woocommerce_visanet_settings");
          if ($vars['multicomercio'] == "yes") {
            if (!empty(WC()->cart->get_cart()) && $valid) {
              WC()->cart->empty_cart();
              wc_add_notice('Sólo se admite 1 producto en su carro de compras. Se ha reemplazado el producto anterior por este.', 'notice');
            }
          }

          return $valid;
        }
        add_filter('woocommerce_add_to_cart_validation', 'visanet_multicomercio_empty_cart', 10, 3);
 
  }
