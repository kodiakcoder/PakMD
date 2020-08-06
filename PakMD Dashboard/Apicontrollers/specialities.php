<?php
include '../controllers/apicontrollers.php';
$apicontroller=new Apicontrollers();
extract($_GET);
if(isset($category_id) && $category_id != ""){
    $specialities = $apicontroller->getspecialities($category_id);
    if($specialities)
    {
        $arr[]=array("status"=>"Success","Specialities"=>$specialities);
        echo json_encode($arr);
    }
    else
    {
        echo '[{"status":"Failed","Error":"Specialities Not Found"}]';
    }
}
else
{
    echo '[{"status":"Failed","Error":"Category Id Is Required"}]';
}


?>