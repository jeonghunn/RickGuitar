<?php
    
//Basic Info
//function getSiteAddress(){
//    return "http://tarks.net/develop/favorite/";
//}

function getCoreUrl(){
    return "http://tarks.net/develop/favorite/";
}

function getAPIUrl(){
    return getCoreUrl()."api.php";
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

//function getDate(){
//    return date('Y-m-d H:i:s');
//}

function getTimeStamp(){
    return strtotime(date('Y-m-d H:i:s'));
}

function initLanguage(){
  //Set language
$language = getHttpLanguage();
//if($user_srl != null){
//    $user_lang = mysql_fetch_array(mysql_query("SELECT * FROM  `pages` WHERE  `user_srl` LIKE '$user_srl'"));
//    $language = $user_lang['lang'];
//}


    // setup locale and translation
    setlocale(LC_ALL, 'en_US.UTF-8');
 require_once "lang/".$language.".php";


}

function T($str)
{
    global $L;
    if (isset($L[$str]))
        return $L[$str];
    else
        return $str;
}

function getClientVersion(){
    return "0.1.4.0.15";
}

function getHttpLanguage(){
    $language = substr($_SERVER['HTTP_ACCEPT_LANGUAGE'], 0, 2);
    if($language == null) $language = "en";
    return $language;
}


function ErrorMessage($msg) {
  require_once 'core/header.php';
echo '<div class="jumbotron"><h1>'.T('error_'.$msg).'</h1><p>'.T('error_'.$msg.'_des').'</p></div>';
    require_once 'core/footer.php';

    exit();
}

function FatalError(){
  echo "Sorry, something went wrong. We will fix this problem soon.";
    exit();
}

function S($str){
  echo T($str);
}

function P($str){
  echo htmlspecialchars($str);
}

function A($str){
  return htmlspecialchars($str);
}

function CoreInfo(){
  global $SERVER_VERSION;
  echo "<h2>FavoriteCore</h2><br><h1>".$SERVER_VERSION."</h1>";
}

function REQUEST($value){
  return mysql_real_escape_string($_REQUEST[$value]);
}


function GET($value){
  return mysql_real_escape_string($_GET[$value]);
}

function POST($value){
  return mysql_real_escape_string($_POST[$value]);
}

function PostAct($url, $arrayvars){

    $vars = null;

for ($i=0 ; $i < count($arrayvars);$i++){


    $vars = $vars.$arrayvars[$i][0]."=".$arrayvars[$i][1];
  if($i != count($arrayvars) - 1){
 $vars = $vars."&";
  }

}



//$myvars = 'myvar1=' . $myvar1 . '&myvar2=' . $myvar2;

$ch = curl_init( $url );
curl_setopt( $ch, CURLOPT_POST, 1);
curl_setopt( $ch, CURLOPT_POSTFIELDS, $vars);
curl_setopt( $ch, CURLOPT_FOLLOWLOCATION, 1);
curl_setopt( $ch, CURLOPT_HEADER, false);
    curl_setopt($ch, CURLOPT_USERAGENT, getUserAgent());
curl_setopt( $ch, CURLOPT_RETURNTRANSFER, 1);

$response = curl_exec( $ch );

return $response;
}

//Print for native app
//function print_info($row, $info){
// global $API_VERSION;
//
//if($API_VERSION >= 1){
////API 1
//
//
//   for ($i=0 ; $i < count($info);$i++){
//$result_arr[] = array($info[$i] => $row[$info[$i]]);
//
//
//}
// echo json_encode($result_arr);
//
//
// }else{
////API BETA
//   for ($i=0 ; $i < count($info);$i++){
//    if(count($info) == $i + 1){
//echo $row[$info[$i]];
//}else{
// echo $row[$info[$i]]."/LINE/.";
//   }
//
//}
//
//
//}
//
//    }
    
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

   echo implode("/LINE/.", $row);
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


function CheckLogin(){
  if(isset($_SESSION['user_srl_auth'])) {
return true;
  }
  return false;
}

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

function getLanguageStrings(){

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
      
?>