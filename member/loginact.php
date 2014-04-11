<?php
session_start();
define('642979',   TRUE);
require '../config.php';

//Auth code to user_srl

require 'member_class.php';

 $id = mysql_real_escape_string($_POST['id']);
$password = mysql_real_escape_string($_POST['password']);
session_start();
$user_srl_auth = TarksAccountLogin($id , $password);
if($user_srl_auth != "null"){
$_SESSION['user_srl_auth'] = $user_srl_auth;
}else{

}
?>
<meta http-equiv='refresh' content='0;url=../index.php'>