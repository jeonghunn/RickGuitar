<?
//Variable
$authcode = $_POST['authcode'];
$tarks_account_auth = addslashes($_POST['tarks_account']);
$name_1 = addslashes($_POST['name_1']);
$name_2 = addslashes($_POST['name_2']);
$gender = addslashes($_POST['gender']);
$reg_id = addslashes($_POST['reg_id']);
$log = "$name_1&&$name_2&&$reg_id&&$tarks_account_auth";


define('642979',   TRUE);
require '../db.php';
//mysql_select_db('favorite',$db_conn);


//Check auth code
if($authcode != $auth) exit();

//Change Auth code to tarks account
require '../auth.php';

//
 function TarksAccount($tarks_account, $value) {
    global $db_conn;
 	mysql_select_db('xe',$db_conn);
 	$xesql ="SELECT $value FROM  `xe_member` WHERE  `user_id` LIKE '$tarks_account'";
$xeresult = mysql_query($xesql);
$xerow=mysql_fetch_array($xeresult);
return $xerow[$value];
 }

if($tarks_account_auth != "null"){
$tarks_account = AuthCheck($tarks_account_auth, true);
$birthday = TarksAccount($tarks_account, "birthday");
mysql_select_db('favorite',$db_conn);
}else{
    $tarks_account = "null";
}



//Find lastest number.
// $insert_number = "SELECT user FROM  `count` WHERE  `user` >=0";
// $insert_number_result = mysql_query($insert_number);
// $number_row =mysql_fetch_array($insert_number_result);
$result = mysql_query("SHOW TABLE STATUS LIKE 'user'");
$row = mysql_fetch_array($result);
$result_number = $row['Auto_increment'];  

//add 1
// $result_number = $number_row[user] + 1;
    
    //Find the Same Reg ID
    $sql ="SELECT * FROM  `user` WHERE  `reg_id` LIKE '$reg_id'";
    $result = mysql_query($sql);
    $row=mysql_fetch_array($result);

    //Tarks Account
        $tarkssql ="SELECT * FROM  `user` WHERE  `tarks_account` LIKE '$tarks_account'";
    $tarksresult = mysql_query($tarkssql);
    $tarksrow=mysql_fetch_array($tarksresult);


    function AddUser() {
        global $result_number, $tarks_account, $name_1, $name_2, $gender, $birthday, $date, $reg_id;
 //Add user to System
            // $add_user_to_system ="UPDATE `count` SET  `user` = '$result_number'";
            // $system_result = mysql_query($add_user_to_system);
            
            //add user to db
            $sql ="INSERT INTO `user` (`tarks_account`, `name_1`, `name_2`, `gender`, `birthday`, `permission`, `join_day`, `reg_id`) VALUES ('$tarks_account', '$name_1', '$name_2', '$gender', '$birthday', '3', '$date', '$reg_id');";
            $result = mysql_query($sql);
            
            $auth_code = MakeAuthCode($result_number, "user_srl");
            echo "$result_number//$auth_code";
    }

    function UpdateUser($user_srl) {
           global $result_number, $tarks_account, $name_1, $name_2, $gender, $birthday, $date, $reg_id;
  //add user to db
            $sql ="UPDATE `user` SET `name_1` = '$name_1', `name_2` = '$name_2', `gender` = '$gender', `reg_id` = '$reg_id' WHERE `user_srl` = '$user_srl'";
            $result = mysql_query($sql);

            $auth_code = FindAuthCode($user_srl, "user_srl");
            echo "$user_srl//$auth_code";
    }

     function DeleteUser($user_srl) {
 $deletesql ="DELETE FROM `user` WHERE `user_srl` = '$user_srl'";
            $deleteresult = mysql_query($deletesql);



     }
    
    if($reg_id == "null"){
        //If no REGID
        //Check Tarks Account Exist
         //Find the Same Tarks Account


        if($tarks_account == $tarksrow[tarks_account]){
          UpdateUser($tarksrow[user_srl]);
        }else{
            AddUser();
        }

    }else{
    if($reg_id == $row[reg_id])
    {

//Matches with db and value but not to null
        if($tarks_account == $row[tarks_account] && $tarks_account != "null"){
            //add user to db
             UpdateUser($row[user_srl]);
        }else{
        //      //Check Account
        // $sql ="SELECT * FROM  `user` WHERE  `user_srl` LIKE '$row[user_srl]'";
        // $result = mysql_query($sql);
        // $row=mysql_fetch_array($result);
        //if this is have tarks account
        if($row[tarks_account] == "null"){
            //Delete Old one Add new one
            //Delete Old Account
           DeleteUser($row[user_srl]);
        }
          AddUser();
        }
    }else{
       
        if($tarks_account == $tarksrow[tarks_account] && $tarks_account != "null"){
            //add user to db
             UpdateUser($tarksrow[user_srl]);
        }else{
           AddUser();

        }
    }
    }
       
    
    
    


    
?>