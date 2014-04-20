<?php if(!defined("642979")) exit();
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
	if($ip_point > 1999) $ip_active = "N";
	if($ip_point < 2000 && $ip_manage[log] == NULL) $ip_active = "Y";
	if($ip_manage[last_access] > $date - 2) $ip_point = $ip_point + 1;
	if($ip_manage[last_access] > $date - 2 && $nowurl == $ip_manage[last_address]) $ip_point = $ip_point + 5;
	if($ip_manage[last_access] < $date - 1000 && $ip_point > 0) $ip_point = $ip_point - 200;
	//Information Update
	mysql_query("UPDATE `ip_manage` SET  `active` = '$ip_active', `point` = '$ip_point' , `last_address` = '$nowurl' , `last_access` = '$date' WHERE `ip_addr` = '$REMOTE_ADDR'");
}
        if($ip_manage[active] == "N") ErrorMessage("ip_error");

   
      
?>