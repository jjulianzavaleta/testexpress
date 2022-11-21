<?php
header("Content-type: application/json; charset=utf-8");
/*require 'simple_html_dom.php';
error_reporting(E_ALL ^ E_NOTICE);
	
$dni = $_POST['custom_question_text_dnirecojo'];

//OBTENEMOS EL VALOR
$consulta = file_get_html('http://aplicaciones007.jne.gob.pe/srop_publico/Consulta/Afiliado/GetNombresCiudadano?DNI='.$dni)->plaintext;

//LA LOGICA DE LA PAGINAS ES APELLIDO PATERNO | APELLIDO MATERNO | NOMBRES

$partes = explode("|", $consulta);


$datos = array(
		0 => $dni, 
		1 => $partes[0], 
		2 => $partes[1],
		3 => $partes[2],
);
*/

$dni = $_POST['dni'];
$url = "https://dniruc.apisperu.com/api/v1/dni/".$dni."?token=eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJlbWFpbCI6ImNkb21pbmd1ZXpsMjAxNkBnbWFpbC5jb20ifQ.zLznaRyAOu-LBNqVKFrHMcV9Q-4X6u0KVd-OGjJap4c";
$file_headers = @get_headers($url);

if ($_SERVER['SERVER_NAME'] == "localhost"){
	if(!$file_headers || $file_headers[0] == 'HTTP/1.0 404 Not Found' ||trim($file_headers[0]) == 'HTTP/1.1 403 Forbidden') {
	    $exists = false;
	}else{
	    $exists = true;
	}
	if($exists===true){

	    $response = file_get_contents($url);
	    echo $response;
	}else{
		$errorp = array("dni"=>"0");
		echo json_encode($errorp, JSON_FORCE_OBJECT);
	}
} else {
	$curl = curl_init($url);
	curl_setopt($curl, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
	curl_setopt($cURL, CURLOPT_RETURNTRANSFER, true);
	$result = curl_exec($curl);  
	curl_close($curl);
}

?>
