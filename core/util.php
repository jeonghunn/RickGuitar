<?php if(!defined("642979")) exit();
    


function ErrorMessage($msg) {
  require 'core/header.php';
echo '<div class="jumbotron"><h1>'.T('error_'.$msg).'</h1><p>'.T('error_'.$msg.'_des').'</p></div>';


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

//Print for native app
function print_info($row, $info){
 global $API_VERSION;

if($API_VERSION >= 1){
//API 1


   for ($i=0 ; $i < count($info);$i++){
$result_arr[] = array($info[$i] => $row[$info[$i]]);


}
 echo json_encode($result_arr);


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
  $me_favorite = mysql_fetch_array(mysql_query("SELECT * FROM  `favorite` WHERE  `user_srl` LIKE '$me_srl' AND `category` LIKE '3' AND `value` LIKE '$you_srl' AND `status` LIKE '0'"));
   $you_favorite = mysql_fetch_array(mysql_query("SELECT * FROM  `favorite` WHERE  `user_srl` LIKE '$you_srl' AND `category` LIKE '3' AND `value` LIKE '$me_srl' AND `status` LIKE '0'"));
  $you_srl_info = mysql_fetch_array(mysql_query("SELECT * FROM  `pages` WHERE  `user_srl` LIKE '$you_srl'"));

  //Global
  $status = 0;

  //Member
  if($me_srl != null) $status = 1;
  if($me_srl == 0) return 0;

  //Check like me and you are like too.
if($me_favorite['value'] == $you_srl) $status = 2;
  //Check like you
if($you_favorite['value'] == $me_srl && $me_srl != 0) $status = 3;

  //Check I'm owner
  if($me_srl == $you_srl) $status = 4;
 if($me_srl == $you_srl_info['admin']) $status = 4;
 
 //Check unknown
 if($you_srl_info['status'] > 4) $status = -1;
 if($user_permission_status == 1) $status = 4;
  return $status;
}

function arr_del($list_arr, $del_value) // 배열, 삭제할 값
{
$b = array_search($del_value,$list_arr); 
if($b!==FALSE) unset($list_arr[$b]); 
 return $list_arr;
}
      
?>