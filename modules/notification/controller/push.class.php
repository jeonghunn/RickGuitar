<?php if(!defined("642979")) exit();


class PushClass
{



function sendPushMessage($user_srl, $send_user_srl, $title,  $content ,$value, $category)
{





    $reg = array($this -> getRegId($user_srl));
$datajson = json_encode(array('category' => $category, 'value' => $value, 'send_user_srl' => $send_user_srl,  'title' => $title, 'content' => $content));
    //$data_array
    $request = array(
        'collapse_key' => $category . "//" . $value,
        'registration_ids' => $reg,
        'data' => array('data' => $datajson),
    );



    $this->sendPushMessageAct($request);

}

 function getRegId($user_srl){
      //import user regid
    $reg_id_number = "SELECT reg_id FROM  `pages` WHERE  `srl` ='$user_srl'";
    $reg_id_result = DBQuery($reg_id_number);
    $reg_id =mysqli_fetch_array($reg_id_result);

    return $reg_id[reg_id];
 }
  
    function sendPushMessageAct($request){

        $headers = array(
            'Content-Type:application/json',
            'Authorization:key=AIzaSyDwLoDb4Hkn0PEU0Kero0z3c4QBHZPZuzg'
        );

        $auth = "AIzaSyDwLoDb4Hkn0PEU0Kero0z3c4QBHZPZuzg";

        $headers = array(
            "Content-Type:application/json",
            "Authorization:key=" . $auth
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

        // print_r($result);
        curl_close($ch);
    }




}

