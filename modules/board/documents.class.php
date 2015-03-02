<?php

class DocumentClass
{

    function document_read($PAGE_CLASS, $user_srl, $doc_srl)
    {
        //$user_srl = AuthCheck($user_srl, false);
        $row = mysql_fetch_array(mysql_query("SELECT * FROM  `documents` WHERE  `srl` LIKE '$doc_srl'"));
        $page_info = $PAGE_CLASS -> GetPageInfo($row['srl']);
        //View
        mysql_query("UPDATE `documents` SET `views` = $row[views] + 1 WHERE `srl` = '$doc_srl'");
        if (getIPAddr() != $row['ip_addr'])  $PAGE_CLASS -> updatePopularity($user_srl, $row['page_srl'], 1);
//Status
        $status = $this -> getDocStatus($PAGE_CLASS, $user_srl, $doc_srl);

        if ($status < $page_info['status']) $row = false;
        if ($status < $row['status']) $row = false;

        return $row;
    }

//Find lastest number.
    function DocLastNumber()
    {
        $table_status = mysql_fetch_array(mysql_query("SHOW TABLE STATUS LIKE 'documents'"));
        return $table_status['Auto_increment'];
    }

    function document_status_update($PAGE_CLASS, $doc_srl, $user_srl, $status)
    {
        //$user_srl = AuthCheck($user_srl, false);
        $status_relation = $this -> getDocStatus($PAGE_CLASS, $user_srl, $doc_srl);
        if ($status_relation == 4) {
            $result = mysql_query("UPDATE `documents` SET `status` = '$status'   WHERE `srl` = '$doc_srl'");
        } else {
            $result = false;
        }
        return $result;
    }


    function getDocStatus($PAGE_CLASS, $user_srl, $doc_srl)
    {
//doc owner
        $doc_owner = $this -> getDocOwner($doc_srl);
        $doc_page_owner = $this -> getDocPageOwner($PAGE_CLASS ,$doc_srl);

        //Check Status
        if ($user_srl != $doc_owner) {
            $status = setRelationStatus($user_srl, $doc_page_owner);
        } else {
            $status = 4;
        }

        return $status;

    }

    function getDocOwner($doc_srl)
    {
        return $this -> getDocInfo($doc_srl, "user_srl");
    }

    function getDocPageOwner($PAGE_CLASS, $doc_srl)
    {
        $OwnerInfo = $PAGE_CLASS -> GetPageInfo($this -> getDocInfo($doc_srl, "page_srl"));


        return $OwnerInfo['user_srl'];

    }

    function getDocInfo($doc_srl, $info)
    {
        $result = mysql_fetch_array(mysql_query("SELECT * FROM  `documents` WHERE  `srl` =$doc_srl"));
        return $result[$info];
    }


    function document_update($doc_srl, $user_srl, $namearray, $valuearray)
    {
        //$user_srl = AuthCheck($user_srl, false);
        $relation_status = setRelationStatus($user_srl, $page_srl);
        $user_info = GetPageInfo($user_srl);
        $name = SetUserName($user_info[lang], $user_info[name_1], $user_info[name_2]);
        $last_number = DocLastNumber();
        $result = mysql_query("INSERT INTO `documents` (`page_srl`, `user_srl`, `name`, `title`, `content`, `date`, `permission`, `status`, `privacy`, `ip_addr`) VALUES ('$page_srl', '$user_srl', '$name', '$title', '$content', '" . getTimeStamp() . "', '$permission', '$status', '$privacy', '" . getIPAddr() . "');");
       // $this -> document_send_push($page_srl, $user_srl, $name, $last_number);
//echo mysql_error();

        return $result;
    }


//require attach_class.php
    function document_write($PAGE_CLASS, $ATTACH_CLASS, $page_srl, $user_srl, $title, $content, $permission, $status, $privacy)
    {
//Check Value security
        security_value_check($title);
        security_value_check($content);
//Start
//	$user_srl = AuthCheck($user_srl, false);
        $relation_status = setRelationStatus($user_srl, $page_srl);
        $user_info = $PAGE_CLASS -> GetPageInfo($user_srl);
        $page_info = $PAGE_CLASS -> GetPageInfo($page_srl);
        $name = SetUserName($user_info['lang'], $user_info['name_1'], $user_info['name_2']);
        $last_number = $this -> DocLastNumber();
        if ($content != "" && $relation_status != -1 && $relation_status >= $page_info['write_status'] && $page_info != null) {
            $attach_result = $ATTACH_CLASS -> attach_file($page_srl, $last_number, $user_srl, $status);
            $result = mysql_query("INSERT INTO `documents` (`page_srl`, `user_srl`, `name`, `title`, `content`, `date`, `permission`, `status`, `privacy`,  `attach`,  `ip_addr`) VALUES ('$page_srl', '$user_srl', '$name', '$title', '$content', '" . getTimeStamp() . "', '$permission', '$status', '$privacy', '$attach_result ? 1 : 0', '" . getIPAddr() . "');");

            if (getIPAddr() != $page_info['ip_addr']) $PAGE_CLASS -> updatePopularity($user_srl, $page_srl, 1);
//Set last update
            mysql_query("UPDATE `pages` SET `last_update` = '" . getTimeStamp() . "'   WHERE `user_srl` = '$page_srl'");
//Push
           $this ->  document_send_push($page_srl, $user_srl, $name, $content, $last_number);
        }
//echo mysql_error();

        return $result;
    }

