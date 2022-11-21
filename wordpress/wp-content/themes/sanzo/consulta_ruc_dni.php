<?php
header("Content-type: application/json; charset=utf-8");

$ruc = $_POST['custom_question_text_ruc'];
$url = "https://dniruc.apisperu.com/api/v1/ruc/".$ruc."?token=eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJlbWFpbCI6ImNkb21pbmd1ZXpsMjAxNkBnbWFpbC5jb20ifQ.zLznaRyAOu-LBNqVKFrHMcV9Q-4X6u0KVd-OGjJap4c";
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
		$errorp = array("ruc"=>"0");
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
