<? if(!defined("642979")) exit();

//Information : auth_value is value
$auth = "642979";
//Make a Auth code string


 function MakeAuthCode($length, $auth_value, $category)  {
    global $date, $REMOTE_ADDR;

 

    //IF auth code already... Delete!
      $deletesql ="DELETE FROM `auth` WHERE `value` = '$auth_value'";
            $deleteresult = mysql_query($deletesql);



       $i = false;
       $repeat = 0;

   while($i == false) {
      echo  $i;
      $i = true;
      $repeat = $repeat + 1;


    //Auth Code Reulst
        $auth_code_result = GenerateString($length);  
     //   GenerateString($length);  

         //Add to Auth Information to Server
            if($auth_value != null) $sql ="INSERT INTO `auth` (`key`, `value`, `category`, `date`, `ipaddr`) VALUES ('$auth_code_result', '$auth_value', '$category', '$date', '$REMOTE_ADDR');";
            $result = mysql_query($sql) or $i = false;

            if($repeat > 30){
            	exit();
            }
   }
 


 

            return $auth_code_result;

        }

        function AuthCheck($auth_key, $delete) {
        	//Auth_key is value of authcode
        $sql ="SELECT * FROM  `auth` WHERE  `key` LIKE '$auth_key'";
        $result = mysql_query($sql);
        $row=mysql_fetch_array($result);

        $value = $row['value'];

        if($row['active'] == 0){
          return false;
        }
//IF delete true, delete auth key
       if($delete == true){
        	  $deletesql ="DELETE FROM `auth` WHERE `key` = '$auth_key'";
            $deleteresult = mysql_query($deletesql);
      }

        return $value;

        }

        function FindAuthCode($value, $category)  {
        $sql ="SELECT * FROM  `auth` WHERE  `value` LIKE '$value' AND  `category` LIKE '$category'";
        $result = mysql_query($sql);
        $row=mysql_fetch_array($result);

$auth_code = $row[key];
        if($row[key] == ""){
        	$auth_code = "null";
        }
//Return key
        return $auth_code;
        }

  
?>