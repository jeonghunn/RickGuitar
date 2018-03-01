<?php

class SquareClass
{

    function Read($SQUARE_CARD_CLASS, $PAGE_CLASS, $ATTACH_CLASS, $user_srl, $square_key, $attach_info)
    {
        //$user_srl = AuthCheck($user_srl, false);
        $row = Model_Square_getSquareByKey($square_key);
        $square_srl = $row['srl'];
        $page_info = $PAGE_CLASS -> GetPageInfo($row['page_srl']);
        //View
        Model_Square_ViewCountUp($row['views'], $square_srl);
//Status
        $status = $this->getStatus($PAGE_CLASS, $user_srl, $square_srl);

        $row['you_doc_status'] = $status;
        if ($attach_info != null) $row['attach_contents'] = json_encode($ATTACH_CLASS->attach_read($user_srl, "square", $square_srl, $status, $attach_info));

        $row['square_cards'] = json_encode($this->getReadResult($SQUARE_CARD_CLASS, $square_srl, json_decode($row['data'], true), $row['type']));


        if ($status < $page_info['status']) $row = false;
        if ($status < $row['status']) $row = false;



        return $row;
    }

    function getReadResult($SQUARE_CARD_CLASS, $square_srl, $data, $type)
    {
        $cards = getSqlList($SQUARE_CARD_CLASS->Read($square_srl), array("content", "date", "style", "align"));

        if ($type == "birthday") {
            $BIRTHDAY_CLASS = new BirthdayClass();
            $cards = $BIRTHDAY_CLASS->getReadResult($data, $cards);
        }


        return $cards;
    }

//Find lastest number.

    function getStatus($PAGE_CLASS, $user_srl, $square_srl)
    {


//doc owner


        $owner = $this->getDocOwner($square_srl);
        $page_owner = $this->getDocPageOwner($PAGE_CLASS, $square_srl);

        if ($page_owner == 0) $status = 0;

        //Check Status
        if ($user_srl != $owner) {
            $status = setRelationStatus($user_srl, $page_owner);
        } else {
            $status = 4;
        }

        return $status;

    }

    function getDocOwner($doc_srl)
    {
        return $this -> getDocInfo($doc_srl, "user_srl");
    }

    function getDocInfo($doc_srl, $info)
    {
        $result = mysqli_fetch_array(DBQuery("SELECT * FROM  `documents` WHERE  `srl` =$doc_srl"));
        return $result[$info];
    }

    function getDocPageOwner($PAGE_CLASS, $doc_srl)
    {
        $OwnerInfo = $PAGE_CLASS -> GetPageInfo($this -> getDocInfo($doc_srl, "page_srl"));


        return $OwnerInfo['srl'];

    }

    function document_status_update($PAGE_CLASS, $doc_srl, $user_srl, $status)
    {
        //$user_srl = AuthCheck($user_srl, false);
        $status_relation = $this -> getDocStatus($PAGE_CLASS, $user_srl, $doc_srl);
        if ($status_relation == 4) {
            $result = DBQuery("UPDATE `documents` SET `status` = '$status'   WHERE `srl` = '$doc_srl' AND `status` < 5");
        } else {
            $result = false;
        }
        return $result;
    }

    function document_update($PAGE_CLASS, $doc_srl, $user_srl, $namearray, $valuearray)
    {
        //$user_srl = AuthCheck($user_srl, false);
        $relation_status = setRelationStatus($user_srl, $page_srl);
        $user_info = $PAGE_CLASS -> GetPageInfo($user_srl);
        $name = SetUserName($user_info['lang'], $user_info['name_1'], $user_info['name_2']);
        $last_number = $this -> DocLastNumber();
        $result = DBQuery("INSERT INTO `documents` (`page_srl`, `user_srl`, `name`, `title`, `content`, `date`, `permission`, `status`, `privacy`, `ip_addr`) VALUES ('$page_srl', '$user_srl', '$name', '$title', '$content', '" . getTimeStamp() . "', '$permission', '$status', '$privacy', '" . getIPAddr() . "');");
       // $this -> document_send_push($page_srl, $user_srl, $name, $last_number);
//echo mysqli_error();

        return $result;
    }

    function LastNumber()
    {
        $table_status = Model_Square_getLastNumber();
        return $table_status['Auto_increment'];
    }


    function getSummarizedTitle($title)
    {

        $title = str_replace("{[", "<", $title);
        $title = str_replace("]}", ">", $title);
        $title = strip_tags($title);

        if (strlen($title) > 60) $title = mb_substr($title, 0, 60) . "...";


        return $title;
    }




//require attach_class.php

