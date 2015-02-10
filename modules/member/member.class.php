<?php
/**
 *
 * User: JHRunning
 * Date: 2/10/15
 * Time: 2:32 PM
 */

class MemberClass{


function getPageSrl($category, $value){

    $member_info = mysql_fetch_array(mysql_query("SELECT * FROM  `member` WHERE  `category` LIKE '$category' AND `value` LIKE '$value'  AND ( `expire` = 0 OR `expire` < ".getTimeStamp().")"));

    return $member_info['page_srl'];

}

    function getPageAuth($category, $value){


        return  FindAuthCode(getPageSrl($category, $value), "user_srl");
    }


}


?>
