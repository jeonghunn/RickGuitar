<?php if(!defined("642979")) exit();

function document_read($user_srl, $lang){

}


function document_write($user_srl, $user_srl_auth , $title, $content, $permission, $status, $privacy){
	global $date, $REMOTE_ADDR;
mysql_query("INSERT INTO `user` (`user_srl`, `name`, `title`, `date`, `permission`, `status`, `privacy` ,`ip_addr`) VALUES ('$user_srl', '$name', '$title', '$date', '3', '1', '0', '$REMOTE_ADDR');");
}

function document_edit($user_srl, $lang){

}

function document_delete($user_srl, $lang){

}
   
      
?>