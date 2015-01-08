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



    return  FindAuthCode($user_info['user_srl'], "user_srl");
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
        $loginResult = $this -> TarksAccount($id, $password);
        if($loginResult){
//Connect main db to auth
            $auth_code_result = MakeAuthCode("15", $id, "tarks_account");
            //Echo Auth code to client
//auth_code_result is value of result of auth
        }
        return $auth_code_result;
    }

}


?>