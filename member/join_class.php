<?php
//You must import auth.php when use this class

 function GetTarksAccountInfo($tarks_account, $value) {
ConnectDB("xe");
 	$xesql ="SELECT $value FROM  `xe_member` WHERE  `user_id` LIKE '$tarks_account'";
$xeresult = mysql_query($xesql);
$xerow=mysql_fetch_array($xeresult);
ConnectMainDB();
return $xerow[$value];
 }

//Find lastest number.
 function MemberLastNumber(){
  $user_table_status =mysql_fetch_array(mysql_query("SHOW TABLE STATUS LIKE 'user'"));
  return $user_table_status['Auto_increment'];  
 }

//add 1
    
      //Find the Same Reg ID
    function CheckSameRegID($reg_id){
 $CheckSameRegID = mysql_fetch_array(mysql_query("SELECT * FROM  `user` WHERE  `reg_id` LIKE '$reg_id'"));
 return $CheckSameRegID;
    }


    //Tarks Account
    function CheckSameTarksAccount($tarks_account){
 $CheckSameTarksAccount = mysql_fetch_array(mysql_query("SELECT * FROM  `user` WHERE  `tarks_account` LIKE '$tarks_account'"));
 return $CheckSameTarksAccount;
    }

//requrie favorite_class.php
   function CreatePage($user_srl_auth, $name, $lang, $country, $profile_pic){
           global  $_FILES ,$date, $REMOTE_ADDR;
         $user_srl = AuthCheck($user_srl_auth, false);
                     //If not page return
        if($user_srl == 0) return false;
           // Get MemberLastNumber
        $MemberNumber = MemberLastNumber();
            //Get Auth Code
            $auth_code = MakeAuthCode("36" , $MemberNumber, "user_srl");

          if($profile_pic == "Y") ProfileUpdate($MemberNumber);
              
           //add user to db
           $sql ="INSERT INTO `user` (`tarks_account`, `admin`, `name_2`, `lang`, `country`, `permission`, `birthday`, `join_day`, `profile_pic`, `profile_update`, `last_update`, `reg_id`) VALUES ('null', '$user_srl', '$name', '$lang', '$country', '3', '0' ,'$date', '$profile_pic', '$date' , '$date' , 'null');";
            $result = mysql_query($sql);


 
             //Create Own Page
       //     $add_page = mysql_query("INSERT INTO `pages` (`user_srl`, `user_mode`,  `ip_addr`) VALUES ('$MemberNumber', 'Y', '$REMOTE_ADDR');");
            mysql_query("INSERT INTO `status` (`user_srl`, `phone_number`) VALUES ('$MemberNumber', '3');");
       
           favorite_add($MemberNumber, $user_srl_auth, '3');

            return array($MemberNumber, $auth_code);

    }
   


    function AddUser($tarks_account, $name_1, $name_2, $gender, $birthday, $country_code, $phone_number, $profile_pic, $reg_id, $lang, $country) {
        global  $date, $REMOTE_ADDR;
 //Add user to System

// Get MemberLastNumber
        $MemberNumber = MemberLastNumber();
            
            //Get Auth Code
            $auth_code = MakeAuthCode("36" , $MemberNumber, "user_srl");

//Profile picture
          if($profile_pic == "Y") ProfileUpdate($MemberNumber);
              
           //add user to db
           $sql ="INSERT INTO `user` (`tarks_account`, `name_1`, `name_2`, `gender`, `birthday`, `country_code`, `phone_number` ,`permission`, `join_day`, `profile_pic`, `profile_update`, `last_update`,  `reg_id`, `lang`, `country`) VALUES ('$tarks_account', '$name_1', '$name_2', '$gender', '$birthday', '$country_code', '$phone_number', '3', '$date', '$profile_pic', '$date', '$date', '$reg_id', '$lang', '$country');";
            $result = mysql_query($sql);


 
             //Create Own Page
       //     $add_page = mysql_query("INSERT INTO `pages` (`user_srl`, `user_mode`,  `ip_addr`) VALUES ('$MemberNumber', 'Y', '$REMOTE_ADDR');");
            mysql_query("INSERT INTO `status` (`user_srl`, `phone_number`) VALUES ('$MemberNumber', '3');");
       


            return array($MemberNumber, $auth_code);
    }

    function UpdateUser($user_srl, $tarks_account, $name_1, $name_2, $gender, $birthday, $country_code, $phone_number, $profile_pic, $reg_id, $country) {
           global $date;


                               if($profile_pic == "Y")  ProfileUpdate($user_srl);
               //add user to db
            $sql ="UPDATE `user` SET `name_1` = '$name_1', `name_2` = '$name_2', `gender` = '$gender', `country_code` = '$country_code', `phone_number` = '$phone_number', `profile_pic` = '$profile_pic', `profile_update` = '$date', `reg_id` = '$reg_id', `country` = '$country' WHERE `user_srl` = '$user_srl'";
            $result = mysql_query($sql);

            $auth_code = FindAuthCode($user_srl, "user_srl");

     
      //     unlink﻿("../files/profile/".$user_srl.".jpg");
           

             return array($user_srl, $auth_code);
    }
    

     function DeleteUser($user_srl) {
 $deletesql ="DELETE FROM `user` WHERE `user_srl` = '$user_srl'";
            $deleteresult = mysql_query($deletesql);



     }


      function AddUserActivityByApp(){
           global $tarks_account, $name_1, $name_2, $gender, $birthday, $country_code, $phone_number, $profile_pic, $reg_id, $lang, $country;
          $AddUserAct = AddUser($tarks_account, $name_1, $name_2, $gender, $birthday, $country_code, $phone_number, $profile_pic, $reg_id, $lang, $country);
          echo $AddUserAct[0]."//".$AddUserAct[1];
      }


function UpdateUserActivityByApp($user_srl){
           global $tarks_account, $name_1, $name_2, $gender, $birthday, $country_code, $phone_number, $profile_pic, $reg_id, $country;
           $UpdateUserAct = UpdateUser($user_srl, $tarks_account, $name_1, $name_2, $gender, $birthday, $country_code, $phone_number, $profile_pic, $reg_id, $country);
           echo $UpdateUserAct[0]."//".$UpdateUserAct[1];
      }


    
?>