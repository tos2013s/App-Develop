<?php
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: PUT, GET, POST, DELETE, OPTIONS');
header('Access-Control-Allow-Headers: Content-Type');

	ini_set('display_errors', 1);
	ini_set('display_startup_errors', 1);
	error_reporting(E_ALL);
	date_default_timezone_set("Asia/Bangkok");

	$sToken = "Xc5gLo8IFM4b1t5GQII2oakRvEzxveFzsVUBr7iYrjj"; // develop alone
	$sMessage ="swan industries\r\n";




/*foreach ($_SERVER as $key => $value) {
    if (strpos($key, 'HTTP_') === 0) {
        $chunks = explode('_', $key);
        $header = '';
        for ($i = 1; $y = sizeof($chunks) - 1, $i < $y; $i++) {
            $header .= ucfirst(strtolower($chunks[$i])).'-';
        }
        $header .= ucfirst(strtolower($chunks[$i])).': '.$value;
        echo $header."\n";
    }
}*/
function getPostObject() {
    $str = file_get_contents('php://input');
    $std = json_decode($str);
    if ($std === null) {
        $std = new stdClass();
        $array = explode('&', $str);
        foreach ($array as $parm) {
            $parts = explode('=', $parm);
            if(sizeof($parts) != 2){
                continue;
            }
            $key = $parts[0];
            $value = $parts[1];
            if ($key === NULL) {
                continue;
            }
            if (is_string($key)) {
                $key = urldecode($key);
            } else {
                continue;
            }
            if (is_bool($value)) {
                $value = boolval($value);
            } else if (is_numeric($value)) {
                $value += 0;
            } else if (is_string($value)) {
                if (empty($value)) {
                    $value = null;
                } else {
                    $lower = strtolower($value);
                    if ($lower === 'true') {
                        $value = true;
                    } else if ($lower === 'false') {
                        $value = false;
                    } else if ($lower === 'null') {
                        $value = null;
                    } else {
                        $value = urldecode($value);
                    }
                }
            } else if (is_array($value)) {
                // value is an array
            } else if (is_object($value)) {
                // value is an object
            }
            $std->$key = $value;
        }
        // length of post array
        //$std->length = sizeof($array);
    }
    return $std;
}

$sMessage .= getPostObject(); //print_r($_REQUEST);

	
	$chOne = curl_init(); 
	curl_setopt( $chOne, CURLOPT_URL, "https://notify-api.line.me/api/notify"); 
	curl_setopt( $chOne, CURLOPT_SSL_VERIFYHOST, 0); 
	curl_setopt( $chOne, CURLOPT_SSL_VERIFYPEER, 0); 
	curl_setopt( $chOne, CURLOPT_POST, 1); 
	curl_setopt( $chOne, CURLOPT_POSTFIELDS, "message=".$sMessage); 
	$headers = array( 'Content-type: application/x-www-form-urlencoded', 'Authorization: Bearer '.$sToken.'', );
	curl_setopt($chOne, CURLOPT_HTTPHEADER, $headers); 
	curl_setopt( $chOne, CURLOPT_RETURNTRANSFER, 1); 
	$result = curl_exec( $chOne ); 

	//Result error 
	if(curl_error($chOne)) 
	{ 
		echo 'error:' . curl_error($chOne); 
	} 
	else { 
		//$result_ = json_decode($result, true); 
		//echo "status : ".$result_['status']; echo "message : ". $result_['message'];
		echo "meassage ok.";
	} 
	curl_close( $chOne );

?>
