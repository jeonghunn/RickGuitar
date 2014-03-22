<?
$authcode = $_POST['authcode'];
$id = mysql_real_escape_string($_POST['id']);
$password = mysql_real_escape_string($_POST['password']);
$log = "$id";

define('642979',   TRUE);
require '../config.php';


//Check Auth
if($authcode != $auth) ErrorMessage("auth_error");

require 'member_info_class.php';

echo TarksAccountCheck($id, $password);

  
?>