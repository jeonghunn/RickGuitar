<?php
$authcode = $_POST['authcode'];
$user_srl_auth = mysql_real_escape_string($_POST['user_srl_auth']);
$kind = mysql_real_escape_string($_POST['kind']);
$value = mysql_real_escape_string($_POST['value']);
$log = $value;
$log_category = $kind;


define('642979',   TRUE);
require '../config.php';


//Check auth code
if($authcode != $auth) ErrorMessage("auth_error");

//Change Auth code to tarks account
require 'member_class.php';

if($kind == 'get_page_auth'){
echo getPageAuth($user_srl, $value);
}

?>
