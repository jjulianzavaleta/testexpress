<?php
header("Content-type: application/json; charset=utf-8");
date_default_timezone_set('America/Lima');
// include database and object files
include_once 'database.php';

// parameters by environment
if ($_SERVER['SERVER_NAME'] == "10.152.1.15") {
  $CONEXION_NOMBRE_HOST = "10.151.1.19";
  $CONEXION_NOMBRE_DB = "ChimuPOS";
  $CONEXION_USER_DB = "sa";
  $CONEXION_PASSWORD_DB = "Gbd1586i";
  $trujillo_store_code = '3410';
  $piura_store_code = '3402';
  $dbhost_xpress = 'mariadb';
  $dbuser_xpress = 'exampleuser';
  $dbpass_xpress = 'examplepass';
  $dbname_xpress = 'exampledb';
} else if ($_SERVER['SERVER_NAME'] == "testxpress.chimuagropecuaria.com.pe") {
  $CONEXION_NOMBRE_HOST = "10.152.0.19";
  $CONEXION_NOMBRE_DB = "POS_Test3";
  $CONEXION_USER_DB = "SA";
  $CONEXION_PASSWORD_DB = "Gbd1586i";
  $trujillo_store_code = '3410';
  $piura_store_code = '3402';
  $dbhost_xpress = 'localhost';
  $dbuser_xpress = 'root';
  $dbpass_xpress = 'q,su6K)sz[';
  $dbname_xpress = 'wordpress_qas';
} else if ($_SERVER['SERVER_NAME'] == "xpress.chimuagropecuaria.com.pe") {
  $CONEXION_NOMBRE_HOST = "10.100.123.13";
  $CONEXION_NOMBRE_DB = "ChimuPOS";
  $CONEXION_USER_DB = "xpress";
  $CONEXION_PASSWORD_DB = "Gbd1586i";
  $trujillo_store_code = '3410';
  $piura_store_code = '3402';
  $dbhost_xpress = 'localhost';
  $dbuser_xpress = 'root';
  $dbpass_xpress = 'q,su6K)sz[';
  $dbname_xpress = 'wordpress';
} else {
  $response = array("status" => "error", "message" => "no environment");
  print_r(json_encode($response));
  exit();
}

// get xpress db connection
$xpress_db = new Database($dbhost_xpress, $dbuser_xpress, $dbpass_xpress, $dbname_xpress);

// get SQLServer connection
$conn = sqlsrv_connect($CONEXION_NOMBRE_HOST, array("Database" => $CONEXION_NOMBRE_DB, "UID" => $CONEXION_USER_DB, "PWD" => $CONEXION_PASSWORD_DB));

if( $conn === false ) {
  die( print_r( sqlsrv_errors(), true));
}

if(!empty($_REQUEST['state'])){
  if(!empty($_REQUEST['delivery_type'])){
    $city_code = ($_REQUEST['state'] == "LAL") ? $trujillo_store_code : $piura_store_code;
    $delivery_type = $_REQUEST['delivery_type'];
    $date = date('d/m/Y');
    $stock_query = "CAST(nStockFinalUnidad AS INT)";

    $response = array();

    if(!empty($_REQUEST['sku'])){
      $sku = " and sCodArt like '%".$_REQUEST['sku']."'";
    } else {
      $xpress_query = " SELECT GROUP_CONCAT(sku.meta_value) AS 'sku' FROM wp_posts p JOIN wp_postmeta sku ON sku.post_id = p.id AND sku.meta_key = '_sku'
                        WHERE p.post_type = 'product' AND p.post_status = 'publish' AND p.post_title NOT LIKE '%panet%' AND p.post_title NOT LIKE '%bolsa%'";
      $xpress_result = $xpress_db->query($xpress_query)->fetchArray();
      $sku = " and CAST(sCodArt AS INT) in (".$xpress_result['sku'].")";
    }

    if ($delivery_type == "programmed"){
      $stocks_validate_query = "SELECT GROUP_CONCAT(sku.meta_value) AS 'sku' FROM wp_posts p JOIN wp_postmeta sku ON sku.post_id = p.id AND sku.meta_key = '_sku' JOIN wp_postmeta val ON val.post_id = p.id AND val.meta_key = 'always_check_stock'
                                WHERE p.post_type = 'product' AND p.post_status = 'publish' AND p.post_title NOT LIKE '%panet%' AND p.post_title NOT LIKE '%bolsa%' AND val.meta_value = 'yes'";
      $header = $xpress_db->query($stocks_validate_query)->fetchArray();
      if(!is_null($header['sku'])){
        $stock_query = "CASE WHEN CAST(sCodArt AS INT) IN (".$header['sku'].") THEN CAST(nStockFinalUnidad AS INT) ELSE 10000 end";
      } else {
        $stock_query = "10000";
      }
    }

    $sql = "SELECT CAST(sCodArt AS INT) as sku, " . $stock_query . " as stock
            FROM SALDOS
            where sFechaSaldo = '$date' and sCodCentro= $city_code" . $sku;

    $stmt = sqlsrv_query( $conn, $sql );
    if( $stmt === false) {
      die( print_r( sqlsrv_errors(), true) );
    }

    while( $row = sqlsrv_fetch_array( $stmt, SQLSRV_FETCH_ASSOC) ) {

      $reserved_query = " SELECT SUM(qt.meta_value) AS qty
                          FROM wp_posts p
                          LEFT JOIN wp_postmeta pm ON pm.post_id = p.id AND pm.meta_key = 'add_delivery_date'
                          LEFT JOIN wp_woocommerce_order_items oi ON p.id = oi.order_id AND order_item_type = 'line_item' AND order_item_name NOT LIKE '%bolsa%'
                          LEFT JOIN wp_woocommerce_order_itemmeta pr ON pr.order_item_id = oi.order_item_id AND pr.meta_key = '_product_id'
                          LEFT JOIN wp_postmeta sku ON sku.post_id = pr.meta_value AND sku.meta_key = '_sku'
                          LEFT JOIN wp_woocommerce_order_itemmeta qt ON qt.order_item_id = oi.order_item_id AND qt.meta_key = '_qty'
                          WHERE p.post_status = 'wc-processing' AND pm.meta_value <= '$date' AND sku.meta_value = " . $row['sku'] . " GROUP BY sku.meta_value;";

      $reserved = $xpress_db->query($reserved_query)->fetchArray();
      $reserved_qty = (!empty($reserved['qty']) && $row['stock'] < 10000) ? $reserved['qty'] : 0;

      array_push($response, array("sku" => $row['sku'], "stock" => max($row['stock'] - $reserved_qty, 0)));
    }
  } else {
    $response = array("status" => "error", "message" => "delivery_type is required");
  }
} else {
  $response = array("status" => "error", "message" => "state is required");
}

print_r(json_encode($response));
