<?php
$authcode = $_POST['authcode'];
$id = mysql_real_escape_string($_POST['id']);
$password = mysql_real_escape_string($_POST['password']);



$log = "$id";
$log_category = "tarks_account_check";

define('642979',   TRUE);
require '../config.php';


//Check Auth
if($authcode != $auth) ErrorMessage("auth_error");

require 'member_class.php';

echo TarksAccountCheck($id, $password);

  
?>