<?
define('642979',   TRUE);
require 'db.php';
$authcode = $_POST['authcode'];



// Set UTF-8

mysql_query("set session character_set_connection=utf8;");
mysql_query("set session character_set_results=utf8;");
mysql_query("set session character_set_client=utf8;");


//Check Permission
if($authcode == $auth) {



    echo "1.0";
    
    
}
   
      
?>