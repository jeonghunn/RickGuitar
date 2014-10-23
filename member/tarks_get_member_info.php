<?
define('642979',   TRUE);
require '../config.php';
$authcode = mysql_real_escape_string($_POST['authcode']);
$tarks_account = mysql_real_escape_string($_POST['tarks_account']);



//Check Permission
if($authcode != $auth) ErrorMessage("auth_error");


    //Get Tarks Account Exist in db
    
$sql ="SELECT tarks_account FROM  `pages` WHERE  `tarks_account` LIKE '$tarks_account'";
$result = mysql_query($sql);
$row=mysql_fetch_array($result);
    
    //if Tarks Account Exist in DB
    if($tarks_account == $row[tarks_account]){



         //Send Imformation
        $sql ="SELECT * FROM  `pages` WHERE  `tarks_account` LIKE '$tarks_account'";
        $result = mysql_query($sql);
        $row=mysql_fetch_array($result);

        //Find auth key
          $auth_key = FindAuthCode($row[user_srl], "user_srl");
          //Send information
        echo "$row[user_srl]/LINE/.$auth_key/LINE/.$row[name_1]/LINE/.$row[name_2]/LINE/.$row[gender]/LINE/.$row[profile_pic]";
    }
   else{
       echo "null";
    }
    

   
      
?>