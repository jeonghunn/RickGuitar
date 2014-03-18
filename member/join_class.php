<?php
//You must import auth.php when use this class

 function TarksAccount($tarks_account, $value) {
    global $db_conn;
 	mysql_select_db('xe',$db_conn);
 	$xesql ="SELECT $value FROM  `xe_member` WHERE  `user_id` LIKE '$tarks_account'";
$xeresult = mysql_query($xesql);
$xerow=mysql_fetch_array($xeresult);
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
   


    function AddUser($tarks_account, $name_1, $name_2, $gender, $birthday, $country_code, $phone_number, $reg_id, $country) {
        global  $date;
 //Add user to System

// Get MemberLastNumber
        $MemberNumber = MemberLastNumber();
            
            //Get Auth Code
            $auth_code = MakeAuthCode("36" , $MemberNumber, "user_srl");

              //Profile picture
             $profile_pic = ProfileUpdate($MemberNumber) ? "Y" : "N";
 
           //add user to db
            $sql ="INSERT INTO `user` (`tarks_account`, `name_1`, `name_2`, `gender`, `birthday`, `country_code`, `phone_number` ,`permission`, `join_day`, `profile_pic`, `profile_update`, `reg_id`, `country`) VALUES ('$tarks_account', '$name_1', '$name_2', '$gender', '$birthday', '$country_code', '$phone_number', '3', '$date', '$profile_pic', '$date', '$reg_id', '$country');";
            $result = mysql_query($sql);
       


            return array($MemberNumber, $auth_code);
    }

    function UpdateUser($user_srl, $tarks_account, $name_1, $name_2, $gender, $birthday, $country_code, $phone_number, $reg_id, $country) {
           global $date;

             //Profile picture
             $profile_pic = ProfileUpdate($user_srl) ? "Y" : "N";

  //add user to db
            $sql ="UPDATE `user` SET `name_1` = '$name_1', `name_2` = '$name_2', `gender` = '$gender', `country_code` = '$country_code', `phone_number` = '$phone_number', `profile_pic` = '$profile_pic', `profile_update` = '$date', `reg_id` = '$reg_id', `country` = '$country' WHERE `user_srl` = '$user_srl'";
            $result = mysql_query($sql);

            $auth_code = FindAuthCode($user_srl, "user_srl");

             return array($user_srl, $auth_code);
    }
    

     function DeleteUser($user_srl) {
 $deletesql ="DELETE FROM `user` WHERE `user_srl` = '$user_srl'";
            $deleteresult = mysql_query($deletesql);



     }

      function ProfileUpdate($file_name) {
$target_path = "../files/profile/";
$tmp_img = explode("." ,$_FILES['uploadedfile']['name']); 
//$img_name = $file_name.".".$tmp_img[1];
$img_name = $file_name."."."jpg";
$target_path = $target_path . basename($img_name);

 $upload_result = move_uploaded_file($_FILES['uploadedfile']['tmp_name'], $target_path);

return $upload_result;
      }

      function AddUserActivityByApp(){
           global $tarks_account, $name_1, $name_2, $gender, $birthday, $country_code, $phone_number, $reg_id, $country;
          $AddUserAct = AddUser($tarks_account, $name_1, $name_2, $gender, $birthday, $country_code, $phone_number, $reg_id, $country);
          echo $AddUserAct[0]."//".$AddUserAct[1];
      }


function UpdateUserActivityByApp($user_srl){
           global $tarks_account, $name_1, $name_2, $gender, $birthday, $country_code, $phone_number, $reg_id, $country;
           $UpdateUserAct = UpdateUser($user_srl, $tarks_account, $name_1, $name_2, $gender, $birthday, $country_code, $phone_number, $reg_id, $country);
           echo $UpdateUserAct[0]."//".$UpdateUserAct[1];
      }


    
?>