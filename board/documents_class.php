<?php if(!defined("642979")) exit();

function document_read($user_srl_auth, $doc_srl){
	$user_srl = AuthCheck($user_srl_auth, false);
 $status = setRelationStatus($user_srl, $doc_user_srl);

return mysql_fetch_array(mysql_query("SELECT * FROM  `documents` WHERE  `srl` AND  `status` <=$status LIKE '$doc_srl'"));
}

//Find lastest number.
 function DocLastNumber(){
  $table_status =mysql_fetch_array(mysql_query("SHOW TABLE STATUS LIKE 'documents'"));
  return $table_status['Auto_increment'];  
 }



function document_write($page_srl, $user_srl_auth , $title, $content, $permission, $status, $privacy){
	global $date, $REMOTE_ADDR;
	$user_srl = AuthCheck($user_srl_auth, false);
	$relation_status = setRelationStatus($user_srl, $page_srl);
	$user_info = GetMemberInfo($user_srl);
	$name = SetUserName($user_info[lang], $user_info[name_1], $user_info[name_2]);
	$last_number = DocLastNumber();
$result = mysql_query("INSERT INTO `documents` (`page_srl`, `user_srl`, `name`, `title`, `content`, `date`, `permission`, `status`, `privacy`, `ip_addr`) VALUES ('$page_srl', '$user_srl', '$name', '$title', '$content', '$date', '$permission', '$status', '$privacy', '$REMOTE_ADDR');");
document_send_push($page_srl, $user_srl, $name, $last_number);
//echo mysql_error();
	
return $result;
}

function document_edit($user_srl, $lang){

}

function document_delete($user_srl, $lang){

}


function document_send_push($page_srl, $user_srl, $name, $number){
if ($user_srl != $page_srl) sendPushMessage($page_srl, $user_srl, $name, "새 글을 남겼습니다.", 1, $number);
}

function document_getList($user_srl_auth, $doc_user_srl, $start, $number){
	$user_srl = AuthCheck($user_srl_auth, false);
  $status = setRelationStatus($user_srl, $doc_user_srl);
 return mysql_query("SELECT * FROM  `documents` WHERE  `page_srl` =$doc_user_srl AND  `status` <=$status ORDER BY  `documents`.`srl` DESC LIMIT $start , $number");
}


function document_PrintList($row, $doc_info){
	 $total= mysql_num_rows ( $row );
	for($i=0 ; $i < $total; $i++){
               mysql_data_seek($row, $i);           //포인터 이동
             $result=mysql_fetch_array($row);        //레코드를 배열로 저장
             echo print_info($result, $doc_info)."/DOC/.";
}         
}
   
      
?>