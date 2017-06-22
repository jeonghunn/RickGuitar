<?php
/**
 * Created by Tarks.
 * User: JHRunning
 */


class SquareApiClass{


    function API_getList($user_srl){

        $DOCUMENT_CLASS = new DocumentClass();
        $PAGE_CLASS = new PageClass();
        $ATTACH_CLASS = new AttachClass();

        $page_srl = REQUEST('page_srl');
        $start_doc = REQUEST('start_doc');
        $doc_number = REQUEST('doc_number');
        $doc_info = REQUEST('doc_info');
        $attach_info = REQUEST('attach_info');

        $DocList = $DOCUMENT_CLASS -> document_getList($PAGE_CLASS, $ATTACH_CLASS, $user_srl, $page_srl, $start_doc, $doc_number,  ExplodeInfoValue($doc_info), ExplodeInfoValue($attach_info));
        print_array($DocList);


    }


    function API_Read($user_srl){

        $DOCUMENT_CLASS = new DocumentClass();
        $PAGE_CLASS = new PageClass();
        $ATTACH_CLASS = new AttachClass();

        $doc_srl = REQUEST('doc_srl');
        $doc_info = REQUEST('doc_info');
        $attach_info = REQUEST('attach_info');

        $Doc_read = $DOCUMENT_CLASS -> document_read($PAGE_CLASS, $ATTACH_CLASS, $user_srl, $doc_srl, ExplodeInfoValue($attach_info));
        print_info($Doc_read, ExplodeInfoValue($doc_info));

    }



    function API_Write($user_srl){


        $SQUARE_CLASS = new SquareClass();
        $PAGE_CLASS = new PageClass();
        $ATTACH_CLASS = new AttachClass();
        $PUSH_CLASS = new PushClass();

        $page_srl = REQUEST('page_srl');
        $title = REQUEST('title');
        $content = REQUEST('content');
        $data = REQUEST('data');
        $permission = REQUEST('permission');
        $status = REQUEST('status');
        $privacy = REQUEST('privacy');

        $square_write = $SQUARE_CLASS->Write($PAGE_CLASS, $ATTACH_CLASS, $PUSH_CLASS, $page_srl, $user_srl, $title, $content, $data, $permission, $status, $privacy);

        echo json_encode($square_write);


    }


    function API_StatusUpdate($user_srl){
        $DOCUMENT_CLASS = new DocumentClass();
        $PAGE_CLASS = new PageClass();

        $doc_srl = REQUEST('doc_srl');
        $status = REQUEST('status');


        $document_status_update = $DOCUMENT_CLASS -> document_status_update($PAGE_CLASS, $doc_srl, $user_srl, $status);
        if($document_status_update == true){
            echo "success";
        }else{
            echo "error";
        }
    }



    function API_AttachDownload(){

        $ATTACH_CLASS = new AttachClass();


        $filevalue = REQUEST('filevalue');

        $ATTACH_CLASS -> AttachDownload($filevalue);

    }


    function API_getCommentList($user_srl){



        $DOCUMENT_CLASS = new DocumentClass();
        $COMMENT_CLASS = new CommentClass();
        $PAGE_CLASS = new PageClass();


        $doc_srl = REQUEST('doc_srl');
        $comment_info = REQUEST('comment_info');
        $start_comment = REQUEST('start_comment');
        $comment_number = REQUEST('comment_number');




        $CommentList = $COMMENT_CLASS -> comment_getList($PAGE_CLASS, $DOCUMENT_CLASS, $user_srl, $doc_srl, $start_comment, $comment_number);
        $COMMENT_CLASS -> comment_PrintList($PAGE_CLASS, $DOCUMENT_CLASS, $user_srl, $CommentList, ExplodeInfoValue($comment_info));
    }



    function API_CommentWrite($user_srl){
        $DOCUMENT_CLASS = new DocumentClass();
        $COMMENT_CLASS = new CommentClass();
        $PAGE_CLASS = new PageClass();
        $PUSH_CLASS = new PushClass();

        $doc_srl = REQUEST('doc_srl');
        $content = REQUEST('content');
        $permission = REQUEST('permission');
        $privacy = REQUEST('privacy');

        $comment_write =  $COMMENT_CLASS -> comment_write($PAGE_CLASS, $DOCUMENT_CLASS, $PUSH_CLASS, $doc_srl, $user_srl, $content, $permission, $privacy);

        if($comment_write == true){
            echo "success";

        }else{
            echo "error";
        }

    }



    function API_CommentStatusUpdate($user_srl){

        $DOCUMENT_CLASS = new DocumentClass();
        $COMMENT_CLASS = new CommentClass();
        $PAGE_CLASS = new PageClass();

        $comment_srl = REQUEST('comment_srl');
        $status = REQUEST('status');

        $comment_status_update = $COMMENT_CLASS -> comment_status_update($PAGE_CLASS, $DOCUMENT_CLASS, $comment_srl, $user_srl, $status);
        if($comment_status_update == true){
            echo "success";

        }else{
            echo "error";
        }
    }





}

