<?php if(!defined("642979")) exit();
    if(strpos($log, "/LINE/.")) ErrorMessage("security_error"); 

    function Security_value_check($value) {
 if(strpos($$value, "/LINE/.")) ErrorMessage("security_error"); 
    }

    //Char check
function rtnSpecialCharCheck($str)
{
 if(preg_match("/[#\&\\+\-%@=\/\\\:;,\.\'\"\^`~\_|\!\/\?\*$#<>()\[\]\{\}]/i", $str,  $match))
 {
  return false;
 }
 return true;
}
      
?>