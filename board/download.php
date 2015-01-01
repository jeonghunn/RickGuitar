<?php
$srl = mysql_real_escape_string($_GET['v']);

//Userupdatecontents
$users_srl = mysql_real_escape_string($_POST['users_srl']);

$log = "$srl";
$log_category = "attach_download";


define('642979',   TRUE);
require_once '../config.php';



//Change Auth code to tarks account
require 'attach_class.php';

$attach_info = getAttachInfoByfileValue($srl);
$path = "../files/binaries/".$attach_info[filevalue];

addAttachDownloadCount($attach_info[srl]);

function mb_basename($path) { return end(explode('/',$path)); } 
function utf2euc($str) { return iconv("UTF-8","cp949//IGNORE", $str); }
function is_ie() { return isset($_SERVER['HTTP_USER_AGENT']) && strpos($_SERVER['HTTP_USER_AGENT'], 'MSIE') !== false; }

$filesize = filesize($path);
$filename = $attach_info[filename];
//$filename = mb_basename($path);
if( is_ie() ) $filename = utf2euc($filename);
 
header("Pragma: public");
header("Expires: 0");
header("Content-Type: application/octet-stream");
header("Content-Disposition: attachment; filename=\"$filename".".".$attach_info[extension]."\"");
header("Content-Transfer-Encoding: binary");
header("Content-Length: $filesize");
 
ob_clean();
flush();
readfile($path);


      
?>