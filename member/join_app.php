<?php
//Variable
$authcode = $_POST['authcode'];
$tarks_account_auth = mysql_real_escape_string($_POST['tarks_account']);
$name_1 = mysql_real_escape_string($_POST['name_1']);
$name_2 = mysql_real_escape_string($_POST['name_2']);
$gender = mysql_real_escape_string($_POST['gender']);
$lang = mysql_real_escape_string($_POST['lang']);
$country_code = mysql_real_escape_string($_POST['country_code']);
$phone_number = mysql_real_escape_string($_POST['phone_number']);
$profile_pic = mysql_real_escape_string($_POST['profile_pic']);
$reg_id = mysql_real_escape_string($_POST['reg_id']);
$country = mysql_real_escape_string($_POST['country']);
$log = "$name_1&&$name_2&&$reg_id&&$tarks_account_auth";


define('642979',   TRUE);
require '../config.php';

//Check auth code
if($authcode != $auth) ErrorMessage("auth_error");


require 'join_class.php';


if($tarks_account_auth != "null"){
$tarks_account = AuthCheck($tarks_account_auth, true);
$birthday = TarksAccount($tarks_account, "birthday");
}else{
    $tarks_account = "null";
}

//Check Reg Id and Tarks Account
  $row = CheckSameRegID($reg_id);
  $tarksrow = CheckSameTarksAccount($tarks_account);




//Check Tarks Account
          if($tarks_account != "null"){
          	  if($tarks_account == $tarksrow[tarks_account]){
                  UpdateUserActivityByApp($tarksrow[user_srl]);
          	  }else{
          	  	 //if this is have tarks account
        if($row[tarks_account] == "null"){
            //Delete Old one Add new one
            //Delete Old Account
           DeleteUser($row[user_srl]);
        }
         AddUserActivityByApp();
          	  }
       
        }else{
        	//If no Tarks Account
        	//Check REGID 
        	 if($reg_id != "null"){
        	 	//Delete User if same reg id, not null and no tarks account
        	 	  if($reg_id == $row[reg_id] && $reg_id != "null" && $row[tarks_account] == "null"){
        	 	  	//IF more than two same reg id
        	 	  	  DeleteUser($row[user_srl]);
        	 	  }

        	 }
        AddUserActivityByApp();
        }
  


    
?>