    function document_edit($user_srl, $lang)
    {

    }

    function document_delete($user_srl, $lang)
    {

    }


    function document_send_push($page_srl, $user_srl, $name, $content, $number)
    {
        if ($user_srl != $page_srl)  sendPushMessage($page_srl, $user_srl, $name, $content, "new_document", 1, $number);
        //if ($user_srl != $page_srl) exec("php /usr/bin/php /var/www/favorite/member/push.php?user_srl=".$page_srl."&send_user_srl=".$user_srl."&title=".$name."&content=".$content."&value=new_document&kind=1&number=".$number." > /dev/null &");
        //if ($user_srl != $page_srl) proc_close(proc_open ("../member/push.php?user_srl=".$page_srl."&send_user_srl=".$user_srl."&title=".$name."&content=".$content."&value=new_document&kind=1&number=".$number." &", array(), $foo));
    }

    function document_getList($PAGE_CLASS, $user_srl, $page_srl, $start, $number)
    {
//	$user_srl = AuthCheck($user_srl, false);
        $doc_page_srl_info = $PAGE_CLASS -> GetPageInfo($page_srl);
        $status = setRelationStatus($user_srl, $page_srl);
        $row = mysql_query("SELECT * FROM  `documents` WHERE  `page_srl` =$page_srl AND  (`status` <=$status OR (`user_srl` =$user_srl AND `status` < 5)) ORDER BY  `documents`.`srl` DESC LIMIT $start , $number");
        if ($doc_page_srl_info['status'] > $status || $doc_page_srl_info == null) $row = false;
        return $row;
    }

    function document_getAllList($user_srl, $start, $number)
    {
//	$user_srl = AuthCheck($user_srl, false);
        $status = setRelationStatus($user_srl, $doc_user_srl);
        return mysql_query("SELECT * FROM  `documents` WHERE  (`status` <=$status OR (`user_srl` =$user_srl AND `status` < 5)) ORDER BY  `documents`.`srl` DESC LIMIT $start , $number");
    }

    function document_getUserUpdateList($PAGE_CLASS, $user_srl, $user_array)
    {
//	$user_srl = AuthCheck($user_srl, false);
        for ($i = 0; $i < count($user_array); $i++) {
            $doc_user_info = $PAGE_CLASS -> GetPageInfo($user_array[$i]);
            $status = setRelationStatus($user_srl, $user_array[$i]);
            if ($doc_user_info['status'] > $status) {
                $contents[] = "";

            } else {
                if ($doc_user_info['status'] <= $status)
                    $row = mysql_query("SELECT * FROM  `documents` WHERE  `page_srl` =$user_array[$i] AND (`status` <=$status OR (`user_srl` =$user_srl AND `status` < 5)) ORDER BY  `documents`.`srl` DESC");
                mysql_data_seek($row, 0);
                $result = mysql_fetch_array($row);
                $contents[] = $result['title'] == "null" ? $result['content'] : $result['title'];
            }
        }

        return $contents;
    }


    function document_printUserUpdateList($array)
    {
        for ($i = 0; $i < count($array); $i++) {
            if ($i == count($array) - 1) {
                echo $array[$i];
            } else {
                echo $array[$i] . "/LINE/.";
            }

        }
    }

    function document_PrintList($row, $doc_info)
    {

        $total = mysql_num_rows($row);
        for ($i = 0; $i < $total; $i++) {
            mysql_data_seek($row, $i);           //포인터 이동
            $result = mysql_fetch_array($row);        //레코드를 배열로 저장
            echo print_info($result, $doc_info) . "/DOC/.";
        }
    }


}
      
?>