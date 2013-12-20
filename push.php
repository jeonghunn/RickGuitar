<?
$headers = array(
 'Content-Type:application/json',
 'Authorization:key=AIzaSyDwLoDb4Hkn0PEU0Kero0z3c4QBHZPZuzg'
);

define('642979',   TRUE);
require 'db.php';
mysql_select_db('favorite',$db_conn);

//import user last number
$last_number = "SELECT user FROM  `count` WHERE  `user` >=0";
$insert_number_result = mysql_query($last_number);
$number_row =mysql_fetch_array($insert_number_result);

//repeat notice send action to all users.
for ($i=0;$i<=$number_row[user];$i++){
 
    //import user regid
    $reg_id_number = "SELECT reg_id FROM  `user` WHERE  `user_srl` ='$i'";
    $reg_id_result = mysql_query($reg_id_number);
    $reg_id =mysql_fetch_array($reg_id_result);
    
    
    //reg_id
    $reIds = array($reg_id[reg_id]);
    
    $auth = "AIzaSyDwLoDb4Hkn0PEU0Kero0z3c4QBHZPZuzg";
    
    sendMessage($auth, $reIds);
    
    
    echo "Success";
    
}
function sendMessage($auth, $reg) {
    $request = array(
                     'registration_ids' => $reg,
                     'data' => array('누군가가 당신을 좋아하는 사람으로 등록했습니다.' => '휴대폰 번호로 찾기'),
                     );
    
    $headers = array(
                     "Content-Type:application/json",
                     "Authorization:key=".$auth
                     );
    
    print("<XMP>");
    print(json_encode($request));
    print("\n");
    
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, "https://android.googleapis.com/gcm/send");
    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($request));
    $result = curl_exec($ch);
    
    print_r($result);
    curl_close($ch);
}


?>