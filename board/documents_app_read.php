<?php
$authcode = $_POST['authcode'];
$kind = mysql_real_escape_string($_POST['kind']);
$user_srl = mysql_real_escape_string($_POST['user_srl']);
$user_srl_auth = mysql_real_escape_string($_POST['user_srl_auth']);
//Getlist
$doc_srl = mysql_real_escape_string($_POST['doc_srl']);
$doc_user_srl = mysql_real_escape_string($_POST['doc_user_srl']);
$start_doc = mysql_real_escape_string($_POST['start_doc']);
$doc_number = mysql_real_escape_string($_POST['doc_number']);
$doc_info = mysql_real_escape_string($_POST['doc_info']);

$log = "$doc_srl$$$doc_user_srl";



define('642979',   TRUE);
require '../config.php';


//Check auth code
if($authcode != $auth) ErrorMessage("auth_error");

//Change Auth code to tarks account
require 'documents_class.php';


//Check Value security
Security_value_check($title);
Security_value_check($content);

//getList
if($kind == 0){
$DocList = document_getList($user_srl_auth, $doc_user_srl, $start_doc, $doc_number);
document_PrintList($DocList, ExplodeInfoValue($doc_info));
}

//Readsummary
if($kind == 1) {

}

//Delete
if($kind == 2){

}



      
?>