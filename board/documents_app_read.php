                                                                                                                 <?php
require_once '../core/base.php';

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

//Userupdatecontents
$users_srl = mysql_real_escape_string($_POST['users_srl']);

$log = "$doc_srl";
$log_category = "doc_read";


define('642979',   TRUE);
require '../config.php';


//Check auth code
if($authcode != $auth) ErrorMessage("auth_error");

//Change Auth code to tarks account
require '../member/member_class.php';
require 'documents_class.php';
require 'attach_class.php';

//Check Value security
Security_value_check($title);
Security_value_check($content);

//getList
if($kind == 0){
$DocList = document_getList($user_srl, $doc_user_srl, $start_doc, $doc_number);
document_PrintList($DocList, ExplodeInfoValue($doc_info));
}

//Read
if($kind == 1) {
$Doc_read = document_read($user_srl, $doc_srl);
print_info($Doc_read, ExplodeInfoValue($doc_info));
 echo "/LINE/.".getDocStatus($user_srl, $doc_srl);
}
//Delete
if($kind == 2){

}

//update
if($kind == 3){

}

//getuserupdatecontent
if($kind == 4){
$userupdatecontent = document_getUserUpdateList($user_srl, ExplodeInfoValue($users_srl));
document_printUserUpdateList($userupdatecontent);
}
//file_attach_read
if($kind == 5){
attach_read_print($user_srl, $doc_srl);
}

      
?>