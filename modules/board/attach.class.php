<?php


class AttachClass{

    function getAttachInfoByfileValue($filevalue)
    {
        $row = mysql_fetch_array(mysql_query("SELECT * FROM  `attach` WHERE  `filevalue` LIKE '$filevalue'"));
        return $row;
    }

    function getAttachInfoBySrl($srl)
    {
        $row = mysql_fetch_array(mysql_query("SELECT * FROM  `attach` WHERE  `srl` LIKE '$srl'"));
        return $row;
    }

    function attach_file($page_srl, $doc_srl, $user_srl, $status)
    {
        $image_path = "files/images/";
        $binaries_path = "files/binaries/";
        if ($_FILES['uploadedfile']['name'] == null) return false;
//$img_name = $file_name.".".$tmp_img[1];
        $file = $_FILES['uploadedfile']['name'];
        $filename = basename($file, strrchr($file, '.'));
        $extension = substr(strrchr($file, '.'), 1);
        $filevalue = getTimeStamp() . '-' . GenerateString(10);
        $size = $_FILES['uploadedfile']["size"];
//Check jpg image
        if ($extension == "jpg" || $extension == "jpeg") {
            $filename = $filevalue;
            $kind = "image";
            $img_name = $filename . "." . $extension;
            $target_path = $image_path . basename($img_name);
        } else {
            $kind = "file";
            $target_path = $binaries_path . $filevalue;
        }


        //파일 사이즈 체크 5M 제한 5M :5242880
        if ($size > 31457280) {
            ErrorMessage("attach_size_error");

        }



        $upload_result = move_uploaded_file($_FILES['uploadedfile']['tmp_name'], $target_path);
if($upload_result)  $result = mysql_query("INSERT INTO `attach` (`page_srl`, `doc_srl`, `user_srl`, `kind`, `filename`, `extension`, `filevalue`, `date`, `size`, `status` , `ip_addr`) VALUES ('$page_srl', '$doc_srl', '$user_srl', '$kind', '$filename', '$extension', '$filevalue', '" . getTimeStamp() . "', '$size', '$status','" . getIPAddr() . "');");

        return $upload_result;
    }

//Require document_class.php
    function attach_read($DOCUMENT_CLASS, $PAGE_CLASS, $user_srl, $doc_srl)
    {
        $status = $DOCUMENT_CLASS -> getDocStatus($PAGE_CLASS, $user_srl, $doc_srl);
        $result = mysql_query("SELECT * FROM  `attach` WHERE  `doc_srl` =$doc_srl AND  (`status` <=$status OR (`user_srl` =$user_srl AND `status` < 5))");

        return $result;
    }

    function getDocAttachCount($doc_srl)
    {
        $count = $this -> getAttachCount($doc_srl);
        $comment_count = mysql_query("UPDATE `documents` SET `attach` = '$count' WHERE `srl` = '$doc_srl'");
    }

    function getAttachCount($doc_srl)
    {
        $attach_count = mysql_query("SELECT * FROM  `attach` WHERE  `doc_srl` = '$doc_srl' AND `status` != '5'");
        $total = mysql_num_rows($attach_count);

        return $total;
    }

    function addAttachDownloadCount($attach_srl)
    {
        $attach_info = $this -> getAttachInfoBySrl($attach_srl);
        $result_num = $attach_info['count'] + 1;
        $comment_count = mysql_query("UPDATE `attach` SET  `count` = '$result_num' WHERE `srl` = '$attach_srl'");
    }


    function attach_read_print($DOCUMENT_CLASS, $user_srl, $doc_srl)
    {
        //$user_srl = AuthCheck($user_srl, false);
        $row = $this -> attach_read($DOCUMENT_CLASS, $user_srl, $doc_srl);

        $total = mysql_num_rows($row);
        for ($i = 0; $i < $total; $i++) {
            mysql_data_seek($row, $i);           //포인터 이동
            $result = mysql_fetch_array($row);        //레코드를 배열로 저장

            if ($result['kind'] == "image") {
                echo getSiteAddress() . "files/images/" . $result['filevalue'] . "." . $result['extension'] . "/LINE/.";
            }

            if ($result['kind'] == "file") {
                echo getSiteAddress() . "board/download.php?v=" . $result['filevalue'] . "&n=" . $result['filename'] . "&e=" . $result['extension'] . "/LINE/.";
            }

        }
    }


}
?>