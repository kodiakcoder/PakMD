<?php
session_start();
include'../application/config.php';

if($_POST['message1'])
{

//$query=mysqli_query($conn,"select * from dr_users");
//$res=mysqli_fetch_array($query);
$google_api_key="AAAAfN5W0dY:APA91bH-oKIpNgNptzVObPl84eUR2GomuF9Oaj1yobRUhGzoF5NJnj9WoaY87P8K1jHhB-UqASz3peLMhdl0dcBo95Lj9xtvZXpHGvY1uTxsk9ZH3w7KcgOuUqHbFOkB5pBEHE3t0Vl-";

// Notification Data
$query=mysqli_query($conn,"select * from clinic_tokendata");
$i=0;
$reg_id=array();
while ($res=mysqli_fetch_array($query))
{

$reg_id[$i]= $res['device_id'];
$i++;
}

$massage = $_POST['message1'];

    
    $registrationIds =  $reg_id ;
    $message = array('message' => $massage);
    $fields = array(
        'registration_ids'  => $registrationIds,
        'data'      => $message
    );
    //print_r($fields);

    //echo '<pre>',print_r($registrationIds,1),'</pre>';

    $url = 'https://fcm.googleapis.com/fcm/send';
    $headers = array(
        'Authorization: key='.$google_api_key,// . $api_key,
        'Content-Type: application/json'
    );
    $json =  json_encode($fields);
    //echo $json;
    $ch = curl_init();
   
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($ch, CURLOPT_POSTFIELDS,$json);

    $result = curl_exec($ch);
    //print_r($result); exit();
    
    if ($result === FALSE){
        die('Curl failed: ' . curl_error($ch));
    }   

    curl_close($ch);
    $response=json_decode($result,true);
    //print_r($response); exit();
    if($response['success']>0)
    {
        //echo "insert into dr_notification values(NULL,'".$massage."')"; exit;
        $notification="insert into clinic_sendnotification values(NULL,'".$massage."')";
        $insertres = mysqli_query($conn,$notification);
        if($insertres)
        {
            echo 1;
        }
    }
    else
    {
       echo 0;
    }

}
?>