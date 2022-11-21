<?php
header("Content-type: application/json; charset=utf-8");

$type = $_REQUEST["type"];
$document = $_REQUEST['document'];

if(isset($document) && isset($type) && (($type == "dni" && strlen($document) == 8) || ($type == "ruc" && strlen($document) == 11))){

	$url = "https://dniruc.apisperu.com/api/v1/$type/$document?token=eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJlbWFpbCI6ImNkb21pbmd1ZXpsMjAxNkBnbWFpbC5jb20ifQ.zLznaRyAOu-LBNqVKFrHMcV9Q-4X6u0KVd-OGjJap4c";
	
	$curl = curl_init($url);
	curl_setopt($curl, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
	curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
	$result = curl_exec($curl);  
	curl_close($curl);
	if (strlen($result) != 0){
		if(!isset(json_decode($result)->success)){
			echo $result;
		} else {
			$errorp = array("status"=>"no-results");
			echo json_encode($errorp, JSON_FORCE_OBJECT);
		}
	} else {
		$errorp = array("status"=>"no-results");
		echo json_encode($errorp, JSON_FORCE_OBJECT);
	}
} else {
	$errorp = array("status"=>"error");
	echo json_encode($errorp, JSON_FORCE_OBJECT);
}
?>