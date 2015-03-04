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


	//Page
function API_getMyPageInfo($user_srl){
	$PAGE = new PageClass();
	//require_once 'core/status.php';

$page_info = REQUEST('page_info');
//Update new member information
	$PageInfoRow = $PAGE -> PageInfo($user_srl, $user_srl ,  ExplodeInfoValue($page_info));

	print_info($PageInfoRow, ExplodeInfoValue($page_info));
}



function API_getPageInfo($user_srl){
	$PAGE = new PageClass();
	//require_once 'core/status.php';

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
        $MEMBER_CLASS = new MemberClass();

		$id = REQUEST('id');
		$password = POST('password');

		$auth = $TARKS_ACCOUNT-> TarksAccountLogin($MEMBER_CLASS ,$id, $password);


			echo $auth;



	}

	//Page - Join
	function API_PageJoin()
	{
		$PAGE = new PageClass();
		$TARKS_ACCOUNT = new TarksAccountClass();


		$admin = REQUEST('admin');
		$tarks_account_auth = POST('tarks_account_auth');
		$name_1 = REQUEST('name_1');
		$name_2 = REQUEST('name_2');
		$gender = REQUEST('gender');
		$lang = REQUEST('lang');
		$country_code = REQUEST('country_code');
		$phone_number = REQUEST('phone_number');
		$profile_pic = REQUEST('profile_pic');
		$reg_id = REQUEST('reg_id');
		$country =REQUEST('counrtry');


		if($tarks_account_auth != null){
			$tarks_account = AuthCheck($tarks_account_auth, 'tarks_account', true);
			$birthday = $TARKS_ACCOUNT -> GetTarksAccountInfo($tarks_account, "birthday");
		}else{
			$tarks_account = "null";
		}

//Check Reg Id and Tarks Account
		$row = $PAGE -> CheckSameRegID($reg_id);
		$tarksrow = $PAGE -> CheckSameTarksAccount($tarks_account);




//Check Tarks Account
		if($tarks_account != "null"){
			if($tarks_account == $tarksrow['tarks_account']){
				$PAGE -> UpdateUserActivityByApp($tarksrow['srl'], $tarks_account, $name_1, $name_2, $gender, $birthday, $country_code, $phone_number, $profile_pic, $reg_id, $country);
			}else{
				//if this is have tarks account
				if($row['tarks_account'] == "null"){
					//Delete Old one Add new one
					//Delete Old Account
					$PAGE -> DeleteUser($row['srl']);
				}
				$PAGE -> AddUserActivityByApp($tarks_account, $admin ,$name_1, $name_2, $gender, $birthday, $country_code, $phone_number, $profile_pic, $reg_id, $lang, $country);
			}

		}else{
			//If no Tarks Account
			//Check REGID
			if($reg_id != "null"){
				//Delete User if same reg id, not null and no tarks account
				if($reg_id == $row['reg_id'] && $reg_id != "null" && $row['tarks_account'] == "null" && $row['admin'] == 0){
					//IF more than two same reg id
					$PAGE -> DeleteUser($row['srl']);
				}

			}
			$PAGE -> AddUserActivityByApp($tarks_account, $admin ,$name_1, $name_2, $gender, $birthday, $country_code, $phone_number, $profile_pic, $reg_id, $lang, $country);
		}
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
    $MEMBER_CLASS = new MemberClass();

	$email = REQUEST('email');
	$id = REQUEST('id');
	$password = POST('password');

$tarks_signup = $TARKS_ACCOUNT -> SignUpTarksAccount($MEMBER_CLASS, $email, $id, $password);

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



    //Board

    function API_getDocList($user_srl){

        $DOCUMENT_CLASS = new DocumentClass();
        $PAGE_CLASS = new PageClass();

        $page_srl = REQUEST('page_srl');
        $start_doc = REQUEST('start_doc');
        $doc_number = REQUEST('doc_number');
        $doc_info = REQUEST('doc_info');

        $DocList = $DOCUMENT_CLASS -> document_getList($PAGE_CLASS, $user_srl, $page_srl, $start_doc, $doc_number);
        $DOCUMENT_CLASS -> document_PrintList($DocList, ExplodeInfoValue($doc_info));


    }


    function API_DocRead($user_srl){

        $DOCUMENT_CLASS = new DocumentClass();
        $PAGE_CLASS = new PageClass();

        $doc_srl = REQUEST('doc_srl');
        $doc_info = REQUEST('doc_info');

        $Doc_read = $DOCUMENT_CLASS -> document_read($PAGE_CLASS, $user_srl, $doc_srl);
        print_info($Doc_read, ExplodeInfoValue($doc_info));

    }

    function API_DocWrite(){


        $DOCUMENT_CLASS = new DocumentClass();
        $PAGE_CLASS = new PageClass();

        $document_write = $DOCUMENT_CLASS ->  document_write($PAGE_CLASS, $ATTACH_CLASS,   $page_srl, $user_srl , $title, $content, $permission, $status, $privacy);
        if($document_write == true){
            echo "success";
        }else{
            echo "error";
        }
    }


    //Comment

    function API_getCommentList($user_srl){



       $DOCUMENT_CLASS = new DocumentClass();
        $COMMENT_CLASS = new CommentClass();
        $PAGE_CLASS = new PageClass();


        $doc_srl = REQUEST('doc_srl');
        $comment_info = REQUEST('comment_info');
        $start_comment = REQUEST('start_comment');
        $comment_number = REQUEST('comment_number');




        $CommentList = $COMMENT_CLASS -> comment_getList($PAGE_CLASS, $DOCUMENT_CLASS, $user_srl, $doc_srl, $start_comment, $comment_number);
        $COMMENT_CLASS -> comment_PrintList($user_srl, $CommentList, ExplodeInfoValue($comment_info));
    }

}




?>