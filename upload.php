<?php

$authcode = $_POST['authcode'];
$category = $_POST['category'];
if($category == "profile"){
	$target_path = "files/profile/";
}


$tmp_img = explode("." ,$_FILES['uploadedfile']['name']); 
$img_name = $tmp_img[0]."_".date('Y-m-d_H_i_s').".".$tmp_img[1];
$target_path = $target_path . basename($img_name);
if(move_uploaded_file($_FILES['uploadedfile']['tmp_name'], $target_path)) {
	echo "The file ".$img_name." has been uploaded".$authcode;
} else {
	echo "There was an error uploading the file, please try again!";
}

?>
