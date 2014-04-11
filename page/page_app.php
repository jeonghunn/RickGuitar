<?
$authcode = $_POST['authcode'];
$page_srl = mysql_real_escape_string($_POST['page_srl']);
$user_srl = mysql_real_escape_string($_POST['user_srl']);
$user_srl_auth = mysql_real_escape_string($_POST['user_srl_auth']);
//$page_info = mysql_real_escape_string($_POST['page_info']);
$log = $page_srl;

define('642979',   TRUE);
require '../config.php';

//Check Auth
if($authcode != $auth) ErrorMessage("auth_error");


require '../core/private.php';
require 'page_class.php';
require '../member/member_class.php';


//Get Profile information
 $PageInfoRow = PageInfo($page_srl, $page_srl);
 //Print Profile information
 print_array($PageInfoRow);

?>