<?php
$authcode = $_POST['authcode'];
$kind = mysql_real_escape_string($_POST['kind']);
$page_srl = mysql_real_escape_string($_POST['page_srl']);
$user_srl = mysql_real_escape_string($_POST['user_srl']);
$doc_srl = mysql_real_escape_string($_POST['doc_srl']);
$user_srl_auth = mysql_real_escape_string($_POST['user_srl_auth']);
$title = mysql_real_escape_string($_POST['title']);
$content = mysql_real_escape_string($_POST['content']);
$permission = mysql_real_escape_string($_POST['permission']);
$status = mysql_real_escape_string($_POST['status']);
$privacy = mysql_real_escape_string($_POST['privacy']);
$log = "$page_srl";
$log_category = "doc_write";

define('642979',   TRUE);
require '../config.php';


//Check auth code
if($authcode != $auth) ErrorMessage("auth_error");

//Change Auth code to tarks account
require '../member/member_class.php';
require '../member/push_class.php';
require 'documents_class.php';



//Update Status
if($kind == 0){
$document_status_update = document_status_update($doc_srl, $user_srl_auth, $status);
if($document_status_update == true){
	echo "document_update_succeed";
}else{
echo "document_update_error";
}
}

//Write
if($kind == 1) {
//	$content = urlencode ( $content );
	//REPLACE FIRST
		// str_replace("<enter>", "<br>", $content); 
		// str_replace("<enter>", "<br>", $content); 
	$document_write = document_write($page_srl, $user_srl_auth , $title, $content, $permission, $status, $privacy);
if($document_write == true){
	echo "document_write_succeed";
}else{
echo "document_write_error";
}
}



      
?>