
<?php
function retrieveJsonPostData()
  {
    // get the raw POST data
    $rawData = file_get_contents("php://input");
    // this returns null if not valid json
    return json_encode($jsonData, JSON_PRETTY_PRINT);
}
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: PUT, GET, POST, DELETE, OPTIONS');
header('Access-Control-Allow-Headers: Content-Type');
header("Content-Type: text/plain");

define('LINE_API',"https://notify-api.line.me/api/notify");
 
$token ="4dsVfCgR7LpqIGOooWHVYSzVYCg0QSAhtqy8mcdBOwV"; // develop for test
$sMessage .="\r\nswan industries\r\n";

//$WebParameter = null;
//$WebParameter .= $_POST['message'];
if ($_SERVER['REQUEST_METHOD'] == 'POST'){
  //$rawData = file_get_contents("php://input");
  //$WebParameter .= retrieveJsonPostData();//"POST \r\n";//$_POST['message'];
  //$WebParameter .= parse_str($rawData);
  //$WebParameter .= $_POST;
  //$WebParameter .= htmlspecialchars($_POST["message"]);//$_POST['{{message}}'];

  $WebParameter .= "REQUEST_METHOD POST \r\n"; // เข้าเงื่อนไข  post
  $WebParameter .= $_POST['message_value'];

}
else if ($_SERVER['REQUEST_METHOD'] == 'GET'){
  $WebParameter .= "GET";//$_GET['message'];  
}
else{
  $WebParameter .= ' no REQUEST_METHOD..GET / POST';
}

/*if(isset($_GET['message'])) {
    $WebParameter .= $_GET['message'];
} 
else {
    $WebParameter .= ' no GET..';
}*/

//$sMessage .= print($HTTP_RAW_POST_DATA);

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

function getPost()
{
    if(!empty($_POST))
    {
        // when using application/x-www-form-urlencoded or multipart/form-data as the HTTP Content-Type in the request
        // NOTE: if this is the case and $_POST is empty, check the variables_order in php.ini! - it must contain the letter P
        return $_POST;
    }
    // when using application/json as the HTTP Content-Type in the request 
    $post = json_decode(file_get_contents('php://input'), true);
    if(json_last_error() == JSON_ERROR_NONE)
    {
        return $post;
    }
    return [];
}
//print_r(getPost());
?>
