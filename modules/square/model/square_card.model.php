<?php


function Model_SquareCards_getLastNumber()
{
    return mysqli_fetch_array(DBQuery("SHOW TABLE STATUS LIKE 'square_cards'"));
}


function Model_SquareCards_Write($page_srl, $user_srl, $square_srl, $parent_card_srl, $name, $content, $permission, $status, $privacy, $attach_result)
{
    return DBQuery("INSERT INTO `square_cards`  ( `page_srl`, `user_srl`,  `square_srl`,  `parent_card_srl`,  `name`,`content`, `date`, `permission`, `status`, `privacy`,  `attach`,  `ip_addr`) VALUES ('$page_srl', '$user_srl', '$square_srl', '$parent_card_srl', '$name',  '$content', '" . getTimeStamp() . "', '$permission', '$status', '$privacy', '$attach_result ? 1 : 0', '" . getIPAddr() . "');");
}


function Model_SquareCard_getSquareCardsBySquare($square_srl)
{
    return DBQuery("SELECT * FROM  `square_cards` WHERE  `square_srl` = '$square_srl' ");
}
//
//function Model_Square_ViewCountUp($views, $square_srl)
//{
//    return DBQuery("UPDATE `square` SET `views` = $views + 1 WHERE `srl` = '$square_srl'");
//}


?>