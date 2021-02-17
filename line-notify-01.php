<?php

$accToken = "4dsVfCgR7LpqIGOooWHVYSzVYCg0QSAhtqy8mcdBOwV";
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



$sMessage .= $WebParameter;


$res = notify_message($sMessage,$accToken);
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
