<?

$authcode = $_POST['authcode'];
$user_srl = mysql_real_escape_string($_POST['user_srl']);
$user_srl_auth = mysql_real_escape_string($_POST['user_srl_auth']);
$lang = mysql_real_escape_string($_POST['lang']);
$member_info = mysql_real_escape_string($_POST['member_info']);
$log = "$lang&&$member_info";

define('642979',   TRUE);
require 'db.php';
//mysql_select_db('favorite',$db_conn);

//Check Permission
if($authcode != $auth) exit();

//Auth code to user_srl
require 'core/auth.php';
require 'member/member_info_class.php';
$user_srl = AuthCheck($user_srl_auth, false);

//Log Client
ClientAgentLog();

//Update new member information
    MemberInfoUpdate($user_srl, $lang);
    //Echo member information
   $row = GetMemberInfo($user_srl);

    
  Print_member_info($row, ExplodeMemberInfoValue($member_info));
?>