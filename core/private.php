<?php if(!defined("642979")) exit();
    function Guest_access_page($string){
    	$allow = true;

    	if(strpos($string, "country_code") || strpos($string, "phone_number") || strpos($string, "reg_id") || strpos($string, "key") || strpos($string, "ip_addr") || strpos($string, "like_me") || strpos($string, "favorite") || strpos($string, "likeable")){
$allow = false;
    	}

    	return $allow;
    	}
      
?>