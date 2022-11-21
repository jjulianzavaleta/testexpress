<?php 

    // define( 'SHORTINIT', true );
    require_once( '../../../wp-load.php' );

    $json = file_get_contents('php://input');
    $data = json_decode($json);

    $cip = $data->cip;
    $nroPedido = $data->operationNumber;
    $status = $data->status;

    global $wpdb, $woocommerce;
    $nombreTabla = $wpdb->prefix . "niubiz_pagoefectivo";
    $sql = "
        SELECT ID, idPedido from $nombreTabla where cip = $cip
    ";
    $result = $wpdb->get_results($sql);

    // echo $result[0]->idPedido;

    $order = new WC_Order($result[0]->idPedido);
    // Actualizar orden
    $order->update_status($status=='Paid'?'processing':'failed');
    $order->add_order_note("operationNumber: {$nroPedido}\nstatus: {$status}");
    if ($status == 'Paid') {$order->reduce_order_stock();}
    // Actualizar BD
    $wpdb->update($nombreTabla,
    array(
      'nroPedido' => $nroPedido,
      'status' => $status
    ),
    array( 'ID' => $result[0]->ID ));

?>