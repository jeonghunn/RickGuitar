<?php
$authcode = $_POST['authcode'];
$kind = mysql_real_escape_string($_POST['kind']);
$user_srl = mysql_real_escape_string($_POST['user_srl']);
$user_srl_auth = mysql_real_escape_string($_POST['user_srl_auth']);
$title = mysql_real_escape_string($_POST['title']);
$content = mysql_real_escape_string($_POST['content']);
$permission = mysql_real_escape_string($_POST['permission']);
$status = mysql_real_escape_string($_POST['status']);
$privacy = mysql_real_escape_string($_POST['privacy']);
$log = "$title$$$permission$$$status$$$privacy";


define('642979',   TRUE);
require '../config.php';


//Check auth code
if($authcode != $auth) ErrorMessage("auth_error");

//Change Auth code to tarks account
require 'documents.php';


//Check Value security
Security_value_check($title);
Security_value_check($content);

//Read
if($kind == 0){

}

//Write
if($kind == 1) {
//	$content = urlencode ( $content );
	//REPLACE FIRST
		// str_replace("<enter>", "<br>", $content); 
		// str_replace("<enter>", "<br>", $content); 
	$document_write = document_write($user_srl, $user_srl_auth , $title, $content, $permission, $status, $privacy);
if($document_write == true){
	echo "document_write_succeed";
	
}else{
echo "document_write_error";
}
}

//Delete
if($kind == 2){

}



      
?>