<?php if(!defined("642979")) exit();
 //add log       
       

function ActLog($user_srl, $REMOTE_ADDR, $date, $log_category, $log){
	     mysql_query("INSERT INTO `log` (`user_srl`, `ip_addr`, `date`, `category`, `value`) VALUES ('$user_srl', '$REMOTE_ADDR', '$date' , '$log_category', '$log');");
}

            function ClientAgentLog(){
            	global $user_srl, $REMOTE_ADDR, $useragent, $date;
            	$row = mysql_fetch_array(mysql_query("SELECT * FROM  `clients` WHERE `ip_addr` LIKE '$REMOTE_ADDR' AND  `user_agent` LIKE '$useragent'"));
            	if($row[ip_addr] != $REMOTE_ADDR || $row[user_agent] != $useragent){
            	mysql_query("INSERT INTO `clients` (`user_srl`, `ip_addr`, `user_agent`, `date`) VALUES ('$user_srl', '$REMOTE_ADDR', '$useragent' , '$date');");
            }
}

<<<<<<< HEAD
        }



   

=======
            function ActLog($user_srl, $REMOTE_ADDR, $date, $log_category, $log){
     mysql_query("INSERT INTO `log` (`user_srl`, `ip_addr`, `date`, `category`, `value`) VALUES ('$user_srl', '$REMOTE_ADDR', '$date' , '$log_category', '$log');");
            }

            function IPManageAct(){
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
	if($ip_point > 4999) $ip_active = "N";
	if($ip_manage[last_access] > $date - 2) $ip_point = $ip_point + 1;
	if($ip_manage[last_access] > $date - 2 && $nowurl == $ip_manage[last_address]) $ip_point = $ip_point + 10;
	if($ip_manage[last_access] < $date - 300 && $ip_point > 0) $ip_point = $ip_point - 500;
		if($ip_point < 5000 && $ip_manage[log] == NULL) $ip_active = "Y";
	//Information Update
	mysql_query("UPDATE `ip_manage` SET  `active` = '$ip_active', `point` = '$ip_point' , `last_address` = '$nowurl' , `last_access` = '$date' WHERE `ip_addr` = '$REMOTE_ADDR'");
}
        if($ip_manage['active'] == "N") ErrorMessage("ip_error");

            }

               function ip_point_add($point){
   	global $REMOTE_ADDR, $ip_point;
     $ip_point = $ip_point + $point;
     mysql_query("UPDATE `ip_manage` SET  `point` = '$ip_point' WHERE `ip_addr` = '$REMOTE_ADDR'");
   }

   function startLogger(){
    global $user_srl, $REMOTE_ADDR, $date, $log_category, $log;



    //     $thread = new Thread("localhost");
    // $thread->setFunc('ActLog', array($user_srl, $REMOTE_ADDR, $date, "adsfdsfadsf", "adsfsfsdf"));
    // $thread->start();



    //         $thread2 = new Thread("localhost");
    // $thread2->setFunc('ClientAgentLog', array());
    // $thread2->start();


    //    $thread3 = new Thread("localhost");
    // $thread3->setFunc('IPManageAct', array());
    // $thread3->start();


   }

        
>>>>>>> a765c313250ddcfa2c535c50f643a1231a8c3a69
?>