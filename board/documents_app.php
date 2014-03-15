<?php if(!defined("642979")) exit();
$authcode = $_POST['authcode'];
$kind = mysql_real_escape_string($_POST['kind']);
$user_srl = mysql_real_escape_string($_POST['user_srl']);
$user_srl_auth = mysql_real_escape_string($_POST['user_srl_auth']);
$title = mysql_real_escape_string($_POST['title']);
$content = mysql_real_escape_string($_POST['content']);
$permission = mysql_real_escape_string($_POST['permission']);
$status = mysql_real_escape_string($_POST['status']);
$privacy = mysql_real_escape_string($_POST['privacy']);


define('642979',   TRUE);
require '../db.php';
//mysql_select_db('favorite',$db_conn);


//Check auth code
if($authcode != $auth) exit();

//Change Auth code to tarks account
require '../auth.php';
require 'documents.php';

//Check Value security
Security_value_check($title);
Security_value_check($content);

//Read
if($kind == 0){

}

//Write
if($kind == 1) document_write($user_srl, $user_srl_auth , $title, $content, $permission, $status, $privacy);

//Delete
if($kind == 2){

}



      
?>