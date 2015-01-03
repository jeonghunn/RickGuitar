<?php

$user_srl = $_GET['user_srl'];
$send_user_srl = $_GET['send_user_srl'];
$title = $_GET['title'];
$content = $_GET['content'];
$value = $_GET['value'];
$kind = $_GET['kind'];
$number = $_GET['number'];

define('642979',   TRUE);
require '../config.php';

sendPushMessage($user_srl, $send_user_srl, $title,  $content ,$value, $kind, $number);


 function getRegId($user_srl){
      //import user regid
    $reg_id_number = "SELECT reg_id FROM  `pages` WHERE  `user_srl` ='$user_srl'";
    $reg_id_result = mysql_query($reg_id_number);
    $reg_id =mysql_fetch_array($reg_id_result);
    
    return $reg_id['reg_id'];
 }



function sendPushMessage($user_srl, $send_user_srl, $title,  $content ,$value, $kind, $number) {



    $headers = array(
 'Content-Type:application/json',
 'Authorization:key=AIzaSyDwLoDb4Hkn0PEU0Kero0z3c4QBHZPZuzg'
);



  $reg =  array(getRegId($user_srl));
     $auth = "AIzaSyDwLoDb4Hkn0PEU0Kero0z3c4QBHZPZuzg";
    $request = array(
                     'collapse_key' => $kind."//".$number,
                     'registration_ids' => $reg,
                     'data' => array( 'data' => $send_user_srl."/LINE/.".$title."/LINE/.".$content."/LINE/.".$value),
                     );
    
    $headers = array(
                     "Content-Type:application/json",
                     "Authorization:key=".$auth
                     );
    
 // print("<XMP>");
 //  print(json_encode($request));
  // print("\n");
    
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, "https://android.googleapis.com/gcm/send");
    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($request));
    $result = curl_exec($ch);
    
   //print_r($result);
    curl_close($ch);
}


?>