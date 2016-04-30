<?php if(!defined("642979")) exit();


    //UTF-8
//mysqli_query("set session character_set_connection=utf8;");
 //   mysqli_query("set session character_set_results=utf8;");
 //   mysqli_query("set session character_set_client=utf8;");

    //Connrct to main db
    ConnectMainDB();
//Connect to db
function ConnectMainDB(){
	ConnectDB("square");
}

function ConnectDB($db_name){
	$db_conn = mysqli_connect('localhost','root','password');
	mysqli_select_db($db_conn, $db_name) or FatalError();
}


?>