<?php

function getGUID(){
    if (function_exists('com_create_guid')){
        return com_create_guid();
    }else{
        mt_srand((double)microtime()*10000);//optional for php 4.2.0 and up.
        $charid = strtoupper(md5(uniqid(rand(), true)));
        $hyphen = chr(45);// "-"
        $uuid = chr(123)// "{"
            .substr($charid, 0, 8).$hyphen
            .substr($charid, 8, 4).$hyphen
            .substr($charid,12, 4).$hyphen
            .substr($charid,16, 4).$hyphen
            .substr($charid,20,12).$hyphen
            .chr(125);// "}"
        $uuid = substr($uuid, 1, 36);
        return $uuid;
    }
}
function create_json_post($post){
            $request="{";
            for ($i=0; $i < count($post) ; $i++) { 
                $llave = key($post);
                $valor = $post[$llave];
                if($i==count($post)-1){
                    $request = $request. "\"$llave\":\"$valor\"";
                }else{
                    $request = $request. "\"$llave\":\"$valor\",";
                }
                next($post);
            }
            $request = $request."}";
            return $request;
}

function contador(){
    $archivo = "contador.txt"; 
    $contador = 0; 
    $fp = fopen($archivo,"r"); 
    $contador = fgets($fp, 26); 
    fclose($fp); 
    ++$contador; 
    $fp = fopen($archivo,"w+"); 
    fwrite($fp, $contador, 26); 
    fclose($fp); 
    return $contador;
}

function securitykey($environment,$merid,$accessk,$seckey){
    switch ($environment) {
        case 'prd':
            $merchantId = $merid;
            $url = "https://apiprod.vnforapps.com/api.security/v1/security";
            $accessKey=$accessk;
            $secretKey=$seckey;
            break;
        case 'dev':
            $merchantId = $merid;
            $url = "https://apitestenv.vnforapps.com/api.security/v1/security";
            $accessKey=$accessk;
            $secretKey=$seckey;
            break;
    }
    $header = array("Content-Type: application/json");
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
    curl_setopt($ch, CURLOPT_USERPWD, "$accessKey:$secretKey");
    curl_setopt($ch, CURLOPT_HEADER, FALSE);
    curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");
    #curl_setopt($ch, CURLOPT_POST, TRUE);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
    #curl_setopt($ch, CURLOPT_POSTFIELDS, $request_body);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
    $key = curl_exec($ch);
    return $key;
}

function guarda_sessionToken($sessionToken){
    $archivo = "sessionToken.txt";  
    $fp = fopen($archivo,"w+"); 
    fwrite($fp, $sessionToken, 96); 
    fclose($fp); 
}
function recupera_sessionToken(){
    $archivo = "sessionToken.txt"; 
    $fp = fopen($archivo,"r"); 
    $valor = fgets($fp, 96);  
    fclose($fp); 
    return $valor;
}

function guarda_sessionKey($sessionKey){
    $archivo = "sessionKey.txt";  
    $fp = fopen($archivo,"w+"); 
    fwrite($fp, $sessionKey, 96); 
    fclose($fp); 
}

function recupera_sessionKey(){
    $archivo = "sessionKey.txt"; 
    $fp = fopen($archivo,"r"); 
    $valor = fgets($fp, 96);  
    fclose($fp); 
    return $valor;
}

function authorization_recurrence($environment,$key,$amount,$merchantId,$transactionToken,$purchaseNumber, $moneda, $productID, $pagoInicial, $frecuencia, $tipo){
    switch ($environment) {
        case 'prd':
            $url = "https://apiprod.vnforapps.com/api.authorization/v3/authorization/ecommerce/".$merchantId;
            break;
        case 'dev':
            $url = "https://apitestenv.vnforapps.com/api.authorization/v3/authorization/ecommerce/".$merchantId;
            break;
    }
    $header = array("Content-Type: application/json","Authorization: $key");
    $pagoInicial = $pagoInicial =='' ? 0 : $pagoInicial;
    $request_body="{
		
		\"antifraud\" : null,
        \"captureType\" : \"manual\",
        \"channel\" : \"web\",
        \"contable\" : true,
        \"cardHolder\" : {
            \"documentNumber\" : \"87654321\",
            \"documentType\" : \"0\"
        },
        \"order\" : {
            \"amount\" : \"$pagoInicial\",
            \"tokenId\" : \"$transactionToken\",
            \"purchaseNumber\" : \"$purchaseNumber\",
            \"currency\" : \"$moneda\",
            \"productId\" : \"$productID\"
        },
        \"recurrence\" : {
            \"amount\" : \"$amount\",
            \"beneficiaryId\" : \"$purchaseNumber\",
            \"frequency\" : \"$frecuencia\",
            \"maxAmount\" : \"$amount\",
            \"type\" : \"$tipo\"
        },
        \"terminalId\" : \"1\",
        \"terminalUnattended\" : false
		
    }";
    // var_dump($request_body);
    // die();
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
    //curl_setopt($ch, CURLOPT_USERPWD, "$accessKey:$secretKey");
    curl_setopt($ch, CURLOPT_HEADER, FALSE);
    curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
    curl_setopt($ch, CURLOPT_POST, TRUE);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $request_body);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
    $response = curl_exec($ch);
    $json = json_decode($response);
    $json = json_encode($json, JSON_PRETTY_PRINT);
    //$dato = $json->sessionKey;
    // var_dump($json);
    // die();
    return $json;
}

