<?php
//$dateData=time(); // วันเวลาขณะนั้น
//echo thai_date_and_time($dateData); // 19 ธันวาคม 2556 เวลา 10:17:48
//$newDate = thai_date_and_time($dateData);

$accToken = "UwJJvP1lFFwR4AIOg89RaeMMy440L8UbioXZ6c1QJu1";
$sMessage = "\r\nรายงานสถานการณ์ โควิด-19\r\nAPI free Covid-19\r\n";
$sMessage.="https://covid19.th-stat.com/th/api \r\n";

//$jsonALL = file_get_contents("https://covid19.th-stat.com/api/open/today");
//$jsonz = preg_replace('/\r|\n/','\n',trim($jsonALL));
//$jsonData = json_decode($jsonz, TRUE);
//$sMessage .=json_encode($jsonData, JSON_PRETTY_PRINT);

$url =  "https://covid19.th-stat.com/api/open/today";  // API Convic-19 ToDay
$obj = file_get_contents($url);
$json = json_decode($obj,true);
$sMessage.= "Date: ".date("Y-m-d H:i:s");
$sMessage.= "Confirmed: ". $json['Confirmed']."\r\n";
$sMessage.= "Recovered: ". $json['Recovered']."\r\n";
$sMessage.= "Hospitalized: ". $json['Hospitalized']."\r\n";
$sMessage.= "Deaths: ". $json['Deaths']."\r\n";
$sMessage.= "NewConfirmed: ". $json['NewConfirmed']."\r\n";
$sMessage.= "NewRecovered: ". $json['NewRecovered']."\r\n";
$sMessage.= "NewHospitalized: ". $json['NewHospitalized']."\r\n";
$sMessage.= "Source: https://covid19.th-stat.com/ \r\n";
$sMessage.= "DevBy: https://www.kidkarnmai.com/\r\n";
$sMessage.= "SeverBy: https://smilehost.asia/ \r\n";

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
