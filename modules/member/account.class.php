<?php
/**
 * User: JHRunning
 * Date: 1/8/15
 * Time: 10:59 AM
 */


class AccountClass{

function AccountLogin($MEMBER_CLASS, $email, $password){
    $password = hash('sha256',$password);
    $loginResult = $this -> CheckAccount($email, $password);

    if($loginResult){
        return true;
    }


   return false;
}

    function CheckAccount($email, $password){
   //     if(!rtnSpecialCharCheck($password)) return false;
        if($email == null || $password == null) return false;
        $row = mysql_fetch_array(mysql_query("SELECT * FROM  `accounts` WHERE  `email_address` LIKE '$email' AND  `password` LIKE '$password'"));
       // $row['email_address'] = "jeonghunn@naver.com";
        if($email == $row['email_address']) {
            return true;
        }else{
            security_passwordWrong();

        }
        return false;
    }

//    function MakeTarksAccountAuthCode($id, $password){
//        $password = md5($password);
//        $loginResult = $this -> TarksAccount($id, $password);
//        if($loginResult){
////Connect main db to auth
//
//            $auth_code_result = MakeAuthCode("15", $id, "tarks_account");
//            //Echo Auth code to client
////auth_code_result is value of result of auth
//        }
//        return $auth_code_result;
//    }


    function SignUpAccount($PAGE_CLASS ,$MEMBER_CLASS, $email, $password, $name_1, $name_2, $gender, $birthday, $country_code, $phone_number, $profile_pic, $reg_id, $lang, $country){

        //Check This is vaild
        if($email == null || $password == null) return false;
        if(!filter_var($email, FILTER_VALIDATE_EMAIL)) return email_invaild_error;
        if(strlen($password) < 6 || strlen($password) > 20 ) return password_length_error;
        if($name_2 == "") return name_invaild_error;
        $password = hash('sha256',$password);
        $email_array = explode("@",$email);
        $email_check = mysql_fetch_array(mysql_query("SELECT * FROM  `accounts` WHERE  `email_address` LIKE '$email'"));
        if($email_check['email_address'] == $email) return email_exist_error;

        //Create User Page
         $page_info = $PAGE_CLASS -> AddUser(0, $name_1, $name_2, $gender, $birthday, $country_code, $phone_number, $profile_pic, $reg_id, $lang, $country);
        //Create Account
      //  $last_number = $this ->  AccountLastNumber();CreateMemberInfo
       $signup = mysql_query("INSERT INTO `accounts` (  `page_srl`,  `email_address`, `password`, `email_id`, `email_host`, `status`, `date`, `ip_addr`, `last_login` ) VALUES (  '$page_info[0]', '$email', '$password' ,  '$email_array[0]', '$email_array[1]', '0',  '".getTimeStamp()."', '".getIPAddr()."' ,'".getTimeStamp()."');");
        //Create Member Info
        $MEMBER_CLASS -> CreateMemberInfo($page_info['0'], 'account', $email, 0);
        return $page_info;
    }

    //Find lastest number.
    function AccountLastNumber(){
        $account_table_status =mysql_fetch_array(mysql_query("SHOW TABLE STATUS LIKE 'accounts'"));
        return $account_table_status['Auto_increment'];
    }

    function GetAccountInfo($tarks_account, $value) {
        $xesql ="SELECT $value FROM  `xe_member` WHERE  `user_id` LIKE '$tarks_account'";
        $xeresult = mysql_query($xesql);
        $xerow=mysql_fetch_array($xeresult);
        return $xerow[$value];
    }


}


?>