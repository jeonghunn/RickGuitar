<?php if(!defined("642979")) exit();

class APIClass{

	function hello_world(){
echo "Hello World!";
}


//API AUTH
function API_AUTH($auth_key){

}

function API_addAPI($user_srl, $name, $des){

}

function API_load_app($user_srl){
$page_info = mysql_real_escape_string($_REQUEST['page_info']);
//Update new member information
    PageInfoUpdate($user_srl);

  print_info(GetPageInfo($user_srl), ExplodeInfoValue($page_info));
}



function API_getPageInfo($user_srl){
  require 'core/status.php';

$page_srl = mysql_real_escape_string($_REQUEST['page_srl']);
$page_info = mysql_real_escape_string($_REQUEST['page_info']);

//Get Profile information
 $PageInfoRow = PageInfo($user_srl, $page_srl, ExplodeInfoValue($page_info));
 //Print Profile information
 print_info($PageInfoRow, ExplodeInfoValue($page_info));
}

function API_SignUpTarksAccount(){
	  require 'member/join_class.php';

	$email = mysql_real_escape_string($_REQUEST['email']);
	$id = mysql_real_escape_string($_REQUEST['id']);
	$password = mysql_real_escape_string($_POST['password']);

$tarks_signup = SignUpTarksAccount($email, $id, $password);

if($tarks_signup == "true"){
echo "succeed";
}else{

if($tarks_signup != false){
	echo $tarks_signup;
}else{
	echo "error";
}


}
}




}




?>