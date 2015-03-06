<?php
define('642979',   TRUE);
 require_once 'core/base.php';
 require_once 'core/db.php';

$API_VERSION = (int) REQUEST('apiv');
$ACTION = REQUEST('a');
$page_auth =POST('auth');
$api_key =REQUEST('api_key');

//Log
$log = REQUEST('page_srl');
$log_category = $ACTION;


require_once 'config.php';
require_once 'core/api.class.php';
require_once 'core/Thumbnail.class.php';
require_once 'modules/page/page.class.php';
require_once 'modules/member/member.class.php';
require_once 'modules/member/tarks_account.class.php';
require_once 'modules/board/documents.class.php';
require_once 'modules/board/comment.class.php';
require_once 'modules/board/attach.class.php';


//$user_srl = AuthCheck($page_auth, false);

$API = new APIClass();
if($api_key == null) ErrorMessage('api_error');


if($ACTION == "hello_world") $API -> hello_world();
if($ACTION == "CoreVersion") $API -> API_getCoreVersion();


//Page
if($ACTION == "page_info") $API -> API_getPageInfo($user_srl);
if($ACTION == "my_page_info") $API -> API_getMyPageInfo($user_srl);
//Page - ADD
if($ACTION == "page_join") $API -> API_PageJoin();

//Member
if($ACTION == "tarks_auth") $API -> API_AuthTarksAccount();
if($ACTION == "make_tarks_authcode") $API -> API_MakeTarksAccountAuth();
if($ACTION == "tarks_sign_up") $API -> API_SignUpTarksAccount();

//Board
if($ACTION == "doc_list") $API -> API_getDocList($user_srl);
if($ACTION == "doc_write") $API -> API_DocWrite($user_srl);
if($ACTION == "doc_read") $API -> API_DocRead($user_srl);
if($ACTION == "comment_list") $API -> API_getCommentList($user_srl);
if($ACTION == "comment_write") $API -> API_CommentWrite($user_srl);


?>