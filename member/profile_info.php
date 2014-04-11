<?
$authcode = $_POST['authcode'];
$user_srl = mysql_real_escape_string($_POST['user_srl']);
$user_srl_auth = mysql_real_escape_string($_POST['user_srl_auth']);
$profile_user_srl = mysql_real_escape_string($_POST['profile_user_srl']);
$member_info = mysql_real_escape_string($_POST['member_info']);
$log = $profile_user_srl;
$log_category = "profile_read";
define('642979',   TRUE);
require '../config.php';

//Check Auth
if($authcode != $auth) ErrorMessage("auth_error");


require '../core/status.php';
require 'member_class.php';


//Get Profile information
 $ProfileInfoRow = ProfileInfo($user_srl_auth, $profile_user_srl, $member_info);
 //Print Profile information
 print_info($ProfileInfoRow, ExplodeInfoValue($member_info));
 echo "/LINE/.".setRelationStatus($user_srl, $profile_user_srl)."/LINE/.".setRelationStatus($profile_user_srl, $user_srl);
?>