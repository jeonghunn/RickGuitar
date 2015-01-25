<?php

class PageClass
{

    function PageInfoUpdate($user_srl)
    {
        $add_info_to_system = "UPDATE `pages` SET `ip_addr` = '" . getIPAddr() . "' WHERE `srl` = $user_srl";
        $system_result = mysql_query($add_info_to_system);
    }

    function ProfileInfoUpdate($user_srl, $title, $value)
    {
        $add_info_to_system = "UPDATE `pages` SET `$title` = '$value' WHERE `srl` = $user_srl";
        $system_result = mysql_query($add_info_to_system);
    }


    function GetPageInfo($user_srl)
    {
        $row = mysql_fetch_array(mysql_query("SELECT * FROM  `pages` WHERE  `srl` LIKE '$user_srl'"));
        return $row;
    }

    function AccessPageInfo($status, $row, $you_srl, $info){
        //Select status table
        $you_srl_status = mysql_fetch_array(mysql_query("SELECT * FROM  `status` WHERE  `user_srl` LIKE '$you_srl'"));

        $you_srl_info = mysql_fetch_array(mysql_query("SELECT * FROM  `pages` WHERE  `user_srl` LIKE '$you_srl'"));

        //    if($status < $you_srl_info[status]) $row = null;
        for ($i=0 ; $i < count($info);$i++){
            if($you_srl_status[$info[$i]] > $status || $you_srl_info['status'] > $status || $you_srl_status[$info[$i]] == null ||$you_srl_info['status'] == 5){
                $row[$info[$i]] = "null";
            }


        }

        return $row;
    }


//IF use this function you must import auth.php and private.php
    function PageInfo($user_srl, $page_srl, $page_info)
    {

//$user_srl = AuthCheck($user_srl, false);
//Get Member Info
        $row = $this -> GetPageInfo($page_srl);
        $row = $this -> AccessPageInfo(setRelationStatus($user_srl, $page_srl), $row, $page_srl, $page_info);
        $row['rel_you_status'] = setRelationStatus($user_srl, $page_srl);
        $row['rel_me_status'] = setRelationStatus($page_srl, $user_srl);

        return $row;
    }

    function ProfileUpdate($file_name)
    {
        global $_FILES;
        $target_path = "../files/profile/";
        $thumbnail_path = "../files/profile/thumbnail/";
        $tmp_img = explode(".", $_FILES['uploadedfile']['name']);
//$img_name = $file_name.".".$tmp_img[1];
        $img_name = $file_name . "." . "jpg";
        $target_path = $target_path . basename($img_name);

        $upload_result = move_uploaded_file($_FILES['uploadedfile']['tmp_name'], $target_path);
        Thumbnail::create($target_path,
            120, 120,
            SCALE_EXACT_FIT,
            Array(
                'savepath' => $thumbnail_path . $img_name
            ));
        $this -> ProfileInfoUpdate($file_name, "profile_update", getTimeStamp());
       $this ->  ProfileInfoUpdate($file_name, "profile_pic", "Y");
        return $upload_result;
    }


    function GetAllPageInfoByUpdate($user_srl, $start, $number)
    {
        $row = mysql_query("SELECT * FROM  `pages` WHERE  `status` < 4 ORDER BY  `pages`.`last_update` DESC LIMIT $start , $number");
        return $row;
    }

    function GetAllPageInfoByPopularity($user_srl, $start, $number)
    {
        $row = mysql_query("SELECT * FROM  `pages` WHERE  `status` < 4 ORDER BY  `pages`.`popularity` DESC LIMIT $start , $number");
        return $row;
    }


    function getPageAuth($user_srl, $page_srl)
    {
        $page_info = $this -> GetPageInfo($page_srl);
        if ($page_info['admin'] == $user_srl) $auth_code = FindAuthCode($page_srl, "user_srl");
        return $auth_code;
    }

    function PhoneNumberToPageNumber($phonenumbers)
    {
        $count = count($phonenumbers);
        if ($count <= 1) return false;
        for ($i = 0; $i < count($phonenumbers); $i++) {
            $orvalue = $i != 0 ? "OR" : "";
            $value = $value . $orvalue . " `phone_number` LIKE '%" . $phonenumbers[$i] . "%' ";
        }
        $row = mysql_query("SELECT * FROM  `pages` WHERE (" . $value . ") AND  `admin` = 0 ORDER BY  `pages`.`last_update` DESC LIMIT 0 ," . $count);
        return $row;
    }

    function updatePopularity($user_srl, $page_srl, $point)
    {

        if ($user_srl != $page_srl) {
            $mf = $this ->getPageInfo($page_srl);
           $this ->  ProfileInfoUpdate($page_srl, "popularity", $mf[popularity] + $point);
        }
    }

// You must import member_class.php
    function member_PrintListbyUpdate($row)
    {
        $total = mysql_num_rows($row);
        for ($i = 0; $i < $total; $i++) {
            mysql_data_seek($row, $i);           //포인터 이동
            $result = mysql_fetch_array($row);        //레코드를 배열로 저장
            //    $user_info = GetPageInfo($result[value]);
            $name = SetUserName($result['lang'], $result['name_1'], $result['name_2']);
            $profile[] = array("last_update" => $result['last_update'], "user_srl" => $result['user_srl'], "name" => $name);
        }

        foreach ($profile as $key => $row) {
            $last_update[$key] = $row['last_update'];
            $user_srl[$key] = $row['user_srl'];
        }

// volume 내림차순, edition 오름차순으로 데이터를 정렬 
// 공통 키를 정렬하기 위하여 $data를 마지막 인수로 추가 
//array_multisort($last_update, SORT_DESC, $user_srl, SORT_ASC, $profile);

        foreach ($profile as $key => $value) {
            echo $value['user_srl'] . "/LINE/." . $value['name'] . "/PFILE/.";
        }

    }


}
      
?>