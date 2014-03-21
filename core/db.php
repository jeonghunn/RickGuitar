<?php if(!defined("642979")) exit();
    $db_conn = mysql_connect('localhost','root','tarksmysql?!?!?!');

    //UTF-8
mysql_query("set session character_set_connection=utf8;");
    mysql_query("set session character_set_results=utf8;");
    mysql_query("set session character_set_client=utf8;");

    
//Connect to db
mysql_select_db('favorite',$db_conn) or ErrorMessage("db_error");
?>