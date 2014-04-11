<?if(!defined("642979")) exit();

//Auth code to user_srl
//$user_srl = AuthCheck($user_srl_auth, false);

function MemberInfoUpdate($user_srl, $lang){
	global $REMOTE_ADDR;
   $add_info_to_system = "UPDATE `user` SET `ip_addr` = '$REMOTE_ADDR' WHERE `user_srl` = $user_srl";
            $system_result = mysql_query($add_info_to_system);
}

function ProfileInfoUpdate($user_srl, $title, $value){
	global $REMOTE_ADDR;
   $add_info_to_system = "UPDATE `user` SET `$title` = '$value' WHERE `user_srl` = $user_srl";
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
$row = AccessMemberInfo(setRelationStatus($user_srl, $profile_user_srl), $row, $profile_user_srl, ExplodeInfoValue($member_info));
  

return $row;
}

   function ProfileUpdate($file_name) {
   	global $date;
$target_path = "../files/profile/";
$thumbnail_path = "../files/profile/thumbnail/";
$tmp_img = explode("." ,$_FILES['uploadedfile']['name']); 
//$img_name = $file_name.".".$tmp_img[1];
$img_name = $file_name."."."jpg";
$target_path = $target_path . basename($img_name);

 $upload_result = move_uploaded_file($_FILES['uploadedfile']['tmp_name'], $target_path);
  Thumbnail::create($target_path,
            120, 120,
            SCALE_EXACT_FIT,
            Array(
              'savepath' => $thumbnail_path.$img_name
            ));
ProfileInfoUpdate($file_name, "profile_update", $date);
ProfileInfoUpdate($file_name, "profile_pic", "Y");
return $upload_result;
      }


function TarksAccountLogin($id, $password){
$password = md5($password);
	$loginResult = TarksAccount($id, $password);

if($loginResult){
	$user_info = mysql_fetch_array(mysql_query("SELECT * FROM  `user` WHERE  `tarks_account` LIKE '$id'"));
}



return  FindAuthCode($user_info[user_srl], "user_srl");
}

function TarksAccount($id, $password){
if(!rtnSpecialCharCheck($id.$password)) ErrorMessage("security_error");
if($id == null || $password == null) ErrorMessage("security_error");
 ConnectDB("xe");
 $row = mysql_fetch_array(mysql_query("SELECT * FROM  `xe_member` WHERE  `user_id` LIKE '$id' AND  `password` LIKE '$password'"));
 ConnectMainDB();
 if($id == $row[user_id]) return true;
 return false;
}


function TarksAccountCheck($id, $password){
$loginResult = TarksAccount($id, $password);
if($loginResult){
//Connect main db to auth
  $auth_code_result = MakeAuthCode("15", $id, "tarks_account");
  //Echo Auth code to client
//auth_code_result is value of result of auth
}
return $auth_code_result;
}
    

   
      
?>