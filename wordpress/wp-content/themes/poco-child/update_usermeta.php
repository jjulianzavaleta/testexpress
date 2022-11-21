<?php
header("Content-type: application/json; charset=utf-8");
date_default_timezone_set('America/Lima');
// include database and object files
include_once 'database.php';

// parameters by environment
if ($_SERVER['SERVER_NAME'] == "10.152.1.15") {
  $dbhost_xpress = 'mariadb';
  $dbuser_xpress = 'exampleuser';
  $dbpass_xpress = 'examplepass';
  $dbname_xpress = 'exampledb';
} else if ($_SERVER['SERVER_NAME'] == "testxpress.chimuagropecuaria.com.pe") {
  $dbhost_xpress = 'localhost';
  $dbuser_xpress = 'root';
  $dbpass_xpress = 'q,su6K)sz[';
  $dbname_xpress = 'wordpress_qas';
} else if ($_SERVER['SERVER_NAME'] == "xpress.chimuagropecuaria.com.pe") {
  $dbhost_xpress = 'localhost';
  $dbuser_xpress = 'root';
  $dbpass_xpress = 'q,su6K)sz[';
  $dbname_xpress = 'wordpress';
} else {
  $response = array("status" => "error", "message" => "no environment");
  print_r(json_encode($response));
  exit();
}

$fields = ['shipping_delivery_type', 'shipping_address_1', 'shipping_address_2', 'shipping_urbanization', 'shipping_city', 'shipping_state', 'shipping_reference', 'shipping_lat_gmaps', 'shipping_lng_gmaps'];
$count = 0;
// get xpress db connection
$xpress_db = new Database($dbhost_xpress, $dbuser_xpress, $dbpass_xpress, $dbname_xpress);

if(!empty($_REQUEST['user_id'])){
  $user_id = $_REQUEST['user_id'];
  $shipping_lat_gmaps= '-8.1085162';
  $shupping_lng_gmaps= '-79.0179694';
  if(!empty($_REQUEST['shipping_delivery_type']) && !empty($_REQUEST['shipping_address_1']) && !empty($_REQUEST['shipping_address_2']) &&
     !empty($_REQUEST['shipping_urbanization']) && !empty($_REQUEST['shipping_city']) && !empty($_REQUEST['shipping_state']) &&
     !empty($_REQUEST['shipping_reference']) && !empty($_REQUEST['shipping_lat_gmaps']) && !empty($_REQUEST['shipping_lng_gmaps'])){
    
    foreach ($fields as $field) {
      $new_val = $_REQUEST[$field];

      $search_sql = "SELECT meta_value FROM wp_usermeta WHERE meta_key = '$field' AND user_id = $user_id;";
      $exist_row = $xpress_db->query($search_sql)->numRows();
      
      if($exist_row){
        $update_insert_sql = "UPDATE wp_usermeta SET meta_value = '$new_val' WHERE user_id = $user_id AND meta_key = '$field'";
      } else {
        $update_insert_sql = "INSERT INTO wp_usermeta (user_id, meta_key, meta_value) VALUES ($user_id, '$field', '$new_val')";
      }

      $affectedRows = $xpress_db->query($update_insert_sql)->affectedRows();
      $count += $affectedRows;
    }
    if($count > 0){
      $response = array("status" => "success", "message" => "fields updated for user");
    } else {
      $response = array("status" => "success", "message" => "no fields updated for user");
    }
  } else {
    $response = array("status" => "error", "message" => "p_shipping_delivery_type and p_shipping_address_1 and p_shipping_address_2 and p_shipping_urbanization and p_shipping_city and p_shipping_state and p_shipping_reference and p_shipping_lat_gmaps and p_shipping_lng_gmaps are all required");
  }
} else {
  $response = array("status" => "error", "message" => "user id is required");
}

print_r(json_encode($response));
