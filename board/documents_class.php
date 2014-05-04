<?php if(!defined("642979")) exit();

function document_read($user_srl_auth, $doc_srl){
	$user_srl = AuthCheck($user_srl_auth, false);
	$row = mysql_fetch_array(mysql_query("SELECT * FROM  `documents` WHERE  `srl` LIKE '$doc_srl'"));
mysql_query("UPDATE `documents` SET `views` = $row[views] + 1 WHERE `srl` = '$doc_srl'");
 $status = getDocStatus($user_srl, $doc_srl);

if($status < $row[status]) $row = false;

return $row;
}

//Find lastest number.
 function DocLastNumber(){
  $table_status = mysql_fetch_array(mysql_query("SHOW TABLE STATUS LIKE 'documents'"));
  return $table_status['Auto_increment'];  
 }

 function document_status_update($doc_srl, $user_srl_auth, $status){
	global $date, $REMOTE_ADDR;
	$user_srl = AuthCheck($user_srl_auth, false);
    $status_relation = getDocStatus($user_srl, $doc_srl);
    if($status_relation == 4){
	 $result = mysql_query("UPDATE `documents` SET `status` = '$status'   WHERE `srl` = '$doc_srl'");
}else{
	$result = false;
}
return $result;
 }


function getDocStatus($user_srl, $doc_srl){
//doc owner
$doc_owner = getDocOwner($doc_srl);
$doc_page_owner = getDocPageOwner($doc_srl);

	//Check Status
	if($user_srl != $doc_owner){
	$status = setRelationStatus($user_srl, $doc_page_owner);
}else{
	$status = 4;
}

return $status;

}

function getDocOwner($doc_srl){
	return getDocInfo($doc_srl, "user_srl");
}

function getDocPageOwner($doc_srl){
	return getDocInfo($doc_srl, "page_srl");
}

function getDocInfo($doc_srl, $info){
	$result =mysql_fetch_array(mysql_query("SELECT * FROM  `documents` WHERE  `srl` =$doc_srl"));
return $result[$info];
}


function document_update($doc_srl, $user_srl_auth , $namearray, $valuearray){
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


//require attach_class.php
function document_write($page_srl, $user_srl_auth , $title, $content, $permission, $status, $privacy){
	global $date, $REMOTE_ADDR;
//Check Value security
security_value_check($title);
security_value_check($content);
//Start
	$user_srl = AuthCheck($user_srl_auth, false);
	$relation_status = setRelationStatus($user_srl, $page_srl);
	$user_info = GetMemberInfo($user_srl);
	$page_info = GetMemberInfo($page_srl);
	$name = SetUserName($user_info[lang], $user_info[name_1], $user_info[name_2]);
	$last_number = DocLastNumber();
	if($content != "" && $relation_status != -1 && $relation_status >= $page_info[write_status] && $page_srl != 0) {
$attach_result = attach_file($page_srl, $last_number, $user_srl, $status);
$result = mysql_query("INSERT INTO `documents` (`page_srl`, `user_srl`, `name`, `title`, `content`, `date`, `permission`, `status`, `privacy`,  `attach`,  `ip_addr`) VALUES ('$page_srl', '$user_srl', '$name', '$title', '$content', '$date', '$permission', '$status', '$privacy', '$attach_result ? 1 : 0', '$REMOTE_ADDR');");

//Set last update
mysql_query("UPDATE `user` SET `last_update` = '$date'   WHERE `user_srl` = '$page_srl'");
//Push
document_send_push($page_srl, $user_srl, $name,  $content, $last_number);
}
//echo mysql_error();
	
return $result;
}

function document_edit($user_srl, $lang){

}

function document_delete($user_srl, $lang){

}


function document_send_push($page_srl, $user_srl, $name, $content, $number){
if ($user_srl != $page_srl) sendPushMessage($page_srl, $user_srl, $name, $content, "new_document", 1, $number);
 //if ($user_srl != $page_srl) exec("php /usr/bin/php /var/www/favorite/member/push.php?user_srl=".$page_srl."&send_user_srl=".$user_srl."&title=".$name."&content=".$content."&value=new_document&kind=1&number=".$number." > /dev/null &");
 //if ($user_srl != $page_srl) proc_close(proc_open ("../member/push.php?user_srl=".$page_srl."&send_user_srl=".$user_srl."&title=".$name."&content=".$content."&value=new_document&kind=1&number=".$number." &", array(), $foo));
}
function document_getList($user_srl_auth, $doc_user_srl, $start, $number){
	$user_srl = AuthCheck($user_srl_auth, false);
  $status = setRelationStatus($user_srl, $doc_user_srl);
 return mysql_query("SELECT * FROM  `documents` WHERE  `page_srl` =$doc_user_srl AND  (`status` <=$status OR (`user_srl` =$user_srl AND `status` < 5)) ORDER BY  `documents`.`srl` DESC LIMIT $start , $number");
}

function document_getAllList($user_srl_auth, $start, $number){
	$user_srl = AuthCheck($user_srl_auth, false);
  $status = setRelationStatus($user_srl, $doc_user_srl);
 return mysql_query("SELECT * FROM  `documents` WHERE  (`status` <=$status OR (`user_srl` =$user_srl AND `status` < 5)) ORDER BY  `documents`.`srl` DESC LIMIT $start , $number");
}

function document_getUserUpdateList($user_srl_auth, $user_array){
	$user_srl = AuthCheck($user_srl_auth, false);
for($i=0 ; $i < count($user_array); $i++){
	  $status = setRelationStatus($user_srl, $user_array[$i]);
 $row = mysql_query("SELECT * FROM  `documents` WHERE  `page_srl` =$user_array[$i] AND (`status` <=$status OR (`user_srl` =$user_srl AND `status` < 5)) ORDER BY  `documents`.`srl` DESC");
  mysql_data_seek($row, 0);
    $result=mysql_fetch_array($row); 
 $contents[] = $result[title] == "null" ? $result[content] : $result[title];
}

return $contents;
}



function document_printUserUpdateList($array){
	for($i=0 ; $i < count($array); $i++){
echo $array[$i]."/LINE/.";
	}
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