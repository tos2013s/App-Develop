<?php
	ini_set('display_errors', 1);
	ini_set('display_startup_errors', 1);
	error_reporting(E_ALL);
	date_default_timezone_set("Asia/Bangkok");

	$sToken = "Xc5gLo8IFM4b1t5GQII2oakRvEzxveFzsVUBr7iYrjj"; // develop alone
	$sMessage .="swan industries\r\n";
	//$sMessage .= askForRequestedArguments();

/*if (!function_exists('apache_request_headers')) {
        function apache_request_headers() {
            foreach($_SERVER as $key=>$value) {
                if (substr($key,0,5)=="HTTP_") {
                    $key=str_replace(" ","-",ucwords(strtolower(str_replace("_"," ",substr($key,5)))));
                    $out[$key]=$value;
                }else{
                    $out[$key]=$value;
        }
            }
            return $out;
        }
	$sMessage .= apache_request_headers();
}*/
//$id = $this->getRequest()->getParam("message",'');
/*$_SERVER['REQUEST_URI_PATH'] = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$pathSegments = explode('/', $_SERVER['REQUEST_URI_PATH']);*/
//$postdata = file_get_contents("php://input");
//$body = print_r($_POST, true);
foreach ($_POST as $key => $value) 
    $body .= $key . ' -> ' . $value . '\n';

header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: PUT, GET, POST, DELETE, OPTIONS');
header('Access-Control-Allow-Headers: Content-Type');
if(isset($_POST['incidentDetails']))
{
   $from_service = 'Responce from server:  ' . $_POST['incidentDetails'];
}
$sMessage .= $from_service;

	
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
