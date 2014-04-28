<?php if(!defined("642979")) exit();
    function AccessMemberInfo($status, $row, $you_srl, $info){
    	if (strpos($info, "ip_addr")) ErrorMessage("security_error");
    	if (strpos($info, "likeable")) ErrorMessage("security_error");
    	//Select status table
    	$you_srl_status = mysql_fetch_array(mysql_query("SELECT * FROM  `status` WHERE  `user_srl` LIKE '$you_srl'"));

        $you_srl_info = mysql_fetch_array(mysql_query("SELECT * FROM  `user` WHERE  `user_srl` LIKE '$you_srl'"));
    
     //    if($status < $you_srl_info[status]) $row = null;
        for ($i=0 ; $i < count($info);$i++){
if($you_srl_status[$info[$i]] > $status){
	$row[$info[$i]] = "null";
}


    	 }
    	

    	return $row;
    	}
      
          function AccessDocuments($status, $row, $you_srl, $info){
        if (strpos($info, "ip_addr")) ErrorMessage("security_error");
        if (strpos($info, "likeable")) ErrorMessage("security_error");
        //Select status table
        $you_srl_status = mysql_fetch_array(mysql_query("SELECT * FROM  `status` WHERE  `user_srl` LIKE '$you_srl'"));

         for ($i=0 ; $i < count($info);$i++){
if($you_srl_status[$info[$i]] > $status){
    $row[$info[$i]] = "null";
}


         }
        

        return $row;
        }
      
?>