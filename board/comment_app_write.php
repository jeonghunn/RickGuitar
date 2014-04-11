<?php
$authcode = $_POST['authcode'];
$kind = mysql_real_escape_string($_POST['kind']);
$doc_srl = mysql_real_escape_string($_POST['doc_srl']);
$user_srl = mysql_real_escape_string($_POST['user_srl']);
$user_srl_auth = mysql_real_escape_string($_POST['user_srl_auth']);
$content = mysql_real_escape_string($_POST['content']);
$permission = mysql_real_escape_string($_POST['permission']);
$privacy = mysql_real_escape_string($_POST['privacy']);
$log = "$doc_srl";
$log_category = "comment_write";

define('642979',   TRUE);
require '../config.php';


//Check auth code
if($authcode != $auth) ErrorMessage("auth_error");

//Change Auth code to tarks account
require '../member/member_class.php';
require '../member/push_class.php';
require 'comment_class.php';
require 'documents_class.php';


//Check Value security
Security_value_check($content);

//Update
if($kind == 0){

}

//Write
if($kind == 1) {
//	$content = urlencode ( $content );
	//REPLACE FIRST
		// str_replace("<enter>", "<br>", $content); 
		// str_replace("<enter>", "<br>", $content); 
	$comment_write = comment_write($doc_srl, $user_srl_auth, $content, $permission, $privacy);
if($comment_write == true){
	echo "comment_write_succeed";
	
}else{
echo "comment_write_error";
}
}




      
?>