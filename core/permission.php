<?php if(!defined("642979")) exit();
       //  Permission Check
 $permission = mysql_fetch_array(mysql_query("SELECT * FROM  `user` WHERE  `user_srl` LIKE '$user_srl'"));
//Permission Check
        if($permission_allow == null) $permission_allow = 3;
        if($permission[permission] > $permission_allow) ErrorMessage("permission_error");
      
?>