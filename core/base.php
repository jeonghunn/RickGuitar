<?php


function getCoreVersion(){
    return "2.40.513.22.34";
}


//Basic Info
function getSiteAddress(){
    return "http://tarks.net/rect/";
}

function getIPAddr(){
    return $_SERVER["REMOTE_ADDR"];
}

function getNowUrl(){
    return $_SERVER["REQUEST_URI"];
}

function getUserAgent(){
    return $_SERVER['HTTP_USER_AGENT'];
}


function getAPIDefaultPoint(){
    return 500;
}

//function getDate(){
//    return date('Y-m-d H:i:s');
//}

function getTimeStamp(){
    return strtotime(date('Y-m-d H:i:s'));
}



function getHttpLanguage(){
    $language = substr($_SERVER['HTTP_ACCEPT_LANGUAGE'], 0, 2);
    if($language == null) $language = "en";
    return $language;
}


function ErrorMessage($msg) {
    MessagePrint("error", $msg, "Error has been encountered.");

    exit();

}


function ErrorPrint($msg, $des) {
    MessagePrint("error", $msg, $des);

    exit();

}

function debugMode(){
    error_reporting(E_ALL);
    ini_set('display_errors', 1);
}

function FatalError(){
  echo "Sorry, something went wrong. We will fix this problem soon.";
    exit();
}

function MessagePrint($category, $message, $des){
    $array = array("category" => $category, "message" => $message, "description" => $des);
   echo json_encode($array);
}

// function loadModule($module){
//     global $API_VERSION, $ACTION, $page_auth, $log, $log_category;
//    require_once 'modules/'.$module.'/'.$module.'.loader.php';
//}
//function loadAPIs($api){
//    global $API_VERSION, $ACTION, $page_auth, $log, $log_category;
//    require_once 'modules/'.$api.'/'.$api.'.api.php';
//}


function P($str){
  echo htmlspecialchars($str);
}

function A($str){
  return htmlspecialchars($str);
}


function CoreInfo(){
  global $SERVER_VERSION;
  echo "<h2>SquareCore</h2><br><h1>".$SERVER_VERSION."</h1>";
}



function RealEscapeString($value){
    global $db_conn;
    return mysqli_real_escape_string($db_conn, $value);

}


function REQUEST($value){
  return RealEscapeString($_REQUEST[$value]);
}


function GET($value){
  return RealEscapeString($_GET[$value]);
}

function POST($value){
  return RealEscapeString($_POST[$value]);
}

function PostAct($url, $arrayvars){



for ($i=0 ; $i < count($arrayvars);$i++){

$vars =+ $arrayvars[$i][0]."=".$arrayvars[$i][1];
  if($i != count($arrayvars) - 1){
 $vars =+ "&";
  }
 
}

//$myvars = 'myvar1=' . $myvar1 . '&myvar2=' . $myvar2;

$ch = curl_init( $url );
curl_setopt( $ch, CURLOPT_POST, 1);
curl_setopt( $ch, CURLOPT_POSTFIELDS, $vars);
curl_setopt( $ch, CURLOPT_FOLLOWLOCATION, 1);
curl_setopt( $ch, CURLOPT_HEADER, 0);
curl_setopt( $ch, CURLOPT_RETURNTRANSFER, 1);

$response = curl_exec( $ch );

return $response;
}

function array_info_match($row, $info){
    for ($i=0 ; $i < count($info);$i++){
      if(SecurityInfoCheck($info[$i])) $result_arr[$info[$i]] = $row[$info[$i]];

    }

    return $result_arr;
}

//Print for native app
function print_info($row, $info){
 global $API_VERSION;

if($API_VERSION >= 1){
//API 1



 echo json_encode(array_info_match($row, $info));


 }else{
//API BETA
   for ($i=0 ; $i < count($info);$i++){
    if(count($info) == $i + 1){
echo $row[$info[$i]];
}else{
 echo $row[$info[$i]]."/LINE/.";
   }

}


}
   
    }
    
     function GenerateString($length)  
    {  
        $characters  = "0123456789";  
        $characters .= "abcdefghijklmnopqrstuvwxyz";  
        $characters .= "ABCDEFGHIJKLMNOPQRSTUVWXYZ";  
        $characters .= "_";  
          
        $string_generated = "";  
          
        $nmr_loops = $length;  
        while ($nmr_loops--)  
        {  
            $string_generated .= $characters[mt_rand(0, strlen($characters))];  
        }  
          
        return $string_generated;  
    }  

//Print for native app
function print_array($row){

   echo  json_encode($row);
    }


    function ExplodeInfoValue($info){
	return explode("//",$info);
}

//Language name
function SetUserName($lang, $name_1, $name_2){
if($lang == "ko"){
$name = $name_1.$name_2;
}else{
$name = $name_2." ".$name_1;
}
return $name;
}

//
//function email_valid($temp_email) {
//    return preg_match("^[0-9a-zA-Z_-]+(\.[0-9a-zA-Z_-]+)*@[0-9a-zA-Z_-]+(\.[0-9a-zA-Z_-]+)+$", $temp_email);
//}

function contentconvert($content)
{
  return str_replace("&lt;etr&gt;", "<br>", htmlspecialchars($content));
}

//Print Error
function alert_error_print($title, $content){
    alert_print("danger", $title, $content);
}

function alert_print($category, $title, $content){
echo '<br><div class="alert alert-'.$category.'" role="alert">
      <strong>'.$title.'</strong>  '.$content.'</div>';
}

     function setRelationStatus($me_srl, $you_srl){
      global $user_permission_status;
//Select you srl
  $me_favorite = mysqli_fetch_array(DBQuery("SELECT * FROM  `favorite` WHERE  `user_srl` LIKE '$me_srl' AND `category` LIKE '3' AND `value` LIKE '$you_srl' AND `status` LIKE '0'"));
   $you_favorite = mysqli_fetch_array(DBQuery("SELECT * FROM  `favorite` WHERE  `user_srl` LIKE '$you_srl' AND `category` LIKE '3' AND `value` LIKE '$me_srl' AND `status` LIKE '0'"));
  $you_srl_info = mysqli_fetch_array(DBQuery("SELECT * FROM  `pages` WHERE  `srl` LIKE '$you_srl'"));

  //Global
  $status = 0;


  if($me_srl == 0 || $me_srl == null) return $status;
  //Member
  if($me_srl != null) $status = 1;


  //Check like me and you are like too.
if($me_favorite['value'] == $you_srl) $status = 2;
  //Check like you
if($you_favorite['value'] == $me_srl && $me_srl != 0) $status = 3;

  //Check I'm owner
  if($me_srl == $you_srl) $status = 4;
 if($me_srl == $you_srl_info['admin']) $status = 4;
 
 //Check unknown
 if($you_srl_info['status'] > 4 || $you_srl_info == null) $status = -1;
 if($user_permission_status == 1) $status = 4;
  return $status;
}

function arr_del($list_arr, $del_value) // 배열, 삭제할 값
{
$b = array_search($del_value,$list_arr); 
if($b!==FALSE) unset($list_arr[$b]); 
 return $list_arr;
}

function lottoNum($min,$max=100){ 
    return(rand(1,$max)<=$min); 
}


function ThreadAct($name, $array){
    require_once 'core/thread.class.php';
    $thread = new Thread("localhost");
    $thread->setFunc( $name,  $array);
    $thread->start();
    $thread->query();
}

      
?>