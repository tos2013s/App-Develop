<?php

$accToken = "UwJJvP1lFFwR4AIOg89RaeMMy440L8UbioXZ6c1QJu1";
$sMessage ="OFS Alert:\r\n";

/*$jsonALL = file_get_contents("https://covid19.th-stat.com/api/open/today");
$jsonz = preg_replace('/\r|\n/','\n',trim($jsonALL));
$jsonData = json_decode($jsonz, TRUE);
$sMessage .=json_encode($jsonData, JSON_PRETTY_PRINT);*/
$WebParameter ="";
if ($_SERVER['REQUEST_METHOD'] == 'POST'){
  $WebParameter .= "REQUEST_METHOD POST \r\n"; // เข้าเงื่อนไข  post
  //$WebParameter .= $_POST['message'];
  //$dataPOST = trim(file_get_contents('php://input'));
  //$xmlData = simplexml_load_string($dataPOST);
  $WebParameter .= print_r($_POST);
}
else if ($_SERVER['REQUEST_METHOD'] == 'GET'){
  $WebParameter .= "GET\r\n";//$_GET['message']; 
	
  $dataPOST = trim(file_get_contents('php://input'));
  //$xmlData = simplexml_load_string($dataPOST);
  //$WebParameter .= $xmlData;
}
else{
  $WebParameter .= ' no REQUEST_METHOD..GET / POST';
}
$allHeaders = getallheaders();
$contentType = $allHeaders['Content-Type'];

//$sMessage .=$contentType;
$sMessage .="\r\n";
$sMessage .= $WebParameter;

	$chOne = curl_init(); 
	curl_setopt( $chOne, CURLOPT_URL, "https://notify-api.line.me/api/notify"); 
	curl_setopt( $chOne, CURLOPT_SSL_VERIFYHOST, 0); 
	curl_setopt( $chOne, CURLOPT_SSL_VERIFYPEER, 0); 
	curl_setopt( $chOne, CURLOPT_POST, 1); 
	curl_setopt( $chOne, CURLOPT_POSTFIELDS, "message=".$sMessage); 
	$headers = array( 'Content-type: application/x-www-form-urlencoded', 'Authorization: Bearer '.$accToken.'', );
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
