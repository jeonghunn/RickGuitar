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






}

