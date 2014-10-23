<?php if(!defined("642979")) exit();
    $db_conn = mysql_connect('localhost','root','password');

    //UTF-8
mysql_query("set session character_set_connection=utf8;");
    mysql_query("set session character_set_results=utf8;");
    mysql_query("set session character_set_client=utf8;");

    //Connrct to main db
    ConnectMainDB();
//Connect to db
function ConnectMainDB(){
	ConnectDB("favorite_test");
}

function ConnectDB($db_name){
	global $db_conn;
	mysql_select_db($db_name,$db_conn) or FatalError();
}


?>