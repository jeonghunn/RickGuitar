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

	//System
	function API_getCoreVersion(){
echo getCoreVersion();
	}

function API_getMyPageInfo($user_srl){
	$PAGE = new PageClass();
	require_once 'core/status.php';
$page_info = REQUEST('page_info');
//Update new member information
  $PAGE -> PageInfoUpdate($user_srl);

  print_info( $PAGE -> GetPageInfo($user_srl), ExplodeInfoValue($page_info));
}



function API_getPageInfo($user_srl){
	$PAGE = new PageClass();
	require_once 'core/status.php';

$page_srl = REQUEST('page_srl');
$page_info = REQUEST('page_info');

//Get Profile information
 $PageInfoRow = $PAGE -> PageInfo($user_srl, $page_srl, ExplodeInfoValue($page_info));
 //Print Profile information
 print_info($PageInfoRow, ExplodeInfoValue($page_info));
}

	//Tarks
	function API_AuthTarksAccount(){
		$TARKS_ACCOUNT = new TarksAccountClass();

		$id = REQUEST('id');
		$password = POST('password');

		$auth = $TARKS_ACCOUNT-> TarksAccountLogin($id, $password);


			echo $auth;



	}


	function API_MakeTarksAccountAuth(){

		$TARKS_ACCOUNT = new TarksAccountClass();
		$id = REQUEST('id');
		$password = POST('password');

		$auth = $TARKS_ACCOUNT-> MakeTarksAccountAuthCode($id, $password);


		echo $auth;



	}


function API_SignUpTarksAccount(){
	APICheckAct();
	$TARKS_ACCOUNT = new TarksAccountClass();

	$email = REQUEST('email');
	$id = REQUEST('id');
	$password = POST('password');

$tarks_signup = $TARKS_ACCOUNT -> SignUpTarksAccount($email, $id, $password);

if($tarks_signup == "true"){
echo "success";
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