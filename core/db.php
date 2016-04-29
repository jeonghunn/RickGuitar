<?php if(!defined("642979")) exit();
    $db_conn = mysqli_connect('localhost','root','pass');

    //UTF-8
mysqli_query("set session character_set_connection=utf8;");
    mysqli_query("set session character_set_results=utf8;");
    mysqli_query("set session character_set_client=utf8;");

    //Connrct to main db
    ConnectMainDB();
//Connect to db
function ConnectMainDB(){
	ConnectDB("square");
}

function ConnectDB($db_name){
	global $db_conn;
	mysqli_select_db($db_name,$db_conn) or FatalError();
}


?>