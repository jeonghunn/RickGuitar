<?php


function Model_Square_getLastNumber()
{
    return mysqli_fetch_array(DBQuery("SHOW TABLE STATUS LIKE 'square'"));
}


function Model_Square_Write($square_key, $page_srl, $user_srl, $name, $title, $content, $type, $data, $permission, $status, $privacy, $attach_result)
{
    return DBQuery("INSERT INTO `square` (`square_key`, `page_srl`, `user_srl`, `name`, `title`, `content`,`type`, ,`data`, `date`, `permission`, `status`, `privacy`,  `attach`,  `ip_addr`) VALUES ('$square_key', '$page_srl', '$user_srl', '$name', '$title', '$content', '$type', '$data',  '" . getTimeStamp() . "', '$permission', '$status', '$privacy', '$attach_result ? 1 : 0', '" . getIPAddr() . "');");
}


?>