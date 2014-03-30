<?php if(!defined("642979")) exit();

function favorite_read($user_srl_auth, $doc_srl){
	$user_srl = AuthCheck($user_srl_auth, false);
 $status = setRelationStatus($user_srl, $doc_user_srl);
}

//Find lastest number.
 // function DocLastNumber(){
 //  $table_status =mysql_fetch_array(mysql_query("SHOW TABLE STATUS LIKE 'documents'"));
 //  return $table_status['Auto_increment'];  
 // }

function favorite_add($fav_user_srl, $user_srl_auth, $category,  $status, $privacy){
$result = favorite_add($fav_user_srl, $user_srl_auth, $category, $country_code, $phone_number, $birthday, $tags, $status, $privacy);
return $result;
}

function favorite_add($fav_user_srl, $user_srl_auth, $category, $country_code, $phone_number, $birthday, $tags, $status, $privacy){
	global $date, $REMOTE_ADDR;
	$user_srl = AuthCheck($user_srl_auth, false);
	//$status = setRelationStatus($user_srl, $page_srl);
	if($fav_user_srl != "null"){
		$fav_user_info = GetMemberInfo($fav_user_srl);

	}
	
	//$name = SetUserName($user_info[lang], $user_info[name_1], $user_info[name_2]);
	//$last_number = DocLastNumber();
$result = mysql_query("INSERT INTO `favorite` (`user_srl`, `fav_user_srl`, `category`, `country_code`, `phone_number`, `birthday`, `tags`, `date`, `ip_addr`, `permission`, `status`, `private`) VALUES ('$user_srl', '$fav_user_srl', '$category', '$country_code', '$phone_number', '$birthday', '$tags', '$date', '$REMOTE_ADDR', '3' , '$status', '$privacy');");
favorite_send_push($fav_user_srl, $user_srl, $name, $last_number);
//echo mysql_error();
	
return $result;
}

function favorite_edit($user_srl, $lang){

}

function favorite_delete($user_srl, $lang){

}


function favorite_send_push($page_srl, $user_srl, $name, $number){
if ($user_srl != $page_srl) sendPushMessage($page_srl, $user_srl, $name, "당신을 좋아하는 사람으로 등록했습니다.", 2, $number);
}

function favorite_getList($user_srl_auth, $doc_user_srl, $start, $number){
	$user_srl = AuthCheck($user_srl_auth, false);
 //$status = setRelationStatus($user_srl, $doc_user_srl);
 return mysql_query("SELECT * FROM  `documents` WHERE  `page_srl` =$doc_user_srl ORDER BY  `documents`.`srl` DESC LIMIT $start , $number");
}


function favorite_PrintList($row, $doc_info){
	 $total= mysql_num_rows ( $row );
	for($i=0 ; $i < $total; $i++){
               mysql_data_seek($row, $i);           //포인터 이동
             $result=mysql_fetch_array($row);        //레코드를 배열로 저장
             echo print_info($result, $doc_info)."/DOC/.";
}         
}
   
      
?>