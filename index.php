<?php
 require_once 'pages/base.php';
 
//Variable
$page_srl = GET('p');
$act_parameter = GET('a');
$loaded = false;

//Session
session_start();
$user_auth = $_SESSION['user_auth'];
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

$user_info = json_decode(PostAct(getAPIUrl(),  array(array('a', 'my_page_info'), array('apiv', getAPIVersion()), array('api_key', getAPIKey()), array('user_auth', $user_auth), array('page_info', 'tarks_account//admin//name_1//name_2//gender//birthday//country_code//phone_number//join_day//profile_pic//profile_update//lang//country//like_me//favorite//rel_you_status//rel_me_status'))), true);
//echo $user_info[0]['tarks_account'];

//$user_srl = $user_info['user_srl'];
$user_name = SetUserName($user_info[0]['lang'], $user_info[0]['name_1'], $user_info[0]['name_2']);

require_once 'pages/header.php';

//Check login
if(!CheckLogin()) {
//Check loginact

	if($act_parameter == "loginact"){


session_start();
$user_auth = PostAct(getAPISUrl(),   array(array('a', 'tarks_auth'),array('apiv', getAPIVersion()), array('api_key', getAPIKey()), array('id', POST('id')), array('password', POST('password'))));
if($user_auth != "null"){
$_SESSION['user_auth'] = $user_auth;
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
	    LoadPages("api_main", "api/api_main", false);
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
