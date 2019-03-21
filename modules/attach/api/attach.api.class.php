<?php
/**
 * Created by Tarks.
 * User: JHRunning
 */


class AttachApiClass{


    function API_DownloadAttach($user_srl){
        
      //  $PAGE_CLASS = new PageClass();
        $ATTACH_CLASS = new AttachClass();

        $filevalue = REQUEST('filevalue');


       $ATTACH_CLASS -> AttachDownload($filevalue);


    }


    function API_UploadAttach($user_srl)
    {

        //  $PAGE_CLASS = new PageClass();
        $ATTACH_CLASS = new AttachClass();


        return $ATTACH_CLASS->attach_file('square', 0, 0, $user_srl, 0);

    }






}