function authorization($environment,$key,$amount,$merchantId,$transactionToken,$purchaseNumber, $moneda){
    switch ($environment) {
        case 'prd':
            $url = "https://apiprod.vnforapps.com/api.authorization/v3/authorization/ecommerce/".$merchantId;
            break;
        case 'dev':
            $url = "https://apitestenv.vnforapps.com/api.authorization/v3/authorization/ecommerce/".$merchantId;
            break;
    }
    $header = array("Content-Type: application/json","Authorization: $key");
    $request_body="{
		
		\"antifraud\" : null,
        \"captureType\" : \"manual\",
        \"channel\" : \"web\",
        \"contable\" : true,
        \"order\" : {
            \"amount\" : \"$amount\",
            \"tokenId\" : \"$transactionToken\",
            \"purchaseNumber\" : \"$purchaseNumber\",
            \"currency\" : \"$moneda\"
        },
        \"terminalId\" : \"1\",
        \"terminalUnattended\" : false
		
    }";
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
    //curl_setopt($ch, CURLOPT_USERPWD, "$accessKey:$secretKey");
    curl_setopt($ch, CURLOPT_HEADER, FALSE);
    curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
    curl_setopt($ch, CURLOPT_POST, TRUE);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $request_body);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
    $response = curl_exec($ch);
    $json = json_decode($response);
    $json = json_encode($json, JSON_PRETTY_PRINT);
    //$dato = $json->sessionKey;
    return $json;
}

function create_token_recurrence($environment,$amount,$key,$merchantId,$accessKey,$secretKey, $pagoInicial){
    switch ($environment) {
        case 'prd':
            $url = "https://apiprod.vnforapps.com/api.ecommerce/v2/ecommerce/token/session/{$merchantId}";
            break;
        case 'dev':
            $url = "https://apitestenv.vnforapps.com/api.ecommerce/v2/ecommerce/token/session/{$merchantId}";
            break;
    }
    $header = array("Content-Type: application/json","Authorization: $key");
    $request_body="{
        \"amount\":{$pagoInicial},
		\"channel\" : \"web\",
        \"antifraud\" : {
            \"clientIp\" : \"192.168.22.11\",
            \"merchantDefineData\" : {
                \"MDD1\" : \"web\",
                \"MDD2\" : \"Canl\",
                \"MDD3\" : \"Canl\"
            }
        },
        \"recurrenceMaxAmount\":{$amount}
    }";
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
    //curl_setopt($ch, CURLOPT_USERPWD, "$accessKey:$secretKey");
    curl_setopt($ch, CURLOPT_HEADER, FALSE);
    curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
    curl_setopt($ch, CURLOPT_POST, TRUE);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $request_body);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
    $response = curl_exec($ch);
    $json = json_decode($response);
    $dato = $json->sessionKey;
    return $dato;
}

function create_token($environment,$amount,$key,$merchantId,$accessKey,$secretKey){
    switch ($environment) {
        case 'prd':
            $url = "https://apiprod.vnforapps.com/api.ecommerce/v2/ecommerce/token/session/{$merchantId}";
            break;
        case 'dev':
            $url = "https://apitestenv.vnforapps.com/api.ecommerce/v2/ecommerce/token/session/{$merchantId}";
            break;
    }
    $header = array("Content-Type: application/json","Authorization: $key");
    $request_body="{
        \"amount\":{$amount},
		\"channel\" : \"web\",
        \"antifraud\" : {
            \"clientIp\" : \"192.168.22.11\",
            \"merchantDefineData\" : {
                \"MDD1\" : \"web\",
                \"MDD2\" : \"Canl\",
                \"MDD3\" : \"Canl\"
            }
        }
    }";
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
    //curl_setopt($ch, CURLOPT_USERPWD, "$accessKey:$secretKey");
    curl_setopt($ch, CURLOPT_HEADER, FALSE);
    curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
    curl_setopt($ch, CURLOPT_POST, TRUE);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $request_body);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
    $response = curl_exec($ch);
    $json = json_decode($response);
    $dato = $json->sessionKey;
    return $dato;
}


