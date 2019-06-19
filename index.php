<?php
define('642979',   TRUE);

 require_once 'pages/core/base.php';
require_once 'pages/lib/lib.loader.php'; //Load library

//Variable
$page_srl = GET('p');
$act_parameter = GET('a');
$loaded = false;

//Session
session_start();
if(isset($_COOKIE['AT'])){
    $_SESSION['user_auth'] = $_COOKIE['AT'];
}
$user_auth = $_SESSION['user_auth'];
if(strpos(REQUEST('keep_signed_in'), 'true') !== false)  setcookie('AT', $user_auth, time()+(60*60*24*100) );
//Logout
if($act_parameter == "logout") {
    session_destroy();
    unset($_COOKIE['AT']);
    setcookie('AT', null, 1);
    setLoaded(true);
    echo "<meta http-equiv='refresh' content='0;url=index.php'>";
}



//echo $user_auth;
//Lang

require_once "pages/lang/".getLang().".php";


$user_info = json_decode(PostAct(getAPIUrl(),  array(array('a', 'my_page_info'), array('apiv', getAPIVersion()), array('api_key', getAPIKey()), array('auth', $user_auth))), true);

$user_srl = $user_info['srl'];
$user_name = SetUserName($user_info['lang'], $user_info['name_1'], $user_info['name_2']);


//Check login
if(!CheckLogin()) {


	//signup
	if($act_parameter == "signupact"){
        $signupresult = PostAct(getAPISUrl(), array(array('a', 'account_sign_up'), array('apiv', getAPIVersion()), array('api_key', getAPIKey()), array('email', POST('email')), array('password', POST('password')),  array('name_2', explode("@", POST('email'))[0])));
        alert_dialog($signupresult);
       $signupresult_array = json_decode($signupresult , true);
        if (strpos($signupresult, 'error') !== false) {
            alert_dialog(T('sign_up_'.$signupresult_array['message']));
            require_once 'pages/modules/account/view/signup.php';
            setLoaded(true);
        }else{
            $act_parameter = "signinact"; //login now

		}

	}


//Check loginact

    if ($act_parameter == "signinact") {


session_start();
$user_auth = PostAct(getAPISUrl(), array(array('a', 'account_auth'), array('apiv', getAPIVersion()), array('api_key', getAPIKey()), array('email', POST('email')), array('password', POST('password'))));
        if (strpos($user_auth, 'error') !== false) {
            alert_dialog(T('login_failed_des'));
            require_once 'pages/modules/account/view/signin.php';
}else{
            $_SESSION['user_auth'] = $user_auth;



            echo "<script>window.location.href='index.php?keep_signed_in=".POST("keep_signed_in")."';</script>";


}
setLoaded(true);
	}
//
//	if($act_parameter == "signin") {
//        require_once 'pages/modules/account/view/signin.php';
//		setLoaded(true);
//}


}




//Guest, User all can
if (getActParameter() == "") $act_parameter = "home";
LoadPages("home", "modules/rick/view/rick_main", false);
LoadPages("error", "core/error", false);
LoadPages("info", "modules/info/view/info", false);
LoadPages("license", "modules/info/view/license", false);
LoadPages("infodetail", "infodetail", false);
LoadPages("signin", "modules/account/view/signin", false);
LoadPages("signup", "modules/account/view/signup", false);

//API
	    LoadPages("api_main", "api/api_main", false);
		LoadPages("api_add", "api/api_add", true);


//Check Key string
if ($act_parameter != null && !$loaded) {

    $square_key = $act_parameter;
    $square_result = json_decode(PostAct(getAPISUrl(), array(array('a', 'square_read'), array('apiv', getAPIVersion()), array('api_key', getAPIKey()), array('auth', getUserAuth()), array('square_key', $square_key))), true);
//if null
    if ($square_result['square_key'] != null) {
        require_once 'pages/modules/rick/view/square_view.php';

        setLoaded(true);
    }


}

//Channel
if ($act_parameter != null && !$loaded) {


    $collection_result = json_decode(PostAct(getAPISUrl(), array(array('a', 'square_collection'), array('apiv', getAPIVersion()), array('api_key', getAPIKey()), array('auth', getUserAuth()), array('name', $act_parameter), array('start_num', 0), array('number', 24))), true);

    // $square_result = json_decode(PostAct(getAPISUrl(), array(array('a', 'square_read'), array('apiv', getAPIVersion()), array('api_key', getAPIKey()), array('auth', getUserAuth()), array('square_key', $square_key))), true);
//if null
    if (count($collection_result) > 0) {
        require_once 'pages/modules/rick/view/square_collection.php';

        setLoaded(true);
    }


}



function checkLoaded(){
	global $loaded;
	$error_code = 404;
	if(!$loaded) require 'pages/core/error.php';
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
	echo "<meta http-equiv='refresh' content='0;url=signin'>";
	setLoaded(true);
}


function setLoaded($b){
	global $loaded;
	$loaded = $b;
}

//Foot
checkLoaded();
if(REQUEST('footer') != 'false') require_once 'pages/footer.php';

?>
