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
  $user_table_status =mysql_fetch_array(mysql_query("SHOW TABLE STATUS LIKE 'pages'"));
  return $user_table_status['Auto_increment'];  
 }

//add 1
    
      //Find the Same Reg ID
    function CheckSameRegID($reg_id){
 $CheckSameRegID = mysql_fetch_array(mysql_query("SELECT * FROM  `pages` WHERE  `reg_id` LIKE '$reg_id'"));
 return $CheckSameRegID;
    }


    //Tarks Account
    function CheckSameTarksAccount($tarks_account){
 $CheckSameTarksAccount = mysql_fetch_array(mysql_query("SELECT * FROM  `pages` WHERE  `tarks_account` LIKE '$tarks_account'"));
 return $CheckSameTarksAccount;
    }

    function CreateStatus($member_srl){
       $ExistStatus = mysql_fetch_array(mysql_query("SELECT * FROM  `status` WHERE  `user_srl` LIKE '$member_srl'"));
               if($ExistStatus == null)   mysql_query("INSERT INTO `status` (`user_srl`, `phone_number`) VALUES ('$member_srl', '3');");
    }

//requrie favorite_class.php
   function CreatePage($user_srl, $name, $lang, $country, $profile_pic){
           global  $_FILES ,$date, $REMOTE_ADDR;
       //  $user_srl = AuthCheck($user_srl, false);
                     //If not page return
           $user_info = getPageInfo($user_srl);
        if($user_info == null || $name == null) return false;
           // Get MemberLastNumber
        $MemberNumber = MemberLastNumber();
            //Get Auth Code
            $auth_code = MakeAuthCode("36" , $MemberNumber, "user_srl");

          if($profile_pic == "Y") ProfileUpdate($MemberNumber);
              $popularity = intval($date/10000);
           //add user to db
           $sql ="INSERT INTO `pages` (`tarks_account`, `admin`, `name_2`, `lang`, `country`, `permission`, `birthday`, `join_day`, `profile_pic`, `profile_update`, `last_update`, `reg_id`, `ip_addr`, `popularity`) VALUES ('null', '$user_srl', '$name', '$lang', '$country', '3', '0' ,'$date', '$profile_pic', '$date' , '$date' , 'null', '$REMOTE_ADDR', '$popularity');";
            $result = mysql_query($sql);


 
             //Create Own Page
       //     $add_page = mysql_query("INSERT INTO `pages` (`user_srl`, `user_mode`,  `ip_addr`) VALUES ('$MemberNumber', 'Y', '$REMOTE_ADDR');");
CreateStatus($MemberNumber);
       
           favorite_add($MemberNumber, $user_srl, '3');

            return array($MemberNumber, $auth_code);

    }
   

function SignUpTarksAccount($email, $id, $password){
  global $date;
  $nowdate = date('YmdHis');
if(!rtnSpecialCharCheck($id)) return "special_char_error";
if($email == null || $id == null || $password == null) return false;
if(strlen($id) < 3 || strlen($id) > 20 ) return "id_length_error";
if(strlen($password) < 6 || strlen($password) > 20 ) return "password_length_error";
$password = md5($password);
$email_array = explode("@",$email);
$extra_vars = 'O:8:"stdClass":1:{s:15:"xe_validator_id";s:42:"modules/member/skins/default/signup_form/1";}';
$nick_name = $date.GenerateString(3);
 ConnectDB("xe");
  $email_check = mysql_fetch_array(mysql_query("SELECT * FROM  `xe_member` WHERE  `email_address` LIKE '$email'"));
   $id_check = mysql_fetch_array(mysql_query("SELECT * FROM  `xe_member` WHERE  `user_id` LIKE '$id'"));
  if($email_check['email_address'] == $email) return "email_exist_error";
  if($id_check['user_id'] == $id) return "id_exist_error";
 $seq = getTarksSeqLastNumber();
 $seq_insert = mysql_query("INSERT INTO `xe_sequence` (`seq`) VALUES (NULL);");
 if($seq_insert) $tarks_signup = mysql_query("INSERT INTO `xe_member` (`member_srl`, `user_id`, `email_address`, `password`, `email_id`, `email_host`, `nick_name`, `regdate`, `last_login`, `change_password_date`, `extra_vars`, `list_order`) VALUES ('$seq', '$id', '$email', '$password' ,  '$email_array[0]', '$email_array[1]', '$nick_name', '$nowdate', '$nowdate', '$nowdate', '$extra_vars', '-$seq');");
ConnectMainDB();

return $tarks_signup;
}


