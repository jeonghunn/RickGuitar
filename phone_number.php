<?

$user_srl =$_POST['user_srl'];
$authcode = $_POST['authcode'];
$value_1 = $_POST['phone_number'];
$people = 0;
//Protect
$protect = 0;

//Phone number replace
$value_1 = preg_replace ("/[ #\&\+\-%@=\/\\\:;,\.'\"\^`~\_|\!\?\*$#<>()\[\]\{\}]/i", "",  $value_1);


//DB
define('642979',   TRUE);
require 'db.php';
mysql_select_db('favorite',$db_conn);


// Set UTF-8

mysql_query("set session character_set_connection=utf8;");
mysql_query("set session character_set_results=utf8;");
mysql_query("set session character_set_client=utf8;");


//Check Permission
if($authcode != $auth) exit();

    //Count +1
    //Find lastest number.
$insert_number = "SELECT check_test FROM  `count` WHERE  `check_test` >=0";
$insert_number_result = mysql_query($insert_number);
$number_row =mysql_fetch_array($insert_number_result);

//add 1
$result_number = $number_row[check_test] + 1;


//Add count to System
            $add_user_to_system ="UPDATE `count` SET  `check_test` = '$result_number'";
            $system_result = mysql_query($add_user_to_system);


    //get Phone number
    
 $sql ="SELECT user_srl FROM  `phone_number` WHERE  `phone_number` LIKE '$value_1'";
 $result = mysql_query($sql);
 //$row=mysql_fetch_array($result);
    while($row = mysql_fetch_array($result)){
    $people = $people + 1;
     echo "$row[user_srl]/";
 }
 //if no
 if($people == 0){
 	echo "0";
 }
   echo "*DIVIDE*$people";

   
      
?>