<?php if(!defined("642979")) exit();
 //  Permission Check
 $user_permission = mysql_fetch_array(mysql_query("SELECT * FROM  `user` WHERE  `user_srl` LIKE '$user_srl'"));
 (int) $user_permission_status = $user_permission[permission];
//Permission Check
  if($user_permission[status] == 5) ErrorMessage("unknown_error");
        if($permission_allow == null) $permission_allow = 3;
        if($user_permission[permission] > $permission_allow) ErrorMessage("permission_error");
      
?>