<? if(!defined("642979")) exit();

//Information : auth_value is value

//Connect to DB
 	mysql_select_db('favorite',$db_conn);


//Make a Auth Code
 	     function GenerateString($length)  
    {  
        $characters  = "0123456789";  
        $characters .= "abcdefghijklmnopqrstuvwxyz";  
        $characters .= "ABCDEFGHIJKLMNOPQRSTUVWXYZ";  
          
        $string_generated = "";  
          
        $nmr_loops = $length;  
        while ($nmr_loops--)  
        {  
            $string_generated .= $characters[mt_rand(0, strlen($characters))];  
        }  
          
        return $string_generated;  
    }  

    //Auth Code Reulst
    $auth_code_result = GenerateString(15);  

    //Add to Auth Information to Server
            $sql ="INSERT INTO `auth` (`key`, `value`, `date`, `ipaddr`) VALUES ('$auth_code_result', '$auth_value', '$date', '$REMOTE_ADDR');";
            $result = mysql_query($sql);

  
?>