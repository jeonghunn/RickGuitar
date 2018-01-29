<?php


function Model_Square_getLastNumber()
{
    return mysqli_fetch_array(DBQuery("SHOW TABLE STATUS LIKE 'square'"));
}


function Model_Square_Write($square_key, $page_srl, $user_srl, $name, $title, $content, $type, $data, $permission, $status, $privacy, $attach_result)
{
    return DBQuery("INSERT INTO `square` (`square_key`, `page_srl`, `user_srl`, `name`, `title`, `content`,`type` ,`data`, `date`, `permission`, `status`, `privacy`,  `attach`,  `ip_addr`) VALUES ('$square_key', '$page_srl', '$user_srl', '$name', '$title', '$content', '$type', '$data',  '" . getTimeStamp() . "', '$permission', '$status', '$privacy', '$attach_result ? 1 : 0', '" . getIPAddr() . "');");
}

function Model_Square_getSquareByKey($square_key)
{
    return mysqli_fetch_array(DBQuery("SELECT * FROM  `square` WHERE  `square_key` LIKE '$square_key' AND `status` < 5"));
}

function Model_Square_ViewCountUp($views, $square_srl)
{
    return DBQuery("UPDATE `square` SET `views` = $views + 1 WHERE `srl` = '$square_srl'");
}

function Model_Square_getLastUpdates($status, $user_srl, $start, $number)
{
    return DBQuery("SELECT * FROM  `square` WHERE  (`status` LIKE '0' OR (`user_srl` =$user_srl AND `status` < 5 AND `user_srl` != 0)) ORDER BY  `square`.`srl` DESC LIMIT $start , $number");
}


?>