<?php


function Model_Square_getLastNumber()
{
    return mysqli_fetch_array(DBQuery("SHOW TABLE STATUS LIKE 'square'"));
}


function Model_Square_Write($square_key, $page_srl, $user_srl, $name, $title, $content, $data, $permission, $status, $privacy, $attach_result)
{
    return DBQuery("INSERT INTO `documents` (`square_key`, `page_srl`, `user_srl`, `name`, `title`, `content`, `data`, `date`, `permission`, `status`, `privacy`,  `attach`,  `ip_addr`) VALUES ('$square_key', '$page_srl', '$user_srl', '$name', '$title', '$content', '$data',  '" . getTimeStamp() . "', '$permission', '$status', '$privacy', '$attach_result ? 1 : 0', '" . getIPAddr() . "');");
}


?>