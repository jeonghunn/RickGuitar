<?
define('642979',   TRUE);
require '../db.php';
mysql_select_db('favorite',$db_conn);
$authcode = $_POST['authcode'];
$tarks_account = $_POST['tarks_account'];


// Set UTF-8

mysql_query("set session character_set_connection=utf8;");
mysql_query("set session character_set_results=utf8;");
mysql_query("set session character_set_client=utf8;");


//Check Permission
if($authcode == $auth) {


    //Get Tarks Account Exist in db
    
$sql ="SELECT tarks_account FROM  `user` WHERE  `tarks_account` LIKE '$tarks_account'";
$result = mysql_query($sql);
$row=mysql_fetch_array($result);
    
    //if Tarks Account Exist in DB
    if($tarks_account == $row[tarks_account]){
         //Send Imformation
        $sql ="SELECT * FROM  `user` WHERE  `tarks_account` LIKE '$tarks_account'";
        $result = mysql_query($sql);
        $row=mysql_fetch_array($result);
        echo "$row[user_srl]/LINE/.$row[name_1]/LINE/.$row[name_2]/LINE/.$row[gender]";
    }
   else{
       echo "null";
    }
    
}
   
      
?>