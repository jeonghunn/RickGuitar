<?php if(!defined("642979")) exit();

function IPManageAct($REMOTE_ADDR, $nowurl, $date){
                 //  Permission Check
        $ip_manage = mysql_fetch_array(mysql_query("SELECT * FROM  `ip_manage` WHERE  `ip_addr` LIKE '$REMOTE_ADDR'"));
//IP Check 
        if($ip_manage[active] == null) {
        	//Make New IP
   mysql_query("INSERT INTO `ip_manage` (`ip_addr`, `active`, `last_address`, `last_access`) VALUES ('$REMOTE_ADDR' , 'Y', '$nowurl', '$date');");
}else{
	//Point (IF more than 100, that ip will be blocked)
	$ip_active = $ip_manage[active];
	$ip_point = $ip_manage[point];
	//Check DDOS
  if($ip_point > 800) APICheckAct();
	if($ip_point > 4999) $ip_active = "N";
	if($ip_manage['last_access'] > $date - 2) $ip_point = $ip_point + 1;
	if($ip_manage['last_access'] > $date - 2 && $nowurl == $ip_manage['last_address']) $ip_point = $ip_point + 10;
	if($ip_manage['last_access'] < $date - 300 && $ip_point > 0) $ip_point = $ip_point - 500;
		if($ip_point < 5000 && $ip_manage[log] == NULL) $ip_active = "Y";
	//Information Update
	mysql_query("UPDATE `ip_manage` SET  `active` = '$ip_active', `point` = '$ip_point' , `last_address` = '$nowurl' , `last_access` = '$date' WHERE `ip_addr` = '$REMOTE_ADDR'");
}
        if($ip_manage[active] == "N") ErrorMessage("ip_error");

    }

       function ip_point_add($point){
   	global $REMOTE_ADDR, $ip_point;
     $ip_point = $ip_point + $point;
     mysql_query("UPDATE `ip_manage` SET  `point` = '$ip_point' WHERE `ip_addr` = '$REMOTE_ADDR'");
   }

   function PermissionCheckAct($user_srl){
   	 //  Permission Check
 $user_permission = mysql_fetch_array(mysql_query("SELECT * FROM  `pages` WHERE  `user_srl` LIKE '$user_srl'"));
 (int) $user_permission_status = $user_permission['permission'];
//Permission Check
  if($user_permission[status] == 5) ErrorMessage("unknown_error");
        if($permission_allow == null) $permission_allow = 3;
        if($user_permission['permission'] > $permission_allow) ErrorMessage("permission_error");
   }

function APICheckAct(){
  if(lottoNum(30)){
$API_KEY = mysql_real_escape_string($_REQUEST['api_key']);
 $user_permission = mysql_fetch_array(mysql_query("SELECT * FROM  `api` WHERE  `user_srl` LIKE '$user_srl'"));


$API_SRL = AuthCheck($API_KEY, false);

if(!$API_SRL) ErrorMessage("api_error");
  }
}
      
?>