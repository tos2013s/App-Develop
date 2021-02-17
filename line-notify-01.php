<?php
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: PUT, GET, POST, DELETE, OPTIONS');
header('Access-Control-Allow-Headers: Content-Type');
header("Content-Type: text/plain");

define('LINE_API',"https://notify-api.line.me/api/notify");
 
$token ="4dsVfCgR7LpqIGOooWHVYSzVYCg0QSAhtqy8mcdBOwV"; // develop for test
$sMessage .="\r\nswan industries\r\n";
$sMessage ="subject\r\n";
$WebParameter = null;

if ($_SERVER['REQUEST_METHOD'] == 'POST'){
	$WebParameter .= $_POST['message'];
}
else if ($_SERVER['REQUEST_METHOD'] == 'GET'){
	$WebParameter .= $_GET['message'];	
}
else{
	$WebParameter .= 'no REQUEST_METHOD..GET';
}


$sMessage .= "\r\n".$WebParameter;
$res = notify_message($sMessage,$token);
print_r($res);

function notify_message($message,$token){
 $queryData = array('message' => $message);
 $queryData = http_build_query($queryData,'','&');
 $headerOptions = array( 
         'http'=>array(
            'method'=>'POST',
            'header'=> "Content-Type: application/x-www-form-urlencoded\r\n"
                      ."Authorization: Bearer ".$token."\r\n"
                      ."Content-Length: ".strlen($queryData)."\r\n",
            'content' => $queryData
         ),
 );
 $context = stream_context_create($headerOptions);
 $result = file_get_contents(LINE_API,FALSE,$context);
 $res = json_decode($result);
 return $res;
}

?>
