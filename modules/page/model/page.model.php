<?php


function Model_Page_addPage($category, $status, $admin, $name_1, $name_2, $gender, $birthday, $country_code, $phone_number, $permission, $profile_pic, $reg_id, $lang, $country, $popularity){
    return DBQuery("INSERT INTO `pages` ( `category`, `status`,  `admin`, `name_1`, `name_2`, `gender`, `birthday`, `country_code`, `phone_number` ,`permission`, `join_day`, `profile_pic`, `profile_update`, `last_update`,  `reg_id`, `lang`, `country` , `popularity`) VALUES ( '$category', '$status', '$admin', '$name_1', '$name_2', '$gender', '$birthday', '$country_code', '$phone_number', '$permission', '".getTimeStamp()."', '$profile_pic', '".getTimeStamp()."', '".getTimeStamp()."', '$reg_id', '$lang', '$country', '$popularity');");


}




      
