<?php
/**
 * User: JHRunning
 * Date: 1/8/15
 * Time: 10:59 AM
 */


class TarksAccountClass{

function TarksAccountLogin($id, $password){
    $password = md5($password);
    $loginResult = $this -> TarksAccount($id, $password);

    if($loginResult){
        $user_info = mysql_fetch_array(mysql_query("SELECT * FROM  `pages` WHERE  `tarks_account` LIKE '$id'"));
    }


    return  FindAuthCode($user_info['srl'], "user_srl");
}

    function TarksAccount($id, $password){
        if(!rtnSpecialCharCheck($id.$password)) return false;
        if($id == null || $password == null) return false;
        ConnectDB("xe");
        $row = mysql_fetch_array(mysql_query("SELECT * FROM  `xe_member` WHERE  `user_id` LIKE '$id' AND  `password` LIKE '$password'"));
        ConnectMainDB();
        if($id == $row['user_id']) {

            return true;
        }else{
            security_passwordWrong();
        }
        return false;
    }

    function MakeTarksAccountAuthCode($id, $password){
        $password = md5($password);
        $loginResult = $this -> TarksAccount($id, $password);
        if($loginResult){
//Connect main db to auth

            $auth_code_result = MakeAuthCode("15", $id, "tarks_account");
            //Echo Auth code to client
//auth_code_result is value of result of auth
        }
        return $auth_code_result;
    }


    function SignUpTarksAccount($email, $id, $password){
        $nowdate = date('YmdHis');
        if(!rtnSpecialCharCheck($id)) return "special_char_error";
        if($email == null || $id == null || $password == null) return false;
        if(!email_valid($email)) return "email_invaild_error";
        if(strlen($id) < 3 || strlen($id) > 20 ) return "id_length_error";
        if(strlen($password) < 6 || strlen($password) > 20 ) return "password_length_error";
        $password = md5($password);
        $email_array = explode("@",$email);
        $extra_vars = 'O:8:"stdClass":1:{s:15:"xe_validator_id";s:42:"modules/member/skins/default/signup_form/1";}';
        $nick_name = getTimeStamp().GenerateString(3);
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

    function GetTarksAccountInfo($tarks_account, $value) {
        ConnectDB("xe");
        $xesql ="SELECT $value FROM  `xe_member` WHERE  `user_id` LIKE '$tarks_account'";
        $xeresult = mysql_query($xesql);
        $xerow=mysql_fetch_array($xeresult);
        ConnectMainDB();
        return $xerow[$value];
    }

    //Find lastest number.
    function getTarksSeqLastNumber(){
        $table_status =mysql_fetch_array(mysql_query("SHOW TABLE STATUS LIKE 'xe_sequence'"));
        return $table_status['Auto_increment'];
    }

}


?>