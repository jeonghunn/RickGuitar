<?php if(!defined("642979")) exit();
//You have to import documents_class.php



function comment_read($user_srl, $doc_srl){
	//$user_srl = AuthCheck($user_srl, false);
	$row = mysql_fetch_array(mysql_query("SELECT * FROM  `documents` WHERE  `srl` LIKE '$doc_srl'"));

 $status = setRelationStatus($user_srl, $row[page_srl]);

if($status < $row[status]) return false;

return $row;
}

//Find lastest number.
 function CommentLastNumber(){
  $table_status =mysql_fetch_array(mysql_query("SHOW TABLE STATUS LIKE 'comments'"));
  return $table_status['Auto_increment'];  
 }


//Require documents_class.php
 function comment_status_update($comment_srl, $user_srl, $status){
	global $date, $REMOTE_ADDR;
	$cmt_info = getComment($comment_srl);
	//$user_srl = AuthCheck($user_srl, false);
    $status_relation = getCommentStatus($user_srl, $comment_srl);
    if($status_relation == 4){
	 $result = mysql_query("UPDATE `comments` SET `status` = '$status'  WHERE `srl` = '$comment_srl'");
	 setDocCommentCount($cmt_info[doc_srl]);
}
return $result;
 }


//Require documents_class.php
function getCommentStatus($user_srl, $comment_srl){

$cmt_info = getComment($comment_srl);
//doc owner
$doc_owner = getDocOwner($cmt_info[doc_srl]);
$doc_page_owner = getDocPageOwner($cmt_info[doc_srl]);
$doc_page_owner_info = GetMemberInfo($doc_page_owner);
$doc_page_owner_admin = $doc_page_owner_info['admin'];

	//Check Status
	if($user_srl != $cmt_info[user_srl] && $user_srl != $doc_owner && $user_srl != $doc_page_owner && $user_srl != $doc_page_owner_admin ){
	$status = setRelationStatus($user_srl, $comment_owner);
}else{
	$status = 4;
}

return $status;

}




function getCommentInfo($srl, $info){
	$result =getComment($srl);
return $result[$info];
}

function getComment($srl){
	$result =mysql_fetch_array(mysql_query("SELECT * FROM  `comments` WHERE  `srl` =$srl"));
return $result;
}


function comment_write($doc_srl, $user_srl , $content, $permission, $privacy){
	global $date, $REMOTE_ADDR;
	//$user_srl = AuthCheck($user_srl, false);
	$user_info = GetMemberInfo($user_srl);
	$name = SetUserName($user_info[lang], $user_info[name_1], $user_info[name_2]);
	$document = document_read($user_srl, $doc_srl);
	$last_number = CommentLastNumber();
if($content != "" && $document != null) {
	$result = mysql_query("INSERT INTO `comments` (`doc_srl`, `user_srl`, `name`, `content`, `date`, `status`, `privacy`, `ip_addr`) VALUES ('$doc_srl', '$user_srl', '$name', '$content', '$date', '$document[status]', '$privacy', '$REMOTE_ADDR');");
	//SetCount
	setDocCommentCount($doc_srl);
	if($REMOTE_ADDR != $document[ip_addr]) updatePopularity($user_srl, $document[page_srl], 1);
	//Send Alert
    comment_send_push($document[user_srl], $doc_srl, $user_srl, $name, $content, $doc_srl);
}
//echo mysql_error();
	
return $result;
}

function comment_edit($user_srl, $lang){

}

function comment_delete($user_srl, $lang){

}

function setDocCommentCount($doc_srl){
	$count = getCommentCount($doc_srl); 
$comment_count = mysql_query("UPDATE `documents` SET `comments` = '$count' WHERE `srl` = '$doc_srl'");
}

function getCommentCount($doc_srl){
	$comment_count = mysql_query("SELECT * FROM  `comments` WHERE  `doc_srl` = '$doc_srl' AND `status` != '5'");
	$total= mysql_num_rows ( $comment_count );

	return $total;
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



function comment_getList($user_srl, $doc_srl, $start, $number){
//	$user_srl = AuthCheck($user_srl, false);
  $status = getDocStatus($user_srl, $doc_srl);
 return mysql_query("SELECT * FROM  `comments` WHERE  `doc_srl` =$doc_srl AND (`status` <=$status OR (`user_srl` =$user_srl AND `status` < 5)) ORDER BY  `comments`.`srl` ASC LIMIT $start , $number");
}


function comment_PrintList($user_srl, $row, $comment_info){
	//	$user_srl = AuthCheck($user_srl, false);
	 $total= mysql_num_rows ( $row );
	for($i=0 ; $i < $total; $i++){
               mysql_data_seek($row, $i);           //포인터 이동
             $result=mysql_fetch_array($row);        //레코드를 배열로 저장
             echo print_info($result, $comment_info)."/LINE/.".getCommentStatus($user_srl, $result[srl])."/CMT/.";
}         
}
   
      
?>