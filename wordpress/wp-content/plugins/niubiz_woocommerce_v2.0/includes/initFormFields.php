<?php
 return array(
    'enabled' => array(
      'title' => 'Activado/Desactivado',
      'type' => 'checkbox',
      'label' => 'Activar Módulo.',
      'default' => 'no'
    ),
    'title' => array(
      'title' => 'Título:',
      'type' => 'text',
      'default' => 'Niubiz'
    ),
    'description' => array(
      'title' => 'Descripción:',
      'type' => 'textarea',
      'default' => 'Paga con tarjeta de crédito/débito'
    ),
    'multicomercio' => array(
      'title' => 'Modo Multicomercio',
      'type' => 'checkbox',
      'label' => 'Activar modo Multicomercio.',
      'default' => 'no'
    ),

    'marcas' => array(
      'title' => 'Marcas',
      'type' => 'multiselect',
      'label' => 'Activar marcas.',
      'options' => array(
        'visa' => 'Visa',
        'mc' => 'MasterCard',
        'amex' => 'Amex',
        'diners' => 'Diners',
        'pe' => 'PagoEfectivo'
      )
    ),
    'buttonSize' => array(
      'title' => 'Tamaño del botón',
      'type' => 'select',
      'options' => array(
        "DEFAULT" => "Defecto",
        "SMALL" => "Pequeño",
        "MEDIUM" => "Mediano",
        "LARGE" => "Grande"
      )
    ),
    'buttonColor' => array(
      'title' => 'Color del botón',
      'type' => 'select',
      'options' => array(
        "NAVY" => "Azul",
        "GRAY" => "Gris"
      )
    ),
    'payButtonColor' => array(
      'title' => 'Color del botón pagar',
      'type' => 'text',
      'default' => '#FF0000'
    ),
    'showAmount' => array(
      'title' => 'Mostrar importe',
      'type' => 'checkbox',
      'label' => 'Mostrar el importe a pagar.',
      'default' => 'yes'
    ),
    'estado' => array(
      'title' => 'Estado',
      'type' => 'select',
      'options' => array("processing" => "Procesando", "completed" => "Completado"),
    ),
    'ambiente' => array(
      'title' => 'Ambiente',
      'type' => 'select',
      'options' => array("dev" => "Desarrollo", "prd" => "Produccion"),
    ),
    'merchant_id' => array(
      'title' => 'Merchant ID Soles',
      'type' => 'text',
    ),
    'accesskey' => array(
      'title' => 'Usuario ID Soles',
      'type' => 'text',
    ),
    'secretkey' => array(
      'title' => 'Contraseña del ID Soles',
      'type' => 'text',
    ),
/* DOLARES */
    'merchant_id_en' => array(
      'title' => 'Merchant ID Dólares',
      'type' => 'text'
    ),
    'accesskey_en' => array(
      'title' => 'Usuario ID Dólares',
      'type' => 'text'
    ),
    'secretkey_en' => array(
      'title' => 'Contraseña del ID Dólares',
      'type' => 'text'
    ),
/*FIN DOLARES */
    'url_logo' => array(
      'title' => 'URL de Logo',
      'type' => 'text'
    ),
    'url_tyc' => array(
      'title' => 'URL de Terminos y Condiciones',
      'type' => 'text'
    ),
    'url_to' => array(
      'title' => 'URL de TimeOut',
      'type' => 'text'
    )
  );