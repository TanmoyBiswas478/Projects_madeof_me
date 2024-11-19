<?php 
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET,POST,PATCH,PUT,DELETE,OPTINS');
header('Access-Control-Allow-Headers: Origin,Content-Type,X-Auth-Token');

$data=json_decode(file_get_contents("php://input"));
$to=$data->to;
$subject = $data->subject;
$txt = nl2br($data->txt);
$headers = "From: donotreply.bishtam@gmail.com";
if(mail($to,$subject,$txt,$headers))
{
 echo "Mail Send Successfully....";
}
else{
    echo "Error...";
}
?>