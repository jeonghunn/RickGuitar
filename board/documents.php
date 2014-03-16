<?php if(!defined("642979")) exit();

function document_read($user_srl, $lang){

}


function document_write($user_srl, $user_srl_auth , $title, $content, $permission, $status, $privacy){
	global $date, $REMOTE_ADDR;
$result = mysql_query("INSERT INTO `documents` (`user_srl`, `name`, `title`, `content`, `date`, `permission`, `status`, `privacy`, `ip_addr`) VALUES ('$user_srl', '$name', '$title', '$content', '$date', '$permission', '$status', '$privacy', '$REMOTE_ADDR');");
//echo mysql_error();
return $result;
}

function document_edit($user_srl, $lang){

}

function document_delete($user_srl, $lang){

}
   
      
?>