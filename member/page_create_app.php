<?php
$authcode = $_POST['authcode'];
$user_srl = mysql_real_escape_string($_POST['user_srl']);
$user_srl_auth = mysql_real_escape_string($_POST['user_srl_auth']);
$name = mysql_real_escape_string($_POST['name']);
$lang = mysql_real_escape_string($_POST['lang']);
$country = mysql_real_escape_string($_POST['country']);
$profile_pic = mysql_real_escape_string($_POST['profile_pic']);
$log = "page_create";
$log_category = "page_create";


define('642979',   TRUE);
require '../config.php';


//Check auth code
if($authcode != $auth) ErrorMessage("auth_error");

//Change Auth code to tarks account
require_once '../core/Thumbnail.class.php';
require '../favorite/favorite_class.php';
require 'member_class.php';
require 'join_class.php';
require 'push_class.php';


$create_page = CreatePage($user_srl, $name, $lang, $country, $profile_pic);

echo $create_page[0];
?>
