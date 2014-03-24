<?if(!defined("642979")) exit();

//Auth code to user_srl
//$user_srl = AuthCheck($user_srl_auth, false);

function MemberInfoUpdate($user_srl, $lang){
	global $REMOTE_ADDR;
   $add_info_to_system = "UPDATE `user` SET  `lang` = '$lang' ,`ip_addr` = '$REMOTE_ADDR' WHERE `user_srl` = $user_srl";
            $system_result = mysql_query($add_info_to_system);
}


function GetMemberInfo($user_srl){

return mysql_fetch_array(mysql_query("SELECT * FROM  `user` WHERE  `user_srl` LIKE '$user_srl'"));
}

//IF use this function you must import auth.php and private.php
function ProfileInfo($user_srl_auth, $profile_user_srl, $member_info){

$user_srl = AuthCheck($user_srl_auth, false);
//Get Member Info
$row = GetMemberInfo($profile_user_srl);
// IF not ownself
if($user_srl != $profile_user_srl){
	
if(Guest_access_profile($member_info) == false) {  
   ErrorMessage("permission_error");
} 

}
return $row;
}


function TarksAccountCheck($id, $password){
    ConnectDB("xe");
  //Protect from sql injection
if(!rtnSpecialCharCheck($id.$password)) ErrorMessage("security_error");
if($id == null || $password == null) ErrorMessage("security_error");
$row = mysql_fetch_array(mysql_query("SELECT * FROM  `xe_member` WHERE  `user_id` LIKE '$id' AND  `password` LIKE '$password'"));
if($id == $row[user_id]){
//Connect main db to auth
ConnectMainDB();
  $auth_code_result = MakeAuthCode("15", $row[user_id], "tarks_account");
  //Echo Auth code to client
//auth_code_result is value of result of auth
}
return $auth_code_result;
}
    

   
      
?>