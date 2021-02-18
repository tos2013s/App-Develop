<?php
$checkData = "";
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
}
else{
	$checkData.="not HTTP Methode. GET/POST\r\n";
}

// Check Data POST, GET . If have data = send line ntify
$sMessage ="\r\n";
$sMessage.= $checkData;
sendDevelop_test($sMessage);
sendDevelop_test($sMessage);
send_IOE_alert_line($sMessage);
function sendDevelop_test_alone($sMessage){
	$accToken = "Xc5gLo8IFM4b1t5GQII2oakRvEzxveFzsVUBr7iYrjj";  // Token develo test #2
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
}
function sendDevelop_test($sMessage){
	$accToken = "UwJJvP1lFFwR4AIOg89RaeMMy440L8UbioXZ6c1QJu1";  // Token develo test #1
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
}
function send_IOE_alert_line($sMessage){
	$accToken = "JcRoVLHkUadppVRzV4IwbOs8awh7LqwZdbZcYQgBlFE";  // IOE OFS alert #1
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
}
?>