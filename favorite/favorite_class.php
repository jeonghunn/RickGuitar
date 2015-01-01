<?php if(!defined("642979")) exit();

function favorite_read_page($category, $user_srl, $value){
	//$user_srl = AuthCheck($user_srl, false);
 //$status = setRelationStatus($user_srl, $doc_user_srl);
return mysql_query("SELECT * FROM  `favorite` WHERE  `user_srl` = '$user_srl' AND `category` = '$category' AND  `status` = 0");

}


//Find lastest number.
 // function DocLastNumber(){
 //  $table_status =mysql_fetch_array(mysql_query("SHOW TABLE STATUS LIKE 'documents'"));
 //  return $table_status['Auto_increment'];  
 // }


function favorite_add($value, $user_srl, $category){
	//$user_srl = AuthCheck($user_srl, false);
	$me_status = setRelationStatus($value, $user_srl);
	$user_info = GetPageInfo($user_srl);	
	$name = SetUserName($user_info['lang'], $user_info['name_1'], $user_info['name_2']);
	//$last_number = DocLastNumber();
	if($me_status < 3 && $me_status > 0){
$result = mysql_query("INSERT INTO `favorite` (`user_srl`, `category`, `value`, `date`, `ip_addr`) VALUES ('$user_srl', '$category', '$value', '".getTimeStamp()."', '".getIPAddr()."');");
//setCount
setFavoriteCount($user_srl, $value, 3);
updatePopularity($user_srl, $value, 20);
favorite_send_push($value, $user_srl, $name, "0");
}
//echo mysql_error();
	
return $result;
}


function favorite_delete($value, $user_srl, $category){
	$me_status = setRelationStatus($value, $user_srl);

	if($me_status == 3){
$result = mysql_query("UPDATE `favorite` SET `status` = '1'   WHERE `user_srl` = '$user_srl' AND `value` = '$value' AND `category` = '$category' AND `status` = '0'");

//setCount
setFavoriteCount($user_srl, $value, 3);
updatePopularity($user_srl, $value, -20);
	}

	return $result;
}

//Set favorite count on user
function setFavoriteCount($user_srl, $value, $category){
	//Count my favorite
	$me_favorite_count = getFavoriteCount($user_srl, $category);
	$me_like_me_count = getLikeMeCount($user_srl, $category);
      mysql_query("UPDATE `pages` SET `favorite` = '$me_favorite_count'   WHERE `user_srl` = '$user_srl'");
    mysql_query("UPDATE `pages` SET `like_me` = '$me_like_me_count'   WHERE `user_srl` = '$user_srl'");

//Count others favorite
   	$you_favorite_count = getFavoriteCount($value, $category); 
	$you_like_me_count = getLikeMeCount($value, $category);
   mysql_query("UPDATE `pages` SET `favorite` = '$you_favorite_count'   WHERE `user_srl` = '$value'");
    mysql_query("UPDATE `pages` SET `like_me` = '$you_like_me_count'   WHERE `user_srl` = '$value'");

}

function getLikeMeCount($user_srl, $category){
	$like_me_count = mysql_query("SELECT * FROM  `favorite` WHERE  `value` = '$user_srl' AND `category` = '$category' AND `status` = '0'");
	$total= mysql_num_rows ( $like_me_count );

	return $total;
}

function getFavoriteCount($user_srl, $category){
	$favorite_count = mysql_query("SELECT * FROM  `favorite` WHERE  `user_srl` = '$user_srl' AND `category` = '$category' AND `status` = '0'");
	$total= mysql_num_rows ( $favorite_count );

	return $total;
}


function favorite_send_push($value, $user_srl, $name, $number){
sendPushMessage($value, $user_srl, $name, "added_to_favorite", "added_to_favorite", 3, $user_srl);
}

function favorite_getList($user_srl, $doc_user_srl, $start, $number){
//	$user_srl = AuthCheck($user_srl, false);
 //$status = setRelationStatus($user_srl, $doc_user_srl);
 return mysql_query("SELECT * FROM  `documents` WHERE  `page_srl` = '$doc_user_srl' AND `status` = '0' ORDER BY  `documents`.`srl` DESC LIMIT $start , $number");
}


function favorite_PrintList($row){
	 $total= mysql_num_rows ( $row );
	for($i=0 ; $i < $total; $i++){
               mysql_data_seek($row, $i);           //포인터 이동
             $result=mysql_fetch_array($row);        //레코드를 배열로 저장
             echo $result[value]."/LINE/.";
}         
}
   
// You must import member_class.php
function favorite_PrintListbyUpdate($row){
	 $total= mysql_num_rows ( $row );
	for($i=0 ; $i < $total; $i++){
               mysql_data_seek($row, $i);           //포인터 이동
             $result=mysql_fetch_array($row);        //레코드를 배열로 저장
             $user_info = GetPageInfo($result[value]);
             	$name = SetUserName($user_info[lang], $user_info[name_1], $user_info[name_2]);
            $profile[] = array( "last_update"=> $user_info[last_update] , "user_srl"=> $result[value], "name"=> $name);
}         

foreach ($profile as $key => $row) { 
  $last_update[$key] = $row['last_update']; 
  $user_srl[$key] = $row['user_srl']; 
} 

// volume 내림차순, edition 오름차순으로 데이터를 정렬 
// 공통 키를 정렬하기 위하여 $data를 마지막 인수로 추가 
array_multisort($last_update, SORT_DESC, $user_srl, SORT_ASC, $profile);

foreach($profile as $key => $value){
echo $value['user_srl']."/LINE/.".$value['name']."/PFILE/.";
}

}
      


?>