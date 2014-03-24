<?if(!defined("642979")) exit();


//Auth code to user_srl
//$user_srl = AuthCheck($user_srl_auth, false);


function GetPageInfo($page_srl){
         //Send Imformation
        $sql ="SELECT * FROM  `pages` WHERE  `srl` LIKE '$page_srl'";
        $result = mysql_query($sql);
        $row=mysql_fetch_array($result);

return $row;
}

//IF use this function you must import auth.php and private.php, member_info_class.php
function PageInfo($page_srl, $user_srl_auth){

$user_srl = AuthCheck($user_srl_auth, false);
//Get Member Info
$page_row = GetPageInfo($page_srl);
$user_row = GetMemberInfo($page_row[user_srl]);
if($page_row[user_mode] == "Y") {

  $row = array($page_row[user_srl], $page_row[user_mode],$user_row[status], SetUserName($user_row[lang], $user_row[name_1], $user_row[name_2]), $page_row[tags], $user_row[like_me], $user_row[favorite] );

}else{
  $row = array($page_row[user_srl], $page_row[user_mode],$page_row[status], $page_row[title], $page_row[tags], $page_row[like_me], $page_row[favorite] );
}


return $row;
}

   
      
?>