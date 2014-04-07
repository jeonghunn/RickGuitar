<?php
$page_srl = $_GET['p'];

session_start();
define('642979',   TRUE);
require 'config.php';

//Auth code to user_srl

require 'member/member_info_class.php';
require 'core/header.php';

if(!isset($_SESSION['user_srl_auth'])) {
	require 'member/login.php';

}else{
require 'member/profile.php'; 
}

require 'core/footer.php';

?>
