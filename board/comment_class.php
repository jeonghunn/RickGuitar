<?php if(!defined("642979")) exit();
//You have to import documents_class.php



function comment_read($user_srl_auth, $doc_srl){
	$user_srl = AuthCheck($user_srl_auth, false);
	$row = mysql_fetch_array(mysql_query("SELECT * FROM  `documents` WHERE  `srl` LIKE '$doc_srl'"));

 $status = setRelationStatus($user_srl, $row[page_srl]);

if($status < $row[status]) ErrorMessage("permission_error");

return $row;
}

//Find lastest number.
 function CommentLastNumber(){
  $table_status =mysql_fetch_array(mysql_query("SHOW TABLE STATUS LIKE 'comments'"));
  return $table_status['Auto_increment'];  
 }



function comment_write($doc_srl, $user_srl_auth , $content, $permission, $privacy){
	global $date, $REMOTE_ADDR;
	$user_srl = AuthCheck($user_srl_auth, false);
	$user_info = GetMemberInfo($user_srl);
	$name = SetUserName($user_info[lang], $user_info[name_1], $user_info[name_2]);
	$document = document_read($user_srl_auth, $doc_srl);
	$last_number = CommentLastNumber();
if($content != "") {
	$comment_count = mysql_query("UPDATE `documents` SET `comments` = $document[comments] + 1 WHERE `srl` = '$doc_srl'");
	$result = mysql_query("INSERT INTO `comments` (`doc_srl`, `user_srl`, `name`, `content`, `date`, `status`, `privacy`, `ip_addr`) VALUES ('$doc_srl', '$user_srl', '$name', '$content', '$date', '$document[status]', '$privacy', '$REMOTE_ADDR');");
    comment_send_push($document[user_srl], $doc_srl, $user_srl, $name, $content, $doc_srl);
}
//echo mysql_error();
	
return $result;
}

function comment_edit($user_srl, $lang){

}

function comment_delete($user_srl, $lang){

}


function comment_send_push($doc_user_srl, $doc_srl, $user_srl, $name, $content, $number){
	$row =mysql_query("SELECT user_srl FROM  `comments` WHERE  `doc_srl` =$doc_srl  ORDER BY  `comments`.`srl`");
$total= mysql_num_rows ( $row );
if($total < 150){
//Delete same id
$sent = array();
for($i=0 ; $i < $total; $i++){
               mysql_data_seek($row, $i);           //포인터 이동
             $result=mysql_fetch_array($row);        //레코드를 배열로 저장
             $sent[] = $result[user_srl];
}     
$sent[] = $doc_user_srl;
$sent =  array_unique($sent);
if($doc_user_srl == $user_srl) $sent = arr_del($sent, $doc_user_srl);
$sent = arr_del($sent, $user_srl);
//re sort
foreach($sent as $a=>$b) if ( $b=='' ) unset($sent[$a]);
$sent = array_values($sent);

	for($i=0 ; $i < count($sent); $i++){
             
             	
             sendPushMessage($sent[$i], $user_srl, $name, $content,  "new_comment", 2, $number);
         
}
}
}         

 


function comment_getList($user_srl_auth, $doc_srl, $start, $number){
	$user_srl = AuthCheck($user_srl_auth, false);
  $status = setRelationStatus($user_srl, $doc_user_srl);
 return mysql_query("SELECT * FROM  `comments` WHERE  `doc_srl` =$doc_srl AND  `status` <=$status ORDER BY  `comments`.`srl` ASC LIMIT $start , $number");
}


function comment_PrintList($row, $comment_info){
	 $total= mysql_num_rows ( $row );
	for($i=0 ; $i < $total; $i++){
               mysql_data_seek($row, $i);           //포인터 이동
             $result=mysql_fetch_array($row);        //레코드를 배열로 저장
             echo print_info($result, $comment_info)."/CMT/.";
}         
}
   
      
?>