<?php
 require_once 'pages/base.php';
 
//Variable
$page_srl = GET('p');
$act_parameter = GET('a');
$loaded = false;

//Session
session_start();
$user_srl_auth = $_SESSION['user_srl_auth'];

//Lang

require_once "pages/lang/".getLang().".php";


//define('642979',   TRUE);
//require_once 'config.php';

//Auth code to user_srl

//member
//require_once 'member/member_class.php';

//board
//require_once 'board/documents_class.php';
//require_once 'board/attach_class.php';

//API
//require_once 'core/api.class.php';

//$user_info = getPageInfo(AuthCheck($user_srl_auth, false));
//$user_srl = $user_info['user_srl'];
//$user_name = SetUserName($user_info['lang'], $user_info['name_1'], $user_info['name_2']);

require_once 'pages/header.php';

//Check login
if(!CheckLogin()) {
//Check loginact

	if($act_parameter == "loginact"){


session_start();
$user_srl_auth = PostAct(getAPIUrl(),  array(array('a', 'login'), array('id', POST('id')), array('password', POST('password'))));
if($user_srl_auth != "null"){
$_SESSION['user_srl_auth'] = $user_srl_auth;
echo "<meta http-equiv='refresh' content='0;url=index.php'>";
}else{
	alert_error_print(T('login_failed'), T('login_failed_des'));
	require_once 'pages/login.php';

}
setLoaded(true);
	}
	
	if($act_parameter == "login") {
		require_once 'pages/login.php';
		setLoaded(true);
}


}
 
//Profile
		if($act_parameter == null && $page_srl != null){
		$page_info = getPageInfo($page_srl);
$page_name = SetUserName($page_info['lang'], $page_info['name_1'], $page_info['name_2']);
require 'pages/profile.php'; 
setLoaded(true);
}

//Guest, User all can
LoadPages("error", "error", false);
LoadPages("info", "info", false);

//API
	    LoadPages("api", "api/api_main", false);
		LoadPages("api_add", "api/api_add", true);




function checkLoaded(){
	global $loaded;
	$error_code = 404;
	if(!$loaded) require 'pages/error.php'; 
}


function LoadPages($ACTION, $page_name, $login_need){
	global $act_parameter, $loaded;
$accept = true;
if($login_need) $accept = CheckLogin();
 if($act_parameter == $ACTION){	
if($accept){
require_once 'pages/'.$page_name.'.php';
setLoaded(true);
}else{
	SettoLogin();
}
}
}

function SettoLogin(){
	echo "<meta http-equiv='refresh' content='0;url=login'>";
	setLoaded(true);
}


function setLoaded($b){
	global $loaded;
	$loaded = $b;
}

//Foot
checkLoaded();
require_once 'pages/footer.php';

?>
