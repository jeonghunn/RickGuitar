<?php
$page_srl = $_GET['p'];

session_start();
define('642979',   TRUE);
require 'config.php';

//Auth code to user_srl

require 'member/member_class.php';

$user_srl_auth = $_SESSION['user_srl_auth'];
$user_info = getMemberInfo(AuthCheck($user_srl_auth, false));
$user_srl = $user_info[user_srl];
$user_name = SetUserName($user_info[lang], $user_info[name_1], $user_info[name_2]);

require 'core/header.php';


if(!isset($_SESSION['user_srl_auth'])) {
	require 'member/login.php';

}else{
$page_info = getMemberInfo($page_srl);
$page_name = SetUserName($page_info[lang], $page_info[name_1], $page_info[name_2]);


require 'member/profile.php'; 
}

require 'core/footer.php';

?>
