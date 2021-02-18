<?php
$checkData = "";
//$data = file_get_contents('php://input');
$data = file_get_contents('https://swan.ofsxpress.com/admin/manager/service/index.php');
$fp = fopen("log.txt","a+");
fwrite($fp,$data);
fclose($fp);

if ($_SERVER['REQUEST_METHOD'] == 'POST'){
	$msg_id_post = $_POST['msg_id'];
	$msg_post = $_POST['message'];
	if (!empty($msg_id_post)){
		$checkData.= $msg_id_post;
	}
	else if (!empty($msg_post)){
		$checkData.= $msg_post;
	}
	else{
		$checkData.="not data POST\r\n";
	}
	
	$data2 = urldecode($msg_id_post);
	$fpp = fopen("logPost2.txt","a+");
	fwrite($fpp,$data2);
	fclose($fpp);

	$data3 = urldecode($msg_post);
	$fppp = fopen("logPost3.txt","a+");
	fwrite($fppp,$data3);
	fclose($fppp);
}
else if ($_SERVER['REQUEST_METHOD'] == 'GET'){
	$msg_id_get = $_GET['msg_id'];
	$msg_get = $_GET['message'];
	if (!empty($msg_id_get)){
		$checkData.= $msg_id_get;
	}
	else if (!empty($msg_get)){
		$checkData.= $msg_get;
	}
	else{
		$checkData.="not data GET\r\n";
	}
	
	$get_data2 = urldecode($msg_id_get);
	$fpp = fopen("logGet2.txt","a+");
	fwrite($fpp,$get_data2);
	fclose($fpp);

	$get_data3 = urldecode(msg_get);
	$fppp = fopen("logGet3.txt","a+");
	fwrite($fppp,$get_data3);
	fclose($fppp);
}
else{
	$checkData.="not HTTP Methode. GET/POST\r\n";
}

// Check Data POST, GET . If have data = send line ntify
$accToken = "Xc5gLo8IFM4b1t5GQII2oakRvEzxveFzsVUBr7iYrjj";  // Token develo test #2
$sMessage ="OFS Alert:\r\n";

$sMessage.= $checkData;

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