<?
define('642979',   TRUE);
require 'config.php';
mysql_select_db('favorite',$db_conn);
$authcode = $_POST['authcode'];


// Set UTF-8

mysql_query("set session character_set_connection=utf8;");
mysql_query("set session character_set_results=utf8;");
mysql_query("set session character_set_client=utf8;");


//Check Permission
if($authcode == $auth) {



         //Send Imformation
        $sql ="SELECT * FROM  `count`";
        $result = mysql_query($sql);
        $row=mysql_fetch_array($result);
        echo "$row[user]/LINE/.$row[check_test]/LINE/.$row[request]/LINE/.$row[message]";
    
    
}
   
      
?>