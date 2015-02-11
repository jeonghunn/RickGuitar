<?php
/**
 *
 * User: JHRunning
 * Date: 2/10/15
 * Time: 2:32 PM
 */

class MemberClass{


function getPageSrl($category, $value){

    $member_info = mysql_fetch_array(mysql_query("SELECT * FROM  `member` WHERE  `category` LIKE '$category' AND `value` LIKE '$value'  AND `status` <= 1  AND ( `expire` = 0 OR `expire` < ".getTimeStamp().")"));

    return $member_info['page_srl'];

}

    function getPageAuth($category, $value){


        return  FindAuthCode($this -> getPageSrl($category, $value), "user_srl");
    }


    function CreateMemberInfo($page_srl, $category, $value, $expired){
        mysql_query("INSERT INTO `member` (`category`, `page_srl`, `value`, `date`, `expired`, `status`) VALUES ('$category', '$page_srl', '$value' , '".getTimeStamp()."', '$expired', '1');");
    }


}


?>
