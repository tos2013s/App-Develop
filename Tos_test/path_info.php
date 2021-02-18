<html>
<body>
<?php
echo $_GET['parameter'];
echo"<hr/>";
echo"<br/>";
/*$url = "https://www.preeyapong.com/PHP_webservice/php_image_upload/getStarChatPrivateShop.php";
//call api
$obj = json_decode(file_get_contents($url), true);
$json = json_decode($obj);
$id = $json->id;
$star_name = $json->star_name;
$image = $json->image;
echo "id: " . $id . ", name: " . $star_name. ", image: " . $image;*/

$json = '{"countryId":"84","productId":"1","status":"ok","op_id":"134"}';
$json = json_decode($json, true);
echo "countryId: ".$json['countryId']."<br/>";
echo "productId: ".$json['productId']."<br/>";
echo "status: ".$json['status']."<br/>";
echo "**********************************************************<br/>";
$url =  "https://www.preeyapong.com/PHP_webservice/Json.php";
$obj = file_get_contents($url);
$json2 = json_decode($obj,true);
echo "ทดสอบ: ". $json2['ทดสอบ']."<br/>";
echo "b: ". $json2['b']."<br/>";
echo "c". $json2['c']."<br/>";
echo "d". $json2['d']."<br/>";
echo "e". $json2['e']."<br/>";

echo"<br/>";
echo "https://www.preeyapong.com/PHP_webservice/Chat_PHP_Realtime/test.php";
//$req_body = json_decode($file_get_contents('php://input'));
//$req = json_decode($req_body,true);
//print_r($req);

?>
</body>
</html>