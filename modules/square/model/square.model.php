<?php


function Model_Square_getSettingByName($name)
{
    return mysqli_fetch_array(DBQuery("SELECT * FROM  `settings` WHERE  `name` LIKE '$name' AND `status` = 0"));
}


?>