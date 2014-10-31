<?php if(!defined("642979")) exit();

class APIClass{

	function hello_world(){
echo "Hello World!";
}


function load_app($user_srl){
$member_info = mysql_real_escape_string($_REQUEST['member_info']);
//Update new member information
    PageInfoUpdate($user_srl);

  print_info(GetPageInfo($user_srl), ExplodeInfoValue($member_info));
}



function getPageInfo($user_srl){
  require 'core/status.php';

$page_srl = mysql_real_escape_string($_REQUEST['page_srl']);
$member_info = mysql_real_escape_string($_REQUEST['member_info']);

//Get Profile information
 $ProfileInfoRow = PageInfo($user_srl, $page_srl, ExplodeInfoValue($member_info));
 //Print Profile information
 print_info($ProfileInfoRow, ExplodeInfoValue($member_info));
}




}




?>