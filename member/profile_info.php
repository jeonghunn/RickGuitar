<?
$authcode = $_POST['authcode'];
$user_srl = mysql_real_escape_string($_POST['user_srl']);
$user_srl_auth = mysql_real_escape_string($_POST['user_srl_auth']);
$profile_user_srl = mysql_real_escape_string($_POST['profile_user_srl']);
$member_info = mysql_real_escape_string($_POST['member_info']);
$log = $profile_user_srl;

define('642979',   TRUE);
require '../db.php';

//Check Auth
if($authcode != $auth) exit(); 

require '../auth.php';
require '../core/private.php';
require 'member_info.php';


//Get Profile information
 $ProfileInfoRow = ProfileInfo($user_srl_auth, $profile_user_srl, $member_info);
 //Print Profile information
 Print_member_info($ProfileInfoRow, ExplodeMemberInfoValue($member_info));

?>