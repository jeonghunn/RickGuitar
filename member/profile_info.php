<?
require_once 'pages/base.php';

//deprecated at 2014-10-28
$API_VERSION = (int) $_POST['apiv'];
$user_srl = mysql_real_escape_string($_POST['user_srl']);
$user_srl_auth = mysql_real_escape_string($_POST['user_srl_auth']);
$profile_user_srl = mysql_real_escape_string($_POST['profile_user_srl']);
$page_info = mysql_real_escape_string($_POST['member_info']);


$log = $profile_user_srl;
$log_category = "profile_read";
define('642979',   TRUE);
require '../config.php';



require '../core/status.php';
require 'member_class.php';


//Get Profile information
 $ProfileInfoRow = PageInfo($user_srl, $profile_user_srl, ExplodeInfoValue($page_info));
 //Print Profile information
 print_info($ProfileInfoRow, ExplodeInfoValue($page_info));

if($API_VERSION == 0){
	 echo "/LINE/.".setRelationStatus($user_srl, $profile_user_srl)."/LINE/.".setRelationStatus($profile_user_srl, $user_srl);
}

?>