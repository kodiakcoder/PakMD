<?php
include '../controllers/apicontrollers.php';
$apicontroller=new Apicontrollers();
$city=$apicontroller->getallcity();
if($city)
{
    $arr[]=array("status"=>"Success","Cities"=>$city);
    echo json_encode($arr);
}
else
{
    echo '[{"status":"Failed","Error":"City Not Found"}]';
}




?>