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
/*if($json = json_decode(file_get_contents("php://input"), true)) {
    print_r($json);
    $data = $json;
} else {
    print_r($_POST);
    $data = $_POST;
}*/
$raw_payload = file_get_contents('php://input', true);
$payload = json_decode($raw_payload, true);
foreach ($payload as $value) {
    $sMessage .= $value, "\n";
}
/*if($payload){
  $myfile = fopen("log.txt", "a+") or die("Unable to open file!");
  fwrite(date('Y-m-d H:i:s', time()).PHP_EOL);
  fclose($myfile);
}*/


	
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
