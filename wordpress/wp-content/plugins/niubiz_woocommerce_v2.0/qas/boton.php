﻿<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="user-scalable=no, width=device-width, initial-scale=1.0" />
	<title>Bot&oacute;n de pago</title>
</head>
<body>

<?php
include "librerias/funciones.php";
//include 'librerias/lib.inc';
if (isset($_POST['transactionToken'])){
	echo $sessionToken = recupera_sessionToken();
	$transactionToken = $_POST['transactionToken'];
	setcookie("transactionToken",$transactionToken);
	echo "<pre>";
	var_dump($_POST);
	echo "<pre>";
	$respuesta = authorization("dev","101266802",$transactionToken,"AKIAJPOQZ7BAXJZ5K35A","Ur+U0pn1bkjRhPGz+G+OLNjqIi7OBlwkZ2eTHySG",$sessionToken);
	echo "<pre>";
	var_dump($respuesta);
	echo "<pre>";
	
	$sal = json_decode($respuesta, true);

	echo "HAA : ".$sal['data']['RESPUESTA'];
}

if (isset($_POST['sessionToken'])){
	echo "Configuración del botón<br>";
	echo $merchanId = $_POST['merchantId'];
	$amount = $_POST['amount'];
	$entorno = $_POST['entorno'];
	switch ($entorno) {
		case 'dev':
			$urljs="https://static-content-qas.vnforapps.com/v2/js/checkout.js?qa=true";
			break;
		case 'prd':
			$urljs="https://static-content.vnforapps.com/v1/js/checkout.js";
			break;
	}
	
	echo "<br>";
	echo $sessionToken = $_POST['sessionToken'];
	echo "<br>";
	echo $numorden = contador();
	$formulario="
	<form action=\"boton.php\" method='post'>
		<script src=\"$urljs\"
			data-sessiontoken=\"$sessionToken\"
			data-merchantid=\"$merchanId\"
			data-buttonsize=\"\"
			data-buttoncolor=\"\" 
			data-merchantlogo =\"https://compuusa.com.pe/img/leo-shopping-logo-1479769105.jpg\"
			data-merchantname=\"\"
			data-formbuttoncolor=\"#0A0A2A\"
			data-showamount=\"\"
			data-purchasenumber=\"$numorden\"
			data-amount=\"$amount\"
			data-cardholdername=\"ROGER\"
			data-cardholderlastname=\"PECHO\"
			data-cardholderemail=\"rogerfrankp@gmail.com\"
			data-usertoken=\"\"
			data-recurrence=\"false\"
			data-frequency=\"Quarterly\"
			data-recurrencetype=\"fixed\"
			data-recurrenceamount=\"200\"
			data-documenttype=\"0\"
			data-documentid=\"\"
			data-beneficiaryid=\"TEST1123\"
			data-productid=\"\"
			data-phone=\"\"
		/></script>
	</form>";
	echo $formulario;
	exit;
}
?>
</body>
</html>