<?
$authcode = $_POST['authcode'];
$page_srl = mysql_real_escape_string($_POST['page_srl']);
$user_srl = mysql_real_escape_string($_POST['user_srl']);
$user_srl_auth = mysql_real_escape_string($_POST['user_srl_auth']);
$page_info = mysql_real_escape_string($_POST['page_info']);
$log = $profile_user_srl;

define('642979',   TRUE);
require '../config.php';

//Check Auth
if($authcode != $auth) ErrorMessage("auth_error");


require '../core/private.php';
require 'member_info_class.php';


//Get Profile information
 $ProfileInfoRow = ProfileInfo($user_srl_auth, $profile_user_srl, $member_info);
 //Print Profile information
 Print_member_info($ProfileInfoRow, ExplodeMemberInfoValue($member_info));

?>