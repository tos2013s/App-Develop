<?php

if($_SERVER['REQUEST_METHOD'] == "POST"){
	$data = array("status" => 0, "msg" => $_POST['ss']);
}
else{
	$data = array("status" => 0, "msg" => "Request method not accepted");
}

	$notifyURL = "https://notify-api.line.me/api/notify";
	$accToken = 'Xc5gLo8IFM4b1t5GQII2oakRvEzxveFzsVUBr7iYrjj';
	
	$chOne = curl_init(); 
	curl_setopt( $chOne, CURLOPT_URL, $notifyURL); 
	curl_setopt( $chOne, CURLOPT_SSL_VERIFYHOST, 0); 
	curl_setopt( $chOne, CURLOPT_SSL_VERIFYPEER, 0); 
	curl_setopt( $chOne, CURLOPT_POST, 1); 
	curl_setopt( $chOne, CURLOPT_POSTFIELDS, "message=".$data); 
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
		$result_ = json_decode($result, true); 
		echo "status : ".$result_['status']; echo "message : ". $result_['message'];
		echo "meassage ok.";
	} 
	curl_close( $chOne );


?>
