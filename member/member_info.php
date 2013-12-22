<?

$authcode = $_POST['authcode'];
$user_srl = addslashes($_POST['user_srl']);
$user_srl_auth = addslashes($_POST['user_srl_auth']);
$lang = addslashes($_POST['lang']);
$member_info = addslashes($_POST['member_info']);

define('642979',   TRUE);
require '../db.php';
//mysql_select_db('favorite',$db_conn);

//Check Permission
if($authcode != $auth) exit();

//Auth code to user_srl
require '../auth.php';
$user_srl = AuthCheck($user_srl_auth, false);

// Save user info
   $add_info_to_system ="UPDATE `user` SET  `lang` = '$lang' ,`ip_addr` = '$REMOTE_ADDR' WHERE `user_srl` = $user_srl";
            $system_result = mysql_query($add_info_to_system);


//Cut the value
            $member_info_array = explode("//",$member_info);


         //Send Imformation
        $sql ="SELECT * FROM  `user` WHERE  `user_srl` LIKE '$user_srl'";
        $result = mysql_query($sql);
        $row=mysql_fetch_array($result);

// while (count($member_info_array)) {

// }

   for ($i=0 ; $i < count($member_info_array);$i++){
   	if(count($member_info_array) == $i + 1){
echo $row[$member_info_array[$i]];
}else{
	echo $row[$member_info_array[$i]]."/LINE/.";
   }

    //    echo "$row[tarks_account]/LINE/.$row[name_1]/LINE/.$row[name_2]/LINE/.$row[permission]/LINE/.$row[reg_id]/LINE/.$row[key]/LINE/.$row[like_me]/LINE/.$row[favorite]";
}
    
    

   
      
?>