function post_form($array_post,$url){
    $html="<html>
    <head>
    </head>
    <Body onload=\"f1.submit();\">
    <form name=\"f1\" method=\"post\" action=\"{$url}\">";
    for ($i=0; $i < count($array_post) ; $i++) { 
        $llave = key($array_post);
        $valor = $array_post[$llave];
        $html = $html."<input type=\"hidden\" name=\"$llave\" value=\"$valor\" />";
        next($array_post);
    }
    $html = $html."</form>
    </body>
    </html>";
    return $html;
}

function getMotivo($id){
    $motivos = array(101 => "(101) Operación Denegada. Tarjeta Vencida. Verifique los datos en su tarjeta e ingréselos correctamente.",
					102 => "(102) Operación Denegada. Contactar con entidad emisora de su tarjeta. ",
					104 => "(104) Operación Denegada. Operación no permitida para esta tarjeta. Contactar con la entidad emisora de su tarjeta. ",
					106 => "(106) Operación Denegada. Intentos de clave secreta excedidos. Contactar con la entidad emisora de su tarjeta. ",
					107 => "(107) Operación Denegada. Contactar con la entidad emisora de su tarjeta. ",
					108 => "(108) Operación Denegada. Contactar con la entidad emisora de su tarjeta. ",
					109 => "(109) Operación Denegada. Contactar con el comercio. ",
					110 => "(110) Operación Denegada. Operación no permitida para esta tarjeta. Contactar con la entidad emisora de su tarjeta. ",
					111 => "(111) Operación Denegada. Contactar con el comercio. ",
					112 => "(112) Operación Denegada. Se requiere clave secreta. ",
					113 => "(113) Monto no permitido ",
					116 => "(116) Operación Denegada. Fondos insuficientes. Contactar con entidad emisora de su tarjeta ",
					117 => "(117) Operación Denegada. Clave secreta incorrecta. ",
					118 => "(118) Operación Denegada. Tarjeta Inválida. Contactar con entidad emisora de su tarjeta. ",
					119 => "(119) Operación Denegada. Intentos de clave secreta excedidos. Contactar con entidad emisora de su tarjeta. ",
					121 => "(121) Operación Denegada. ",
					126 => "(126) Operación Denegada. Clave secreta inválida. ",
					129 => "(129) Operación Denegada. Código de seguridad invalido. Contactar con entidad emisora de su tarjeta ",
					180 => "(180) Operación Denegada. Tarjeta Inválida. Contactar con entidad emisora de su tarjeta. ",
					181 => "(181) Operación Denegada. Tarjeta con restricciones de débito. Contactar con entidad emisora de su tarjeta. ",
					182 => "(182) Operación Denegada. Tarjeta con restricciones de crédito. Contactar con entidad emisora de su tarjeta. ",
					183 => "(183) Operación Denegada. Problemas de comunicación. Intente más tarde. ",
					190 => "(190) Operación Denegada. Contactar con entidad emisora de su tarjeta. ",
					191 => "(191) Operación Denegada. Contactar con entidad emisora de su tarjeta. ",
					192 => "(192) Operación Denegada. Contactar con entidad emisora de su tarjeta. ",
					199 => "(199) Operación Denegada. ",
					201 => "(201) Operación Denegada. Tarjeta vencida. Contactar con entidad emisora de su tarjeta. ",
					202 => "(202) Operación Denegada. Contactar con entidad emisora de su tarjeta ",
					204 => "(204) Operación Denegada. Operación no permitida para esta tarjeta. Contactar con entidad emisora de su tarjeta. ",
					206 => "(206) Operación Denegada. Intentos de clave secreta excedidos. Contactar con la entidad emisora de su tarjeta. ",
					207 => "(207) Operación Denegada. Contactar con entidad emisora de su tarjeta.. ",
					208 => "(208) Operación Denegada. Contactar con entidad emisora de su tarjeta. ",
					209 => "(209) Operación Denegada. Contactar con entidad emisora de su tarjeta ",
					263 => "(263) Operación Denegada. Contactar con el comercio. ",
					264 => "(264) Operación Denegada. Entidad emisora de la tarjeta no está disponible para realizar la autenticación. ",
					265 => "(265) Operación Denegada. Clave secreta del tarjetahabiente incorrecta. Contactar con entidad emisora de su tarjeta. ",
					266 => "(266) Operación Denegada. Tarjeta Vencida. Contactar con entidad emisora de su tarjeta. ",
					280 => "(280) Operación Denegada. Clave secreta errónea. Contactar con entidad emisora de su tarjeta. ",
					290 => "(290) Operación Denegada. Contactar con entidad emisora de su tarjeta. ",
					300 => "(300) Operación Denegada. Número de pedido del comercio duplicado. Favor no atender. ",
					306 => "(306) Operación Denegada. Contactar con entidad emisora de su tarjeta. ",
					401 => "(401) Operación Denegada. Contactar con el comercio. ",
					402 => "(402) Operación Denegada. ",
					403 => "(403) Operación Denegada. Tarjeta no autenticada. ",
					404 => "(404) Operación Denegada. Contactar con el comercio. ",
					405 => "(405) Operación Denegada. Contactar con el comercio. ",
					406 => "(406) Operación Denegada. Contactar con el comercio. ",
					407 => "(407) Operación Denegada. Contactar con el comercio. ",
					408 => "(408) Operación Denegada. Código de seguridad no coincide. Contactar con entidad emisora de su tarjeta ",
					409 => "(409) Operación Denegada. Código de seguridad no procesado por la entidad emisora de la tarjeta ",
					410 => "(410) Operación Denegada. Código de seguridad no ingresado. ",
					411 => "(411) Operación Denegada. Código de seguridad no procesado por la entidad emisora de la tarjeta  ",
					412 => "(412) Operación Denegada. Código de seguridad no reconocido por la entidad emisora de la tarjeta ",
					413 => "(413) Operación Denegada. Contactar con entidad emisora de su tarjeta. ",
					414 => "(414) Operación Denegada. ",
					415 => "(415) Operación Denegada. ",
					416 => "(416) Operación Denegada. ",
					417 => "(417) Operación Denegada. ",
					418 => "(418) Operación Denegada. ",
					419 => "(419) Operación Denegada. ",
					420 => "(420) Operación Denegada. Tarjeta no es VISA. ",
					421 => "(421) Operación Denegada. Contactar con entidad emisora de su tarjeta. ",
					422 => "(422) Operación Denegada. El comercio no está configurado para usar este medio de pago. Contactar con el comercio. ",
					423 => "(423) Operación Denegada. Se canceló el proceso de pago. ",
					424 => "(424) Operación Denegada. ",
					666 => "(666) Operación Denegada. Problemas de comunicación. Intente más tarde. ",
					667 => "(667) Operación Denegada. Transacción sin respuesta de Verified by Visa. ",
					668 => "(668) Operación Denegada. Contactar con el comercio. ",
					669 => "(669) Operación Denegada. Contactar con el comercio. ",
					670 => "(670) Operación Denegada. Contactar con el comercio. ",
					672 => "(672) Operación Denegada. Módulo antifraude. ",
					673 => "(673) Operación Denegada. Contactar con el comercio. ",
					674 => "(674) Operación Denegada. Contactar con el comercio. ",
					676 => "(676) Operación Denegada. Contactar con el comercio. ",
					677 => "(677) Operación Denegada. Contactar con el comercio. ",
					678 => "(678) Operación Denegada. Contactar con el comercio. ",
					904 => "(904) Operación Denegada. ",
					909 => "(909) Operación Denegada. Problemas de comunicación. Intente más tarde. ",
					910 => "(910) Operación Denegada. ",
					912 => "(912) Operación Denegada. Entidad emisora de la tarjeta no disponible ",
					913 => "(913) Operación Denegada. ",
					916 => "(916) Operación Denegada. ",
					928 => "(928) Operación Denegada. ",
					940 => "(940) Operación Denegada. ",
					941 => "(941) Operación Denegada. ",
					942 => "(942) Operación Denegada. ",
					943 => "(943) Operación Denegada. ",
					945 => "(945) Operación Denegada. ",
					946 => "(946) Operación Denegada. Operación de anulación en proceso. ",
					947 => "(947) Operación Denegada. Problemas de comunicación. Intente más tarde. ",
					948 => "(948) Operación Denegada. ",
					949 => "(949) Operación Denegada. ",
					965 => "(965) Operación Denegada. Contactar con entidad emisora. ",
					
					///
					754 => "(754) Comercio o terminal no valido. "
					);
return $motivos[$id];
}
?>