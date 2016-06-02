<?php


function Model_Attach_attachRead($category, $doc_srl, $doc_status ,$user_srl ){
    return  mysqli_fetch_array(DBQuery("SELECT * FROM  `attach` WHERE  `doc_srl` = '$doc_srl' AND `category` = '$category'  AND  (`status` <=$doc_status OR (`user_srl` =$user_srl AND `status` < 5))"));


}

function Model_Attach_addAttch($page_srl, $category, $doc_srl, $user_srl, $kind, $filename, $extension , $filevalue, $url,  $size, $status){
   return DBQuery("INSERT INTO `attach` (`page_srl`, `category`, `doc_srl`, `user_srl`, `kind`, `filename`, `extension`, `filevalue`, `url`, `date`, `size`, `status` , `ip_addr`) VALUES ('$page_srl', '$category','$doc_srl', '$user_srl', '$kind', '$filename', '$extension', '$filevalue', $url', '" . getTimeStamp() . "', '$size', '$status','" . getIPAddr() . "');");
}




      
?>