//Find lastest number.
 function getTarksSeqLastNumber(){
  $table_status =mysql_fetch_array(mysql_query("SHOW TABLE STATUS LIKE 'xe_sequence'"));
  return $table_status['Auto_increment'];  
 }

    function AddUser($tarks_account, $admin, $name_1, $name_2, $gender, $birthday, $country_code, $phone_number, $profile_pic, $reg_id, $lang, $country) {
        global  $date, $REMOTE_ADDR;
 //Add user to System

// Get MemberLastNumber
        $MemberNumber = MemberLastNumber();
            
            //Get Auth Code
            $auth_code = MakeAuthCode("36" , $MemberNumber, "user_srl");

//Profile picture
          if($profile_pic == "Y") ProfileUpdate($MemberNumber);
               $popularity = intval($date/10000);
           //add user to db
           $sql ="INSERT INTO `pages` (`tarks_account`, `status`,  `admin`, `name_1`, `name_2`, `gender`, `birthday`, `country_code`, `phone_number` ,`permission`, `join_day`, `profile_pic`, `profile_update`, `last_update`,  `reg_id`, `lang`, `country` , `popularity`) VALUES ('$tarks_account', '0', '$admin', '$name_1', '$name_2', '$gender', '$birthday', '$country_code', '$phone_number', '3', '$date', '$profile_pic', '$date', '$date', '$reg_id', '$lang', '$country', '$popularity');";
            $result = mysql_query($sql);


 
             //Create Own Page
       //     $add_page = mysql_query("INSERT INTO `pages` (`user_srl`, `user_mode`,  `ip_addr`) VALUES ('$MemberNumber', 'Y', '$REMOTE_ADDR');");
      CreateStatus($MemberNumber);
       


            return array($MemberNumber, $auth_code);
    }

    function UpdateUser($user_srl, $tarks_account, $name_1, $name_2, $gender, $birthday, $country_code, $phone_number, $profile_pic, $reg_id, $country) {
           global $date;


                               if($profile_pic == "Y")  ProfileUpdate($user_srl);
               //add user to db
            $sql ="UPDATE `pages` SET `name_1` = '$name_1', `name_2` = '$name_2', `gender` = '$gender', `country_code` = '$country_code', `phone_number` = '$phone_number', `profile_pic` = '$profile_pic', `profile_update` = '$date', `reg_id` = '$reg_id', `country` = '$country' WHERE `user_srl` = '$user_srl'";
            $result = mysql_query($sql);

            $auth_code = FindAuthCode($user_srl, "user_srl");

     
      //     unlink﻿("../files/profile/".$user_srl.".jpg");
           

             return array($user_srl, $auth_code);
    }
    

     function DeleteUser($user_srl) {
 $deletesql ="DELETE FROM `pages` WHERE `user_srl` = '$user_srl'";
            $deleteresult = mysql_query($deletesql);



     }


      function AddUserActivityByApp(){
           global $admin, $tarks_account, $name_1, $name_2, $gender, $birthday, $country_code, $phone_number, $profile_pic, $reg_id, $lang, $country;
          $AddUserAct = AddUser($tarks_account, $admin ,$name_1, $name_2, $gender, $birthday, $country_code, $phone_number, $profile_pic, $reg_id, $lang, $country);
          echo $AddUserAct[0]."//".$AddUserAct[1];
      }


function UpdateUserActivityByApp($user_srl){
           global $tarks_account, $name_1, $name_2, $gender, $birthday, $country_code, $phone_number, $profile_pic, $reg_id, $country;
           $UpdateUserAct = UpdateUser($user_srl, $tarks_account, $name_1, $name_2, $gender, $birthday, $country_code, $phone_number, $profile_pic, $reg_id, $country);
           echo $UpdateUserAct[0]."//".$UpdateUserAct[1];
      }


    
?>