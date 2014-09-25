<?php
$page_srl = $_GET['p'];
$act_parameter = $_GET['a'];

session_start();
$user_srl_auth = $_SESSION['user_srl_auth'];


define('642979',   TRUE);
require 'config.php';

//Auth code to user_srl

require 'member/member_class.php';
require 'board/documents_class.php';

$user_info = getMemberInfo(AuthCheck($user_srl_auth, false));
$user_srl = $user_info[user_srl];
$user_name = SetUserName($user_info[lang], $user_info[name_1], $user_info[name_2]);

require 'core/header.php';


//Check login
if(!isset($_SESSION['user_srl_auth'])) {
//Check loginact

	if($act_parameter == "loginact"){

 $id = mysql_real_escape_string($_POST['id']);
$password = mysql_real_escape_string($_POST['password']);
session_start();
$user_srl_auth = TarksAccountLogin($id , $password);
if($user_srl_auth != "null"){
$_SESSION['user_srl_auth'] = $user_srl_auth;
echo "<meta http-equiv='refresh' content='0;url=index.php'>";
}else{
	alert_error_print(T('login_failed'), T('login_failed_des'));
	require 'member/login.php';
	security_passwordWrong();

}
	}else{
		require 'member/login.php';
	}

	

}else{

	if($page_srl != null){
		$page_info = getMemberInfo($page_srl);
$page_name = SetUserName($page_info[lang], $page_info[name_1], $page_info[name_2]);
require 'member/profile.php'; 
}else{

}


}

require 'core/footer.php';

?>
