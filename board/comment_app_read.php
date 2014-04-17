<?php
$authcode = $_POST['authcode'];
$user_srl = mysql_real_escape_string($_POST['user_srl']);
$user_srl_auth = mysql_real_escape_string($_POST['user_srl_auth']);
//Getlist
$doc_srl = mysql_real_escape_string($_POST['doc_srl']);
$start_comment = mysql_real_escape_string($_POST['start_comment']);
$comment_number = mysql_real_escape_string($_POST['comment_number']);
$comment_info = mysql_real_escape_string($_POST['comment_info']);

$log = "$doc_srl";
$log_category = "comment_read";


define('642979',   TRUE);
require '../config.php';


//Check auth code
if($authcode != $auth) ErrorMessage("auth_error");

//Change Auth code to tarks account
require 'comment_class.php';
require 'documents_class.php';


//Check Value security
Security_value_check($content);

//getList
//if($kind == 0){
$CommentList = comment_getList($user_srl_auth, $doc_srl, $start_comment, $comment_number);
comment_PrintList($user_srl_auth, $CommentList, ExplodeInfoValue($comment_info));
//}

//Read
// if($kind == 1) {
// $Doc_read = document_read($user_srl_auth, $doc_srl);
// print_info($Doc_read, ExplodeInfoValue($doc_info));
// }

//Delete
if($kind == 2){

}



      
?>