    function Write($SQUARE_CARD_CLASS, $PAGE_CLASS, $ATTACH_CLASS, $PUSH_CLASS, $page_srl, $user_srl, $title, $content, $type, $data, $square_cards, $permission, $status, $privacy)
    {
//Check Value security
//        security_value_check($title);
//        security_value_check($content);


        $result = false;
        $relation_status = setRelationStatus($user_srl, $page_srl);
        $user_info = $PAGE_CLASS->GetPageInfo($user_srl);
        $page_info = $PAGE_CLASS->GetPageInfo($page_srl);
        $name = SetUserName($user_info['lang'], $user_info['name_1'], $user_info['name_2']);
        $last_number = $this->LastNumber();
        $square_key = GenerateString(12);


        $WriteResult = null;


        //ToArray
        $data_array = ReadJson($data);
        $square_cards_array = ReadJson($square_cards);


        //setTitle
        if ($title == null) {
            $title = $this->getSummarizedTitle($square_cards_array[0]['content']);
        }


        //GETResult of doc

        if ($type == "birthday") {
            $BIRTHDAY_CLASS = new BirthdayClass();
            $WriteResult = $BIRTHDAY_CLASS->getWriteResult($title, $content, $data_array, $square_cards_array);

        }

        //Set WriteResult
        if ($WriteResult != null) {
            $title = $WriteResult[0];
            $content = $WriteResult[1];
            $data = RealEscapeString(EncodeJson($WriteResult[2]));
            $square_cards_array = $WriteResult[3];

        }


        //WRTIE SquareCard
        for ($i = 0; $i < count($square_cards_array); $i++) {

            $SQUARE_CARD_CLASS->Write($ATTACH_CLASS, $PUSH_CLASS, $last_number, 0, $page_srl, $user_srl, RealEscapeString($square_cards_array[$i]['content']), RealEscapeString($square_cards_array[$i]['align']), RealEscapeString($square_cards_array[$i]['style']), $permission, $status, $privacy);


        }



        if ($type != "" && ($relation_status != -1 && $relation_status >= $page_info['write_status'] && $page_info != null) || ($page_srl == 0)) {
            $attach_result = $ATTACH_CLASS->attach_file("square", $page_srl, $last_number, $user_srl, $status);


            $result = Model_Square_Write($square_key, $page_srl, $user_srl, $name, $title, $content, $type, $data, $permission, $status, $privacy, $attach_result);

            //  if (getIPAddr() != $page_info['ip_addr']) $PAGE_CLASS -> updatePopularity($user_srl, $page_srl, 1);
//Set last update
            DBQuery("UPDATE `pages` SET `last_update` = '" . getTimeStamp() . "'   WHERE `user_srl` = '$page_srl'");
//Push
            // $this ->  document_send_push($PUSH_CLASS, $page_srl, $user_srl, $name, $content, $last_number);
        }
//echo mysqli_error();

        if ($result == true) {
            return array("category" => "success", "square_key" => $square_key);
        }

        return array("category" => "error", "square_key" => $square_key);
    }

    function document_send_push($PUSH_CLASS, $page_srl, $user_srl, $name, $content, $number)
    {
        if ($user_srl != $page_srl)  $PUSH_CLASS -> sendPushMessage($page_srl, $user_srl, $name, $content, $number,  "new_document");
        //if ($user_srl != $page_srl) exec("php /usr/bin/php /var/www/favorite/member/push.php?user_srl=".$page_srl."&send_user_srl=".$user_srl."&title=".$name."&content=".$content."&value=new_document&kind=1&number=".$number." > /dev/null &");
        //if ($user_srl != $page_srl) proc_close(proc_open ("../member/push.php?user_srl=".$page_srl."&send_user_srl=".$user_srl."&title=".$name."&content=".$content."&value=new_document&kind=1&number=".$number." &", array(), $foo));
    }

    function document_edit($user_srl, $lang)
    {

    }

    function document_delete($user_srl, $lang)
    {

    }


    function getMain($SQUARE_CLASS, $PAGE_CLASS, $ATTACH_CLASS, $user_srl, $square_info, $attach_info)
    {

        $result = null;

        $top_items = array(array("square_key" => "birthday", "title" => "생일 축하 카드 만들기"), array("square_key" => "http://tarks.net/fsquare", "title" => "Square Forum 방문하기."), array("square_key" => "w8UkEWEiFGzi", "title" => "Square 3.8 패치 노트"));
        //   $new_collection = $SQUARE_CLASS->getCollection($PAGE_CLASS, $ATTACH_CLASS, $user_srl, "new", 0, 4, $square_info, $attach_info);


        $result = array('top' => $top_items);


        return $result;
    }


    function getCollection($PAGE_CLASS, $ATTACH_CLASS, $user_srl, $name, $start, $number, $info, $attach_info)
    {

        // $other_srl = 0;
        //  $status = setRelationStatus($user_srl, $other_srl);
        $status = 0;

        $row = null;


        if ($name == "new") {

            $row = Model_Square_getLastUpdates($status, $user_srl, $start, $number);


            if ($attach_info != null) {
                $total = mysqli_num_rows($row);

                for ($i = 0; $i < $total; $i++) {
                    mysqli_data_seek($row, $i);           //포인터 이동
                    $result = mysqli_fetch_array($row);        //레코드를 배열로 저장

                    //  echo print_info($result, $doc_info);
                    if ($attach_info != null && $result['attach'] != 0) $result['attach_contents'] = json_encode($ATTACH_CLASS->attach_read($user_srl, "square", $result['srl'], 0, $attach_info));

                    $array[] = array_info_match($result, $info);
                }
            }

        }


        // if ($doc_page_srl_info['status'] > $status || $doc_page_srl_info == null) $array = false;
        return $array;
    }

    function document_getAllList($user_srl, $start, $number)
    {
//	$user_srl = AuthCheck($user_srl, false);
        $status = setRelationStatus($user_srl, $doc_user_srl);
        return DBQuery("SELECT * FROM  `documents` WHERE  (`status` <=$status OR (`user_srl` =$user_srl AND `status` < 5)) ORDER BY  `documents`.`srl` DESC LIMIT $start , $number");
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
                    $row = DBQuery("SELECT * FROM  `documents` WHERE  `page_srl` =$user_array[$i] AND (`status` <=$status OR (`user_srl` =$user_srl AND `status` < 5)) ORDER BY  `documents`.`srl` DESC");
                mysqli_data_seek($row, 0);
                $result = mysqli_fetch_array($row);
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




        $total = mysqli_num_rows($row);
        for ($i = 0; $i < $total; $i++) {
            mysqli_data_seek($row, $i);           //포인터 이동
            $result = mysqli_fetch_array($row);        //레코드를 배열로 저장
          //  echo print_info($result, $doc_info);
            $array[] = array_info_match($result, $doc_info);
        }



        echo json_encode($array);
    }


}
      
?>